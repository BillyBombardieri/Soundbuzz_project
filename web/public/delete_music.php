<?php 
    require_once('base/init.php');
    if ( !enLigne() ){ 
        header('location:connexion.php');
        exit();
    }    
    $id=$_GET['id_music'];

    $delete = $soundbuzz->exec(" DELETE FROM music WHERE id_music=$id");
    header("Location: mymusic.php");
?>