<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Conseiller</title>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <meta charset="utf-8">
</head>
<body>
<header class="p-3 navbar bg-neutral text-neutral-content">
    <div class="navbar-start">
        <?php if (isset($contenuInfoConseiller)) {
            echo $contenuInfoConseiller;
        } ?>
    </div>

    <div class="navbar-center gap-8">
        <a href="?actionConseil=conseiller_inscription_client">
            <div class="item">Inscription client</div>
        </a>
        <?php if (isset($contenuNavBar)) {
            echo $contenuNavBar;
        } ?>
    </div>

    <a href="sprintBank.php" class="navbar-end">
        <div class="logout">Déconnexion</div>
    </a>
</header>
<main class="m-4 mx-6 bg-base-100 text-neutral">
    <?php if (isset($contenu)) {
        echo $contenu;
    } ?>
</main>
</body>
</html>

