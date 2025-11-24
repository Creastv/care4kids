(() => {
  const initHeaderNav = (nav) => {
    const toggle = nav.querySelector(".header-nav__toggle");
    const overlay = nav.querySelector(".header-nav__overlay");
    const panel = nav.querySelector(".header-nav__panel");

    if (!toggle || !panel) {
      return;
    }

    const breakpoint =
      parseInt(nav.getAttribute("data-nav-breakpoint"), 10) || 1024;

    const setAria = (isOpen) => {
      toggle.setAttribute("aria-expanded", String(isOpen));
    };

    const lockBody = () => {
      document.body.classList.add("has-open-nav");
    };

    const unlockBody = () => {
      if (!document.querySelector(".header-nav.is-open")) {
        document.body.classList.remove("has-open-nav");
      }
    };

    const openNav = () => {
      nav.classList.add("is-open");
      setAria(true);
      lockBody();
    };

    const closeNav = () => {
      nav.classList.remove("is-open");
      setAria(false);
      unlockBody();
    };

    toggle.addEventListener("click", () => {
      if (nav.classList.contains("is-open")) {
        closeNav();
      } else {
        openNav();
      }
    });

    overlay?.addEventListener("click", closeNav);

    panel.addEventListener("click", (event) => {
      const target = event.target;
      if (
        target instanceof HTMLElement &&
        target.classList.contains("header-nav__link")
      ) {
        closeNav();
      }
    });

    document.addEventListener("keyup", (event) => {
      if (event.key === "Escape") {
        closeNav();
      }
    });

    const mq = window.matchMedia(`(min-width: ${breakpoint + 1}px)`);
    const handleMq = () => {
      if (mq.matches) {
        closeNav();
      }
    };

    if (typeof mq.addEventListener === "function") {
      mq.addEventListener("change", handleMq);
    } else if (typeof mq.addListener === "function") {
      mq.addListener(handleMq);
    }
  };

  const initStickyHeader = () => {
    const header = document.querySelector(".site-header");
    if (!header) return;

    let lastScrollTop = 0;
    let ticking = false;
    const scrollThreshold = 100; // Minimum scroll distance before header becomes sticky

    const updateHeader = () => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop < scrollThreshold) {
        // At the top of the page
        header.classList.remove("is-sticky", "is-hidden");
      } else {
        // Scrolled down
        header.classList.add("is-sticky");

        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
          // Scrolling down
          header.classList.add("is-hidden");
        } else {
          // Scrolling up
          header.classList.remove("is-hidden");
        }
      }

      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
      ticking = false;
    };

    const handleScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(updateHeader);
        ticking = true;
      }
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
  };

  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".header-nav").forEach((nav) => {
      initHeaderNav(nav);
    });
    initStickyHeader();
  });
})();

