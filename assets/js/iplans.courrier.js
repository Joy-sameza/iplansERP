const newcourrier = document.querySelector("[data-newcourrier]");
const modal = document.querySelector("[data-modal]");
const close = document.querySelector("[data-close]");
const range = document.querySelector("[data-range]");
const select = document.querySelectorAll("[data-select]");
const reset = document.querySelector("[data-reset]");
const upload = document.querySelector("[data-upload]");
const entrant = document.querySelector(".entrant");
const Rupload = document.querySelector("[data-Rupload]");
const rowInfoTemplate = document.querySelector("[data-template-row-info]");
const tableBody = document.querySelector("[data-tbody]");

newcourrier.addEventListener("click", () => modal.classList.add("open"));
close.addEventListener("click", () => modal.classList?.remove("open"));
window.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && modal.classList.contains("open")) {
    modal.classList?.remove("open");
  }
});

function addBorderRadius() {
  const borr = entrant.clientWidth * 0.025 + "px";
  entrant.style.borderRadius = borr;
  entrant.nextElementSibling.style.borderRadius = borr;
}
onresize = addBorderRadius();

range.onchange = adjustSelectedOption;
reset.onclick = adjustSelectedOption;

function adjustSelectedOption(event) {
  const val = parseInt(event.target.value);
  const a = val / 5;
  select.forEach((element) => element.removeAttribute("checked"));
  select[4 - a].setAttribute("checked", "checked");
}
upload.addEventListener("click", function () {
  Rupload.click();
});

Rupload.addEventListener("change", function () {
  const files = this.files;

  for (let i = 0; i < files.length; i++) {
    const filename = files[i].name;
    const size = (files[i].size / 1024).toFixed(2);
    let type = filename.split["."];
    console.log(type ?? "?", size, filename);
    updateTable(
      type,
      filename,
      size >= 1024 ? (size / 1024).toFixed(2) + " MB" : size + " KB"
    );
  }
});

function updateTable(type, doc_name, size) {
  const element = rowInfoTemplate.content.cloneNode(true);
  setValue("type", type, { parent: element });
  setValue("doc-name", doc_name, { parent: element });
  setValue("size", size, { parent: element });
  tableBody.appendChild(element);
}

function setValue(input, value, { parent = document } = {}) {
  parent.querySelector(`[data-${input}]`).textContent = value;
}
