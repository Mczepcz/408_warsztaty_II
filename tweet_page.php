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
            $tweetId = $_GET["id"];
            $currentTweet = new Tweet();
            $currentTweet->loadFromDB($conn, $tweetId);
            $tweet = $currentTweet->showTweet($conn, $tweetId);
            var_dump($tweet);
        }
        ?>
        <div>
            <div>
                
                <p><?php echo $tweet['text'];?></p>
                <hr/>
                <h4>Comments :</h4>
                <ul>
                    
                </ul>
            </div>
        </div>
    </body>
</html>
