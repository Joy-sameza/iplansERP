const newcourrier = document.querySelector("[data-newcourrier]");
const modal = document.querySelector("[data-modal]");
const close = document.querySelector("[data-close]");

newcourrier.addEventListener("click", () => modal.classList.add("open"));
close.addEventListener("click", () => modal.classList?.remove("open"));

const entrant = document.querySelector(".entrant");

function addBorderRadius() {
  const borr = entrant.clientWidth * 0.025 + "px";
  entrant.style.borderRadius = borr;
  entrant.nextElementSibling.style.borderRadius = borr;
}
onresize = addBorderRadius();