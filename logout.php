<?php
    session_start();
    session_destroy();

    if(isset($_SESSION["isLoggedIn"])&&$_SESSION["username"]){
        unset($_SESSION["isLoggedIn"]);
        unset($_SESSION["username"]);
    }

    if(isset($_COOKIE['username'])){
        setcookie("username","",time()-3600,"/");
    }

    header('location:login.php');

    session_abort();
?>