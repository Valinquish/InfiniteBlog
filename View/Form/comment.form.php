<form method="post" action="index.php?action=edit_comment&id=<?= $commentaire['id']; ?>">
    <fieldset>
        <legend>Que souhaitez-vous modifier ?</legend>
        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
        <textarea class="form-control" id="content" name="content" rows="4" required><?= $commentaire['content']; ?></textarea><br />
        <input class="w-100 btn btn-secondary" type="submit" value="Modifier">
    </fieldset>
</form>