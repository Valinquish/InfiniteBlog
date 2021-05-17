<?php $this->title = "Infinite Blog - " . $article['title']; ?>

<article>
    <div class="text-center py-5" style="background: linear-gradient(0.25turn, #f15a2b, #e94b4e);">
        <div class="container">
            <h1 class="display-1"><?= $article['title'] ?></h1>
            <p class="lead"><?= $article['summary'] ?></p>
        </div>
    </div>
    <div class="container mt-2">
        <p class="text-muted">Publié le <?= $article['formatted_date'] ?> par <i class="uil uil-user-circle"></i><?= $article['author'] ?></p>
        <div class="mb-3"><?= $article['content'] ?></div>
    </div>
</article>

<!-- Administration -->
<div class="container">
    <?php if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) { ?>
        <form method="post">
            <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-secondary" formaction="index.php?action=form_article&option=edit&id=<?= $article['id']; ?>"><i class="uil uil-edit-alt"></i>&#201;diter</button>
                <button type="submit" class="btn btn-danger" formaction="index.php?action=delete_article" onclick="return confirm('Attention, la suppression de l\'article est irréversible !');"><i class="uil uil-cancel"></i>Supprimer</button>
            </div>
        </form>
    <?php } ?>
</div>
<hr>

<!-- Commentaires -->
<div class="container">
    <h2>Commentaires</h2>
    <?php if ($commentaires->rowCount() > 0) { ?>
        <?php foreach ($commentaires as $commentaire) { ?>
            <!-- Contenu des commentaires -->
            <p class="mb-1 text-muted"><i class="uil uil-user-circle"></i><?= $commentaire['author'] ?> a commenté le <?= $commentaire['formatted_date']; ?> :</p>
            <p><?= $commentaire['content'] ?></p>
            <!-- Gestion d'un commentaire -->
            <div class="mb-3">
                <?php if ((isset($_SESSION['user_id']) && $_SESSION['user_id'] == $commentaire['author_id']) || (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1)) { ?>
                    <form method="post">
                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                        <input type="hidden" name="comment_id" value="<?= $commentaire['id']; ?>">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#editCommment<?= $commentaire['id']; ?>" aria-expanded="false"><i class="uil uil-edit-alt"></i>&#201;diter</button>
                            <button type="submit" class="btn btn-danger" formaction="index.php?action=delete_commentaire" onclick="return confirm('Attention, la suppression du commentaire est irréversible !');"><i class="uil uil-cancel"></i>Supprimer</button>
                        </div>
                    </form>
                    <div class="collapse" id="editCommment<?= $commentaire['id']; ?>">
                        <form method="post" >
                            <fieldset>
                                <legend>Que souhaitez-vous modifier ?</legend>
                                <input type="hidden" name="action" value="edit_comment">
                                <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                <input type="hidden" name="comment_id" value="<?= $commentaire['id']; ?>">
                                <textarea class="form-control" name="edit_content" rows="4"><?= $commentaire['content']; ?></textarea>
                                <input class="w-100 btn btn-secondary" type="submit" value="Modifier">
                            </fieldset>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <!-- #Gestion d'un commentaire -->
        <?php } ?>
    <?php } else { ?>
        <p class="alert alert-primary" role="alert">Il n'y a pas de commentaires... soyez le premier à commenter !</p>
    <?php } ?>
</div>
<hr>

<!-- Ajouter un commentaire -->
<div class="container">
    <!-- Ne s'affiche que si un utilisateur est connecté -->
    <?php if (isset($_SESSION['user_id'])) { ?>
        <form method="post" action="index.php?action=commenter">
            <fieldset>
                <legend>Que voulez-vous commenter, <?= $_SESSION['pseudo']; ?> ?</legend>
                <textarea class="form-control" id="content" name="content" rows="4" placeholder="Votre commentaire" required></textarea>
                <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                <input class="w-100 btn btn-primary mt-3" type="submit" value="Commenter">
            </fieldset>
        </form>
        <!-- Affiche un avertissement si l'utilisateur n'est pas connecté -->
    <?php } else { ?>
        <p class="alert alert-warning" role="alert">Vous devez être <a href="index.php?action=form_connexion">connecté</a> pour commenter cet article.</p>
    <?php } ?>
</div>