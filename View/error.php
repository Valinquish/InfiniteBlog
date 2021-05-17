<?php $this->title = 'Erreur'; ?>

<div class="container mt-4">
    <h1 class="display-5 fw-bold">Désolé...</h1>
    <p class="lead">...il semblerait qu'il y ait eu une erreur.</p>
    <p class="mb-4"><?= $error_msg; ?></p>
    <a href="<?= $_SERVER['PHP_SELF']; ?>">Retour</a>
</div>