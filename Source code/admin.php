<?php

session_start();

if (isset($_COOKIE['stay']) && $_COOKIE['stay'] == "1") {

    if(!$_SESSION["roleName"] == "Administrator"){
        header("location:index.php");
    }

    include_once "logout.php";

} else{
    header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include_once "menu.php" ?>
    <nav>
        <div class="navleft">
            <img src="images/youcode_logo.png" alt="logo">
            <span class="line"></span>
            <span class="description">SYSTÈME DE GESTION DES RESTAURANTS</span>
        </div>
        <div class="navright">
            <ul>
                <li><a href="index.php">Accueil</a></li>              
                <li><a  href="/">Catégories</a></li>
                <li><a href="/">Contact</a></li>
            </ul>
            <div id="user">
                <img class="avatar" src="<?php echo $_SESSION["avatar"] ?>" alt="">
                <p><?php echo "{$_SESSION["firstName"]} {$_SESSION["lastName"]}" ?></p>
                <form class="logout" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" name="logout" value="logout">
                         Se deconnecter
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="realcontents">
            <form method="post" action="add.php">
            <button class="add" name="todo" value="add">
                <img src="images/plus.svg" alt="">
                <p>Ajouter</p>
            </button>
            </form>
            <div id="realcontent"></div>
            <div id="showmore">Affichier plus de produits</div>
        </div>
    </div>
    <script src="js/admin.js"></script>
</body>
</html>

<?php

// mysqli_free_result($showproducts);

// mysqli_close($database);

?>


