let menuSection = document.querySelectorAll(".sticky-nav li");

// for clickable event
menuSection.forEach((v) => {
  const link = v.querySelector("a");
  if (link) {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const href = link.getAttribute("href");
      if (href && href.startsWith("#")) {
        const targetElement = document.querySelector(href);
        if (targetElement) {
          const elementPosition = targetElement.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - 150;
          window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
          });
        }
      }
      setTimeout(() => {
        menuSection.forEach((j) => j.classList.remove("active"));
        v.classList.add("active");
      }, 300);
    });
  }
});

// for window scrolldown event

window.onscroll = () => {
  let mainSection = document.querySelectorAll(".anchor");

  mainSection.forEach((v, i) => {
    let rect = v.getBoundingClientRect().y;
    if (rect < window.innerHeight - 500) {
      menuSection.forEach((v) => v.classList.remove("active"));
      if (menuSection[i]) {
        menuSection[i].classList.add("active");
      }
    }
  });
};
