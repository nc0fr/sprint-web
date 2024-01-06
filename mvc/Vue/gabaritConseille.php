<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank | Conseiller</title>
      <link rel="stylesheet" href="Vue/css/styleConseille.css">
      <meta charset="utf-8">
    </head>
    <body>
    <div class="navbar">
      <div class="infos"><?php if (!empty($contenu)) {
              echo $contenu;
          } ?></div>
      <div class="item">Interface 1</div>
      <div class="item">Interface 2</div>
      <div class="item">Interface 3</div>
      <div class="item">Interface 4</div>
      <a href="sprintBank.php"><div class="logout">Déconnexion</div></a>
    </div>
    </body>
</html>

