const audio = document.getElementById("bgSound");

window.addEventListener("scroll", () => {
  const maxScroll = document.body.scrollHeight - window.innerHeight;
  const scrollPos = window.scrollY;

  let volume = 1 - scrollPos / maxScroll;
  volume = Math.max(0, Math.min(1, volume)); // limit 0–1

  audio.volume = volume;
});

const menuButton = document.getElementById("menu-button");
const navMenu = document.querySelector(".navMenu");

menuButton.addEventListener("click", () => {
  const isOpen = navMenu.classList.contains("show");

  if (isOpen) {
    console.log("open");
    navMenu.classList.remove("show");
    menuButton.setAttribute("aria-expanded", "false");
  } else {
    console.log("close");
    navMenu.classList.add("show");
    menuButton.setAttribute("aria-expanded", "true");
  }
});
