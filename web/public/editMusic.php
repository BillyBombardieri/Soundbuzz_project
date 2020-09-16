<?php 
    require_once('base/init.php'); 
    if ( !enLigne() ){ 

        header('location: connexion.php');
        exit();
    }
    $verifAdmin = $_SESSION['user']['droit'];
    $id = $_GET['id_music'];
    $id_user = $_GET['id_utilisateur'];
    $droit = $_GET['admin'];
    if ($verifAdmin == 3 || $verifAdmin == 1) {
        $requete = $soundbuzz->prepare(" SELECT * FROM music WHERE id_music='$id'"); 
        //Enregistre les modifs si toutes les données sont entrées
        if(isset($_POST['enregistrer'])) { 
            if(!empty($_POST['titre_morceau']) ){
                $nom = $soundbuzz->exec("UPDATE music SET titre_morceau = '$_POST[titre_morceau]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['genre']) ){
                $prenom = $soundbuzz->exec("UPDATE music SET genre = '$_POST[genre]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['description_music']) ){
                $mail = $soundbuzz->exec("UPDATE music SET description_music = '$_POST[description_music]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['artiste']) ){
                $nom = $soundbuzz->exec("UPDATE music SET artiste = '$_POST[artiste]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['compositeur']) ){
                $prenom = $soundbuzz->exec("UPDATE music SET compositeur = '$_POST[compositeur]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['contenu']) ){
                $mail = $soundbuzz->exec("UPDATE music SET contenu = '$_POST[contenu]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['date_creation']) ){
                $nom = $soundbuzz->exec("UPDATE music SET date_creation = '$_POST[date_creation]' WHERE id_music='$id' ");
            }
            if(!empty($_POST['duree_morceau']) ){
                $prenom = $soundbuzz->exec("UPDATE music SET duree_morceau = '$_POST[duree_morceau]' WHERE id_music='$id' ");
            }
        }
    ?>

    <?php require_once('base/head.php') ?>
    <body>
        <?php require_once('base/navbar.php'); ?>
        <main>
            <?php
                //Execute la requete prepare
                $requete->execute(); 
                $musics = $requete->fetchAll(PDO::FETCH_ASSOC);
            ?>
        </main>

        <section class="top">
        <div class="dropdown">
            <a href="mymusic.php" class="dropdown"><button class="dropbtn2">Retour</button></a>
        </div>
        <a href="delete_music.php?id_music=<?php echo $id;?>" name="delete" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette musique ?')"><button class="dropbtn2">Supprimer</button></a>
        </section>
            <br><br>
        <section class="middle">
            <h1>Modification du morceau : <b><?php echo $id ?></b></h1>
            <br>
        </section>
        <br><br>
        <section class="corps">
            <h2>Actuellement :</h2><br>
            <table class= "dico">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Genre</th>
                        <th>Description</th>
                        <th>Artiste</th>
                        <th>Compositeur</th>
                        <th>Contenu</th>
                        <th>Date Création</th>
                        <th>Durée</th>
                    </tr>
                </thead>
                <?php foreach ($musics as $music): ?>
                        <div class="contrat">
                            <?php if(!empty($music["id_music"])): ?>
                                <tr>
                                    <td><?= $music["titre_morceau"] ?></td>
                                    <td><?= $music["genre"] ?></td>
                                    <td><?= $music["description_music"] ?></td>
                                    <td><?= $music["artiste"] ?></td>
                                    <td><?= $music["compositeur"] ?></td>
                                    <td><?= $music["contenu"] ?></td>
                                    <td><?= $music["date_creation"] ?></td>
                                    <td><?= $music["duree_morceau"] ?></td>
                                </tr>
                            <?php endif ?>
                        </div>
                <?php endforeach ?>
            </table>
            <br><br>
            <!-- Formulaire pour modifier un contrat -->
            <form class="form-style-7" method="post" action="">
                <ul>
                    <li>
                        <label for="name">Titre</label>
                        <input type="text" name="titre_morceau" maxlength="100" value="<?= $music["titre_morceau"] ?>">
                        <span>Modifier le titre</span>
                    </li>
                    <li>
                        <label for="name">Genre</label>
                        <input type="text" name="genre" maxlength="100" value="<?= $music["genre"] ?>">
                        <span>Modifier le genre</span>
                    </li>
                    <li>
                        <label for="name">Description</label>
                        <input type="text" name="description_music" maxlength="100" value="<?= $music["description_music"] ?>">
                        <span>Modifier la description</span>
                    </li>
                    <li>
                        <label for="name">Artiste</label>
                        <input type="text" name="artiste" maxlength="100" value="<?= $music["artiste"] ?>">
                        <span>Modifier le nom d'Artiste</span>
                    </li>
                    <li>
                        <label for="name">Compositeur</label>
                        <input type="text" name="compositeur" maxlength="100" value="<?= $music["compositeur"] ?>">
                        <span>Modifier le nom du Compositeur</span>
                    </li>
                    <li>
                        <label for="name">Contenu</label>
                        <input type="text" name="contenu" maxlength="100" value="<?= $music["contenu"] ?>">
                        <span>Modifier le contenu</span>
                    </li>
                    <li>
                        <label for="name">Date de Création</label>
                        <input type="date" name="date_creation" maxlength="100" value="<?= $music["date_creation"] ?>">
                        <span>Modifier la date de création</span>
                    </li>
                    <li>
                        <label for="name">Durée</label>
                        <input type="int" name="duree_morceau" maxlength="100" value="<?= $music["duree_morceau"] ?>">
                        <span>Modifier la durée du Morceau</span>
                    </li>
                    <li>
                        <input type="submit" name="enregistrer" value="Enregistrer" >
                    </li>
                </ul>
            </form>
        </section>

<?php
} elseif ($verifAdmin == NULL) { ?>
    <body class="noir">
        <div class="blanc">
            <a href="../accueil.php" class="img"><img src="favicon.ico" alt=""></a>
            <p class="p_erreur"> Vous n'avez pas accès à ce contenu, veuillez cliquer sur l'image afin d'être redirigé</p>
        </div>
    </body> 
<?php } ?>


<!-- Style du Formualire -->
<style type="text/css">
    .form-style-7{
        max-width:65vh;
        margin:5px auto;
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
        height: 16px;
        padding: 2px 5px 2px 5px;
        color: black;
        font-size: 14px;
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
        display: block;
        outline: none;
        border: none;
        height: 45px;
        line-height: 25px;
        font-size: 16px;
        padding: 0;
        font-family: Georgia, "Times New Roman", Times, serif;
    }
    .form-style-7 li > span{
        background:#55acee;
        display: block;
        padding: 3px;
        margin: 0 -9px -9px -9px;
        text-align: center;
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        margin-top: 3px;
    }
    .form-style-7 textarea{
        resize:none;
        height : 15vh;
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
<!-- Style Global-->
<style>
    .corps {
        margin-block-end: 3%;
    }

    .top h1 {
        margin: 0;
        text-align: center;
        color: black;
        font-size: 250%;
    }

    .top h2 {
        margin: 0;
        text-align: center;
        color: black;
        font-size: 180%;
    }

    .top b {
        color: #55acee;
    }

    .top a {
        text-decoration: none;
        color: black;
    }

    .middle h1 {
        margin: 0;
        text-align: center;
        color: black;
        font-size: 250%;
    }

    .middle h2 {
        margin: 0;
        text-align: center;
        color: black;
        font-size: 180%;
    }

    .middle b {
        color: #55acee;
    }

    .middle a {
        text-decoration: none;
        color: black;
    }

    .corps h2 {
        text-align: center;
    }

    .dico {
        border-collapse: collapse;
        width: 50%;
        margin:auto;
    }

    .dico td, .dico th {
        border: 1px solid black;
        padding: 8px;
    }

    .dico tr:nth-child(even){background-color: #f2f2f2;}

    .dico tr:hover {background-color: #ddd;}

    .dico th {  
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #55acee;
        color: white;
    }

    table {
    border:3px solid black;
    }

    thead, tfoot {
    background-color:#D0E3FA;
    background-image:url(sky.jpg);
    border:1px solid #6495ed;
    }

    tbody {
    background-color:#FFFFFF;
    border:1px solid #6495ed;
    }

    th {
    font-family:monospace;
    border:1px dotted #6495ed;
    background-color:#EFF6FF;
    padding: 15px;
    }

    td {
    font-family:sans-serif;
    font-size:70%;
    border:1px solid #6495ed;
    padding:5px;
    text-align:center;
    }

    td a {
        font-size: 150%;
    }

    textarea {
        border-color: black;
        border-width: 1px;
    }

    input {
        border-color: black;
        border-width: 1px;
    }
    .dropbtn2 {
        background-color: #55acee;
        color: white;
        padding: 13px;
        font-size: 15px;
        border: none;
        cursor: pointer;
        margin-bottom: 1vh;
        width : 17vh;
        float : right;
        margin : 10px;
        text-align: center;
    }

     .dropbtn2 a {
        color : white;
        text-decoration : none;
    }

    .part {
        display: inline-flex;
        justify-content: space-around;
        align-items: center;
        margin-left:1%;
        width: 100%;
    }


    .margin {
        margin-top: 3%; 
        margin-left: 3%; 
        margin-right: 5%;
    }

    .noir {
        background : black;
    }

    .blanc {
        background : white;
        border: 10px solid #55acee;
        margin-left: 25vh;
        margin-right: 25vh;
        margin-top : 10vh;
    }

    .img {
        text-align: center;
        display: block;
        margin-top: 5vh;
        margin-bottom: 6vh;
    }

    .p_erreur {
        text-align : center;
        font-size: 16px;

    }

    .forme {
        width: 55%;
        height: auto!important;
        margin: auto;
        border-style: ridge;
        border-color: black;
        border-radius: 10px;
    }

    .forme input, textarea {
        font-size: 80%;
    }

    .forme label {
        font-size: 110%;
    }

    #button {
        display: block;
        margin : auto;
        background-color: #55acee;
        color: white;
        padding: 8px;
        font-size: 13px;
        border: none;
        margin-block-end: 2%;
    }


    .dropbtn {
    background-color: #55acee;
    color: white;
    padding: 13px;
    font-size: 13px;
    border: none;
    cursor: pointer;
    width : 15vh;
    }

    .dropdown {
    position: relative;
    display: inline-block;
    margin-top: 0.5vh;
    margin-left: 5px;
    }
</style>

<style>
    @media (min-width: 768px) and (max-width: 991px) {
        .forme {
            width: 80%;
        }

        table,tbody,tr,td {
        font-size: 60%;

        }

        .forme input, textarea {
        font-size: 60%;
        }

        .forme label {
        font-size: 80%;
        }
    }


    @media (min-width: 992px) and (max-width: 1100px) {
        .forme {
            width: 68%;
        }
        table,tbody,tr,td {
        font-size: 60%;  
        }

    }


    @media (min-width: 1101px) and (max-width: 1299px) {

        .forme {
            width: 70%;
        }

    }
</style>
<?php require_once('base/footer.php'); ?>