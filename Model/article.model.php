<?php

require_once 'Model/model.php';

class Article extends Model
{
    // Renvoie les informations d'un article
    public function getArticle($article_id)
    {
        $sql = 'SELECT article.id AS id, title, content, summary, pseudo as author, 
                       DATE_FORMAT(article.creation_date, "%d/%m/%y à %H:%i:%s") AS formatted_date 
                FROM article INNER JOIN member ON article.author_id = member.id 
                WHERE article.id = :id';
        $article = $this->getPDO()->prepare($sql);
        $article->bindParam('id', $article_id); // Liaison des paramètres
        $article->execute();
        if ($article->rowCount() == 1)
            return $article->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$article_id'"); // Gestion d'erreur
    }

    // Renvoie la liste de tous les articles, triés par identifiant décroissant
    public function getArticles()
    {
        $sql = 'SELECT article.id AS id, title, content, summary, pseudo as author, 
                        DATE_FORMAT(article.creation_date, "%d/%m/%y à %H:%i:%s") AS formatted_date  FROM article
                INNER JOIN member ON article.author_id = member.id 
                ORDER BY article.id DESC';
        $articles = $this->getPDO()->query($sql);
        return $articles;
    }

    // Renvoie le nombre total d'articles
    public function countArticles()
    {
        $sql = 'SELECT COUNT(*) AS nb_articles FROM article';
        $req = $this->getPDO()->query($sql);
        $count = $req->fetch(); // Il y a toujours 1 ligne dans le résultat
        return $count['nb_articles'];
    }

    // Ajouter un article
    public function addArticle($title, $content, $summary, $author_id)
    {
        $sql = 'INSERT INTO article(creation_date, title, content, summary, author_id) VALUES (NOW(), :title, :content, :summary, :author_id)';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('title', $title);
        $req->bindParam('content', $content);
        $req->bindParam('summary', $summary);
        $req->bindParam('author_id', $author_id);
        $req->execute();
    }

    // Editer un article existant
    public function editArticle($article_id, $title, $content, $summary)
    {
        $sql = 'UPDATE article SET title = :title, content = :content, summary = :summary WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('id', $article_id);
        $req->bindParam('title', $title);
        $req->bindParam('content', $content);
        $req->bindParam('summary', $summary);
        $req->execute();
    }

    // Supprimer un article existant
    public function deleteArticle($article_id)
    {
        $sql = 'DELETE FROM article WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        $req->bindParam('id', $article_id); // Liaison des paramètres
        $req->execute();
    }
}
