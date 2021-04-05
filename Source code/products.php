<?php

if(isset($_GET['offset'])){
    session_start();

    include_once "config.php";
    $offset = mysqli_real_escape_string($database, $_GET['offset']);
    $showproductsSQL = "SELECT x.productRating, x.productID, x.productName, x.productDescription, x.productImage, x.productPrice, x.productAddedAt, x.productQty, y.categoryName FROM products x INNER JOIN categories y ON x.productCategoryID = y.categoryID LIMIT 3 OFFSET {$offset}";
    $showproducts = mysqli_query($database, $showproductsSQL);

    if(mysqli_num_rows($showproducts) > 0){
        while($showproductsResult = mysqli_fetch_assoc($showproducts)){
            if(basename($_SERVER['HTTP_REFERER']) == "admin.php" && $_SESSION["roleName"] == "Administrator"){
                echo '<div class="item">
                    <img src="images/products/' .htmlspecialchars($showproductsResult["productImage"]). '" alt="">
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
            } else{
                echo '<div class="item">
                <div class="content">
                    <img src="images/products/' .htmlspecialchars($showproductsResult["productImage"]). '" alt="">
                    <div class="description">
                        <div class="up">
                            <div class="left">
                                <h1>' . htmlspecialchars($showproductsResult["productName"]) . '</h1>
                                <div class="details">
                                    <img src="images/star.svg" alt="">
                                    <div class="category">' .htmlspecialchars($showproductsResult["productRating"]). ' • ' .htmlspecialchars($showproductsResult["categoryName"]). '</div>
                                </div>
                            </div>
                            <div class="right">' .htmlspecialchars($showproductsResult["productPrice"]). ' DH</div>
                        </div>
                        <button class="addtocart">Ajouter au panier</button>
                    </div>
                </div>
                </div>'; 
            }
        }
    }
    mysqli_free_result($showproducts);
    mysqli_close($database);

} else{
    header("location:index.php");
}

?>