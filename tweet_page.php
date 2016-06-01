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
        echo 'POST';
        if(isset($_POST['comment'])){
            $newComment = new Comment();
            $newComment->setUserId($_SESSION['loggedUserId']);
            $newComment->setTweetId($_GET['id']);
            $newComment->setCreationDate(date('Y-m-d H:i:s'));
            $newComment->setText($_POST['comment']);
            $newComment->saveToDB($conn);
        }
        
        $tweetComments = $currentTweet->getAllComments($conn);
}
        ?>
        <div>

            <p><?php echo $tweet['text'];?></p>
            <hr/>
            <h4>Comments :</h4>
            <ul>
                <?php
                foreach ($tweetComments as $comment){
                    $author = User::getUserById($conn, $comment[1]);

                    echo '<li> #'.$comment[0].' author: '.$author['full_name'].' date: '.$comment[3].' <br/>'.$comment[4].'</li>';
                }
                ?>
            </ul>
            <form method='POST'>
                <label>Leave a comment:</label><br/>
                <textarea name='comment' rows ='5' cols='20' maxlength='60' placeholder='Write your comment'></textarea><br/>
                <input type="submit" value='Comment'/>
            </form>
            <br/>
        </div>
        <a href='index.php'>Main Page</a>
    </body>
</html>
