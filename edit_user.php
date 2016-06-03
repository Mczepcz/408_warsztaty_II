<!DOCTYPE html>
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
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $connectedUser = new User();
            if(isset($_POST['newEmail'])){
            $user = User::getUserByEmail($conn, $_POST["newEmail"]);   
            }
            $connectedUser->loadFromDB($conn, $_SESSION['loggedUserId']);
            if(!$user){
                if(strlen(trim($_POST["newEmail"]))>0){
                    $connectedUser->setEmail($_POST["newEmail"]);
                }
            }
            else{
                echo "This email is already exists";
            }
            if(isset($_POST['newName']) && strlen(trim($_POST["newName"]))>0){
              $connectedUser->setFullName($_POST['newName']);  
            }
            if(isset($_POST['newPassword']) && strlen(trim($_POST["newPassword"]))>0){
                
               $connectedUser->setPassword($_POST['newPassword'], $_POST['retypeNewPassword']);     
            }
            
            if($connectedUser->saveToDB($conn)){
                echo "Changes was applied";
               
            }
            else{
                echo "Error durning appling";
            }
        }
        
        ?>
        <form method="POST">
            <label>New full name </label>
            <input type="text" name="newName"/></br>
            <label>New e-mail</label>
            <input type="email" name="newEmail"/></br>
            <label>New password </label>
            <input type="password" name="newPassword"/></br>
            <label>Retype password</label>
            <input type="password" name="retypeNewPassword"/><br/>
            <input type="submit" value="Submit changes"/>
            
        </form>
        
        <a href='index.php'>Main Page</a>
    </body>
</html>
