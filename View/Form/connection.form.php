<?php $this->title = ucfirst($action); ?>

<main class="form-signin text-center">
    <form method="post" action="<?= "index.php?action=" . $action ?>">
        <fieldset>
            <legend class="h1 mb-3 fw-normal"><?= ucfirst($action); ?></legend>

            <div class="form-floating">
                <input type="text" class="form-control" id="login" name="login" placeholder="Pseudonyme" minlength="3" maxlength="100" required>
                <label for="login">Pseudonyme</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="100" required>
                <label for="password">Mot de passe</label>
            </div>

            <div class="btn-group-vertical d-flex" role="group">
                <input type="submit" class="w-100 btn btn-primary" value="<?= $actionLabel; ?>">
                <input type="reset" class="w-100 btn btn-secondary">
            </div>
        </fieldset>
    </form>

</main>