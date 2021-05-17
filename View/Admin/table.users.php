<table class="table table-hover">
    <caption>Liste des utilisateurs</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilsateur</th>
            <th>Groupe</th>
            <th>Date de création</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['pseudo']; ?></td>
                <td><?= $user['label']; ?></td>
                <td><?= $user['formatted_date']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-secondary" onclick="location.href='index.php?action=admin&option=edit_role&id=<?= $user['id']; ?>'"><i class="uil uil-edit-alt"></i>&#201;diter</button>
                            <button type="submit" class="btn btn-danger" formaction="index.php?action=delete_user" onclick="return confirm('Attention, la suppression de l\'utilisateur est irréversible !');"><i class="uil uil-cancel"></i>Supprimer</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>