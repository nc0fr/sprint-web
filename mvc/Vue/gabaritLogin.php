<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="Vue/css/styleLogin.css">
    <title>Sprint Bank | Login</title>
    <meta charset="utf-8">

</head>
<body>
<div class="ensemble">
    <h2>Connectez-vous</h2>
    <form method="post" class="formulaire">
        <label>
            <input type="text"
                   name="login"
                    placeholder="Nom d'utilisateur"
                    required>
        </label>
        <label>
            <input type="password"
                   name="mdp"
                   placeholder="Mot de passe"
                   required>
        </label>
        <input type="submit"
               name="connexion"
               value="Connexion"
               class="boutton">
    </form>
</div>
<?php if (!empty($contenu)) {
    echo $contenu;
} ?>
</body>
</html>

