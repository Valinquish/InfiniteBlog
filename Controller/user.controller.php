<?php

require_once 'Model/user.model.php';
require_once 'View/view.php';

class ControllerUser extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // Déconnexion d'un utilisateur (destruction de la session)
    public function disconnect()
    {
        session_destroy();
        header('Location: index.php'); // Redirection vers la page principale
    }

    // Connexion d'un utilisateur
    public function connect($pseudo, $password)
    {
        $user = $this->user->getUser($pseudo);
        if (!$user) { // Vérifie si l'utilisateur existe
            throw new Exception("L'utilisateur n'existe pas"); // Gestion d'erreur
        }
        // Vérification si le mot de passe saisi est identique au mot de passe chiffré de la base
        if (password_verify($password, $user['password'])) {
            // Initialisation des variables de session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['role_id'] = $user['role_id'];
            header('Location: index.php'); // Redirection vers la page principale
        } else {
            throw new Exception("Nom d'utilisateur et/ou mot de passe incorrect(s)."); // Gestion d'erreur
        }
    }

    // Inscription d'un utilisateur
    public function register($pseudo, $password)
    {
        if (!$this->user->getUser($pseudo)) { // Vérifie si l'utilisateur existe déjà
            $this->user->addUser($pseudo, $password); // Ajout de l'utilisateur
            $this->connect($pseudo, $password); // Connexion de l'utilisateur
            header('Location: index.php'); // Redirection vers la page principale
        } else {
            throw new Exception("Ce nom d'utilisateur est déjà utilisé");  // Gestion d'erreur
        }
    }

    // Affichage du formulaire de connexion ou d'inscription
    public function formulaire($action)
    {
        $this->isDisconnected();
        $view = new View('Form/connection.form');
        $action = ltrim($action, 'form_');
        if ($action == 'connexion') {
            $actionLabel = 'Se connecter';
        } else if ($action == 'inscription') {
            $actionLabel = "S'inscrire";
        }
        $view->generateView(array('action' => $action, 'actionLabel' => $actionLabel));
    }
}
