<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Accueil</title>
		
		<link rel="stylesheet" href="./src/styles.css">

	</head>



	<body>

        <?php 
			$lienPage = $_SERVER["REQUEST_URI"];
			$identifiant = explode("login=", $lienPage);

		?>
		
		<form action="controleurs/ctrl-connecter.php" method="POST" style="display:flex; flex-direction:column;" >
			<label>Identifiant</label>
			<input name="email" type="email" value="<?php echo $identifiant[1]; ?>" />
			<label>Mot de passe</label>
			<input name="mdp" type="password" /> </br>
			<button type="submit">Se connecter</button>
		</form>

		<?php
		
			$styleErreur = 'color:red; background-color:#fee; border-radius:5%';

			switch($_SERVER['REQUEST_URI']){
				case "/suivateliers/index.php?echec=1" :
					echo "<p style='$styleErreur'>L'identifiant ou le mot de passe est incorrect.</p>";
					break;
				case "/suivateliers/index.php?echec=0":
					echo "<p style='$styleErreur'>Erreur lors de la tentative de connexion.</p>";
					break;
			}

		?>
		
	</body>


</html>
