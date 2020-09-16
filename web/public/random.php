<?php require_once('base/init.php'); ?>
<?php require_once('base/head.php') ?>
<?php require_once('base/navbar.php'); ?>
<?php 
$prepare = $soundbuzz->prepare("SELECT * FROM music ORDER by rand() limit 1");
$prepare->execute();
$random_song = $prepare->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
    <section class="middle">
        <img src="img/juke.png" alt="Avatar" style="width:15%">
    </section>
    <section class="corps">
                <h2>Actuellement :</h2><br>
                <table class= "dico">
                    <thead>
                    <tr>
                    <th scope="col">
                        Titre
                    </th>
                    <th scope="col">
                        Artiste
                    </th>
                    <th scope="col">
                        Genre
                    </th>
                    <th scope="col">
                        Date de sortie
                    </th>
                    <th scope="col">
                    Durée du morceau
                    </th>
                    <th scope="col">
                        Ajouter à une playlist
                    </th>

                </tr>
                    </thead>
                    <?php foreach ($random_song as $random): ?>
                            <div class="contrat">
                                <?php if(!empty($random["id_music"])): ?>
                                <tr>
                                    <td class="text_center"><?php echo $random["titre_morceau"]; ?></td>
                                    <td class="text_center"><?php echo $random["artiste"]; ?></td>
                                    <td class="text_center"><?php echo $random["genre"]; ?></td>
                                    <td class="text_center"><?php echo $random["date_creation"]; ?></td>
                                    <td class="text_center"><?php echo $random['duree_morceau']; ?></td>
                                </tr>
                                <?php endif ?>
                            </div>
                    <?php endforeach ?>
                </table>
    <audio controls="controls">
        <source src="musics/11-XS.mp3" type="audio/mp3" />
        Votre navigateur n'est pas compatible
    </audio><br><br>
    <div class ="buttonnunique">
        <a href="refresh.php">NEXT</a>
    </div>
</body>

<!-- Style Global-->
<style>
.buttonnunique {
    background-color: #55acee; 
    border: none;
    color: black;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 19px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    width: 105px;
    height: 22px;
    margin-top: auto;
    margin: auto;
    display: block;
    }

    .buttonnunique {
    background-color: black; 
    color: black; 
    border: 2px solid #0b8fed;
    }


    .buttonnunique:hover {
    background-color: #55acee;
    color: white;
    }

    .buttonnunique a {
        text-decoration : none;
        color : white;
    }
    audio {
        display: block;
        margin: auto;
        margin-top: 10vh;
    }
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
        margin : 10px;
        display: block;
        margin: auto;
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

    img {
        width: 20%;
        margin: auto;
        display: block;
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