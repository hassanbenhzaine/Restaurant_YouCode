<?php
    session_start();

    if(isset($_COOKIE['stay']) && $_SESSION["roleName"] == "Administrator") {
        
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
    <?php include_once "nav_dashboard.php" ?>
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
    <script src="js/products.js"></script>
</body>
</html>
