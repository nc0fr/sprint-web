<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Agent</title>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <meta charset="utf-8">
</head>
<body>
<header class="p-3 navbar bg-neutral text-neutral-content">
    <div class="navbar-start">
        <?php if (! empty($contenu1)) {
            echo $contenu1;
        } ?>
    </div>

    <div class="navbar-center gap-8">
        <a href="?action=gestion_clients">
            <div class="item">Modifier client</div>
        </a>
        <a href="?action=synthese">
            <div class="item">Synthèse client</div>
        </a>
        <a href="?action=operations">
            <div class="item">Effectuer opération</div>
        </a>
        <div class="item">Gestion RDV</div>
    </div>

    <a href="sprintBank.php" class="navbar-end">
        <div class="logout">Déconnexion</div>
    </a>
</header>
<main class="m-4 mx-6 bg-base-100 text-neutral">
    <form method="post" class="formulaire">
        <?php
        if (isset($contenu)) {
            echo '<p>'.$contenu.'</p>';
        }
        ?>
    </form>
</main>
<footer class="footer bg-neutral text-neutral-content">
    <div class="p-2">
        <div class="text-center text-sm">
            © 2024 Sprint Bank
        </div>
    </div>
</footer>
</body>
</html>
