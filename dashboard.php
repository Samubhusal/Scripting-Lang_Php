<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
    session_start();
    if(isset($_POST['remember-me'])){
        setcookie("username",$username,time()+(86400)*30,"/");
    }
    if(isset($_SESSION['isLoggedIn'])&& $_SESSION['isLoggedIn']==true){
        echo'<h1>Welcome to dashboard'.$_SESSION['username'].'</h1>';
    ?>
    <button><a href="logout.php">Logout</a></button>
    <?php    
    }else{
        header('Location:login.php');
    }
    ?>
</body>
</html>