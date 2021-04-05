<?php

if(isset($_POST["email"]) && isset($_POST["pass"])){

    include_once "config.php";

    $email = mysqli_real_escape_string($database, $_POST["email"]);
    $pass = mysqli_real_escape_string($database, $_POST["pass"]);

    $checkroleSQL = "SELECT x.email, x.firstName, x.lastName, x.pass, x.avatar, y.roleName FROM users x INNER JOIN roles y ON x.id = y.userID WHERE email='$email'";
    $loginquery = mysqli_query($database, $checkroleSQL);

    if(mysqli_num_rows($loginquery) > 0){
        $loginresult = mysqli_fetch_assoc($loginquery);
        $passhashed = password_verify($pass,$loginresult['pass']);
    
        if($passhashed == true){
            session_start();
            $_SESSION["email"] = $loginresult["email"];
            $_SESSION["firstName"] = $loginresult["firstName"];
            $_SESSION["lastName"] = $loginresult["lastName"];
            $_SESSION["roleName"] = $loginresult["roleName"];
            $_SESSION["avatar"] = $loginresult["avatar"];
    
            if(isset($_POST["staylogged"]) && $_POST["staylogged"] == "true"){
                setcookie("stay","1",time()+3600*24*365,"/","localhost",0,1);
            } else{
                setcookie("stay","1",time()+20,"/","localhost",0,1);
            }

        } else{
            echo "Email ou mot de passe incorrect";
        }
    }

    mysqli_free_result($loginquery);
    mysqli_close($database);

} else{
    header("location:index.php");
}

?>