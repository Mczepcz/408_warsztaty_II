<!DOCTYPE html>
<?php

session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/connection.php';

if(!isset($_SESSION['loggedUserId'])){
    header("Location: login.php");
}
if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if(isset($_POST['tweetText'])){
        $newTweet = new Tweet();
        $newTweet->setUserId($_SESSION['loggedUserId']);
        $newTweet->setText($_POST['tweetText']);
        $newTweet->saveToDB($conn);
        header("Location: index.php");
    }
}
$connectedUser = new User();
$connectedUser->loadFromDB($conn,$_SESSION['loggedUserId']); 
$userTweets = $connectedUser->loadAllTweets($conn);
$connectedUserId = $connectedUser->getId();


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src='js/app.js'></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                    <li role="presentation"><a href='allUsers.php'>See others users</a></li>
                    <li role="presentation"><a href="messages.php">Post box</a></li>
                </ul>
            </div>
            <div class="row">
                <h1><a href="user_page.php?id=<?php echo $connectedUserId?>"><?php echo $connectedUser->getFullName() ?> </a><small>User id :<?php echo $_SESSION['loggedUserId']?></small></h1><br/>
            </div>
            <div class="row">
            <h3>Your Entries:</h3>
            </div>
            <ul class="list-group">
                <?php
                if($userTweets){
                    foreach ($userTweets as $tweets){
                        $commNum = Tweet::numOfComments($conn, $tweets[0]);

                        echo '<li class="list-group-item"><a class="list-group-item-heading" href=tweet_page.php?id='.$tweets[0].'> #'.$tweets[0].'</a><p class = "list-group-item-text">'.$tweets[1].'</p><small>Comments: <span class="label label-default">'.$commNum.'</span></small></li>';
                    }
                }
                ?>
            </ul>
            <form method='POST'>
                <div class="form-group">    
                    <label for="tweet">Your new Entry:</label><br/>
                    <textarea class="form-control" id='tweet' name='tweetText' rows ='10' cols='45' maxlength='140' placeholder='Write your short message'></textarea><br/>
                    <p><span id='counter'>0</span>/140</p>
                    <input type="submit" class="btn btn-primary" value='Enter'/>
                </div>
            </form>
        </div>


    </body>
</html>
