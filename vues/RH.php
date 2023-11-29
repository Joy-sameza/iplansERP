<?php
$title = 'accueil';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$url = $_SERVER["REQUEST_URI"];
$query = parse_url($url, PHP_URL_QUERY);
if ($query == "lang=en") {
    $_SESSION["lang"] = "en";
    include_once "./lang/en.php";
} else {
    if ($query == NULL) {
        $lanuage = $_SESSION['lang'] ?? 'fr';
        if ($lanuage == 'en') {
            include_once "./lang/en.php";
        }
        if ($lanuage == 'fr') {
            include_once "./lang/fr.php";
        }
    } else {
        $_SESSION["lang"] = "fr";
        include_once "./lang/fr.php";
    }
}


ob_start();
?>


<link href="<?= SITE_URL ?>/assets/css/index5.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/assets/css/styleRH.css" rel="stylesheet">

<main>
    <div class="cont">
        <div class="premier_coter">
            <div class="gestion_sav">
                GESTIONAIRE DES RESSOURCES HUMAINES
            </div>
            <div class="cont_sav">
                <div class="sav_list">
                    <div class="action">
                        <div class="ligne1">
                            <p>Liste des Projects</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Listes des Etapes des Projects</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Votes</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Etats Des Virements</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Evolution Nb.employés /jrs</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Evolution Nb.employés /Mois</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="ligne2">
                            <p>Parametrage Frais de Mission</p>
                            <button class="loupe"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cote_gauche">
            <div class="menu">
                <button class=" mbtn"><i class="fas fa-bars"></i></button>
                <i class="fas fa-times  croix"></i>
            </div>
            <h2>Demo</h2>
            <img src="<?= SITE_URL ?>/assets/image/SAV.webp" alt="">
            <div class="centre_cote_droit">
                <img src="<?= SITE_URL ?>/assets/image/fond 2.webp" alt="">
                <h2>Gestion RH</h2>
                <img src="<?= SITE_URL ?>/assets/image/foncd.webp" alt="">
            </div>

            <img src="<?= SITE_URL ?>/assets/image/SAV 2.webp" alt="">
            <div class="small_contenair">
                <img src="<?= SITE_URL ?>/assets/image/recycle.webp" alt="">
                <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">
            </div>
        </div>

        <div class="cote_droite">
            <button class="cadena"><i class="fas fa-lock"></i> </button>

            <button class="btn employer_btn"> <i class="fas fa-users"></i><a href="<?= SITE_URL ?>/tableau">Employés</a> </button>
            <button class="btn"> <i class="fas fa-save"></i></i>
                <p>Pointages</p>
            </button>
            <button class="btn"> <i class="fas fa-clock"></i></i>
                <p>Planning Horaires</p>
            </button>
            <button class="btn"> <i class="fas fa-unlock-alt"></i>
                <a href="<?= SITE_URL ?>/list_mission">Mission</a>
            </button>
            <button class="btn"> <i class="fas fa-calendar-minus"></i>
                <a href="<?= SITE_URL ?>/list_abscences">Absences</a>
            </button>
            <button class="btn"> <i class="fas fa-suitcase-rolling"></i>
                <p>Congés</p>
            </button>
            <button class="btn"> <i class="fas fa-border-style"></i>
                <p>Cloture</p>
            </button>
            <button class="btn"> <i class="fas fa-dollar-sign"></i>
                <p>Acompte</p>
            </button>
            <button class="btn"> <i class="fas fa-car"></i>
                <p>Parc Auto</p>
            </button>
            <button class="btn"> <i class="fas fa-phone-alt"></i>
                <p>Telephone</p>
            </button>
            <button class="btn"> <i class="fas fa-money-bill"></i>
                <p>Bon de decaissement</p>
            </button>
            <button class="btn"> <i class="fas fa-clock"></i>
                <p>Hooraires</p>
            </button>
            <button class="btn"> <i class="fas fa-users"></i>
                <p>Grille Salariale</p>
            </button>
            <button class="btn"> <i class="fas fa-money-check-alt"></i>
                <p>Salaire</p>
            </button>

        </div>
    </div>

    <footer>
        <div class="license_active">
            <h2>
                license active...
            </h2>
        </div>
        <div class="user_name">
            <h2>
                Connexion normale - user [ YAN ]
            </h2>
            <div class="footer_button">
                <button class="delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>


        </div>
    </footer>
</main>




<div class="cont_employer" style="display: none;">
    <div class="contenue_employers">
        <div class="cont_titre">
            <div style="display: flex;">
                <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" class="ico_emplye">
                <h2 class="fiche_sala">Fiche Salarié</h2>
            </div>

            <div>
                <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> </button>
            </div>
        </div>


        <div class="cont_employer2">
            <div class="list_gauche">
                <div class="se1">
                    <p>Mission</p>
                    <p>Evenements</p>
                    <p>La paie</p>
                    <p>Congés</p>
                </div>
                <div class="se1">
                    <p>Frais de Deplacement</p>
                    <p>Acomptes</p>
                    <p class="divers">Divers</p>
                    <p class="acti">Employés</p>
                </div>
            </div>


            <div class="econte">
                <div class="econte1">
                    <h1 style="background-color: black;color: white;">Employé</h1>
                    <section class="div_1">
                        <h3 style="font-size: 15px;">Identité</h3>
                        <div class="idntite1">
                            <div>
                                <label for="">Civilité</label>
                                <select name="" id="" style="width: 130%;">
                                    <option value="">Monsieur</option>
                                </select>
                                <div style="display: flex; flex-direction: column;">
                                    <h3 style="margin-top: -10px;">sexe</h3>
                                    <div style="display: flex ; gap: 7px; margin-top: -7px;">
                                        <label for="">Masculin</label>
                                        <input type="checkbox" value="Oui">

                                        <label for="">Feminin</label>
                                        <input type="checkbox" value="Oui">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="idntite2">
                            <label for="">Nom</label>
                            <input type="text">
                        </div>
                        <div class="idntite3">
                            <label for="">Prenom</label>
                            <input type="text">
                        </div>
                        <div class="idntite4">
                            <label for="" style="width: 80%">N* Carte national</label>
                            <input type="text">
                            <label for="" style="width: 25%">Fait a</label>
                            <input type="text">
                            <label for="" style="width: 50%">Expire le</label>
                            <input type="date">
                        </div>
                        <div class="idntite5">
                            <label for="">Adresse</label>
                            <input type="text">
                        </div>
                        <div class="idntite6">
                            <label for="">Telephone</label>
                            <input type="tel">
                        </div>
                        <div class="idntite7">
                            <label for="">Telephone Pro~</label>
                            <input type="tel">
                        </div>
                        <div class="idntite8">
                            <label for="">Site (Agence)</label>
                            <select name="" id="">
                                <option value="">DEMO</option>
                            </select>
                        </div>
                        <div class="idntite9">
                            <label for="">Direction </label>
                            <select name="" id="">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="idntite10">
                            <label for="">Sous-Direction </label>
                            <select name="" id="">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="idntite11">
                            <label for="">Service </label>
                            <select name="" id="">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="idntite12">
                            <label for="">Departement </label>
                            <select name="" id="">
                                <option value="">CHAUFFEUR</option>
                            </select>
                        </div>
                        <div class="idntite13">
                            <label for="">Poste Occupé </label>
                            <select name="" id="">
                                <option value="">PROJECT MANAGER</option>
                            </select>
                        </div>
                    </section>







                    <div class="div_2">
                        <h3>Info Personnelles</h3>
                        <div>
                            <div class="te1">
                                <label for="">Date de Naissance</label>
                                <input type="date" name="" id="">
                            </div>
                            <div>
                                <label for="">Date de Naissance</label>
                                <select name="" id="" style="width: 80%; margin-right: 30%;">
                                    <option value="">Dschang</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Nom du Pere</label>
                                <input type="text" name="" id="">
                            </div>
                            <div>
                                <label for="">Nom de la mere</label>
                                <input type="text" name="" id="">
                            </div>
                            <div>
                                <label for="">nom durgence</label>
                                <input type="text" name="" id="">
                            </div>
                            <div>
                                <label for="">Numero D'urgence</label>
                                <input type="tel" name="" id="">
                            </div>
                            <div>
                                <label for="">Adresse email</label>
                                <input type="email" name="" id="">
                            </div>
                            <div>
                                <label for="">Adresse email pro~</label>
                                <input type="email" name="" id="">
                            </div>
                            <div class="situation">
                                <h4>situation matrimonial</h4>
                                <div>
                                    <div style="display: flex; align-items: center;
                                                justify-content: center; margin-top: 20px;">
                                        <label for="">Nombre d'enfants</label>
                                        <input type="number" value="1" class="enfant">
                                    </div>
                                    <div>
                                        <div>

                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <p>Celebataire</p>
                                            <p>Marié</p>
                                            <p>Divorcé</p>
                                            <p>Veuf \ Veuve</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <section class="econte2">
                    <div class="class1">
                        <div class="class2 spec1">
                            <div class="class3">
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <label for="">Prestataire externe ?</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <label for="">Prestataire externe ?</label>
                                </div>
                            </div>
                            <div class="class4">
                                <div>
                                    <label for="">Carte a puce</label>
                                    <div>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    </div>
                                </div>
                                <div>
                                    <label for="">Biometrie</label>
                                    <div>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div style="background-image: url(./fond.png);" class=" spec2">
                            <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                            <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>

                        </div>
                    </div>

                    <div class="class5">
                        <div class="class6">
                            <button class="clicked">Horaires</button>
                            <button>Services</button>
                            <button>Messagerie</button>
                            <button>Biometrie</button>
                        </div>
                        <div class="class7">
                            <div class="class8">
                                <div class="qwe1"><br>
                                    <div class="ligne">
                                        asd
                                    </div>
                                </div>
                                <div class="qwe2">
                                    <div class="activer">
                                        <input type="checkbox" name="" id="">
                                        <p>
                                            Activer
                                        </p>
                                    </div>
                                    <div class="opt">
                                        <div class="option_debut">
                                            <label for="">Début Option</label>
                                            <input type="time" name="" id="">
                                        </div>
                                        <div class="Option_fin">
                                            <label for="">Fin Option</label>
                                            <input type="time" name="" id="">
                                        </div>
                                    </div>
                                    <div class="btn_bas">
                                        <button>Ajouter<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                        <button>Retirer<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    </div>

                                </div>
                            </div>
                            <div class="class9">
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Lundi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Mardi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Mercredi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Jeudi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Vendredi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Samedi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <p>Dimache</p>
                                </div>

                            </div>
                        </div>


                        <div>

                        </div>
                    </div>




                </section>

            </div>
        </div>


        <div class="option">
            <div style="width: 50%; padding-left: 30px;">
                <button>Ajouter</button>
            </div>


            <div style="width: 50%; display: flex; gap: 20px;">
                <button class="btn1">
                    << /button>
                        <button class="btn2">></button>
            </div>

            <div style="width: 100%; display: flex; justify-content: space-around;">
                <button>Recherche</button>
                <button>Imprimer</button>
                <button>Vider</button>
            </div>

            <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                <button class="Fermer">Fermer</button>
            </div>

        </div>

    </div>
</div>


<div class="divers_cont" style="display: none;">
    <main>
        <div class="cont_employer">
            <div class="contenue_employers">
                <div class="cont_titre">
                    <div style="display: flex;">
                        <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" class="ico_emplye">
                        <h2 class="fiche_sala">Fiche Salarié</h2>
                    </div>

                    <div>
                        <button class="close_window2" style="width: 30px; height: 30px; background-color: red; border: none;"> </button>
                    </div>
                </div>


                <div class="cont_employer2">
                    <div class="list_gauche">
                        <div class="se1">
                            <p>Mission</p>
                            <p>Evenements</p>
                            <p>La paie</p>
                            <p>Congés</p>
                        </div>
                        <div class="se1">
                            <p>Frais de Deplacement</p>
                            <p>Acomptes</p>
                            <p class="acti">Divers</p>
                            <p class="employers_btn">Employés</p>
                        </div>
                    </div>


                    <div class="econte" style="zoom: 89%;">
                        <div class="econte1">
                            <h1 style="background-color: black;">Divers</h1>
                            <div style="padding-top: 10px;">
                                <button>Categorie</button>
                                <button>Banque</button>
                            </div>
                            <div class="Autre"> <!--le carre autre commence ici -->
                                <p>
                                    <b>Autres</b>
                                </p>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Convention Collective</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="" id="" style="width: 150px;"></select>
                                            <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <label for="">Echellon</label>
                                        <select name="" id="" style="width: 100%;">
                                            <option value="">E</option>
                                        </select>
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                </div><!--ligne 1 fini ici-->


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content:space-between; align-items: center; width: 100%; ">
                                        <p>Categorie</p>
                                        <div style="display: flex; justify-content: left; width: 50%; gap: 7px;">
                                            <select name="" id="" style="width: 150px;">
                                                <option value="">VI</option>
                                            </select>
                                            <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <label for="">Indice</label>
                                        <select name="" id="" style="width: 100%;">
                                            <option value="">E</option>
                                        </select>
                                        <button style="height: 20px; height: 20px;"><img src="./image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Salaire De base Par semaine</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="text">
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="" id="">
                                        <label for=""><b>logé</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Heure par Semaine</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="" id="" style="width: 140px;">
                                                <option value="">0</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="" id="">
                                        <label for=""><b>Nourie</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Taux Horaires</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="" id="" style="width: 140px;">
                                                <option value="">0</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="" id="">
                                        <label for=""><b>Assuré</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Cumul Heure</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="text" name="" id="">
                                        </div>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Grade de Salairié</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="text" name="" id="" style="width: 70%; ">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="width: 100%;  height: 200px; "><!--Diplomes-->
                                <p>
                                    <b>Diplomes</b>
                                </p>
                                <div style="display: flex; justify-content: right; align-items: end;  width: 100%;
                                            height: 80%;">
                                    <div style="display: flex; flex-direction: column; align-items: end; justify-content: space-between; height: 100%;">
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                    <div style="width: 100%; height: 100%; padding-top: 10px;">
                                        <div style="width: 100%; height: 100%; border: 1px solid black;">
                                            <div style="display: flex; width: 100%; background-color: black; color: white; ">
                                                <p style="width: 50%;  padding-left: 5px; text-align: center;">Nom</p>
                                                <p style="width: 25%; padding-left: 5px; text-align: center;">Année</p>
                                                <p style="width: 25%; padding-left: 5px; text-align: center;">Mention</p>
                                            </div>
                                            <div style="display: flex; width: 100%; background-color: #2169ec; height: 30px;">
                                                <p style="width: 50%;  padding-left: 5px;"></p>
                                                <p style="width: 25%; padding-left: 5px;"></p>
                                                <p style="width: 25%; padding-left: 5px;"></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div> <!--contrat-->
                                <p>
                                    <b>Contrat</b>
                                </p>
                                <div style="display: flex; align-items: center; justify-content: space-around;">
                                    <label for="">Genre de Salarié</label>
                                    <select name="" id=""></select>
                                    <button style="height: 20px; height: 20px;"><img src="./image/la terre.webp" alt="" style="width: 20px;"></button>
                                    <label for="">Type De Contrat</label>
                                    <select name="" id="">
                                        <option value="">
                                            CDD
                                        </option>
                                    </select>
                                    <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">Identifiant Interne</label>
                                    <input type="text" name="" id="" style=" width: 60%;">
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">Matricule Interne</label>
                                    <input type="text" name="" id="" style=" width: 60%;">
                                </div>
                                <div style="width: 100%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="" style=" width: 30%;">Matricule Social (CNPS)</label>
                                    <input type="text" name="" id="" style=" width: 40%;">
                                    <label for="" style="width: 20%; padding-left: 10px;">N* Enreg</label>
                                    <input type="number" style="width: 15%;">
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">NIU (Impots)</label>
                                    <input type="text" name="" id="" style=" width: 60%;">
                                </div>
                                <div>
                                    <p>
                                        <b>Entrée</b>
                                    </p>
                                    <div style="width: 40%;   display: flex; justify-content: space-around;">
                                        <label for="">Entrée</label>
                                        <input type="date" name="" id="">
                                    </div>
                                    <div style="width: 40%;  display: flex; justify-content: space-around;">
                                        <label for="">Date de Contrat</label>
                                        <input type="date" name="" id="">
                                    </div>
                                </div>
                                <div>
                                    <p>
                                        <b>Depart</b>
                                    </p>
                                    <div style="width: 50%;   display: flex; justify-content: space-evenly; align-items: center;">
                                        <label for="" style="width: 100%; ">Date de Depart</label>
                                        <input type="date" name="" id="" style="width: 500px;">
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <label for="">Archivé</label>
                                        </div>
                                    </div>
                                    <div style="width: 40%;   display: flex; justify-content: space-around;">
                                        <label for="">Motif De Depart</label>
                                        <input type="text" name="" id="">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="econte2">
                            <div class="class1">
                                <div class="class2 spec1">
                                    <div class="class3">
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <label for="">Prestataire externe ?</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <label for="">Prestataire externe ?</label>
                                        </div>
                                    </div>
                                    <div class="class4">
                                        <div>
                                            <label for="">Carte a puce</label>
                                            <div>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="">Biometrie</label>
                                            <div>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div style="background-image: url(./fond.png);" class=" spec2">
                                    <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>

                                </div>
                            </div>

                            <div class="class5">
                                <div class="class6">
                                    <button class="clicked">Horaires</button>
                                    <button>Services</button>
                                    <button>Messagerie</button>
                                    <button>Biometrie</button>
                                </div>
                                <div class="class7">
                                    <div class="class8">
                                        <div class="qwe1"><br>
                                            <div class="ligne">
                                                asd
                                            </div>
                                        </div>
                                        <div class="qwe2">
                                            <div class="activer">
                                                <input type="checkbox" name="" id="">
                                                <p>
                                                    Activer
                                                </p>
                                            </div>
                                            <div class="opt">
                                                <div class="option_debut">
                                                    <label for="">Début Option</label>
                                                    <input type="time" name="" id="">
                                                </div>
                                                <div class="Option_fin">
                                                    <label for="">Fin Option</label>
                                                    <input type="time" name="" id="">
                                                </div>
                                            </div>
                                            <div class="btn_bas">
                                                <button>Ajouter<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                                <button>Retirer<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="class9">
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Lundi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Mardi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Mercredi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Jeudi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Vendredi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Samedi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <p>Dimache</p>
                                        </div>

                                    </div>
                                </div>


                                <div>

                                </div>
                            </div>

                        </section>

                    </div>
                </div>


                <div class="option">
                    <div style="width: 50%; padding-left: 30px;">
                        <button>Ajouter</button>
                    </div>


                    <div style="width: 50%; display: flex; gap: 20px;">
                        <button class="btn1">
                            << /button>
                                <button class="btn2">></button>
                    </div>

                    <div style="width: 100%; display: flex; justify-content: space-around;">
                        <button>Recherche</button>
                        <button>Imprimer</button>
                        <button>Vider</button>
                    </div>

                    <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                        <button class="Fermerr">Fermer</button>
                    </div>

                </div>

            </div>
        </div>
    </main>
</div>


























<script>
    const care1 = document.querySelector(".mbtn");
    const element1 = document.querySelector(".premier_coter");
    const element2 = document.querySelector(".croix");
    care1.addEventListener("click", () => {
        element1.classList.add("disparait");
        element2.classList.add("visible");
    });
</script>
<script>
    const ferme = document.querySelector(".Fermer");
    const cont_employer = document.querySelector(".cont_employer");
    const Diver_cont = document.querySelector(".divers_cont");
    ferme.addEventListener("click", () => {
        cont_employer.style.display = "none";
        Diver_cont.style.display = "none";
    });
</script>
<script>
    const fermer = document.querySelector(".Fermerr");
    const cont_employerr = document.querySelector(".cont_employer");
    const Diver_contr = document.querySelector(".divers_cont");
    fermer.addEventListener("click", () => {
        cont_employer.style.display = "none";
        Diver_cont.style.display = "none";
    });
</script>
<script>
    const diverBtn = document.querySelector(".divers");
    const cont_diver = document.querySelector(".divers_cont");
    diverBtn.addEventListener("click", () => {
        cont_diver.style.display = "flex";
    })
</script>
<script>
    const emploBtn = document.querySelector(".employers_btn");
    const cont_divers = document.querySelector(".divers_cont");
    emploBtn.addEventListener("click", () => {
        cont_divers.style.display = "none";
    })
</script>
<script>
    const close_window = document.querySelector(".close_window");
    const cont_employe = document.querySelector(".cont_employer");
    close_window.addEventListener("click", () => {
        cont_employe.style.display = "none";
    });
</script>
<script>
    const close_window2 = document.querySelector(".close_window2");
    const cont_employe2 = document.querySelector(".cont_employer");
    const Diver_contr2 = document.querySelector(".divers_cont");
    close_window2.addEventListener("click", () => {
        cont_employe2.style.display = "none";
        Diver_contr2.style.display = "none";
    });
</script>
<script>
    const employer = document.querySelector(".employer_btn");
    const cont_emp = document.querySelector(".cont_employer");
    employer.addEventListener("click", () => {
        cont_emp.style.display = "flex";
    });
</script>

<script>
    const croix = document.querySelector(".croix");
    const Supprime = document.querySelector(".premier_coter");

    croix.addEventListener("click", () => {
        Supprime.classList.remove("disparait"); // Supprime la classe "disparait"
        croix.classList.remove("visible");
    });
</script>

<?php
$content = ob_get_clean();
include 'layout.php';
?>