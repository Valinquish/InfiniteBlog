<?php

require_once 'Model/article.model.php';
require_once 'Model/comment.model.php';
require_once 'View/view.php';

class ControllerArticle extends Controller
{
    private $article;
    private $comment;

    public function __construct()
    {
        $this->article = new Article();
        $this->comment = new Comment();
    }

    // Affiche les détails sur un article
    public function showArticle($article_id)
    {
        if ($article_id != 0) {
            $article = $this->article->getArticle($article_id);
            $commentaires = $this->comment->getComments($article_id);
            $view = new View("Article/article");
            $view->generateView(array('article' => $article, 'commentaires' => $commentaires));
        } else {
            throw new Exception("Identifiant d'article non valide");
        }
    }

    // Ajouter un comment sous un article
    public function addComment($content, $author_id, $article_id)
    {
        // Ajout du comment
        $this->comment->addComment($content, $author_id, $article_id);
        // Actualisation de l'affichage de l'article
        $this->showArticle($article_id);
    }

    public function editComment($content, $comment_id, $article_id)
    {
        $this->comment->editComment($content, $comment_id);
        $this->showArticle($article_id);
    }

    public function deleteComment($comment_id, $article_id)
    {
        $this->comment->deleteComment($comment_id);
        // Actualisation de l'affichage de l'article
        $this->showArticle($article_id);
    }

    // Ajout d'un article
    public function addArticle($title, $content, $summary, $author_id)
    {
        $this->isAdmin();
        $this->article->addArticle($title, $content, $summary, $author_id);
        // Redirection vers la page principale
        header('Location: index.php');
    }

    // Edition d'un article
    public function editArticle($article_id, $title, $content, $summary)
    {
        $this->article->editArticle($article_id, $title, $content, $summary);
        // Actualisation de l'affichage de l'article édité
        $this->showArticle($article_id);
    }

    // Suppression d'un article
    public function deleteArticle($article_id)
    {
        $this->article->deleteArticle($article_id);
        // Redirection vers la page principale
        header('Location: index.php');
    }

    // Affichage du formulaire d'ajout ou d'édition d'un article
    public function formulaire($action, $article_id = null)
    {
        $this->isAdmin();
        $view = new View("Form/article.form");
        if ($action == 'ajout') {
            $actionLabel = 'Ajouter un article';
            $view->generateView(array('action' => 'add_article', 'actionLabel' => $actionLabel));
        } else if ($action == 'edit') {
            $article = $this->article->getArticle($article_id);
            $actionLabel = "Editer un article - $article_id";
            $view->generateView(array('action' => 'edit_article', 'actionLabel' => $actionLabel, 'id' => $article_id, 'article' => $article));
        }
    }
}
