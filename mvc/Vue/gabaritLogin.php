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
                
                <input type="text" name="login" placeholder="Nom d'utilisateur" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type="submit" name="connexion" value="Connexion" class="boutton">
                
        </form>
      </div>
      <?php echo $contenu; ?>
    </body>
</html>

