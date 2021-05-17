<?php $this->title = 'Administration'; ?>

<div class="container mt-4">
    <h1>Administration</h1>
    <p class="lead">Bienvenue, <?= $_SESSION['pseudo'] ?> !</p>
    <p>
        Ce blog comporte <?= $nbArticles ?> article(s), <?= $nbComments ?> commentaire(s) et <?= $nbUsers ?> utilisateur(s).<br />
        Quelle action souhaitez-vous effectuer ?
    </p>
    <div class="accordion" id="admin">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAccount">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#manageAccount" aria-expanded="true" aria-controls="manageAccount">
                    &#201;diter le compte
                </button>
            </h2>
            <div id="manageAccount" class="accordion-collapse collapse show" aria-labelledby="headingAccount">
                <div class="accordion-body">
                    <?php require 'View/Form/user.form.php'; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingArticles">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#manageArticles" aria-expanded="false" aria-controls="manageArticles">
                    Gérer les articles
                </button>
            </h2>
            <div id="manageArticles" class="accordion-collapse collapse" aria-labelledby="headingArticles">
                <div class="accordion-body">
                    <?php require 'View/Admin/table.articles.php'; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingUsers">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#manageUsers" aria-expanded="false" aria-controls="manageUsers">
                    Gérer les utilisateurs
                </button>
            </h2>
            <div id="manageUsers" class="accordion-collapse collapse" aria-labelledby="headingUsers">
                <div class="accordion-body">
                    <?php require 'View/Admin/table.users.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>