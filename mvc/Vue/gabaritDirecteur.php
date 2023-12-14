<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Sprint Bank | Gestion employés</title>
      <script type="text/javascript" src="/Vue/js/directeur.js"></script>
      <meta charset="utf-8">
    </head>
    <body>

      <nav>
				  <ul>
				  	<li>Gestion employés</li>
			  		<li>
              <form method='post' action="sprintBank.php">
                <p>
                  <input type="submit" name="showAllMotif" value="Gestion des motifs">
                </p>
              </form>
            </li>
			  		<li>
              <form method="post" action="sprintBank.php">
                <p>
                  <input type="submit" name="gestionTypeCompteContrat" value="Gestion des Comptes/Contrats"/>
                </p>
              </form>
            </li>
		  			<li>Statistiques</li>
		  		</ul>
			</nav>
      <?php if(isset($contenu)){
        echo $contenu;} ?>
    </body>
</html>

