const clientTable = document.getElementById("client_");
const clientTableRows = clientTable.getElementsByTagName("tr");
const clientTableTemplate = document.getElementById("client_table_template");
let clientData = await fetchData();
let dataAction = "";

clientTable.innerHTML = "";
for (let rowData of clientData)
    updateTable(clientTable, rowData, clientTableTemplate);

categorieForm.addEventListener("change", handleChangeEvent);
printTableEmp.addEventListener("click", handlePrintTableClick);
newData.addEventListener("click", handleNewDataClick);
openData.addEventListener("click", () => (dataAction = "open"));
deleteData.addEventListener("click", () => (dataAction = "delete"));

Array.from(clientTableRows).forEach((row) =>
    row.addEventListener("click", handleRowClick)
);

/**
 * Fetches data from the API URL.
 *
 * @return {Promise<Array>} A promise that resolves to the fetched data.
 */
async function fetchData() {
    const response = await fetch(api_url_client);
    const data = await response.json();
    return data;
    //nothing
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
    const client = {
        Civilite:"Civilite",
        Nom: "Nom",
        Prenom:"Prenom",
        TypeClient:"TypeClient",
        Province:"Province",
        Societe:"Societe",
        Site:"Site",
        Telephone:"Telephone",
        Departement:"Departement",
        Arrondissement:"Arrondissement",
        District:"District",
        CodePostale:"CodePostale",
        Ville:"Ville",
        Pays:"Pays",
        Adresse:"Adresse",
        Email:"Email",
        DateContact:"DateContact",
        Titre:"Titre",
        Nationalite:"Nationalite",
        NumeroContribuable:"NumeroContribuable",
        Profession:"Profession",
    };

    Object.entries(data).forEach(([key, value]) => {
        if (key in client) {
            setValue(client[key], value, { parent: element });
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
 * Handle the click events of the btn and print the table contents
 * @param {Event} event The triggering event
 */
function handlePrintTableClick() {
    const print="imprimer le"
    const displayDateTime = new Date().toLocaleDateString(pdfLang, {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
    });
    const nothing=" ";
    const pdf = new jspdf.jsPDF({ orientation: "landscape", format: "a4" });
    pdf.addImage(
        SITE_URL + "/assets/img/iplans logo.png",
        "PNG",
        10,
        10,
        2.969 * 50 * 0.25,
        1 * 50 * 0.25
    );
    const iplans = "\nREGISTRE DES EMPLOYEES";

    const jsonData = pdf.autoTableHtmlToJson(
        document.getElementById("myTable"),
        false
    );

    const printableRows = {
        civilite: 2,
        nom: 3,
        prenom: 4,
        Fonction: 5,
        phone: 6,
        Matricule: 8,
        Email: 11,
        date_entree: 33,
        date_sortie: 32,
    };
    pdf.setFontSize(10);
    pdf.text(iplans+nothing+print+nothing+displayDateTime, 10, 25);
    const filteredData = [];
    const headings = [];

    Object.entries(printableRows).forEach(([key]) => headings.push(key));

    for (const row of jsonData.data) {
        let filteredRow = [];
        Object.entries(printableRows).forEach(([, value]) => {
            filteredRow.push(row[value]);
        });
        filteredData.push(filteredRow);
    }
    pdf.autoTable({
        head: [headings],
        body: filteredData,
        styles: {
            fontSize: 10,
        },
        startY: 35,
    });
    pdf.save("registre employees.pdf");
    return;
}
function handleNewDataClick() { }

/**
 * Handles the click event on a row.
 *
 * @param {Event} event - The click event.
 */
async function handleRowClick(event) {
    const tableRow = event.target.parentNode;
    const rowData = extractDataFromRow(tableRow);
    const id = parseInt(rowData.NEng);
    switch (dataAction) {
        case "open":
            dataAction = "";
            openRowData(tableRow, id);
            break;
        case "delete":
            dataAction = "";
            await deleteRowData(id);
            break;
        default:
            break;
    }
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
    if (services === "TOUS" || !services) return data;
    const serv = {
        SSMEDICALE: "SSMEDICALE",
    };
    return data.filter((element) => element.Service == serv[services]);
}
/**
 * Filter the data according to the specified grade
 * @param {String} grade Grade to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useGradeFilters(grade, data) {
    if (grade === "TOUS" || !grade) return data;
    const grd = {
        CADRE_SUPERIEUR: "CADRE SUPERIEUR",
    };
    return data.filter((element) => element.Grade == grd[grade]);
}
/**
 * Filter the data according to the specified convention
 * @param {String} convention Convention to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useConventionFilters(convention, data) {
    if (convention === "TOUTES" || !convention) return data;
    const conv = {
        departement1: "FONCTION",
    };
    return data.filter((element) => element.Convention == conv[convention]);
}
/**
 * Filter the data according to the specified categorie
 * @param {String} categorie Categorie to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useCategorieFilters(categorie, data) {
    if (categorie === "TOUTES" || !categorie) return data;
    const cat = {
        0: "0",
        "03": "03",
        4: "4",
        6: "6",
        8: "8",
        A: "A",
        I: "I",
        IX: "IX",
        VI: "VI",
        XII: "XII",
    };
    return data.filter((element) => element.categorie == cat[categorie]);
}
/**
 * Filter the data according to the specified fonction
 * @param {String} fonction Fonction to filter
 * @param {Array} data Data to be filterd out
 * @return {Array} Filtered data
 */
function useFonctionFiltrers(fonction, data) {
    if (fonction === "TOUTES" || !fonction) return data;
    const fonc = {
        AGENT_D_ENTRETIEN: "AGENT D'ENTRETIEN",
        AIDE_MAGSINIER: "AIDE MAGSINIER",
        ASSISTANCE_TECHNIQUE: "ASSISTANCE TECHNIQUE",
        CHAUFFEUR_COURRIER: "CHAUFFEUR COURRIER",
        COMMERCIAL: "COMMERCIAL",
        COMPTABLE: "COMPTABLE",
        CHAUFFEUR_LIVREUR: "CHAUFFEUR/LIVREUR",
        CONTROLLEUR_DE_GESTION: "CONTROLLEUR DE GESTION",
        DIRECTEUR_COMMERCIAL: "DIRECTEUR COMMERCIAL",
        DIRECTEUR_GENERAL: "DIRECTEUR GENERAL",
        DIRECTRICE_GENERALE_ADJOINTE: "DIRECTRICE GENERALE ADJOINTE",
        FACTURIERE: "FACTURIERE",
        GARDIEND_DE_NUIT: "GARDIEND DE NUIT",
        HOETESSE_DE_VENTES: "HOETESSE DE VENTES",
        IT: "IT",
        MAGASINIER: "MAGASINIER",
        PEDIATRE: "PEDIATRE",
        PRESTATAIRE: "PRESTATAIRE",
        PROJECT_MANAGER: "PROJECT MANAGER",
        RECEPTIONNISTE: "RECEPTIONNISTE",
        RESPONSABLE_DU_PERSONNEL: "RESPONSABLE DU PERSONNEL",
        RESPONSABLE_D_ENTREPOT: "RESPONSABLE D ENTREPOT",
        RESPONSABLE_PROMO: "RESPONSABLE PROMO",
    };
    return data.filter((element) => element.Fonction == fonc[fonction]);
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
/**
 * Extracts data from a given row and returns an object with the extracted data.
 *
 * @param {HTMLTableRowElement} row - The row from which to extract the data.
 * @return {Object} An object containing the extracted data.
 */
function extractDataFromRow(row) {
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
        NEng: "NEng",
    };
    // const list = Object.keys(pers);
    // let obj = {};
    // list.forEach((item, index) => (obj[item] = row.children[index].textContent));
    // return obj;
}
function openRowData() { }
/**
 *  Delete an employee data from database
 * @param {number} id ID of the data to delete in database
 */
async function deleteRowData(id) {
    const val = await swal({
        icon: "warning",
        title: "Etes-vous sûr de vouloir supprimer?",
        text: "Cette action est irreversible!",
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: {
            cancel: {
                text: "Non!",
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
    const url = SITE_URL + "/forms/formdeletepers.php";
    const response = await postData(url, {}, id);
    if (response["rows"] >= 1 && response["message"])
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

    try {
        const response = await fetch(`${action}/?id=${id}`, options);
        if (!response.ok && response.status !== 200) {
            return { errors: true };
        }
        const responseData = await response.json();
        return responseData;
    } catch (error) {
        return { errors: true };
    }
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
        dangerMode: type === "error",
        timer: type === "error" ? 3500 : 3000,
    });
}
