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
        
        
        
        
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $senderId = $_SESSION['loggedUserId'];
            $recieverId = $_GET['id'];
            
            $newMessage = new Message();
            $newMessage->setSenderId($senderId);
            $newMessage->setReceiverId($recieverId);
            $newMessage->setTitle($_POST["title"]);
            $newMessage->setTextMessage($_POST['message']);
            if($newMessage->saveToDB($conn)){
                echo "New message was sent";
            }
            else{
                echo "We cennot deliver your message. There was some difficulties";
            }
        }
        ?>
        <form method = "POST">
            <label>Title</label><br/>
            <input type="text" name="title" maxlength="100"><br/>
            <label>Message</label><br/>
            <textarea name="message" rows="20" cols="45" placeholder='Write your message'></textarea><br/>
            <input type="submit" value='Send'/>        
        </form>
        <a href='index.php'>Main Page</a>
    </body>
</html>
