<?php require_once('base/init.php'); ?>
<?php 
    if ( !enLigne() ){ 

        //header('location:connexion.php');
        //exit();
    }
    $admin = $_SESSION['utilisateur']['droit'];

?>
<?php require_once('base/head.php') ?>
<?php require_once('base/navbar.php'); ?>
<body>
    <section class="corps">
            <div class="lien">
                <div class="card">
                    <a href="random.php"><img src="img/juke.png" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                        <h4 class="soustitre"><b>Ecoutez des musiques aléatoires</b></h4> 
                    </div>
                </div>
                </div>
                <div class="lien">
                    <div class="card">
                        <a href="add_music.php"><img src="img/votremusiquebmanc.png" alt="Avatar" style="width:100%"></a>
                        <div class="container">
                            <h4 class="soustitre"><b>Ecoutez vos musiques</b></h4> 
                        </div>
                    </div>
                </div>
                <div class="lien">
                <div class="card">
                    <a href="new_music.php"><img src="img/newartist.png" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                        <h4 class="soustitre"><b>Ecoutez de nouvelles musiques</b></h4>  
                    </div>
                </div>
            </div>
       
    </section>
</body>
<style>
.corps {
    display: grid;
    grid-template-columns: repeat(3,25%);
    grid-gap: 10px;
    margin-block-end: 3%;
}

.soustitre {
    text-align: center;
    text-transform: uppercase;
    color: black; 
    padding-bottom: 10vh;
}

.lien a {
    text-decoration: none;
    text-align: center;
    min-height: 10em;
    display: table-cell;
    vertical-align: middle;
    margin-left : 10vh;
}

.card {
  box-shadow: 0 4px 8px 0 #55acee; 
  transition: 0.3s;
  width: 100%;
  margin-bottom: 40px;
  margin-left: 25vh;
  margin-top: 3vh;
}

.card:hover {
  box-shadow: 0 8px 30px 0 #55acee; 
}

.container {
  padding: 2px 16px;
}


.top a {
    position: relative;
    text-decoration : none;
    color : white;
    font-size : 15px;
}

.top a img {
    float :left;
    color : white;
    font-size : 15px;
    width : 13vh;
}


.dropdown {
position: relative;
display: inline-block;
float: right;
margin-right: 10px;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f1f1f1;
min-width: 100px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: rgb(255,100,0);
}

.dropDown {
position: relative;
display: inline-block;
float: left;
margin-top: 0.5vh;
margin-left: 5px;
}
</style>
<?php require_once('base/footer.php');  ?>