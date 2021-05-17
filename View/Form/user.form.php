<?php if (isset($_GET['id']) && $_SESSION['role_id'] == 1) { ?>
    <form method="post">
        <fieldset>
            <legend class="blog-generic-title">Changer le role</legend>

            <label for="role_id">Nouveau role :</label>
            <select id="role_id" name="role_id">
                <?php foreach ($roles as $role) { ?>
                    <option value="<?= $role['id'] ?>"><?= $role['label'] ?></option>
                <?php } ?>
            </select>

            <input type="hidden" name="action" value="edit_role">

            <input type="submit" name="submit" value="Envoyer">
        </fieldset>
    </form>
    <a href="index.php?action=admin">Annuler</a>
<?php } else { ?>
    <form class="mb-3" method="post" action="index.php?action=edit_username">
        <fieldset>
            <legend class="blog-generic-title">Changer votre nom d'utilisateur</legend>

            <div class="form-floating">
                <input class="form-control" type="text" id="login" name="login" placeholder="Pseudonyme" value="<?= $_SESSION['pseudo']; ?>" minlength="3" maxlength="100" required>
                <label for="login">Pseudonyme</label>
            </div>

            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

            <div class="btn-group mt-2" role="group">
                <input class="btn btn-primary" type="submit" name="submit" value="Modifier">
                <input class="btn btn-secondary" type="reset" name="reset" value="Annuler">
            </div>
        </fieldset>
    </form>

    <form method="post" action="index.php?action=edit_password">
        <fieldset>
            <legend class="blog-generic-title">Changer votre mot de passe</legend>

            <div class="form-floating">
                <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe" minlength="3" maxlength="100" required>
                <label for="password">Mot de passe</label>
            </div>

            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

            <div class="btn-group mt-2" role="group">
                <input class="btn btn-primary" type="submit" name="submit" value="Modifier">
                <input class="btn btn-secondary" type="reset" name="reset" value="Annuler">
            </div>
        </fieldset>
    </form>
<?php } ?>