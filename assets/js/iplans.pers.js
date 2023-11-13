const persTable = document.getElementById("pers_table");
const persTableTemplate = document.getElementById("pers_table_template");
const categorieForm = document.getElementById("categie_form");
const genre = categorieForm.querySelectorAll('[name="genre"]');
const prestataire = categorieForm.querySelectorAll('[name="prestataire"]');
const conforme = categorieForm.querySelectorAll('[name="conforme"]');

let persData = await fetchData();

persTable.innerHTML = "";
for (let rowData of persData)
  updateTable(persTable, rowData, persTableTemplate);

categorieForm.addEventListener("change", handleChangeEvent);

/**
 * Fetches data from the API URL.
 *
 * @return {Promise<Array>} A promise that resolves to the fetched data.
 */
async function fetchData() {
  const response = await fetch(api_url_pers);
  const data = await response.json();
  return data;
}
/**
 * Updates the table with the given data by cloning an element and setting its values.
 *
 * @param {Element} table - The table element to update.
 * @param {Object} data - The data object containing the values to set.
 * @param {DocumentFragment} elementClone - The cloned element to update with the data values.
 */
function updateTable(table, data = {}, elementClone) {
  const element = elementClone.content.cloneNode(true);
  const pers = {
    civilite: "civilite",
    nom: "nom",
    prenom: "prenom",
    Fonction: "Fonction",
    phone: "phone",
    PSeudo: "PSeudo",
    Matricule: "Matricule",
    MatriculeInterne: "MatriculeInterne",
    cni: "cni",
    Email: "Email",
    dnais: "dnais",
    npere: "npere",
    nmere: "nmere",
    vnais: "vnais",
    nurg: "nurg",
    nuurg: "nuurg",
    AgenceBanque: "AgenceBanque",
    CodeBanque: "CodeBanque",
    CodeGuichetBanque: "CodeGuichetBanque",
    NumeroCompteBanque: "NumeroCompteBanque",
    CleRibBanque: "CleRibBanque",
    CodeSwiftBanque: "CodeSwiftBanque",
    CodeUtilisateur: "CodeUtilisateur",
    categorie: "categorie",
    Grade: "Grade",
    Convention: "Convention",
    departement1: "departement1",
    Direction: "Direction",
    SousDirection: "SousDirection",
    Service: "Service",
    motif_depart: "motif_depart",
    date_sortie: "date_sortie",
    date_entree: "date_entree",
    genre_salarie: "genre_salarie",
    type_contrat: "type_contrat",
    IDDate_Contrat: "IDDate_Contrat",
    IDDate_Sortie: "IDDate_Sortie",
    LieuDelivranceCNI: "LieuDelivranceCNI",
    DateExpirationCNI: "DateExpirationCNI",
    IDDateExpirationCNI: "IDDateExpirationCNI",
  };

  Object.entries(data).forEach(([key, value]) => {
    if (key in pers) {
      setValue(pers[key], value, { parent: element });
    }
  });
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

let genreRadio,
  prestataireRadio,
  conformeRadio,
  actif,
  directionFiltre,
  sousDirectionFiltre,
  servicesFiltre,
  gradeFiltre,
  conventionFiltre,
  categorieFiltre,
  fonctionFiltre;
/**
 * Handle the change events of form
 * @param {Event} event The triggering event
 */
function handleChangeEvent(event) {
  const start = categorieForm.querySelector("#date_debut").value;
  const end = categorieForm.querySelector("#date_fin").value;

  if (event.target.name === "date_debut" || event.target.name === "date_fin")
    return;
  if (event.target.name === "genre") genreRadio = event.target.value;
  if (event.target.name === "prestataire")
    prestataireRadio = event.target.value;
  if (event.target.name === "conforme") conformeRadio = event.target.value;
  if (event.target.name === "actif") actif = event.target.checked;
  if (event.target.name === "direction_filtre")
    directionFiltre = event.target.value;
  if (event.target.name === "sous_direction_filtre")
    sousDirectionFiltre = event.target.value;
  if (event.target.name === "services_filtre")
    servicesFiltre = event.target.value;
  if (event.target.name === "grade_filtre") gradeFiltre = event.target.value;
  if (event.target.name === "convention_filtre")
    conventionFiltre = event.target.value;
  if (event.target.name === "categorie_filtre")
    categorieFiltre = event.target.value;
  if (event.target.name === "fonction_filtre")
    fonctionFiltre = event.target.value;

  let output = persData;

  if (directionFiltre) output = useDirectionFilters(directionFiltre, output);
  if (sousDirectionFiltre)
    output = useSousDirectionFilters(sousDirectionFiltre, output);
  if (servicesFiltre) output = useServicesFilters(servicesFiltre, output);
  if (gradeFiltre) output = useGradeFilters(gradeFiltre, output);
  if (conventionFiltre) output = useConventionFilters(conventionFiltre, output);
  if (categorieFiltre) output = useCategorieFilters(categorieFiltre, output);
  if (fonctionFiltre) output = useFonctionFiltrers(fonctionFiltre, output);

  if (actif) output = useDatefilters(start, end, output);
  if (genreRadio) output = useGenreFilters(genreRadio, output);
  if (prestataireRadio)
    output = usePrestataireFilters(prestataireRadio, output);
  if (conformeRadio) output = useConformeFilters(conformeRadio, output);

  persTable.innerHTML = "";
  if (output.length <= 0) return;
  for (let rowData of output)
    updateTable(persTable, rowData, persTableTemplate);
}
/**
 * Filter the data according to the specified direction
 * @param {String} direction Direction to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useDirectionFilters(direction, data) {
  if (direction === "TOUTES" || !direction) return data;
  const direc = {
    MEDICALE: "MEDICALE",
  };
  return data.filter((element) => element.Direction == direc[direction]);
}
/**
 * Filter the data according to the specified sousDirection
 * @param {String} sousDirection Sous-direction to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useSousDirectionFilters(sousDirection, data) {
  if (sousDirection === "TOUTES" || !sousDirection) return data;
  const direc = {
    MEDICALE: "MEDICALE",
  };
  return data.filter(
    (element) => element.SousDirection == direc[sousDirection]
  );
}
/**
 * Filter the data according to the specified services
 * @param {String} services Services to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useServicesFilters(services, data) {
  if (services === "TOUTES" || !services) return data;
  const serv = {
    SSMEDICALE: "SSMEDICALE",
  };
  return data.filter((element) => element.Service == serv[services]);
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
    let dtt = d.dnais,
      dt;
    if (dtt.includes("/")) {
      dt = new Date(dtt.split("/").join("-"));
    } else {
      dt = new Date(dtt);
    }
    return startDate <= dt && dt <= endDate;
  });
}
/**
 * Filter the data according to the specified genres
 * @param {String} genres Genres to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useGenreFilters(genres, data) {
  if (genres === "all" || !genres) return data;
  const sexe = {
    male: 1,
    female: 0,
  };
  return data.filter((element) => element.Sexe == sexe[genres]);
}
/**
 * Filter the data according to the specified prestataire
 * @param {String} prestataire Prestataire to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function usePrestataireFilters(prestataire, data) {
  if (prestataire === "all" || !prestataire) return data;
  const prestat = {
    yes: 1,
    no: 0,
  };
  return data.filter(
    (element) => element.PrestataireExterne == prestat[prestataire]
  );
}
/**
 * Filter the data according to the specified conforme
 * @param {String} conforme Conforme to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useConformeFilters(conforme, data) {
  if (conforme === "all" || !conforme) return data;
  const prestat = {
    yes: 1,
    no: 0,
  };
  return data.filter(
    (element) => element.PrestataireExterne == prestat[conforme]
  );
}