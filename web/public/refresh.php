<?php
require_once('base/init.php');
    if ( !enLigne() ){ 
        header('location:connexion.php');
        exit();
    }    
    header("Location: random.php");
?>