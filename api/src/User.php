<?php
class User
{
    //DB require stuff
    private $conn;
    private $table = 'utilisateurs';

    //Properties for courriers
    public $courrierId;
    public $site;
    public $type;
    public $ref;
    public $obj;
    public $source;
    public $desti;
    public $date;
    public $heure;
    public $niveau;
    public $status;

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
        $query = "SELECT * FROM {$this->table} WHERE Supprimer = 0";

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
        $query = "SELECT * FROM {$this->table} WHERE NEng = :courierId AND Supprimer != 1";

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
 groupe = :groupe,
  nom  = :nom,
 prenom = :prenom,
  passwords = :passwords,
  matricule = :matricule,
 portee  =:portee,
 PorteeSite = :porteesite,
  PasswordDemand = :passworddemand,
  VisibiliteValeurStock = :visibilitevaleurstock, 
  BloquerModificationTitreFacture = :bloquermodificationtitrefacture, 
  BloquerExportationEtats = :bloquerexportationetats, 
  BloquerAnnulationFacture = :bloquerannulationfacture ,
 ActiverRgltMultipleCreancier = :activerrgltmultiplecreancier, 
 EntetePageDefaut = :entetepagedefaut, 
  RemiseMax = :remisemax, 
 ValeurRemiseMax = :valeurremisemax, 
  superviseur = :superviseur,  
  MODPointage = :modpointage, 
 MODFinance  = :modfinance,  
 MODGestionRH  = :modgestionrh,  
 MODTelephonie = :modtelephonie, 
 MODComptabilite = :modcomptabilite, 
 MODStocks  = :modstocks,  
 MODService  = :modservice,  
 MODSante  = :modsante , 
 MODHotel   = :modhotel ,  
 MODPaie   = :modpaie,   
 AlerteAnnivNaissance = :alerteannivnaissance, 
  AlerteAnnivTravail = :alerteannivtravail, 
 AlerteCaisseNonCloturee = :alertecaissenoncloturee, 
 AlerteStocksTPV = :alertestockstpv, 
  AlerteTacheGRC = :alertetachegrc ,
 AlerteTicketSAV = :alerteticketsav,
 AlerteBiologie  = :alertebiologie,  
  AlerteImagerie = :alerteimagerie, 
   AlerteEndoscopie = :alerteendoscopie, 
 AlerteNoteSurPatient = :alertenotesurpatient, 
  AlerteAlarmeSurPatient = :alertealarmesurpatient, 
  AlerteFacturation = :alertefacturation, 
 IndexTPVAlerteStocksTPV = :indextpvalertestockstpv,
  AlerteDemandeAbsence  = :alertedemandeabsence , 
 Synchronization = :synchronization, 
  AlerteEchueDebiteur = :alerteechuedebiteur, 
 AlerteDuesCreancier = :alerteduescreancier, 
 LastUpDateTime = :lastupdatetime ,
 IDLastUpDate = :idlastupdate, 
UserLastUpDateTime = :userlastupdatetime ,
 CodeAgence = :codeagence, 
 DateTime  = :datetime,  
IndexGroupe  = :indexgroupe,  
IDDateTime   = :iddatetime,   
 UserDateTime  = :userdatetime,  
 Archive  = :archive,  
ArchiveIDDate  = :archiveiddate,  
 ArchiveDate   = :archivedate,   
ArchiveUser  = :archiveuser,  
 ArchiveMotif   = :archivemotif,   
ArchiveDefinitive = :archivedefinitive, 
 ArchiveDefinitiveIDDate = :archivedefinitiveiddate, 
 ArchiveDefinitiveDate  = :archivedefinitivedate,  
 ArchiveDefinitiveUser = :archivedefinitiveuser, 
 ArchiveDefinitiveMotif  = :archivedefinitivemotif 
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
        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;

        //data
        $this->site = htmlspecialchars(strip_tags($data['Site']??"DEMO"));
        $this->indexe = htmlspecialchars(strip_tags($data['Indexe']??$uniqueId));
        $this->groupe = htmlspecialchars(strip_tags($data['groupe']??0));
        $this->nom = htmlspecialchars(strip_tags($data['nom']));
        $this->prenom = htmlspecialchars(strip_tags($data['prenom']));
        $this->passwords = htmlspecialchars(strip_tags($data['passwords']));
        $this->matricule  = htmlspecialchars(strip_tags($data['matricule']??0));
        $this->portee = htmlspecialchars(strip_tags($data['portee']??0));
        $this->porteesite = htmlspecialchars(strip_tags($data['PorteeSite']??0));
        $this->passworddemand = htmlspecialchars(strip_tags($data['PasswordDemand']??0));
        $this->visibilitevaleurstock = htmlspecialchars(strip_tags($data['VisibiliteValeurStock']??0));
        $this->bloquermodificationtitrefacture = htmlspecialchars(strip_tags($data['BloquerModificationTitreFacture']??0));
        $this->bloquerexportationetats = htmlspecialchars(strip_tags($data['BloquerExportationEtats']??0));
        $this->bloquerannulationfacture = htmlspecialchars(strip_tags($data['BloquerAnnulationFacture']??0));
        $this->activerrgltmultiplecreancier   = htmlspecialchars(strip_tags($data['ActiverRgltMultipleCreancier']??0));
        $this->entetepagedefaut  = htmlspecialchars(strip_tags($data['EntetePageDefaut']??0));
        $this->remisemax = htmlspecialchars(strip_tags($data['RemiseMax']??0));
        $this->valeurremisemax  = htmlspecialchars(strip_tags($data['ValeurRemiseMax']??0));
        $this->superviseur = htmlspecialchars(strip_tags($data['superviseur']??0));
        $this->modpointage = htmlspecialchars(strip_tags($data['MODPointage']??0));
        $this->modfinance  = htmlspecialchars(strip_tags($data['MODFinance']??0));
        $this->modgestionrh  = htmlspecialchars(strip_tags($data['MODGestionRH']??0));
        $this->modtelephonie  = htmlspecialchars(strip_tags($data['MODTelephonie']??0));
        $this->modcomptabilite = htmlspecialchars(strip_tags($data['MODComptabilite']??0));
        $this->modstocks = htmlspecialchars(strip_tags($data['MODStocks']??0));
        $this->modservice = htmlspecialchars(strip_tags($data['MODService']??0));
        $this->modsante  = htmlspecialchars(strip_tags($data['MODSante']??0));
        $this->archivedefinitive = htmlspecialchars(strip_tags($data['ArchiveDefinitive']??0));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($data['ArchiveDefinitiveMotif']??0));
        $this->modhotel = htmlspecialchars(strip_tags($data['MODHotel']??0));
        $this->modpaie = htmlspecialchars(strip_tags($data['MODPaie']??0));
        $this->alerteannivnaissance = htmlspecialchars(strip_tags($data['AlerteAnnivNaissance']??0));
        $this->alerteannivtravail = htmlspecialchars(strip_tags($data['AlerteAnnivTravail']??0));
        $this->alertecaissenoncloturee = htmlspecialchars(strip_tags($data['AlerteCaisseNonCloturee']??0));
        $this->alertestockstpv = htmlspecialchars(strip_tags($data['AlerteStocksTPV']??0));
        $this->alertetachegrc  = htmlspecialchars(strip_tags($data['AlerteTacheGRC']??0));
        $this->alerteticketsav = htmlspecialchars(strip_tags($data['AlerteTicketSAV']??0));
        $this->alertebiologie = htmlspecialchars(strip_tags($data['AlerteBiologie']??0));
        $this->alerteimagerie = htmlspecialchars(strip_tags($data['AlerteImagerie']??0));
        $this->alerteendoscopie = htmlspecialchars(strip_tags($data['AlerteEndoscopie']??0));
        $this->alertenotesurpatient = htmlspecialchars(strip_tags($data['AlerteNoteSurPatient']??0));
        $this->alertealarmesurpatient = htmlspecialchars(strip_tags($data['AlerteAlarmeSurPatient']??0));
        $this->alertefacturation = htmlspecialchars(strip_tags($data['AlerteFacturation']??0));
        $this->indextpvalertestockstpv = htmlspecialchars(strip_tags($data['IndexTPVAlerteStocksTPV']??0));
        $this->alertedemandeabsence  = htmlspecialchars(strip_tags($data['AlerteDemandeAbsence']??0));
        $this->alerteechuedebiteur  = htmlspecialchars(strip_tags($data['AlerteEchueDebiteur']??0));
        $this->alerteduescreancier = htmlspecialchars(strip_tags($data['AlerteDuesCreancier']??0));
        $this->indexgroupe = htmlspecialchars(strip_tags($data['IndexGroupe']??0));



        // $this->status = htmlspecialchars(strip_tags($data['status']));

        $this->date = htmlspecialchars(  date('d/m/Y'));

        $this->heure = htmlspecialchars(strip_tags( date('H:i')));

        // return ($this->heure) ;



        $iddate = strtotime($this->date);
        $idheure = strtotime($this->heure);
        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime);
        $txt = "New";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;
        $archiveiddate=strtotime($this->date );
        $archiveuser=$login;
        $archivedefintiveiddate=strtotime($this->date );
        $archivedefinitiveuser=$login;



        //Bind data
        $stmt->bindParam(':site', $site['Site'], PDO::PARAM_STR);
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':groupe', $this->groupe, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(':passwords', $this->passwords, PDO::PARAM_STR);
        $stmt->bindParam(':portee', $this->portee, PDO::PARAM_STR);
        $stmt->bindParam(':porteesite', $this->porteesite, PDO::PARAM_STR);
        $stmt->bindParam(':passworddemand', $this->passworddemand, PDO::PARAM_STR);
        $stmt->bindParam(':indexe', $uniqueId, PDO::PARAM_STR);
        //$stmt->bindParam(':iddate', $iddate, PDO::PARAM_INT);
        //$stmt->bindParam(':idheure', $idheure, PDO::PARAM_INT);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':codeagence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':visibilitevaleurstock', $this->visibilitevaleurstock, PDO::PARAM_STR);
        $stmt->bindParam(':bloquermodificationtitrefacture', $this->bloquermodificationtitrefacture, PDO::PARAM_STR);
        $stmt->bindParam(':bloquerexportationetats', $this->bloquerexportationetats , PDO::PARAM_STR);
        $stmt->bindParam(':bloquerannulationfacture', $this->bloquerannulationfacture, PDO::PARAM_STR);
        $stmt->bindParam(':activerrgltmultiplecreancier', $this->activerrgltmultiplecreancier, PDO::PARAM_INT);
        $stmt->bindParam(':entetepagedefaut', $this->entetepagedefaut, PDO::PARAM_STR);
        $stmt->bindParam(':remisemax', $this->remisemax, PDO::PARAM_STR);
        $stmt->bindParam(':valeurremisemax', $this->valeurremisemax, PDO::PARAM_STR);
        $stmt->bindParam(':superviseur', $this->superviseur, PDO::PARAM_STR);
        $stmt->bindParam(':modpointage', $this->modpointage, PDO::PARAM_STR);
        $stmt->bindParam(':modfinance', $this->modfinance, PDO::PARAM_INT);
        $stmt->bindParam(':modgestionrh', $this->modgestionrh, PDO::PARAM_STR);
        $stmt->bindParam(':modtelephonie', $this->modtelephonie, PDO::PARAM_STR);
        $stmt->bindParam(':modcomptabilite', $this->modcomptabilite, PDO::PARAM_STR);
        $stmt->bindParam(':modstocks', $this->modstocks, PDO::PARAM_STR);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveuser', $archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefintiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitiveuser', $archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':userlastupdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':modservice', $this->modservice, PDO::PARAM_STR);
        $stmt->bindParam(':modsante', $this->modsante, PDO::PARAM_STR);
        $stmt->bindParam(':modhotel', $this->modhotel, PDO::PARAM_STR);
        $stmt->bindParam(':modpaie', $this->modpaie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteannivnaissance', $this->alerteannivnaissance, PDO::PARAM_STR);
        $stmt->bindParam(':alerteannivtravail', $this->alerteannivtravail, PDO::PARAM_STR);
        $stmt->bindParam(':alertecaissenoncloturee', $this->alertecaissenoncloturee, PDO::PARAM_STR);
        $stmt->bindParam(':alertestockstpv', $this->alertestockstpv, PDO::PARAM_STR);
        $stmt->bindParam(':alertetachegrc', $this->alertetachegrc, PDO::PARAM_STR);
        $stmt->bindParam(':alerteticketsav', $this->alerteticketsav, PDO::PARAM_STR);
        $stmt->bindParam(':alertebiologie', $this->alertebiologie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteimagerie', $this->alerteimagerie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteendoscopie', $this->alerteendoscopie, PDO::PARAM_STR);
        $stmt->bindParam(':alertenotesurpatient', $this->alertenotesurpatient, PDO::PARAM_STR);
        $stmt->bindParam(':alertealarmesurpatient', $this->alertealarmesurpatient, PDO::PARAM_STR);
        $stmt->bindParam(':alertefacturation', $this->alertefacturation, PDO::PARAM_STR);
        $stmt->bindParam(':indextpvalertestockstpv', $this->indextpvalertestockstpv, PDO::PARAM_STR);
        $stmt->bindParam(':alertedemandeabsence', $this->alertedemandeabsence, PDO::PARAM_STR);
        $stmt->bindParam(':alerteechuedebiteur', $this->alerteechuedebiteur, PDO::PARAM_STR);
        $stmt->bindParam(':alerteduescreancier', $this->alerteduescreancier, PDO::PARAM_STR);
        $stmt->bindParam(':indexgroupe', $this->indexgroupe, PDO::PARAM_STR);

        // $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);

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
 groupe = :groupe,
  nom  = :nom,
 prenom = :prenom,
  passwords = :passwords,
  matricule = :matricule,
 portee  =:portee,
 PorteeSite = :porteesite,
  PasswordDemand = :passworddemand,
  VisibiliteValeurStock = :visibilitevaleurstock, 
  BloquerModificationTitreFacture = :bloquermodificationtitrefacture, 
  BloquerExportationEtats = :bloquerexportationetats, 
  BloquerAnnulationFacture = :bloquerannulationfacture ,
 ActiverRgltMultipleCreancier = :activerrgltmultiplecreancier, 
 EntetePageDefaut = :entetepagedefaut, 
  RemiseMax = :remisemax, 
 ValeurRemiseMax = :valeurremisemax, 
  superviseur = :superviseur,  
  MODPointage = :modpointage, 
 MODFinance  = :modfinance,  
 MODGestionRH  = :modgestionrh,  
 MODTelephonie = :modtelephonie, 
 MODComptabilite = :modcomptabilite, 
 MODStocks  = :modstocks,  
 MODService  = :modservice,  
 MODSante  = :modsante , 
 MODHotel   = :modhotel ,  
 MODPaie   = :modpaie,   
 AlerteAnnivNaissance = :alerteannivnaissance, 
  AlerteAnnivTravail = :alerteannivtravail, 
 AlerteCaisseNonCloturee = :alertecaissenoncloturee, 
 AlerteStocksTPV = :alertestockstpv, 
  AlerteTacheGRC = :alertetachegrc ,
 AlerteTicketSAV = :alerteticketsav,
 AlerteBiologie  = :alertebiologie,  
  AlerteImagerie = :alerteimagerie, 
   AlerteEndoscopie = :alerteendoscopie, 
 AlerteNoteSurPatient = :alertenotesurpatient, 
  AlerteAlarmeSurPatient = :alertealarmesurpatient, 
  AlerteFacturation = :alertefacturation, 
 IndexTPVAlerteStocksTPV = :indextpvalertestockstpv,
  AlerteDemandeAbsence  = :alertedemandeabsence , 
 Synchronization = :synchronization, 
  AlerteEchueDebiteur = :alerteechuedebiteur, 
 AlerteDuesCreancier = :alerteduescreancier, 
 LastUpDateTime = :lastupdatetime ,
 IDLastUpDate = :idlastupdate, 
UserLastUpDateTime = :userlastupdatetime ,
 CodeAgence = :codeagence, 
 DateTime  = :datetime,  
IndexGroupe  = :indexgroupe,  
IDDateTime   = :iddatetime,   
 UserDateTime  = :userdatetime,  
 Archive  = :archive,  
ArchiveIDDate  = :archiveiddate,  
 ArchiveDate   = :archivedate,   
ArchiveUser  = :archiveuser,  
 ArchiveMotif   = :archivemotif,   
ArchiveDefinitive = :archivedefinitive, 
 ArchiveDefinitiveIDDate = :archivedefinitiveiddate, 
 ArchiveDefinitiveDate  = :archivedefinitivedate,  
 ArchiveDefinitiveUser = :archivedefinitiveuser, 
 ArchiveDefinitiveMotif  = :archivedefinitivemotif 
        WHERE NEng = :courrierId";
        $stmt = $this->conn->prepare($query);

        //data
        $this->site = htmlspecialchars(strip_tags($new_data['Site']??$current['Site']??"DEMO"));
        $this->groupe = htmlspecialchars(strip_tags($new_data['groupe']??$current['groupe']??"aucun"));
        $this->indexe = htmlspecialchars(strip_tags($new_data['Indexe']??$current['Indexe']));
        $this->nom = htmlspecialchars(strip_tags($new_data['nom']??$current['nom']));
        $this->prenom = htmlspecialchars(strip_tags($new_data['prenom']??$current['prenom']));
        $this->passwords = htmlspecialchars(strip_tags($new_data['passwords']??$current['passwords']));
        $this->matricule  = htmlspecialchars(strip_tags($new_data['matricule']??$current['matricule']??0));
        $this->portee = htmlspecialchars(strip_tags($new_data['portee']??$current['portee']??0));
        $this->porteesite = htmlspecialchars(strip_tags($new_data['PorteeSite']??$current['PorteeSite']??0));
        $this->passworddemand = htmlspecialchars(strip_tags($new_data['PasswordDemand']??$current['PasswordDemand']??0));
        $this->visibilitevaleurstock = htmlspecialchars(strip_tags($new_data['VisibiliteValeurStock']??$current['VisibiliteValeurStock']??0));
        $this->bloquermodificationtitrefacture = htmlspecialchars(strip_tags($new_data['BloquerModificationTitreFacture']??$current['BloquerModificationTitreFacture']??0));
        $this->bloquerexportationetats = htmlspecialchars(strip_tags($new_data['BloquerExportationEtats']??$current['BloquerExportationEtats']??0));
        $this->bloquerannulationfacture = htmlspecialchars(strip_tags($new_data['BloquerAnnulationFacture']??$current['BloquerAnnulationFacture']??0));
        $this->activerrgltmultiplecreancier   = htmlspecialchars(strip_tags($new_data['ActiverRgltMultipleCreancier']??$current['ActiverRgltMultipleCreancier']??0));
        $this->entetepagedefaut  = htmlspecialchars(strip_tags($new_data['EntetePageDefaut']??$current['EntetePageDefaut']??0));
        $this->remisemax = htmlspecialchars(strip_tags($new_data['RemiseMax']??$current['RemiseMax']??0));
        $this->valeurremisemax  = htmlspecialchars(strip_tags($new_data['ValeurRemiseMax']??$current['ValeurRemiseMax']??0));
        $this->superviseur = htmlspecialchars(strip_tags($new_data['superviseur']??$current['superviseur']??0));
        $this->modpointage = htmlspecialchars(strip_tags($new_data['MODPointage']??$current['MODPointage']??0));
        $this->modfinance  = htmlspecialchars(strip_tags($new_data['MODFinance']??$current['MODFinance']??0));
        $this->modgestionrh  = htmlspecialchars(strip_tags($new_data['MODGestionRH']??$current['MODGestionRH']??0));
        $this->modtelephonie  = htmlspecialchars(strip_tags($new_data['MODTelephonie']??$current['MODTelephonie']??0));
        $this->modcomptabilite = htmlspecialchars(strip_tags($new_data['MODComptabilite']??$current['MODComptabilite']??0));
        $this->modstocks = htmlspecialchars(strip_tags($new_data['MODStocks']??$current['MODStocks']??0));
        $this->modservice = htmlspecialchars(strip_tags($new_data['MODService']??$current['MODService']??0));
        $this->modsante  = htmlspecialchars(strip_tags($new_data['MODSante']??$current['MODSante']??0));
        $this->archivedefinitive = htmlspecialchars(strip_tags($new_data['ArchiveDefinitive']??$current['ArchiveDefinitive']??0));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveMotif']??$current['ArchiveDefinitiveMotif']??0));
        $this->modhotel = htmlspecialchars(strip_tags($new_data['MODHotel']??$current['MODHotel']??0));
        $this->modpaie = htmlspecialchars(strip_tags($new_data['MODPaie']??$current['MODPaie']??0));
        $this->alerteannivnaissance = htmlspecialchars(strip_tags($new_data['AlerteAnnivNaissance']??$current['AlerteAnnivNaissance']??0));
        $this->alerteannivtravail = htmlspecialchars(strip_tags($new_data['AlerteAnnivTravail']??$current['AlerteAnnivTravail']??0));
        $this->alertecaissenoncloturee = htmlspecialchars(strip_tags($new_data['AlerteCaisseNonCloturee']??$current['AlerteCaisseNonCloturee']??0));
        $this->alertestockstpv = htmlspecialchars(strip_tags($new_data['AlerteStocksTPV']??$current['AlerteStocksTPV']??0));
        $this->alertetachegrc  = htmlspecialchars(strip_tags($new_data['AlerteTacheGRC']??$current['AlerteTacheGRC']??0));
        $this->alerteticketsav = htmlspecialchars(strip_tags($new_data['AlerteTicketSAV']??$current['AlerteTicketSAV']??0));
        $this->alertebiologie = htmlspecialchars(strip_tags($new_data['AlerteBiologie']??$current['AlerteBiologie']??0));
        $this->alerteimagerie = htmlspecialchars(strip_tags($new_data['AlerteImagerie']??$current['AlerteImagerie']??0));
        $this->alerteendoscopie = htmlspecialchars(strip_tags($new_data['AlerteEndoscopie']??$current['AlerteEndoscopie']??0));
        $this->alertenotesurpatient = htmlspecialchars(strip_tags($new_data['AlerteNoteSurPatient']??$current['AlerteNoteSurPatient']??0));
        $this->alertealarmesurpatient = htmlspecialchars(strip_tags($new_data['AlerteAlarmeSurPatient']??$current['AlerteAlarmeSurPatient']??0));
        $this->alertefacturation = htmlspecialchars(strip_tags($new_data['AlerteFacturation']??$current['AlerteFacturation']??0));
        $this->indextpvalertestockstpv = htmlspecialchars(strip_tags($new_data['IndexTPVAlerteStocksTPV']??$current['IndexTPVAlerteStocksTPV']??0));
        $this->alertedemandeabsence  = htmlspecialchars(strip_tags($new_data['AlerteDemandeAbsence']??$current['AlerteDemandeAbsence']??0));
        $this->alerteechuedebiteur  = htmlspecialchars(strip_tags($new_data['AlerteEchueDebiteur']??$current['AlerteEchueDebiteur']??0));
        $this->alerteduescreancier = htmlspecialchars(strip_tags($new_data['AlerteDuesCreancier']??$current['AlerteDuesCreancier']??0));
        $this->indexgroupe = htmlspecialchars(strip_tags($new_data['IndexGroupe']??$current['IndexGroupe']??0));

        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));


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
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':groupe', $this->groupe, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $stmt->bindParam(':passwords', $this->passwords, PDO::PARAM_STR);
        $stmt->bindParam(':portee', $this->portee, PDO::PARAM_STR);
        $stmt->bindParam(':porteesite', $this->porteesite, PDO::PARAM_STR);
        $stmt->bindParam(':passworddemand', $this->passworddemand, PDO::PARAM_STR);
        $stmt->bindParam(':indexe', $this->indexe, PDO::PARAM_STR);
        //$stmt->bindParam(':iddate', $iddate, PDO::PARAM_INT);
        //$stmt->bindParam(':idheure', $idheure, PDO::PARAM_INT);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':codeagence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':visibilitevaleurstock', $this->visibilitevaleurstock, PDO::PARAM_STR);
        $stmt->bindParam(':bloquermodificationtitrefacture', $this->bloquermodificationtitrefacture, PDO::PARAM_STR);
        $stmt->bindParam(':bloquerexportationetats', $this->bloquerexportationetats , PDO::PARAM_STR);
        $stmt->bindParam(':bloquerannulationfacture', $this->bloquerannulationfacture, PDO::PARAM_STR);
        $stmt->bindParam(':activerrgltmultiplecreancier', $this->activerrgltmultiplecreancier, PDO::PARAM_INT);
        $stmt->bindParam(':entetepagedefaut', $this->entetepagedefaut, PDO::PARAM_STR);
        $stmt->bindParam(':remisemax', $this->remisemax, PDO::PARAM_STR);
        $stmt->bindParam(':valeurremisemax', $this->valeurremisemax, PDO::PARAM_STR);
        $stmt->bindParam(':superviseur', $this->superviseur, PDO::PARAM_STR);
        $stmt->bindParam(':modpointage', $this->modpointage, PDO::PARAM_STR);
        $stmt->bindParam(':modfinance', $this->modfinance, PDO::PARAM_INT);
        $stmt->bindParam(':modgestionrh', $this->modgestionrh, PDO::PARAM_STR);
        $stmt->bindParam(':modtelephonie', $this->modtelephonie, PDO::PARAM_STR);
        $stmt->bindParam(':modcomptabilite', $this->modcomptabilite, PDO::PARAM_STR);
        $stmt->bindParam(':modstocks', $this->modstocks, PDO::PARAM_STR);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveuser', $archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefintiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitiveuser', $archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':userlastupdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':modservice', $this->modservice, PDO::PARAM_STR);
        $stmt->bindParam(':modsante', $this->modsante, PDO::PARAM_STR);
        $stmt->bindParam(':modhotel', $this->modhotel, PDO::PARAM_STR);
        $stmt->bindParam(':modpaie', $this->modpaie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteannivnaissance', $this->alerteannivnaissance, PDO::PARAM_STR);
        $stmt->bindParam(':alerteannivtravail', $this->alerteannivtravail, PDO::PARAM_STR);
        $stmt->bindParam(':alertecaissenoncloturee', $this->alertecaissenoncloturee, PDO::PARAM_STR);
        $stmt->bindParam(':alertestockstpv', $this->alertestockstpv, PDO::PARAM_STR);
        $stmt->bindParam(':alertetachegrc', $this->alertetachegrc, PDO::PARAM_STR);
        $stmt->bindParam(':alerteticketsav', $this->alerteticketsav, PDO::PARAM_STR);
        $stmt->bindParam(':alertebiologie', $this->alertebiologie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteimagerie', $this->alerteimagerie, PDO::PARAM_STR);
        $stmt->bindParam(':alerteendoscopie', $this->alerteendoscopie, PDO::PARAM_STR);
        $stmt->bindParam(':alertenotesurpatient', $this->alertenotesurpatient, PDO::PARAM_STR);
        $stmt->bindParam(':alertealarmesurpatient', $this->alertealarmesurpatient, PDO::PARAM_STR);
        $stmt->bindParam(':alertefacturation', $this->alertefacturation, PDO::PARAM_STR);
        $stmt->bindParam(':indextpvalertestockstpv', $this->indextpvalertestockstpv, PDO::PARAM_STR);
        $stmt->bindParam(':alertedemandeabsence', $this->alertedemandeabsence, PDO::PARAM_STR);
        $stmt->bindParam(':alerteechuedebiteur', $this->alerteechuedebiteur, PDO::PARAM_STR);
        $stmt->bindParam(':alerteduescreancier', $this->alerteduescreancier, PDO::PARAM_STR);
        $stmt->bindParam(':indexgroupe', $this->indexgroupe, PDO::PARAM_STR);
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
        $query = "UPDATE {$this->table} SET Supprimer = 1 WHERE NEng = :courierId";

        // Sanitize and assign the courier ID
        $courierId = htmlspecialchars(strip_tags($id));

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($query);

        // Bind the courier ID parameter
        $stmt->bindParam(':courierId', $courierId, PDO::PARAM_INT);

        // Execute the SQL statement
        $stmt->execute();

        // Return the number of rows affected by the delete operation
        return $stmt->rowCount();
    }
}
