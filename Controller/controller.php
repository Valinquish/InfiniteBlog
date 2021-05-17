<?php

class Controller
{
    // Vérifie si un utilisateur (quel qu'il soit) est connecté
    public function isConnected()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Vous n'êtes pas autorisé à effectuer cette action");
        }
    }

    // Vérifie si un utilisateur (quel qu'il soit) est déconnecté
    public function isDisconnected()
    {
        if (isset($_SESSION['user_id'])) {
            throw new Exception("Vous êtes déjà connecté !");
        }
    }

    // Vérifie si un utilisateur est admin
    public function isAdmin()
    {
        $this->isConnected();
        if ($_SESSION['role_id'] != 1) {
            throw new Exception("Vous n'êtes pas autorisé à effectuer cette action");
        }
    }
}
