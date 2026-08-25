<?php
    $username="admin";

    $password="password";

    $error="";

    if(isset($_COOKIE["username"])){
        session_start();
        $_SESSION["isLoggedIn"]=true;
        $_SESSION["username"]=$_COOKIE["username"];
        header('location:dashboard.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $submitted_username=$_POST['username'];
        $submitted_password=$_POST['password'];

        if($submitted_username===$username && $submitted_password===$password){
            $_SESSION['isLoggedIn']=true;
            $_SESSION['username']=$submitted_username;

            header('Location:dashboard.php');
        }else{
            $error="Username and password doesn't match";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
</head>
<body>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="username">
        </div>
        <br><br/>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="password">
        </div>


        <div class="error">
            <?php if($error!=""){
                echo $error;
            }?>
        </div>

        <div class="form-group">
            <label for="remember-me">Remember Me</label>
            <input type="checkbox" id="remember-me" name="remember-me">
        </div>

        <div class="form-group">
        <input type="submit" name="login" value="login">
        </div>
    </form>
</body>
</html>
