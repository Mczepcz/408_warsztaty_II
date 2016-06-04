<!DOCTYPE html>
<?php
session_start();
require_once 'src/connection.php';
require_once 'src/User.php';

if(isset($_SESSION['loggedUserId'])){
    header ("Location: index.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = strlen(trim($_POST['email']))? trim($_POST['email']):null;
    $password = strlen(trim($_POST['password']))? trim($_POST['password']):null;
    
    if($email && $password) {
        if($loggedUserId = User::login($conn, $email, $password)){
           $_SESSION['loggedUserId'] = $loggedUserId;
           header("Location: index.php");
       }
       else{
           echo"Inncorect login or password";
       }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="POST">
                <div class="form-group">
                    <fieldset>
                        <label>
                            E-mail
                            <input class="form-control" type="email" name="email" />

                        </label>
                        <br/>
                        <label>
                            Password
                            <input class="form-control" type="password" name="password" />

                        </label>
                        <br/>
                        <input class="btn btn-primary" type="submit" valu="Sign in"/>
                    </fieldset>
                    <h4><a href="register.php">New user? Sign up now!</a></h4>
                </div>
            </form>
        </div>
    </body>
</html>
