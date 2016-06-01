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
        require_once './src/Tweet.php';
        require_once './src/connection.php';
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        if($_SERVER["REQUEST_METHOD"]==="GET"){
            $userId = $_GET["id"];
            $User = new User();
            $User->loadFromDB($conn,$userId); 
            $userTweets = $User->loadAllTweets($conn);
        }
        ?>
        <div>
            <h3><?php echo $User->getFullName() ?></h3>
            <p>E-mail: <?php echo $User->getEmail()  ?> </p>
            <h4>User's entries: </h4>
            <ul>
            <?php
            foreach ($userTweets as $tweets){
                echo '<li> #'.$tweets[0].'<br/>'.$tweets[1].'</li>';
            }
            ?>
            </ul>
            
        </div>
        
        
    </body>
</html>
