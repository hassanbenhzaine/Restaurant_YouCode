<?php

include_once "config.php";

if(isset($_GET['offset'])){
            
    $showproductsSQL = "SELECT x.productName, x.productPrice, x.productImage, y.categoryName, x.productRating 
    FROM products x INNER JOIN categories y ON x.productCategoryID = y.categoryID LIMIT 3 OFFSET {$_GET['offset']}";

    $showproductsQuery = mysqli_query($database, $showproductsSQL);
    
    if(mysqli_num_rows($showproductsQuery) > 0){
        while($showproductsResults = mysqli_fetch_assoc($showproductsQuery)){
            echo '<div class="item">
            <div class="content">
                <img src="' .htmlspecialchars($showproductsResults["productImage"]). '" alt="">
                <div class="description">
                    <div class="up">
                        <div class="left">
                            <h1>' . htmlspecialchars($showproductsResults["productName"]) . '</h1>
                            <div class="details">
                                <img src="images/star.svg" alt="">
                                <div class="category">' .htmlspecialchars($showproductsResults["productRating"]). ' • ' .htmlspecialchars($showproductsResults["categoryName"]). '</div>
                            </div>
                        </div>
                        <div class="right">' .htmlspecialchars($showproductsResults["productPrice"]). ' DH</div>
                    </div>
                    <button class="addtocart">Ajouter au panier</button>
                </div>
            </div>
        </div>';
        }
    }
    mysqli_free_result($showproductsQuery);
}

session_start();
if (isset($_COOKIE['stay']) && $_COOKIE['stay'] == "1") {
if(isset($_GET['offsetadmin']) && $_SESSION["roleName"] == "Administrator"){

    $showproductsSQL = "SELECT x.productID, x.productName, x.productDescription, x.productImage, x.productPrice, x.productAddedAt, x.productQty, y.categoryName FROM products x INNER JOIN categories y ON x.productCategoryID = y.categoryID LIMIT 3 OFFSET {$_GET['offsetadmin']}";
        $showproducts = mysqli_query($database, $showproductsSQL);

        if(mysqli_num_rows($showproducts) > 0){
            while($showproductsResult = mysqli_fetch_assoc($showproducts)){
                echo '<div class="item">
                    <img src="' .htmlspecialchars($showproductsResult["productImage"]). '" alt="">
                    <div class="itemcontent">
                        <div class="details1">
                        <div class="title">
                            ' .htmlspecialchars($showproductsResult["productName"]). '
                        </div>
                        <div class="description">
                            ' .htmlspecialchars($showproductsResult["productDescription"]). '
                        </div>
                        </div>
                        <div class="details2">
                            <div class="detailsleft">
                                <div class="detail">
                                    <img src="images/price-tag.svg" alt="">
                                    <p>' .htmlspecialchars($showproductsResult["productPrice"]).' DH'. '</p>
                                </div>
                                <div class="detail push">
                                    <img src="images/calendar.svg" alt="">
                                    <p>' .htmlspecialchars($showproductsResult["productAddedAt"]). '</p>
                                </div>
                                <div class="detail push">
                                    <img src="images/quantity.svg" alt="">
                                    <p>' .htmlspecialchars($showproductsResult["productQty"]). '</p>
                                </div>
                                <div class="detail push">
                                    <img src="images/category.svg" alt="">
                                    <p>' .htmlspecialchars($showproductsResult["categoryName"]). '</p>
                                </div>
                            </div>
                            <div class="detailsright">
                                <form method="post" action="update.php">
                                    <button type="submit" name="modify" value="' .htmlspecialchars($showproductsResult["productID"]). '">
                                        <img src="images/pencil.svg" alt="">
                                    </button>
                                </form>
                                <form method="post" action="update.php">
                                    <button type="submit" name="delete" value="' .htmlspecialchars($showproductsResult["productID"]). '">
                                        <img class="pushe" src="images/delete.svg" alt="">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
                }
        }

}
}

mysqli_close($database);

?>