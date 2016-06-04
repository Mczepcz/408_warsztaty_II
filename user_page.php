<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
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
        echo "<div class='row'>";
        echo '<ul class="nav nav-pills">';
        echo '<li role="presentation"><a href="index.php">Main Page</a></li>';
        if($user->getActive()){
            if($userId === $_SESSION['loggedUserId']){
                echo '<li role="presentation"><a href="edit_user.php?id='.$connectedUserId.'">Edit your profile</a></li>';
                echo '<li role="presentation"><a href="delete_profile.php" > Delete your profile</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            else{
                echo '<li role="presentation"><a href="send_message.php?id='.$userId.'">Send Message</a></li>';
                echo '</ul>';
                echo '</div>';
            }
            echo '<div>';
            echo '<h3>'.$user->getFullName().'</h3>';
            echo '<p>E-mail: '.$user->getEmail().'</p>';
            echo "<h4>User's entries: </h4>";
            echo '<ul class="list-group">';
            if($userTweets){
                foreach ($userTweets as $tweets){
                    $commNum = Tweet::numOfComments($conn, $tweets[0]);
                    
                    echo '<li class="list-group-item"><a class="list-group-item-heading" href=tweet_page.php?id='.$tweets[0].'> #'.$tweets[0].'</a><p class = "list-group-item-text">'.$tweets[1].'</p><small>Comments: <span class="label label-default">'.$commNum.'</span></small></li>';
                }
            }
            echo'</ul>'; 
            echo'</div>';
            
        }
        else{
            echo "This user has deactivated profile. Until activation any interraction with user will be impossible";
        }
        ?>
      
       
        </div>
        
    </body>
</html>
