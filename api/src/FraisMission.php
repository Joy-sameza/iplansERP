<?php
class FraisMission
{
    //DB require stuff
    private $conn;
    private $table = 'detailnotesfraismission';

    //Properties for pers
    public $courrierId;
    public $site;
    public $date;

    public $indexe;
    public $codebanque;
    private $transportparjour;
    private $transport;
    private $logementparjour;
    private $logement;
    private $nutritionparjour;
    private $nutrition;
    private $perdiemeparjour;
    private $perdieme;
    private $autresparjour;
    private $autres;
    private $totalparjour;
    private $totalfrais;
    private $caburant;
    private $archivemotif;
    private $archivedefinitive;
    private $archivedefinitivedate;
    private $numnote;
    private $modereglement;
    private $pseudoaccorde;
    private $idheureaccordee;
    private $iddateaccordee;
    private $montantaccorde;
    private $idreglement;
    private $heureaccordee;
    private $dateaccordee;
    private $datecreation;
    private $iddatecreation;
    private $archive;
    private $archivedate;
    private $archivedefinitivemotif;
    private $civilite;
    private $creerpar;
    private $indexmission;
    private $synchronization;
    private $idlastupdate;
    private $userlastupdatetime;
    private $codeagence;
    private $datetime;
    private $iddatetime;
    private $userdatetime;
    private $archiveiddate;
    private $archiveuser;
    private $archivedefinitiveiddate;
    private $archivedefinitiveuser;

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
        $query = "SELECT * FROM  {$this->table} ";

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

    // Create a new frais de mission
    public function create(array $data): string | false
    {
        $query = "INSERT INTO {$this->table} 
                    SET  
                        Site = :site,
                        Indexe  = :indexe,
                        NumNote  = :numnote,
                        ModeReglement= :modereglement,
                          PseudoAccorde= :pseudoaccorde,
                        TransportParJour= :transportparjour,
                        Transport= :transport,
                        LogementParJour= :logementparjour,
                        Logement= :logement,
                        NutritionParJour= :nutritionparjour,
                        Nutrition= :nutrition,
                        PerdiemeParJour= :perdiemeparjour,
                        Perdieme= :perdieme,
                        AutresParJour= :autresparjour,
                        Autres= :autres,
                        TotalPArJour= :totalparjour,
                        TotalFrais= :totalfrais,
                        IDHeureAccordee= :idheureaccordee,
                        IDDateAccordee= :iddateaccordee,
                        MontantAccorde= :montantaccorde, 
                        IDReglement= :idreglement,
                        HeureAccordee= :heureaccordee,
                        DateAccordee= :dateaccordee,
                        DateCreation= :datecreation,
                        IDDateCreation= :iddatecreation,
                        CreePar= :creerpar,
                        IndexMission= :indexmission,
                        Carburant= :caburant,
                        Synchronization= :synchronization,
                        LastUpDateTime = :lastupdatetime,
                        IDLastUpDate= :idlastupdate,
                        UserLastUpDateTime= :userlastupdatetime,
                        CodeAgence= :codeagence,
                        DateTime= :datetime,
                        IDDateTime= :iddatetime,
                        UserDateTime= :userdatetime,
                        Archive= :archive,
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
        $this->transportparjour = htmlspecialchars(strip_tags($data['TransportParJour']));
        $this->transport = htmlspecialchars(strip_tags($data['Transport']));
        $this->logementparjour = htmlspecialchars(strip_tags($data['LogementParJour']));
        $this->logement = htmlspecialchars(strip_tags($data['Logement']));
        $this->nutritionparjour = htmlspecialchars(strip_tags($data['NutritionParJour']));
        $this->nutrition = htmlspecialchars(strip_tags($data['Nutrition']));
        $this->perdiemeparjour = htmlspecialchars(strip_tags($data['PerdiemeParJour']));
        $this->perdieme = htmlspecialchars(strip_tags($data['Perdieme']));
        $this->autresparjour = htmlspecialchars(strip_tags($data['AutresParJour']));
        $this->autres = htmlspecialchars(strip_tags($data['Autres']));
        $this->totalparjour = htmlspecialchars(strip_tags($data['TotalPArJour']));
        $this->totalfrais = htmlspecialchars(strip_tags($data['TotalFrais']));
        $this->caburant = htmlspecialchars(strip_tags($data['Carburant']));
        $this->archivedefinitive= htmlspecialchars(strip_tags($data['ArchiveDefinitive']??0));
        $this->archivemotif= htmlspecialchars(strip_tags($data['ArchiveMotif']??0));
        $this->archivedefinitive= htmlspecialchars(strip_tags($data['ArchiveDefinitive']??0));
        $this->archivedefinitivedate= htmlspecialchars(strip_tags($data['ArchiveDefinitiveDate']??0));
        $this->numnote= htmlspecialchars(strip_tags($data['NumNote']??0));
        $this->modereglement= htmlspecialchars(strip_tags($data['ModeReglement']??0));
        $this->pseudoaccorde= htmlspecialchars(strip_tags($data['PseudoAccorde']??0));
        $this->montantaccorde= htmlspecialchars(strip_tags($data['MontantAccorde']??0));
        $this->idheureaccordee= htmlspecialchars(strip_tags($data['IDHeureAccordee']??0));
        $this->iddateaccordee= htmlspecialchars(strip_tags($data['IDDateAccordee']??0));
        $this->montantaccorde= htmlspecialchars(strip_tags($data['MontantAccorde']??0));
        $this->idreglement= htmlspecialchars(strip_tags($data['IDReglement']??0));
        $this->heureaccordee= htmlspecialchars(strip_tags($data['HeureAccordee']??0));
        $this->dateaccordee= htmlspecialchars(strip_tags($data['DateAccordee']??0));
        $this->datecreation= htmlspecialchars(strip_tags($data['DateCreation']??0));
        $this->iddatecreation= htmlspecialchars(strip_tags($data['IDDateCreation']??0));




        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;


        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime) ?? 0;
        $archivedefinitiveiddate = strtotime($this->archivedefinitivedate) ?? 0;

        $txt = "New";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;
        $archiveiddate=strtotime(date('H:i:s', time() - 1 * 60 * 60));
        $archiveuser=$login;
        $archivedefintiveiddate=strtotime(date('H:i:s', time() - 1 * 60 * 60));
        $archivedefinitiveuser=$login;


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
        $stmt->bindParam(':datecreation', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':transportparjour', $this->transportparjour, PDO::PARAM_INT);
        $stmt->bindParam(':transport', $this->transport, PDO::PARAM_INT);
        $stmt->bindParam(':logementparjour', $this->logementparjour, PDO::PARAM_INT);
        $stmt->bindParam(':logement', $this->logement , PDO::PARAM_INT);
        $stmt->bindParam(':nutritionparjour', $this->nutritionparjour, PDO::PARAM_INT);
        $stmt->bindParam(':nutrition', $this->nutrition, PDO::PARAM_INT);
        $stmt->bindParam(':perdiemeparjour', $this->perdiemeparjour, PDO::PARAM_INT);
        $stmt->bindParam(':perdieme', $this->perdieme, PDO::PARAM_INT);
        $stmt->bindParam(':autresparjour', $this->autresparjour, PDO::PARAM_INT);
        $stmt->bindParam(':autres', $this->autres, PDO::PARAM_INT);
        $stmt->bindParam(':totalparjour', $this->totalparjour, PDO::PARAM_INT);
        $stmt->bindParam(':totalfrais', $this->totalfrais, PDO::PARAM_INT);
        $stmt->bindParam(':caburant', $this->caburant, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $this->archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveuser', $archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefinitiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitiveuser', $archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':indexmission', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':creerpar', $login, PDO::PARAM_STR);
        $stmt->bindParam(':idheureaccordee', $this->idheureaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':iddateaccordee', $this->iddateaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':montantaccorde', $this->montantaccorde, PDO::PARAM_INT);
        $stmt->bindParam(':idreglement', $this->idreglement, PDO::PARAM_INT);
        $stmt->bindParam(':heureaccordee', $this->heureaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':dateaccordee', $this->dateaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':iddatecreation', $this->iddatecreation, PDO::PARAM_INT);
        $stmt->bindParam(':numnote', $this->numnote, PDO::PARAM_INT);
        $stmt->bindParam(':modereglement', $this->modereglement, PDO::PARAM_INT);
        $stmt->bindParam(':pseudoaccorde', $this->pseudoaccorde, PDO::PARAM_INT);


        //Execute statement
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    // Update a frais de mission
    public function update(array $current, array $new_data): int | bool
    {
        $query = "UPDATE {$this->table} 
        SET 
  
  Site = :site,
Indexe  = :indexe,
NumNote  = :numnote,
ModeReglement= :modereglement,
  PseudoAccorde= :pseudoaccorde,
 TransportParJour= :transportparjour,
Transport= :transport,
 LogementParJour= :logementparjour,
 Logement= :logement,
NutritionParJour= :nutritionparjour,
 Nutrition= :nutrition,
PerdiemeParJour= :perdiemeparjour,
 Perdieme= :perdieme,
AutresParJour= :autresparjour,
Autres= :autres,
TotalPArJour= :totalparjour,
TotalFrais= :totalfrais,
 IDHeureAccordee= :idheureaccordee,
 IDDateAccordee= :iddateaccordee,
 MontantAccorde= :montantaccorde, 
IDReglement= :idreglement,
 HeureAccordee= :heureaccordee,
DateAccordee= :dateaccordee,
DateCreation= :datecreation,
IDDateCreation= :iddatecreation,
CreePar= :creerpar,
IndexMission= :indexmission,
 Carburant= :caburant,
Synchronization= :synchronization,
LastUpDateTime = :lastupdatetime,
IDLastUpDate= :idlastupdate,
UserLastUpDateTime= :userlastupdatetime,
 CodeAgence= :codeagence,
DateTime= :datetime,
IDDateTime= :iddatetime,
UserDateTime= :userdatetime,
 Archive= :archive,
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
        $this->civilite = htmlspecialchars(strip_tags($new_data['Indexe'] ?? $current['Indexe']));
        $this->pseudoaccorde = htmlspecialchars(strip_tags($new_data['PseudoAccorde'] ?? $current['PseudoAccorde']));
        $this->numnote = htmlspecialchars(strip_tags($new_data['NumNote'] ?? $current['NumNote']));
        $this->modereglement = htmlspecialchars(strip_tags($new_data['ModeReglement'] ?? $current['ModeReglement']));
        $this->transportparjour = htmlspecialchars(strip_tags($new_data['TransportParJour'] ?? $current['TransportParJour']));
        $this->transport = htmlspecialchars(strip_tags($new_data['Transport'] ?? $current['Transport']));
        $this->logementparjour = htmlspecialchars(strip_tags($new_data['LogementParJour'] ?? $current['LogementParJour']));
        $this->logement = htmlspecialchars(strip_tags($new_data['Logement'] ?? $current['Logement']));
        $this->nutritionparjour = htmlspecialchars(strip_tags($new_data['NutritionParJour'] ?? $current['NutritionParJour']));
        $this->nutrition = htmlspecialchars(strip_tags($new_data['Nutrition'] ?? $current['Nutrition']));
        $this->perdiemeparjour = htmlspecialchars(strip_tags($new_data['PerdiemeParJour'] ?? $current['PerdiemeParJour']));
        $this->perdieme = htmlspecialchars(strip_tags($new_data['Perdieme'] ?? $current['Perdieme']));
        $this->autresparjour = htmlspecialchars(strip_tags($new_data['AutresParJour'] ?? $current['AutresParJour']));
        $this->autres = htmlspecialchars(strip_tags($new_data['Autres'] ?? $current['Autres']));
        $this->totalparjour = htmlspecialchars(strip_tags($new_data['TotalPArJour'] ?? $current['TotalPArJour']));
        $this->totalfrais = htmlspecialchars(strip_tags($new_data['TotalFrais'] ?? $current['TotalFrais']));
        $this->idheureaccordee = htmlspecialchars(strip_tags($new_data['IDHeureAccordee'] ?? $current['IDHeureAccordee']));
        $this->iddateaccordee = htmlspecialchars(strip_tags($new_data['IDDateAccordee'] ?? $current['IDDateAccordee']));
        $this->montantaccorde = htmlspecialchars(strip_tags($new_data['MontantAccorde'] ?? $current['MontantAccorde']));
        $this->idreglement = htmlspecialchars(strip_tags($new_data['IDReglement'] ?? $current['IDReglement']));
        $this->heureaccordee = htmlspecialchars(strip_tags($new_data['HeureAccordee'] ?? $current['HeureAccordee']));
        $this->dateaccordee = htmlspecialchars(strip_tags($new_data['DateAccordee'] ?? $current['DateAccordee']));
        $this->datecreation = htmlspecialchars(strip_tags($new_data['DateCreation'] ?? $current['DateCreation']));
        $this->iddatecreation = htmlspecialchars(strip_tags($new_data['IDDateCreation'] ?? $current['IDDateCreation']));
        $this->creerpar = htmlspecialchars(strip_tags($new_data['CreePar'] ?? $current['CreePar']));
        $this->indexmission = htmlspecialchars(strip_tags($new_data['IndexMission'] ?? $current['IndexMission']));
        $this->caburant = htmlspecialchars(strip_tags($new_data['Carburant'] ?? $current['Carburant']));
        $this->synchronization = htmlspecialchars(strip_tags($new_data['Synchronization'] ?? $current['Synchronization']));
        $this->idlastupdate = htmlspecialchars(strip_tags($new_data['IDLastUpDate'] ?? $current['IDLastUpDate']));
        $this->userlastupdatetime = htmlspecialchars(strip_tags($new_data['UserLastUpDateTime'] ?? $current['UserLastUpDateTime']));
        $this->codeagence = htmlspecialchars(strip_tags($new_data['CodeAgence'] ?? $current['CodeAgence']));
        $this->datetime = htmlspecialchars(strip_tags($new_data['DateTime'] ?? $current['DateTime']));
        $this->iddatetime = htmlspecialchars(strip_tags($new_data['IDDateTime'] ?? $current['IDDateTime']));
        $this->userdatetime = htmlspecialchars(strip_tags($new_data['UserDateTime'] ?? $current['UserDateTime']));
        $this->archive = htmlspecialchars(strip_tags($new_data['Archive'] ?? $current['Archive']));
        $this->archiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveIDDate'] ?? $current['ArchiveIDDate']));
        $this->archivedate = htmlspecialchars(strip_tags($new_data['ArchiveDate'] ?? $current['ArchiveDate']));
        $this->archiveuser = htmlspecialchars(strip_tags($new_data['ArchiveUser'] ?? $current['ArchiveUser']));
        $this->archivemotif = htmlspecialchars(strip_tags($new_data['ArchiveMotif'] ?? $current['ArchiveMotif']));
        $this->archivedefinitive = htmlspecialchars(strip_tags($new_data['ArchiveDefinitive'] ?? $current['ArchiveDefinitive']));
        $this->archivedefinitiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveIDDate'] ?? $current['ArchiveDefinitiveIDDate']));
        $this->archivedefinitivedate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveDate'] ?? $current['ArchiveDefinitiveDate']));
        $this->archivedefinitiveuser= htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveUser'] ?? $current['ArchiveDefinitiveUser']));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveMotif'] ?? $current['ArchiveDefinitiveMotif']));
        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));



        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;


        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime) ?? 0;
        $archivedefinitiveiddate = strtotime($this->archivedefinitivedate) ?? 0;

        $txt = "Modified";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;
        $archiveiddate=strtotime(date('H:i:s', time() - 1 * 60 * 60));
        $archiveuser=$login;
        $archivedefintiveiddate=strtotime(date('H:i:s', time() - 1 * 60 * 60));
        $archivedefinitiveuser=$login;


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
        $stmt->bindParam(':datecreation', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':transportparjour', $this->transportparjour, PDO::PARAM_INT);
        $stmt->bindParam(':transport', $this->transport, PDO::PARAM_INT);
        $stmt->bindParam(':logementparjour', $this->logementparjour, PDO::PARAM_INT);
        $stmt->bindParam(':logement', $this->logement , PDO::PARAM_INT);
        $stmt->bindParam(':nutritionparjour', $this->nutritionparjour, PDO::PARAM_INT);
        $stmt->bindParam(':nutrition', $this->nutrition, PDO::PARAM_INT);
        $stmt->bindParam(':perdiemeparjour', $this->perdiemeparjour, PDO::PARAM_INT);
        $stmt->bindParam(':perdieme', $this->perdieme, PDO::PARAM_INT);
        $stmt->bindParam(':autresparjour', $this->autresparjour, PDO::PARAM_INT);
        $stmt->bindParam(':autres', $this->autres, PDO::PARAM_INT);
        $stmt->bindParam(':totalparjour', $this->totalparjour, PDO::PARAM_INT);
        $stmt->bindParam(':totalfrais', $this->totalfrais, PDO::PARAM_INT);
        $stmt->bindParam(':caburant', $this->caburant, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $this->archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveiddate', $archiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archiveuser', $archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $archivedefinitiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $archivedefinitivedate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitiveuser', $archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':indexmission', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':creerpar', $login, PDO::PARAM_STR);
        $stmt->bindParam(':idheureaccordee', $this->idheureaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':iddateaccordee', $this->iddateaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':montantaccorde', $this->montantaccorde, PDO::PARAM_INT);
        $stmt->bindParam(':idreglement', $this->idreglement, PDO::PARAM_INT);
        $stmt->bindParam(':heureaccordee', $this->heureaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':dateaccordee', $this->dateaccordee, PDO::PARAM_INT);
        $stmt->bindParam(':iddatecreation', $this->iddatecreation, PDO::PARAM_INT);
        $stmt->bindParam(':numnote', $this->numnote, PDO::PARAM_INT);
        $stmt->bindParam(':modereglement', $this->modereglement, PDO::PARAM_INT);
        $stmt->bindParam(':pseudoaccorde', $this->pseudoaccorde, PDO::PARAM_INT);
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
