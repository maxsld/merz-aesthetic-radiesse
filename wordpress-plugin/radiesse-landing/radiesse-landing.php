<?php
/**
 * Plugin Name:  RADIESSE® – Landing Page
 * Description:  Standalone page template for the RADIESSE® France landing page. Does not interfere with the active theme.
 * Version:      1.2.0
 * Author:       Merz Aesthetics France
 * License:      GPL-2.0-or-later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'RADIESSE_LANDING_DIR', plugin_dir_path( __FILE__ ) );
define( 'RADIESSE_LANDING_URL', plugin_dir_url( __FILE__ ) );

// ── 1. Register page template ───────────────────────────────────────────────
add_filter( 'theme_page_templates', function ( $templates ) {
    $templates['radiesse-landing'] = 'RADIESSE Landing';
    return $templates;
} );

// ── 2. Load our template file when the page uses it ─────────────────────────
add_filter( 'template_include', function ( $template ) {
    if ( is_page() ) {
        $tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $tpl === 'radiesse-landing' ) {
            $file = RADIESSE_LANDING_DIR . 'templates/page-radiesse.php';
            if ( file_exists( $file ) ) {
                return $file;
            }
        }
    }
    return $template;
} );

// ── 3. Dequeue WP default styles on this page only ──────────────────────────
// CSS, JS, fonts are all inlined directly in the template — no enqueue needed.
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_page() ) return;
    $tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
    if ( $tpl !== 'radiesse-landing' ) return;

    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

// ── 4. Inject centres from DB into the page (overrides hardcoded list) ──────
add_action( 'wp_head', function () {
    if ( ! is_page() ) return;
    $tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
    if ( $tpl !== 'radiesse-landing' ) return;

    $centers = get_option( 'radiesse_centers' );
    if ( $centers && is_array( $centers ) && count( $centers ) > 0 ) {
        echo '<script>window.RADIESSE_CENTERS=' . wp_json_encode( $centers ) . ';</script>' . "\n";
    }
} );

// ── 4b. Export CSV ───────────────────────────────────────────────────────────
// Sur admin_init : declenche avant tout affichage. Appele depuis le rendu de la
// page, les en-tetes HTTP arrivaient trop tard et le CSV etait ajoute a la fin
// du HTML de l'admin, donnant un fichier inutilisable.
add_action( 'admin_init', function () {
    if ( ! isset( $_GET['page'], $_GET['radiesse_export'] ) ) return;
    if ( $_GET['page'] !== 'radiesse-landing-centers' ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'radiesse_export' );
    radiesse_landing_export_csv();
    exit;
} );

// ── 5. Admin page — CSV import ───────────────────────────────────────────────
add_action( 'admin_menu', function () {
    add_menu_page(
        'RADIESSE® — Centres',
        'RADIESSE Landing',
        'manage_options',
        'radiesse-landing-centers',
        'radiesse_landing_admin_page',
        'dashicons-location-alt',
        30
    );
} );

function radiesse_landing_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $message = '';
    $error   = '';

    // ── Handle CSV upload ────────────────────────────────────────────────────
    if ( isset( $_POST['radiesse_import_csv'] ) ) {
        check_admin_referer( 'radiesse_csv_import' );

        if ( empty( $_FILES['csv_file']['tmp_name'] ) ) {
            $error = 'Aucun fichier sélectionné.';
        } else {
            $report = null;
            $result = radiesse_landing_parse_csv( $_FILES['csv_file']['tmp_name'], $report );
            if ( is_wp_error( $result ) ) {
                $error = $result->get_error_message();
            } else {
                update_option( 'radiesse_centers', $result, false );
                $message = count( $result ) . ' centre(s) importé(s) avec succès.';
                if ( ! empty( $report['skipped'] ) ) {
                    $error = count( $report['skipped'] ) . ' centre(s) écarté(s), adresse non localisable : '
                           . implode( ' ; ', array_slice( $report['skipped'], 0, 20 ) )
                           . ( count( $report['skipped'] ) > 20 ? ' …' : '' );
                }
            }
        }
    }

    // ── Handle reset to hardcoded ────────────────────────────────────────────
    if ( isset( $_POST['radiesse_reset'] ) ) {
        check_admin_referer( 'radiesse_csv_import' );
        delete_option( 'radiesse_centers' );
        $message = 'Liste réinitialisée (données par défaut du plugin).';
    }

    $centers  = get_option( 'radiesse_centers' );
    $count    = is_array( $centers ) ? count( $centers ) : 0;
    $using_db = is_array( $centers ) && $count > 0;

    ?>
    <div class="wrap">
        <h1>RADIESSE® — Gestion des centres</h1>

        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html( $message ); ?></p></div>
        <?php endif; ?>
        <?php if ( $error ) : ?>
            <div class="notice notice-error is-dismissible"><p><?php echo esc_html( $error ); ?></p></div>
        <?php endif; ?>

        <div style="background:#fff;border:1px solid #ccd0d4;border-radius:4px;padding:24px;max-width:700px;margin-top:20px;">
            <h2 style="margin-top:0;">Statut actuel</h2>
            <?php if ( $using_db ) : ?>
                <p>✅ <strong><?php echo $count; ?> centres</strong> chargés depuis la base de données (CSV importé).</p>
                <p>
                    <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=radiesse-landing-centers&radiesse_export=1' ), 'radiesse_export' ) ); ?>"
                       class="button">⬇ Exporter la liste actuelle (CSV)</a>
                </p>
            <?php else : ?>
                <p>ℹ️ Aucun CSV importé — la carte utilise la <strong>liste par défaut</strong> intégrée au plugin (<?php echo count( radiesse_landing_default_centers() ); ?> centres).</p>
            <?php endif; ?>
        </div>

        <div style="background:#fff;border:1px solid #ccd0d4;border-radius:4px;padding:24px;max-width:700px;margin-top:20px;">
            <h2 style="margin-top:0;">Importer un nouveau CSV</h2>

            <p>Le fichier CSV doit contenir ces colonnes (séparateur virgule ou point-virgule, encodage UTF-8) :</p>
            <code style="display:block;background:#f0f0f0;padding:10px;border-radius:4px;margin-bottom:16px;">
                name, street, streetNumber, zip, city, country
            </code>
            <p><strong>Les en-têtes de l'export Merz sont acceptés tels quels</strong>, aucun renommage n'est
               nécessaire : <code>Name Doc Loc</code>, <code>Street Name</code>, <code>Postal Code</code>,
               <code>VILLE</code>, <code>Country</code>. Le numéro de rue est isolé automatiquement
               s'il est collé au libellé (« 165 ROUTE DE NIMES »).</p>
            <p>Les coordonnées GPS (lat/lng) sont calculées automatiquement via l'adresse. Ajoutez des
               colonnes <code>lat</code> et <code>lng</code> au fichier pour éviter cette étape sur les
               gros imports.</p>

            <p><a href="<?php echo esc_url( RADIESSE_LANDING_URL . 'assets/centers-template.csv' ); ?>" class="button" download>⬇ Télécharger le modèle CSV</a></p>

            <form method="post" enctype="multipart/form-data" style="margin-top:20px;">
                <?php wp_nonce_field( 'radiesse_csv_import' ); ?>
                <table class="form-table" style="margin:0;">
                    <tr>
                        <th style="padding-left:0;"><label for="csv_file">Fichier CSV</label></th>
                        <td><input type="file" name="csv_file" id="csv_file" accept=".csv,text/csv" required></td>
                    </tr>
                </table>
                <p style="margin-top:16px;">
                    <button type="submit" name="radiesse_import_csv" class="button button-primary">⬆ Importer</button>
                </p>
            </form>
        </div>

        <?php if ( $using_db ) : ?>
        <div style="background:#fff;border:1px solid #ccd0d4;border-radius:4px;padding:24px;max-width:700px;margin-top:20px;">
            <h2 style="margin-top:0;">Réinitialiser</h2>
            <p>Supprime le CSV importé et revient à la liste par défaut du plugin.</p>
            <form method="post">
                <?php wp_nonce_field( 'radiesse_csv_import' ); ?>
                <button type="submit" name="radiesse_reset" class="button button-secondary"
                    onclick="return confirm('Réinitialiser la liste ?')">Réinitialiser</button>
            </form>
        </div>
        <?php endif; ?>

        <?php if ( $using_db ) : ?>
        <div style="background:#fff;border:1px solid #ccd0d4;border-radius:4px;padding:24px;max-width:700px;margin-top:20px;">
            <h2 style="margin-top:0;">Liste actuelle (<?php echo $count; ?> centres)</h2>
            <table class="widefat striped" style="font-size:13px;">
                <thead>
                    <tr>
                        <th>Nom</th><th>Ville</th><th>Code postal</th><th>GPS</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ( $centers as $p ) : ?>
                    <tr>
                        <td><?php echo esc_html( $p['name'] ); ?></td>
                        <td><?php echo esc_html( $p['city'] ); ?></td>
                        <td><?php echo esc_html( $p['zip'] ); ?></td>
                        <td><?php echo isset( $p['lat'] ) ? esc_html( $p['lat'] ) . ', ' . esc_html( $p['lng'] ) : '<em style="color:#999">non géocodé</em>'; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Normalise un en-tete pour la comparaison : sans accents, sans espaces,
 * sans ponctuation, en minuscules. "Postal Code" et "postal_code" donnent
 * tous les deux "postalcode".
 */
function radiesse_landing_normalize_key( $h ) {
    $h = ltrim( trim( (string) $h ), "\xEF\xBB\xBF" );
    if ( function_exists( 'iconv' ) ) {
        $t = @iconv( 'UTF-8', 'ASCII//TRANSLIT', $h );
        if ( $t !== false ) $h = $t;
    }
    return preg_replace( '/[^a-z0-9]/', '', strtolower( $h ) );
}

/**
 * Noms de colonnes acceptes pour chaque champ. Le premier est le nom canonique.
 * On accepte les en-tetes bruts de l'export Merz ("Name Doc Loc", "Street Name",
 * "Postal Code", "VILLE") pour qu'aucun renommage ne soit necessaire avant import.
 */
function radiesse_landing_header_aliases() {
    return [
        'name'         => [ 'name', 'namedocloc', 'nomdocloc', 'nom', 'centre', 'center' ],
        'street'       => [ 'street', 'streetname', 'rue', 'adresse', 'address' ],
        'streetNumber' => [ 'streetnumber', 'numero', 'numerorue', 'housenumber' ],
        'zip'          => [ 'zip', 'zipcode', 'postalcode', 'codepostal', 'cp' ],
        'city'         => [ 'city', 'ville', 'town' ],
        'country'      => [ 'country', 'pays' ],
        'lat'          => [ 'lat', 'latitude' ],
        'lng'          => [ 'lng', 'lon', 'long', 'longitude' ],
    ];
}

/**
 * Associe chaque champ a l'indice de colonne correspondant. Si plusieurs colonnes
 * peuvent convenir (un fichier contenant a la fois "ZIP" et "Postal Code"), on
 * retient celle qui contient reellement des donnees exploitables.
 */
function radiesse_landing_map_columns( $headers, $rows ) {
    $map = [];
    foreach ( radiesse_landing_header_aliases() as $field => $aliases ) {
        $candidates = [];
        foreach ( $headers as $i => $h ) {
            if ( in_array( radiesse_landing_normalize_key( $h ), $aliases, true ) ) {
                $candidates[] = $i;
            }
        }
        if ( ! $candidates ) continue;
        if ( count( $candidates ) === 1 ) { $map[ $field ] = $candidates[0]; continue; }

        $best = null; $bestScore = -1;
        foreach ( $candidates as $i ) {
            $score = 0;
            foreach ( $rows as $r ) {
                if ( ! isset( $r[ $i ] ) ) continue;
                $v = trim( $r[ $i ] );
                if ( $v === '' ) continue;
                $score++;
                // un code postal francais tient en 5 chiffres : ca departage ZIP et Postal Code
                if ( $field === 'zip' && preg_match( '/^\d{5}$/', $v ) ) $score += 2;
            }
            if ( $score > $bestScore ) { $bestScore = $score; $best = $i; }
        }
        $map[ $field ] = $best;
    }
    return $map;
}

function radiesse_landing_parse_csv( $filepath, &$report = null ) {
    $handle = fopen( $filepath, 'r' );
    if ( ! $handle ) {
        return new WP_Error( 'csv_open', 'Impossible d\'ouvrir le fichier.' );
    }

    // Detect separator
    $first_line = fgets( $handle );
    rewind( $handle );
    $separator = ( substr_count( $first_line, ';' ) > substr_count( $first_line, ',' ) ) ? ';' : ',';

    $headers = null;
    $rows    = [];
    while ( ( $row = fgetcsv( $handle, 4096, $separator ) ) !== false ) {
        if ( count( $row ) < 2 || ( count( $row ) === 1 && trim( (string) $row[0] ) === '' ) ) continue;
        if ( $headers === null ) {
            $headers = array_map( 'trim', $row );
            $headers[0] = ltrim( $headers[0], "\xEF\xBB\xBF" );
            continue;
        }
        // on tolere une ligne plus courte ou plus longue que l'en-tete
        $rows[] = $row;
    }
    fclose( $handle );

    if ( $headers === null ) {
        return new WP_Error( 'csv_empty', 'Fichier vide : aucune ligne d\'en-tete trouvee.' );
    }

    $map      = radiesse_landing_map_columns( $headers, $rows );
    $required = [ 'name', 'city', 'zip', 'country' ];
    $missing  = [];
    foreach ( $required as $f ) {
        if ( ! isset( $map[ $f ] ) ) $missing[] = $f;
    }
    if ( $missing ) {
        $aliases = radiesse_landing_header_aliases();
        $hints   = [];
        foreach ( $missing as $f ) {
            $hints[] = sprintf( '"%s" (accepte aussi : %s)', $f, implode( ', ', array_slice( $aliases[ $f ], 1 ) ) );
        }
        return new WP_Error( 'csv_headers',
            'Colonne(s) manquante(s) : ' . implode( ' ; ', $hints ) .
            '. Colonnes trouvees : ' . implode( ', ', $headers ) );
    }

    $centers = [];
    $skipped = [];
    foreach ( $rows as $row ) {
        $p = [];
        foreach ( $map as $field => $i ) {
            $p[ $field ] = isset( $row[ $i ] ) ? trim( (string) $row[ $i ] ) : '';
        }
        foreach ( [ 'name', 'street', 'streetNumber', 'zip', 'city', 'country', 'lat', 'lng' ] as $f ) {
            if ( ! isset( $p[ $f ] ) ) $p[ $f ] = '';
        }
        if ( $p['name'] === '' ) continue;

        // L'export Merz met le numero dans le libelle de rue ("165 ROUTE DE NIMES").
        // On l'isole pour que l'adresse affichee et l'itineraire soient corrects.
        if ( $p['streetNumber'] === '' && $p['street'] !== ''
             && preg_match( '/^\s*(\d+\s*(?:bis|ter|quater|[a-z])?)\s+(.+)$/iu', $p['street'], $m ) ) {
            $p['streetNumber'] = trim( $m[1] );
            $p['street']       = trim( $m[2] );
        }

        if ( $p['lat'] !== '' ) $p['lat'] = (float) str_replace( ',', '.', $p['lat'] );
        if ( $p['lng'] !== '' ) $p['lng'] = (float) str_replace( ',', '.', $p['lng'] );

        if ( $p['lat'] === '' || $p['lng'] === '' ) {
            $coords = radiesse_landing_geocode( $p );
            if ( $coords ) {
                $p['lat'] = $coords['lat'];
                $p['lng'] = $coords['lng'];
            }
        }
        // Un centre sans coordonnees casserait le marqueur sur la carte : on
        // l'ecarte, mais on le signale pour qu'il ne disparaisse pas en silence.
        if ( $p['lat'] === '' || $p['lng'] === '' ) {
            $skipped[] = $p['name'] . ' (' . trim( $p['zip'] . ' ' . $p['city'] ) . ')';
            continue;
        }

        $centers[] = $p;
    }

    $report = [ 'skipped' => $skipped, 'total_lignes' => count( $rows ) ];

    if ( empty( $centers ) ) {
        return new WP_Error( 'csv_empty',
            'Aucun centre exploitable : les ' . count( $rows ) . ' ligne(s) lues n\'ont pas pu etre geocodees. '
            . 'Verifiez les adresses, ou ajoutez des colonnes lat et lng au fichier.' );
    }

    return $centers;
}

function radiesse_landing_geocode( $p ) {
    $address = implode( ' ', array_filter( [
        $p['streetNumber'] ?? '',
        $p['street']       ?? '',
        $p['zip']          ?? '',
        $p['city']         ?? '',
        $p['country']      ?? '',
    ] ) );

    $url      = 'https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&q=' . urlencode( $address );
    $response = wp_remote_get( $url, [
        'headers' => [ 'User-Agent' => 'RadiesseLandingPlugin/1.0 (merzaesthetics.fr)' ],
        'timeout' => 5,
    ] );

    if ( is_wp_error( $response ) ) return null;

    $body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( empty( $body[0] ) ) return null;

    return [ 'lat' => (float) $body[0]['lat'], 'lng' => (float) $body[0]['lon'] ];
}

function radiesse_landing_export_csv() {
    $centers = get_option( 'radiesse_centers', [] );

    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename="radiesse-centers.csv"' );

    $out     = fopen( 'php://output', 'w' );
    $columns = [ 'name', 'street', 'streetNumber', 'zip', 'city', 'country', 'lat', 'lng' ];

    fputcsv( $out, $columns );
    foreach ( $centers as $p ) {
        $row = [];
        foreach ( $columns as $col ) {
            $row[] = $p[ $col ] ?? '';
        }
        fputcsv( $out, $row );
    }
    fclose( $out );
}

function radiesse_landing_default_centers() {
    return [
        ['name'=>'Centre Esthétique Saint-Honoré','city'=>'Paris','zip'=>'75008','lat'=>48.870477,'lng'=>2.310511,'street'=>'Rue de Ponthieu','streetNumber'=>'12','country'=>'France'],
        ['name'=>'Cabinet Médical Bourdonnais','city'=>'Paris','zip'=>'75007','lat'=>48.856138,'lng'=>2.302764,'street'=>'Avenue de la Bourdonnais','streetNumber'=>'85','country'=>'France'],
        ['name'=>'Clinique Saint-Germain Esthétique','city'=>'Paris','zip'=>'75006','lat'=>48.852399,'lng'=>2.339677,'street'=>'Boulevard Saint-Germain','streetNumber'=>'126','country'=>'France'],
        ['name'=>'Cabinet Monceau','city'=>'Paris','zip'=>'75017','lat'=>48.882461,'lng'=>2.309578,'street'=>'Place du Général Catroux','streetNumber'=>'7','country'=>'France'],
        ['name'=>'Centre Dermatologique Opéra','city'=>'Paris','zip'=>'75009','lat'=>48.8805,'lng'=>2.330073,'street'=>'Square Moncey','streetNumber'=>'5','country'=>'France'],
        ['name'=>'Clinique Esthétique de Corbiac','city'=>'Saint-Médard-en-Jalles','zip'=>'33160','lat'=>44.876705,'lng'=>-0.696811,'street'=>'Rue Claude Bernard','streetNumber'=>'26','country'=>'France'],
        ['name'=>'Centre Médical Caudéran','city'=>'Bordeaux','zip'=>'33200','lat'=>44.856182,'lng'=>-0.615268,'street'=>'Rue Falquet','streetNumber'=>'12','country'=>'France'],
        ['name'=>'Cabinet Rodocanachi','city'=>'Marseille','zip'=>'13008','lat'=>43.274374,'lng'=>5.385837,'street'=>'Boulevard Rodocanachi','streetNumber'=>'55 bis','country'=>'France'],
        ['name'=>'Institut Esthétique Prado','city'=>'Marseille','zip'=>'13006','lat'=>43.289532,'lng'=>5.374693,'street'=>'Rue Roux de Brignoles','streetNumber'=>'13','country'=>'France'],
        ['name'=>'Cabinet Quai Jean Moulin','city'=>'Lyon','zip'=>'69001','lat'=>45.766576,'lng'=>4.837887,'street'=>'Quai Jean Moulin','streetNumber'=>'9','country'=>'France'],
        ['name'=>'Clinique Presqu\'île Esthétique','city'=>'Lyon','zip'=>'69002','lat'=>45.754,'lng'=>4.832,'street'=>'Rue de la République','streetNumber'=>'48','country'=>'France'],
        ['name'=>'Centre Médical Wilson','city'=>'Toulouse','zip'=>'31000','lat'=>43.6045,'lng'=>1.4442,'street'=>'Place du Président Wilson','streetNumber'=>'3','country'=>'France'],
        ['name'=>'Cabinet Promenade','city'=>'Nice','zip'=>'06000','lat'=>43.6959,'lng'=>7.2716,'street'=>'Rue de France','streetNumber'=>'21','country'=>'France'],
        ['name'=>'Centre Esthétique Graslin','city'=>'Nantes','zip'=>'44000','lat'=>47.217029,'lng'=>-1.563169,'street'=>'Place Aristide Briand','streetNumber'=>'5','country'=>'France'],
        ['name'=>'Cabinet Médical Antigone','city'=>'Montpellier','zip'=>'34000','lat'=>43.600264,'lng'=>3.898424,'street'=>'Rue de Syracuse','streetNumber'=>'82','country'=>'France'],
        ['name'=>'Clinique Villa Ermitage','city'=>'Lambersart','zip'=>'59130','lat'=>50.644465,'lng'=>3.031826,'street'=>'Avenue Henri Delecaux','streetNumber'=>'8 bis','country'=>'France'],
        ['name'=>'Centre Dermatologique Neudorf','city'=>'Strasbourg','zip'=>'67100','lat'=>48.5734,'lng'=>7.7521,'street'=>'Route du Polygone','streetNumber'=>'104','country'=>'France'],
        ['name'=>'Cabinet Entraigues','city'=>'Tours','zip'=>'37000','lat'=>47.388074,'lng'=>0.688381,'street'=>'Rue d\'Entraigues','streetNumber'=>'19','country'=>'France'],
        ['name'=>'Centre CLEMA','city'=>'Angers','zip'=>'49000','lat'=>47.444203,'lng'=>-0.543031,'street'=>'Rue François Cevert','streetNumber'=>'16','country'=>'France'],
        ['name'=>'Maison Elixience','city'=>'Metz','zip'=>'57000','lat'=>49.107022,'lng'=>6.163254,'street'=>'Rue Bossuet','streetNumber'=>'31','country'=>'France'],
        ['name'=>'Dermatologie Esthétique Caen','city'=>'Caen','zip'=>'14000','lat'=>49.179074,'lng'=>-0.361873,'street'=>'Place de l\'Ancienne Comédie','streetNumber'=>'12','country'=>'France'],
        ['name'=>'Cabinet Léon Gontier','city'=>'Amiens','zip'=>'80000','lat'=>49.894379,'lng'=>2.292921,'street'=>'Place Léon Gontier','streetNumber'=>'4','country'=>'France'],
        ['name'=>'Skin Aesthetics Landouge','city'=>'Limoges','zip'=>'87100','lat'=>45.84325,'lng'=>1.192997,'street'=>'Avenue de Landouge','streetNumber'=>'223','country'=>'France'],
        ['name'=>'Cabinet Sarliève','city'=>'Cournon-d\'Auvergne','zip'=>'63800','lat'=>45.741463,'lng'=>3.159245,'street'=>'Rue de Sarliève','streetNumber'=>'21','country'=>'France'],
        ['name'=>'Clinique Del Mar','city'=>'Antibes','zip'=>'06160','lat'=>43.558947,'lng'=>7.128187,'street'=>'Boulevard Francis Meilland','streetNumber'=>'90','country'=>'France'],
        ['name'=>'Centre Esthétique Thabor','city'=>'Rennes','zip'=>'35000','lat'=>48.1147,'lng'=>-1.6702,'street'=>'Rue de Paris','streetNumber'=>'42','country'=>'France'],
    ];
}
