<?php
	session_start();
	if (isset($_SESSION['LAST_REQUEST_TIME'])) {
		if (time() - $_SESSION['LAST_REQUEST_TIME'] > 3600) {
			// session timed out, last request is longer than 1hour ago
			$_SESSION = array();
			session_destroy();
		}
	}
	$_SESSION['LAST_REQUEST_TIME'] = time();

	//$orange = new PDO('mysql:host=localhost;dbname=orange', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8') ); //connexion bdd w10
	$soundbuzz = new PDO('mysql:host=mysql;dbname=Soundbuzz', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8') );  //connexion bdd ubuntu en local

	function enLigne(){
		if( !isset($_SESSION['user']) ){
			//Si la session utilisateur n'existe pas, cela signifie que l'on n'est pas connecté donc on retournera false
			return false;
		}
		else{ 
			return true;
		}
	} 
?>