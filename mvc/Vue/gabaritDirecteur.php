<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank | Gestion employés</title>
      <!--<link rel="stylesheet" href="Vue/css/styleDirecteur.css">-->
      <script type="text/javascript" src="/Vue/js/directeur.js"></script>
      <meta charset="utf-8">
    </head>
    <body>
    <div class="navbar">
      <div class="infos"><?php if (isset($contenu1)) {
          echo $contenu1;
      } ?></div>
      <a href="?action=gestion_employes"><div class="item">Gestion des employés</div></a>
      <a href="?action1=gestion_motifs"><div class="item">Gestions des justificatifs</div></a>
      <a href="?action3=gestion_comptes_contrats"><div class="item">Comptes et contrats</div></a>
      <div class="item">Statistiques</div>
      <a href="sprintBank.php"><div class="logout">Déconnexion</div></a>
    </div>
      <?php if (isset($contenu)) {
          echo $contenu;
      } ?>
    </body>
</html>

