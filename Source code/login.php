<?php

if(isset($_POST["submit"], $_POST["email"], $_POST["password"])){

    include_once "config.php";

    $email = mysqli_real_escape_string($database, $_POST["email"]);
    $pass = $_POST["password"];

    $checkroleSQL = "SELECT x.email, x.firstName, x.lastName, x.pass, x.avatar, y.roleName FROM users x INNER JOIN roles y ON x.id = y.userID WHERE email='$email'";
    $loginquery = mysqli_query($database, $checkroleSQL);
    $loginresult = mysqli_fetch_assoc($loginquery);

    $passhashed = password_verify($pass,$loginresult['pass']);

    if($passhashed == true){
        session_start();
        $_SESSION["email"] = $loginresult["email"];
        $_SESSION["firstName"] = $loginresult["firstName"];
        $_SESSION["lastName"] = $loginresult["lastName"];
        $_SESSION["roleName"] = $loginresult["roleName"];
        $_SESSION["avatar"] = $loginresult["avatar"];

        if(isset($_POST["staylogged"]) && $_POST["staylogged"] == true){
            setcookie("stay","1",time()+3600*24*365,"/","localhost",0,1);
        } else{
            setcookie("stay","1",time()+300,"/","localhost",0,1);
        }

        if($loginresult["roleName"] == "Administrator"){
            header("location:admin.php");
        } elseif($loginresult["roleName"] == "Client"){
            header("location:client.php");
        }

    } else{
        echo "<script>
                alert('Email ou mot de passe incorrect');
                window.location='index.php';
              </script>";
    }

    mysqli_free_result($loginquery);

    mysqli_close($database);

} else{
    header("Location:index.php");
}

?>