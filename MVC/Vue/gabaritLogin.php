<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank : Login</title>
      <link rel="stylesheet" href="Vue/css/styleLogin.css">
      <meta charset="utf-8">
    </head>
    <body>
        <form method="post">                        
                <p><label>Nom d'utilisateur :</label>
                <input type="text" name="login"></p>
                <p><label>Mot de passe :</label>
                <input type="password" name="mdp"></p>
                <p><input type="submit" value="Connexion" name="connexion"></p>
                <?php echo $contenu; ?>
        </form>
    </body>
</html>

