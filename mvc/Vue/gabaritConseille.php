<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Conseiller</title>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <meta charset="utf-8">
</head>
<body>
<div class="navbar">
    <div class="infos"><?php if (isset($contenuInfoConseiller)) {
            echo $contenuInfoConseiller;
        } ?></div>
    <a href="?actionConseil=conseiller_inscription_client">
        <div class="item">Inscription Client</div>
    </a>
    <?php if (isset($contenuNavBar)) {
        echo $contenuNavBar;
    } ?>
    <a href="sprintBank.php">
        <div class="logout">Déconnexion</div>
    </a>
</div>
<div>
    <?php if (isset($contenu)) {
        echo $contenu;
    } ?>
</div>
</body>
</html>

