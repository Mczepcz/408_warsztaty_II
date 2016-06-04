<!DOCTYPE html>
<?php
require_once 'src/User.php';
require_once 'src/connection.php';
session_start();

if(isset($_SESSION['loggedUserId'])){
    header ("Location: index.php");
}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $email = strlen(trim($_POST['email'])) > 0 ? trim($_POST['email']) : null;
    $password = strlen(trim($_POST['password'])) > 0 ? trim($_POST['password']) : null;
    $retypedPassword = strlen(trim($_POST['retypedPassword'])) > 0 ? trim($_POST['retypedPassword']) : null;
    $fullName = strlen(trim($_POST['fullName'])) > 0 ? trim($_POST['fullName']) : null;
    
    $user = User::getUserByEmail($conn, $email);
    
    if ($email && $password && $retypedPassword && $fullName && $password==$retypedPassword && !$user['active']){
        
        
        $newUser = new User();
        if($user['active']== 0){
            $newUser->loadFromDB($conn, $user['id']);
        }
        $newUser->setEmail($email);
        $newUser->setPassword($password, $retypedPassword);
        $newUser->setFullName($fullName);
        $newUser->activate();
        if($newUser->saveToDB($conn)){
            echo "<p class = 'bg-success'>Registration succesful! Please log in</p><br/>";
            echo "<a class='btn btn-success' href='login.php'>Login</a>";   
        }
        else{
            echo"Error durning registration <br/>";
        }
    }
    else{
        if(!$email){
            echo "<p class='bg-danger'>Incorrect e-mail</p> <br/>";
        }
        if(!$password){
            echo "<p class='bg-danger'>Incorrect password</p> <br/>";
        }
        if(!$retypedPassword || $password != $retypedPassword){
            echo "<p class='bg-danger'>Incorrect retyped password</p> <br/>";
        }
        if(!$fullName){
            echo "<p class='bg-danger'>Incorrect Full Name<p class='bg-danger'</p> <br/>";
        }
        if($user && $user['active']){
            echo "<p class='bg-danger'>This mail is already registered</p>";
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
                <fieldset class="form-group" >
                    <label>
                        Email:
                        <input class="form-control" type='email' name='email'/>
                    </label>
                    <br/>
                    <label>
                        Password:
                        <input class="form-control"  type='password' name='password'/>
                    </label>
                    <br/>
                    <label>
                        Retype password:
                        <input class="form-control"  type='password' name='retypedPassword'/>
                    </label>
                    <br/>
                    <label>
                        Full Name:
                        <input class="form-control"  type='text' name='fullName'/>
                    </label>
                    <br/>
                    <input class="btn btn-success" type="submit" value="Register"/>
                </fieldset>
            </form>
        </div>
    </body>
</html>
