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
    </head>
    <body>
        Logged user id =<?php echo $_SESSION['loggedUserId']?><br/>
        <a href="user_page.php?id=<?php echo $connectedUserId?>"><?php echo $connectedUser->getFullName() ?> </a><br/>
        <b>Your Entries:</b>
        <ul>
            <?php
            foreach ($userTweets as $tweets){
                echo '<li><a href=tweet_page.php?id='.$tweets[0].'> #'.$tweets[0].'</a><br/>'.$tweets[1].'</li>';
            }
            ?>
        </ul>
        <form method='POST'>
            <label>Your new Entry:</label><br/>
            <textarea name='tweetText' rows ='10' cols='45' maxlength='140' placeholder='Write your short message'></textarea><br/>
            <input type="submit" value='Tweet'/>
        </form>
        <br/>
        <a href="logout.php">Logout</a>
        <a href='allUsers.php'>See others users</a>
        <a href="messages.php">Post box</a>

    </body>
</html>
