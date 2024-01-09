const newcourrier = document.querySelector("[data-newcourrier]");
const modal1 = document.querySelector("[data-modal1]");
const modal2 = document.querySelector("[data-modal2]");
const modal3 = document.querySelector("[data-modal3]");
const close1 = document.querySelector("[data-close]");
const close2 = document.querySelector("[data-close2]");
const close3 = document.querySelector("[data-close3]");
const range = document.querySelectorAll("[data-range]");
const reset = document.querySelectorAll("[data-reset]");
const upload = document.querySelectorAll("[data-upload]");
const Rupload = document.querySelectorAll("[data-Rupload]");
const removeAll = document.querySelectorAll("[data-removeAll]");
const addPiece = document.querySelectorAll("[data-addPiece]");
const removePiece = document.querySelectorAll("[data-removePiece]");
const entrant = document.querySelector(".entrant");
const rowInfoTemplate = document.querySelector("[data-template-row-info]");
const tableBody = document.querySelectorAll("[data-tbody]");
const ouvrirCourrier = document.querySelector("[data-ouvrirCourrier]");
const dataList = document.querySelector(".list");
const listRowTemplate = document.querySelector("[data-list-template-info]");
const formOuvrirCourrier = document.querySelector("#formOuvrirCourrier");
const modifybtn = modal2.querySelector("#modify");
const deletebtn = modal2.querySelector("#delete");
const archivebtn = modal2.querySelector("#archive");
const printbtn = modal2.querySelector("#print");
const listTableRows = modal2.getElementsByTagName("tr");
const nouvelleRedaction = document.querySelector("[data-nouvelleRedaction]");

let modal1ref, modal2ref;
modal1ref = false;
modal2ref = false;
/**
 * Opens the specified modals when their respective trigger buttons are clicked.
 *
 * @param {Array} modals - An array of objects representing the modals and their trigger buttons.
 * @param {HTMLElement} modals[].triggerButton - The trigger button for the modal.
 * @param {HTMLElement} modals[].modal - The modal element to be opened.
 */
const openModals = (modals) => {
  modals.forEach(({ triggerButton, modal }) => {
    triggerButton.addEventListener("click", (e) => {
      modal.classList.add("open");
      if (modal === modal1) modal1ref = "btn";
      if (modal === modal2) modal2ref = "btn";
      window.dispatchEvent(new Event("change"));
    });
  });
};

/**
 * Closes the specified modals when their respective trigger buttons are clicked.
 *
 * @param {Array} modals - An array of objects representing the modals and their trigger buttons.
 * @param {HTMLElement} modals[].triggerButton - The trigger button for the modal.
 * @param {HTMLElement} modals[].modal - The modal element to be closed.
 */
const closeModals = (modals) => {
  modals.forEach(({ triggerButton, modal }) => {
    triggerButton.addEventListener("click", () => {
      modal.classList?.remove("open");
      modal1ref = modal2ref = false;
    });
  });
};

openModals([
  { triggerButton: newcourrier, modal: modal1 },
  { triggerButton: ouvrirCourrier, modal: modal2 },
  { triggerButton: nouvelleRedaction, modal: modal3 },
]);
closeModals([
  { triggerButton: close1, modal: modal1 },
  { triggerButton: close2, modal: modal2 },
  { triggerButton: close3, modal: modal3 },
]);
window.addEventListener("keydown", (e) => {
  if (
    e.key === "Escape" &&
    (modal1.classList.contains("open") ||
      modal2.classList.contains("open") ||
      modal3.classList.contains("open"))
  ) {
    modal1.classList?.remove("open");
    modal2.classList?.remove("open");
    modal3.classList?.remove("open");
    modal1ref = modal2ref = false;
  }
});

window.addEventListener("change", (e) => {
  let imps = modal1.querySelectorAll("[type='radio'][name='niveau']");
  if (modal1ref === false) {
    modal1.querySelector("form").action =
      SITE_URL + "/forms/formdataupdate.php";
    imps[0].parentNode.parentNode.style.pointerEvents = "auto";
    modal1.querySelector(
      "[type='range'][list='options']"
    ).parentNode.style.display = "none";
  } else {
    modal1.querySelector("form").action = SITE_URL + "/forms/formdata.php";
    imps[0].parentNode.parentNode.style.pointerEvents = "none";
    modal1
      .querySelector("[type='range'][list='options']")
      .parentNode.style.removeProperty("display");
    // reset.click();
  }
});

/**
 * Sets the border radius of the entrant element and its next sibling.
 *
 * @param {type} entrant - The element to set the border radius on.
 * @return {void}
 */
function addBorderRadius() {
  const borderRadius = entrant.clientWidth * 0.025 + "px";
  entrant.style.borderRadius = borderRadius;
  entrant.nextElementSibling.style.borderRadius = borderRadius;
  entrant.nextElementSibling.nextElementSibling.style.borderRadius =
    borderRadius;
}

window.addEventListener("resize", addBorderRadius);
addBorderRadius();

range.forEach((r, i) =>
  r.addEventListener("change", function (event) {
    let select;
    if (i === 0) {
      select = modal1.querySelectorAll("[data-select]");
    }
    if (i === 1) {
      select = modal3.querySelectorAll("[data-select]");
    }
    const selectedValue = parseInt(event.target.value);
    const selectedOptionIndex = Math.floor(selectedValue / 5);

    select?.forEach((option) => option.removeAttribute("checked"));
    select[4 - selectedOptionIndex].setAttribute("checked", "checked");
  })
);
reset.forEach((r, i) =>
  r.addEventListener("click", () => {
    removeAll[i].click();
  })
);
upload.forEach((u, i) =>
  u.addEventListener("click", function () {
    Rupload[i].click();
  })
);

Rupload.forEach((u, index) =>
  u.addEventListener("change", function () {
    const files = this.files;

    for (let i = 0; i < files.length; i++) {
      const filename = files[i].name;
      const size = (files[i].size / 1024).toFixed(2);
      const fileExtension = filename.lastIndexOf(".");
      let type;
      fileExtension !== -1
        ? (type = filename.substring(fileExtension, filename.length))
        : undefined;
      type = type?.split(".").pop().toUpperCase();
      updateTable(
        tableBody[index],
        {
          type: type ?? "???",
          doc_name: filename,
          size: size >= 1024 ? (size / 1024).toFixed(2) + " MB" : size + " KB",
        },
        rowInfoTemplate
      );
    }
  })
);

removeAll.forEach((re, i) =>
  re.addEventListener("click", () => {
    tableBody[i].innerHTML = "";
    Rupload[i].value = "";
  })
);

addPiece.forEach((a, i) =>
  a.addEventListener("click", () => Rupload[i].click())
);

removePiece.forEach((r, i) =>
  r.addEventListener("click", () => {
    tableBody[i].removeChild(tableBody[i].lastChild);
    Rupload[i].value = "";
  })
);

/**
 * Updates the table with the given data by cloning an element and setting its values.
 *
 * @param {Element} table - The table element to update.
 * @param {Object} data - The data object containing the values to set.
 * @param {DocumentFragment} elementClone - The cloned element to update with the data values.
 */
function updateTable(table, data = {}, elementClone) {
  const element = elementClone.content.cloneNode(true);
  setValue("type", data.type, { parent: element });
  setValue("doc-name", data.doc_name, { parent: element });
  setValue("size", data.size, { parent: element });

  const courier = {
    ReferenceCourier: "ref",
    ObjetCourier: "objet",
    DateDepot: "date",
    HeureDepot: "heure",
    SourceCourier: "source",
    Destinataire: "destinataire",
    NiveauImportance: "niveau",
    InOutCourier: "type",
    Statut: "statut",
    NEng: "neng",
  };

  Object.entries(data).forEach(([key, value]) => {
    if (key in courier) {
      setValue(courier[key], value, { parent: element });
    }
  });
  // table.innerHTML = "";
  table.appendChild(element);
}

/**
 * Sets the value of an element with a specific data attribute.
 *
 * @param {string} dataAttribute - The data attribute to search for.
 * @param {any} value - The value to set on the element.
 * @param {Object} options - The options object.
 * @param {HTMLElement} options.parent - The parent element to search within (default: document).
 */
function setValue(dataAttribute, value, { parent = document } = {}) {
  const element = parent.querySelector(`[data-${dataAttribute}]`);
  if (element) {
    element.textContent = value;
  }
}

let data;
window.addEventListener("DOMContentLoaded", async () => {
  data = fetchData();
  formOuvrirCourrier.dispatchEvent(new Event("change"));
});

let niveauFiltre, etatFiltre, typeFiltre, filtre;
formOuvrirCourrier.addEventListener("change", (e) => {
  const start = formOuvrirCourrier.querySelector("#date_debut").value;
  const end = formOuvrirCourrier.querySelector("#date_fin").value;

  if (e.target.name === "date_debut" || e.target.name === "date_fin") return;
  if (e.target.name === "etat_filtre") etatFiltre = e.target.value;
  if (e.target.name === "niveau_filtre") niveauFiltre = e.target.value;
  if (e.target.name === "type_filtre") typeFiltre = e.target.value;
  if (e.target.name === "filtre") filtre = e.target.checked;

  data.then((rows) => {
    let output = rows;
    if (filtre) output = useDatefilters(start, end, output);
    if (niveauFiltre) output = useNiveaufilters(niveauFiltre, output);
    if (etatFiltre) output = useEtatfilters(etatFiltre, output);
    if (typeFiltre) output = useTypefilters(typeFiltre, output);
    dataList.innerHTML = "";
    if (output.length === 0) return;
    output.forEach((row) => updateTable(dataList, row, listRowTemplate));
    let action = "";
    modifybtn.addEventListener("click", () => (action = "modify"));
    deletebtn.addEventListener("click", () => (action = "delete"));
    archivebtn.addEventListener("click", () => (action = "archive"));
    printbtn.addEventListener("click", () => printTable());
    Array.from(listTableRows).forEach((row) => {
      row.addEventListener("click", async (e) => {
        const tableRow = e.target.parentNode;
        const id = parseInt(extractDataFromRow(tableRow).neng);
        switch (action) {
          case "modify":
            action = "";
            modifyData(tableRow, id);
            break;
          case "archive":
            action = "";
            await archiveData(id);
            break;
          case "delete":
            action = "";
            await deleteData(id);
            break;
          default:
            break;
        }
      });
    });
  });
});

function printTable() {
  const pdf = new jspdf.jsPDF({ orientation: "landscape" });
  const iplans = "\nREGISTRE DES COURRIERS";
  const displayDateTime = new Date().toLocaleDateString(pdfLang, {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
  });
  pdf.addImage(
      SITE_URL + "/assets/img/iplans logo.png",
      "PNG",
      10,
      10,
      2.969 * 50 * 0.25,
      1 * 50 * 0.25
  );
  pdf.setFontSize(11);
  pdf.text(displayDateTime + iplans, 10, 10);
  pdf.autoTable({
    html: "#printable",
    startX: 10,
    margin: { top: 20 },
  });
  pdf.save("table.pdf");
  return;
}

/**
 * Fetches data from the API URL.
 *
 * @return {Promise<object>} A promise that resolves to the fetched data.
 */
async function fetchData() {
  const response = await fetch(API_URL);
  const data = await response.json();
  return data;
}

/**
 *
 * @param {string} start The starting date to apply the filters
 * @param {string} end The ending date to apply the filters
 * @param {Array} data List of data to be filtered
 * @returns {Array} List of filtered data
 */
function useDatefilters(start, end, data) {
  const startDate = new Date(start);
  const endDate = new Date(end);

  const diff = endDate - startDate;
  if (diff <= 0) {
    swal({
      icon: "error",
      closeOnClickOutside: true,
      text: "Date de debut dois être plus petit que la Date de fin.",
      dangerMode: true,
      timer: 3000,
      onOpen: function () {
        swal.showLoading();
      },
    });
    return [];
  }
  if (data.length <= 0) return [];
  return data.filter((d) => {
    let dt = d.DateDepot;
    if (dt.includes("/")) {
      dt = new Date(dt.split("/").join("-"));
    } else {
      dt = new Date(dt);
    }
    return startDate <= dt && dt <= endDate;
  });
}

/**
 * Filter data based on the level
 * @param {string} niveau The level to filter out
 * @param {Array} data List of data to filter
 * @returns {Array} List of filtered data
 */
function useNiveaufilters(niveau, data) {
  if (data.length === 0) {
    return [];
  }

  if (!niveau) {
    return data;
  }

  const filters = {
    exceptionnel_filtre: "Exceptionnel",
    tres_haute_filtre: "Très haute",
    haute_filtre: "Haute",
    moyenne_filtre: "Moyenne",
    basse_filtre: "Basse",
  };

  const filteredData = data.filter((d) => {
    return d.NiveauImportance === filters[niveau];
  });

  return filteredData.length > 0 ? filteredData : data;
}

/**
 *
 * @param {string} etat The state to filter
 * @param {Array} data List of data to filter
 * @returns {Array} List of filtered data
 */
function useEtatfilters(etat, data) {
  if (data.length <= 0) return [];
  if (!etat) return data;
  switch (etat) {
    case "archive_filtre":
      return data.filter(
        (d) =>
          d.Statut === "Archivé" ||
          d.Statut === "Traité" ||
          d.Statut === "Archivé/Traité" ||
          d.Statut === "Traité/Archivé"
      );
    case "non_archive_filtre":
      return data.filter((d) => d.Statut === "");
    default:
      return data;
  }
}

/**
 * Filters the data based on the given type.
 * @param {string} type - The type to filter
 * @param {Array} data - List of data to filter
 * @returns {Array} - List of filtered data
 */
function useTypefilters(type, data) {
  // If data is empty, return an empty array
  if (data.length === 0) return [];

  // If type is falsy, return the original data
  if (!type) return data;

  // Filter the data based on the type
  switch (type) {
    case "entrant_filtre":
      // Filter for "Entrant" type
      return data.filter((item) => item.InOutCourier === "Entrant");
    case "sortant_filtre":
      // Filter for "Sortant" type
      return data.filter((item) => item.InOutCourier === "Sortant");
    case "encours_filtre":
      // Filter for "Sortant" type
      return data.filter((item) => item.InOutCourier === "En cours");
    default:
      // Return the original data for unknown type
      return data;
  }
}

/**
 *
 * @param {HTMLTableRowElement} tableRow data to modify in database
 * @param {number} id The id of the data to modify in the database
 */
function modifyData(tableRow, id) {
  modal1.classList.add("open");
  modal1.style.zIndex = 100;
  modal2.style.zIndex = 10;

  const data = extractDataFromRow(tableRow);

  const inps = modal1.querySelectorAll("[type='radio'][name='type']");
  const type = data.inOutCourier;
  inps[0].checked = type === "Entrant";
  inps[1].checked = type === "Sortant";

  modal1.querySelector("#ref").value = data.ref;
  modal1.querySelector("#objet").value = data.objet;
  modal1.querySelector("#source").value = data.source;
  modal1.querySelector("#desti").value = data.desti;

  const d = data.date.replace(/\//g, "-");
  const pts = d.split("-");
  const formattedDate =
    pts.slice(-1)[0].length === 4 ? pts.reverse().join("-") : d;
  modal1.querySelector("#date").value = formattedDate;

  const time = data.heure
    .split(":")
    .map((part) => part.padStart(2, "0"))
    .join(":");
  modal1.querySelector("#heure").value = time;

  let imps = modal1.querySelectorAll("[type='radio'][name='niveau']");
  const level = data.niveau;
  imps.forEach((imp) => (imp.checked = imp.value === level));

  const frm = modal1.querySelector("form");
  frm.addEventListener("submit", async (e) => {
    if (frm.action !== SITE_URL + "/forms/formdataupdate.php") return;
    e.preventDefault();
    const dt = {
      ref: frm.querySelector("#ref").value,
      objet: frm.querySelector("#objet").value,
      source: frm.querySelector("#source").value,
      desti: frm.querySelector("#desti").value,
      date: frm.querySelector("#date").value,
      heure: frm.querySelector("#heure").value,
      type: getRadioInputValue("type", frm),
      niveau: getRadioInputValue("niveau", frm),
      userfiles: frm.querySelector("[name='userfiles'][type='file']").files[0],
    };
    const response = await postData(frm.action, dt, id);
    if (
      (response["rows"] === undefined && response["message"]) ||
      response["errors"]
    )
      return showAlert(
        "Le courrier ne peut pas être modifié",
        "error",
        "Le courrier est déjà archivé"
      );
    showAlert("Courrier modifié avec succès", "success").then(() => {
      close1.click();
    });
    window.dispatchEvent(new Event("DOMContentLoaded"));
    formOuvrirCourrier.dispatchEvent(
      new Event("change", { bubbles: true, cancelable: true })
    );
    // formOuvrirCourrier.dispatchEvent(new Event("change"));
  });
}

/**
 * Retrieves the value of a checked radio input by name within a specified form.
 *
 * @param {string} name - The name of the radio input.
 * @param {HTMLFormElement} parentForm - The parent form element.
 * @return {string|undefined} The value of the checked radio input, or undefined if no input is checked.
 */
function getRadioInputValue(name, parentForm) {
  const radioInputs = Array.from(
    parentForm.querySelectorAll(`input[name="${name}"]`)
  );
  const checkedRadioInput = radioInputs.find(
    (radioInput) => radioInput.checked
  );
  return checkedRadioInput?.value;
}

/**
 *
 * @param {HTMLTableCellElement} data data to archive in database
 * @param {number} id id of courier
 */
async function archiveData(id) {
  const val = await swal({
    icon: "warning",
    title: "Etes-vous sûr de vouloir archiver ce courier ?",
    dangerMode: true,
    closeOnClickOutside: false,
    closeOnEsc: false,
    buttons: {
      cancel: {
        text: "Non, ne pas archiver!",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Oui, archiver!",
        value: true,
        className: "",
        closeModal: true,
      },
    },
  });

  if (!val) return;
  const url = SITE_URL + "/forms/formdataupdate.php";
  const response = await postData(
    url,
    {
      statut: "Archivé",
    },
    id
  );

  if (
    (response["rows"] === undefined && response["message"]) ||
    response["errors"]
  )
    return showAlert("Le courrier ne peut plus être archivé", "error");
  showAlert("Courrier archivé avec succès", "success");
  window.dispatchEvent(new Event("DOMContentLoaded"));
  formOuvrirCourrier.dispatchEvent(new Event("change"));
}
/**
 *
 * @param {number} id ID of the data to delete in database
 */
async function deleteData(id) {
  const val = await swal({
    icon: "warning",
    title: "Etes-vous sûr de vouloir supprimer ce courier ?",
    dangerMode: true,
    closeOnClickOutside: false,
    closeOnEsc: false,
    buttons: {
      cancel: {
        text: "Non, ne pas supprimer!",
        value: false,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Oui, supprimer!",
        value: true,
        className: "",
        closeModal: true,
      },
    },
  });
  if (!val) return;
  const url = SITE_URL + "/forms/formdatadelete.php";
  const response = await postData(url, {}, id);
  if (response["rows"] === 1 && response["message"])
    return showAlert("L'employé a été supprimé avec succès", "success");
  return showAlert("L'employé n'a pas pu être supprimé", "error");
}
/**
 * Send a POST request to the server with data
 * @param {string} action - Server URI action
 * @param {object} data - Data to send to the server
 * @param {number} id - ID of the data to send
 * @returns {Promise<any>} - Promise that resolves to the response JSON
 */
async function postData(action, data, id) {
  const formData = new FormData();

  for (const key in data) {
    formData.append(key, data[key]);
  }
  formData.append("iplans_submit", "");

  const options = {
    cache: "reload",
    method: "POST",
    body: formData,
  };

  const response = await fetch(`${action}/?id=${id}`, options);
  if (!response.ok && response.status !== 200) {
    return { errors: true };
  }
  const responseData = await response.json();
  return responseData;
}

/**
 * Extracts data from a given row and returns an object with the extracted data.
 *
 * @param {HTMLTableRowElement} row - The row from which to extract the data.
 * @return {Object} An object containing the extracted data.
 */
function extractDataFromRow(row) {
  return {
    ref: row.children[0].textContent,
    objet: row.children[1].textContent,
    date: row.children[2].textContent,
    heure: row.children[3].textContent,
    source: row.children[4].textContent,
    desti: row.children[5].textContent,
    niveau: row.children[6].textContent,
    inOutCourier: row.children[7].textContent,
    statut: row.children[8].textContent,
    neng: row.children[9].textContent,
  };
}

/**
 * Displays an alert with a specified title, type, and optional text.
 *
 * @param {string} title - The title of the alert.
 * @param {string} type - The type of the alert.
 * @param {string} [text=""] - The optional text to display in the alert.
 * @return {Promise} - A promise that resolves after the alert is displayed.
 */
async function showAlert(title, type, text = "") {
  swal({
    icon: type,
    closeOnClickOutside: true,
    text: text,
    title: title,
    dangerMode: true,
    timer: type === "error" ? 3500 : 3000,
  });
}

if (SAVE) showAlert("Courrier enregistré avec succès", "success");
