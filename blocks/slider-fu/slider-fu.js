/* global Swiper */

(() => {
  const initSliderFuCarousel = () => {
    if (typeof Swiper === "undefined") {
      return;
    }

    const swiperEl = document.querySelector(".b-slider-fu-swiper");
    if (!swiperEl) {
      return;
    }

    const carouselContainer = swiperEl.closest(".b-slider-fu__carousel");
    const baseSlideWidth = carouselContainer
      ? parseFloat(carouselContainer.getAttribute("data-slide-width")) || 1.6
      : 1.6;

    const badges = document.querySelectorAll(".b-slider-fu__badge");
    const prevBtn = document.querySelector(".b-slider-fu__nav--prev");
    const nextBtn = document.querySelector(".b-slider-fu__nav--next");

    // Konfiguracja Swipera z konfigurowalną szerokością slajdów
    const swiperConfig = {
      // slidesPerView: baseSlideWidth,
      slidesPerView: 1.1,
      spaceBetween: 50,
      speed: 600,
      centeredSlides: true,
      loop: true,
      loopedSlides: 3, // Liczba slajdów do sklonowania dla loop (ważne dla centeredSlides)
      loopAdditionalSlides: 2, // Dodatkowe slajdy do sklonowania
      allowTouchMove: true,
      grabCursor: true,
      simulateTouch: true,
      touchRatio: 1,
      touchAngle: 45,
      resistance: true,
      resistanceRatio: 0.85,
      watchSlidesProgress: true,
      observeParents: true,
      observer: true,
      breakpoints: {
        640: {
          slidesPerView: 1.2,
          spaceBetween: 60,
        },
        768: {
          slidesPerView: 1.2,
          spaceBetween: 100,
          
        },
        1024: {
          slidesPerView: 1.9,
          spaceBetween: 100,
        },
        1280: {
          slidesPerView: 1.9,
          spaceBetween: 160,
        },
        1440: {
          slidesPerView: 1.9,
          spaceBetween: 160,
        },
      },
    };

    // Dodaj nawigację jeśli przyciski istnieją
    if (prevBtn && nextBtn) {
      swiperConfig.navigation = {
        nextEl: nextBtn,
        prevEl: prevBtn,
      };
    }

    // eslint-disable-next-line no-new
    const swiper = new Swiper(swiperEl, swiperConfig);

    // Funkcja do centrowania aktywnego badge'a
    const centerActiveBadge = (activeIndex) => {
      const badgesContainer = document.querySelector(".b-slider-fu__badges");
      if (!badgesContainer) return;

      // Znajdź aktywny badge (tylko oryginalny, nie klon)
      const activeBadge = Array.from(
        badgesContainer.querySelectorAll(".b-slider-fu__badge:not(.b-slider-fu__badge--clone)")
      ).find((badge) => {
        const slideIndex = parseInt(badge.getAttribute("data-slide-index"), 10);
        return slideIndex === activeIndex;
      });

      if (activeBadge) {
        const containerWidth = badgesContainer.clientWidth;
        const badgeLeft = activeBadge.offsetLeft;
        const badgeWidth = activeBadge.offsetWidth;
        const scrollPosition = badgeLeft - containerWidth / 2 + badgeWidth / 2;

        badgesContainer.scrollTo({
          left: scrollPosition,
          behavior: "smooth",
        });
      }
    };

    // Funkcja do pobrania rzeczywistego indeksu aktywnego slajdu
    const getRealActiveIndex = () => {
      // Znajdź aktywny slajd
      const activeSlide = swiper.slides[swiper.activeIndex];
      if (!activeSlide) {
        return swiper.realIndex;
      }

      // Sprawdź czy slajd ma atrybut data-swiper-slide-index (dla loop)
      const slideIndex = activeSlide.getAttribute("data-swiper-slide-index");
      if (slideIndex !== null) {
        return parseInt(slideIndex, 10);
      }

      // Fallback do realIndex
      return swiper.realIndex !== undefined ? swiper.realIndex : swiper.activeIndex;
    };

    // Synchronizacja badge'ów ze slajdami
    const updateBadges = (activeIndex) => {
      // Upewnij się, że indeks jest w prawidłowym zakresie
      const totalBadges = badges.length;
      if (activeIndex < 0 || activeIndex >= totalBadges) {
        activeIndex = activeIndex % totalBadges;
        if (activeIndex < 0) {
          activeIndex += totalBadges;
        }
      }

      badges.forEach((badge, index) => {
        const slideIndex = parseInt(badge.getAttribute("data-slide-index"), 10);
        if (slideIndex === activeIndex) {
          badge.classList.add("b-slider-fu__badge--active");
        } else {
          badge.classList.remove("b-slider-fu__badge--active");
        }
      });

      // Wyśrodkuj aktywny badge
      centerActiveBadge(activeIndex);
    };

    // Obsługa kliknięć w badge'y
    badges.forEach((badge) => {
      badge.addEventListener("click", (e) => {
        // Zapobiegaj przewijaniu jeśli kliknięto w badge
        e.stopPropagation();
        const slideIndex = parseInt(badge.getAttribute("data-slide-index"), 10);
        swiper.slideToLoop(slideIndex); // Użyj slideToLoop zamiast slideTo dla loop
        // Wyśrodkuj kliknięty badge
        centerActiveBadge(slideIndex);
      });
    });

    // Aktualizuj badge'y przy zmianie slajdu
    swiper.on("slideChange", () => {
      const realIndex = getRealActiveIndex();
      updateBadges(realIndex);
    });

    // Napraw indeksy po inicjalizacji loop
    swiper.on("loopFix", () => {
      const realIndex = getRealActiveIndex();
      updateBadges(realIndex);
    });

    // Ustaw początkowy aktywny badge po pełnej inicjalizacji
    swiper.on("init", () => {
      setTimeout(() => {
        const realIndex = getRealActiveIndex();
        updateBadges(realIndex);
      }, 100);
    });

    console.log("Slider FU carousel initialized:", swiper);
  };

  // Funkcja do obsługi drag-to-scroll dla badge'ów
  const initBadgesDragScroll = () => {
    const badgesContainer = document.querySelector(".b-slider-fu__badges");
    if (!badgesContainer) {
      return;
    }

    let isDown = false;
    let startX;
    let scrollLeft;

    badgesContainer.addEventListener("mousedown", (e) => {
      isDown = true;
      badgesContainer.style.cursor = "grabbing";
      badgesContainer.style.userSelect = "none";
      startX = e.pageX - badgesContainer.offsetLeft;
      scrollLeft = badgesContainer.scrollLeft;
    });

    badgesContainer.addEventListener("mouseleave", () => {
      isDown = false;
      badgesContainer.style.cursor = "grab";
      badgesContainer.style.userSelect = "auto";
    });

    badgesContainer.addEventListener("mouseup", () => {
      isDown = false;
      badgesContainer.style.cursor = "grab";
      badgesContainer.style.userSelect = "auto";
    });

    badgesContainer.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - badgesContainer.offsetLeft;
      const walk = (x - startX) * 2; // Prędkość przewijania (można dostosować)
      badgesContainer.scrollLeft = scrollLeft - walk;
    });

    // Obsługa scroll wheel
    badgesContainer.addEventListener("wheel", (e) => {
      e.preventDefault();
      badgesContainer.scrollLeft += e.deltaY;
    });

    // Obsługa touch events dla urządzeń mobilnych
    let touchStartX = 0;
    let touchScrollLeft = 0;

    badgesContainer.addEventListener("touchstart", (e) => {
      touchStartX = e.touches[0].pageX;
      touchScrollLeft = badgesContainer.scrollLeft;
    });

    badgesContainer.addEventListener("touchmove", (e) => {
      const x = e.touches[0].pageX;
      const walk = (x - touchStartX) * 2;
      badgesContainer.scrollLeft = touchScrollLeft - walk;
    });

    // Ustaw początkowy kursor
    badgesContainer.style.cursor = "grab";
  };

  // Funkcja do obsługi efektu paralaksy GSAP
  const initParallax = () => {
    // Sprawdź czy GSAP jest załadowany
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
      setTimeout(initParallax, 100);
      return;
    }

    // Zarejestruj plugin ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Znajdź wszystkie slajdy
    const slides = document.querySelectorAll(".b-slider-fu__slide");
    if (slides.length === 0) return;

    // Usuń istniejące triggery dla tego bloku
    const allTriggers = ScrollTrigger.getAll();
    for (let i = 0; i < allTriggers.length; i++) {
      const trigger = allTriggers[i];
      if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith("slider-fu-parallax-")) {
        trigger.kill();
      }
    }

    // Odśwież ScrollTrigger
    ScrollTrigger.refresh();

    // Dla każdego slajdu dodaj efekt paralaksy
    slides.forEach((slide, index) => {
      // Elementy overlay
      const overlayLeft = slide.querySelector(".cpt-feature-hero__overlay__left");
      const overlayRight = slide.querySelector(".cpt-feature-hero__overlay__right");

      // Elementy SVG w slide-bg
      const svgLeft = slide.querySelector(".b-slider-fu__svg-left");
      const svgRight = slide.querySelector(".b-slider-fu__svg-right");

      // Obrazek tła
      const bgImage = slide.querySelector(".b-slider-fu__slide-bg-img");

      // Parallax dla overlay left
      if (overlayLeft) {
        gsap.set(overlayLeft, { y: 0, x: 0 });
        gsap.fromTo(
          overlayLeft,
          { y: 40, x: 15 }, // Pozycja przed środkiem
          {
            y: -40, // Pozycja po środku
            x: -15,
            ease: "none",
            scrollTrigger: {
              trigger: slide,
              start: "top bottom",
              end: "bottom top",
              scrub: 2,
              invalidateOnRefresh: true,
              id: `slider-fu-parallax-overlay-left-${index}`,
            },
          }
        );
      }

      // Parallax dla overlay right
      if (overlayRight) {
        gsap.set(overlayRight, { y: 0, x: 0 });
        gsap.fromTo(
          overlayRight,
          { y: 40, x: -15 }, // Pozycja przed środkiem
          {
            y: -40, // Pozycja po środku
            x: 15,
            ease: "none",
            scrollTrigger: {
              trigger: slide,
              start: "top bottom",
              end: "bottom top",
              scrub: 20,
              invalidateOnRefresh: true,
              id: `slider-fu-parallax-overlay-right-${index}`,
            },
          }
        );
      }

      // Parallax dla SVG left
      if (svgLeft) {
        gsap.set(svgLeft, { y: 0, x: 0 });
        gsap.fromTo(
          svgLeft,
          { y: 25, x: 10 }, // Pozycja przed środkiem
          {
            y: -25, // Pozycja po środku
            x: -10,
            ease: "none",
            scrollTrigger: {
              trigger: slide,
              start: "top bottom",
              end: "bottom top",
              scrub: 10.5,
              invalidateOnRefresh: true,
              id: `slider-fu-parallax-svg-left-${index}`,
            },
          }
        );
      }

      // Parallax dla SVG right
      if (svgRight) {
        gsap.set(svgRight, { y: 0, x: 0 });
        gsap.fromTo(
          svgRight,
          { y: 25, x: -10 }, // Pozycja przed środkiem
          {
            y: -25, // Pozycja po środku
            x: 10,
            ease: "none",
            scrollTrigger: {
              trigger: slide,
              start: "top bottom",
              end: "bottom top",
              scrub: 10.5,
              invalidateOnRefresh: true,
              id: `slider-fu-parallax-svg-right-${index}`,
            },
          }
        );
      }

      // Parallax dla obrazka tła
      if (bgImage) {
        gsap.set(bgImage, { y: 0, x: 0 });
        gsap.fromTo(
          bgImage,
          { y: 100, x: 0 }, // Pozycja przed środkiem
          {
            y: 0, // Domyślna pozycja gdy na środku
            x: 0,
            ease: "none",
            scrollTrigger: {
              trigger: slide,
              start: "top bottom",
              end: "center center", // Zatrzymaj się gdy slajd jest na środku
              scrub: 2.5,
              invalidateOnRefresh: true,
              id: `slider-fu-parallax-bg-img-${index}`,
            },
          }
        );
      }
    });

    // Odśwież ScrollTrigger po utworzeniu wszystkich instancji
    setTimeout(() => {
      ScrollTrigger.refresh();
    }, 300);
  };

  document.addEventListener("DOMContentLoaded", () => {
    initSliderFuCarousel();
    initBadgesDragScroll();
    initParallax();
  });

  // Odśwież na resize okna
  let resizeTimer;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      if (typeof ScrollTrigger !== "undefined") {
        ScrollTrigger.refresh();
      }
    }, 250);
  });
})();

