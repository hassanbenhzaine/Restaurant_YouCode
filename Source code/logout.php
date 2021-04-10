<?php

if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    setcookie("stay","1",time());
    header("location:index.php");
} else{
    header("location:index.php");
}

?>