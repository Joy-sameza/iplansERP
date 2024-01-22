<?php
class Client
{
    //DB require stuff
    private $conn;
    private $table = 'clients';

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
        $query = "SELECT *
    FROM {$this->table} WHERE Supprimer = 0 LIMIT 100";

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
