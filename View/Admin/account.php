<?php $this->title = 'Administration'; ?>

<div class="container mt-4">
    <h1>Profil</h1>
    <p class="lead">Bienvenue, <?= $_SESSION['pseudo'] ?> !</p>

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
    </div>
</div>