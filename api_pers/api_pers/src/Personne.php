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
        $query = "SELECT * FROM  {$this->table} where supprimer=0";

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
        $query = "SELECT * FROM {$this->table} WHERE NEng = :courierId and supprimer !=1";

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

        $this->civilite = htmlspecialchars(strip_tags($data['civilite']));
        $this->nom = htmlspecialchars(strip_tags($data['nom']));
        $this->prenom = htmlspecialchars(strip_tags($data['prenom']));
        $this->grade = htmlspecialchars(strip_tags($data['Grade']));
        $this->assurance = htmlspecialchars(strip_tags($data['Assurance']));
        $this->matricule = htmlspecialchars(strip_tags($data['Matricule']));
        $this->matriculeinterne = htmlspecialchars(strip_tags($data['MatriculeInterne']));
        $this->cni = htmlspecialchars(strip_tags($data['cni']));
        $this->lieudelivrancecni = htmlspecialchars(strip_tags($data['LieuDelivranceCNI']));
        $this->dateexpirationcni = htmlspecialchars(strip_tags($data['DateExpirationCNI']));
        $this->iddateexpirationcni = htmlspecialchars(strip_tags($data['IDDateExpirationCNI']));
        $this->departement = htmlspecialchars(strip_tags($data['departement']));
        $this->departement1 = htmlspecialchars(strip_tags($data['departement1']));
        $this->direction = htmlspecialchars(strip_tags($data['Direction']));
        $this->sousdirection = htmlspecialchars(strip_tags($data['SousDirection']));
        $this->service = htmlspecialchars(strip_tags($data['Service']));
        $this->email = htmlspecialchars(strip_tags($data['Email']));
        $this->emailprofessionnel = htmlspecialchars(strip_tags($data['EmailProfessionnel']));
        $this->agencebanque = htmlspecialchars(strip_tags($data['AgenceBanque']));
        $this->codebanque = htmlspecialchars(strip_tags($data['CodeBanque']));
        $this->codeguichetbanque = htmlspecialchars(strip_tags($data['CodeGuichetBanque']));
        $this->codeswiftbanque = htmlspecialchars(strip_tags($data['CodeSwiftBanque']));
        $this->numerocomptebanque = htmlspecialchars(strip_tags($data['NumeroCompteBanque']));
        $this->cleribbanque = htmlspecialchars(strip_tags($data['CleRibBanque']));
        $this->phone = htmlspecialchars(strip_tags($data['phone']));
        $this->agence = htmlspecialchars(strip_tags($data['agence']));
        $this->telephoneprofessionnel = htmlspecialchars(strip_tags($data['TelephoneProfessionnel']));
        $this->adresse = htmlspecialchars(strip_tags($data['Adresse']));
        $this->fonction = htmlspecialchars(strip_tags($data['Fonction']));
        $this->foto = htmlspecialchars(strip_tags($data['foto']));
        $this->sexe = htmlspecialchars(strip_tags($data['Sexe']));
        $this->signaturenumerique = htmlspecialchars(strip_tags($data['SignatureNumerique']));
        $this->fingerprint1 = htmlspecialchars(strip_tags($data['FingerPrint1']));
        $this->fingerprint2 = htmlspecialchars(strip_tags($data['FingerPrint2']));
        $this->fingerprint3 = htmlspecialchars(strip_tags($data['FingerPrint3']));
        $this->fingerprint4 = htmlspecialchars(strip_tags($data['FingerPrint4']));
        $this->image = htmlspecialchars(strip_tags($data['image']));
        $this->signature = htmlspecialchars(strip_tags($data['signature']));
        $this->status = htmlspecialchars(strip_tags($data['STATUS']));
        $this->typepers = htmlspecialchars(strip_tags($data['TypePers']));
        $this->badge = htmlspecialchars(strip_tags($data['badge']));
        $this->dnais = htmlspecialchars(strip_tags($data['dnais']));
        $this->iddatenaissance = htmlspecialchars(strip_tags($data['IDDateNaissance']));
        $this->npere = htmlspecialchars(strip_tags($data['npere']));
        $this->nmere = htmlspecialchars(strip_tags($data['nmere']));
        $this->vnais = htmlspecialchars(strip_tags($data['vnais']));
        $this->nurg = htmlspecialchars(strip_tags($data['nurg']));
        $this->nuurg = htmlspecialchars(strip_tags($data['nuurg']));
        $this->threadindex = htmlspecialchars(strip_tags($data['THREADINDEX']));
        $this->threadindex1 = htmlspecialchars(strip_tags($data['THREADINDEX1']));
        $this->lundi = htmlspecialchars(strip_tags($data['LUNDI']));
        $this->mardi = htmlspecialchars(strip_tags($data['MARDI']));
        $this->mercedi = htmlspecialchars(strip_tags($data['MERCREDI']));
        $this->jeudi = htmlspecialchars(strip_tags($data['JEUDI']));
        $this->vendredi = htmlspecialchars(strip_tags($data['VENDREDI']));
        $this->samedi = htmlspecialchars(strip_tags($data['SAMEDI']));
        $this->dimanche = htmlspecialchars(strip_tags($data['DIMANCHE']));
        $this->prestataireexterne = htmlspecialchars(strip_tags($data['PrestataireExterne']));
        $this->vue = htmlspecialchars(strip_tags($data['VUE']));
        $this->supp = htmlspecialchars(strip_tags($data['SUPP']));
        $this->modif_pointage = htmlspecialchars(strip_tags($data['modif_pointage']));
        $this->reccuperation = htmlspecialchars(strip_tags($data['reccuperation']));
        $this->convention = htmlspecialchars(strip_tags($data['Convention']));
        $this->categorie = htmlspecialchars(strip_tags($data['categorie']));
        $this->echelon = htmlspecialchars(strip_tags($data['Echelon']));
        $this->indice = htmlspecialchars(strip_tags($data['Indice']));
        $this->salairebasemensuel = htmlspecialchars(strip_tags($data['SalaireBaseMensuel']));
        $this->taux_h = htmlspecialchars(strip_tags($data['taux_h']));
        $this->heureshebdo = htmlspecialchars(strip_tags($data['HeuresHebdo']));
        $this->loge = htmlspecialchars(strip_tags($data['loge']));
        $this->nourri = htmlspecialchars(strip_tags($data['nourri']));
        $this->genre_salarie = htmlspecialchars(strip_tags($data['genre_salarie']));
        $this->date_entree = htmlspecialchars(strip_tags($data['date_entree']));
        $this->iddate_Entree = htmlspecialchars(strip_tags($data['IDDate_Entree']));
        $this->date_contrat = htmlspecialchars(strip_tags($data['date_contrat']));
        $this->iddate_contrat = htmlspecialchars(strip_tags($data['IDDate_Contrat']));
        $this->date_sortie = htmlspecialchars(strip_tags($data['date_sortie']));
        $this->iddate_Sortie = htmlspecialchars(strip_tags($data['IDDate_Sortie']));
        $this->type_contrat = htmlspecialchars(strip_tags($data['type_contrat']));
        $this->motif_depart = htmlspecialchars(strip_tags($data['motif_depart']));
        $this->majconges = htmlspecialchars(strip_tags($data['majconges']));
        $this->archive = htmlspecialchars(strip_tags($data['archive']));
        $this->afficheplanning = htmlspecialchars(strip_tags($data['AffichePlanning']));
        $this->situationmatrimoniale = htmlspecialchars(strip_tags($data['SituationMatrimoniale']));
        $this->nombreenfant = htmlspecialchars(strip_tags($data['NombreEnfant']));
        $this->pseudo = htmlspecialchars(strip_tags($data['PSeudo']));
        $this->saisietpv = htmlspecialchars(strip_tags($data['SaisieTPV']));
        $this->encaissementtpv = htmlspecialchars(strip_tags($data['EncaissementTPV']));
        $this->synchronization = htmlspecialchars(strip_tags($data['Synchronization']));
        $this->nbmails = htmlspecialchars(strip_tags($data['NbMails']));
        $this->numeroordresocial = htmlspecialchars(strip_tags($data['NumeroOrdreSocial']));
        $this->codeutilisateur = htmlspecialchars(strip_tags($data['CodeUtilisateur']));
        $this->numerosocial = htmlspecialchars(strip_tags($data['NumeroSocial']));
        $this->numerocontribuable = htmlspecialchars(strip_tags($data['NumeroContribuable']));
        $this->indexcarteapuce = htmlspecialchars(strip_tags($data['IndexCarteAPuce']));
        $this->indexcompta = htmlspecialchars(strip_tags($data['IndexCompta']));
        $this->indexcomptaacompte = htmlspecialchars(strip_tags($data['IndexComptaAcompte']));
        $this->indexcomptaopposition = htmlspecialchars(strip_tags($data['IndexComptaOpposition']));
        $this->pointagepc = htmlspecialchars(strip_tags($data['PointagePC']));
        $this->conforme = htmlspecialchars(strip_tags($data['Conforme']));
        $this->archivedate = htmlspecialchars(strip_tags($data['ArchiveDate']));
        $this->archiveiddate = htmlspecialchars(strip_tags($data['ArchiveIDDate']));
        $this->archiveuser = htmlspecialchars(strip_tags($data['ArchiveUser']));
        $this->archivemotif = htmlspecialchars(strip_tags($data['ArchiveMotif']));
        $this->archivedefinitive = htmlspecialchars(strip_tags($data['ArchiveDefinitive']));
        $this->archivedefinitivedate = htmlspecialchars(strip_tags($data['ArchiveDefinitiveDate']));
        $this->archivedefinitiveiddate = htmlspecialchars(strip_tags($data['ArchiveDefinitiveIDDate']));
        $this->archivedefinitiveuser = htmlspecialchars(strip_tags($data['ArchiveDefinitiveUser']));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($data['ArchiveDefinitiveMotif']));


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
        $stmt->bindParam(':synchronization', $this->synchronization, PDO::PARAM_STR);
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
            InOutCourier = :type, 
            ReferenceCourier = :ref, 
            ObjetCourier = :obj, 
            SourceCourier = :source, 
            Destinataire = :desti, 
            DateDepot = :date, 
            HeureDepot = :heure, 
            NiveauImportance = :niveau,
            Synchronization = :synchronization,
            LastUpDateTime = :lastupdatetime,
            IDLastUpDate = :idlastupdate,
            UserLastUpDateTime = :userlastupdatetime,
            NomPieceJointe = :nompiecejointe,
            DestiPieceJointe = :destipiecejointe,
            Statut = :statut
        WHERE NEng = :courrierId";
        $stmt = $this->conn->prepare($query);

        //data
        $this->site = htmlspecialchars(strip_tags($new_data['Site'] ?? $current['Site']));
        $this->type = htmlspecialchars(strip_tags($new_data['InOutCourier'] ?? $current['InOutCourier']));
        $this->ref = htmlspecialchars(strip_tags($new_data['ReferenceCourier'] ?? $current['ReferenceCourier']));
        $this->obj = htmlspecialchars(strip_tags($new_data['ObjetCourier'] ?? $current['ObjetCourier']));
        $this->source = htmlspecialchars(strip_tags($new_data['SourceCourier'] ?? $current['SourceCourier']));
        $this->desti = htmlspecialchars(strip_tags($new_data['Destinataire'] ?? $current['Destinataire']));
        $this->date = htmlspecialchars(strip_tags($new_data['DateDepot'] ?? $current['DateDepot']));
        $this->heure = htmlspecialchars(strip_tags($new_data['HeureDepot'] ?? $current['HeureDepot']));
        $this->niveau = htmlspecialchars(strip_tags($new_data['NiveauImportance'] ?? $current['NiveauImportance']));
        $this->status = htmlspecialchars(strip_tags($new_data['Statut'] ?? $current['Statut']));
        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));
        $nompiecejointe = htmlspecialchars(strip_tags($new_data['NomPieceJointe'] ?? $current['NomPieceJointe']));
        $destipiecejointe = htmlspecialchars(strip_tags($new_data['DestiPieceJointe'] ?? $current['DestiPieceJointe']));

        if ($current['Statut'] == 'Archivé') {
            return false;
        }

        $txt = "Modified";
        $synchronization = "$txt;$current[CodeAgence];";
        $lastupdatetime = date("Y/m/d H:i:s", time() - 1 * 60 * 60);
        $idlastupdate = strtotime($lastupdatetime);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $login = $_SESSION["login"] ?? "NONO";
        $userlastupdatetime = $login;

        //Bind data
        $stmt->bindParam(':site', $this->site, PDO::PARAM_STR);
        $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
        $stmt->bindParam(':ref', $this->ref, PDO::PARAM_STR);
        $stmt->bindParam(':obj', $this->obj, PDO::PARAM_STR);
        $stmt->bindParam(':source', $this->source, PDO::PARAM_STR);
        $stmt->bindParam(':desti', $this->desti, PDO::PARAM_STR);
        $stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':heure', $this->heure, PDO::PARAM_STR);
        $stmt->bindParam(':niveau', $this->niveau, PDO::PARAM_STR);
        $stmt->bindParam(':courrierId', $this->courrierId, PDO::PARAM_INT);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userlastupdatetime', $userlastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':nompiecejointe', $nompiecejointe, PDO::PARAM_STR);
        $stmt->bindParam(':destipiecejointe', $destipiecejointe, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $this->status, PDO::PARAM_STR);

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
        SET supprimer=1
        WHERE NEng = :courierId";

        // Sanitize and assign the courier ID
        $courierId = htmlspecialchars(strip_tags($id));

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($query);


        // make a backup in table `backupcourrier`



        // Bind the courier ID parameter
        $stmt->bindParam(':courierId', $courierId, PDO::PARAM_INT);

        // Execute the SQL statement
        $stmt->execute();

        // Return the number of rows affected by the delete operation
        return $stmt->rowCount();
    }
}
