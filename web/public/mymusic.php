<?php 
    require_once('base/init.php'); 
    if ( !enLigne() ){ 

        header('location: connexion.php');
        exit();
    }
    $verifAdmin = $_SESSION['user']['droit'];
    $email = $_SESSION['user']['email'];
    $id_user = $_SESSION['user']['id_user'];

    if($verifAdmin==1 || $verifAdmin== 3) {
        $requete = $soundbuzz->prepare(" SELECT * FROM music WHERE fk2_id_user='$id_user'");
        $requete->execute(); 
        $musics = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

    <?php require_once('base/head.php') ?>
    <body>
        <?php require_once('base/navbar.php'); ?>
        <main>
        </main>

        <section class="top">
            <div class="dropdown">
                <a href="accueil.php" class="dropdown"><button class="dropbtn2">Retour</button></a>
            </div>
            <div class="dropbtn2">
                <a href="add_music.php">Add Musique</a>
            </div>
        </section>
            <br><br>
            <section class="corps">
        <table class= "dico">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Artiste</th>
                    <th>Durée</th>
                    <th>Photo</th>
                    <th>Lecture</th>
                    <th>Edit</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <!-- Tableau d'affichage -->
            <?php $dossier='logo/'; ?>
            <?php foreach ($musics as $music): ?>
                <div class="datacenter">
                    <?php if(!empty($music["id_music"])): ?>
                        <tr>
                            <td><?= $music["titre_morceau"] ?></td>
                            <td><?= $music["artiste"] ?></td>
                            <td><?= $music["duree_morceau"] ?></td>
                            <td><?= $music['photo'] ?></td>
                            <td>
                                <audio controls="controls">
                                    <source src="musics/<?php echo($music["titre_morceau"]); ?>" type="audio/mp3"/>
                                </audio>
                            </td>
                            <?php if ($verifAdmin == 1 || $verifAdmin == 3){ ?>    
                                <td><a href="editMusic.php?id_music=<?php echo $music["id_music"];?>"><img src="img/edit.png" alt="" width="22px" height="auto"></a></td>
                            <?php } ?>
                            <?php if ($verifAdmin == 1 || $verifAdmin == 3){ ?>    
                                <td><a href="delete_music.php?id_music=<?php echo($music["id_music"]);?>" name="delete" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette musique ?')"><button class="dropbtn3">Supprimer</button></a></td>
                            <?php } ?>
                        </tr>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </table>
    </section>

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
.corps {
        margin-block-end: 3%;
    }
    .top {
        margin-bottom : 25px;
    }   
    .top h1 {
        margin: 0;
        text-align: center;
        color: black;
        font-size: 250%;
    }

    .dropbtn3 {
        font-size : 13px;
        color: white;
        background-color: red;
        width : 13vh;
        height : 5vh;
        border :none;
        cursor: pointer;
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

    input.input2 {
        color: black;
        padding: 13px;
        font-size: 13px;
        border: none;
        width: 10vh;
        margin-right : 15px;
        margin-top : 13px;
        background-color : white;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .formulaire {
        text-align : center;
        margin-bottom: 25px;
    }

    label {
        font-size: 22px;
    }

    button {
        font-size : 13px;
        color: white;
        background-color: #55acee;
        width : 13vh;
        height : 5vh;
        border :none;
        cursor: pointer;
    }

    .middle b {
        color: #55acee; 
    }

    .middle a {
        text-decoration: none;
        color: black;
    }

    .dico {
        border-collapse: collapse;
        width: 80%;
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

    th.thObs {
        padding : 5vh;
    }

    td {
        font-family:sans-serif;
        font-size:85%;
        border:1px solid #6495ed;
        padding:5px;
        text-align:center;
    }

    td a {
        font-size: 150%;
    }
    .dropbtn {
        background-color: #55acee; 
        color: white;
        padding: 13px;
        font-size: 13px;
        border: none;
        cursor: pointer;
        margin-bottom: 1vh;
        width : 15vh;
    }

    .dropbtn8 {
        background-color: red; 
        color: white;
        padding: 13px;
        font-size: 13px;
        border: none;
        cursor: pointer;
        margin-bottom: 1vh;
        width : 15vh;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        margin-top: 0.5vh;
        margin-left: 5px;
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
</style>
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