<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sprint Bank | Gestion Clients</title>
    <!--<link rel="stylesheet" href="Vue/css/styleGestion.css">-->

    <meta charset="utf-8">
</head>
<body>
<div class="navbar">
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
    <a href="sprintBank.php">
        <div class="logout">Déconnexion</div>
    </a>
</div>
<form method="post" class="formulaire">
    <?php
    if (! empty($contenu)) {
        echo '<p>'.$contenu.'</p>';
    }
    ?>
</form>


