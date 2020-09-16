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
    require_once('base/head.php');
    require_once('base/navbar.php');
?>
<body>
    <section class= "top">
    <div class="dropbtn2">
        <a href="mymusic.php">Retour</a><br><br>
</section>
    <?php
        if( isset($_POST['ajout']) ){ 
            $valid='';
            $error='';
            $date_transfert=date("Y-m-d");
            if(!empty($_POST['titre_morceau']) AND !empty($_POST['genre']) AND !empty($_POST['description_music']) AND !empty($_POST['artiste']) AND !empty($_POST['compositeur']) 
            AND !empty($_POST['contenu']) AND !empty($date_transfert) AND !empty($_POST['date_creation']) AND !empty($_POST['duree_morceau']) AND !empty($_FILES['logo']['name']) ){

                $photo=$_FILES['logo']['name'];
                $add = $soundbuzz->prepare(" INSERT INTO music (titre_morceau, genre, description_music, photo, artiste, compositeur, contenu, date_transfert, 
                date_creation, duree_morceau, fk2_id_user) VALUES (:titre_morceau, :genre, :description_music, :photo, :artiste, :compositeur, :contenu, :date_transfert, :date_creation, :duree_morceau, :fk2_id_user) ");
                $add->bindParam(':titre_morceau', $_POST['titre_morceau']);
                $add->bindParam(':genre', $_POST['genre']);
                $add->bindParam(':description_music', $_POST['description_music']);
                $add->bindParam(':photo', $photo);
                $add->bindParam(':artiste', $_POST['artiste']);
                $add->bindParam(':compositeur', $_POST['compositeur']);
                $add->bindParam(':contenu', $_POST['contenu']);
                $add->bindParam(':date_transfert', $date_transfert);
                $add->bindParam(':date_creation', $_POST['date_creation']);
                $add->bindParam(':duree_morceau', $_POST['duree_morceau']);
                $add->bindParam(':fk2_id_user', $id_user);
                $add->execute();
                $valid .= '<div style="color:green;text-align:center;">Music Ajouté ! <a href="mymusic.php">Cliquez ici pour la voir</a></div>';
                echo($valid);
            }
            else {
                $error .= '<div style="color:red;text-align:center; font-weight: bold; text-decoration: underline;">Veuillez remplir tout les champs</div>';
            }
        }
        ?>
    </top>
    <section>
        <h1>Ajoutez votre<b> Musique</b></h1><br>
        <?php echo $inscrip; ?>
        <?php echo $error; ?>
        <?php echo $errormdp; ?>
        <br>
        <!-- Formulaire d'inscription -->
        <form method="post" class="form-style-7" action=""  enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="nom">Titre du Morceau</label>
                    <input type="text" name="titre_morceau"><br><br>
                    <span> Entrez le nom du morceau </span>
                </li>
                <li>
                    <label for="prenom">Genre</label>
                    <input type="text" name="genre"><br><br>
                    <span> Entrez le genre de la musique </span>
                </li>
                <li>
                    <label for="nom">Description</label>
                    <input type="text" name="description_music"><br><br>
                    <span> Entrez une brève description </span>
                </li>
                <li>
                    <label for="prenom">Artiste</label>
                    <input type="text" name="artiste"><br><br>
                    <span> Entrez le nom de l'artiste </span>
                </li>
                <li>
                    <label for="nom">Compositeur</label>
                    <input type="text" name="compositeur"><br><br>
                    <span> Entrez le nom du compositeur </span>
                </li>
                <li>
                    <label for="nom">Contenu</label>
                    <input type="text" name="contenu"><br><br>
                    <span> Entrez le type de contenu </span>
                </li>
                <li>
                    <label for="prenom">Date Création</label>
                    <input type="date" name="date_creation"><br><br>
                    <span> Entrez la date de création du morceau </span>
                </li>
                <li>
                    <label for="nom">Durée (seconde)</label>
                    <input type="int" name="duree_morceau"><br><br>
                    <span> Entrez la durée du morceau en SECONDE </span>
                </li>
                <li>
                    <label for="url">Télécharger la photo</label>
                    <input type="file" id="logo" name="logo" accept=".png, .jpeg, .jpg" maxlength="100">
                    <span>Téléchargez le logo au format PNG, JPEG ou JPG</span>
                </li>
                <li>
                    <input type="submit" name="ajout" class="dropbtn2" value="Ajouter">
                </li>
            </ul>
        </form>
        <?php
            //Verifie l'extension et la taille du PDF
            if(isset($_FILES['logo']['name'])) {
                $dossier = 'logo/';
                $fichier = basename($_FILES['logo']['name']);
                $taille_maxi = 100000;
                $taille = filesize($_FILES['logo']['tmp_name']);
                $extensions = array('.png', '.jpeg', '.jpg','.PNG', '.JPEG', '.JPG');
                $extension = strrchr($_FILES['logo']['name'], '.'); 
                //Début des vérifications de sécurité...
                if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                {
                    $erreur_file = 'Vous devez uploader un fichier de type png, jpeg, jpg !';
                }
                if($taille>$taille_maxi)
                {
                    $erreur_file = 'Le fichier est trop gros...';
                }
                if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                {
                    //On formate le nom du fichier ici...
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    if(move_uploaded_file($_FILES['logo']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                    {
                    }
                    else //Sinon (la fonction renvoie FALSE).
                    {
                        $erreur_upload = 'Echec de l\'upload !';
                    }
                }
            }
        ?>
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