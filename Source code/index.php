<?php

include_once "logout.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youcode Food</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="overlay">
        <div class="window" id="login">
            <img class="closeForm" alt="" src="images/cross-sign.svg">
            <form class="form form2" action="login.php" method="POST">
                <input type="email" name="email" class="input" placeholder="Email">
                <input type="password" name="password" class="input" placeholder="Mot de passe">
                <label id="staylogged">
                    <input type="checkbox" name="staylogged" class="staylogged">
                    Rester connecté
                </label>
                <button type="submit" name="submit" class="input submit">
                    Se connecter
                </button>
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
                <button type="submit" name="submit" class="input submit">S'inscrire</button> 
            </form>
            <p>Vous avez déjà un compte? <a id="loginlink">Se connecter</a></p>
        </div>
    </div>
    <header>
        <nav>
            <div class="navleft">
                <img src="images/youcode_logo.png" alt="logo">
                <span class="line"></span>
                <span class="description">SYSTÈME DE GESTION DES RESTAURANTS</span>
            </div>
            <div class="navright">
                <ul>
                    <li><a href="index.php">Accueil</a></li>              
                    <li class="link1"><a  href="categories.html">Catégories</a></li>
                    <li class="link2"><a href="contact.html">Contact</a></li>
                </ul>
               <?php if (isset($_COOKIE['stay']) && $_COOKIE['stay'] == "1") { ?>
                <a href="admin.php" class="button">
                        Dashboard
               </a>
                <form id="disconnectbutton" class="logout" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <button class="button" type="submit" name="logout" value="logout">
                    Se deconnecter
                </button>
                </form>
                <?php } else { ?>
                    <button class="button" id="loginbutton">
                        Se connecter
                    </button>
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
    <footer>
        © Copyright YouCode Food 2021, Tous droits réservés.
    </footer>
    <script src="js/app.js"></script>
</body>
</html>