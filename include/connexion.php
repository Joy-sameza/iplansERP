<?php
class connexion{
    public $access;
    public function __construct()
    {
        try{

            $this->access=new pdo("mysql:host=localhost;dbname=demo;charset=utf8",
                "root","12345");
            $this->access->setAttribute(pdo::ATTR_ERRMODE,pdo::ERRMODE_WARNING);
        } catch (Exception $e){
            echo  $e->getMessage();
            die();
        }

    }
}
