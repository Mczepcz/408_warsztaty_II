<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        require_once './src/User.php';
        require_once './src/connection.php';
        
        $connectedUser = new User();
        $connectedUser->loadFromDB($conn, $_SESSION['loggedUserId']);
        
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            if(isset($_POST["delete"]) && $_POST["delete"] == 1){
                $connectedUser->deactivate();
                $connectedUser->saveToDB($conn);
                echo"<p> Your profile was deleted</p><br/>";
                echo '<a href="register.php">Want make new profile? Sign up now!</a>'; 
                unset($_SESSION['loggedUserId']);
            }
            else{
                echo "You have to mark checkbox";
                echo "<hr>";
                echo'<p> You are going to delete your profile. <br/> Are you sure to do that?</p>';
                echo'<form method="POST"><br/>';
                echo '<input type = "checkbox" name="delete" value="1"> I want to delete my profile and I am aware of those horrible consequences<br>';
                echo '<input type="submit" value="Delete profile">';   
                echo'</form>';
                echo '<a href="index.php">Main Page</a>';
            }
        }
        else{
            echo'<p> You are going to delete your profile.<br/> Are you sure to do that?</p>';
            echo'<form method="POST"><br/>';
            echo '<input type = "checkbox" name="delete" value="1"> I want to delete my profile and I am aware of those horrible consequences<br>';
            echo '<input type="submit" value="Delete profile">';   
            echo'</form>';
            echo '<a href="index.php">Main Page</a>';
        }
        ?>
    </body>
</html>
