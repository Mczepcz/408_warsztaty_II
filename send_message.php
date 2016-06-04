<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href='index.php'>Main Page</a></li>
                </ul>
            </div>
        <?php
        session_start();
        require_once './src/connection.php';
        require_once './src/Message.php';
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        
        
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $senderId = $_SESSION['loggedUserId'];
            $recieverId = $_GET['id'];
            
            $newMessage = new Message();
            $newMessage->setSenderId($senderId);
            $newMessage->setReceiverId($recieverId);
            $newMessage->setTitle($_POST["title"]);
            $newMessage->setTextMessage($_POST['message']);
            if($newMessage->saveToDB($conn)){
                echo '<p class = "bg-success">New message was sent</p>';
            }
            else{
                echo '<p class="bg-danger">We cennot deliver your message. There was some difficulties</p>';
            }
        }
        ?>
        <form method = "POST">
            <div class="form-group">   
                <label for="messageTitle">Title</label><br/>
                <input class="form-control" id="messageTitle" type="text" name="title" maxlength="100"><br/>
                <label for="messageText">Message</label><br/>
                <textarea class="form-control" id="messageText" name="message" rows="20" cols="45" placeholder='Write your message'></textarea><br/>
                <input class ="btn btn-primary" type="submit" value='Send'/>
            </div>
        </form>
        </div>
    </body>
</html>
