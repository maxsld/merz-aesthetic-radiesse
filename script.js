const siteHeader = document.querySelector(".site-header");
const siteMenuLinks = Array.from(document.querySelectorAll(".site-menu-item"));
const siteMenuToggle = document.querySelector(".site-menu-toggle");

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
    faqItems.forEach((otherItem) => {
      const otherTrigger = otherItem.querySelector(".faq-trigger");
      const shouldOpen = otherItem === item && !otherItem.classList.contains("is-open");

      otherItem.classList.toggle("is-open", shouldOpen);
      if (otherTrigger) otherTrigger.setAttribute("aria-expanded", String(shouldOpen));
      setFaqPanelHeight(otherItem, shouldOpen);
    });
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
