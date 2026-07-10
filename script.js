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
  const mapFrame = document.querySelector(".cta-map-frame");

  if (!input || !searchButton || !resultsBox || !mapEl) return;

  const MAX_RESULTS = 10;
  const NEARBY_RADIUS_KM = 50;
  const FALLBACK_RESULTS = 3;

  // Données factices en attendant le CSV des centres
  const CENTERS = [
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
    if (mapFrame) mapFrame.hidden = true;
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

  const geocodeLocation = (query) => {
    const url = `https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&countrycodes=fr,mc&q=${encodeURIComponent(query)}`;
    return fetch(url, { headers: { Accept: "application/json" } })
      .then((response) => { if (!response.ok) throw new Error(); return response.json(); })
      .then((data) => (data?.length ? { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) } : null));
  };

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

    const coords = zipToCoords(rawQuery) || cityToCoords(rawQuery);
    if (coords) {
      showNearest(coords.lat, coords.lng, rawQuery);
      return;
    }

    countEl.textContent = `Recherche autour de « ${rawQuery} »…`;
    listEl.innerHTML = "";
    resultsBox.hidden = false;
    geocodeLocation(rawQuery)
      .then((location) => {
        if (!location) {
          countEl.textContent = `Aucun centre trouvé pour « ${rawQuery} ». Essayez un code postal.`;
          return;
        }
        showNearest(location.lat, location.lng, rawQuery);
      })
      .catch(() => {
        countEl.textContent = `Aucun centre trouvé pour « ${rawQuery} ». Essayez un code postal.`;
      });
  };

  searchButton.addEventListener("click", doSearch);
  input.addEventListener("keydown", (event) => {
    if (event.key === "Enter") doSearch();
  });
})();
