<?php
class Siteiplans
{
    //DB require stuff
    private $conn;
    private $table = 'siteiplans';

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
        $query = "SELECT * FROM {$this->table}  WHERE NEng = :courierId AND Supprimer != 1 ";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':courierId', $courierId, PDO::PARAM_STR);

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
                        InOutCourier = :type, 
                        ReferenceCourier = :ref, 
                        ObjetCourier = :obj, 
                        SourceCourier = :source, 
                        Destinataire = :desti, 
                        DateDepot = :date, 
                        HeureDepot = :heure, 
                        NiveauImportance = :niveau,
                        Indexe = :indexe,
                        IdDate = :iddate,
                        IDHeureDepot = :idheure,
                        DateTime = :datetime,
                        IDDateTime = :iddatetime,
                        CodeAgence = :codeagence,
                        Synchronization = :synchronization,
                        LastUpDateTime = :lastupdatetime,
                        IDLastUpDate = :idlastupdate,
                        UserDateTime = :userdatetime,
                        NomPieceJointe = :nompiecejointe,
                        DestiPieceJointe = :destipiecejointe
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
        $this->type = htmlspecialchars(strip_tags($data['InOutCourier']));
        $this->ref = htmlspecialchars(strip_tags($data['ReferenceCourier']));
        $this->obj = htmlspecialchars(strip_tags($data['ObjetCourier']));
        $this->source = htmlspecialchars(strip_tags($data['SourceCourier']));
        $this->desti = htmlspecialchars(strip_tags($data['Destinataire']));
        $this->niveau = htmlspecialchars(strip_tags($data['NiveauImportance']));
        $nompiecejointe = htmlspecialchars(strip_tags($data['NomPieceJointe']));
        $destipiecejointe = htmlspecialchars(strip_tags($data['DestiPieceJointe']));

        // $this->status = htmlspecialchars(strip_tags($data['status']));

        $this->date = htmlspecialchars(strip_tags(implode("/", explode('-', $data['DateDepot'])) ?? date('Y/m/d')));

        $this->heure = htmlspecialchars(strip_tags($data['HeureDepot'] ?? date('H:i')));

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


        //Bind data
        $stmt->bindParam(':site', $site['Site'], PDO::PARAM_STR);
        $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
        $stmt->bindParam(':ref', $this->ref, PDO::PARAM_STR);
        $stmt->bindParam(':obj', $this->obj, PDO::PARAM_STR);
        $stmt->bindParam(':source', $this->source, PDO::PARAM_STR);
        $stmt->bindParam(':desti', $this->desti, PDO::PARAM_STR);
        $stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
        $stmt->bindParam(':heure', $this->heure, PDO::PARAM_STR);
        $stmt->bindParam(':niveau', $this->niveau, PDO::PARAM_STR);
        $stmt->bindParam(':indexe', $uniqueId, PDO::PARAM_STR);
        $stmt->bindParam(':iddate', $iddate, PDO::PARAM_INT);
        $stmt->bindParam(':idheure', $idheure, PDO::PARAM_INT);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':codeagence', $codeAgence["CodeAgence"], PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':lastupdatetime', $lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':nompiecejointe', $nompiecejointe, PDO::PARAM_STR);
        $stmt->bindParam(':destipiecejointe', $destipiecejointe, PDO::PARAM_STR);
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
Indexe = :indexe ,
NomSite = :nomsite,  
Company = :company,
Continent = :continent, 
Pays= :pays,
Ville= :ville,
Region= :region,
SousRegion= :sousregion,
Arrondissement= :arrondissement,
 District= :district,
IDSite= :idsite,
BusinessSector= :businesssector,
PackageSouscrit= :packagekouscrit,
SpecialiteSouscrite= :specialitesouscrite,
IDPackageSouscrit= :idpackagesouscrit,
IDSpecialiteSouscrite= :idspecialitesouscrite,
TauxCommissionAbonnement= :tauxcommissionabonnement,
TauxCommissionMateriel= :tauxcommissionmateriel,
Employees= :employees,
NombrePoste= :nombreposte,
WebSite= :website,
Telephone= :telephone,
Address= :address,
EMail= :email,
POBOX= :pobox,
NumeroContribuable= :numerocontribuable,
RegistreCommerce= :registrecommerce,
CNPS= :cnps,
VersioniPlans= :versioniplans,
ThreadIndex= :threadindex,
IDBusinessSector= :idbusinesssector,
Synchronization= :synchronization,
CodeAgence= :codeagence,
CodeDistributeur= :codedistributeur,
Regime= :regime,
CodeEnregistrementCNPS= :codeenregistrementcnps,
NBJourCongeParMois= :nbjourcongeparmois,
IndemniteCongeNumerateur= :indemnitecongenumerateur,
IndemniteCongeDenominateur= :indemnitecongedenominateur,
LastUpDateTime= :lastupdatetime,
IDLastUpDate= :idlastupdate,
UserLastUpDateTime= :userlastupdatetime,
DateTime= :datetime,
IDDateTime= :iddatetime,
UserDateTime= :userdatetime,
Societe= :societe,
MACAdress= :macadress,
DateFinAccess= :datefinaccess,
IDDateFinAccess= :iddatefinaccess,
Visible= :visible,
PlanComptableCentrale= :plancomptablecentrale,
Archive= :archive,
ArchiveIDDate= :archiveiddate,
ArchiveDate= :archivedate,
ArchiveUser= :archiveuser,
ArchiveMotif= :archivemotif,
ArchiveDefinitive= :archivedefinitive,
ArchiveDefinitiveIDDate= :archivedefinitiveiddate,
ArchiveDefinitiveDate= :archivedefinitivedate,
ArchiveDefinitiveUser= :archivedefinitiveuser,
ArchiveDefinitiveMotif= :archivedefinitivemotif,
NomPhoto= :nomphoto
        WHERE NEng = :courrierId";
        $stmt = $this->conn->prepare($query);

        //data
        $this->site = htmlspecialchars(strip_tags($new_data['Site'] ?? $current['Site']));
        $this->indexe  = htmlspecialchars(strip_tags($new_data['Indexe'] ?? $current['Indexe']));
        $this->nomphoto  = htmlspecialchars(strip_tags($new_data['NomPhoto'] ?? $current['NomPhoto']));
        $this->nomsite  = htmlspecialchars(strip_tags($new_data['NomSite'] ?? $current['NomSite']));
        $this->company = htmlspecialchars(strip_tags($new_data['Company'] ?? $current['Company']));
        $this->continent = htmlspecialchars(strip_tags($new_data['Continent'] ?? $current['Continent']));
        $this->pays = htmlspecialchars(strip_tags($new_data['Pays'] ?? $current['Pays']));
        $this->ville = htmlspecialchars(strip_tags($new_data['Ville'] ?? $current['Ville']));
        $this->region = htmlspecialchars(strip_tags($new_data['Region'] ?? $current['Region']));
        $this->sousregion = htmlspecialchars(strip_tags($new_data['SousRegion'] ?? $current['SousRegion']));
        $this->arrondissement = htmlspecialchars(strip_tags($new_data['Arrondissement'] ?? $current['Arrondissement']));
        $this->courrierId = htmlspecialchars(strip_tags($current["NEng"]));
        $this->district= htmlspecialchars(strip_tags($new_data['District'] ?? $current['District']));
       $this->idsite = htmlspecialchars(strip_tags($new_data['IDSite'] ?? $current['IDSite']));
        $this->businesssector = htmlspecialchars(strip_tags($new_data['BusinessSector'] ?? $current['BusinessSector']));
        $this->packagekouscrit = htmlspecialchars(strip_tags($new_data['PackageSouscrit'] ?? $current['PackageSouscrit']));
        $this->specialitesouscrite = htmlspecialchars(strip_tags($new_data['SpecialiteSouscrite'] ?? $current['SpecialiteSouscrite ']??0));
        $this->idpackagesouscrit = htmlspecialchars(strip_tags($new_data['IDPackageSouscrit'] ?? $current['IDPackageSouscrit']??0));
        $this->idspecialitesouscrite = htmlspecialchars(strip_tags($new_data['IDSpecialiteSouscrite'] ?? $current['IDSpecialiteSouscrite']));
        $this->tauxcommissionabonnement = htmlspecialchars(strip_tags($new_data['TauxCommissionAbonnement'] ?? $current['TauxCommissionAbonnement']));
        $this->tauxcommissionmateriel = htmlspecialchars(strip_tags($new_data['TauxCommissionMateriel'] ?? $current['TauxCommissionMateriel']));
        $this->employees = htmlspecialchars(strip_tags($new_data['Employees'] ?? $current['Employees']));
        $this->nombreposte = htmlspecialchars(strip_tags($new_data['NombrePoste'] ?? $current['NombrePoste']));
        $this->website = htmlspecialchars(strip_tags($new_data['WebSite'] ?? $current['WebSite']));
        $this->telephone = htmlspecialchars(strip_tags($new_data['Telephone'] ?? $current['Telephone']));
        $this->address = htmlspecialchars(strip_tags($new_data['Address'] ?? $current['Address']));
        $this->email = htmlspecialchars(strip_tags($new_data['EMail'] ?? $current['EMail']));
        $this->pobox = htmlspecialchars(strip_tags($new_data['POBOX'] ?? $current['POBOX']));
        $this->numerocontribuable = htmlspecialchars(strip_tags($new_data['NumeroContribuable'] ?? $current['NumeroContribuable']));
        $this->registrecommerce = htmlspecialchars(strip_tags($new_data['RegistreCommerce'] ?? $current['RegistreCommerce ']??0));
        $this->cnps = htmlspecialchars(strip_tags($new_data['CNPS'] ?? $current['CNPS']));
        $this->versioniplans = htmlspecialchars(strip_tags($new_data['VersioniPlans'] ?? $current['VersioniPlans']));
        $this->threadindex = htmlspecialchars(strip_tags($new_data['ThreadIndex'] ?? $current['ThreadIndex']));
        $this->idbusinesssector = htmlspecialchars(strip_tags($new_data['IDBusinessSector'] ?? $current['IDBusinessSector']));
        $this->synchronization = htmlspecialchars(strip_tags($new_data['Synchronization'] ?? $current['Synchronization']));
        $this->codeagence = htmlspecialchars(strip_tags($new_data['CodeAgence'] ?? $current['CodeAgence']));
        $this->codedistributeur = htmlspecialchars(strip_tags($new_data['CodeDistributeur'] ?? $current['CodeDistributeur']));
        $this->regime = htmlspecialchars(strip_tags($new_data['Regime'] ?? $current['Regime']));
        $this->codeenregistrementcnps = htmlspecialchars(strip_tags($new_data['CodeEnregistrementCNPS'] ?? $current['CodeEnregistrementCNPS']));
        $this->nbjourcongeparmois = htmlspecialchars(strip_tags($new_data['NBJourCongeParMois'] ?? $current['NBJourCongeParMois']));
        $this->indemnitecongenumerateur = htmlspecialchars(strip_tags($new_data['IndemniteCongeNumerateur'] ?? $current['IndemniteCongeNumerateur']));
        $this->indemnitecongedenominateur = htmlspecialchars(strip_tags($new_data['IndemniteCongeDenominateur'] ?? $current['IndemniteCongeDenominateur']));
        $this->lastupdatetime = htmlspecialchars(strip_tags($new_data['LastUpDateTime'] ?? $current['LastUpDateTime']));
        $this->idlastupdate = htmlspecialchars(strip_tags($new_data['IDLastUpDate'] ?? $current['IDLastUpDate']));
        $this->userlastupdatetime = htmlspecialchars(strip_tags($new_data['UserLastUpDateTime'] ?? $current['UserLastUpDateTime']));
        $this->datetime = htmlspecialchars(strip_tags($new_data['DateTime'] ?? $current['DateTime']));
        $this->iddatetime = htmlspecialchars(strip_tags($new_data['IDDateTime'] ?? $current['IDDateTime']));
        $this->userdatetime = htmlspecialchars(strip_tags($new_data['UserDateTime'] ?? $current['UserDateTime']));
        $this->societe = htmlspecialchars(strip_tags($new_data['Societe'] ?? $current['Societe']));
        $this->macadress = htmlspecialchars(strip_tags($new_data['MACAdress'] ?? $current['MACAdress']));
        $this->datefinaccess = htmlspecialchars(strip_tags($new_data['DateFinAccess'] ?? $current['DateFinAccess']));
        $this->iddatefinaccess = htmlspecialchars(strip_tags($new_data['IDDateFinAccess'] ?? $current['IDDateFinAccess']));
        $this->visible = htmlspecialchars(strip_tags($new_data['Visible'] ?? $current['Visible']));
        $this->plancomptablecentrale = htmlspecialchars(strip_tags($new_data['PlanComptableCentrale'] ?? $current['PlanComptableCentrale']));
        $this->archive = htmlspecialchars(strip_tags($new_data['Archive'] ?? $current['Archive']));
        $this->archiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveIDDate'] ?? $current['ArchiveIDDate']));
        $this->archivedate = htmlspecialchars(strip_tags($new_data['ArchiveDate'] ?? $current['ArchiveDate']));
        $this->archiveuser = htmlspecialchars(strip_tags($new_data['ArchiveUser'] ?? $current['ArchiveUser']));
        $this->archivemotif = htmlspecialchars(strip_tags($new_data['ArchiveMotif'] ?? $current['ArchiveMotif']));
        $this->archivedefinitive = htmlspecialchars(strip_tags($new_data['ArchiveDefinitive'] ?? $current['ArchiveDefinitive']));
        $this->archivedefinitiveiddate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveIDDate'] ?? $current['ArchiveDefinitiveIDDate']));
        $this->archivedefinitivedate = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveDate'] ?? $current['ArchiveDefinitiveDate']));
        $this->archivedefinitiveuser = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveUser'] ?? $current['ArchiveDefinitiveUser']));
        $this->archivedefinitivemotif = htmlspecialchars(strip_tags($new_data['ArchiveDefinitiveMotif'] ?? $current['ArchiveDefinitiveMotif']));


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
        $stmt->bindParam(':indexe', $this->indexe, PDO::PARAM_STR);
        $stmt->bindParam(':nomsite', $this->nomsite , PDO::PARAM_STR);
        $stmt->bindParam(':nomphoto', $this->nomphoto , PDO::PARAM_STR);
        $stmt->bindParam(':company', $this->company, PDO::PARAM_STR);
        $stmt->bindParam(':continent', $this->continent , PDO::PARAM_STR);
        $stmt->bindParam(':pays', $this->pays, PDO::PARAM_STR);
        $stmt->bindParam(':ville', $this->ville, PDO::PARAM_STR);
        $stmt->bindParam(':region', $this->region, PDO::PARAM_STR);
        $stmt->bindParam(':sousregion', $this->sousregion, PDO::PARAM_STR);
        $stmt->bindParam(':arrondissement', $synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':district', $this->district, PDO::PARAM_STR);
        $stmt->bindParam(':idsite', $this->idsite, PDO::PARAM_INT);
        $stmt->bindParam(':businesssector', $this->businesssector, PDO::PARAM_STR);
        $stmt->bindParam(':packagekouscrit', $this->packagekouscrit, PDO::PARAM_STR);
        $stmt->bindParam(':specialitesouscrite', $this->specialitesouscrite, PDO::PARAM_STR);
        $stmt->bindParam(':idpackagesouscrit', $this->idpackagesouscrit, PDO::PARAM_STR);
        $stmt->bindParam(':idspecialitesouscrite', $this->idspecialitesouscrite, PDO::PARAM_STR);
        $stmt->bindParam(':tauxcommissionabonnement', $this->tauxcommissionabonnement, PDO::PARAM_STR);
        $stmt->bindParam(':tauxcommissionmateriel', $this->tauxcommissionmateriel , PDO::PARAM_STR);
        $stmt->bindParam(':employees', $this->employees, PDO::PARAM_STR);
        $stmt->bindParam(':nombreposte', $this->nombreposte , PDO::PARAM_STR);
        $stmt->bindParam(':website', $this->website, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);
        $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':courrierId', $this->courrierId, PDO::PARAM_INT);
        $stmt->bindParam(':pobox', $this->pobox, PDO::PARAM_STR);
        $stmt->bindParam(':numerocontribuable', $this->numerocontribuable, PDO::PARAM_STR);
        $stmt->bindParam(':registrecommerce', $this->registrecommerce, PDO::PARAM_INT);
        $stmt->bindParam(':cnps', $this->cnps, PDO::PARAM_STR);
        $stmt->bindParam(':versioniplans', $this->versioniplans, PDO::PARAM_STR);
        $stmt->bindParam(':threadindex', $this->threadindex, PDO::PARAM_STR);
        $stmt->bindParam(':idbusinesssector', $this->idbusinesssector, PDO::PARAM_STR);
        $stmt->bindParam(':synchronization', $this->synchronization, PDO::PARAM_STR);
        $stmt->bindParam(':codeagence', $this->codeagence, PDO::PARAM_STR);
        $stmt->bindParam(':codedistributeur', $this->codedistributeur , PDO::PARAM_STR);
        $stmt->bindParam(':regime', $this->regime, PDO::PARAM_STR);
        $stmt->bindParam(':codeenregistrementcnps', $this->codeenregistrementcnps , PDO::PARAM_STR);
        $stmt->bindParam(':nbjourcongeparmois', $this->nbjourcongeparmois, PDO::PARAM_STR);
        $stmt->bindParam(':indemnitecongenumerateur', $this->indemnitecongenumerateur, PDO::PARAM_STR);
        $stmt->bindParam(':indemnitecongedenominateur', $this->indemnitecongedenominateur, PDO::PARAM_STR);
        $stmt->bindParam(':lastupdatetime', $this->lastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':idlastupdate', $this->idlastupdate, PDO::PARAM_INT);
        $stmt->bindParam(':userlastupdatetime', $this->userlastupdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':datetime', $this->datetime, PDO::PARAM_STR);
        $stmt->bindParam(':iddatetime', $this->iddatetime, PDO::PARAM_INT);
        $stmt->bindParam(':userdatetime', $this->userdatetime, PDO::PARAM_STR);
        $stmt->bindParam(':societe', $this->societe, PDO::PARAM_STR);
        $stmt->bindParam(':macadress', $this->macadress, PDO::PARAM_STR);
        $stmt->bindParam(':datefinaccess', $this->datefinaccess, PDO::PARAM_STR);
        $stmt->bindParam(':iddatefinaccess', $this->iddatefinaccess, PDO::PARAM_STR);
        $stmt->bindParam(':visible', $this->visible, PDO::PARAM_STR);
        $stmt->bindParam(':plancomptablecentrale', $this->plancomptablecentrale , PDO::PARAM_STR);
        $stmt->bindParam(':archive', $this->archive, PDO::PARAM_STR);
        $stmt->bindParam(':archiveiddate', $this->archiveiddate , PDO::PARAM_STR);
        $stmt->bindParam(':archivedate', $this->archivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archiveuser', $this->archiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivemotif', $this->archivemotif, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitive', $this->archivedefinitive, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveiddate', $this->archivedefinitiveiddate, PDO::PARAM_INT);
        $stmt->bindParam(':archivedefinitivedate', $this->archivedefinitivedate, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitiveuser', $this->archivedefinitiveuser, PDO::PARAM_STR);
        $stmt->bindParam(':archivedefinitivemotif', $this->archivedefinitivemotif, PDO::PARAM_INT);

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
