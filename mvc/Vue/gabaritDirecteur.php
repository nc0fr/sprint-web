<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Directeur</title>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <meta charset="utf-8">
</head>
<body>
<header class="p-3 navbar bg-neutral text-neutral-content">
    <div class="infos navbar-start">
        <?php if (! empty($contenu1)) {
            echo $contenu1;
        } ?>
    </div>

    <div class="navbar-center gap-8">
        <a href="?action=gestion_employes">
            <div class="item">Gestion des employés</div>
        </a>
        <a href="?action=gestion_motifs">
            <div class="item">Gestions des justificatifs</div>
        </a>
        <a href="?action=gestion_comptes_contrats">
            <div class="item">Comptes et contrats</div>
        </a>
        <a href="?action=statistiques">
            <div class="item">Statistiques</div>
        </a>
    </div>
    <a href="sprintBank.php" class="navbar-end">
        <div class="logout">Déconnexion</div>
    </a>
</header>
<main class="m-4 mx-6 bg-base-100 text-neutral">
    <?php if (! empty($contenu)) {
        echo $contenu;
    } ?>
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

