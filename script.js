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
  const syncHeaderState = () => {
    siteHeader.classList.toggle("is-scrolled", window.scrollY > 12);
  };
  syncHeaderState();
  window.addEventListener("scroll", syncHeaderState, { passive: true });
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

/* ---- Video player ---- */
const moaSection = document.querySelector(".moa-section");
const benefitsVideoBlock = document.querySelector(".benefits-video-block");
const benefitsVideo = document.querySelector(".benefits-video");

if (benefitsVideoBlock && benefitsVideo) {
  const toggleButton = benefitsVideoBlock.querySelector(".video-toggle");
  const muteButton = benefitsVideoBlock.querySelector(".video-mute");
  const progress = benefitsVideoBlock.querySelector(".video-progress");
  const time = benefitsVideoBlock.querySelector(".video-time");
  const toggleIcon = toggleButton?.querySelector("i");
  const muteIcon = muteButton?.querySelector("i");
  let controlsTimer;

  benefitsVideo.removeAttribute("controls");

  const showControlsBriefly = () => {
    benefitsVideoBlock.classList.add("is-controls-visible");
    window.clearTimeout(controlsTimer);
    if (!benefitsVideo.paused) {
      controlsTimer = window.setTimeout(() => {
        benefitsVideoBlock.classList.remove("is-controls-visible");
      }, 1600);
    }
  };

  const formatVideoTime = (seconds) => {
    if (!Number.isFinite(seconds)) return "0:00";
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60).toString().padStart(2, "0");
    return `${minutes}:${secs}`;
  };

  const updatePlayState = () => {
    const isPaused = benefitsVideo.paused;
    benefitsVideoBlock.classList.toggle("is-video-paused", isPaused);
    toggleButton?.setAttribute("aria-label", isPaused ? "Lire la vidéo" : "Mettre en pause");
    toggleIcon?.classList.toggle("fa-play", isPaused);
    toggleIcon?.classList.toggle("fa-pause", !isPaused);
  };

  const updateMuteState = () => {
    const isMuted = benefitsVideo.muted;
    muteButton?.setAttribute("aria-label", isMuted ? "Activer le son" : "Couper le son");
    muteIcon?.classList.toggle("fa-volume-xmark", isMuted);
    muteIcon?.classList.toggle("fa-volume-high", !isMuted);
  };

  const updateProgress = () => {
    const duration = benefitsVideo.duration || 0;
    const percent = duration ? (benefitsVideo.currentTime / duration) * 100 : 0;
    if (progress) {
      progress.value = String(percent);
      progress.style.setProperty("--progress", `${percent}%`);
    }
    if (time) time.textContent = formatVideoTime(benefitsVideo.currentTime);
  };

  toggleButton?.addEventListener("click", () => {
    if (benefitsVideo.paused) benefitsVideo.play().catch(() => {});
    else benefitsVideo.pause();
  });

  muteButton?.addEventListener("click", () => {
    benefitsVideo.muted = !benefitsVideo.muted;
    updateMuteState();
  });

  benefitsVideo.addEventListener("click", () => {
    showControlsBriefly();
    if (benefitsVideo.paused) benefitsVideo.play().catch(() => {});
    else benefitsVideo.pause();
  });

  progress?.addEventListener("input", () => {
    const duration = benefitsVideo.duration || 0;
    if (duration) benefitsVideo.currentTime = (Number(progress.value) / 100) * duration;
  });

  benefitsVideoBlock.addEventListener("mousemove", showControlsBriefly);
  benefitsVideoBlock.addEventListener("touchstart", showControlsBriefly, { passive: true });
  benefitsVideo.addEventListener("play", updatePlayState);
  benefitsVideo.addEventListener("pause", updatePlayState);
  benefitsVideo.addEventListener("timeupdate", updateProgress);
  benefitsVideo.addEventListener("loadedmetadata", updateProgress);
  benefitsVideo.addEventListener("volumechange", updateMuteState);

  if (moaSection && "IntersectionObserver" in window) {
    const videoObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          benefitsVideo.muted = true;
          benefitsVideo.play().catch(() => {});
          updateMuteState();
        } else {
          benefitsVideo.pause();
        }
      });
    }, { threshold: 0.48 });
    videoObserver.observe(moaSection);
  }

  updatePlayState();
  updateMuteState();
  updateProgress();
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

/* ---- Benefit blocks scroll reveal ---- */
if ("IntersectionObserver" in window) {
  const benefitBlocks = document.querySelectorAll(".benefit-block");

  benefitBlocks.forEach((block) => {
    block.style.opacity = "0";
    block.style.transform = "translateY(24px)";
    block.style.transition = "opacity 0.65s ease, transform 0.65s ease";
  });

  const revealObs = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1";
        entry.target.style.transform = "translateY(0)";
        revealObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.18 });

  benefitBlocks.forEach((block) => revealObs.observe(block));
}
