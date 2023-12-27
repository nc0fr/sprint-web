<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank | Agent</title>
      <!--<link rel="stylesheet" href="Vue/css/styleAgent.css">-->
      <meta charset="utf-8">
    </head>
    <body>
    <div class="navbar">

      <a href="?action2=gestion_clients"><div class="item">Modifier client</div></a>
      <a href= "?action5==synthese"><div class="item">Synthèse client</div></a>
      <a href="?action4==operations"><div class="item">Effectuer opération</div></a>
      <div class="item">Gestion RDV</div>
      <a href="sprintBank.php"><div class="logout">Déconnexion</div></a>
    </div>
    <form method="post" class="formulaire">
        <?php
        if (isset($contenu)){
        echo '<p>'.$contenu.'</p>';
        }
        ?>
    </form>





    </body>
</html>
