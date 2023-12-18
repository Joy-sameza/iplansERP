<?php
class Personne
{
    //DB require stuff
    private $conn;
    private $table = 'pers';

    //Properties for pers
    public $courrierId;
    public $site;
    public $date;

    public $indexe;
    public $codebanque;
    public $civilite;
    public $nom;
    public $prenom;
    public $grade;
    public $assurance;
    public $matricule;
    public $matriculeinterne;
    public $cni;
    public $lieudelivrancecni;
    public $dateexpirationcni;
    public $ddateexpirationcni;
    public $departement;
    public $departement1;
    public $direction;
    public $sousdirection;
    public $service;
    public $email;
    public $emailprofessionnel;
    public $agencebanque;
    public $codeguichetbanque;
    public $codeswiftbanque;
    public $numerocomptebanque;
    public $cleribbanque;
    public $agence;
    public $phone;
    public $telephoneprofessionnel;
    public $adresse;
    public $fonction;
    public $foto;
    public $sexe;
    public $signaturenumerique;
    public $fingerprint1;
    public $fingerprint2;
    public $fingerprint3;
    public $fingerprint4;
    public $image;
    public $signature;
    public $status;
    public $typepers;
    public $badge;
    public $dnais;
    public $iddatenaissance;
    public $npere;
    public $nmere;
    public $vnais;
    public $nurg;
    public $nuurg;
    public $threadindex;
    public $threadindex1;
    public $lundi;
    public $mardi;
    public $mercedi;
    public $jeudi;
    public $vendredi;
    public $samedi;
    public $dimanche;
    public $prestataireexterne;
    public $vue;
    public $supp;
    public $modif_pointage;
    public $reccuperation;
    public $convention;
    public $categorie;
    public $echelon;
    public $indice;
    public $salairebasemensuel;
    public $taux_h;
    public $heureshebdo;
    public $loge;
    public $nourri;
    public $genre_salarie;
    public $date_entree;
    public $iddate_Entree;
    public $date_contrat;
    public $iddate_contrat;
    public $iddate_Sortie;
    public $type_contrat;
    public $date_sortie;
    public $motif_depart;
    public $majconges;
    public $archive;
    public $afficheplanning;
    public $situationmatrimoniale;
    public $nombreenfant;
    public $pseudo;
    public $saisietpv;
    public $encaissementtpv;
    public $synchronization;
    public $nbmails;
    public $numeroordresocial;
    public $lastupdatetime;
    public $idlastupdate;
    public $userlastupdatetime;
    public $codeagence;
    public $codeutilisateur;
    public $datetime;
    public $numerosocial;
    public $numerocontribuable;
    public $indexcarteapuce;
    public $indexcompta;
    public $indexcomptaacompte;
    public $indexcomptaopposition;
    public $pointagepc;
    public $conforme;
    public $iddatetime;
    public $userdatetime;
    public $archiveiddate;
    public $archivedate;
    public $archiveuser;
    public $archivemotif;
    public $archivedefinitive;
    public $archivedefinitiveiddate;
    public $archivedefinitivedate;
    public $archivedefinitiveuser;
    public $archivedefinitivemotif;
    public $iddateexpirationcni;

    /**
     * Constructor for the class.
     *
     * @param Database $connection The database connection object.
     */
    public function __construct(Database $connection)
    {
        $this->conn = $connection->connect();
    }

    /**
     * Retrieves all available couriers from the database.
     *
     * @return array An array of couriers.
     */
    public function getAll(): array
    {
        // Build the SQL query to select all rows from the table
        $query = "SELECT * FROM  {$this->table} where supp=0";

        // Execute the query and retrieve the result set
        $stmt = $this->conn->query($query);

        // Initialize an empty array to store the retrieved data
        $data = [];

        // Loop through each row in the result set
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Add the row to the data array
            array_push($data, $row);
        }

        // Return the data array
        return $data;
    }

    public function getAllSite(): array
    {
        // Build the SQL query to select all rows from the table
        $query = 'SELECT `Site` FROM siteiplans';

        // Execute the query and retrieve the result set
        $stmt = $this->conn->query($query);

        // Initialize an empty array to store the retrieved data
        $data = $formatter  = [];

        // Loop through each row in the result set
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Add the row to the data array
            array_push($data, $row);
        }

        foreach ($data as $d) {
            array_push($formatter, $d["Site"]);
        }
        // Return the data array
        return $formatter;
    }

    /**
     * Retrieve a specific courier from the database.
     *
     * @param int $courierId The ID of the courier to retrieve.
     *
     * @return array|false The data of the courier if found, false otherwise.
     */
    public function get($courierId): array | false
    {
        // Prepare the SQL query
        $query = "SELECT * FROM {$this->table} WHERE NEng = :courierId and supp = 0";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':courierId', $courierId, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Fetch the data
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if data exists
        if ($data !== false) {
            return $data;
        }

        return false;
    }

    // Create a new courrier
    public function create(array $data): string | false
    {
        $query = "INSERT INTO {$this->table} 
                    SET  
    Site = :site,
    Indexe = :indexe,
    civilite= :civilite,
    nom= :nom,
    prenom= :prenom ,
    Grade= :grade,
    Assurance= :assurance,
    Matricule= :matricule,
    MatriculeInterne= :matriculeinterne,
    cni= :cni,
    LieuDelivranceCNI= :lieudelivrancecni,
    DateExpirationCNI= :dateexpirationcni,
    IDDateExpirationCNI= :iddateexpirationcni,
    departement= :departement,
    departement1= :departement1,
    Direction= :direction,
    SousDirection= :sousdirection,
    Service= :service,
    Email= :email,
    EmailProfessionnel= :emailprofessionnel,
    AgenceBanque= :agencebanque,
    CodeBanque= :codebanque ,
    CodeGuichetBanque= :codeguichetbanque,
    CodeSwiftBanque= :codeswiftbanque,
    NumeroCompteBanque= :numerocomptebanque,
    CleRibBanque= :cleribbanque,
    phone= :phone,
    agence= :agence,
    TelephoneProfessionnel= :telephoneprofessionnel,
    Adresse= :adresse,
    Fonction= :fonction,
    foto= :foto,
    Sexe= :sexe,
    SignatureNumerique= :signaturenumerique,
    FingerPrint1= :fingerprint1,
    FingerPrint2= :fingerprint2,
    FingerPrint3= :fingerprint3,
    FingerPrint4= :fingerprint4,
    image= :image,
    signature=  :signature,
    STATUS= :status,
    TypePers= :typepers,
    badge= :badge ,
    dnais= :dnais,
    IDDateNaissance= :iddatenaissance,
    npere= :npere,
    nmere= :nmere,
    vnais= :vnais,
    nurg= :nurg,
    nuurg= :nuurg,
    THREADINDEX= :threadindex,
    THREADINDEX1= :threadindex1,
    LUNDI= :lundi,
    MARDI= :mardi,
    MERCREDI= :mercedi,
    JEUDI= :jeudi,
    VENDREDI= :vendredi,
    SAMEDI= :samedi,
    DIMANCHE= :dimanche,
    PrestataireExterne= :prestataireexterne,
    VUE= :vue,
    SUPP= :supp,
    modif_pointage= :modif_pointage,
    reccuperation= :reccuperation,
    Convention= :convention,
    categorie= :categorie,
    Echelon= :echelon,
    Indice= :indice,
    SalaireBaseMensuel= :salairebasemensuel,
    taux_h= :taux_h,
    HeuresHebdo= :heureshebdo,
    loge= :loge,
    nourri= :nourri,
    genre_salarie= :genre_salarie,
    date_entree= :date_entree,
    IDDate_Entree= :iddate_Entree,
    date_contrat= :date_contrat,
    IDDate_Contrat= :iddate_contrat,
    date_sortie= :date_sortie,
    IDDate_Sortie= :iddate_Sortie,
    type_contrat= :type_contrat,
    motif_depart= :motif_depart,
    majconges= :majconges,
    archive= :archive,
    AffichePlanning= :afficheplanning,
    SituationMatrimoniale= :situationmatrimoniale,
    NombreEnfant= :nombreenfant,
    PSeudo= :pseudo,
    SaisieTPV= :saisietpv,
    EncaissementTPV= :encaissementtpv,
    Synchronization= :synchronization,
    NbMails= :nbmails,
    NumeroOrdreSocial= :numeroordresocial,
    LastUpDateTime= :lastupdatetime,
    IDLastUpDate= :idlastupdate,
    UserLastUpDateTime= :userlastupdatetime,
    CodeAgence= :codeagence,
    CodeUtilisateur= :codeutilisateur,
    DateTime= :datetime,
    NumeroSocial= :numerosocial,
    NumeroContribuable= :numerocontribuable,
    IndexCarteAPuce= :indexcarteapuce,
    IndexCompta= :indexcompta,
    IndexComptaAcompte= :indexcomptaacompte,
    IndexComptaOpposition= :indexcomptaopposition,
    PointagePC= :pointagepc,
    Conforme= :conforme,
    IDDateTime= :iddatetime,
    UserDateTime= :userdatetime,
    ArchiveIDDate= :archiveiddate,
    ArchiveDate= :archivedate,
    ArchiveUser= :archiveuser,
    ArchiveMotif= :archivemotif,
    ArchiveDefinitive= :archivedefinitive,
    ArchiveDefinitiveIDDate= :archivedefinitiveiddate,
    ArchiveDefinitiveDate= :archivedefinitivedate,
    ArchiveDefinitiveUser= :archivedefinitiveuser,
    ArchiveDefinitiveMotif= :archivedefinitivemotif
    

                ";
        $stmt = $this->conn->prepare($query);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $login = $_SESSION["login"]["nom"] ?? "NONO";

        $setting_query = "SELECT Site FROM utilisateurs WHERE nom = '{$login}'";
        $setting_stmt = $this->conn->query($setting_query);
        $site = $setting_stmt->fetch(PDO::FETCH_ASSOC);

        $code_agence_query = "SELECT `CodeAgence` FROM settings WHERE `Site` = '{$site['Site']}'";
        $code_agence_stmt = $this->conn->query($code_agence_query);
        $codeAgence = $code_agence_stmt->fetch(PDO::FETCH_ASSOC);

        //data

        $this->civilite = htmlspecialchars(strip_tags($data['civilite']?? 0));
        $this->nom = htmlspecialchars(strip_tags($data['nom']?? 0));
        $this->prenom = htmlspecialchars(strip_tags($data['prenom']?? 0));
        $this->grade = htmlspecialchars(strip_tags($data['Grade'] ?? 0));
        $this->assurance = htmlspecialchars(strip_tags($data['Assurance'] ?? 0));
        $this->matricule = htmlspecialchars(strip_tags($data['Matricule']?? 0));
        $this->matriculeinterne = htmlspecialchars(strip_tags($data['MatriculeInterne']?? 0));
        $this->cni = htmlspecialchars(strip_tags($data['cni']?? 0));
        $this->lieudelivrancecni = htmlspecialchars(strip_tags($data['LieuDelivranceCNI']?? 0));
        $this->dateexpirationcni = htmlspecialchars(strip_tags($data['DateExpirationCNI']?? 0));
        $this->iddateexpirationcni = htmlspecialchars(strip_tags($data['IDDateExpirationCNI'] ?? 0));
        $this->departement = htmlspecialchars(strip_tags($data['departement']?? 0));
        $this->departement1 = htmlspecialchars(strip_tags($data['departement1']?? 0));
        $this->direction = htmlspecialchars(strip_tags($data['Direction']?? 0));
        $this->sousdirection = htmlspecialchars(strip_tags($data['SousDirection']?? 0));
        $this->service = htmlspecialchars(strip_tags($data['Service']?? 0));
        $this->email = htmlspecialchars(strip_tags($data['Email']?? 0));
        $this->emailprofessionnel = htmlspecialchars(strip_tags($data['EmailProfessionnel']?? 0));
        $this->agencebanque = htmlspecialchars(strip_tags($data['AgenceBanque'] ?? 0));
        $this->codebanque = htmlspecialchars(strip_tags($data['CodeBanque'] ?? 0));
        $this->codeguichetbanque = htmlspecialchars(strip_tags($data['CodeGuichetBanque'] ?? 0));
        $this->codeswiftbanque = htmlspecialchars(strip_tags($data['CodeSwiftBanque'] ?? 0));
        $this->numerocomptebanque = htmlspecialchars(strip_tags($data['NumeroCompteBanque'] ?? 0));
        $this->cleribbanque = htmlspecialchars(strip_tags($data['CleRibBanque'] ??  0));
        $this->phone = htmlspecialchars(strip_tags($data['phone']?? 0));
        $this->agence = htmlspecialchars(strip_tags($data['agence'] ?? "DEMO"));
        $this->telephoneprofessionnel = htmlspecialchars(strip_tags($data['TelephoneProfessionnel'] ?? 0));
        $this->adresse = htmlspecialchars(strip_tags($data['Adresse'] ?? 0));
        $this->fonction = htmlspecialchars(strip_tags($data['Fonction'] ?? 0));
        $this->foto = htmlspecialchars(strip_tags($data['foto'] ?? 0));
        $this->sexe = htmlspecialchars(strip_tags($data['Sexe']?? 0));
        $this->signaturenumerique = htmlspecialchars(strip_tags($data['SignatureNumerique'] ?? 0));
        $this->fingerprint1 = htmlspecialchars(strip_tags($data['FingerPrint1'] ?? 0));
        $this->fingerprint2 = htmlspecialchars(strip_tags($data['FingerPrint2'] ?? 0));
        $this->fingerprint3 = htmlspecialchars(strip_tags($data['FingerPrint3'] ?? 0));
        $this->fingerprint4 = htmlspecialchars(strip_tags($data['FingerPrint4'] ?? 0));
        $this->image = htmlspecialchars(strip_tags($data['image'] ?? 0));
        $this->signature = htmlspecialchars(strip_tags($data['signature'] ?? 0));
        $this->status = htmlspecialchars(strip_tags($data['STATUS'] ?? 0));
        $this->typepers = htmlspecialchars(strip_tags($data['TypePers'] ?? 0));
        $this->badge = htmlspecialchars(strip_tags($data['badge'] ?? 0));
        $this->dnais = htmlspecialchars(strip_tags($data['dnais'] ?? 0));
        $this->iddatenaissance = htmlspecialchars(strip_tags($data['IDDateNaissance'] ?? 0000));
        $this->npere = htmlspecialchars(strip_tags($data['npere'] ?? 0));
        $this->nmere = htmlspecialchars(strip_tags($data['nmere'] ?? 0));
        $this->vnais = htmlspecialchars(strip_tags($data['vnais'] ?? 0));
        $this->nurg = htmlspecialchars(strip_tags($data['nurg'] ?? 0));
        $this->nuurg = htmlspecialchars(strip_tags($data['nuurg'] ?? 0));
        $this->threadindex = htmlspecialchars(strip_tags($data['THREADINDEX'] ?? 0));
        $this->threadindex1 = htmlspecialchars(strip_tags($data['THREADINDEX1'] ?? 0));
        $this->lundi = htmlspecialchars(strip_tags($data['LUNDI'] ?? 0));
        $this->mardi = htmlspecialchars(strip_tags($data['MARDI'] ?? 0));
        $this->mercedi = htmlspecialchars(strip_tags($data['MERCREDI'] ?? 0));
        $this->jeudi = htmlspecialchars(strip_tags($data['JEUDI'] ?? 0));
        $this->vendredi = htmlspecialchars(strip_tags($data['VENDREDI'] ?? 0));
        $this->samedi = htmlspecialchars(strip_tags($data['SAMEDI'] ?? 0));
        $this->dimanche = htmlspecialchars(strip_tags($data['DIMANCHE'] ?? 0));
        $this->prestataireexterne = htmlspecialchars(strip_tags($data['PrestataireExterne'] ?? 0));
        $this->vue = htmlspecialchars(strip_tags($data['VUE'] ?? 0));
        $this->supp = htmlspecialchars(strip_tags($data['SUPP'] ?? 0));
        $this->modif_pointage = htmlspecialchars(strip_tags($data['modif_pointage'] ?? 0));
        $this->reccuperation = htmlspecialchars(strip_tags($data['reccuperation'] ?? 0));
        $this->convention = htmlspecialchars(strip_tags($data['Convention'] ?? 0));
        $this->categorie = htmlspecialchars(strip_tags($data['categorie'] ?? 0));
        $this->echelon = htmlspecialchars(strip_tags($data['Echelon'] ?? 0));
        $this->indice = htmlspecialchars(strip_tags($data['Indice'] ?? 0));
        $this->salairebasemensuel = htmlspecialchars(strip_tags($data['SalaireBaseMensuel'] ?? 0));
        $this->taux_h = htmlspecialchars(strip_tags($data['taux_h'] ?? 0));
        $this->heureshebdo = htmlspecialchars(strip_tags($data['HeuresHebdo'] ?? 0));
        $this->loge = htmlspecialchars(strip_tags($data['loge'] ?? 0));
        $this->nourri = htmlspecialchars(strip_tags($data['nourri'] ?? 0));
        $this->genre_salarie = htmlspecialchars(strip_tags($data['genre_salarie'] ?? 0));
        $this->date_entree = htmlspecialchars(strip_tags($data['date_entree'] ?? 0));
        $this->iddate_Entree = htmlspecialchars(strip_tags($data['IDDate_Entree'] ?? 0));
        $this->date_contrat = htmlspecialchars(strip_tags($data['date_contrat'] ?? 0));
        $this->iddate_contrat = htmlspecialchars(strip_tags($data['IDDate_Contrat'] ?? 0));
        $this->date_sortie = htmlspecialchars(strip_tags($data['date_sortie'] ?? 0));
        $this->iddate_Sortie = htmlspecialchars(strip_tags($data['IDDate_Sortie'] ?? 0));
        $this->type_contrat = htmlspecialchars(strip_tags($data['type_contrat'] ?? 0));
        $this->motif_depart = htmlspecialchars(strip_tags($data['motif_depart'] ?? 0));
        $this->majconges = htmlspecialchars(strip_tags($data['majconges'] ?? 0));
        $this->archive = htmlspecialchars(strip_tags($data['archive'] ?? 0));
        $this->afficheplanning = htmlspecialchars(strip_tags($data['AffichePlanning'] ?? 0));
        $this->situationmatrimoniale = htmlspecialchars(strip_tags($data['SituationMatrimoniale'] ?? 0));
        $this->nombreenfant = htmlspecialchars(strip_tags($data['NombreEnfant'] ?? 0));
        $this->pseudo = htmlspecialchars(strip_tags($data['PSeudo'] ?? 0));
        $this->saisietpv = htmlspecialchars(strip_tags($data['SaisieTPV'] ?? 0));
        $this->encaissementtpv = htmlspecialchars(strip_tags($data['EncaissementTPV'] ?? 0));
        $this->synchronization = htmlspecialchars(strip_tags($data['Synchronization'] ?? 0));
        $this->nbmails = htmlspecialchars(strip_tags($data['NbMails'] ?? 0));
        $this->numeroordresocial = htmlspecialchars(strip_tags($data['NumeroOrdreSocial'] ?? 0));
        $this->codeutilisateur = htmlspecialchars(strip_tags($data['CodeUtilisateur'] ?? 0));
        $this->numerosocial = htmlspecialchars(strip_tags($data['NumeroSocial'] ?? 0));
        $this->numerocontribuable = htmlspecialchars(strip_tags($data['NumeroContribuable'] ?? 0));
        $this->indexcarteapuce = htmlspecialchars(strip_tags($data['IndexCarteAPuce'] ?? 0));
        $this->indexcompta = htmlspecialchars(strip_tags($data['IndexCompta'] ?? 0));
        $this->indexcomptaacompte = htmlspecialchars(strip_tags($data['IndexComptaAcompte'] ?? 0));
        $this->indexcomptaopposition = htmlspecialchars(strip_tags($data['IndexComptaOpposition'] ?? 0));
        $this->pointagepc = htmlspecialchars(strip_tags($data['PointagePC'] ?? 0));
        $this->conforme = htmlspecialchars(strip_tags($data['Conforme'] ?? 0));
        $this->archivedate = htmlspecialchars(strip_tags($data['ArchiveDate'] ?? 0));
        $this->archiveiddate = htmlspecialchars(strip_tags($data['ArchiveIDDate'] ?? 0));
        $this->archiveuser = htmlspecialchars(strip_tags($data['ArchiveUser'] ?? 0));
        $this->archivemotif = htmlspecialchars(strip_tags($data['ArchiveMotif'] ?? 0));
        $this->archivedefinitive = htmlspecialchars(strip_tags($data['ArchiveDefinitive'] ?? 0));
        $this->archivedefinitivedate = htmlspecialchars(strip_tags($data['ArchiveDefinitiveDate'] ?? 0));
        $this->archivedefinitiveiddate = htmlspecialchars(strip_tags($data['ArchiveDefinitiveIDDate'] ?? 0));
        $this->archivedefinitiveuser = htmlspecialchars(strip_tags($data['ArchiveDefinitiveUser'] ?? 0));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($data['ArchiveDefinitiveMotif'] ?? 0));


        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;


        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime) ?? 0;
        $iddateexpirationcni = strtotime($this->dateexpirationcni) ?? 0;
        $iddatenaissance = strtotime($this->dnais) ?? 0;
        $iddate_Entree = strtotime($this->date_entree) ?? 0;
        $iddate_contrat = strtotime($this->date_contrat) ?? 0;
        $iddate_Sortie = strtotime($this->date_sortie) ?? 0;
        $archiveiddate = strtotime($this->archivedate) ?? 0;
        $archivedefinitiveiddate = strtotime($this->archivedefinitivedate) ?? 0;

        $txt = "New";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;


        //Bind data
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userlastupdatetime', $userdatetime, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':indexe', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':codeagence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':site', $site['Site'], PDO::PARAM_STR);
        $stmt->bindParam(':civilite', $this->civilite, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $this->grade, PDO::PARAM_STR);
        $stmt->bindParam(':assurance', $this->assurance, PDO::PARAM_STR);
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':matriculeinterne', $this->matriculeinterne, PDO::PARAM_STR);
        $stmt->bindParam(':cni', $this->cni, PDO::PARAM_INT);
        $stmt->bindParam(':lieudelivrancecni', $this->lieudelivrancecni, PDO::PARAM_STR);
        $stmt->bindParam(':dateexpirationcni', $this->dateexpirationcni, PDO::PARAM_STR);
        $stmt->bindParam(':iddateexpirationcni', $iddateexpirationcni, PDO::PARAM_INT);
        $stmt->bindParam(':departement', $this->departement, PDO::PARAM_STR);
        $stmt->bindParam(':departement1', $this->departement1, PDO::PARAM_STR);
        $stmt->bindParam(':direction', $this->direction, PDO::PARAM_STR);
        $stmt->bindParam(':sousdirection', $this->sousdirection, PDO::PARAM_STR);
        $stmt->bindParam(':service', $this->service, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':emailprofessionnel', $this->emailprofessionnel, PDO::PARAM_STR);
        $stmt->bindParam(':agencebanque', $this->agencebanque, PDO::PARAM_STR);
        $stmt->bindParam(':codebanque', $this->codebanque, PDO::PARAM_STR);
        $stmt->bindParam(':codeguichetbanque', $this->codeguichetbanque, PDO::PARAM_STR);
        $stmt->bindParam(':codeswiftbanque', $this->codeswiftbanque, PDO::PARAM_STR);
        $stmt->bindParam(':numerocomptebanque', $this->numerocomptebanque, PDO::PARAM_INT);
        $stmt->bindParam(':cleribbanque', $this->cleribbanque, PDO::PARAM_STR);
        $stmt->bindParam(':agence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $this->phone, PDO::PARAM_INT);
        $stmt->bindParam(':telephoneprofessionnel', $this->telephoneprofessionnel, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $this->adresse, PDO::PARAM_STR);
        $stmt->bindParam(':fonction', $this->fonction, PDO::PARAM_INT);
        $stmt->bindParam(':foto', $this->foto, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $this->sexe, PDO::PARAM_STR);
        $stmt->bindParam(':signaturenumerique', $this->signaturenumerique, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint1', $this->fingerprint1, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint2', $this->fingerprint2, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint3', $this->fingerprint3, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint4', $this->fingerprint4, PDO::PARAM_STR);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':signature', $this->signature, PDO::PARAM_INT);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':typepers', $this->typepers, PDO::PARAM_STR);
        $stmt->bindParam(':badge', $this->badge, PDO::PARAM_STR);
        $stmt->bindParam(':dnais', $this->dnais, PDO::PARAM_STR);
        $stmt->bindParam(':iddatenaissance', $iddatenaissance, PDO::PARAM_INT);
        $stmt->bindParam(':npere', $this->npere, PDO::PARAM_STR);
        $stmt->bindParam(':nmere', $this->nmere, PDO::PARAM_STR);
        $stmt->bindParam(':vnais', $this->vnais, PDO::PARAM_STR);
        $stmt->bindParam(':nurg', $this->nurg, PDO::PARAM_STR);
        $stmt->bindParam(':nuurg', $this->nuurg, PDO::PARAM_STR);
        $stmt->bindParam(':threadindex', $this->threadindex, PDO::PARAM_STR);
        $stmt->bindParam(':threadindex1', $this->threadindex1, PDO::PARAM_STR);
        $stmt->bindParam(':lundi', $this->lundi, PDO::PARAM_STR);
        $stmt->bindParam(':mardi', $this->mardi, PDO::PARAM_STR);
        $stmt->bindParam(':mercedi', $this->mercedi, PDO::PARAM_STR);
        $stmt->bindParam(':jeudi', $this->jeudi, PDO::PARAM_STR);
        $stmt->bindParam(':vendredi', $this->vendredi, PDO::PARAM_STR);
        $stmt->bindParam(':samedi', $this->samedi, PDO::PARAM_STR);
        $stmt->bindParam(':dimanche', $this->dimanche, PDO::PARAM_STR);
        $stmt->bindParam(':prestataireexterne', $this->prestataireexterne, PDO::PARAM_STR);
        $stmt->bindParam(':vue', $this->vue, PDO::PARAM_STR);
        $stmt->bindParam(':supp', $this->supp, PDO::PARAM_STR);
        $stmt->bindParam(':modif_pointage', $this->modif_pointage, PDO::PARAM_STR);
        $stmt->bindParam(':reccuperation', $this->reccuperation, PDO::PARAM_STR);
        $stmt->bindParam(':convention', $this->convention, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $this->categorie, PDO::PARAM_STR);
        $stmt->bindParam(':echelon', $this->echelon, PDO::PARAM_STR);
        $stmt->bindParam(':indice', $this->indice, PDO::PARAM_STR);
        $stmt->bindParam(':salairebasemensuel', $this->salairebasemensuel, PDO::PARAM_INT);
        $stmt->bindParam(':taux_h', $this->taux_h, PDO::PARAM_STR);
        $stmt->bindParam(':heureshebdo', $this->heureshebdo, PDO::PARAM_INT);
        $stmt->bindParam(':loge', $this->loge, PDO::PARAM_STR);
        $stmt->bindParam(':nourri', $this->nourri, PDO::PARAM_STR);
        $stmt->bindParam(':genre_salarie', $this->genre_salarie, PDO::PARAM_STR);
        $stmt->bindParam(':date_entree', $this->date_entree, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_Entree', $iddate_Entree, PDO::PARAM_INT);
        $stmt->bindParam(':date_contrat', $this->date_contrat, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_contrat', $iddate_contrat, PDO::PARAM_INT);
        $stmt->bindParam(':date_sortie', $this->date_sortie, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_Sortie', $iddate_Sortie, PDO::PARAM_INT);
        $stmt->bindParam(':type_contrat', $this->type_contrat, PDO::PARAM_STR);
        $stmt->bindParam(':motif_depart', $this->motif_depart, PDO::PARAM_STR);
        $stmt->bindParam(':majconges', $this->majconges, PDO::PARAM_STR);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':afficheplanning', $this->afficheplanning, PDO::PARAM_INT);
        $stmt->bindParam(':situationmatrimoniale', $this->situationmatrimoniale, PDO::PARAM_STR);
        $stmt->bindParam(':nombreenfant', $this->nombreenfant, PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':saisietpv', $this->saisietpv, PDO::PARAM_STR);
        $stmt->bindParam(':encaissementtpv', $this->encaissementtpv, PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':codeutilisateur', $this->codeutilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':nbmails', $this->nbmails, PDO::PARAM_INT);
        $stmt->bindParam(':numeroordresocial', $this->numeroordresocial, PDO::PARAM_STR);
        $stmt->bindParam(':numerosocial', $this->numerosocial, PDO::PARAM_INT);
        $stmt->bindParam(':numerocontribuable', $this->numerocontribuable, PDO::PARAM_STR);
        $stmt->bindParam(':indexcarteapuce', $this->indexcarteapuce, PDO::PARAM_STR);
        $stmt->bindParam(':indexcompta', $this->indexcompta, PDO::PARAM_STR);
        $stmt->bindParam(':indexcomptaacompte', $this->indexcomptaacompte, PDO::PARAM_STR);
        $stmt->bindParam(':indexcomptaopposition', $this->indexcomptaopposition, PDO::PARAM_STR);
        $stmt->bindParam(':pointagepc', $this->pointagepc, PDO::PARAM_STR);
        $stmt->bindParam(':conforme', $this->conforme, PDO::PARAM_STR);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archiveuser', $this->archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefinitiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $this->archivedefinitivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveuser', $this->archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);


        //Execute statement
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    // Update a courrier
    public function update(array $current, array $new_data): int | bool
    {
        $query = "UPDATE {$this->table} 
        SET 
            Site = :site,
    Indexe = :indexe,
    civilite= :civilite,
    nom= :nom,
    prenom= :prenom ,
    Grade= :grade,
    Assurance= :assurance,
    Matricule= :matricule,
    MatriculeInterne= :matriculeinterne,
    cni= :cni,
    LieuDelivranceCNI= :lieudelivrancecni,
    DateExpirationCNI= :dateexpirationcni,
    IDDateExpirationCNI= :iddateexpirationcni,
    departement= :departement,
    departement1= :departement1,
    Direction= :direction,
    SousDirection= :sousdirection,
    Service= :service,
    Email= :email,
    EmailProfessionnel= :emailprofessionnel,
    AgenceBanque= :agencebanque,
    CodeBanque= :codebanque ,
    CodeGuichetBanque= :codeguichetbanque,
    CodeSwiftBanque= :codeswiftbanque,
    NumeroCompteBanque= :numerocomptebanque,
    CleRibBanque= :cleribbanque,
    phone= :phone,
    agence= :agence,
    TelephoneProfessionnel= :telephoneprofessionnel,
    Adresse= :adresse,
    Fonction= :fonction,
    foto= :foto,
    Sexe= :sexe,
    SignatureNumerique= :signaturenumerique,
    FingerPrint1= :fingerprint1,
    FingerPrint2= :fingerprint2,
    FingerPrint3= :fingerprint3,
    FingerPrint4= :fingerprint4,
    image= :image,
    signature=  :signature,
    STATUS= :status,
    TypePers= :typepers,
    badge= :badge ,
    dnais= :dnais,
    IDDateNaissance= :iddatenaissance,
    npere= :npere,
    nmere= :nmere,
    vnais= :vnais,
    nurg= :nurg,
    nuurg= :nuurg,
    THREADINDEX= :threadindex,
    THREADINDEX1= :threadindex1,
    LUNDI= :lundi,
    MARDI= :mardi,
    MERCREDI= :mercedi,
    JEUDI= :jeudi,
    VENDREDI= :vendredi,
    SAMEDI= :samedi,
    DIMANCHE= :dimanche,
    PrestataireExterne= :prestataireexterne,
    VUE= :vue,
    SUPP= :supp,
    modif_pointage= :modif_pointage,
    reccuperation= :reccuperation,
    Convention= :convention,
    categorie= :categorie,
    Echelon= :echelon,
    Indice= :indice,
    SalaireBaseMensuel= :salairebasemensuel,
    taux_h= :taux_h,
    HeuresHebdo= :heureshebdo,
    loge= :loge,
    nourri= :nourri,
    genre_salarie= :genre_salarie,
    date_entree= :date_entree,
    IDDate_Entree= :iddate_Entree,
    date_contrat= :date_contrat,
    IDDate_Contrat= :iddate_contrat,
    date_sortie= :date_sortie,
    IDDate_Sortie= :iddate_Sortie,
    type_contrat= :type_contrat,
    motif_depart= :motif_depart,
    majconges= :majconges,
    archive= :archive,
    AffichePlanning= :afficheplanning,
    SituationMatrimoniale= :situationmatrimoniale,
    NombreEnfant= :nombreenfant,
    PSeudo= :pseudo,
    SaisieTPV= :saisietpv,
    EncaissementTPV= :encaissementtpv,
    Synchronization= :synchronization,
    NbMails= :nbmails,
    NumeroOrdreSocial= :numeroordresocial,
    LastUpDateTime= :lastupdatetime,
    IDLastUpDate= :idlastupdate,
    UserLastUpDateTime= :userlastupdatetime,
    CodeAgence= :codeagence,
    CodeUtilisateur= :codeutilisateur,
    DateTime= :datetime,
    NumeroSocial= :numerosocial,
    NumeroContribuable= :numerocontribuable,
    IndexCarteAPuce= :indexcarteapuce,
    IndexCompta= :indexcompta,
    IndexComptaAcompte= :indexcomptaacompte,
    IndexComptaOpposition= :indexcomptaopposition,
    PointagePC= :pointagepc,
    Conforme= :conforme,
    IDDateTime= :iddatetime,
    UserDateTime= :userdatetime,
    ArchiveIDDate= :archiveiddate,
    ArchiveDate= :archivedate,
    ArchiveUser= :archiveuser,
    ArchiveMotif= :archivemotif,
    ArchiveDefinitive= :archivedefinitive,
    ArchiveDefinitiveIDDate= :archivedefinitiveiddate,
    ArchiveDefinitiveDate= :archivedefinitivedate,
    ArchiveDefinitiveUser= :archivedefinitiveuser,
    ArchiveDefinitiveMotif= :archivedefinitivemotif
        WHERE NEng = :courrierId";
        $stmt = $this->conn->prepare($query);

        $login = $_SESSION["login"]["nom"] ?? "NONO";

        $setting_query = "SELECT Site FROM utilisateurs WHERE nom = '{$login}'";
        $setting_stmt = $this->conn->query($setting_query);
        $site = $setting_stmt->fetch(PDO::FETCH_ASSOC);

        $code_agence_query = "SELECT `CodeAgence` FROM settings WHERE `Site` = '{$site['Site']}'";
        $code_agence_stmt = $this->conn->query($code_agence_query);
        $codeAgence = $code_agence_stmt->fetch(PDO::FETCH_ASSOC);
        //data
        $this->site = htmlspecialchars(strip_tags($new_data['Site'] ?? $current['Site']));
        $this->civilite = htmlspecialchars(strip_tags($new_data['civilite'] ?? $current['civilite']));
        $this->nom = htmlspecialchars(strip_tags($new_data['nom'] ?? $current['nom']));
        $this->prenom = htmlspecialchars(strip_tags($new_data['prenom'] ?? $current['prenom']));
        $this->grade = htmlspecialchars(strip_tags($new_data['Grade'] ?? $current['Grade']));
        $this->assurance = htmlspecialchars(strip_tags($new_data['Assurance'] ?? $current['Assurance']));
        $this->matricule = htmlspecialchars(strip_tags($new_data['Matricule'] ?? $current['Matricule']));
        $this->matriculeinterne = htmlspecialchars(strip_tags($new_data['MatriculeInterne'] ?? $current['MatriculeInterne']));
        $this->cni = htmlspecialchars(strip_tags($new_data['cni'] ?? $current['cni']));
        $this->lieudelivrancecni = htmlspecialchars(strip_tags($new_data['LieuDelivranceCNI'] ?? $current['LieuDelivranceCNI']));
        $this->dateexpirationcni = htmlspecialchars(strip_tags($new_data['DateExpirationCNI'] ?? $current['DateExpirationCNI']));
        $this->iddateexpirationcni = htmlspecialchars(strip_tags($new_data['IDDateExpirationCNI'] ?? $current['IDDateExpirationCNI']));
        $this->departement = htmlspecialchars(strip_tags($new_data['departement'] ?? $current['departement']));
        $this->departement1 = htmlspecialchars(strip_tags($new_data['departement1'] ?? $current['departement1']));
        $this->direction = htmlspecialchars(strip_tags($new_data['Direction'] ?? $current['Direction']));
        $this->sousdirection = htmlspecialchars(strip_tags($new_data['SousDirection'] ?? $current['SousDirection']));
        $this->service = htmlspecialchars(strip_tags($new_data['Service'] ?? $current['Service']));
        $this->email = htmlspecialchars(strip_tags($new_data['Email'] ?? $current['Email']));
        $this->emailprofessionnel = htmlspecialchars(strip_tags($new_data['EmailProfessionnel'] ?? $current['EmailProfessionnel']));
        $this->agencebanque = htmlspecialchars(strip_tags($new_data['AgenceBanque'] ?? $current['AgenceBanque']));
        $this->codebanque = htmlspecialchars(strip_tags($new_data['CodeBanque'] ?? $current['CodeBanque']));
        $this->codeguichetbanque = htmlspecialchars(strip_tags($new_data['CodeGuichetBanque'] ?? $current['CodeGuichetBanque']));
        $this->codeswiftbanque = htmlspecialchars(strip_tags($new_data['CodeSwiftBanque'] ?? $current['CodeSwiftBanque']));
        $this->numerocomptebanque = htmlspecialchars(strip_tags($new_data['NumeroCompteBanque'] ?? $current['NumeroCompteBanque']));
        $this->cleribbanque = htmlspecialchars(strip_tags($new_data['CleRibBanque'] ?? $current['CleRibBanque']));
        $this->phone = htmlspecialchars(strip_tags($new_data['phone'] ?? $current['phone']));
        $this->agence = htmlspecialchars(strip_tags($new_data['agence'] ?? $current['agence']));
        $this->telephoneprofessionnel = htmlspecialchars(strip_tags($new_data['TelephoneProfessionnel'] ?? $current['TelephoneProfessionnel']));
        $this->adresse = htmlspecialchars(strip_tags($new_data['Adresse'] ?? $current['Adresse']));
        $this->fonction = htmlspecialchars(strip_tags($new_data['Fonction'] ?? $current['Fonction']));
        $this->foto = htmlspecialchars(strip_tags($new_data['foto'] ?? $current['foto']));
        $this->sexe = htmlspecialchars(strip_tags($new_data['Sexe'] ?? $current['Sexe']));
        $this->signaturenumerique = htmlspecialchars(strip_tags($new_data['SignatureNumerique'] ?? $current['SignatureNumerique']));
        $this->fingerprint1 = htmlspecialchars(strip_tags($new_data['FingerPrint1'] ?? $current['FingerPrint1']));
        $this->fingerprint2 = htmlspecialchars(strip_tags($new_data['FingerPrint2'] ?? $current['FingerPrint2']));
        $this->fingerprint3 = htmlspecialchars(strip_tags($new_data['FingerPrint3'] ?? $current['FingerPrint3']));
        $this->fingerprint4 = htmlspecialchars(strip_tags($new_data['FingerPrint4'] ?? $current['FingerPrint4']));
        $this->image = htmlspecialchars(strip_tags($new_data['image'] ?? $current['image']));
        $this->signature = htmlspecialchars(strip_tags($new_data['signature'] ?? $current['signature']));
        $this->status = htmlspecialchars(strip_tags($new_data['STATUS'] ?? $current['STATUS']));
        $this->typepers = htmlspecialchars(strip_tags($new_data['TypePers'] ?? $current['TypePers']));
        $this->badge = htmlspecialchars(strip_tags($new_data['badge'] ?? $current['badge']));
        $this->dnais = htmlspecialchars(strip_tags($new_data['dnais'] ?? $current['dnais']));
        $this->iddatenaissance = htmlspecialchars(strip_tags($new_data['IDDateNaissance'] ?? $current['IDDateNaissance']));
        $this->npere = htmlspecialchars(strip_tags($new_data['npere'] ?? $current['npere']));
        $this->nmere = htmlspecialchars(strip_tags($new_data['nmere'] ?? $current['nmere']));
        $this->vnais = htmlspecialchars(strip_tags($new_data['vnais'] ?? $current['vnais']));
        $this->nurg = htmlspecialchars(strip_tags($new_data['nurg'] ?? $current['nurg']));
        $this->nuurg = htmlspecialchars(strip_tags($new_data['nuurg'] ?? $current['nuurg']));
        $this->threadindex = htmlspecialchars(strip_tags($new_data['THREADINDEX'] ?? $current['THREADINDEX']));
        $this->threadindex1 = htmlspecialchars(strip_tags($new_data['THREADINDEX1'] ?? $current['THREADINDEX1']));
        $this->lundi = htmlspecialchars(strip_tags($new_data['LUNDI'] ?? $current['LUNDI']));
        $this->mardi = htmlspecialchars(strip_tags($new_data['MARDI'] ?? $current['MARDI']));
        $this->mercedi = htmlspecialchars(strip_tags($new_data['MERCREDI'] ?? $current['MERCREDI']));
        $this->jeudi = htmlspecialchars(strip_tags($new_data['JEUDI'] ?? $current['JEUDI']));
        $this->vendredi = htmlspecialchars(strip_tags($new_data['VENDREDI'] ?? $current['VENDREDI']));
        $this->samedi = htmlspecialchars(strip_tags($new_data['SAMEDI'] ?? $current['SAMEDI']));
        $this->dimanche = htmlspecialchars(strip_tags($new_data['DIMANCHE'] ?? $current['DIMANCHE']));
        $this->prestataireexterne = htmlspecialchars(strip_tags($new_data['PrestataireExterne'] ?? $current['PrestataireExterne']));
        $this->vue = htmlspecialchars(strip_tags($new_data['VUE'] ?? $current['VUE']));
        $this->supp = htmlspecialchars(strip_tags($new_data['SUPP'] ?? $current['SUPP']));
        $this->modif_pointage = htmlspecialchars(strip_tags($new_data['modif_pointage'] ?? $current['modif_pointage']));
        $this->reccuperation = htmlspecialchars(strip_tags($new_data['reccuperation'] ?? $current['reccuperation']));
        $this->convention = htmlspecialchars(strip_tags($new_data['Convention'] ?? $current['Convention']));
        $this->categorie = htmlspecialchars(strip_tags($new_data['categorie'] ?? $current['categorie']));
        $this->echelon = htmlspecialchars(strip_tags($new_data['Echelon'] ?? $current['Echelon']));
        $this->indice = htmlspecialchars(strip_tags($new_data['Indice'] ?? $current['Indice']));
        $this->salairebasemensuel = htmlspecialchars(strip_tags($new_data['SalaireBaseMensuel'] ?? $current['SalaireBaseMensuel']));
        $this->taux_h = htmlspecialchars(strip_tags($new_data['taux_h'] ?? $current['taux_h']));
        $this->heureshebdo = htmlspecialchars(strip_tags($new_data['HeuresHebdo'] ?? $current['HeuresHebdo']));
        $this->loge = htmlspecialchars(strip_tags($new_data['loge'] ?? $current['loge']));
        $this->nourri = htmlspecialchars(strip_tags($new_data['nourri'] ?? $current['nourri']));
        $this->genre_salarie = htmlspecialchars(strip_tags($new_data['genre_salarie'] ?? $current['genre_salarie']));
        $this->date_entree = htmlspecialchars(strip_tags($new_data['date_entree'] ?? $current['date_entree']));
        $this->iddate_Entree = htmlspecialchars(strip_tags($new_data['IDDate_Entree'] ?? $current['IDDate_Entree']));
        $this->date_contrat = htmlspecialchars(strip_tags($new_data['date_contrat'] ?? $current['date_contrat']));
        $this->iddate_contrat = htmlspecialchars(strip_tags($new_data['IDDate_Contrat'] ?? $current['IDDate_Contrat']));
        $this->date_sortie = htmlspecialchars(strip_tags($new_data['date_sortie'] ?? $current['date_sortie']));
        $this->iddate_Sortie = htmlspecialchars(strip_tags($new_data['IDDate_Sortie'] ?? $current['IDDate_Sortie']));
        $this->type_contrat = htmlspecialchars(strip_tags($new_data['type_contrat'] ?? $current['type_contrat']));
        $this->motif_depart = htmlspecialchars(strip_tags($new_data['motif_depart'] ?? $current['motif_depart']));
        $this->majconges = htmlspecialchars(strip_tags($new_data['majconges'] ?? $current['majconges']));
        $this->archive = htmlspecialchars(strip_tags($new_data['archive'] ?? $current['archive']));
        $this->afficheplanning = htmlspecialchars(strip_tags($new_data['AffichePlanning'] ?? $current['AffichePlanning']));
        $this->situationmatrimoniale = htmlspecialchars(strip_tags($new_data['SituationMatrimoniale'] ?? $current['SituationMatrimoniale']));
        $this->nombreenfant = htmlspecialchars(strip_tags($new_data['NombreEnfant'] ?? $current['NombreEnfant']));
        $this->pseudo = htmlspecialchars(strip_tags($new_data['PSeudo'] ?? $current['PSeudo']));
        $this->saisietpv = htmlspecialchars(strip_tags($new_data['SaisieTPV'] ?? $current['SaisieTPV']));
        $this->encaissementtpv = htmlspecialchars(strip_tags($new_data['EncaissementTPV'] ?? $current['EncaissementTPV']));
        $this->synchronization = htmlspecialchars(strip_tags($new_data['Synchronization'] ?? $current['Synchronization']));
        $this->nbmails = htmlspecialchars(strip_tags($new_data['NbMails'] ?? $current['NbMails']));
        $this->numeroordresocial = htmlspecialchars(strip_tags($new_data['NumeroOrdreSocial'] ?? $current['NumeroOrdreSocial']));
        $this->codeutilisateur = htmlspecialchars(strip_tags($new_data['CodeUtilisateur'] ?? $current['CodeUtilisateur']));
        $this->numerosocial = htmlspecialchars(strip_tags($new_data['NumeroSocial'] ?? $current['NumeroSocial']));
        $this->numerocontribuable = htmlspecialchars(strip_tags($new_data['NumeroContribuable'] ?? $current['NumeroContribuable']));
        $this->indexcarteapuce = htmlspecialchars(strip_tags($new_data['IndexCarteAPuce'] ?? $current['IndexCarteAPuce']));
        $this->indexcompta = htmlspecialchars(strip_tags($new_data['IndexCompta'] ?? $current['IndexCompta']));
        $this->indexcomptaacompte = htmlspecialchars(strip_tags($new_data['IndexComptaAcompte'] ?? $current['IndexComptaAcompte']));
        $this->indexcomptaopposition = htmlspecialchars(strip_tags($new_data['IndexComptaOpposition'] ?? $current['IndexComptaOpposition']));
        $this->pointagepc = htmlspecialchars(strip_tags($new_data['PointagePC'] ?? $current['PointagePC']));
        $this->conforme = htmlspecialchars(strip_tags($new_data['Conforme'] ?? $current['Conforme']));
        $this->archivedate = htmlspecialchars(strip_tags($new_data['ArchiveDate'] ?? $current['ArchiveDate']));
        $this->archiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveIDDate'] ?? $current['ArchiveIDDate']));
        $this->archiveuser = htmlspecialchars(strip_tags($new_data['ArchiveUser'] ?? $current['ArchiveUser']));
        $this->archivemotif = htmlspecialchars(strip_tags($new_data['ArchiveMotif'] ?? $current['ArchiveMotif']));
        $this->archivedefinitive = htmlspecialchars(strip_tags($new_data['ArchiveDefinitive'] ?? $current['ArchiveDefinitive']));
        $this->archivedefinitivedate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveDate'] ?? $current['ArchiveDefinitiveDate']));
        $this->archivedefinitiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveIDDate'] ?? $current['ArchiveDefinitiveIDDate']));
        $this->archivedefinitiveuser = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveUser'] ?? $current['ArchiveDefinitiveUser']));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveMotif'] ?? $current['ArchiveDefinitiveMotif']));
        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));
        if ($current['STATUS'] == 'Archivé') {
            return false;
        }

        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;


        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime) ?? 0;
        $iddateexpirationcni = strtotime($this->dateexpirationcni) ?? 0;
        $iddatenaissance = strtotime($this->dnais) ?? 0;
        $iddate_Entree = strtotime($this->date_entree) ?? 0;
        $iddate_contrat = strtotime($this->date_contrat) ?? 0;
        $iddate_Sortie = strtotime($this->date_sortie) ?? 0;
        $archiveiddate = strtotime($this->archivedate) ?? 0;
        $archivedefinitiveiddate = strtotime($this->archivedefinitivedate) ?? 0;

        $txt = "Modified";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;


        //Bind data
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userlastupdatetime', $userdatetime, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':indexe', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':codeagence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':site', $site['Site'], PDO::PARAM_STR);
        $stmt->bindParam(':civilite', $this->civilite, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $this->grade, PDO::PARAM_STR);
        $stmt->bindParam(':assurance', $this->assurance, PDO::PARAM_STR);
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':matriculeinterne', $this->matriculeinterne, PDO::PARAM_STR);
        $stmt->bindParam(':cni', $this->cni, PDO::PARAM_INT);
        $stmt->bindParam(':lieudelivrancecni', $this->lieudelivrancecni, PDO::PARAM_STR);
        $stmt->bindParam(':dateexpirationcni', $this->dateexpirationcni, PDO::PARAM_STR);
        $stmt->bindParam(':iddateexpirationcni', $iddateexpirationcni, PDO::PARAM_INT);
        $stmt->bindParam(':departement', $this->departement, PDO::PARAM_STR);
        $stmt->bindParam(':departement1', $this->departement1, PDO::PARAM_STR);
        $stmt->bindParam(':direction', $this->direction, PDO::PARAM_STR);
        $stmt->bindParam(':sousdirection', $this->sousdirection, PDO::PARAM_STR);
        $stmt->bindParam(':service', $this->service, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':emailprofessionnel', $this->emailprofessionnel, PDO::PARAM_STR);
        $stmt->bindParam(':agencebanque', $this->agencebanque, PDO::PARAM_STR);
        $stmt->bindParam(':codebanque', $this->codebanque, PDO::PARAM_STR);
        $stmt->bindParam(':codeguichetbanque', $this->codeguichetbanque, PDO::PARAM_STR);
        $stmt->bindParam(':codeswiftbanque', $this->codeswiftbanque, PDO::PARAM_STR);
        $stmt->bindParam(':numerocomptebanque', $this->numerocomptebanque, PDO::PARAM_INT);
        $stmt->bindParam(':cleribbanque', $this->cleribbanque, PDO::PARAM_STR);
        $stmt->bindParam(':agence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $this->phone, PDO::PARAM_INT);
        $stmt->bindParam(':telephoneprofessionnel', $this->telephoneprofessionnel, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $this->adresse, PDO::PARAM_STR);
        $stmt->bindParam(':fonction', $this->fonction, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $this->foto, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $this->sexe, PDO::PARAM_STR);
        $stmt->bindParam(':signaturenumerique', $this->signaturenumerique, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint1', $this->fingerprint1, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint2', $this->fingerprint2, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint3', $this->fingerprint3, PDO::PARAM_STR);
        $stmt->bindParam(':fingerprint4', $this->fingerprint4, PDO::PARAM_STR);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':signature', $this->signature, PDO::PARAM_INT);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':typepers', $this->typepers, PDO::PARAM_STR);
        $stmt->bindParam(':badge', $this->badge, PDO::PARAM_STR);
        $stmt->bindParam(':dnais', $this->dnais, PDO::PARAM_STR);
        $stmt->bindParam(':iddatenaissance', $iddatenaissance, PDO::PARAM_INT);
        $stmt->bindParam(':npere', $this->npere, PDO::PARAM_STR);
        $stmt->bindParam(':nmere', $this->nmere, PDO::PARAM_STR);
        $stmt->bindParam(':vnais', $this->vnais, PDO::PARAM_STR);
        $stmt->bindParam(':nurg', $this->nurg, PDO::PARAM_STR);
        $stmt->bindParam(':nuurg', $this->nuurg, PDO::PARAM_STR);
        $stmt->bindParam(':threadindex', $this->threadindex, PDO::PARAM_STR);
        $stmt->bindParam(':threadindex1', $this->threadindex1, PDO::PARAM_STR);
        $stmt->bindParam(':lundi', $this->lundi, PDO::PARAM_STR);
        $stmt->bindParam(':mardi', $this->mardi, PDO::PARAM_STR);
        $stmt->bindParam(':mercedi', $this->mercedi, PDO::PARAM_STR);
        $stmt->bindParam(':jeudi', $this->jeudi, PDO::PARAM_STR);
        $stmt->bindParam(':vendredi', $this->vendredi, PDO::PARAM_STR);
        $stmt->bindParam(':samedi', $this->samedi, PDO::PARAM_STR);
        $stmt->bindParam(':dimanche', $this->dimanche, PDO::PARAM_STR);
        $stmt->bindParam(':prestataireexterne', $this->prestataireexterne, PDO::PARAM_STR);
        $stmt->bindParam(':vue', $this->vue, PDO::PARAM_STR);
        $stmt->bindParam(':supp', $this->supp, PDO::PARAM_STR);
        $stmt->bindParam(':modif_pointage', $this->modif_pointage, PDO::PARAM_STR);
        $stmt->bindParam(':reccuperation', $this->reccuperation, PDO::PARAM_STR);
        $stmt->bindParam(':convention', $this->convention, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $this->categorie, PDO::PARAM_STR);
        $stmt->bindParam(':echelon', $this->echelon, PDO::PARAM_STR);
        $stmt->bindParam(':indice', $this->indice, PDO::PARAM_STR);
        $stmt->bindParam(':salairebasemensuel', $this->salairebasemensuel, PDO::PARAM_INT);
        $stmt->bindParam(':taux_h', $this->taux_h, PDO::PARAM_STR);
        $stmt->bindParam(':heureshebdo', $this->heureshebdo, PDO::PARAM_INT);
        $stmt->bindParam(':loge', $this->loge, PDO::PARAM_STR);
        $stmt->bindParam(':nourri', $this->nourri, PDO::PARAM_STR);
        $stmt->bindParam(':genre_salarie', $this->genre_salarie, PDO::PARAM_STR);
        $stmt->bindParam(':date_entree', $this->date_entree, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_Entree', $iddate_Entree, PDO::PARAM_INT);
        $stmt->bindParam(':date_contrat', $this->date_contrat, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_contrat', $iddate_contrat, PDO::PARAM_INT);
        $stmt->bindParam(':date_sortie', $this->date_sortie, PDO::PARAM_STR);
        $stmt->bindParam(':iddate_Sortie', $iddate_Sortie, PDO::PARAM_INT);
        $stmt->bindParam(':type_contrat', $this->type_contrat, PDO::PARAM_STR);
        $stmt->bindParam(':motif_depart', $this->motif_depart, PDO::PARAM_STR);
        $stmt->bindParam(':majconges', $this->majconges, PDO::PARAM_STR);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':afficheplanning', $this->afficheplanning, PDO::PARAM_INT);
        $stmt->bindParam(':situationmatrimoniale', $this->situationmatrimoniale, PDO::PARAM_STR);
        $stmt->bindParam(':nombreenfant', $this->nombreenfant, PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':saisietpv', $this->saisietpv, PDO::PARAM_STR);
        $stmt->bindParam(':encaissementtpv', $this->encaissementtpv, PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':codeutilisateur', $this->codeutilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':nbmails', $this->nbmails, PDO::PARAM_INT);
        $stmt->bindParam(':numeroordresocial', $this->numeroordresocial, PDO::PARAM_STR);
        $stmt->bindParam(':numerosocial', $this->numerosocial, PDO::PARAM_INT);
        $stmt->bindParam(':numerocontribuable', $this->numerocontribuable, PDO::PARAM_STR);
        $stmt->bindParam(':indexcarteapuce', $this->indexcarteapuce, PDO::PARAM_STR);
        $stmt->bindParam(':indexcompta', $this->indexcompta, PDO::PARAM_STR);
        $stmt->bindParam(':indexcomptaacompte', $this->indexcomptaacompte, PDO::PARAM_STR);
        $stmt->bindParam(':indexcomptaopposition', $this->indexcomptaopposition, PDO::PARAM_STR);
        $stmt->bindParam(':pointagepc', $this->pointagepc, PDO::PARAM_STR);
        $stmt->bindParam(':conforme', $this->conforme, PDO::PARAM_STR);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archiveuser', $this->archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefinitiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $this->archivedefinitivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveuser', $this->archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':courrierId', $this->courrierId, PDO::PARAM_INT);


        //Execute statement
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Deletes a courier by ID.
     *
     * @param int $id The ID of the courier to delete.
     * @return int The number of rows affected by the delete operation.
     */
    public function delete($id): int | false
    {
        // Define the query to delete the courier by ID
        $query = "UPDATE {$this->table} 
        SET supp=1
        WHERE NEng = :courierId";

        // Sanitize and assign the courier ID
        $courierId = htmlspecialchars(strip_tags($id));

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($query);

        // Bind the courier ID parameter
        $stmt->bindParam(':courierId', $courierId, PDO::PARAM_INT);

        // Execute the SQL statement
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
