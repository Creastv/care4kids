/* global Swiper */

(() => {
  const initBulletsCarousel = (container) => {
    if (typeof Swiper === "undefined") {
      return;
    }

    const swiperEl = container.querySelector(".bullets-swiper");
    if (!swiperEl) {
      return;
    }

    const columnsClass = Array.from(container.classList).find((cls) =>
      cls.startsWith("bullets-columns-"),
    );
    const maxColumns = columnsClass
      ? parseInt(columnsClass.replace("bullets-columns-", ""), 10)
      : 3;

    const paginationEl = container.querySelector(".bullets-swiper__pagination");
    const controlsEl = container.querySelector(".bullets-swiper__controls");
    const nextEl = controlsEl ? controlsEl.querySelector(".swiper-button-next") : null;
    const prevEl = controlsEl ? controlsEl.querySelector(".swiper-button-prev") : null;

    // Konfiguracja Swipera
    const swiperConfig = {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 600,
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
    };

    // Dodaj pagination tylko jeśli element istnieje
    if (paginationEl) {
      swiperConfig.pagination = {
        el: paginationEl,
        clickable: true,
      };
    }

    // Dodaj navigation tylko jeśli oba przyciski istnieją
    if (nextEl && prevEl) {
      swiperConfig.navigation = {
        nextEl,
        prevEl,
      };
    } else {
      console.warn('Bullets carousel: Navigation buttons not found');
    }

    // Dodaj breakpoints
    swiperConfig.breakpoints = {
      640: {
        slidesPerView: 2,
        spaceBetween: 0,
        loop: true,
        navigation: false,
      },
      1024: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      1360: {
        slidesPerView: 3,
        spaceBetween: 60,
      },
    };

    // eslint-disable-next-line no-new
    const swiper = new Swiper(swiperEl, swiperConfig);

    console.log('Bullets carousel initialized:', swiper);
  };

  document.addEventListener("DOMContentLoaded", () => {
    document
      .querySelectorAll(".bullets-container[data-bullets-display='carousel']")
      .forEach((container) => {
        initBulletsCarousel(container);
      });
  });
})();

