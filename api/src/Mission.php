<?php
class Mission
{
    //DB require stuff
    private $conn;
    private $table = 'mission';

    //Properties for courriers
    public $missionId;
    public $destination;
    public $mode_deplacement;
    public $cadre;
    public $site;
    public $date_depart;
    public $date_retour;
    public $nature_changement;
    public $prise_charge;
    public $duree_travail_jour;
    public $nombrejour;
    private $immatriculation;
    private $num_bl_lta;
    private $num_dossier;
    private $nom_prenom;
    private $rapport_mission;

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
                        site = :site, 
                        matricule = :matricule, 
                        Departement = :departement, 
                        dest = :dest, 
                        via = :via, 
                        cadre = :cadre, 
                       Rapport = :rapport, 
                        dat = :dat, 
                        DateCreation = :datecreation,
                        Indexe = :indexe,
                        duree = :duree,
                        duree_travail = :duree_travail,
                        motor = :motor,
                        IndexEvenement = :IndexEvenement,
                        IndexDossierLogistique = :IndexDossierLogistique,
                        Synchronization = :synchronization,
                        NumeroDossier = :numerodossier,
                        NumeroBL_LTA = :numerobl_lta,
                        charge = :charge,
                        mat = :mat,
                        state = :state,
                        PriseEnCharge = :priseencharge,
                        Note_de_Frais = :note_de_frais,
                    IDDateDebut = :iddatedebut,
                        BlockPointage = :blockpointage,
                        historique = :historique,
                        Lieux = :lieux,
                        LastUpDateTime = :lastupdatetime, 
                         IDLastUpDate = :idlastupdate,
                        UserLastUpDateTime = :userlastupdatetime,
                        CodeAgence = :codeagence,
                        DateTime = :datetime,
                        IDDateTime = :iddatetime,
                    UserDateTime = :userdatetime,
                        archive = :archive,
                        ArchiveIDDate = :archiveiddate,
                        ArchiveDate = :archivedate,
                        ArchiveUser = :archiveuser,
                    ArchiveMotif = :archivemotif,
                        ArchiveDefinitive = :archivedefinitive,
                        ArchiveDefinitiveIDDate = :archivedefinitiveiddate,
                        ArchiveDefinitiveDate = :archivedefinitivedate,
                        ArchiveDefinitiveUser = :archivedefinitiveuser,
                       ArchiveDefinitiveMotif = :archivedefinitivemotif
                        -- Statut = :status
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
        $this->matricule = htmlspecialchars(strip_tags($data['matricule']));
        $this->departement = htmlspecialchars(strip_tags($data['Departement']));
        $this->dest = htmlspecialchars(strip_tags($data['dest']));
        $this->via = htmlspecialchars(strip_tags($data['via']));
        $this->cadre = htmlspecialchars(strip_tags($data['cadre']));
        $this->motor = htmlspecialchars(strip_tags($data['motor']));
        $this->rapport  = htmlspecialchars(strip_tags($data['Rapport']));
        $this->duree = htmlspecialchars(strip_tags($data['duree']));
        $this->duree_travail = htmlspecialchars(strip_tags($data['duree_travail']));
        $this->indexEvenement = htmlspecialchars(strip_tags($data['IndexEvenement']));
        $this->indexdossierlogistique = htmlspecialchars(strip_tags($data['IndexDossierLogistique']));
        $this->numerodossier = htmlspecialchars(strip_tags($data['NumeroDossier']));
        $this->Numerobl_lta = htmlspecialchars(strip_tags($data['NumeroBL_LTA']));
        $this->mat = htmlspecialchars(strip_tags($data['mat']));
        $this->state = htmlspecialchars(strip_tags($data['state']));
        $this->priseencharge = htmlspecialchars(strip_tags($data['PriseEnCharge']));
        $this->note_de_frais = htmlspecialchars(strip_tags($data['Note_de_Frais']));
        $this->blockpointage = htmlspecialchars(strip_tags($data['BlockPointage']));
        $this->historique = htmlspecialchars(strip_tags($data['historique']));
        $this->charge = htmlspecialchars(strip_tags($data['charge']));
        $this->lieux = htmlspecialchars(strip_tags($data['Lieux']));
        $this->archive = htmlspecialchars(strip_tags($data['Archive']));
        $this->archivemotif  = htmlspecialchars(strip_tags($data['ArchiveMotif']));
        $this->archivedefinitive = htmlspecialchars(strip_tags($data['ArchiveDefinitive']));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($data['ArchiveDefinitiveMotif']));


        // $this->status = htmlspecialchars(strip_tags($data['status']));

        $this->date = htmlspecialchars(  date('d/m/Y'));

        $this->heure = htmlspecialchars(strip_tags( date('H:i')));

        // return ($this->heure) ;

        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;

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
        $stmt->bindParam(':departement', $this->departement, PDO::PARAM_STR);
        $stmt->bindParam(':dest', $this->dest, PDO::PARAM_STR);
        $stmt->bindParam(':via', $this->via, PDO::PARAM_STR);
        $stmt->bindParam(':cadre', $this->cadre, PDO::PARAM_STR);
        $stmt->bindParam(':rapport', $this->rapport, PDO::PARAM_STR);
        $stmt->bindParam(':dat', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':datecreation', $this->date, PDO::PARAM_STR);
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
        $stmt->bindParam(':duree', $this->duree, PDO::PARAM_STR);
        $stmt->bindParam(':duree_travail', $this->duree_travail, PDO::PARAM_STR);
        $stmt->bindParam(':IndexEvenement', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':IndexDossierLogistique', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':numerodossier', $this->numerodossier, PDO::PARAM_INT);
        $stmt->bindParam(':numerobl_lta', $this->numerobl_lta, PDO::PARAM_STR);
        $stmt->bindParam(':charge', $this->charge, PDO::PARAM_STR);
        $stmt->bindParam(':mat', $this->mat, PDO::PARAM_STR);
        $stmt->bindParam(':state', $this->state, PDO::PARAM_STR);
        $stmt->bindParam(':priseencharge', $this->priseencharge, PDO::PARAM_STR);
        $stmt->bindParam(':note_de_frais', $this->note_de_frais, PDO::PARAM_INT);
        $stmt->bindParam(':iddatedebut', $iddatedebut, PDO::PARAM_STR);
        $stmt->bindParam(':blockpointage', $this->blockpointage, PDO::PARAM_STR);
        $stmt->bindParam(':historique', $this->historique, PDO::PARAM_STR);
        $stmt->bindParam(':lieux', $this->lieux, PDO::PARAM_STR);
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
        $stmt->bindParam(':motor', $this->motor, PDO::PARAM_STR);
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
           site = :site, 
                        matricule = :matricule, 
                        Departement = :departement, 
                        dest = :dest, 
                        via = :via, 
                        cadre = :cadre, 
                       Rapport = :rapport, 
                        dat = :dat, 
                        DateCreation = :datecreation,
                        Indexe = :indexe,
                        duree = :duree,
                        duree_travail = :duree_travail,
                        motor = :motor,
                        IndexEvenement = :IndexEvenement,
                        IndexDossierLogistique = :IndexDossierLogistique,
                        Synchronization = :synchronization,
                        NumeroDossier = :numerodossier,
                        NumeroBL_LTA = :numerobl_lta,
                        charge = :charge,
                        mat = :mat,
                        state = :state,
                        PriseEnCharge = :priseencharge,
                        Note_de_Frais = :note_de_frais,
                    IDDateDebut = :iddatedebut,
                        BlockPointage = :blockpointage,
                        historique = :historique,
                        Lieux = :lieux,
                        LastUpDateTime = :lastupdatetime, 
                         IDLastUpDate = :idlastupdate,
                        UserLastUpDateTime = :userlastupdatetime,
                        CodeAgence = :codeagence,
                        DateTime = :datetime,
                        IDDateTime = :iddatetime,
                    UserDateTime = :userdatetime,
                        archive = :archive,
                        ArchiveIDDate = :archiveiddate,
                        ArchiveDate = :archivedate,
                        ArchiveUser = :archiveuser,
                    ArchiveMotif = :archivemotif,
                        ArchiveDefinitive = :archivedefinitive,
                        ArchiveDefinitiveIDDate = :archivedefinitiveiddate,
                        ArchiveDefinitiveDate = :archivedefinitivedate,
                        ArchiveDefinitiveUser = :archivedefinitiveuser,
                       ArchiveDefinitiveMotif = :archivedefinitivemotif
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
        $this->site = htmlspecialchars(strip_tags($new_data['site'] ?? $current['site']));
        $this->matricule = htmlspecialchars(strip_tags($new_data['matricule']??$current['matricule']));
        $this->departement = htmlspecialchars(strip_tags($new_data['Departement'] ??$current['Departement']));
        $this->dest = htmlspecialchars(strip_tags($new_data['dest'] ?? $current['dest']));
        $this->via = htmlspecialchars(strip_tags($new_data['via'] ?? $current['via']));
        $this->cadre = htmlspecialchars(strip_tags($new_data['cadre'] ?? $current['cadre']));
        $this->motor = htmlspecialchars(strip_tags($new_data['motor'] ?? $current['motor']));
        $this->rapport  = htmlspecialchars(strip_tags($new_data['Rapport'] ?? $current['Rapport']));
        $this->duree = htmlspecialchars(strip_tags($new_data['duree'] ?? $current['duree']));
        $this->duree_travail = htmlspecialchars(strip_tags($new_data['duree_travail'] ?? $current['duree_travail']));
        $this->indexEvenement = htmlspecialchars(strip_tags($new_data['IndexEvenement'] ?? $current['IndexEvenement']));
        $this->indexdossierlogistique = htmlspecialchars(strip_tags($new_data['IndexDossierLogistique'] ?? $current['IndexDossierLogistique']));
        $this->numerodossier = htmlspecialchars(strip_tags($new_data['NumeroDossier'] ?? $current['NumeroDossier']));
        $this->Numerobl_lta = htmlspecialchars(strip_tags($new_data['NumeroBL_LTA'] ?? $current['NumeroBL_LTA']));
        $this->mat = htmlspecialchars(strip_tags($new_data['mat'] ?? $current['mat']));
        $this->state = htmlspecialchars(strip_tags($new_data['state'] ?? $current['state']));
        $this->priseencharge = htmlspecialchars(strip_tags($new_data['PriseEnCharge'] ?? $current['PriseEnCharge']));
        $this->note_de_frais = htmlspecialchars(strip_tags($new_data['Note_de_Frais'] ?? $current['Note_de_Frais']));
        $this->blockpointage = htmlspecialchars(strip_tags($new_data['BlockPointage'] ?? $current['BlockPointage']));
        $this->historique = htmlspecialchars(strip_tags($new_data['historique'] ??$current['historique']));
        $this->charge = htmlspecialchars(strip_tags($new_data['charge'] ?? $current['charge']));
        $this->lieux = htmlspecialchars(strip_tags($new_data['Lieux'] ?? $current['Lieux']));
        $this->archive = htmlspecialchars(strip_tags($new_data['Archive'] ?? $current['Archive']));
        $this->archivemotif  = htmlspecialchars(strip_tags($new_data['ArchiveMotif'] ?? $current['ArchiveMotif']));
        $this->type = htmlspecialchars(strip_tags($new_data['ArchiveDefinitive'] ?? $current['ArchiveDefinitive']));
        $this->ref = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveMotif'] ?? $current['ArchiveDefinitiveMotif']));
        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));

        $this->date = htmlspecialchars(  date('d/m/Y'));

        $this->heure = htmlspecialchars(strip_tags( date('H:i')));

        // return ($this->heure) ;

        $i = 0;
        $tmp = mt_rand(0, 9);
        do {
            $tmp .= mt_rand(0, 9);
        } while (++$i < 24);
        $uniqueId = $codeAgence["CodeAgence"] . $tmp;

        $iddate = strtotime($this->date);
        $idheure = strtotime($this->heure);
        $datetime = $this->date . " " . date('H:i:s', time() - 1 * 60 * 60);
        $iddatetime = strtotime($datetime);
        $txt = "modified";
        $synchronization = "$txt;$codeAgence[CodeAgence];";
        $lastupdatetime = $datetime;
        $idlastupdate = $iddatetime;
        $userdatetime = $login;
        $archiveiddate=strtotime($this->date );
        $archiveuser=$login;
        $archivedefintiveiddate=strtotime($this->date );
        $archivedefinitiveuser=$login;
        //Bind data
        $stmt->bindParam(':site', $this->site, PDO::PARAM_STR);
        $stmt->bindParam(':matricule', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':departement', $this->departement, PDO::PARAM_STR);
        $stmt->bindParam(':dest', $this->dest, PDO::PARAM_STR);
        $stmt->bindParam(':via', $this->via, PDO::PARAM_STR);
        $stmt->bindParam(':cadre', $this->cadre, PDO::PARAM_STR);
        $stmt->bindParam(':rapport', $this->rapport, PDO::PARAM_STR);
        $stmt->bindParam(':dat', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':datecreation', $this->date, PDO::PARAM_STR);
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
        $stmt->bindParam(':duree', $this->duree, PDO::PARAM_STR);
        $stmt->bindParam(':duree_travail', $this->duree_travail, PDO::PARAM_STR);
        $stmt->bindParam(':IndexEvenement', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':IndexDossierLogistique', $this->matricule, PDO::PARAM_STR);
        $stmt->bindParam(':numerodossier', $this->numerodossier, PDO::PARAM_INT);
        $stmt->bindParam(':numerobl_lta', $this->numerobl_lta, PDO::PARAM_STR);
        $stmt->bindParam(':charge', $this->charge, PDO::PARAM_STR);
        $stmt->bindParam(':mat', $this->mat, PDO::PARAM_STR);
        $stmt->bindParam(':state', $this->state, PDO::PARAM_STR);
        $stmt->bindParam(':priseencharge', $this->priseencharge, PDO::PARAM_STR);
        $stmt->bindParam(':note_de_frais', $this->note_de_frais, PDO::PARAM_INT);
        $stmt->bindParam(':iddatedebut', $iddatedebut, PDO::PARAM_STR);
        $stmt->bindParam(':blockpointage', $this->blockpointage, PDO::PARAM_STR);
        $stmt->bindParam(':historique', $this->historique, PDO::PARAM_STR);
        $stmt->bindParam(':lieux', $this->lieux, PDO::PARAM_STR);
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
        $stmt->bindParam(':motor', $this->motor, PDO::PARAM_STR);
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
