<?php

require_once 'Model/article.model.php';
require_once 'View/view.php';

class ControllerAccueil
{
    private $article;

    public function __construct()
    {
        $this->article = new Article();
    }

    // Affiche la liste de tous les articles du blog
    public function home()
    {
        $articles = $this->article->getArticles();
        $view = new View("Accueil/home");
        $view->generateView(array('articles' => $articles));
    }
}
