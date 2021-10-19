<?php 

	$datetime = new DateTime();
	$dateHeure = $datetime->format('D-m-y H:i:s');

?>


<?php 

	function getListeAteliers(){

		try{

			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers',
							'sanayabio',
							'sb2021'
			);

			$sql = 'select * from Atelier';

			$st = $bd->prepare($sql);

			$st->execute();

			$listeAteliers = $st->fetchall();

			unset($bd);


			if( count( $listeAteliers == 1 ) ){
				return $listeAteliers;
			}


		}
		catch(PDOException $e){
			print_r($e);
		}


	} 
?>


<?php 

	$login = $_POST[ 'email' ];
	$mdp = $_POST[ 'mdp' ];

	if( preg_match("/admin/", $login) ){
		
		$login = $_POST[ 'email' ] ;
		$mdp = $_POST[ 'mdp' ] ;
		
		try {
	
			$ipClient = $_SERVER['REMOTE_ADDR'];
			$navigateurClient = $_SERVER['HTTP_USER_AGENT'];
	
			
	
			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers' ,
							'sanayabio' ,
							'sb2021'
				) ;
				
			$sql = 'select * '
				 . 'from Responsable_Atelier '
				 . 'where nom_de_connexion = :login '
				 . 'and mdp = :mdp' ;
				 
			$st = $bd -> prepare( $sql ) ;
			
			$st -> execute( array( 
									':login' => $login ,
									':mdp' => $mdp 
							) 
						) ;
			$resultat = $st -> fetchall() ;
				
			unset( $bd ) ;
			
			if( count( $resultat ) == 1 ) {
				session_start() ;
				$_SESSION[ 'login' ] = $login;
				$_SESSION[ 'numero' ] = $resultat[0]['numero'] ;
				$_SESSION[ 'nom_de_connexion' ] = $resultat[0]['nom_connexion'] ;
				$_SESSION[ 'nom' ] = $resultat[0]['nom'] ;
				$_SESSION[ 'prenom' ] = $resultat[0]['prenom'] ;
				$_SESSION['datetimeAuth'] = $datetime->format('D-m-y H:i:s');
				$_SESSION['listeAteliers'] = getListeAteliers();
				$_SESSION[ 'admin' ] = true;
	
				$resultatAuth = 'Ok';
				$_SESSION[ 'logContent' ] = $logContent;
	
	
				header( 'Location: ../vues/vue-liste-ateliers.php' ) ;
			}
			else {
				$logContent = "$ipClient | $dateHeure | $login | $resultatAuth | $navigateurClient\n";
	
	
				header( 'Location: ../index.php?echec=1') ;
			}
		}
		catch( PDOException $e ){
			
			$resultatAuth = "Nok";
							
			header( 'Location: ../index.php?echec=0' ) ;
		}

	}
	else{
		$email = $_POST[ 'email' ] ;
		$mdp = $_POST[ 'mdp' ] ;
		
		try {
	
			$ipClient = $_SERVER['REMOTE_ADDR'];
			$navigateurClient = $_SERVER['HTTP_USER_AGENT'];
	
			
	
			$bd = new PDO(
							'mysql:host=localhost;dbname=sbateliers' ,
							'sanayabio' ,
							'sb2021'
				) ;
				
			$sql = 'select * '
				 . 'from Client '
				 . 'where email = :email '
				 . 'and mdp = :mdp' ;
				 
			$st = $bd -> prepare( $sql ) ;
			
			$st -> execute( array( 
									':email' => $email ,
									':mdp' => $mdp 
							) 
						) ;
			$resultat = $st -> fetchall() ;
				
			unset( $bd ) ;
			
			if( count( $resultat ) == 1 ) {
				session_start() ;
				$_SESSION[ 'numero' ] = $resultat[0]['numero'] ;
				$_SESSION[ 'nom' ] = $resultat[0]['nom'] ;
				$_SESSION[ 'prenom' ] = $resultat[0]['prenom'] ;
				$_SESSION[ 'civilite' ] = $resultat[0]['civilite'] ;
				$_SESSION[ 'date_de_naissance' ] = $resultat[0]['date_de_naissance'] ;
				$_SESSION[ 'code_postal' ] = $resultat[0]['code_postal'] ;
				$_SESSION[ 'adresse' ] = $resultat[0]['adresse'] ;
				$_SESSION[ 'ville' ] = $resultat[0]['ville'] ;
				$_SESSION[ 'numero_tel' ] = $resultat[0]['numero_tel'] ;
				$_SESSION[ 'email' ] = $email ;
				$_SESSION['datetimeAuth'] = $datetime->format('D-m-y H:i:s');
				$_SESSION['listeAteliers'] = getListeAteliers();
	
	
				$resultatAuth = 'Ok';
				$_SESSION[ 'logContent' ] = $logContent;
	
	
				header( 'Location: ../vues/vue-liste-ateliers.php' ) ;
			}
			else {
				$logContent = "$ipClient | $dateHeure | $email | $resultatAuth | $navigateurClient\n";
	
	
				header( 'Location: ../index.php?echec=1') ;
			}
		}
		catch( PDOException $e ){
			
			$resultatAuth = "Nok";
							
			header( 'Location: ../index.php?echec=0' ) ;
		}
	}

?>