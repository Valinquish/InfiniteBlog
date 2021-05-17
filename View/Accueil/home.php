<?php $this->title = 'Infinite Blog'; ?>

<div class="text-center py-5" style="background: linear-gradient(0.25turn, #f15a2b, #e94b4e);">
    <div class="container">
        <a class="text-dark text-decoration-none" href="index.php"><h1 class="display-1">Infinite Blog</h1></a>
        <p class="lead mb-4">L'infini est un, car s'il n'était pas un, il ne serait pas infini.</p>
    </div>
</div>
<div class="container">
    <?php if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) { ?>
        <a class="btn btn-primary mt-4" href="index.php?action=form_article&option=ajout&id"><i class="uil uil-pen"></i>Ajouter un article</a>
    <?php } ?>

    <?php foreach ($articles as $article) { ?>
        <article class="row g-0 border rounded overflow-hidden flex-md-row my-4 shadow-sm h-md-250 position-relative">
            <div class=" p-4 d-flex flex-column position-static">
                <h2><?= $article['title'] ?></h2>
                <p class="mb-2 text-muted">Publié le <?= $article['formatted_date'] ?> par <i class="uil uil-user-circle"></i><?= $article['author'] ?></p>
                <p class="card-text mb-3"><?= $article['summary'] ?></p>
                <a href="<?= "index.php?action=article&id=" . $article['id'] ?>" class="stretched-link">Continuer la lecture</a>
            </div>
        </article>
    <?php } ?>
</div>