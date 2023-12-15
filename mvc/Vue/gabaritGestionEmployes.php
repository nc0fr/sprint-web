<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank | Gestion</title>
      <!--<link rel="stylesheet" href="Vue/css/styleGestion.css">-->

      <meta charset="utf-8">
    </head>
    <body>

        <div class="navbar">
        <!--<div class="infos"></div>-->
        <a href="?action=gestion_employes"><div class="item">Gestion des employés</div></a>
        <a href="?action1=gestion_motifs"><div class="item">Gestion des justificatifs</div></a>
        <a href="?action3=gestion_comptes_contrats"><div class="item">Comptes et contrats</div></a>
        <div class="item">Statistiques</div>
        <a href="sprintBank.php"><div class="logout">Déconnexion</div></a>
        </div>



        <form method="post" class="formulaire">                        
          <fieldset class="ajouter">
          <h2>Ajouter Employé</h2>      
          <p><input type="text" name="nom" placeholder="Nom" required>
          <input type="text" name="prenom" placeholder="Prénom" required></p>
          <p><input type="text" name="login" placeholder="Nom d'utilisateur" required>
          <input type="password" name="mdp" placeholder="Mot de passe" required></p>
          <p><h4>Directeur</h4><input type="radio" name="poste" value="DIRECTEUR" required>
          <h4>Agent</h4><input type="radio" name="poste" value="AGENT" required>
          <h4>Conseiller</h4><input type="radio" name="poste" value="CONSEILLER" required></p>
          <h4>Date d'embauche</h4><input type="datetime-local" name="dateembauche">
          <p><input type="submit" name="ajtemploye" value="Ajouter"></p>
          </fieldset>
        </form>
        <?php
        if(isset($contenu)){
          echo '<p>'.$contenu.'</p>' ;
        } 
        ?>


        <form method="post" class="formulaire">    
          <fieldset class="modifier">    
          <h2>Modifier Identifiants</h2>
          <p><input type="text" name="nom" placeholder="Nom" required>
          <input type="text" name="prenom" placeholder="Prénom" required></p>
          <p><input type="text" name="login" placeholder="Nom d'utilisateur" required>
          <input type="password" name="mdp" placeholder="Mot de passe" required></p>
          <p><input type="submit" name="setemploye" value="Modifier"></p>
          </fieldset>
        </form>
       
    </body>
</html>
