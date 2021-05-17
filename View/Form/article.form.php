<?php $this->title = $actionLabel; ?>

<div class="container mt-3">
    <form method="post" action="index.php?action=<?= $action; ?>">
        <fieldset>
            <legend class="h1"><?= $actionLabel; ?></legend>
            <div class="mb-3">
                <label for="title">Titre de l'article</label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Chapitre premier" value="<?php if (isset($article)) echo $article['title']; ?>" maxlength="255" required>
            </div>
            <div class="mb-3">
                <label for="summary">Résumé de l'article</label>
                <textarea class="form-control" id="summary" name="summary" rows="3" placeholder="Ce chapitre parle de..." ><?php if (isset($article)) echo $article['summary']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="content">Que souhaitez-vous raconter ?</label>
                <textarea class="tinymce form-control" id="content" name="content" rows="10" placeholder="Il était une fois..." ><?php if (isset($article)) echo $article['content']; ?></textarea>
            </div>
            <input class="form-control" type="hidden" name="article_id" value="<?php if (isset($id)) echo $id; ?>">

            <div class="btn-group-vertical d-flex mt-4">
                <input type="submit" class="w-100 btn btn-primary" value="Ajouter">
                <input type="reset" class="w-100 btn btn-secondary">
            </div>
        </fieldset>
    </form>
</div>