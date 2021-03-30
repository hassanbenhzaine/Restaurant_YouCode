<?php

session_start();

if (isset($_COOKIE['stay']) && $_COOKIE['stay'] == "1" && $_SESSION["roleName"] == "Administrator") {

    include_once "logout.php";
    include_once "config.php";

    $categoriesSQL = "SELECT categoryID, categoryName FROM categories";
    $categoriesQuery = mysqli_query($database,$categoriesSQL);

    if(isset($_POST["submit"])){

        $productName = htmlspecialchars($_POST['productName']);
        $productPrice = htmlspecialchars($_POST['productPrice']);
        $productDescription = htmlspecialchars($_POST['productDescription']);
        $productCategoryID = htmlspecialchars($_POST['productCategoryID']);
        $productQty = htmlspecialchars($_POST['productQty']);
        $productRating = htmlspecialchars($_POST['productRating']);

        $lastproductSQL = "SELECT MAX(productID) FROM products";
        $lastproduct = mysqli_query($database,$lastproductSQL);
        $lastproductResult = mysqli_fetch_assoc($lastproduct);
        $fileName =  ++$lastproductResult['MAX(productID)'] . "_" . $_FILES['productImage']['name'];
        $fileTmpName  = $_FILES['productImage']['tmp_name'];
        $uploadPath = getcwd() . "\images\products\\" .  $fileName; 
        move_uploaded_file($fileTmpName, $uploadPath);

        if($_FILES['productImage']['size'] == 0){
            $fileName = "default.jpg";
        }

        if(empty($productName)){
            $productName = "Pas de titre";
        }
        if(empty($productDescription)){
            $productDescription = "Pas de description";
        }
        if(empty($productPrice)){
            $productPrice = 0;
        }
        if(empty($productCategoryID)){
            $productCategoryID = 1;  
        }
        if(empty($productQty)){
            $productQty = 0;
        }
        if(empty($productRating)){
            $productRating = 0;
        }
        
        $updateSQL = "INSERT INTO products(productName,productPrice,productImage,productDescription,productCategoryID,productQty,productRating) VALUES('{$productName}','{$productPrice}','images/products/{$fileName}','{$productDescription}','{$productCategoryID}','{$productQty}',4.5);";

        $update = mysqli_query($database, $updateSQL);

        if($update){
            header("Location:admin.php");
        } else{
            echo "error";
        }
        
    }
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
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <div class="menu">
        <div class="menucontainer">
            <a class="menuitem opa" href="admin.php">
                <img src="images/manage_products.svg" alt="">
                <p>Produits</p>
            </a> 
            <a class="menuitem" href="admin.php">
                <img src="images/customer.svg" alt="">
                <p>Clients</p>
            </a>
            <a class="menuitem opa" href="admin.php">
                <img src="images/order.svg" alt="">
                <p>Commandes</p>
            </a>
        </div>
    </div>
    <nav>
        <div class="navleft">
            <img src="images/youcode_logo.png" alt="logo">
            <span class="line"></span>
            <span class="description">SYSTÈME DE GESTION DES RESTAURANTS</span>
        </div>
        <div class="navright">
            <ul>
                <li><a href="index.php">Accueil</a></li>              
                <li class="link1"><a  href="/">Catégories</a></li>
                <li class="link2"><a href="/">Contact</a></li>
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
        <div class="realcontent">
            <form id="myform" class="form" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="productName" class="input" placeholder="Titre">
                <textarea form="myform" name="productDescription" placeholder="Description"></textarea>
                <input type="text" name="productPrice" class="input third" placeholder="Prix d'unité">
                <input type="text" name="productQty" class="input third" placeholder="Quanité">
                <input type="text" name="productRating" class="input third" placeholder="évaluation">

                <select name="productCategoryID" class="input">
                    <?php while($categoriesResult = mysqli_fetch_assoc($categoriesQuery)){ ?>
                        <option value="<?php echo htmlspecialchars($categoriesResult["categoryID"]) ?>">
                            <?php echo htmlspecialchars($categoriesResult["categoryName"])  ?>
                        </option>
                    <?php } 
                        mysqli_free_result($categoriesQuery);
                    ?>
                    <option disabled selected>Choisissez une catégorie</option>
                </select>
                <input type="file" name="productImage" class="file" accept=".jpeg,.jpg,.png">
                <button type="submit" name="submit" class="input submit" value="submit">
                    Ajouter
                </button>
            </form>
        </div>

    </div>
</body>
</html>
<?php 
    mysqli_close($database);
?>