<?php
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RADIESSE® - Merzaesthetics France</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/favicon-16x16.png">
  <link rel="icon" type="image/x-icon" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/favicon.ico">
  <link rel="mask-icon" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="stylesheet" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/vendor/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/vendor/leaflet/leaflet.min.css">
  <?php wp_head(); ?>
  <style>
@font-face  {
  font-family: "Aeonik Pro";
  src: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/fonts/AeonikPro-Light.otf") format("opentype");
  font-style: normal;
  font-weight: 300;
  font-display: swap;
}

@font-face  {
  font-family: "Aeonik Pro";
  src: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/fonts/AeonikPro-Regular.otf") format("opentype");
  font-style: normal;
  font-weight: 400;
  font-display: swap;
}

@font-face  {
  font-family: "Aeonik Pro";
  src: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/fonts/AeonikPro-Bold.otf") format("opentype");
  font-style: normal;
  font-weight: 700;
  font-display: swap;
}

@font-face  {
  font-family: "Romantic Couple";
  src: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/fonts/Romantic-Couple-Bold.ttf") format("truetype");
  font-style: normal;
  font-weight: 700;
  font-display: swap;
}

/* ===================== VARIABLES ===================== */
:root  {
  --blue: #00A6C7;
  --blue-dark: #173757;
  --navy: #173757;
  --ink: #173757;
  --sky: #EFFFFF;
  --cream: #fff;
  --paper: #ffffff;
  --page-max-width: 1680px;
  --header-height: 68px;
}

/* ===================== RESET ===================== */
*  {
  box-sizing: border-box !important;
}
*,
*::before,
*::after  {
  border-radius: 0 !important;
}

.sr-only  {
  width: 1px !important;
  height: 1px !important;
  position: absolute !important;
  overflow: hidden !important;
  clip: rect(0, 0, 0, 0) !important;
  white-space: nowrap !important;
}

html  {
  min-width: 320px !important;
  scroll-behavior: smooth !important;
}

body  {
  margin: 0 !important;
  color: var(--ink) !important;
  background: var(--paper) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-weight: 300 !important;
  font-kerning: normal !important;
  text-rendering: optimizeLegibility !important;
}

sup  {
  font-size: 0.6em;
  line-height: 0;
  vertical-align: super;
  position: relative;
  top: -0.38em;
}

.sup-mark  {
  font-size: 0.7em;
  line-height: 0;
  vertical-align: super;
  position: relative;
  top: -0.38em;
}

.sup-reg  {
  font-size: 0.6em;
  line-height: 0;
  vertical-align: super;
  position: relative;
  top: -0.18em;
}

a  {
  color: inherit !important;
  text-decoration: none !important;
}

.nowrap-brand  {
  white-space: nowrap !important;
  display: inline !important;
}

/* ===================== PRIMARY HEADER ===================== */
.site-header  {
  position: relative !important;
  z-index: 300 !important;
  background: #fff !important;
  border-bottom: 1px solid rgba(17, 17, 17, 0.08) !important;
  transition: background 180ms ease, border-color 180ms ease, box-shadow 180ms ease !important;
}

body.header-is-fixed  {
  padding-top: var(--header-height) !important;
}

.site-header-inner  {
  max-width: 1400px !important;
  min-height: 68px !important;
  width: 100% !important;
  margin: 0 auto !important;
  padding: 0 clamp(24px, 3vw, 40px) 0 clamp(34px, 5vw, 92px) !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  gap: 24px !important;
}

.site-brand  {
  flex: 0 0 auto !important;
  display: inline-flex !important;
  align-items: center !important;
}

.site-brand img  {
  width: 176px !important;
  height: auto !important;
  display: block !important;
  filter: none !important;
  transition: filter 180ms ease !important;
}

.site-menu-toggle  {
  display: none !important;
  width: 44px !important;
  height: 44px !important;
  padding: 0 !important;
  border: 0 !important;
  background: transparent !important;
  color: var(--navy) !important;
  cursor: pointer !important;
}

.site-menu-toggle span  {
  width: 22px !important;
  height: 2px !important;
  display: block !important;
  margin: 5px auto !important;
  background: currentColor !important;
  transition: transform 180ms ease, opacity 180ms ease !important;
}

.site-menu  {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-end !important;
  gap: clamp(14px, 1.6vw, 32px) !important;
  flex-wrap: nowrap !important;
}

.site-menu-item  {
  display: inline-flex !important;
  position: relative !important;
  padding: 22px 0 20px !important;
  color: var(--navy) !important;
  font-size: clamp(12px, 0.92vw, 15px) !important;
  font-weight: 700 !important;
  letter-spacing: 0 !important;
  line-height: 1 !important;
  text-transform: uppercase !important;
  white-space: nowrap !important;
  transition: color 180ms ease !important;
}

.site-menu-item-highlight  {
  padding: 12px 18px !important;
  background: var(--blue-dark) !important;
  color: #fff !important;
  text-align: center !important;
  justify-content: center !important;
  font-weight: 500 !important;
}

.site-menu-item.is-active::before,
.site-menu-item:hover::before,
.site-menu-item:focus-visible::before  {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 8px !important;
  height: 2px !important;
  background: var(--blue) !important;
}

.site-menu-item-highlight.is-active::before,
.site-menu-item-highlight:hover::before,
.site-menu-item-highlight:focus-visible::before  {
  content: none !important;
}

.site-menu-item:focus-visible  {
  outline: none !important;
}

.site-header.is-scrolled  {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  background: #fff !important;
  border-bottom-color: rgba(17, 17, 17, 0.08) !important;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
}

.site-header.is-menu-open .site-menu-toggle span:first-child  {
  transform: translateY(7px) rotate(45deg) !important;
}
.site-header.is-menu-open .site-menu-toggle span:nth-child(2)  {
  opacity: 0 !important;
}
.site-header.is-menu-open .site-menu-toggle span:last-child  {
  transform: translateY(-7px) rotate(-45deg) !important;
}

/* ===================== SHARED COMPONENTS ===================== */
.watch-btn  {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: fit-content !important;
  min-height: 53px !important;
  padding: 18px 22px !important;
  background: var(--blue-dark) !important;
  color: #fff !important;
  font-size: 15px !important;
  font-weight: 500 !important;
  letter-spacing: 0 !important;
  line-height: 1.15 !important;
  text-align: center !important;
  text-transform: uppercase !important;
  transition: transform 120ms ease !important;
}

.section-shell  {
  max-width: 1200px !important;
  margin: 0 auto !important;
  padding: 0 34px !important;
}

.section-heading  {
  max-width: 760px !important;
  margin-bottom: 34px !important;
}

.section-heading h2  {
  margin: 0 !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
}

.section-heading h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.section-heading p  {
  margin: 0 auto !important;
  max-width: 640px !important;
  color: rgba(23, 55, 87, 0.68) !important;
  font-size: 19px;
  font-weight: 300 !important;
  line-height: 1.55;
}

.benefits-tag  {
  margin: 0 0 14px !important;
  color: var(--blue) !important;
  font-size: clamp(11px, 0.8vw, 13px) !important;
  font-weight: 700 !important;
  line-height: 1.2 !important;
  text-transform: uppercase !important;
  letter-spacing: 0 !important;
}

.benefits-tag::after  {
  content: "" !important;
  width: 84px !important;
  height: 2px !important;
  display: block !important;
  margin: 8px 0 0 !important;
  background: linear-gradient(90deg, var(--blue) 0 62%, rgba(0, 166, 199, 0.3) 100%) !important;
}

.benefits-tag-center  {
  display: table !important;
  text-align: center !important;
  width: auto !important;
  margin: 0 auto 14px !important;
}

.benefits-tag-center::after  {
  margin-left: auto !important;
  margin-right: auto !important;
}

.benefits-heading-center .benefits-tag  {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  width: 100% !important;
  margin: 0 auto 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
  text-align: center !important;
}

.benefits-heading-center .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
  margin-left: auto !important;
  margin-right: auto !important;
}

.indications-heading .benefits-tag  {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  width: 100% !important;
  margin: 0 auto 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
  text-align: center !important;
}

.indications-heading .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
  margin-left: auto !important;
  margin-right: auto !important;
}

.moa-heading .benefits-tag  {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  width: 100% !important;
  margin: 0 auto 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
  text-align: center !important;
}

.moa-heading .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
  margin-left: auto !important;
  margin-right: auto !important;
}

.faq-heading .benefits-tag  {
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  width: 100% !important;
  margin: 0 auto 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
  text-align: center !important;
}

.faq-heading .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
  margin-left: auto !important;
  margin-right: auto !important;
}

.cta-heading .benefits-tag  {
  margin-bottom: 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
}

.cta-heading .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
}

.definition-copy .benefits-tag  {
  margin-bottom: 25px !important;
  font-size: clamp(10px, 1vw, 14px) !important;
  letter-spacing: 0 !important;
}

.definition-copy .benefits-tag::after  {
  width: 58px !important;
  margin-top: 6px !important;
}

/* ===================== HERO ===================== */
.hero  {
  position: relative !important;
  /* Ratio releve sur la maquette de reference (2970x983). En figeant la
     hauteur sur la largeur, le cadre "R" en background: contain garde
     exactement la meme place quelle que soit la hauteur de la fenetre. */
  aspect-ratio: 2970 / 983 !important;
  height: auto !important;
  overflow: hidden !important;
  background: #007ea8 !important;
}

/* Vidéo : occupe 55% de la largeur à gauche */
.hero-video-shell  {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  bottom: 0 !important;
  width: 55% !important;
  z-index: 2 !important;
  overflow: hidden !important;
}

.hero-video-poster  {
  position: absolute !important;
  inset: 0 !important;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: 32% 0% !important;
  display: block !important;
}

.hero-video-shell.is-video-ready .hero-video-poster  {
  opacity: 0 !important;
  transition: opacity 220ms ease !important;
}

.hero-video  {
  position: relative !important;
  z-index: 1 !important;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: 32% 0% !important;
  display: block !important;
}

.hero-video-controls  {
  position: absolute !important;
  left: 50% !important;
  bottom: 18px !important;
  width: min(400px, calc(100% - 44px)) !important;
  z-index: 2 !important;
  min-height: 34px !important;
  padding: 5px 9px !important;
  display: grid !important;
  grid-template-columns: 24px minmax(0, 1fr) auto 24px !important;
  align-items: center !important;
  gap: 8px !important;
  border: 1px solid rgba(255, 255, 255, 0.12) !important;
  background: rgba(9, 20, 35, 0.52) !important;
  box-shadow: 0 14px 34px rgba(0, 0, 0, 0.22) !important;
  opacity: 0 !important;
  transform: translateX(-50%) translateY(8px) !important;
  pointer-events: none !important;
  backdrop-filter: blur(12px) !important;
  transition: opacity 180ms ease, transform 180ms ease !important;
}

.hero-video-shell:hover .hero-video-controls,
.hero:hover .hero-video-controls,
.hero-video-shell:focus-within .hero-video-controls,
.hero-video-shell.is-controls-visible .hero-video-controls  {
  opacity: 1 !important;
  transform: translateX(-50%) translateY(0) !important;
  pointer-events: auto !important;
}

.hero-video-controls .video-control-btn  {
  width: 24px !important;
  height: 24px !important;
  padding: 0 !important;
  border: 0 !important;
  background: transparent !important;
  color: #fff !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 11px !important;
  cursor: pointer !important;
  appearance: none !important;
  -webkit-appearance: none !important;
}

.hero-video-controls .video-control-btn:focus-visible  {
  outline: 1px solid rgba(255, 255, 255, 0.7) !important;
  outline-offset: 2px !important;
}

.hero-video-controls .video-time  {
  min-width: 2.6ch !important;
  color: rgba(255, 255, 255, 0.9) !important;
  font-size: 10px !important;
  font-variant-numeric: tabular-nums !important;
  line-height: 1 !important;
}

.hero-video-controls .video-progress-wrap  {
  display: flex !important;
  align-items: center !important;
}

.hero-video-controls .video-progress  {
  width: 100% !important;
  margin: 0 !important;
  background: transparent !important;
  appearance: none !important;
  -webkit-appearance: none !important;
}

.hero-video-controls .video-progress::-webkit-slider-runnable-track  {
  height: 2px !important;
  background: linear-gradient(
    to right,
    var(--blue) 0%,
    var(--blue) var(--progress, 0%),
    rgba(255, 255, 255, 0.38) var(--progress, 0%),
    rgba(255, 255, 255, 0.38) 100%
  ) !important;
}

.hero-video-controls .video-progress::-moz-range-track  {
  height: 2px !important;
  border: 0 !important;
  background: rgba(255, 255, 255, 0.38) !important;
}

.hero-video-controls .video-progress::-moz-range-progress  {
  height: 2px !important;
  background: var(--blue) !important;
}

.hero-video-controls .video-progress::-webkit-slider-thumb  {
  width: 10px !important;
  height: 10px !important;
  margin-top: -4px !important;
  border: 0 !important;
  border-radius: 999px !important;
  background: var(--blue) !important;
  appearance: none !important;
  -webkit-appearance: none !important;
}

.hero-video-controls .video-progress::-moz-range-thumb  {
  width: 10px !important;
  height: 10px !important;
  border: 0 !important;
  border-radius: 999px !important;
  background: var(--blue) !important;
}

/*
  Panel bleu + R : hero-frame.png est l'image qui contient
  à la fois le fond bleu et le découpage du R en espace blanc/transparent.
  On la positionne de left: 28% à right: 0, couvrant toute la hauteur.
  La vidéo est visible à travers la partie gauche (zone du R).
*/
.hero-panel  {
  position: absolute !important;
  top: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  left: -2% !important;
  z-index: 3 !important;
  background: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/hero-frame.webp") center center / contain no-repeat !important;
  display: flex !important;
  align-items: center !important;
  pointer-events: none !important;
}

/* La colonne bleue va de 55% (bord le plus large du R) a 100% de la fenetre.
   Le panneau debordant de -2% a gauche, cela fait 45/102 = 44.12% de sa largeur.
   Le bloc de texte y est centre, donc sa position est identique a toutes les tailles. */
.hero-panel-inner  {
  width: 44.12% !important;
  margin: 0 0 0 auto !important;
  padding: 0 clamp(16px, 1.6vw, 32px) !important;
  display: flex !important;
  justify-content: center !important;
}

/* Contenu texte : décalé à droite du R (≈ 22% de la largeur du panel) */
.hero-panel-content  {
  /* La plus longue ligne du titre mesure 10.49 fois la taille de police,
     quelle que soit la largeur. On cale la description sur cette mesure
     (10.6 pour la marge d'arrondi) et le bloc se reduit a cette largeur,
     ce qui le centre correctement dans la zone bleue. */
  --hero-title-size: max(28px, 3vw) !important;
  --hero-copy-width: calc(10.6 * var(--hero-title-size)) !important;
  width: fit-content !important;
  max-width: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  gap: clamp(14px, 1.8vw, 22px) !important;
  text-align: left !important;
  pointer-events: auto !important;
}

.hero-panel-content h1,
.hero-description  {
  width: 100% !important;
  max-width: var(--hero-copy-width) !important;
}

.hero-panel-content h1  {
  /* max-content : le titre garde ses 3 lignes meme si la police de repli a des
     metriques plus larges que prevu. */
  width: max-content !important;
  max-width: 100% !important;
  margin: 0 !important;
  color: #fff !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: var(--hero-title-size) !important;
  font-weight: 300 !important;
  line-height: 1.12 !important;
  text-transform: uppercase !important;
  letter-spacing: 0 !important;
}

.hero-ref  {
  font-size: 0.36em !important;
  font-weight: 400 !important;
}

.hero-description  {
  margin: 0 !important;
  color: rgba(255,255,255,0.9) !important;
  font-family: Arial, Helvetica, sans-serif !important;
  font-size: max(12px, 1.15vw) !important;
  line-height: 1.62 !important;
  overflow-wrap: anywhere !important;
  text-align: left !important;
}

/* CTA hero */
.hero-cta  {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  align-self: flex-start !important;
  /* Le bouton suit lui aussi la largeur, pour rester proportionne au texte. */
  min-height: max(53px, 3.04vw) !important;
  padding: max(18px, 1.03vw) max(22px, 1.26vw) !important;
  border: 0 !important;
  background: var(--blue-dark) !important;
  color: #fff !important;
  font-size: max(15px, 0.86vw) !important;
  font-weight: 500 !important;
  letter-spacing: 0 !important;
  line-height: 1.15 !important;
  text-align: center !important;
  text-transform: uppercase !important;
  transition: transform 120ms ease !important;
  white-space: nowrap !important;
}

.hero-cta sup  {
  font-style: normal !important;
}

.hero-footnotes  {
  display: grid !important;
  gap: 0 !important;
  padding-top: 12px !important;
}

.hero-footnote  {
  margin: 0 !important;
  color: #fff !important;
  font-family: Arial, Helvetica, sans-serif !important;
  font-size: clamp(12px, 0.8vw, 12px) !important;
  line-height: 1.5 !important;
}

/* ---- Responsive hero ---- */
@media (max-width: 1200px)  {
  .hero  {
  height: auto !important;
}

  .hero-video-shell  {
  width: 52% !important;
}

  .hero-panel-inner  {
  width: 47.06% !important;
  padding: 0 16px !important;
}

  .hero-panel-content  {
  --hero-title-size: clamp(24px, 2.4vw, 42px) !important;
  padding-top: 0 !important;
  gap: 16px !important;
}

  .hero-panel-content h1,
  .hero-description  {
  max-width: var(--hero-copy-width) !important;
}

  .hero-panel-content h1  {
  font-size: var(--hero-title-size) !important;
}

  .hero-description  {
  font-size: clamp(15px, 1vw, 15px) !important;
  line-height: 1.5 !important;
}

  .hero-footnote  {
  font-size: 8px !important;
  line-height: 1.45 !important;
}

  .section-heading h2,
  .benefits-heading-center h2,
  .definition-copy h2,
  .indications-heading h2,
  .moa-heading h2,
  .faq-heading h2,
  .cta-heading h2  {
  font-size: clamp(28px, 2.8vw, 40px) !important;
}
}

@media (max-width: 1100px)  {
  .hero  {
  height: auto !important;
  aspect-ratio: auto !important;
}

  .hero-video-shell  {
  position: relative !important;
  width: 100% !important;
  height: auto !important;
  min-height: 0 !important;
  max-height: none !important;
  aspect-ratio: 16 / 9 !important;
}

  .hero-video  {
  height: 100% !important;
}

  .hero-panel  {
  position: relative !important;
  left: 0 !important;
  background-image: none !important;
  background-color: #007ea8 !important;
}

  .hero-panel-inner  {
  width: 100% !important;
  padding: 0 !important;
}

  .hero-panel-content  {
  padding: 32px 22px !important;
  max-width: none !important;
  width: 100% !important;
  transform: none !important;
}

  .hero-panel-content h1,
  .hero-description  {
  width: 100% !important;  max-width: none !important;
}

  .hero-cta  {
  white-space: normal !important;
  text-align: center !important;
  align-self: flex-start !important;
  width: fit-content !important;
}

  .hero-panel-content h1  {
  font-size: clamp(24px, 4.4vw, 38px) !important;
  line-height: 1.08 !important;
}

  .section-heading h2,
  .benefits-heading-center h2,
  .definition-copy h2,
  .indications-heading h2,
  .moa-heading h2,
  .faq-heading h2,
  .cta-heading h2  {
  font-size: clamp(26px, 4vw, 34px) !important;
  line-height: 1.08 !important;
}
}

@media (max-width: 520px)  {
  .hero-video-shell  {
  height: auto !important;
}
  .hero-video-controls  {
  left: 12px !important;
  right: 12px !important;
  bottom: 12px !important;
  gap: 8px !important;
}
  .hero-panel-content h1  {
  font-size: 31px !important;
  line-height: 1.06 !important;
}
}

/* ===================== DEFINITION ===================== */
.definition-section  {
  padding: 6rem 0 72px !important;
  background: #fff !important;
}

.definition-content  {
  display: grid !important;
  grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr) !important;
  align-items: stretch !important;
  gap: 48px !important;
}

.definition-copy h2  {
  margin: 0 0 20px !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 44px) !important;
  font-weight: 300 !important;
  line-height: 1.04 !important;
  text-transform: uppercase !important;
}

.definition-title-script  {
  color: var(--blue-dark) !important;
  font-family: "Romantic Couple", "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-weight: 700 !important;
  font-size: clamp(42px, 4.6vw, 72px) !important;
  letter-spacing: 0.02em !important;
  line-height: 0.95 !important;
  text-transform: none !important;
}

.definition-copy h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.definition-intro  {
  color: #00A6C7 !important;
  margin: 0 0 16px !important;
  font-size: 17px !important;
  font-weight: 300 !important;
  font-style: italic !important;
  line-height: 1.55 !important;
  text-align: justify !important;
}

.definition-copy p  {
  margin: 0 0 24px !important;
  color: rgba(23,55,87,0.7);
  font-size: 17px !important;
  font-weight: 300 !important;
  line-height: 1.55 !important;
  text-align: justify !important;
}

.definition-highlight-line  {
  display: inline !important;
  color: var(--blue) !important;
  font-size: 1.08em !important;
  font-weight: 400 !important;
  font-style: italic !important;
}

.definition-callout  {
  margin: 0 0 28px !important;
  padding: 18px 20px !important;
  background: linear-gradient(180deg, rgba(0, 166, 199, 0.1), rgba(0, 166, 199, 0.05)) !important;
  border-left: 4px solid var(--blue) !important;
  color: var(--blue-dark) !important;
}

.definition-footnote  {
  margin: 0 !important;
  color: rgba(23,55,87,0.62) !important;
  line-height: 1.5 !important;
}

.definition-footnote.hero-footnote  {
  font-size: clamp(8px, 0.62vw, 9px) !important;
}

.watch-btn + .definition-footnote  {
  margin-top: 10px !important;
}

.definition-footnote + .definition-footnote  {
  margin-top: 4px !important;
}

.definition-visual  {
  margin: 0 !important;
  border-radius: 8px;
  overflow: hidden !important;
  min-height: 100% !important;
  background: #fff !important;
}

.definition-video,
.definition-media  {
  width: 100% !important;
  height: 100% !important;
  display: block !important;
  object-fit: cover !important;
  object-position: center !important;
  background: #fff !important;
}

/* ===================== BENEFITS ===================== */
.benefits-section  {
  padding: 80px 0 !important;
  background: #fff !important;
}

.benefits-heading-center  {
  max-width: none !important;
  text-align: center !important;
  margin-bottom: 22px !important;
  position: relative !important;
}

.benefits-heading-center h2  {
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
  margin: 0 !important;
}

.benefits-heading-center h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

#benefices .benefits-handwritten  {
  position: static !important;
  display: block !important;
  width: fit-content !important;
  margin: 0 0 50px 0 !important;
  max-width: none !important;
  color: var(--blue) !important;
  font-family: "Romantic Couple", "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(32px, 5.4vw, 48px) !important;
  font-weight: 700 !important;
  line-height: 0.95 !important;
  text-align: left !important;
  white-space: nowrap !important;
  transform: rotate(-5deg) !important;
}

#benefices .benefits-handwritten-accent  {
  color: var(--blue) !important;
}

.benefit-block  {
  display: grid !important;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) !important;
  align-items: center !important;
  gap: 56px !important;
  padding: 48px 0 !important;
  border-top: 1px solid rgba(0,0,0,0.07) !important;
}

.benefit-block:first-of-type  {
  border-top: none !important;
}

.benefit-block-right .benefit-copy  {
  order: 1 !important;
}
.benefit-block-right .benefit-visual  {
  order: 2 !important;
}

.benefit-visual  {
  margin: 0 !important;
}

.benefit-img-placeholder  {
  width: 100% !important;
  min-height: 380px !important;
  border-radius: 8px;
  position: relative !important;
  overflow: hidden !important;
  background-color: var(--cream) !important;
  background-position: center center !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.benefit-img-placeholder::after  {
  content: "Image à des fins d’illustration." !important;
  position: absolute !important;
  right: 12px !important;
  bottom: 10px !important;
  color: rgba(255, 255, 255, 0.72) !important;
  font-size: 10px !important;
  line-height: 1.2 !important;
  letter-spacing: 0 !important;
  white-space: nowrap !important;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.28) !important;
}

.benefit-img-1  {
  background-image: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_LauraS_03.webp") !important;
  background-position: 50% 28% !important;
  background-size: 180% !important;
}
.benefit-img-2  {
  background-image: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_YuliaS_05.webp") !important;
  background-position: 40% 36% !important;
  background-size: 180% !important;
}
.benefit-img-3  {
  background-image: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_ZyaS_05.webp") !important;
  background-position: 38% 30% !important;
  background-size: 155% !important;
}

.benefit-eyebrow  {
  display: block !important;
  margin-bottom: 8px !important;
  color: var(--blue) !important;
  font-size: 12px !important;
  font-weight: 700 !important;
  letter-spacing: 0 !important;
  text-transform: uppercase !important;
}

.benefit-copy h3  {
  margin: 0 0 16px !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(32px, 3vw, 44px) !important;
  font-weight: 300 !important;
  line-height: 1.1 !important;
}

.benefit-subtitle  {
  display: inline !important;
  color: var(--navy) !important;
  font-size: clamp(32px, 3vw, 44px) !important;
  font-weight: 300 !important;
  white-space: nowrap !important;
}

#benefit-3-title  {
  color: var(--navy) !important;
  font-size: clamp(32px, 3vw, 44px) !important;
  font-weight: 300 !important;
}

#benefit-3-title .benefit-subtitle  {
  color: var(--blue) !important;
  font-size: inherit !important;
  font-weight: 300 !important;
}

.benefit-copy p  {
  margin: 0 0 24px;
  color: rgba(23,55,87,0.7);
  font-size: 18px;
  font-weight: 300 !important;
  line-height: 1.65;
}

.benefit-stats  {
  margin: 0 0 16px !important;
  padding: 0 !important;
  list-style: none !important;
  display: grid !important;
  gap: 14px !important;
}

.benefit-stats li  {
  display: flex !important;
  align-items: baseline !important;
  gap: 12px !important;
}

.benefit-stats strong  {
  flex: 0 0 auto !important;
  display: inline-block !important;
  min-width: 0 !important;
  color: var(--blue) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(38px, 2.8vw, 52px) !important;
  font-weight: 400 !important;
  font-variant-numeric: tabular-nums lining-nums !important;
  text-align: left !important;
  line-height: 1 !important;
  white-space: nowrap !important;
}

.benefit-stats span  {
  color: rgba(23,55,87,0.68) !important;
  font-size: 16px !important;
  font-weight: 300 !important;
  line-height: 1.4 !important;
}

.benefit-footnote  {
  margin: 8px 0 0 !important;
  color: rgba(23, 55, 87, 0.62) !important;
  font-size: 11px !important;
  line-height: 1.5 !important;
}

.benefit-footnote-inline  {
  margin-top: -4px !important;
}

.benefit-center-disclaimer  {
  margin: -10px 0 18px !important;
  max-width: 720px !important;
  color: rgba(23, 55, 87, 0.58) !important;
  font-size: 11px !important;
  font-weight: 300 !important;
  line-height: 1.5 !important;
  text-align: left !important;
}

.moa-footnote  {
  margin-top: -12px !important;
  text-align: center !important;
}

.benefits-cta-block  {
  padding-top: 48px !important;
  text-align: center !important;
}

/* ===================== INDICATIONS ===================== */
.indications-section  {
  padding: 126px 0 80px !important;
  background: #fff !important;
}

.indications-heading  {
  max-width: none !important;
  text-align: center !important;
  margin-bottom: 48px !important;
}

.indications-heading h2  {
  margin: 28px 0 0 !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
}

.indications-heading h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.indications-heading p  {
  margin: 16px auto 0 !important;
  max-width: 640px !important;
  color: rgba(23,55,87,0.65) !important;
  font-size: 19px !important;
  font-weight: 300 !important;
  line-height: 1.55 !important;
}

.indications-heading .indications-handwritten  {
  margin: 46px 0 0 !important;
  display: table !important;
  width: fit-content !important;
  max-width: none !important;
  color: var(--blue) !important;
  font-family: "Romantic Couple", "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(32px, 5.4vw, 48px) !important;
  font-weight: 700 !important;
  line-height: 0.95 !important;
  text-align: left !important;
  transform: rotate(-4deg) !important;
}

.indications-indicator  {
  margin: 0 !important;
}

.indications-indicator-media  {
  position: relative !important;
  max-width: 1040px !important;
  margin: 0 auto !important;
}

.indications-img-placeholder  {
  width: 100% !important;
  min-height: 720px !important;
  border-radius: 12px;
  background-color: var(--cream) !important;
  background-image: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_LauraS_01-opt.webp") !important;
  background-position: center 38% !important;
  background-size: 128% !important;
  background-repeat: no-repeat !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.indications-img-placeholder::after  {
  content: none !important;
}

/* Callouts génériques */
.ind-callout  {
  position: absolute !important;
  z-index: 5 !important;
  display: flex !important;
  align-items: center !important;
  gap: 18px !important;
  pointer-events: none !important;
  opacity: 0 !important;
  transform: translateY(18px) !important;
  transition: opacity 520ms ease, transform 520ms ease !important;
  will-change: opacity, transform !important;
}

.ind-callout.is-visible  {
  opacity: 1 !important;
  transform: translateY(0) !important;
}

.ind-callout-text  {
  font-size: clamp(12px, 1vw, 15px) !important;
  font-weight: 500 !important;
  line-height: 1.2 !important;
  text-transform: uppercase !important;
  white-space: nowrap !important;
  color: var(--navy) !important;
  text-align: left !important;
}

.ind-callout-text small  {
  display: block !important;
  font-size: 0.85em !important;
  font-style: italic !important;
  font-weight: 300 !important;
  text-transform: none !important;
  color: rgba(23,55,87,0.55) !important;
}

.ind-callout-line  {
  width: 122px !important;
  height: 1px !important;
  display: block !important;
  background: var(--blue) !important;
  flex: 0 0 auto !important;
}

.ind-callout-dots  {
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
  flex: 0 0 auto !important;
}

.ind-skin-frame  {
  position: absolute !important;
  top: -27px !important;
  left: 118px !important;
  width: 273px !important;
  height: 308px !important;
  pointer-events: none !important;
}

.ind-skin-frame-corner  {
  position: absolute !important;
  width: 46px !important;
  height: 46px !important;
  border-color: var(--blue) !important;
  border-style: solid !important;
  opacity: 0.95 !important;
}

.ind-skin-frame-corner-tl  {
  top: 0 !important;
  left: 0 !important;
  border-width: 1px 0 0 1px !important;
}

.ind-skin-frame-corner-bl  {
  bottom: 0 !important;
  left: 0 !important;
  border-width: 0 0 1px 1px !important;
}

.ind-callout-dot  {
  display: inline-block !important;
  width: 10px !important;
  height: 10px !important;
  flex: 0 0 10px !important;
  border-radius: 50% !important;
  box-shadow: 0 0 0 1.5px rgba(255, 255, 255, 0.9) !important;
}

.ind-dot-plus  {
  background: var(--navy) !important;
}

.ind-dot-std  {
  background: var(--blue) !important;
}

.ind-dot-diluted  {
  background: #b7ecf8 !important;
}

.ind-callout-skin-quality  {
  top: 16% !important;
  left: 17% !important;
  width: 420px !important;
  min-height: 250px !important;
  align-items: center !important;
}

.ind-callout-skin-quality .ind-callout-text  {
  position: relative !important;
  z-index: 1 !important;
}
.ind-callout-nasolabial  {
  top: 38% !important;
  right: 15% !important;
  flex-direction: row-reverse !important;
}
.ind-callout-cheeks  {
  top: 46% !important;
  right: 18% !important;
  flex-direction: row-reverse !important;
}
.ind-callout-jawline  {
  top: 53% !important;
  right: 16% !important;
  flex-direction: row-reverse !important;
}
.ind-callout-decollete  {
  top: 83% !important;
  left: 19% !important;
  flex-direction: row-reverse !important;
}
.ind-callout-hands  {
  top: 65% !important;
  right: 4% !important;
  flex-direction: row-reverse !important;
}

.ind-callout-jawline .ind-callout-line  {
  width: 150px !important;
}

.ind-callout-nasolabial .ind-callout-line  {
  width: 172px !important;
}

.indications-legend  {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 24px !important;
  margin-top: 22px !important;
  flex-wrap: wrap !important;
}

.indications-cta-block  {
  padding-top: 42px !important;
  text-align: center !important;
}

.legend-item  {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  color: rgba(23,55,87,0.72) !important;
  font-size: 14px !important;
  font-weight: 400 !important;
}

.legend-item sup  {
  margin-left: -0.25em !important;
}

.legend-dot  {
  display: inline-block !important;
  width: 10px !important;
  height: 10px !important;
  flex: 0 0 10px !important;
  border-radius: 50% !important;
  vertical-align: middle !important;
  box-shadow: 0 0 0 1.5px rgba(255, 255, 255, 0.9) !important;
}

.legend-dot-plus  {
  background: var(--navy) !important;
}

.legend-dot-std  {
  background: var(--blue) !important;
}

.legend-dot-diluted  {
  background: #b7ecf8 !important;
}

/* ===================== MOA ===================== */
.moa-section  {
  padding: 80px 0 !important;
  background: #fff !important;
}

.moa-content  {
  display: grid !important;
  gap: 56px !important;
}

.moa-heading  {
  max-width: none !important;
  text-align: center !important;
  margin-bottom: 0 !important;
}

.moa-heading h2  {
  margin: 0 !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
}

.moa-heading h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.moa-heading p  {
  margin: 16px auto 0 !important;
  max-width: 820px !important;
  color: rgba(23,55,87,0.65) !important;
  font-size: 18px;
  font-weight: 300 !important;
  line-height: 1.42;
}

.moa-callout  {
  max-width: 980px !important;
  margin: 80px auto 80px !important;
  padding: 0 !important;
  display: grid !important;
  grid-template-columns: minmax(0, 1.16fr) minmax(220px, 0.84fr) !important;
  align-items: stretch !important;
  gap: 36px !important;
  border: none !important;
  background: transparent !important;
  text-align: left !important;
}

.moa-callout-copy  {
  display: grid !important;
  gap: 18px !important;
  align-content: center !important;
}

.moa-callout-title  {
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(22px, 2vw, 32px) !important;
  line-height: 1.08 !important;
  font-weight: 300 !important;
  text-transform: uppercase !important;
}

.moa-callout-title strong  {
  display: block !important;
  margin-top: 4px !important;
  color: var(--blue) !important;
  font-size: inherit !important;
  font-weight: inherit !important;
}

.moa-callout-kicker  {
  display: block !important;
  color: var(--navy) !important;
  font-size: clamp(22px, 2vw, 32px) !important;
  font-weight: 300 !important;
}

.moa-callout-body  {
  display: grid !important;
  gap: 18px !important;
}

.moa-callout-note  {
  margin: -8px 0 0 !important;
  max-width: none !important;
  color: rgba(23,55,87,0.58) !important;
  font-size: 11px !important;
  line-height: 1.5 !important;
}

.moa-callout-body p  {
  margin: 0 !important;
  max-width: none !important;
  font-size: 16px;
  line-height: 1.4;
}

.moa-callout-process  {
  width: 78% !important;
  max-width: 320px !important;
  height: auto !important;
  display: block !important;
  margin: 8px 0 0 !important;
}

.moa-callout-points  {
  display: grid !important;
  grid-template-columns: 1fr !important;
  gap: 12px !important;
}

.moa-callout-points p  {
  display: flex !important;
  align-items: flex-start !important;
  gap: 12px !important;
  color: var(--navy) !important;
  font-size: 16px !important;
  line-height: 1.45 !important;
}

.moa-callout-points i  {
  flex: 0 0 auto !important;
  margin-top: 2px !important;
  color: var(--blue) !important;
  font-size: 16px !important;
}

.moa-callout-points span  {
  display: block !important;
}

.moa-callout-visual  {
  margin: 0 !important;
  height: 100% !important;
  align-self: stretch !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px !important;
  border-radius: 8px;
  overflow: hidden !important;
  min-height: 0 !important;
  max-height: 360px !important;
  background: #eef1f4 !important;
}

.moa-callout-image  {
  width: 110% !important;
  height: 100% !important;
  display: block !important;
  object-fit: contain !important;
  object-position: center !important;
}

.moa-heading > p:last-child  {
  font-size: 20px !important;
}

.moa-steps  {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 0 !important;
  flex-wrap: wrap !important;
}

.moa-step  {
  flex: 1 1 220px !important;
  max-width: 300px !important;
  margin-top: 32px !important;
  text-align: center !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  gap: 16px !important;
}

.moa-step-number  {
  width: 48px !important;
  height: 48px !important;
  border-radius: 50%;
  background: var(--blue) !important;
  color: #fff !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: 20px !important;
  font-weight: 700 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  flex: 0 0 auto !important;
}

.moa-step-media  {
  width: 100% !important;
  max-width: 240px !important;
  height: 180px !important;
  border-radius: 8px;
  margin: 0 !important;
  overflow: hidden !important;
  background: linear-gradient(135deg, var(--cream) 0%, rgba(0,166,199,0.2) 100%) !important;
  box-shadow: 0 16px 32px rgba(23, 55, 87, 0.08) !important;
}

.moa-step-media img  {
  width: 100% !important;
  height: 100% !important;
  display: block !important;
  object-fit: cover !important;
}

.moa-step p  {
  margin: 0 !important;
  max-width: 220px !important;
  color: rgba(23,55,87,0.72) !important;
  font-size: 16px !important;
  font-weight: 300 !important;
  line-height: 1.5 !important;
  text-align: center !important;
}

.moa-arrow  {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 0 12px !important;
  color: var(--blue) !important;
  font-size: 24px !important;
  flex: 0 0 auto !important;
}

/* ===================== MOA PILLARS ===================== */
.moa-pillars  {
  width: 100% !important;
  max-width: 1420px !important;
  margin: 0 auto !important;
  padding: 34px 36px 28px !important;
  display: grid !important;
  grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
  gap: 34px !important;
  background: var(--blue-dark) !important;
}

.moa-pillar  {
  min-width: 0 !important;
}

.moa-pillar-icon  {
  width: 96px !important;
  height: 96px !important;
  margin-bottom: 18px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.moa-pillar-icon img  {
  width: 100% !important;
  height: 100% !important;
  display: block !important;
  object-fit: contain !important;
  mix-blend-mode: screen !important;
}

.moa-pillar h3  {
  margin: 0 0 6px !important;
  color: #fff !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  line-height: 1.08 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.02em !important;
}

.moa-pillar-accent  {
  margin: 0 !important;
  color: #00b7e6 !important;
  font-size: 17px !important;
  font-style: italic !important;
  font-weight: 700 !important;
  line-height: 1.25 !important;
}

.moa-pillar-accent + p  {
  margin-top: 8px !important;
}

.moa-pillar p:last-child  {
  margin-bottom: 0 !important;
  color: #fff !important;
  font-size: 16px !important;
  font-weight: 300 !important;
  line-height: 1.5 !important;
}

/* ===================== STATS BAND ===================== */
.stats-band  {
  position: relative !important;
  margin-top: 46px !important;
  background: linear-gradient(90deg, var(--blue-dark) 0%, var(--blue-dark) 46%, var(--blue) 100%) !important;
}

.stats-inner  {
  max-width: 1200px !important;
  margin: 0 auto !important;
  padding: 30px 40px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
}

.stats-list  {
  flex: 1 1 auto !important;
  display: grid !important;
  grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
  gap: 24px !important;
  text-align: center !important;
}

.stat-item  {
  min-height: 72px !important;
  padding: 8px 10px !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: flex-start !important;
  gap: 6px !important;
}

.stat-item strong  {
  display: inline-block !important;
  min-width: 4ch !important;
  color: #fff !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(36px, 2.5vw, 52px) !important;
  font-weight: 400 !important;
  line-height: 0.95 !important;
  text-align: center !important;
  white-space: nowrap !important;
  min-height: 1em !important;
}

.stat-item span  {
  color: rgba(255, 255, 255, 0.82) !important;
  font-size: 14px !important;
  line-height: 1.3 !important;
}

.stat-item span small  {
  display: block !important;
  padding-top: 10px !important;
  font-size: 8.5px !important;
  line-height: 1.35 !important;
  opacity: 0.82 !important;
}

.stats-disclaimer  {
  margin: 0 !important;
  color: rgba(31, 61, 101, 0.76) !important;
  font-size: 12px !important;
  line-height: 1.45 !important;
  text-align: center !important;
}

.stats-disclaimer-wrap  {
  max-width: 1200px !important;
  margin: 14px auto 0 !important;
  padding: 0 40px !important;
}

/* ===================== FAQ ===================== */
.faq-section  {
  padding: 80px 0 !important;
  background: #fff !important;
}

.faq-shell  {
  max-width: 1200px !important;
}

.faq-heading  {
  max-width: 760px !important;
  margin: 0 auto 56px !important;
  text-align: center !important;
}

.faq-heading h2  {
  margin: 0 !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
}

.faq-heading h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.faq-heading p  {
  margin: 16px auto 0 !important;
  max-width: 640px !important;
  color: rgba(23,55,87,0.65) !important;
  font-size: 19px !important;
  font-weight: 300 !important;
  line-height: 1.55 !important;
}

.faq-list  {
  display: grid !important;
  gap: 12px !important;
}

.faq-item  {
  max-width: 800px !important;
  width: 100% !important;
  margin: 0 auto !important;
  border: 1px solid rgba(0, 166, 199, 0.15) !important;
  border-radius: 8px;
  background: var(--cream) !important;
  overflow: hidden !important;
}

.faq-trigger  {
  width: 100% !important;
  padding: 20px 22px !important;
  display: grid !important;
  grid-template-columns: minmax(0, 1fr) 28px !important;
  align-items: center !important;
  gap: 18px !important;
  border: 0 !important;
  background: transparent !important;
  color: inherit !important;
  text-align: left !important;
  cursor: pointer !important;
}

.faq-question  {
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: 21px !important;
  font-weight: 300 !important;
  line-height: 1.45 !important;
}

.faq-toggle  {
  width: 28px !important;
  height: 28px !important;
  position: relative !important;
  justify-self: end !important;
}

.faq-toggle::before,
.faq-toggle::after  {
  content: "" !important;
  width: 18px !important;
  height: 2px !important;
  position: absolute !important;
  left: 50% !important;
  top: 50% !important;
  border-radius: 999px;
  background: var(--blue-dark) !important;
  transform: translate(-50%, -50%) !important;
  transition: transform 220ms ease, opacity 220ms ease !important;
}

.faq-toggle::after  {
  transform: translate(-50%, -50%) rotate(90deg) !important;
}
.faq-item.is-open .faq-toggle::after  {
  opacity: 0 !important;
  transform: translate(-50%, -50%) rotate(90deg) scaleX(0.35) !important;
}
.faq-item.is-open .faq-toggle::before  {
  background: var(--navy) !important;
}

.faq-panel  {
  height: 0;
  overflow: hidden;
  transition: height 360ms cubic-bezier(0.22, 1, 0.36, 1);
}

.faq-answer  {
  max-width: 760px !important;
  padding: 0 22px 20px !important;
  color: rgba(23, 55, 87, 0.7) !important;
  font-size: 17px !important;
  font-weight: 300 !important;
  line-height: 1.7 !important;
}

.faq-answer-note  {
  margin: 16px 0 0 !important;
  color: rgba(23, 55, 87, 0.7) !important;
  font-size: 17px !important;
  line-height: 1.7 !important;
}

.faq-footnote  {
  max-width: 800px !important;
  margin: 16px auto 0 !important;
  color: rgba(23, 55, 87, 0.62) !important;
  font-size: 11px !important;
  line-height: 1.5 !important;
  text-align: center !important;
}

.cta-footnote  {
  margin-left: 0 !important;
  margin-right: 0 !important;
  text-align: left !important;
}

/* ===================== CTA / FIND A PROVIDER ===================== */
.cta-section  {
  padding: 72px 0 !important;
  background: var(--cream) !important;
  scroll-margin-top: 96px !important;
}

.cta-shell  {
  max-width: 1200px !important;
}

.cta-heading  {
  max-width: 560px !important;
  margin: 0 0 28px !important;
  text-align: left !important;
}

.cta-heading h2  {
  margin: 0 !important;
  color: var(--navy) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(30px, 3.1vw, 46px) !important;
  font-weight: 300 !important;
  line-height: 1.06 !important;
  text-transform: uppercase !important;
}

.cta-heading h2 span  {
  color: var(--blue) !important;
  font-weight: 300 !important;
}

.cta-heading p  {
  margin: 14px 0 0 !important;
  color: rgba(23,55,87,0.68) !important;
  font-size: 17px !important;
  font-weight: 300 !important;
  line-height: 1.5 !important;
}

.cta-locator  {
  display: grid !important;
  grid-template-columns: minmax(320px, 0.92fr) minmax(0, 1.08fr) !important;
  gap: 56px !important;
  align-items: stretch !important;
}

.cta-search  {
  padding: 8px 0 !important;
  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
  border-radius: 8px;
}

.cta-heading .cta-handwritten  {
  margin: -2rem 0 40px !important;
  width: fit-content !important;
  max-width: none !important;
  color: var(--blue) !important;
  font-family: "Romantic Couple", "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: clamp(32px, 5.4vw, 48px) !important;
  font-weight: 700 !important;
  line-height: 0.95 !important;
  text-align: left !important;
  transform: rotate(-4deg) !important;
}

.cta-handwritten-comma  {
  margin-left: -0.18em !important;
}

.cta-search-row  {
  display: grid !important;
  grid-template-columns: minmax(0, 1fr) auto !important;
  gap: 12px !important;
}

.cta-search input  {
  min-height: 54px !important;
  padding: 0 16px !important;
  border: 1px solid rgba(0, 0, 0, 0.12) !important;
  border-radius: 4px;
  background: rgba(255, 255, 255, 0.92) !important;
  color: var(--ink) !important;
  font: inherit !important;
}

.cta-search-btn  {
  min-height: 54px !important;
  padding: 0 22px !important;
  outline: none !important;
  border: 0 !important;
  cursor: pointer !important;
}

.cta-map  {
  height: 480px !important;
  align-self: start !important;
  position: sticky !important;
  top: calc(var(--header-height) + 24px) !important;
  overflow: hidden !important;
  border: 1px solid rgba(0, 166, 199, 0.15) !important;
  border-radius: 8px;
  background: var(--cream) !important;
}

/* ---- Doc locator ---- */
#doclocator-map[hidden]  {
  display: none !important;
}

#doclocator-map  {
  width: 100% !important;
  height: 100% !important;
  z-index: 1 !important;
}

#doclocator-results  {
  margin-top: 20px !important;
}

#doclocator-count  {
  margin: 0 0 12px !important;
  color: rgba(23, 55, 87, 0.68) !important;
  font-size: 13px !important;
  line-height: 1.4 !important;
}

#doclocator-list  {
  margin: 0 !important;
  padding: 0 !important;
  list-style: none !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 10px !important;
  max-height: 420px !important;
  overflow-y: auto !important;
}

.doclocator-item  {
  padding: 14px 16px !important;
  border: 1px solid rgba(0, 166, 199, 0.25) !important;
  background: #fff !important;
  cursor: pointer !important;
  transition: box-shadow 0.2s ease, border-color 0.2s ease !important;
}

.doclocator-item:hover  {
  box-shadow: 0 6px 18px rgba(0, 166, 199, 0.16) !important;
  border-color: rgba(0, 166, 199, 0.55) !important;
}

.doclocator-item-title  {
  margin: 0 0 6px !important;
  color: var(--navy) !important;
  font-size: 15px !important;
  font-weight: 700 !important;
  line-height: 1.35 !important;
}

.doclocator-item-address  {
  margin: 0 !important;
  color: rgba(23, 55, 87, 0.68) !important;
  font-size: 13px !important;
  line-height: 1.45 !important;
}

.doclocator-item-distance  {
  display: block !important;
  margin-top: 6px !important;
  color: var(--blue) !important;
  font-size: 12px !important;
  font-weight: 700 !important;
}

.doclocator-item-actions,
.doclocator-popup-actions  {
  display: flex !important;
  flex-wrap: wrap !important;
  gap: 8px !important;
  margin-top: 12px !important;
}

.doclocator-action  {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 7px !important;
  min-height: 34px !important;
  padding: 0 12px !important;
  border: 1px solid rgba(23, 55, 87, 0.2) !important;
  background: #fff !important;
  color: var(--navy) !important;
  font: inherit !important;
  font-size: 12px !important;
  font-weight: 500 !important;
  text-transform: uppercase !important;
  cursor: pointer !important;
}

.doclocator-action-primary  {
  border-color: var(--blue-dark) !important;
  background: var(--blue-dark) !important;
  color: #fff !important;
}

.doclocator-popup  {
  min-width: 220px !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
}

.doclocator-popup-title  {
  margin: 0 0 6px !important;
  color: var(--navy) !important;
  font-size: 14px !important;
  font-weight: 700 !important;
  line-height: 1.35 !important;
}

.doclocator-popup-address  {
  margin: 0 !important;
  color: rgba(23, 55, 87, 0.72) !important;
  font-size: 12px !important;
  line-height: 1.45 !important;
}

.doclocator-popup .doclocator-action  {
  text-decoration: none !important;
}

/* ===================== PRE REFERENCES ===================== */
.pre-references-notes  {
  padding: 32px 0 28px !important;
  background: var(--paper) !important;
}

.pre-references-shell  {
  display: grid !important;
  gap: 10px !important;
}

.pre-references-note  {
  margin: 0 !important;
  color: var(--navy) !important;
  font-size: 12px !important;
  line-height: 1.7 !important;
}

/* ===================== REFERENCES ===================== */
.references-section  {
  padding: 40px 0 !important;
  background: var(--blue-dark) !important;
}

.references-shell h2  {
  margin: 0 0 14px !important;
  color: rgba(255, 255, 255, 0.92) !important;
  font-family: "Aeonik Pro", Arial, Helvetica, sans-serif !important;
  font-size: 18px !important;
  font-weight: 300 !important;
}

.references-list  {
  margin: 0 !important;
  padding-left: 18px !important;
  color: rgba(255, 255, 255, 0.82) !important;
  font-size: 12px !important;
  line-height: 1.7 !important;
}

.references-list li + li  {
  margin-top: 4px !important;
}

.references-inline-note  {
  margin: 0 !important;
  color: rgba(255, 255, 255, 0.82) !important;
  font-size: 12px !important;
  line-height: 1.7 !important;
}

.references-note  {
  margin: 4px 0 0 !important;
  color: rgba(255, 255, 255, 0.82) !important;
  font-size: 12px !important;
  line-height: 1.7 !important;
}

/* ===================== FOOTER ===================== */
.site-footer  {
  background: var(--blue-dark) !important;
  color: rgba(255, 255, 255, 0.76) !important;
}

.footer-shell  {
  padding-top: 20px !important;
  padding-bottom: 40px !important;
}

.footer-legal  {
  display: grid !important;
  gap: 2px !important;
  padding-bottom: 34px !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.footer-legal p  {
  margin: 0 !important;
  color: rgba(255, 255, 255, 0.82) !important;
  font-size: 12px !important;
  line-height: 1.15 !important;
}

.footer-columns  {
  padding: 34px 0 !important;
  display: grid !important;
  grid-template-columns: minmax(220px, 1fr) minmax(220px, 1fr) !important;
  gap: 30px !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.footer-column h3  {
  margin: 0 0 16px !important;
  color: #fff !important;
  font-size: 14px !important;
  font-weight: 700 !important;
  letter-spacing: 0 !important;
  text-transform: uppercase !important;
}

.footer-link-list  {
  margin: 0 !important;
  padding: 0 !important;
  list-style: none !important;
  display: grid !important;
  gap: 10px !important;
}

.footer-link-list li  {
  font-size: 13px !important;
  line-height: 1.65 !important;
}
.footer-link-list a  {
  color: rgba(255, 255, 255, 0.75) !important;
}

.footer-secondary-links  {
  padding-top: 18px !important;
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: wrap !important;
  gap: 32px !important;
}

.footer-secondary-links a  {
  color: rgba(255, 255, 255, 0.75) !important;
  font-size: 13px !important;
  line-height: 1.4 !important;
}

.footer-bottom  {
  padding-top: 26px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  gap: 24px !important;
}

.footer-bottom p  {
  margin: 0 !important;
  max-width: none !important;
  font-size: 13px !important;
  color: rgba(255, 255, 255, 0.55) !important;
  white-space: nowrap !important;
}

.footer-reference  {
  margin: 16px 0 0 !important;
  font-size: 12px !important;
  line-height: 1.5 !important;
  color: rgba(255, 255, 255, 0.5) !important;
}

.footer-brand  {
  line-height: 0 !important;
  white-space: nowrap !important;
}

.footer-brand img  {
  width: 190px !important;
  max-width: 100% !important;
  height: auto !important;
  display: block !important;
  filter: invert(1) !important;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 1120px)  {
  .site-header-inner  {
  padding: 0 24px !important;
  min-height: 62px !important;
  gap: 18px !important;
}
  .site-brand img  {
  width: 156px !important;
}
  .stats-list  {
  grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
}
  .cta-locator  {
  grid-template-columns: 1fr !important;
  gap: 28px !important;
}
  .cta-map  {
  position: static !important;
}
  .definition-content  {
  gap: 36px !important;
}
  .moa-pillars  {
  grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
}
}

@media (max-width: 1024px)  {
  .site-header-inner  {
  min-height: 64px !important;
  padding: 10px 16px !important;
  flex-direction: row !important;
  justify-content: space-between !important;
  gap: 14px !important;
}
  .site-brand img  {
  width: 132px !important;
  flex: 0 0 auto !important;
}

  .site-menu-toggle  {
  display: block !important;
  flex: 0 0 auto !important;
  margin-left: auto !important;
}

  .site-menu  {
  position: absolute !important;
  top: calc(100% + 10px) !important;
  left: 16px !important;
  right: 16px !important;
  min-width: 0 !important;
  padding: 16px !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  gap: 0 !important;
  overflow: hidden !important;
  border: 1px solid rgba(17, 17, 17, 0.08) !important;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.97) !important;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.14) !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
  transform: translateY(-8px) !important;
  transition: opacity 180ms ease, transform 180ms ease, visibility 180ms ease !important;
  backdrop-filter: blur(12px) !important;
}

  .site-header.is-menu-open .site-menu  {
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
  transform: translateY(0) !important;
}

  .site-menu-item  {
  width: 100% !important;
  padding: 14px 0 !important;
  font-size: 14px !important;
  color: var(--navy) !important;
  letter-spacing: 0 !important;
  border-bottom: 1px solid rgba(17, 17, 17, 0.08) !important;
}

  .site-menu-item-highlight  {
  width: 100% !important;
  margin-top: 10px !important;
  padding: 14px 16px !important;
  border-bottom: 0 !important;
  color: #fff !important;
}

  .site-menu-item:last-child  {
  border-bottom: 0 !important;
}
  .site-menu-item.is-active::before,
  .site-menu-item:hover::before  {
  background: var(--blue) !important;
}

  .definition-content  {
  grid-template-columns: 1fr !important;
  gap: 28px !important;
}

  .benefit-block,
  .benefit-block-right  {
  grid-template-columns: 1fr !important;
  gap: 28px !important;
}
  .benefit-block-right .benefit-copy  {
  order: 1 !important;
}
  .benefit-block-right .benefit-visual  {
  order: 2 !important;
}

  .stats-list  {
  grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
  gap: 14px !important;
}

  .moa-steps  {
  flex-direction: column !important;
  align-items: center !important;
}
  .moa-arrow  {
  display: none !important;
}
  .moa-pillars  {
  padding: 30px 24px 24px !important;
  grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
  gap: 28px 22px !important;
}

  .footer-columns  {
  grid-template-columns: 1fr !important;
}

  .section-shell  {
  padding: 0 22px !important;
}
  .definition-section, .benefits-section, .indications-section, .moa-section, .faq-section, .cta-section  {
  padding: 56px 0 !important;
}
}

@media (max-width: 520px)  {
  .site-header-inner  {
  min-height: 58px !important;
  padding: 8px 12px !important;
}
  .site-brand img  {
  width: 124px !important;
}

  .benefits-heading-center  {
  max-width: none !important;
  text-align: center !important;
  margin-bottom: 58px !important;
}

  #benefices .benefits-handwritten  {
  position: static !important;
  display: block !important;
  width: fit-content !important;
  margin: 0 auto 50px !important;
  text-align: center !important;
  white-space: normal !important;
  transform: rotate(-3deg) !important;
}

  .indications-heading .indications-handwritten  {
  display: block !important;
  margin: 0 auto 0 !important;
  text-align: center !important;
  transform: rotate(-3deg) !important;
}

  .cta-heading .cta-handwritten  {
  margin: 0 auto 32px !important;
  text-align: center !important;
  transform: rotate(-3deg) !important;
}

  .benefit-block,
  .benefit-block-right  {
  grid-template-columns: 1fr !important;
  gap: 22px !important;
}

  .benefit-visual,
  .benefit-block-right .benefit-visual  {
  order: 1 !important;
}

  .benefit-copy,
  .benefit-block-right .benefit-copy  {
  order: 2 !important;
}

  .hero-video-controls,
  .benefits-video-controls  {
  display: none !important;
}

  .watch-btn  {
  min-height: 58px !important;
  width: 100% !important;
  padding: 18px 16px !important;
  display: block !important;
  margin: 0 auto !important;
  text-align: center !important;
  line-height: 1.35 !important;
}

  .benefits-watch-btn  {
  width: fit-content !important;
}

  .indications-img-placeholder  {
  width: 100% !important;
  height: auto !important;
  min-height: 0 !important;
  aspect-ratio: 809 / 610 !important;
  border-radius: 12px;
  background-image: url("<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/zone-cible-img-reponsive.webp") !important;
  background-position: center top !important;
  background-size: contain !important;
  background-repeat: no-repeat !important;
}

  .ind-callout  {
  display: none !important;
}

  .stats-list  {
  grid-template-columns: 1fr !important;
}

  .stats-band  {
  background: linear-gradient(180deg, var(--blue-dark) 0%, var(--blue-dark) 46%, var(--blue) 100%) !important;
}

  .benefits-heading-center h2,
  .section-heading h2,
  .definition-copy h2,
  .indications-heading h2,
  .moa-heading h2,
  .faq-heading h2,
  .cta-heading h2  {
  font-size: 30px !important;
  line-height: 1.04 !important;
}

  .moa-callout  {
  grid-template-columns: 1fr !important;
  gap: 18px !important;
  text-align: left !important;
}

  .moa-callout-visual  {
  min-height: 260px !important;
}

  .moa-callout-copy,
  .moa-callout-body  {
  justify-items: center !important;
  text-align: left !important;
}

  .moa-callout-title  {
  font-size: 28px !important;
}

  .moa-callout-body p  {
  text-align: left !important;
}

  .moa-callout-points  {
  grid-template-columns: 1fr !important;
  gap: 12px !important;
  justify-items: start !important;
}

  .moa-callout-points p  {
  width: auto !important;
  margin: 0 !important;
  justify-content: flex-start !important;
  text-align: left !important;
  gap: 8px !important;
}

  .moa-step-media  {
  width: 100% !important;
  max-width: 100% !important;
}

  .moa-pillars  {
  padding: 24px 20px !important;
  grid-template-columns: 1fr !important;
  gap: 24px !important;
}

  .moa-pillar-icon  {
  width: 84px !important;
  height: 84px !important;
  margin-bottom: 16px !important;
}

  .moa-pillar h3,
  .moa-pillar-accent  {
  font-size: 18px !important;
}

  .moa-pillar p:last-child  {
  font-size: 14px !important;
}

  .benefit-img-placeholder  {
  min-height: 260px !important;
}
  .faq-question  {
  font-size: 18px !important;
}
  .faq-answer  {
  font-size: 16px !important;
}

  .cta-search-row  {
  grid-template-columns: 1fr !important;
}
  .cta-search-btn  {
  width: 100% !important;
}
  .cta-map  {
  height: 320px !important;
  position: static !important;
}
  #doclocator-list  {
  max-height: 320px !important;
}

  .footer-shell  {
  padding-top: 40px !important;
  padding-bottom: 28px !important;
}
  .footer-legal p, .footer-link-list li, .footer-bottom p  {
  font-size: 12px !important;
}
  .footer-bottom  {
  flex-direction: column !important;
  align-items: flex-start !important;
}
  .footer-bottom p  {
  white-space: normal !important;
}
  .footer-brand  {
  width: 150px !important;
}

}

  </style>
</head>
<body <?php body_class("radiesse-page"); ?>>
<?php wp_body_open(); ?>
  <header class="site-header" aria-label="Navigation principale">
    <div class="site-header-inner">
      <a class="site-brand" href="#definition" aria-label="RADIESSE">
        <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/logo-Radiesse-navy-300x45.webp" alt="RADIESSE">
      </a>

      <button class="site-menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu" aria-label="Ouvrir le menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav class="site-menu" id="site-menu" aria-label="Menu principal">
        <a class="site-menu-item" href="#definition">DÉCOUVRIR RADIESSE<sup style="font-size: 0.7em; margin-top: 1em;">®</sup></a>
        <a class="site-menu-item" href="#indications">ZONES CIBLÉES</a>
        <a class="site-menu-item" href="#comment-ca-marche">MODE D’ACTION</a>
        <a class="site-menu-item" href="#faq">FAQ</a>
        <a class="site-menu-item site-menu-item-highlight" href="#praticien">TROUVER RADIESSE<sup style="font-size: 0.7em; margin-top: 1em;">®</sup></a>
      </nav>
    </div>
  </header>

  <main>
    <!-- HERO SECTION -->
    <section class="hero" aria-label="Présentation RADIESSE®">

      <!-- Vidéo plein fond (visible à travers le R) -->
      <div class="hero-video-shell" aria-label="Vidéo de présentation RADIESSE®">
        <img class="hero-video-poster" src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_LauraS_01-opt.webp" alt="" aria-hidden="true">
        <video class="hero-video" autoplay muted loop playsinline webkit-playsinline preload="metadata" poster="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_LauraS_01-opt.webp">
          <source src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/video/1920x1080_15sec_branded-website-V4.mp4" type="video/mp4">
        </video>
        <div class="hero-video-controls" aria-label="Contrôles vidéo hero">
          <button class="video-control-btn video-toggle" type="button" aria-label="Mettre en pause"><i class="fa-solid fa-pause" aria-hidden="true"></i></button>
          <label class="video-progress-wrap">
            <span class="sr-only">Progression de la vidéo hero</span>
            <input class="video-progress" type="range" min="0" max="100" value="0" step="0.1">
          </label>
          <span class="video-time" aria-live="off">0:00</span>
          <button class="video-control-btn video-mute" type="button" aria-label="Activer le son"><i class="fa-solid fa-volume-xmark" aria-hidden="true"></i></button>
        </div>
      </div>

      <!-- Panel bleu avec le R en frame (couvre de ~28% à droite) -->
      <div class="hero-panel">
        <div class="hero-panel-inner">
          <div class="hero-panel-content">
            <h1>
              Réveillez votre peau<br>
              en profondeur<sup class="sup-mark" style="font-size: 0.5em; top: -0.08em;">*</sup> avec<br>
              RADIESSE<sup class="sup-reg">®</sup> <sup style="font-size: 0.3em; top: -1em; left: -0.5em;">1-4</sup>
            </h1>
            <p class="hero-description">
              RADIESSE<sup class="sup-reg">®</sup> est un biostimulateur régénérateur<sup class="sup-mark">* 5-6</sup> injectable
              qui stimule la production de collagène et d'élastine pour
              renforcer durablement<sup class="sup-mark">** 7-9</sup> la structure<sup class="sup-mark">* 5</sup> et la qualité de votre peau.<sup>1-3</sup>
            </p>
            <a class="hero-cta" href="#praticien">
              <span class="hero-cta-label">RADIESSE<sup class="sup-reg">®</sup> autour de chez vous</span>
            </a>
            
          </div>
        </div>
      </div>

    </section>

    <!-- DÉFINITION RAPIDE -->
    <section id="definition" class="definition-section" aria-labelledby="definition-title">
      <div class="section-shell definition-content">
        <div class="definition-copy">
          <h2 id="definition-title"><span class="definition-title-script">Chère moi,</span></h2>
          <p class="definition-intro">Prendre soin de toi aujourd'hui, c'est le plus beau des cadeaux que tu puisses t'offrir.</p>
          <p>RADIESSE<sup class="sup-reg">®</sup> agit en harmonie<sup class="sup-mark">***</sup>avec le corps pour restaurer la qualité de la peau de l'intérieur<sup class="sup-mark">*1-4</sup> au fil du temps.<sup class="sup-mark">**1-3,10</sup></p>
          <p class="definition-callout"><strong>Comment ?</strong> RADIESSE<sup class="sup-reg">®</sup> stimule la production naturelle de collagène et d'élastine, ainsi que d'autres composants clés de la peau.<sup class="sup-mark">*</sup></p>
          <a class="watch-btn" href="#praticien">En savoir plus</a>
        </div>
        <figure class="definition-visual">
          <img class="definition-media" src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Radiesse_Group_01.webp" alt="Femmes souriantes en groupe, visuel RADIESSE®">
        </figure>
      </div>
    </section>

    <!-- BÉNÉFICES -->
    <section id="benefices" class="benefits-section" aria-labelledby="benefits-title">
        <div class="section-shell">
        <div class="section-heading benefits-heading-center">
                    <p class="benefits-handwritten">Laisse ta <span class="benefits-handwritten-accent">confiance</span> rayonner<span style="margin-left: -.7rem;">.</span></p>
          <h2 id="benefits-title">Raffermit. <span>Lisse.</span> Réveille.</h2>
        </div>

        <!-- Bénéfice 1 : Raffermit -->
        <article class="benefit-block benefit-block-left" aria-labelledby="benefit-1-title">
          <figure class="benefit-visual">
            <div class="benefit-img-placeholder benefit-img-1" aria-label="Résultat Raffermit RADIESSE®"></div>
          </figure>
          <div class="benefit-copy">
            <h3 id="benefit-1-title">Raffermit</h3>
            <p>RADIESSE<sup class="sup-reg">®</sup> améliore la fermeté, l'élasticité et l'hydratation de votre peau.<sup>5</sup></p>
            <ul class="benefit-stats">
              <li><strong>+31,8%</strong><span>de collagène à 3 mois.<sup>17</sup></span></li>
            </ul>
            <p class="benefit-footnote benefit-footnote-inline">(95% IC; 14,6-49,0; P=0,001)</p>
            <p class="benefit-footnote">Mesuré histologiquement sur prélèvements abdominaux à 3 mois après traitement par CaHA diluée (1:1) vs sérum physiologique (contrôle). D'après les données de Goldie et al., 2025.<sup>17</sup></p>
            <p class="benefit-footnote">Les données issues de cette étude histologique ne sont pas strictement extrapolables à l'efficacité clinique.</p>
          </div>
        </article>

        <!-- Bénéfice 2 : Lisse -->
        <article class="benefit-block benefit-block-right" aria-labelledby="benefit-2-title">
          <div class="benefit-copy">
            <h3 id="benefit-2-title">Lisse</h3>
            <p>Des résultats visiblement plus lisses et plus fermes,<sup>1-3</sup> pour un résultat d'apparence naturel et durable.</p>
            <ul class="benefit-stats">
              <li><strong>12 mois</strong><span>de résultats visibles ou plus.<sup>7-10</sup></span></li>
            </ul>
            <p class="benefit-footnote">L'effet du traitement esthétique peut durer jusqu'à 12 mois ou plus pour la majorité des indications des produits de la gamme Radiesse<sup class="sup-reg">®</sup>, avec une durée d'effet de 6 à 7 mois ou plus pour les indications de traitement des sillons nasogéniens et des plis d'amertume du produit Radiesse<sup class="sup-reg">®</sup> + Lidocaine.</p>
          </div>
          <figure class="benefit-visual">
            <div class="benefit-img-placeholder benefit-img-2" aria-label="Résultat Lisse RADIESSE®"></div>
          </figure>
        </article>

        <!-- Bénéfice 3 : Réveille -->
        <article class="benefit-block benefit-block-left" aria-labelledby="benefit-3-title">
          <figure class="benefit-visual">
            <div class="benefit-img-placeholder benefit-img-3" aria-label="Résultat Réveille RADIESSE®"></div>
          </figure>
          <div class="benefit-copy">
            <h3 id="benefit-3-title">Réveille <span class="benefit-subtitle">la jeunesse de la peau</span></h3>
            <p>Pour une peau d’apparence plus jeune<sup>1-3,12</sup> et une meilleure qualité de peau<sup>1-3</sup> permettant de révéler sa beauté à tout âge.<sup>†</sup></p>
            <ul class="benefit-stats">
              <li><strong>98%</strong><span>des patients sont satisfaits des résultats après 4 mois.<sup style="font-size: 10.8px">13</sup></span></li>
            </ul>
            <p class="benefit-footnote">Questionnaire de satisfaction de 120 patients (étude clinique multicentrique Moers et al., 2007).</p>
          </div>
        </article>
      </div>

      <div class="benefits-cta-block">
        <a class="watch-btn benefits-watch-btn" href="#praticien">LOCALISER UN CENTRE RADIESSE<sup class="sup-reg">®</sup></a>
      </div>
    </section>

    <!-- CHIFFRES MARQUE -->
    <section class="stats-band" aria-labelledby="stats-title">
      <div class="stats-inner">
        <div class="stats-list">
          <article class="stat-item"><strong>+22 ans</strong><span>d'expertise scientifique et clinique</span></article>
          <article class="stat-item"><strong>+220</strong><span>publications scientifiques depuis 2005<sup>14</sup></span></article>
          <article class="stat-item"><strong>+85</strong><span>pays dans le monde<sup>14</sup></span></article>
          <article class="stat-item"><strong>98%</strong><span>de satisfaction patient<sup>13</sup><small>Étude menée sur 120 patients</small></span></article>
          <article class="stat-item"><strong>+20M</strong><span>de seringues vendues<sup>14</sup></span></article>
        </div>
      </div>
    </section>

    <!-- INDICATIONS -->
    <section id="indications" class="indications-section" aria-labelledby="indications-title">
      <div class="section-shell">
        <div class="section-heading indications-heading">
          <p class="indications-handwritten">Tu me remercieras plus tard<span style="margin-left: -.15em;">.</span></p>
          <h2 id="indications-title">Zones <span>ciblées</span></h2>
          <p>RADIESSE<sup class="sup-reg">®</sup> traite plusieurs zones : visage, mains et décolleté, pour une peau plus ferme, plus lisse et plus éclatante.<sup>1-3</sup></p>
        </div>

        <figure class="indications-indicator">
          <div class="indications-indicator-media">
            <div class="indications-img-placeholder" aria-label="Indications RADIESSE® sur le visage et le corps"></div>

            <div class="ind-callout ind-callout-skin-quality" aria-hidden="true">
              <span class="ind-skin-frame">
                <span class="ind-skin-frame-corner ind-skin-frame-corner-tl"></span>
                <span class="ind-skin-frame-corner ind-skin-frame-corner-bl"></span>
              </span>
              <span class="ind-callout-text">Qualité de peau<br><small>Améliore l’éclat</small></span>
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-plus"></span>
                <span class="ind-callout-dot ind-dot-std"></span>
              </span>
            </div>

            <div class="ind-callout ind-callout-cheeks" aria-hidden="true">
              <span class="ind-callout-text">Joues<br><small>Restaure le volume</small></span>
              <span class="ind-callout-line"></span>
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-plus"></span>
                <span class="ind-callout-dot ind-dot-std"></span>
              </span>
            </div>

            <div class="ind-callout ind-callout-nasolabial" aria-hidden="true">
              <span class="ind-callout-text">Sillons nasogéniens<br><small>Restaure le volume</small></span>
              <span class="ind-callout-line"></span>
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-plus"></span>
                <span class="ind-callout-dot ind-dot-std"></span>
              </span>
            </div>

            <div class="ind-callout ind-callout-jawline" aria-hidden="true">
              <span class="ind-callout-text">Ovale &amp; bajoues<br><small>Définit et lifte</small></span>
              <span class="ind-callout-line"></span>
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-plus"></span>
              </span>
            </div>

            <div class="ind-callout ind-callout-decollete" aria-hidden="true">
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-diluted"></span>
              </span>
              <span class="ind-callout-line"></span>
              <span class="ind-callout-text">Décolleté<br><small>Lisse les rides et ridules</small></span>
            </div>

            <div class="ind-callout ind-callout-hands" aria-hidden="true">
              <span class="ind-callout-text">Mains<br><small>Restaure fermeté et volume perdus</small></span>
              <span class="ind-callout-line"></span>
              <span class="ind-callout-dots">
                <span class="ind-callout-dot ind-dot-plus"></span>
                <span class="ind-callout-dot ind-dot-std"></span>
              </span>
            </div>
          </div>
          <figcaption class="indications-legend" aria-label="Légende traitements RADIESSE">
            <span class="legend-item"><span class="legend-dot legend-dot-plus"></span>RADIESSE<sup class="sup-reg">®</sup> (+)</span>
            <span class="legend-item"><span class="legend-dot legend-dot-std"></span>RADIESSE<sup class="sup-reg">®</sup></span>
            <span class="legend-item"><span class="legend-dot legend-dot-diluted"></span>RADIESSE<sup class="sup-reg">®</sup> 1:2 dilution</span>
          </figcaption>
        </figure>
        <div class="indications-cta-block">
          <a class="watch-btn indications-watch-btn" href="#praticien">TROUVER UN CENTRE RADIESSE<sup class="sup-reg">®</sup></a>
        </div>
      </div>
    </section>

    <!-- MOA — COMMENT ÇA FONCTIONNE -->
    <section id="comment-ca-marche" class="moa-section" aria-labelledby="moa-title">
      <div class="section-shell moa-content">
        <div class="section-heading moa-heading">
          <h2 id="moa-title">Comment agit <span>RADIESSE<sup class="sup-reg">®</sup> ?</span></h2>
          <p>Avec le temps, votre peau produit moins de <strong>collagène</strong> et d’<strong>élastine</strong>,<sup>15</sup> <br> responsables de la <strong>fermeté de la peau</strong>.</p>
          <div class="moa-callout">
            <div class="moa-callout-copy">
              <div class="moa-callout-title">
                <span class="moa-callout-kicker">Qu’est-ce qu’un</span>
                <strong>biostimulateur régénérateur&nbsp;?</strong>
              </div>
              <div class="moa-callout-body">
                <p>Un biostimulateur régénérateur injectable est un traitement esthétique qui aide à stimuler votre peau pour qu'elle se régénère elle-même.<sup class="sup-mark">*</sup></p>
                <p class="moa-callout-note">* Les résultats individuels peuvent varier. Les indications dépendent du produit utilisé.</p>
                <div class="moa-callout-points">
                </div>
              </div>
            </div>
            <figure class="moa-callout-visual">
              <img class="moa-callout-image" src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/radiesse-img-product.webp" alt="Produit RADIESSE®">
            </figure>
          </div>
          <p><strong>RADIESSE<sup class="sup-reg">®</sup> agit en 3 étapes pour améliorer la qualité de votre peau en profondeur.<sup>1-4</sup></strong></p>
        </div>

        <div class="moa-steps">
          <article class="moa-step">
            <div class="moa-step-number" aria-hidden="true">1</div>
            <figure class="moa-step-media">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Etape%20injections%201.webp" alt="Étape 1 : injection de RADIESSE sous la peau">
            </figure>
            <p>L'implant injectable RADIESSE<sup class="sup-reg">®</sup> est injecté sous la peau.</p>
          </article>
          <div class="moa-arrow" aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></div>
          <article class="moa-step">
            <div class="moa-step-number" aria-hidden="true">2</div>
            <figure class="moa-step-media">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Etape%20injections%202.webp" alt="Étape 2 : stimulation de la production de collagène et d’élastine">
            </figure>
            <p>Il vient stimuler la production d'élastine et de collagène.<sup>1–3</sup></p>
          </article>
          <div class="moa-arrow" aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></div>
          <article class="moa-step">
            <div class="moa-step-number" aria-hidden="true">3</div>
            <figure class="moa-step-media">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/Etape%20injections%203.webp" alt="Étape 3 : amélioration de la structure de la peau">
            </figure>
            <p>Il aide à améliorer la structure<sup class="sup-mark">*</sup> de la peau.</p>
          </article>
        </div>

        <div class="moa-pillars" aria-label="Bénéfices biologiques RADIESSE®">
          <article class="moa-pillar">
            <div class="moa-pillar-icon" aria-hidden="true">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/icon-STRUCTURE-150x150.webp" alt="">
            </div>
            <h3>STRUCTURE</h3>
            <p class="moa-pillar-accent">Collagène de type I</p>
            <p>Le renouvellement du collagène de type I contribue à renforcer la peau et à améliorer sa résistance.<sup>5,11</sup></p>
          </article>

          <article class="moa-pillar">
            <div class="moa-pillar-icon" aria-hidden="true">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/icon-SUPPORT.webp" alt="">
            </div>
            <h3>SOUTIEN</h3>
            <p class="moa-pillar-accent">Collagène de type III</p>
            <p>Soutient l’amélioration de la qualité de la peau et joue un rôle clé dans la stabilisation du collagène de type I.<sup>16</sup></p>
          </article>

          <article class="moa-pillar">
            <div class="moa-pillar-icon" aria-hidden="true">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/icon-ELASTICITY-150x150.webp" alt="">
            </div>
            <h3>ÉLASTICITÉ</h3>
            <p class="moa-pillar-accent">Élastine</p>
            <p>Aide la peau à retrouver son élasticité naturelle, sa souplesse et son effet rebondi.<sup>6</sup></p>
          </article>

          <article class="moa-pillar">
            <div class="moa-pillar-icon" aria-hidden="true">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/icon-GLOW-150x150.webp" alt="">
            </div>
            <h3>ÉCLAT</h3>
            <p class="moa-pillar-accent">Protéoglycanes</p>
            <p>Aident la peau à retenir l’hydratation et à préserver un aspect repulpé et lumineux.<sup>16</sup></p>
          </article>

          <article class="moa-pillar">
            <div class="moa-pillar-icon" aria-hidden="true">
              <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/icon-NOURISH-150x150.webp" alt="">
            </div>
            <h3>NUTRITION</h3>
            <p class="moa-pillar-accent">Angiogenèse</p>
            <p>Favorise la création de nouveaux vaisseaux sanguins pour nourrir les tissus cutanés en oxygène et en nutriments, et soutenir la santé de la peau.<sup>5</sup></p>
          </article>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="faq-section" aria-labelledby="faq-title">
      <div class="section-shell faq-shell">
        <div class="section-heading faq-heading">
          <h2 id="faq-title">Les réponses à <span>vos questions</span></h2>
          <p>Vous vous posez des questions sur RADIESSE<sup class="sup-reg">®</sup> ? Découvrez ici toutes les informations essentielles pour mieux comprendre le traitement.</p>
        </div>

        <div class="faq-list">
          <article class="faq-item is-open">
            <button class="faq-trigger" type="button" aria-expanded="true"><span class="faq-question">En quoi consiste le traitement ?</span><span class="faq-toggle" aria-hidden="true"></span></button>
            <div class="faq-panel"><div class="faq-answer">RADIESSE<sup class="sup-reg">®</sup> est injecté sous la peau. La quantité de RADIESSE<sup class="sup-reg">®</sup> injectée déterminera la durée du traitement, mais en général, le traitement dure environ 30 minutes.</div></div>
          </article>
          <article class="faq-item">
            <button class="faq-trigger" type="button" aria-expanded="false"><span class="faq-question">Dans combien de temps verrai-je les effets de mon traitement RADIESSE<sup class="sup-reg">®</sup> ?</span><span class="faq-toggle" aria-hidden="true"></span></button>
            <div class="faq-panel"><div class="faq-answer">En fonction du traitement, l’effet sera visible immédiatement après l’injection en raison des effets remodelants et de restauration des volumes. De plus, en stimulant la production naturelle de collagène de votre organisme, l’amélioration de la qualité de la peau avec RADIESSE<sup class="sup-reg">®</sup> continuera à se renforcer avec le temps.<sup class="sup-mark">**11,14</sup></div></div>
          </article>
          <article class="faq-item">
            <button class="faq-trigger" type="button" aria-expanded="false"><span class="faq-question">Combien de temps les résultats de RADIESSE<sup class="sup-reg">®</sup> durent-ils ? <sup>1–3</sup></span><span class="faq-toggle" aria-hidden="true"></span></button>
            <div class="faq-panel"><div class="faq-answer">La durée des résultats dépend de l’âge, du type de peau, du mode de vie, du métabolisme et, bien sûr, de la zone traitée. En règle générale, les résultats de RADIESSE<sup class="sup-reg">®</sup> sont particulièrement durables et peuvent persister jusqu’à 12 mois.<sup class="sup-mark">**</sup> Chez certaines personnes, les résultats ont duré encore plus longtemps, de 18 mois à 2 ans.<sup>12,14</sup></div></div>
          </article>
          <article class="faq-item">
            <button class="faq-trigger" type="button" aria-expanded="false"><span class="faq-question">Y a-t-il des effets indésirables ? <sup>1–3</sup></span><span class="faq-toggle" aria-hidden="true"></span></button>
            <div class="faq-panel"><div class="faq-answer">Comme tout produit, RADIESSE<sup class="sup-reg">®</sup> est susceptible d’entraîner des réactions non souhaitées, notamment au site d’injection. Les effets indésirables graves les plus fréquemment rapportés sont les suivants : nécrose, œdème, réaction allergique et infection.<br><br>Informez dans les meilleurs délais votre médecin si vous présentez l’un de ces effets ou tout autre effet indésirable. Vous pouvez également informer de tout effet indésirable MERZ AESTHETICS France : vigilances.ax@merz.com ou signalement.social-sante.gouv.fr<br><br>Pour des informations plus exhaustives concernant les différentes thématiques ci-dessus et notamment les contre-indications et les effets indésirables, se référer à la notice patient du dispositif concerné.<sup>1-3</sup><br><br>Demandez conseil à votre médecin.<p class="faq-answer-note">Réservé aux adultes (18 ans+) et ne doit pas être utilisé chez la femme enceinte ou allaitante.</p></div></div>
          </article>
        </div>
      </div>
    </section>

    <!-- FIND A PROVIDER -->
    <section id="praticien" class="cta-section" aria-labelledby="cta-title">
      <div class="section-shell cta-shell">
        <div class="cta-locator">
          <div class="cta-search">
            <div class="section-heading cta-heading">
              <p class="cta-handwritten">Avec amour<span class="cta-handwritten-comma">,</span> ton futur toi.</p>
              <h2 id="cta-title">Trouvez RADIESSE<sup class="sup-reg">®</sup><br><span>autour de chez vous</span></h2>
              <p>Localisez facilement un cabinet/une clinique  près de chez vous.</p>
              <p>Saisissez votre code postal dès maintenant pour localiser les centres<sup class="sup-mark">*</sup> en toute simplicité !</p>
            </div>
            <div class="cta-search-row">
              <input id="doc-search" type="text" placeholder="Code postal ou ville">
              <button class="watch-btn cta-search-btn" type="button">Rechercher</button>
            </div>
            <p class="faq-footnote cta-footnote">*Centre utilisateur régulier de RADIESSE®.<sup>14</sup></p>
            <div id="doclocator-results" hidden>
              <p id="doclocator-count"></p>
              <ul id="doclocator-list"></ul>
            </div>
          </div>

          <div class="cta-map">
            <div id="doclocator-map" hidden aria-label="Carte des centres RADIESSE® les plus proches"></div>
          </div>
        </div>
      </div>
    </section>

    <section class="pre-references-notes" aria-label="Mentions et renvois">
      <div class="section-shell pre-references-shell">
        <p class="pre-references-note">
          *Favorise la production de collagène de type I, de type III, d'élastine, de protéoglycanes ainsi que l'angiogenèse.
        </p>
        <p class="pre-references-note">
          **L'effet du traitement esthétique peut durer jusqu'à 12 mois ou plus pour la majorité des indications des produits de la gamme Radiesse<sup class="sup-reg">®</sup>, avec une durée d'effet de 6 à 7 mois ou plus pour les indications de traitement des sillons nasogéniens et des plis d'amertume du produit Radiesse<sup class="sup-reg">®</sup> + Lidocaine.
        </p>
        <p class="pre-references-note">
          ***Les microsphères d'hydroxylapatite de calcium contenues dans l'implant Radiesse<sup class="sup-reg">®</sup> contribuent à stimuler la production endogène de collagène et d'élastine.
        </p>
        <p class="pre-references-note">
          †Chez les patients de 18 ans et plus.
        </p>
      </div>
    </section>

    <!-- RÉFÉRENCES -->
    <section class="references-section" aria-labelledby="references-title">
      <div class="section-shell references-shell">
        <h2 id="references-title">Références</h2>
        <ol class="references-list">
          <li>Notice patient Radiesse® 1,5 ml</li>
          <li>Notice Patient Radiesse® 3.0 ml</li>
          <li>Notice Patient Radiesse®+ Lidocaïne</li>
          <li>Fisher GJ, Varani J, Voorhees JJ. Looking older: fibroblast collapse and therapeutic implications. Arch Dermatol. 2008 May;144(5):666–672</li>
          <li>
            Yutskovskaya YA, Kogan EA. Improved neocollagenesis and skin mechanical properties after injection of diluted calcium hydroxylapatite in the neck and décolletage: a pilot study. J Drugs Dermatol. 2017;16(1):68–74.
            <p class="references-inline-note">Etude pilote histologique ayant porté sur 20 sujets.</p>
          </li>
          <li>Implant injectable Radiesse® - Résumé des caractéristiques de sécurité et des performances cliniques Partie 1 - Destinée aux professionnels de la santé.</li>
          <li>Notice Radiesse® 1,5 ml</li>
          <li>Notice Radiesse® 3.0 ml</li>
          <li>Notice Radiesse® + Lidocaine</li>
          <li>Van Loghem J.V. and al. Calcium hydroxylapatite: Over a Decade of clinical experience. J Clin Aesthet Dermatol. 2015;8(1):38.</li>
          <li>Yutskovskaya M.D. and al. A Randomized, split-face, histomorphologic study comparing a volumetric calcium hydroxylapatite and a hyaluronic acid-based dermal filler. Journal of Drugs in Dermatology. 2014;13(9):1047-1052.</li>
          <li>Muti G.F. Open-Label, Post-Marketing Study to Evaluate the Performance and Safety of Calcium Hydroxylapatite With Integral Lidocaine to Correct Facial Volume Loss. J Drugs Dermatol. 2019;18(1):86-91.</li>
          <li>Moers-Carpi M. and al. Dermatol Surg. 2007;33(Suppl 2):S144–S151.</li>
          <li>
            Données internes Merz Aesthetics 2025.
            <p class="references-inline-note">+220 publications scientifiques depuis 2005 : ne préjuge pas de la bonne qualité méthodologique des études.</p>
          </li>
          <li>
            Bass L.S. and al. Calcium Hydroxylapatite (Radiesse) for Treatment of Nasolabial Folds: Long-Term Safety and Efficacy. Aesthetic Surgery Journal. 2010;30:235.
          </li>
          <li>Nowag B, et al. CaHA microspheres: contact with fibroblasts and amount of spheres are key factors for collagen stimulation.</li>
          <li>Goldie K, Casabona G, Corduff N, McCarthy AD, Riegel K. Regeneration of an extracellular matrix ecosystem following subcutaneous injection with different Radiesse dilutions: a histologic and ultrasound study. J Cosmet Dermatol. 2026;25:e70930.</li>
        </ol>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="section-shell footer-shell">
      <div class="footer-legal">
        <p>L’implant injectable RADIESSE<sup class="sup-reg">®</sup> et RADIESSE<sup class="sup-reg">®</sup> (+) Lidocaïne est un dispositif destiné uniquement à des fins non médicales. Il est destiné à l’augmentation du volume des tissus mous dermiques profonds et sous-dermiques.</p>
        <p>Les implants injectables RADIESSE<sup class="sup-reg">®</sup> (1,5ml) et RADIESSE<sup class="sup-reg">®</sup>(3ml) sont indiqués chez l‘adulte pour :</p>
        <p>Le traitement des sillons nasogéniens ;</p>
        <p>L’augmentation du volume des joues ;</p>
        <p>Le traitement des mains pour corriger la perte de volume dans le dos de la main ;</p>
        <p>La restauration et/ou la correction des signes de perte de masse graisseuse au niveau du visage (lipoatrophie) chez les personnes atteintes du virus de l’immunodéficience humaine ;</p>
        <p>L’implant injectable RADIESSE<sup class="sup-reg">®</sup> (1,5 ml) dilué à 1:2 avec de la solution saline à 0,9 % pour injection est destiné au traitement des rides modérées à sévères du décolleté.</p>
        <p>L’implant injectable RADIESSE<sup class="sup-reg">®</sup>(+) Lidocaïne est indiqué chez l‘adulte pour :</p>
        <p>Le traitement des sillons nasogéniens ;</p>
        <p>L’augmentation du volume des joues ;</p>
        <p>Le traitement des plis d’amertume ;</p>
        <p>Le traitement du contour de la mâchoire ;</p>
        <p>Le traitement des mains pour corriger la perte de volume dans le dos de la main.</p>
        <p>Dispositif de classe III – Organisme notifié TÜV CE0123. Produit non pris en charge par les organismes d’assurance maladie.</p>
        <p>Lire attentivement la notice patient du produit. Le traitement par produit de comblement peut nécessiter plusieurs retouches dans le temps pour atteindre la correction souhaitée. Il doit être administré uniquement par des professionnels de santé correctement formés. Publication à destination des patients. Veuillez contacter votre médecin si vous avez des questions ou si vous ressentez un quelconque effet indésirable. Les résultats individuels peuvent varier, veuillez demander conseil à votre médecin expert en esthétique.</p>
        <p>Mandataire : Merz Aesthetics GmbH - Eckenheimer Landstraße 100 - 60318 Frankfurt am Main Germany. Fabricant : Merz North America, Inc. - 4133 Courtney Street Suite 10 Franksville, Wisconsin 53126 USA. Distributeur : Merz Aesthetics France - 2 avenue Gambetta - 92400 Courbevoie, Tél : (+33) 1 89 31 23 50. Pour toute question sur RADIESSE<sup class="sup-reg">®</sup> : infomed.ax@merz.com</p>
        <p>Pour toute déclaration d’effets indésirables : vigilances.ax@merz.com ou https://signalement.socialsante.gouv.fr</p>
        <p>© 2026 Merz Aesthetics France. Tous droits réservés. MERZ AESTHETICS est une marque de commerce et une marque déposée de Merz Pharma GmbH &amp; Co. KGaA.</p>
      </div>

      <div class="footer-secondary-links" aria-label="Liens légaux">
        <a href="https://merzaesthetics.fr/politique-de-confidentialite/" target="_blank" rel="noopener noreferrer">Politique de confidentialité</a>
        <a href="https://merzaesthetics.fr/mentions-legales/" target="_blank" rel="noopener noreferrer">Mentions légales</a>
        <a href="https://merzaesthetics.fr/conditions-generales-dutilisation/" target="_blank" rel="noopener noreferrer">Conditions générales d’utilisation</a>
        <a href="https://merzaesthetics.fr/politique-de-gestion-des-cookies/" target="_blank" rel="noopener noreferrer">Politique de gestion des cookies</a>
      </div>

      <div class="footer-bottom">
        <div class="footer-brand">
          <img src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/img/logo-merz-aesthetics.webp" alt="Merz Aesthetics Logo">
        </div>
        <p>Copyright © 2026 Merz Aesthetics France. Tous droits réservés.</p>
      </div>
      <p class="footer-reference">PUB-RAD-2026056_ Juillet 2026<br>26/07/MerzAesthe/GP/001</p>
    </div>
  </footer>

  <script src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/vendor/gsap.min.js"></script>
  <script src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/vendor/ScrollTrigger.min.js"></script>
  <script src="<?php echo esc_url(RADIESSE_LANDING_URL); ?>assets/vendor/leaflet/leaflet.min.js"></script>
  <script>
const siteHeader = document.querySelector(".site-header");
const siteMenuLinks = Array.from(document.querySelectorAll(".site-menu-item"));
const siteMenuToggle = document.querySelector(".site-menu-toggle");

document.querySelectorAll("sup").forEach((sup) => {
  if (sup.textContent.trim() === "®") {
    sup.classList.add("sup-mark");
  }
});

/* ---- Mobile menu ---- */
if (siteHeader && siteMenuToggle) {
  const syncMenuState = (isOpen) => {
    siteHeader.classList.toggle("is-menu-open", isOpen);
    siteMenuToggle.setAttribute("aria-expanded", String(isOpen));
  };

  siteMenuToggle.addEventListener("click", () => {
    syncMenuState(!siteHeader.classList.contains("is-menu-open"));
  });

  siteMenuLinks.forEach((link) => {
    link.addEventListener("click", () => syncMenuState(false));
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > 820) syncMenuState(false);
  });
}

/* ---- Sticky header ---- */
if (siteHeader) {
  const syncHeaderMetrics = () => {
    document.documentElement.style.setProperty("--header-height", `${siteHeader.offsetHeight}px`);
  };

  const syncHeaderState = () => {
    const isScrolled = window.scrollY > 12;
    siteHeader.classList.toggle("is-scrolled", isScrolled);
    document.body.classList.toggle("header-is-fixed", isScrolled);
    syncHeaderMetrics();
  };

  syncHeaderMetrics();
  syncHeaderState();
  window.addEventListener("scroll", syncHeaderState, { passive: true });
  window.addEventListener("resize", syncHeaderState);
}

/* ---- Active nav link on scroll ---- */
if (siteMenuLinks.length) {
  const menuTargets = siteMenuLinks
    .map((link) => {
      const href = link.getAttribute("href");
      if (!href || !href.startsWith("#")) return null;
      const target = document.querySelector(href);
      if (!target) return null;
      return { link, target };
    })
    .filter(Boolean);

  const setActiveMenuLink = (activeLink) => {
    siteMenuLinks.forEach((link) => link.classList.toggle("is-active", link === activeLink));
  };

  const syncActiveMenuLink = () => {
    const headerOffset = siteHeader?.offsetHeight || 0;
    const triggerY = window.scrollY + headerOffset + 120;
    let activeItem = menuTargets[0] || null;

    menuTargets.forEach((item) => {
      if (item.target.offsetTop <= triggerY) activeItem = item;
    });

    if (activeItem) setActiveMenuLink(activeItem.link);
  };

  siteMenuLinks.forEach((link) => {
    link.addEventListener("click", () => setActiveMenuLink(link));
  });

  window.addEventListener("scroll", syncActiveMenuLink, { passive: true });
  window.addEventListener("load", syncActiveMenuLink);
  syncActiveMenuLink();
}

/* ---- Video players ---- */
const moaSection = document.querySelector(".moa-section");

const setupCustomVideoPlayer = (container, video, options = {}) => {
  if (!container || !video) return null;

  const toggleButton = container.querySelector(".video-toggle");
  const muteButton = container.querySelector(".video-mute");
  const progress = container.querySelector(".video-progress");
  const time = container.querySelector(".video-time");
  const toggleIcon = toggleButton?.querySelector("i");
  const muteIcon = muteButton?.querySelector("i");
  let controlsTimer;

  video.removeAttribute("controls");

  const showControlsBriefly = () => {
    container.classList.add("is-controls-visible");
    window.clearTimeout(controlsTimer);
    controlsTimer = window.setTimeout(() => {
      container.classList.remove("is-controls-visible");
    }, options.controlsTimeout ?? 1600);
  };

  const formatVideoTime = (seconds) => {
    if (!Number.isFinite(seconds)) return "0:00";
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60).toString().padStart(2, "0");
    return `${minutes}:${secs}`;
  };

  const updatePlayState = () => {
    const isPaused = video.paused;
    if (options.pausedClass) container.classList.toggle(options.pausedClass, isPaused);
    toggleButton?.setAttribute("aria-label", isPaused ? "Lire la vidéo" : "Mettre en pause");
    toggleIcon?.classList.toggle("fa-play", isPaused);
    toggleIcon?.classList.toggle("fa-pause", !isPaused);
  };

  const updateMuteState = () => {
    const isMuted = video.muted;
    muteButton?.setAttribute("aria-label", isMuted ? "Activer le son" : "Couper le son");
    muteIcon?.classList.toggle("fa-volume-xmark", isMuted);
    muteIcon?.classList.toggle("fa-volume-high", !isMuted);
  };

  const updateProgress = () => {
    const duration = video.duration || 0;
    const percent = duration ? (video.currentTime / duration) * 100 : 0;
    if (progress) {
      progress.value = String(percent);
      progress.style.setProperty("--progress", `${percent}%`);
    }
    if (time) time.textContent = formatVideoTime(video.currentTime);
  };

  toggleButton?.addEventListener("click", () => {
    if (video.paused) video.play().catch(() => {});
    else video.pause();
  });

  muteButton?.addEventListener("click", () => {
    video.muted = !video.muted;
    updateMuteState();
  });

  video.addEventListener("click", () => {
    showControlsBriefly();
    if (video.paused) video.play().catch(() => {});
    else video.pause();
  });

  progress?.addEventListener("input", () => {
    const duration = video.duration || 0;
    if (duration) video.currentTime = (Number(progress.value) / 100) * duration;
  });

  container.addEventListener("mousemove", showControlsBriefly);
  container.addEventListener("touchstart", showControlsBriefly, { passive: true });
  video.addEventListener("play", updatePlayState);
  video.addEventListener("pause", updatePlayState);
  video.addEventListener("timeupdate", updateProgress);
  video.addEventListener("loadedmetadata", updateProgress);
  video.addEventListener("volumechange", updateMuteState);

  if (options.startMuted) video.muted = true;

  updatePlayState();
  updateMuteState();
  updateProgress();

  return { showControlsBriefly };
};

const benefitsVideoBlock = document.querySelector(".benefits-video-block");
const benefitsVideo = document.querySelector(".benefits-video");

if (benefitsVideoBlock && benefitsVideo) {
  setupCustomVideoPlayer(benefitsVideoBlock, benefitsVideo, {
    pausedClass: "is-video-paused",
    controlsTimeout: 1600,
  });

  if (moaSection && "IntersectionObserver" in window) {
    const videoObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          benefitsVideo.muted = true;
          benefitsVideo.play().catch(() => {});
        } else {
          benefitsVideo.pause();
        }
      });
    }, { threshold: 0.48 });
    videoObserver.observe(moaSection);
  }
}

const heroVideoShell = document.querySelector(".hero-video-shell");
const heroVideo = document.querySelector(".hero-video");

if (heroVideoShell && heroVideo) {
  setupCustomVideoPlayer(heroVideoShell, heroVideo, {
    controlsTimeout: 1200,
    startMuted: true,
  });

  heroVideo.defaultMuted = true;
  heroVideo.muted = true;

  const tryPlayHeroVideo = () => {
    heroVideo.play()
      .then(() => {
        heroVideoShell.classList.add("is-video-ready");
      })
      .catch(() => {
        heroVideoShell.classList.remove("is-video-ready");
      });
  };

  heroVideo.addEventListener("loadeddata", () => {
    heroVideoShell.classList.add("is-video-ready");
    tryPlayHeroVideo();
  });

  heroVideo.addEventListener("canplay", tryPlayHeroVideo);
  heroVideo.addEventListener("playing", () => {
    heroVideoShell.classList.add("is-video-ready");
  });
  heroVideo.addEventListener("error", () => {
    heroVideoShell.classList.remove("is-video-ready");
  });

  window.addEventListener("load", tryPlayHeroVideo, { once: true });
}

/* ---- FAQ accordion ---- */
const faqItems = document.querySelectorAll(".faq-item");

const setFaqPanelHeight = (item, isOpen) => {
  const panel = item.querySelector(".faq-panel");
  if (!panel) return;
  panel.style.height = isOpen ? `${panel.scrollHeight}px` : "0px";
};

faqItems.forEach((item) => {
  const trigger = item.querySelector(".faq-trigger");
  if (!trigger) return;

  setFaqPanelHeight(item, item.classList.contains("is-open"));

  trigger.addEventListener("click", () => {
    const shouldOpen = !item.classList.contains("is-open");

    item.classList.toggle("is-open", shouldOpen);
    trigger.setAttribute("aria-expanded", String(shouldOpen));
    setFaqPanelHeight(item, shouldOpen);
  });
});

window.addEventListener("resize", () => {
  faqItems.forEach((item) => {
    if (item.classList.contains("is-open")) setFaqPanelHeight(item, true);
  });
});

/* ---- Indications callouts entrance animation ---- */
if ("IntersectionObserver" in window) {
  const indicationsMedia = document.querySelector(".indications-indicator-media");

  if (indicationsMedia) {
    const callouts = indicationsMedia.querySelectorAll(".ind-callout");

    const obs = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          callouts.forEach((callout, i) => {
            setTimeout(() => {
              callout.classList.add("is-visible");
            }, i * 240);
          });
          obs.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.45,
      rootMargin: "0px 0px -10% 0px",
    });

    obs.observe(indicationsMedia);
  }
}

/* ---- Count-up animation for key stats ---- */
(() => {
  const counters = Array.from(document.querySelectorAll(".benefit-stats strong, .stat-item strong"));
  if (!counters.length) return;

  const reduceMotion = window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;

  const parseCounter = (text) => {
    const match = text.trim().match(/^([^0-9]*)(\d+)(.*)$/);
    if (!match) return null;
    return {
      prefix: match[1] || "",
      value: Number(match[2]),
      suffix: match[3] || "",
    };
  };

  const easeInOutCubic = (t) => (t < 0.5)
    ? 4 * t * t * t
    : 1 - Math.pow(-2 * t + 2, 3) / 2;

  const animateCounter = (el) => {
    if (el.dataset.countAnimated === "true") return;

    const parsed = parseCounter(el.textContent || "");
    if (!parsed) return;

    el.dataset.countAnimated = "true";

    if (reduceMotion) {
      el.textContent = `${parsed.prefix}${parsed.value}${parsed.suffix}`;
      return;
    }

    const duration = 3400;
    const start = performance.now();

    const frame = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const currentValue = Math.max(1, Math.round(parsed.value * easeInOutCubic(progress)));
      el.textContent = `${parsed.prefix}${currentValue}${parsed.suffix}`;

      if (progress < 1) {
        window.requestAnimationFrame(frame);
      } else {
        el.textContent = `${parsed.prefix}${parsed.value}${parsed.suffix}`;
      }
    };

    el.textContent = `${parsed.prefix}1${parsed.suffix}`;
    window.requestAnimationFrame(frame);
  };

  if (!("IntersectionObserver" in window)) {
    counters.forEach(animateCounter);
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      animateCounter(entry.target);
      observer.unobserve(entry.target);
    });
  }, {
    threshold: 0.2,
    rootMargin: "0px 0px 12% 0px",
  });

  counters.forEach((counter) => observer.observe(counter));
})();

/* ---- Doc locator (centres RADIESSE®) ---- */
(() => {
  const input = document.getElementById("doc-search");
  const searchButton = document.querySelector(".cta-search-btn");
  const resultsBox = document.getElementById("doclocator-results");
  const countEl = document.getElementById("doclocator-count");
  const listEl = document.getElementById("doclocator-list");
  const mapEl = document.getElementById("doclocator-map");

  if (!input || !searchButton || !resultsBox || !mapEl) return;

  const MAX_RESULTS = 50;
  const NEARBY_RADIUS_KM = 50;
  const FALLBACK_RESULTS = 3;

  // Données factices en attendant le CSV des centres (surchargées par window.RADIESSE_CENTERS si un CSV a été importé)
  const CENTERS = window.RADIESSE_CENTERS || [
    { name: "Centre Esthétique Saint-Honoré", city: "Paris", zip: "75008", lat: 48.870477, lng: 2.310511, street: "Rue de Ponthieu", streetNumber: "12" },
    { name: "Cabinet Médical Bourdonnais", city: "Paris", zip: "75007", lat: 48.856138, lng: 2.302764, street: "Avenue de la Bourdonnais", streetNumber: "85" },
    { name: "Clinique Saint-Germain Esthétique", city: "Paris", zip: "75006", lat: 48.852399, lng: 2.339677, street: "Boulevard Saint-Germain", streetNumber: "126" },
    { name: "Cabinet Monceau", city: "Paris", zip: "75017", lat: 48.882461, lng: 2.309578, street: "Place du Général Catroux", streetNumber: "7" },
    { name: "Centre Dermatologique Opéra", city: "Paris", zip: "75009", lat: 48.8805, lng: 2.330073, street: "Square Moncey", streetNumber: "5" },
    { name: "Clinique Esthétique de Corbiac", city: "Saint-Médard-en-Jalles", zip: "33160", lat: 44.876705, lng: -0.696811, street: "Rue Claude Bernard", streetNumber: "26" },
    { name: "Centre Médical Caudéran", city: "Bordeaux", zip: "33200", lat: 44.856182, lng: -0.615268, street: "Rue Falquet", streetNumber: "12" },
    { name: "Cabinet Rodocanachi", city: "Marseille", zip: "13008", lat: 43.274374, lng: 5.385837, street: "Boulevard Rodocanachi", streetNumber: "55 bis" },
    { name: "Institut Esthétique Prado", city: "Marseille", zip: "13006", lat: 43.289532, lng: 5.374693, street: "Rue Roux de Brignoles", streetNumber: "13" },
    { name: "Cabinet Quai Jean Moulin", city: "Lyon", zip: "69001", lat: 45.766576, lng: 4.837887, street: "Quai Jean Moulin", streetNumber: "9" },
    { name: "Clinique Presqu'île Esthétique", city: "Lyon", zip: "69002", lat: 45.754, lng: 4.832, street: "Rue de la République", streetNumber: "48" },
    { name: "Centre Médical Wilson", city: "Toulouse", zip: "31000", lat: 43.6045, lng: 1.4442, street: "Place du Président Wilson", streetNumber: "3" },
    { name: "Cabinet Promenade", city: "Nice", zip: "06000", lat: 43.6959, lng: 7.2716, street: "Rue de France", streetNumber: "21" },
    { name: "Centre Esthétique Graslin", city: "Nantes", zip: "44000", lat: 47.217029, lng: -1.563169, street: "Place Aristide Briand", streetNumber: "5" },
    { name: "Cabinet Médical Antigone", city: "Montpellier", zip: "34000", lat: 43.600264, lng: 3.898424, street: "Rue de Syracuse", streetNumber: "82" },
    { name: "Clinique Villa Ermitage", city: "Lambersart", zip: "59130", lat: 50.644465, lng: 3.031826, street: "Avenue Henri Delecaux", streetNumber: "8 bis" },
    { name: "Centre Dermatologique Neudorf", city: "Strasbourg", zip: "67100", lat: 48.5734, lng: 7.7521, street: "Route du Polygone", streetNumber: "104" },
    { name: "Cabinet Entraigues", city: "Tours", zip: "37000", lat: 47.388074, lng: 0.688381, street: "Rue d'Entraigues", streetNumber: "19" },
    { name: "Centre CLEMA", city: "Angers", zip: "49000", lat: 47.444203, lng: -0.543031, street: "Rue François Cevert", streetNumber: "16" },
    { name: "Maison Elixience", city: "Metz", zip: "57000", lat: 49.107022, lng: 6.163254, street: "Rue Bossuet", streetNumber: "31" },
    { name: "Dermatologie Esthétique Caen", city: "Caen", zip: "14000", lat: 49.179074, lng: -0.361873, street: "Place de l'Ancienne Comédie", streetNumber: "12" },
    { name: "Cabinet Léon Gontier", city: "Amiens", zip: "80000", lat: 49.894379, lng: 2.292921, street: "Place Léon Gontier", streetNumber: "4" },
    { name: "Skin Aesthetics Landouge", city: "Limoges", zip: "87100", lat: 45.84325, lng: 1.192997, street: "Avenue de Landouge", streetNumber: "223" },
    { name: "Cabinet Sarliève", city: "Cournon-d'Auvergne", zip: "63800", lat: 45.741463, lng: 3.159245, street: "Rue de Sarliève", streetNumber: "21" },
    { name: "Clinique Del Mar", city: "Antibes", zip: "06160", lat: 43.558947, lng: 7.128187, street: "Boulevard Francis Meilland", streetNumber: "90" },
    { name: "Centre Esthétique Thabor", city: "Rennes", zip: "35000", lat: 48.1147, lng: -1.6702, street: "Rue de Paris", streetNumber: "42" },
  ];

  // Centre approximatif de chaque département : pas d'API externe pour les codes postaux
  const DEPT_COORDS = {
    "01": [46.2, 5.2], "02": [49.5, 3.4], "03": [46.3, 3.4], "04": [44.1, 6.2], "05": [44.7, 6.4],
    "06": [43.9, 7.2], "07": [44.7, 4.7], "08": [49.7, 4.7], "09": [42.9, 1.6], "10": [48.3, 4.1],
    "11": [43.2, 2.4], "12": [44.3, 2.6], "13": [43.5, 5.4], "14": [49.1, -0.4], "15": [45.0, 2.6],
    "16": [45.7, 0.2], "17": [45.7, -0.6], "18": [47.1, 2.4], "19": [45.3, 2.0], "21": [47.3, 4.8],
    "22": [48.3, -2.8], "23": [46.0, 2.2], "24": [45.1, 0.7], "25": [47.2, 6.0], "26": [44.7, 5.0],
    "27": [49.1, 1.2], "28": [48.4, 1.5], "29": [48.2, -4.2], "2A": [41.9, 9.0], "2B": [42.4, 9.3],
    "30": [44.0, 4.2], "31": [43.6, 1.4], "32": [43.6, 0.6], "33": [44.8, -0.6], "34": [43.6, 3.9],
    "35": [48.1, -1.7], "36": [46.8, 1.6], "37": [47.4, 0.7], "38": [45.2, 5.7], "39": [46.7, 5.6],
    "40": [43.9, -0.8], "41": [47.6, 1.3], "42": [45.5, 4.2], "43": [45.0, 3.9], "44": [47.2, -1.6],
    "45": [47.9, 2.2], "46": [44.6, 1.6], "47": [44.4, 0.6], "48": [44.5, 3.5], "49": [47.5, -0.6],
    "50": [49.1, -1.3], "51": [49.0, 4.4], "52": [48.1, 5.1], "53": [48.1, -0.8], "54": [48.7, 6.2],
    "55": [49.1, 5.4], "56": [47.9, -2.9], "57": [49.1, 6.2], "58": [47.1, 3.5], "59": [50.4, 3.1],
    "60": [49.4, 2.1], "61": [48.4, 0.1], "62": [50.5, 2.6], "63": [45.8, 3.2], "64": [43.3, -0.4],
    "65": [43.2, 0.1], "66": [42.7, 2.9], "67": [48.5, 7.5], "68": [47.8, 7.3], "69": [45.7, 4.8],
    "70": [47.6, 6.2], "71": [46.6, 4.5], "72": [47.9, 0.2], "73": [45.6, 6.4], "74": [46.0, 6.4],
    "75": [48.9, 2.3], "76": [49.4, 1.1], "77": [48.5, 2.9], "78": [48.8, 1.9], "79": [46.4, -0.4],
    "80": [50.0, 2.3], "81": [43.9, 2.1], "82": [44.0, 1.4], "83": [43.4, 6.1], "84": [43.9, 5.1],
    "85": [46.7, -1.4], "86": [46.6, 0.3], "87": [45.8, 1.3], "88": [48.1, 6.5], "89": [47.9, 3.6],
    "90": [47.6, 6.9], "91": [48.6, 2.3], "92": [48.8, 2.2], "93": [48.9, 2.4], "94": [48.8, 2.5],
    "95": [49.1, 2.1], "971": [16.3, -61.4], "972": [14.6, -61.0], "973": [4.0, -53.0],
    "974": [-21.1, 55.5], "976": [-12.8, 45.2],
  };

  // Grandes villes -> département (recherche par nom de ville sans API externe)
  const CITY_TO_DEPT = {
    "paris": "75", "marseille": "13", "lyon": "69", "toulouse": "31", "nice": "06", "nantes": "44",
    "strasbourg": "67", "montpellier": "34", "bordeaux": "33", "lille": "59", "rennes": "35", "reims": "51",
    "le havre": "76", "saint-etienne": "42", "saint-étienne": "42", "toulon": "83", "grenoble": "38",
    "dijon": "21", "angers": "49", "nimes": "30", "nîmes": "30", "villeurbanne": "69", "clermont-ferrand": "63",
    "le mans": "72", "aix-en-provence": "13", "brest": "29", "tours": "37", "amiens": "80", "limoges": "87",
    "annecy": "74", "perpignan": "66", "besancon": "25", "besançon": "25", "metz": "57", "orleans": "45",
    "orléans": "45", "rouen": "76", "mulhouse": "68", "caen": "14", "nancy": "54", "argenteuil": "95",
    "saint-denis": "93", "montreuil": "93", "roubaix": "59", "tourcoing": "59", "avignon": "84", "poitiers": "86",
    "versailles": "78", "pau": "64", "la rochelle": "17", "calais": "62", "cherbourg": "50", "antibes": "06",
    "cannes": "06", "chambery": "73", "chambéry": "73", "valence": "26", "colmar": "68", "vannes": "56",
    "quimper": "29", "beziers": "34", "béziers": "34", "bayonne": "64", "albi": "81", "agen": "47",
    "blois": "41", "niort": "79", "vichy": "03", "monaco": "06", "ajaccio": "2A", "bastia": "2B",
    "troyes": "10", "chartres": "28", "laval": "53", "saint-malo": "35", "lorient": "56", "bourges": "18",
    "tarbes": "65", "auxerre": "89", "nevers": "58", "gap": "05", "rodez": "12", "aurillac": "15",
    "carcassonne": "11", "montauban": "82", "cahors": "46",
  };

  let map = null;
  let resultMarkers = [];

  const markerIcon = () => L.divIcon({
    className: "",
    html: '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="38" viewBox="0 0 28 38"><path d="M14 0C6.268 0 0 6.268 0 14c0 9.5 14 24 14 24S28 23.5 28 14C28 6.268 21.732 0 14 0z" fill="#173757" stroke="#173757" stroke-width="1.5"/><circle cx="14" cy="14" r="6" fill="#fff"/></svg>',
    iconSize: [28, 38],
    iconAnchor: [14, 38],
    popupAnchor: [0, -40],
  });

  const ensureMap = () => {
    if (map) return map;
    mapEl.hidden = false;
    map = L.map(mapEl, { zoomControl: true }).setView([46.8, 2.3], 6);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);
    setTimeout(() => map.invalidateSize(), 50);
    return map;
  };

  const escapeHtml = (value) => String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#39;");

  const getAddressLine = (center) => `${center.streetNumber} ${center.street}, ${center.zip} ${center.city}`;

  const getDirectionsUrl = (center) =>
    `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(`${getAddressLine(center)}, France`)}`;

  const shareCenter = (center) => {
    const shareUrl = getDirectionsUrl(center);
    if (navigator.share) {
      navigator.share({ title: center.name, text: `RADIESSE® - ${getAddressLine(center)}`, url: shareUrl }).catch(() => {});
      return;
    }
    if (navigator.clipboard?.writeText) {
      navigator.clipboard.writeText(shareUrl)
        .then(() => window.alert("Lien copié."))
        .catch(() => window.prompt("Copiez ce lien :", shareUrl));
      return;
    }
    window.prompt("Copiez ce lien :", shareUrl);
  };

  const createPopupContent = (center) => (
    '<div class="doclocator-popup">' +
      `<p class="doclocator-popup-title">${escapeHtml(center.name)}</p>` +
      `<p class="doclocator-popup-address">${escapeHtml(getAddressLine(center))}</p>` +
      '<div class="doclocator-popup-actions">' +
        `<a class="doclocator-action doclocator-action-primary" href="${getDirectionsUrl(center)}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-route" aria-hidden="true"></i> Itinéraire</a>` +
        '<button type="button" class="doclocator-action" data-action="share-destination"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Partager</button>' +
      "</div>" +
    "</div>"
  );

  const clearResultMarkers = () => {
    resultMarkers.forEach((marker) => map.removeLayer(marker));
    resultMarkers = [];
  };

  const haversine = (lat1, lng1, lat2, lng2) => {
    const R = 6371;
    const dLat = ((lat2 - lat1) * Math.PI) / 180;
    const dLng = ((lng2 - lng1) * Math.PI) / 180;
    const a = Math.sin(dLat / 2) ** 2 +
      Math.cos((lat1 * Math.PI) / 180) * Math.cos((lat2 * Math.PI) / 180) * Math.sin(dLng / 2) ** 2;
    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  };

  const zipToCoords = (zip) => {
    if (!/^\d{5}$/.test(zip)) return null;
    const code = zip.startsWith("97") ? zip.substring(0, 3) : zip.substring(0, 2);
    return DEPT_COORDS[code] ? { lat: DEPT_COORDS[code][0], lng: DEPT_COORDS[code][1] } : null;
  };

  const cityToCoords = (query) => {
    const code = CITY_TO_DEPT[query.toLowerCase().trim()];
    return code && DEPT_COORDS[code] ? { lat: DEPT_COORDS[code][0], lng: DEPT_COORDS[code][1] } : null;
  };

  // Base Adresse Nationale : bien plus fiable que Nominatim sur les codes postaux
  // francais ("75012" -> Paris 12e, et non le centre du departement).
  const geocodeBAN = (query) => {
    const url = `https://api-adresse.data.gouv.fr/search/?limit=1&q=${encodeURIComponent(query)}`;
    return fetch(url, { headers: { Accept: "application/json" } })
      .then((response) => { if (!response.ok) throw new Error(); return response.json(); })
      .then((data) => {
        const hit = data?.features?.[0];
        return hit ? { lat: hit.geometry.coordinates[1], lng: hit.geometry.coordinates[0] } : null;
      });
  };

  // Repli Nominatim : couvre Monaco et les libelles que la BAN ne connait pas.
  const geocodeNominatim = (query) => {
    const url = `https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&countrycodes=fr,mc&q=${encodeURIComponent(query)}`;
    return fetch(url, { headers: { Accept: "application/json" } })
      .then((response) => { if (!response.ok) throw new Error(); return response.json(); })
      .then((data) => (data?.length ? { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) } : null));
  };

  const geocodeLocation = (query) =>
    geocodeBAN(query)
      .catch(() => null)
      .then((location) => location || geocodeNominatim(query).catch(() => null));

  const renderCenterList = (items) => {
    listEl.innerHTML = "";

    items.forEach((center) => {
      const li = document.createElement("li");
      li.className = "doclocator-item";
      li.innerHTML =
        `<p class="doclocator-item-title">${escapeHtml(center.name)}</p>` +
        `<p class="doclocator-item-address">${escapeHtml(getAddressLine(center))}</p>` +
        `<span class="doclocator-item-distance">${Math.round(center.dist)} km</span>` +
        '<div class="doclocator-item-actions">' +
          '<button type="button" class="doclocator-action doclocator-action-primary" data-action="directions"><i class="fa-solid fa-route" aria-hidden="true"></i> Itinéraire</button>' +
          '<button type="button" class="doclocator-action" data-action="share"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Partager</button>' +
        "</div>";

      li.addEventListener("click", () => {
        map.setView([center.lat, center.lng], 14);
        const marker = resultMarkers.find((m) => m._center === center);
        marker?.openPopup();
        window._mtm = window._mtm || [];
        window._mtm.push({ event: "docsearch_contact" });
      });
      li.querySelector('[data-action="directions"]').addEventListener("click", (event) => {
        event.stopPropagation();
        window.open(getDirectionsUrl(center), "_blank", "noopener");
      });
      li.querySelector('[data-action="share"]').addEventListener("click", (event) => {
        event.stopPropagation();
        shareCenter(center);
      });

      listEl.appendChild(li);
    });

    resultsBox.hidden = false;
  };

  const showNearest = (lat, lng, rawQuery) => {
    ensureMap();
    clearResultMarkers();

    const sorted = CENTERS
      .map((center) => ({ ...center, dist: haversine(lat, lng, center.lat, center.lng) }))
      .sort((a, b) => a.dist - b.dist);

    // Uniquement les centres réellement à proximité ; si aucun dans le rayon,
    // on retombe sur les quelques plus proches pour ne pas laisser la recherche vide.
    let nearest = sorted.filter((center) => center.dist <= NEARBY_RADIUS_KM).slice(0, MAX_RESULTS);
    let isFallback = false;
    if (!nearest.length) {
      nearest = sorted.slice(0, FALLBACK_RESULTS);
      isFallback = true;
    }

    resultMarkers = nearest.map((center) => {
      const marker = L.marker([center.lat, center.lng], { icon: markerIcon() }).addTo(map);
      marker._center = center;
      marker.bindPopup(createPopupContent(center));
      marker.on("popupopen", (event) => {
        const shareBtn = event.popup.getElement()?.querySelector('[data-action="share-destination"]');
        shareBtn?.addEventListener("click", (clickEvent) => {
          clickEvent.preventDefault();
          shareCenter(center);
        });
      });
      return marker;
    });

    map.fitBounds(L.latLngBounds(nearest.map((c) => [c.lat, c.lng])), { padding: [40, 40], maxZoom: 12 });

    countEl.textContent = isFallback
      ? `Aucun centre à moins de ${NEARBY_RADIUS_KM} km de « ${rawQuery} ». Voici les ${nearest.length} centres les plus proches :`
      : `${nearest.length} centre${nearest.length > 1 ? "s" : ""} RADIESSE® près de « ${rawQuery} »`;
    renderCenterList(nearest);
  };

  const doSearch = () => {
    const rawQuery = input.value.trim();
    if (!rawQuery) return;

    window._mtm = window._mtm || [];
    window._mtm.push({ event: "docsearch_searchbar" });

    // On geocode d'abord la saisie : un code postal doit pointer sur SA commune,
    // pas sur le centre du departement. Les tables DEPT_COORDS / CITY_TO_DEPT ne
    // servent plus que de repli si le service de geocodage est injoignable.
    countEl.textContent = `Recherche autour de « ${rawQuery} »…`;
    listEl.innerHTML = "";
    resultsBox.hidden = false;

    const fallback = () => {
      const coords = zipToCoords(rawQuery) || cityToCoords(rawQuery);
      if (coords) {
        showNearest(coords.lat, coords.lng, rawQuery);
        return;
      }
      countEl.textContent = `Aucun centre trouvé pour « ${rawQuery} ». Essayez un code postal.`;
    };

    geocodeLocation(rawQuery)
      .then((location) => {
        if (!location) {
          fallback();
          return;
        }
        showNearest(location.lat, location.lng, rawQuery);
      })
      .catch(fallback);
  };

  searchButton.addEventListener("click", doSearch);
  input.addEventListener("keydown", (event) => {
    if (event.key === "Enter") doSearch();
  });

  ensureMap();
})();

document.addEventListener("click", (event) => {
  const trigger = event.target.closest('a[href="#praticien"]');
  if (trigger) {
    window._mtm = window._mtm || [];
    window._mtm.push({ event: "doclocator_open" });
  }
});

  </script>
<?php wp_footer(); ?>
</body>
</html>
