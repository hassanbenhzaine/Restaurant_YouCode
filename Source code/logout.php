<?php

if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    setcookie("stay","1",time(),"/","localhost",0,1);
    header("location:index.php");
}

?>