<?php 
    require_once('base/init.php');
    if ( !enLigne() ){ 

        header('location:connexion.php');
        exit();
    }
    $verifAdmin = $_SESSION['user']['droit'];
    if ($verifAdmin == 3) {
        
        $id_utilisateur = $_SESSION['user']['id_user'];
        $requete = $soundbuzz->prepare(" SELECT * FROM user"); 
?>
<?php require_once('base/head.php') ?>
<body>
    <?php require_once('base/navbar.php'); ?>
    <main>
        <?php
            $requete->execute(); 
            $users = $requete->fetchAll(PDO::FETCH_ASSOC);
        ?>
    </main>
    <section class="top">
        <div class="dropdown">
            <a href="accueil.php" class="dropdown"><button class="dropbtn">Accueil</button></a><br><br>
        </div>
        </section>
        <br><br>
        <form method="GET" class="formulaire">
            <label for="fournisseur">Email :
                <input class="input2" type="recherche" name="recherche" autocomplete="on">
            </label>
            <button>Afficher</button>
        </form>
        <!-- Fonction de recherche selon la valeur du Input -->
        <?php if(isset($_GET['recherche'])){
                $ifNotId = $soundbuzz->prepare(" SELECT * FROM user WHERE email LIKE '".$_GET['recherche']."%' "); 
                $ifNotId->execute();
                $users = $ifNotId->fetchAll(PDO::FETCH_ASSOC); 
            }
        ?>
            <?php if(empty($ifNotId) && isset($_GET["recherche"]) ){ ?>
                <h2 class="no_search">Aucun Fournisseur ne correspond à votre recherche</h2>
            <?php } ?>
        <section class="middle">
            <div>
                <h1>Liste des utilisateurs :</h1>
                <br><br>
            </div>
        </div>
    </section><br><br>

    <section class="corps">
        <table class= "dico">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Adresse Mail</th>
                    <th>Droit</th>
                    <th>Edit</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <!-- Tableau d'affichage -->
            <?php foreach ($users as $user): ?>
                <div class="datacenter">
                    <?php if(!empty($user["id_user"])): ?>
                        <?php $id_utilisateur = $user["id_user"] ?>
                        <tr>
                            <td><?= $user["id_user"] ?></td>
                            <td><?= $user["nom"] ?></td>
                            <td><?= $user["prenom"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["droit"] ?></td>
                            <?php if ($verifAdmin == 3){ ?>    
                                <td><a href="editUser.php?id_utilisateur=<?php echo $id_utilisateur;?>&admin=<?php echo $user["droit"];?>&email=<?php echo $user["email"];?>"><img src="img/edit.png" alt="" width="22px" height="auto"></a></td>
                            <?php } ?>
                            <?php if ($verifAdmin == 3){ ?>    
                                <td><a href="delete_user.php?id_user=<?php echo $id_user;?>" name="delete" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce User ?')"><button class="dropbtn3">Supprimer</button></a></td>
                            <?php } ?>
                        </tr>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </table>
    </section>
</body>

<?php

} elseif ($verifAdmin == 1 || $verifAdmin==NULL) { ?>
    <body class="noir">
        <div class="blanc">
            <a href="accueil.php" class="img"><img src="favicon.ico" alt=""></a>
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
    .dropbtn3 {
        font-size : 13px;
        color: white;
        background-color: red;
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
</style>
<?php require_once('base/footer.php');  ?>