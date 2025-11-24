/* global Swiper */

(() => {
  const initOpinionsCarousel = () => {
    if (typeof Swiper === "undefined") {
      return;
    }

    const swiperEl = document.querySelector(".b-opinions-swiper");
    if (!swiperEl) {
      return;
    }

    // Konfiguracja Swipera z autoplayem, bez nawigacji
    // 3 pełne opinie + częściowo widoczne po bokach
    const swiperConfig = {
      slidesPerView: 1,
      spaceBetween: 20,
      speed: 600,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      loop: true,
      centeredSlides: false,
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
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 1.5,
          spaceBetween: 24,
        },
        1024: {
          slidesPerView: 2.2,
          spaceBetween: 24,
        },
        1280: {
          slidesPerView: 3.2,
          spaceBetween: 30,
        },
        1440: {
          slidesPerView: 3.2,
          spaceBetween: 30,
        },
      },
    };

    // eslint-disable-next-line no-new
    const swiper = new Swiper(swiperEl, swiperConfig);

    console.log('Opinions carousel initialized:', swiper);
  };

  document.addEventListener("DOMContentLoaded", () => {
    initOpinionsCarousel();
  });
})();

