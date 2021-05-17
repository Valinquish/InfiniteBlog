<?php

require_once 'Controller/home.controller.php';
require_once 'Controller/admin.controller.php';
require_once 'Controller/article.controller.php';
require_once 'Controller/user.controller.php';
require_once 'View/view.php';

class Moteur
{
    private $ctrlHome;
    private $ctrlAdmin;
    private $ctrlArticle;
    private $ctrlUser;

    public function __construct()
    {
        session_start();
        $this->ctrlHome = new ControllerAccueil();
        $this->ctrlAdmin = new ControllerAdmin();
        $this->ctrlArticle = new ControllerArticle();
        $this->ctrlUser = new ControllerUser();
    }

    // Traite une requête entrante
    public function handleRequest()
    {
        try {
            $action = ""; // valeur par défaut
            if (isset($_GET['action'])) { // pour les actions d'affichage
                $action = $_GET['action'];
            }
            if (isset($_POST['action'])) { // pour les actions de modification sur les données
                $action = $_POST['action'];
            }

            switch ($action) {
                    /* Articles  */
                case 'article':
                    $this->ctrlArticle->showArticle($_GET['id']);
                    break;

                case 'form_article':
                    $this->ctrlArticle->formulaire($_GET['option'], $_GET['id']);
                    break;

                case 'add_article':
                    $this->ctrlArticle->addArticle($_POST['title'], $_POST['content'], $_POST['summary'], $_SESSION['user_id']);
                    break;

                case 'edit_article':
                    $this->ctrlArticle->editArticle($_POST['article_id'], $_POST['title'], $_POST['content'], $_POST['summary']);
                    break;

                case 'delete_article':
                    $this->ctrlArticle->deleteArticle($_POST['article_id']);
                    break;
                    /* */
                    /* Commentaires */
                case 'commenter':
                    $this->ctrlArticle->addComment($_POST['content'], $_SESSION['user_id'], $_POST['article_id']);
                    break;

                case 'edit_comment':
                    $this->ctrlArticle->editComment($_POST['edit_content'], $_POST['comment_id'], $_POST['article_id']);
                    break;

                case 'delete_commentaire':
                    $this->ctrlArticle->deleteComment($_POST['comment_id'], $_POST['article_id']);
                    break;
                    /* */
                    /* Sessions*/
                case 'connexion':
                    $this->ctrlUser->connect($_POST['login'], $_POST['password']);
                    break;

                case 'inscription':
                    $this->ctrlUser->register($_POST['login'], $_POST['password']);
                    break;

                case 'deconnexion':
                    $this->ctrlUser->disconnect();
                    break;

                case 'form_connexion':
                    $this->ctrlUser->formulaire($action);
                    break;

                case 'form_inscription':
                    $this->ctrlUser->formulaire($action);
                    break;
                    /* */
                    /* Administration*/
                case 'account':
                    $this->ctrlAdmin->userPanel();
                    break;

                case 'admin':
                    $this->ctrlAdmin->adminPanel();
                    break;

                case 'edit_password':
                    $this->ctrlAdmin->editPassword($_POST['user_id'], $_POST['password']);
                    break;

                case 'edit_username':
                    $this->ctrlAdmin->editUsername($_POST['user_id'], $_POST['login']);
                    break;

                case 'edit_role':
                    $this->ctrlAdmin->editRole($_GET['id'], $_POST['role_id']);
                    break;


                case 'delete_user':
                    $this->ctrlAdmin->deleteUser($_POST['user_id']);
                    break;
                    /* */
                    /* Action par défaut (affichage de la page principale) */
                default:
                    $this->ctrlHome->home();
                    break;
            }
        } catch (Exception $error) {
            $this->handleError($error->getMessage());
        }
    }

    // Gère une erreur d'exécution (exception)
    private function handleError($error_msg)
    {
        $view = new View("error");
        $view->generateView(array('error_msg' => $error_msg));
    }
}
