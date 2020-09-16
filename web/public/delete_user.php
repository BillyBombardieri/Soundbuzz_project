<?php 
    require_once('base/init.php');
    if ( !enLigne() ){ 
        header('location:connexion.php');
        exit();
    }    
    $id=$_GET['id_user'];
    var_dump($id);
    $delete = $soundbuzz->exec(" DELETE FROM user WHERE id_user=$id");
    //header("Location: gestionUser.php");
?>
                    