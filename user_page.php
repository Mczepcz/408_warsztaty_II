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
            $connectedUserId = $_SESSION['loggedUserId'];
            $user = new User();
            $user->loadFromDB($conn,$userId); 
            $userTweets = $user->loadAllTweets($conn);
        }
        if($user->getActive()){   
            echo '<div>';
            echo '<h3>'.$user->getFullName().'</h3>';
            echo '<p>E-mail: '.$user->getEmail().'</p>';
            echo "<h4>User's entries: </h4>";
            echo '<ul>';
            if($userTweets){
                foreach ($userTweets as $tweets){
                    echo '<li><a href=tweet_page.php?id='.$tweets[0].'> #'.$tweets[0].'</a><br/>'.$tweets[1].'</li>';
                }
            }
            echo'</ul>'; 
            echo'</div>';
            if($userId === $_SESSION['loggedUserId']){
                echo '<a href="edit_user.php?id='.$connectedUserId.'">Edit your profile</a>';
                echo '<a href="delete_profile.php" > Delete your profile</a>';
            }
            else{
                echo '<a href="send_message.php?id='.$userId.'">Send Message</a>';
            }
        }
        else{
            echo "This user has deactivated profile. Until activation any interraction with user will be impossible";
        }
        ?>
      
        <a href='index.php'>Main Page</a>
        
        
    </body>
</html>
