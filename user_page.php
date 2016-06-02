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
                echo '<li><a href=tweet_page.php?id='.$tweets[0].'> #'.$tweets[0].'</a><br/>'.$tweets[1].'</li>';
            }
            ?>
            </ul>
            
        </div>
        <?php
        if($userId === $_SESSION['loggedUserId']){
            echo '<a href="edit.php?id='.$userId.'">Edit your profile</a>';
        }
        else{
            echo '<a href="send_message.php?id='.$userId.'">Send Message</a>';
        }
        ?>
      
        <a href='index.php'>Main Page</a>
        
        
    </body>
</html>
