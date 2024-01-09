<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Directeur</title>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <meta charset="utf-8">
</head>
<body>
<div class="navbar">
    <div class="infos">
        <?php if (!empty($contenu1)) {
            echo $contenu1;
        } ?>
    </div>
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
    <a href="sprintBank.php">
        <div class="logout">Déconnexion</div>
    </a>
</div>
<?php if (!empty($contenu)) {
    echo $contenu;
} ?>
</body>
</html>

