<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youcode Food</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="overlay">
        <div class="window" id="login">
            <img class="closeForm" alt="" src="images/cross-sign.svg">
            <form class="form form2">
                <input type="email" id="email" class="input" placeholder="Email">
                <input type="password" id="pass" class="input" placeholder="Mot de passe">
                <div class="loginextra">
                    <label id="staylogged">
                        <input type="checkbox" id="staylogged1" name="staylogged" class="staylogged">
                        Rester connecté
                    </label>
                    <p id="error"></p>
                </div>
                <button type="button" id="submit" class="input submit">Se connecter</button>
            </form>
            <p>Vous n'avez pas encore de compte? <a id="signuplink">S'inscrire</a></p>
        </div>
        <div class="window" id="signup">
            <img class="closeForm" alt="" src="images/cross-sign.svg">
            <form class="form" action="signup.php" method="POST">
                <input type="text" name="firstname" class="input half" placeholder="Prénom">
                <input type="text" name="lastname" class="input half" placeholder="Nom">
                <input type="email" name="email" class="input" placeholder="Email">
                <input type="phone" name="phone" class="input" placeholder="Numéro de téléphone">
                <input type="password" name="password" class="input half" placeholder="Mot de passe">
                <input type="password" name="password" class="input half" placeholder="Répéter le mot de passe">
                <button type="submit" name="signup" class="input submit">S'inscrire</button> 
            </form>
            <p>Vous avez déjà un compte? <a id="loginlink">Se connecter</a></p>
        </div>
    </div>
    <header>
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
                <?php if (isset($_COOKIE['stay']) && $_COOKIE['stay'] == "1") { ?>
                    <a href="admin.php" class="button">Dashboard</a>
                    <form id="disconnectbutton" class="logout" method="post" action="logout.php">
                        <button class="button" type="submit" name="logout" value="logout">Se deconnecter</button>
                    </form>
                <?php } else { ?>
                    <button class="button" id="loginbutton">Se connecter</button>
                <?php } ?>
        </div>
        </nav>
        <h1>Votre repas avec un seul clic</h1>
    </header>
    <img id="downarrow" src="images/down-arrow.svg" alt="">
    <section>
        <div id="realcontent"></div>
        <button id="showmore">Voir plus de produits</button>
    </section>
    <footer>© Copyright YouCode Food 2021, Tous droits réservés.</footer>
    <script src="js/animation.js"></script>
    <script src="js/products.js"></script>
    <script src="js/login.js"></script>
</body>
</html>