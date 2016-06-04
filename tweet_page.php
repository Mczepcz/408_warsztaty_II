<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src='js/app.js'></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        session_start();
        require_once './src/User.php';
        require_once './src/Tweet.php';
        require_once './src/Comment.php';
        require_once './src/connection.php';
        
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        if(isset($_GET["id"])){
            $tweetId = $_GET["id"];
            $currentTweet = new Tweet();
            $currentTweet->loadFromDB($conn, $tweetId);
            $tweet = $currentTweet->showTweet($conn, $tweetId);
            
        }
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if(isset($_POST['comment'])){
                $newComment = new Comment();
                $newComment->setUserId($_SESSION['loggedUserId']);
                $newComment->setTweetId($_GET['id']);
                $newComment->setCreationDate(date('Y-m-d H:i:s'));
                $newComment->setText($_POST['comment']);
                $newComment->saveToDB($conn);
                header("location: tweet_page.php?id=$tweetId");
            }
        }
        
        $commNum = Tweet::numOfComments($conn, $_GET['id']);
        $tweetComments = $currentTweet->getAllComments($conn);

        ?>
        <div class="container">
            <ul class="nav nav-pills">
                <li role="presentation"><a href='index.php'>Main Page</a></li>
            </ul>
            
            <div class="row">
                <div class="well">
                    <p><?php echo $tweet['text'];?></p>
                </div>
            </div>
            
            <h4>Comments (<?php echo $commNum ?>) :</h4>
            <ul class="list-group">
                <?php
                if($tweetComments){
                    foreach ($tweetComments as $comment){
                        $authorObject = User::getUserById($conn, $comment[1]);
                        $author = '<a href="user_page.php?id='.$authorObject['id'].'">'.$authorObject['full_name'].'</a>';

                        echo '<li class="list-group-item"><p class="list-group-item-heading"> #'.$comment[0].' author: '.$author.' date: '.$comment[3].' </p><p class="list-group-item-text">'.$comment[4].'</p></li>';
                    }
                }    
                ?>
            </ul>
            <form method='POST'>
                <div class="form-group"> 
                    <label for="tweet">Leave a comment:</label><br/>
                    <textarea class="form-control" id="tweet" name='comment' rows ='5' cols='20' maxlength='60' placeholder='Write your comment'></textarea><br/>
                     <p><span id="counter">0</span>/60</p>
                    <input class="btn btn-primary" type="submit" value='Comment'/>
                </div>
            </form>
            <br/>
        </div>
        
    </body>
</html>
