<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS custom -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <link href="Assets/style.css" rel="stylesheet">
    <link rel="icon" href="Assets/logo.ico">
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Unicode -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/4d5plchu170imydswmjk84vyh16yiwzsuwpuv91hwm66862n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="Assets/script.js" referrerpolicy="origin"></script>
    <title><?= $title ?></title>
</head>

<body>
    <!-- Section de navigation -->
    <nav class="d-flex flex-wrap justify-content-center px-3 py-1 bg-dark">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-light text-decoration-none" href="index.php" id="top">
            <img class="bi me-2" alt="logo" src="Assets/logo.png" height="30">
            <span class="blog-generic-title fs-4">Infinite</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link link-light" href="index.php"><i class="uil uil-house-user"></i>Accueil</a></li>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li class="nav-item"><a class="nav-link link-light" href="index.php?action=form_connexion"><i class="uil uil-signin"></i>Connexion</a></li>
                <li class="nav-item"><a class="nav-link link-light" href="index.php?action=form_inscription"><i class="uil uil-user-plus"></i>Inscription</a></li>
            <?php } else { ?>
                <?php if ($_SESSION['role_id'] == 0) { ?>
                    <li class="nav-item"><a class="nav-link link-light" href="index.php?action=account"><i class="uil uil-user"></i>Compte</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link link-light" href="index.php?action=admin"><i class="uil uil-dashboard"></i>Administration</a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link link-light" href="index.php?action=deconnexion"><i class="uil uil-signout"></i>Déconnexion</a></li>
            <?php } ?>
        </ul>
    </nav>

    <div>
        <?= $content ?>
        <!-- Élément spécifique géré par la Vue et les Controleurs -->
    </div>

    <footer class="footer bg-dark text-center">
        <div class="container d-flex flex-wrap justify-content-center">
            <a class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-muted text-decoration-none" href="#top">Retour en haut</a>
            <span class="col-12 col-lg-auto mb-3 mb-lg-0 text-muted">Programmation Web | L3 MIASHS - IDS | 2020-2021</span>
        </div>
    </footer>
</body>

</html>