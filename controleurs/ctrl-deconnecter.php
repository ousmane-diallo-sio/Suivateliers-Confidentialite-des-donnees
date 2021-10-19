<?php 

    session_start();

	if($_SESSION[ 'admin' ]){
		$login = $_SESSION[ 'email' ] ;
	}
	else{
		$login = $_SESSION[ 'login' ];
	}
	
	session_unset() ;
	session_destroy() ;
	
	header( "Location: ../index.php?login=$login" ) ;

?>