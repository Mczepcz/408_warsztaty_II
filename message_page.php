<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        require_once './src/connection.php';
        require_once './src/Message.php';
        require_once './src/User.php';
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        
        if($_SERVER["REQUEST_METHOD"]==="GET"){
            $messageId = $_GET['id'];
            $currentMessage = Message::showMessage($conn, $messageId);
            $reciever = User::getUserById($conn, $currentMessage['receiver_id']);
            
            if(!(isset($_GET['tag']))){
                Message::changeIsRead($conn, $messageId);
                $replyButton = "<a href='send_message.php?id=".$currentMessage['sender_id']."'>Reply</a>";
                $fromField = "<p><b>From: </b>".$currentMessage['full_name']."</p>";
            }
            else{
                $replyButton="";
                $fromField = "<p><b>To: </b>".$reciever['full_name']."</p>";
            }
            
           
            
            echo "<div>";
            echo "<p><b>Title: </b>".$currentMessage['title']."</p>";
            echo $fromField;
            echo "<div>";
            echo $currentMessage['text_message'];
            echo "</div>";
            echo "</br>";
            echo $replyButton;
            echo "</div>";
            
        }
        
        ?>
        <a href='index.php'>Main Page</a>
    </body>
</html>
