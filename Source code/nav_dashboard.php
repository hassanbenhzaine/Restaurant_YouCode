<nav>
    <div class="navleft">
        <img src="images/youcode_logo.png" alt="logo">
        <span class="line"></span>
        <span class="description">SYSTÈME DE GESTION<br>DES RESTAURANTS</span>
    </div>
    <div class="navmiddle">
        <ul>
            <li><a href="index.php">Accueil</a></li>              
            <li><a href="index.php">Catégories</a></li>
            <li><a href="index.php">Contact</a></li>
        </ul>
    </div>
    <div class="navright">
        <div class="user">
            <img class="avatar" src="images/avatars/<?php echo $_SESSION["avatar"] ?>" alt="">
            <p><?php echo "{$_SESSION["firstName"]} {$_SESSION["lastName"]}" ?></p>
            <form class="logout" method="post" action="logout.php">
                <button class="button" type="submit" name="logout" value="logout">Se deconnecter</button>
            </form>
        </div>
    </div>
</nav>