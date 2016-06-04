<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class='container'>
             <div class="row">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="index.php">Main Page</a></li>
                </ul>
            </div>
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
                echo "<div class='row'>";
                echo "<p class = 'bg-danger'>This email is already exists</p>";
                echo "</div>";
            }
            if(isset($_POST['newName']) && strlen(trim($_POST["newName"]))>0){
              $connectedUser->setFullName($_POST['newName']);  
            }
            if(isset($_POST['newPassword']) && strlen(trim($_POST["newPassword"]))>0){
                
               $connectedUser->setPassword($_POST['newPassword'], $_POST['retypeNewPassword']);     
            }
            
            if($connectedUser->saveToDB($conn)){
                echo "<div class='row'>";
                echo "<p class='bg-success'>Changes was applied</p>";
                echo "</div>";
               
            }
            else{
                echo "<div class='row'>";
                echo "<p class = 'bg-danger'>Error durning appling</p>";
                echo "</div>";
            }
        }
        
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="fullName">New full name </label>
                <input id="fullName" class="form-control" type="text" name="newName"/></br>
                <label for ="email">New e-mail</label>
                <input id="email" class="form-control" type="email" name="newEmail"/></br>
                <label for="pass">New password </label>
                <input id="pass" class="form-control" type="password" name="newPassword"/></br>
                <label for="rePass">Retype password</label>
                <input id="rePass" class="form-control" type="password" name="retypeNewPassword"/><br/>
                <input class="btn btn-primary" type="submit" value="Submit changes"/>
            </div>
        </form>
    </body>
</html>
