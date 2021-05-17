<a class="btn btn-primary mb-2" href="index.php?action=form_article&option=ajout&id"><i class="uil uil-pen"></i>Ajouter un article</a>

<table class="table table-hover">
    <caption>Liste des articles</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Date de création</th>
            <th>Auteur</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <td><?= $article['id']; ?></td>
                <td><?= $article['title']; ?></td>
                <td><?= $article['summary']; ?></td>
                <td><?= $article['formatted_date']; ?></td>
                <td><?= $article['author']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-secondary" formaction="index.php?action=form_article&option=edit&id=<?= $article['id']; ?>"><i class="uil uil-edit-alt"></i>&#201;diter</button>
                            <button type="submit" class="btn btn-danger" formaction="index.php?action=delete_article" onclick="return confirm('Attention, la suppression de l\'article est irréversible !');"><i class="uil uil-cancel"></i>Supprimer</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>