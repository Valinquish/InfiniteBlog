<?php

require_once 'Model/model.php';

class Comment extends Model
{
    // Renvoie la liste des commentaires associés à un billet
    public function getComments($article_id)
    {
        $sql = 'SELECT comment.id as id, content, pseudo as author, author_id, article_id, 
                        DATE_FORMAT(comment.creation_date, "%d/%m/%y à %H:%i:%s") AS formatted_date 
                FROM comment 
                    INNER JOIN member ON comment.author_id = member.id 
                WHERE article_id = :article_id';
        $comments = $this->getPDO()->prepare($sql);
        $comments->bindParam(':article_id', $article_id); // Liaison des paramètres
        $comments->execute();
        return $comments;
    }

    // Renvoie le nombre total de commentaires
    public function countComments()
    {
        $sql = 'SELECT COUNT(*) AS nb_comments FROM comment';
        $req = $this->getPDO()->query($sql);
        $count = $req->fetch(); // Il y a toujours 1 ligne dans le résultat
        return $count['nb_comments'];
    }

    // Ajouter un commentaire à un article
    public function addComment($content, $author_id, $article_id)
    {
        $sql = 'INSERT INTO comment(creation_date, content, author_id, article_id) VALUES (NOW(), :content, :author_id, :article_id)';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('content', $content);
        $req->bindParam('author_id', $author_id);
        $req->bindParam('article_id', $article_id);
        $req->execute();
    }

    // Editer un commentaire existant
    public function editComment($content, $comment_id)
    {
        $sql = 'UPDATE comment SET content = :content WHERE id = :id';
        // Liaison des paramètres
        $req = $this->getPDO()->prepare($sql);
        $req->bindParam('content', $content);
        $req->bindParam('id', $comment_id);
        $req->execute();
    }

    // Supprimer un commentaire existant
    public function deleteComment($comment_id)
    {
        $sql = 'DELETE FROM comment WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('id', $comment_id);
        $req->execute();
    }
}
