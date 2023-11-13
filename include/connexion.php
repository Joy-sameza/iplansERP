<?php
require_once "./include/config.php";
class connexion
{
    public $access;
    private $host = HOST_NAME;
    private $port = DB_PORT;
    private $name = DB_NAME;
    private $username = USER_NAME;
    private $password = USER_PASSWORD;

    public function __construct()
    {
        try {

            $this->access = new pdo("mysql:host={$this->host};port={$this->port};dbname={$this->name};charset=utf8", $this->username, $this->password);
            $this->access->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_WARNING);
        } catch (Exception $e) {
            echo  $e->getMessage();
            die();
        }
    }
}
