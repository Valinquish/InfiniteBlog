<?php

require_once 'Model/model.php';

class User extends Model
{
    // Ajoute un utilisateur (inscription)
    public function addUser($pseudo, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // chiffrement du mot de passe
        $sql = 'INSERT INTO member(pseudo, password, creation_date) VALUES (:pseudo, :password, NOW())';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('pseudo', $pseudo);
        $req->bindParam('password', $hashedPassword);
        $req->execute();
    }

    // Supprime un utilisateur existant
    public function deleteUser($user_id)
    {
        $sql = 'DELETE FROM member WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        $req->bindParam('id', $user_id); // Liaison des paramètres
        $req->execute();
    }

    // Edite le pseudo d'un utilisateur existant
    public function editUsername($user_id, $pseudo)
    {
        $sql = 'UPDATE member SET pseudo = :pseudo WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('id', $user_id);
        $req->bindParam('pseudo', $pseudo);
        $req->execute();
    }

    // Edite le mot de passe d'un utilisateur existant
    public function editPassword($user_id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // chiffrement du mot de passe
        $sql = 'UPDATE member SET password = :password WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('id', $user_id);
        $req->bindParam('password', $hashedPassword);
        $req->execute();
    }

    // Editer le rôle d'un utilisateur existant
    public function editRole($user_id, $role_id)
    {
        $sql = 'UPDATE member SET role_id = :role_id WHERE id = :id';
        $req = $this->getPDO()->prepare($sql);
        // Liaison des paramètres
        $req->bindParam('id', $user_id);
        $req->bindParam('role_id', $role_id);
        $req->execute();
    }

    // Renvoie un utilisateur existant
    public function getUser($pseudo)
    {
        $sql = 'SELECT * FROM member WHERE pseudo = :pseudo';
        $user = $this->getPDO()->prepare($sql);
        $user->bindParam('pseudo', $pseudo); // Liaison des paramètres
        $user->execute();
        return $user->fetch(); // Renvoie 'false' si l'utilisateur n'existe pas

    }

    // Renvoie la liste de tous les utilisateurs 
    public function getUsers()
    {
        $sql = 'SELECT member.id, pseudo, label, DATE_FORMAT(creation_date, "%d/%m/%y à %H:%i:%s") AS formatted_date FROM member INNER JOIN role ON member.role_id = role.id ORDER BY member.id';
        $users = $this->getPDO()->query($sql);
        return $users;
    }

    // Renvoie le nombre total d'utilisateurs
    public function countUsers()
    {
        $sql = 'SELECT COUNT(*) AS nb_users FROM member';
        $req = $this->getPDO()->query($sql);
        $count = $req->fetch(); // Il y a toujours 1 ligne dans le résultat
        return $count['nb_users'];
    }

    // Renvoie les roles
    function getRoles()
    {
        $sql = 'SELECT * FROM role';
        return $this->getPDO()->query($sql);
    }
}
