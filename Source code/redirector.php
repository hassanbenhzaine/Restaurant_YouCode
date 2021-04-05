<?php

session_start();

if($_SESSION["roleName"] == "Administrator"){
    header("location:admin.php");
} elseif($_SESSION["roleName"] == "Client"){
    header("location:client.php");
} else{
    header("location:index.php");
}

?>