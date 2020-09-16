<?php 
    require_once('base/init.php'); 
    if( !enLigne() ){
        header('location:accueil.php');
        exit();
    }
    $verifAdmin = $_SESSION['user']['droit'];
    $email = $_SESSION['user']['email'];
    $id_user = $_SESSION['user']['id_user'];
    if ($verifAdmin == 3 || $verifAdmin==1) {
    require_once('base/head.php') 
?>
<body>
    <?php require_once('base/navbar_base.php'); ?>
    <section class= "top">
    <div class="dropbtn2">
        <a href="myplaylist.php">Retour</a><br><br>
</section>
    <?php
        if( isset($_POST['ajout']) ){ 
            $valid='';
            $error='';
            if(!empty($_POST['nom']) AND !empty($_POST['description']) ){
                $nom= $_POST['nom'];
                $description= $_POST['description'];
                $add = $soundbuzz->exec(" INSERT INTO playlist(nom_playlist, description_playlist, fk_id_user) VALUES('$nom', '$description', '$id_user')");
                $valid .= '<div style="color:green;text-align:center;">Playlist Ajouté ! <a href="myplaylist.php">Cliquez ici pour la voir</a></div>';
                echo($valid);
            }
            else {
                $error .= '<div style="color:red;text-align:center; font-weight: bold; text-decoration: underline;">Veuillez remplir tout les champs</div>';
            }
        }
        ?>
    </top>
    <section>
        <h1>Créer votre<b> Playlist</b></h1><br>
        <?php echo $inscrip; ?>
        <?php echo $error; ?>
        <?php echo $errormdp; ?>
        <br>
        <!-- Formulaire d'inscription -->
        <form method="post" class="form-style-7" action=""  enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom"><br><br>
                    <span> Entrez le nom de la playlist </span>
                </li>
                <li>
                    <label for="prenom">Description</label>
                    <input type="text" name="description"><br><br>
                    <span> Entrez une petite description </span>
                </li>
                <li>
                    <input type="submit" name="ajout" class="dropbtn2" value="Ajouter">
                </li>
        </form>
    </section>
</body>  
<?php
} elseif ($verifAdmin==NULL) { ?>
    <body class="noir">
        <div class="blanc">
            <a href="../accueil.php" class="img"><img src="favicon.ico" alt=""></a>
            <p class="p_erreur"> Vous n'avez pas accès à ce contenu, veuillez cliquer sur l'image afin d'être redirigé</p>
        </div>
    </body> 
<?php } ?>     
<style>
    body {
        margin: 0;
        padding: 0;
    }

    h1 {
        margin-top: 2%;
        text-align: center;
        font-size: 300%;
    }
    b {
        color: #55acee;
    }

    section p {
        text-align: center;
        font-size: 130%;
    }

    .formulaire {
        text-align: center;
        font-size: 150%;
    }

    .formulaire input {
        font-size: 50%;
    }



    p a {
        text-align: center;
        font-size: 90%;
    }

    .top a {
        text-decoration: none;
        color: white;
        font-size: 15px;
    }

    .dropbtn2 {
    background-color: #55acee;
    color: white;
    padding: 13px;
    border: none;
    cursor: pointer;
    width: 16vh;
    margin-left : 30px;
    margin-top : 13px;
    text-align : center;
    padding-bottom : unset;
    position: relative;
    display: inline-block;
    }
</style>

<style type="text/css">
    .form-style-7{
        max-width:65vh;
        margin: auto;
        background:#fff;
        border-radius:2px;
        padding:20px;
        font-family: Georgia, "Times New Roman", Times, serif;
    }
    .form-style-7 h1{
        display: block;
        text-align: center;
        padding: 0;
        margin: 0px 0px 20px 0px;
        color: black;
        font-size:x-large;
    }
    .form-style-7 ul{
        list-style:none;
        padding:0;
        margin:0;	
    }
    .form-style-7 li{
        display: block;
        padding: 9px;
        border:1px solid black;
        margin-bottom: 30px;
        border-radius: 3px;
    }
    .form-style-7 li:last-child{
        border:none;
        margin-bottom: 0px;
        text-align: center;
    }
    .form-style-7 li > label{
        display: block;
        float: left;
        margin-top: -19px;
        background: #FFFFFF;
        height: 14px;
        padding: 2px 5px 2px 5px;
        color: black;
        font-size: 16px;
        overflow: hidden;
        font-family: Arial, Helvetica, sans-serif;
    }
    .form-style-7 input[type="text"],
    .form-style-7 input[type="date"],
    .form-style-7 input[type="datetime"],
    .form-style-7 input[type="email"],
    .form-style-7 input[type="number"],
    .form-style-7 input[type="textarea"],
    .form-style-7 input[type="search"],
    .form-style-7 input[type="time"],
    .form-style-7 input[type="url"],
    .form-style-7 input[type="file"],
    .form-style-7 input[type="password"],
    .form-style-7 input[type="radio"],
    .form-style-7 textarea,
    .form-style-7 select 
    {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        outline: none;
        border: none;
        height: 45px;
        line-height: 25px;
        font-size: 16px;
        padding: 0;
        font-family: Georgia, "Times New Roman", Times, serif;
    }
    .form-style-7 li > span{
        background: #55acee;
        display: block;
        padding: 3px;
        margin: 0 -9px -9px -9px;
        text-align: center;
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }
    .form-style-7 textarea{
        resize:none;
    }
    .form-style-7 input[type="submit"],
    .form-style-7 input[type="button"]{
        background:black;
        border: none;
        padding: 10px 20px 10px 20px;
        border-bottom: 3px solid #55acee;
        border-radius: 3px;
        color: white;
    }
    .form-style-7 input[type="submit"]:hover,
    .form-style-7 input[type="button"]:hover{
        background: #55acee;
        color:white;
    }
</style>

<?php require_once('base/footer.php');  ?>