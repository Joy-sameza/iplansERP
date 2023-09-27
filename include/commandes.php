<?php
require_once "connexion.php";
class Commandes extends connexion
{
    function ajouter($image, $nom, $prix, $desc)
    {

        $req = $this->access->prepare(" INSERT INTO produits(image,nom,prix,description) 
 VALUES('$image','$nom',$prix,'$desc') ");
        $req->execute(array($image, $nom, $prix, $desc));
        $req->closeCursor();
    }
    function afficher()
    {


        $req = $this->access->prepare("SELECT * FROM produits ORDER BY id DESC ");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }
    function supprimer($id)
    {
        //   require "connexion.php";
        $req = $this->access->prepare("DELETE  FROM produits WHERE id=? ");
        $req->execute(array($id));
        $req->closeCursor();
    }
    function update($id, $image, $nom, $prix, $desc)
    {
        $req = $this->access->prepare("
        UPDATE produits
        set image='$image', nom='$nom',prix=$prix,description='$desc'
       WHERE id=?
        ");
    }
    function getAdmin($email, $password): array | false
    {
        $statement = $this->access->prepare("SELECT * FROM utilisateurs WHERE nom = ? AND passwords = ?");
        $statement->execute([$email, $password]);
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return [$data['nom'], $data['passwords']] ?: false;
    }
}