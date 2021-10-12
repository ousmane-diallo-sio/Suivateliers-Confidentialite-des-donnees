<?php session_start(); ?>


<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Liste stagiaires</title>
		
		<link rel="stylesheet" href="../src/styles.css"/>
		
	</head>



	<body>
		
		<?php include '../composants/bar-de-navigation.php'; ?>
		
		<div style="display: flex; flex-direction: column; text-align: center; align-items: center">
			<h2>Bienvenue <?php echo $_SESSION['prenom'] ?> </h2>

				<p>Liste des stagiaires :</p>

				

		</div>
		
	</body>


</html>
