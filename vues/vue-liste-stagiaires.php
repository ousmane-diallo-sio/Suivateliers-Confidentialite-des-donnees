<?php session_start(); ?>


<?php

	function getListeParticipants(){
		
		try{

			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers',
							'sanayabio',
							'sb2021'
			);

			$sql = 'select * from Participation';

			$st = $bd->prepare($sql);

			$st->execute();

			$resultat = $st->fetchall();

			unset($bd);


			if( count( $resultat == 1 ) ){
				return $resultat;
			}


		}
		catch(PDOException $e){
			print_r($e);
		}

	}


    function getListeParticipantsParAtelier(){
		
		$numAtelier = $_GET[ 'numAtelier' ];
		try{

			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers',
							'sanayabio',
							'sb2021'
			);

			$sql = 'select numero, nom, prenom, ville from Client c inner join Participation p on c.numero = p.numero_client where numero_atelier = :numAtelier;';

			$st = $bd->prepare($sql);

			$st->execute( array(
						':numAtelier' => $numAtelier,
						) 
			);

			$resultat = $st->fetchall();

			unset($bd);


			if( count( $resultat == 1 ) ){
				return $resultat;
			}


		}
		catch(PDOException $e){
			print_r($e);
		}

	}

	$listeParticipants = getListeParticipantsParAtelier();
	

?>


<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Liste stagiaires</title>
		
		<link rel="stylesheet" href="../src/styles.css"/>
		
	</head>



	<body>
		
		<?php include '../composants/bar-de-navigation.php'; ?>
		
		<div style="display: flex; flex-direction: column; text-align: center; align-items: center">

				<h4>Liste des stagiaires pour l'atelier numéro <?php echo $_GET[ 'numAtelier' ] ?></h4>
				
				<table>

					<thead>
						<td>Numéro client</td>
						<td>Nom</td>
						<td>Prénom</td>
						<td>Ville</td>
					</thead>

					<tbody>
						<?php 
							foreach($listeParticipants as $participant){
					
								echo "<tr>";
									echo "<td>" .$participant['numero'] ."</td>";
									echo "<td>" .$participant['nom'] ."</td>"; 
									echo "<td>" .$participant['prenom'] ."</td>"; 
									echo "<td>" .$participant['ville'] ."</td>"; 
								echo "</tr>";

							}								
						?>
					</tbody>
					
				</table>
					

		</div>
		
	</body>


</html>
