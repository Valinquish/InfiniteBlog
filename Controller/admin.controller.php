<?php

require_once 'Model/article.model.php';
require_once 'Model/comment.model.php';
require_once 'Model/user.model.php';
require_once 'Controller/controller.php';
require_once 'View/view.php';

class ControllerAdmin extends Controller
{
    private $article;
    private $comment;
    private $user;

    public function __construct()
    {
        $this->article = new Article();
        $this->comment = new Comment();
        $this->user = new User();
    }

    public function adminPanel()
    {
        $this->isAdmin();
        $nbArticles = $this->article->countArticles();
        $nbComments = $this->comment->countComments();
        $nbUsers = $this->user->countUsers();
        $articles = $this->article->getArticles();
        $users = $this->user->getUsers();
        $roles = $this->user->getRoles();
        $view = new View('Admin/admin');
        $view->generateView(array(
            'nbArticles' => $nbArticles, 'nbComments' => $nbComments, 'nbUsers' => $nbUsers,
            'articles' => $articles, 'users' => $users, 'roles' => $roles
        ));
    }

    public function userPanel()
    {
        $this->isConnected();
        $view = new View('Admin/account');
        $view->generateView(array());
    }

    function deleteUser($user_id)
    {
        $this->user->deleteUser($user_id);
        // Actualisation de l'affichage en fonction du rôle
        if ($_SESSION['role_id'] == 1) {
            $this->adminPanel();
        } else {
            $this->userPanel();
        }
    }

    function editPassword($user_id, $password)
    {
        $this->user->editPassword($user_id, $password);
        // Actualisation de l'affichage en fonction du rôle
        if ($_SESSION['role_id'] == 1) {
            $this->adminPanel();
        } else {
            $this->userPanel();
        }
    }

    function editUsername($user_id, $pseudo)
    {
        if (!$this->user->getUser($pseudo)) {
            $this->user->editUsername($user_id, $pseudo);
            $_SESSION['pseudo'] = $pseudo; // Réaffectation de la variable de session avec le nouveau pseudo
            // Actualisation de l'affichage en fonction du rôle
            if ($_SESSION['role_id'] == 1) {
                $this->adminPanel();
            } else {
                $this->userPanel(); 
            }
        } else {
            throw new Exception("Ce nom d'user est déjà utilisé"); // Gestion d'erreur
        }
    }

    function editRole($user_id, $role_id)
    {
        $this->user->editRole($user_id, $role_id);
        $this->adminPanel();
    }
}
