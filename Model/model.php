<?php

abstract class Model
{
    // Objet PDO d'accès à la BDD
    private $pdo;

    // Effectue la connexion à la BDD
    // Instancie et renvoie l'objet PDO associé
    protected function getPDO()
    {
        if ($this->pdo == null) {
            // Création de la connexion
            $this->pdo = new PDO('mysql:host=localhost;dbname=blog_php3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->pdo;
    }
}
