<?php

    session_start();

    if (isset($_COOKIE['stay']) && $_SESSION["roleName"] == "Administrator") {
        include_once "config.php";

        $categoriesSQL = "SELECT categoryID, categoryName FROM categories";
        $categoriesQuery = mysqli_query($database,$categoriesSQL);

        if(isset($_POST["add"])){

            $productName = mysqli_real_escape_string($database, $_POST['productName']);
            $productPrice = mysqli_real_escape_string($database, $_POST['productPrice']);
            $productDescription = mysqli_real_escape_string($database, $_POST['productDescription']);
            $productCategoryID = mysqli_real_escape_string($database, $_POST['productCategoryID']);
            $productQty = mysqli_real_escape_string($database, $_POST['productQty']);
            $productRating = mysqli_real_escape_string($database, $_POST['productRating']);

            // Get last product ID in table for product image nomination
            $lastproductSQL = "SELECT MAX(productID) FROM products";
            $lastproduct = mysqli_query($database,$lastproductSQL);
            $lastproductResult = mysqli_fetch_assoc($lastproduct);
            $fileName =  ++$lastproductResult['MAX(productID)'] .'_'. $_FILES['productImage']['name'];
            $fileTmpName  = $_FILES['productImage']['tmp_name'];
            $uploadPath = getcwd() . "\images\products\\" .  $fileName; 
            move_uploaded_file($fileTmpName, $uploadPath);

            if(empty($_FILES['productImage']['name'])){
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
            
            $updateSQL = "INSERT INTO products(productName,productPrice,productImage,productDescription,productCategoryID,productQty) 
            VALUES('$productName','$productPrice','$fileName','$productDescription','$productCategoryID','$productQty');";
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
    <?php include_once "menu.php" ?>
    <?php include_once "nav_dashboard.php" ?>
        <div class="realcontent">
            <form id="myform" class="form" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="productName" class="input" placeholder="Titre">
                <textarea form="myform" name="productDescription" placeholder="Description"></textarea>
                <input type="text" name="productPrice" class="input" placeholder="Prix d'unité">
                <input type="text" name="productQty" class="input" placeholder="Quanité">
                <select name="productCategoryID" class="input">
                    <?php while($categoriesResult = mysqli_fetch_assoc($categoriesQuery)){ ?>
                        <option value="<?php echo htmlspecialchars($categoriesResult["categoryID"]) ?>">
                            <?php echo htmlspecialchars($categoriesResult["categoryName"])  ?>
                        </option>
                    <?php } 
                        mysqli_free_result($categoriesQuery);
                        mysqli_close($database);
                    ?>
                    <option disabled selected>Choisissez une catégorie</option>
                </select>
                <input type="file" name="productImage" class="file" accept=".jpeg,.jpg,.png">
                <button type="submit" name="add" class="input submit" value="1">Ajouter</button>
            </form>
        </div>
</body>
</html>