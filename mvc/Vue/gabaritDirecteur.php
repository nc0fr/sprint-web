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
                  <input type="submit" name="gestionJustificative" value="Gestion des justificative">
                </p>
              </form>
            </li>
			  		<li>Pièces justificatives</li>
		  			<li>Statistiques</li>
		  		</ul>
			</nav>
      <?php echo $contenu; ?>
    </body>
</html>

