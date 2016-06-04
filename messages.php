<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        session_start();
        require_once './src/connection.php';
        require_once './src/Message.php';
        
        if(!isset($_SESSION['loggedUserId'])){
            header("Location: login.php");
        }
        
        $allReceived=[];
        $allSent = [];
        
        

        $loggedUserId = $_SESSION['loggedUserId'];

        
        $sqlReceived = "SELECT Messages.*, User.full_name FROM Messages JOIN User on Messages.sender_id = User.id WHERE receiver_id = '$loggedUserId'";
        $sqlSent = "SELECT Messages.*, User.full_name FROM Messages JOIN User on Messages.receiver_id = User.id WHERE sender_id = '$loggedUserId'";
        
        $resultReceived = $conn->query($sqlReceived);
        $resultSent = $conn->query($sqlSent);
        
        if($resultReceived->num_rows > 0){
            
            while($rowReceived = $resultReceived->fetch_assoc()){
                $allReceived[] = [$rowReceived['id'],$rowReceived['title'],$rowReceived['is_read'],$rowReceived['full_name'],$rowReceived['text_message'], $rowReceived['sender_id']];
            }
        }
        
        if($resultSent->num_rows > 0){
            
            while($rowSent = $resultSent->fetch_assoc()){
                 $allSent[] = [$rowSent['id'],$rowSent['title'],$rowSent['is_read'],$rowSent['full_name'],$rowSent['text_message'], $rowSent['receiver_id']];
            }
        }
        ?>
        <div class="container">
            <ul class="nav nav-pills">
                <li role="presentation"><a href='index.php'>Main Page</a></li>
            </ul>
            
            <div class="row">
                <h4>Received Messages:</h4>
            </div>
                <ul class="list-group">
                    <?php
                    if(count($allReceived)>0){
                        for($i=0; $i<count($allReceived);$i++){
                            if($allReceived[$i][2]){
                                echo '<li class="list-group-item">';
                                echo '<div class="list-group-item-heading">';
                                echo '<b>From: </b><a href="user_page.php?id='.$allReceived[$i][5].'">'.$allReceived[$i][3].'</a><br/>';
                                echo '<b>Title: </b>';
                                echo '<a href="message_page.php?id='.$allReceived[$i][0].'"><b>'.$allReceived[$i][1].'</b></a>';
                                echo '</div>';
                                echo '<p class = "list-group-item-text"><i>'.substr($allReceived[$i][4], 0, 30).'</i></p>';
                                echo '</li>';
                            }
                            else{
                                echo '<li class="list-group-item">';
                                echo '<div class="list-group-item-heading">';
                                echo '<b>From: </b><a href="user_page.php?id='.$allReceived[$i][5].'">'.$allReceived[$i][3].'</a><br/>';
                                echo '<b>Title: </b>';
                                echo '<a href="message_page.php?id='.$allReceived[$i][0].'">'.$allReceived[$i][1].'</a>';
                                echo '</div>';
                                echo '<p class = "list-group-item-text"><i>'.substr($allReceived[$i][4], 0, 30).'</i></p>';
                                echo '</li>';
                            }
                        }
                    }
                    else{
                        echo "You haven't received any messages";
                    }
                    ?>
                </ul>
            
            <div class="row">
                <h4>Sent Messages:</h4>
            </div>
                <ul class="list-group">
                    <?php
                    if(count($allSent)>0){
                        for($i=0; $i<count($allSent);$i++){
                            echo '<li class="list-group-item">';
                            echo '<div class="list-group-item-heading">';
                            echo '<b>To: </b><a href="user_page.php?id='.$allSent[$i][5].'">'.$allSent[$i][3].'</a><br/>';
                            echo '<b>Title: </b>';
                            echo '<a href="message_page.php?id='.$allSent[$i][0].'&tag=s">'.$allSent[$i][1].'</a>';
                            echo '</div>';
                            echo '<p class = "list-group-item-text"><i>'.substr($allSent[$i][4], 0, 30).'</i></p>';
                            echo '</li>'; 
                        }
                    }
                    else{
                        echo "You haven't sent any messages";
                    }
                    ?>
                </ul>
                
            
        </div>
        
    </body>
</html>
