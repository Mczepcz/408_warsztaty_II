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
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
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
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<p class="bg-sucess"> Your profile was deleted</p><br/>';
                echo '</div>';
                echo '<div class="row">';
                echo '<a href="register.php">Want make new profile? Sign up now!</a>';
                echo '</div>';
                echo '</div>';
                unset($_SESSION['loggedUserId']);
            }
            else{
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<ul class="nav nav-pills">';
                echo '<li role="presentation"><a href="index.php">Main Page</a></li>';
                echo '</ul>';
                echo '</div>';
                echo '<div class="row"><p class="bg-warning">You have to mark checkbox if you want to delete your profile</p></div>';
                echo '<hr/>';
                echo'<div = "row"><p class="text-danger"> You are going to delete your profile.</p></div>';
                echo '<div = "row"><p class="text-danger"> Are you sure to do that?</p></div>';

                echo'<form method="POST"><br/>';
                echo '<div class="form-group">';
                echo '<input type = "checkbox" name="delete" value="1"> I want to delete my profile and I am aware of consequences<br>';
                echo '<input class="btn btn-danger" type="submit" value="Delete profile">';   
                echo '</div>';
                echo'</form>';
                echo'</div>';
            }
        }
        else{
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<ul class="nav nav-pills">';
            echo '<li role="presentation"><a href="index.php">Main Page</a></li>';
            echo '</ul>';
            echo '</div>';
           
            echo'<div = "row"><p class="text-danger"> You are going to delete your profile.</p></div>';
            echo '<div = "row"><p class="text-danger"> Are you sure to do that?</p></div>';
            
            echo'<form method="POST"><br/>';
            echo '<div class="form-group">';
            echo '<input type = "checkbox" name="delete" value="1"> I want to delete my profile and I am aware of consequences<br>';
            echo '<input class="btn btn-danger" type="submit" value="Delete profile">';   
            echo '</div>';
            echo'</form>';
            echo'</div>';
        }
        ?>
    </body>
</html>
