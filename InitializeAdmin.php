<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog_php3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $sql = 'INSERT INTO member(pseudo, password, role_id) VALUES (?, ?, ?)';
    $req = $pdo->prepare($sql);
    $req->execute(array('admin', password_hash('password', PASSWORD_DEFAULT), 1));
    echo 'Réussite !';
    header('Location : index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
