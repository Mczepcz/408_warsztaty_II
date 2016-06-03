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
                $allReceived[] = [$rowReceived['id'],$rowReceived['title'],$rowReceived['is_read'],$rowReceived['full_name'],$rowReceived['text_message']];
            }
        }
        
        if($resultSent->num_rows > 0){
            
            while($rowSent = $resultSent->fetch_assoc()){
                 $allSent[] = [$rowSent['id'],$rowSent['title'],$rowSent['is_read'],$rowSent['full_name'],$rowSent['text_message']];
            }
        }
        ?>
        <div>
            <div>
                <h4>Received Messages:</h4>
                <ul>
                    <?php
                    if(count($allReceived)>0){
                        for($i=0; $i<count($allReceived);$i++){
                            if($allReceived[$i][2]){
                                echo '<li>';
                                echo '<b>From: </b>'.$allReceived[$i][3].'<br/>';
                                echo '<b>Title: </b>';
                                echo '<a href="message_page.php?id='.$allReceived[$i][0].'"><b>'.$allReceived[$i][1].'</b></a>';
                                echo '<p><i>'.substr($allReceived[$i][4], 0, 30).'</i></p>';
                                echo '</li>';
                            }
                            else{
                                echo '<li>';
                                echo '<b>From: </b>'.$allReceived[$i][3].'<br/>';
                                echo '<b>Title: </b>';
                                echo '<a href="message_page.php?id='.$allReceived[$i][0].'">'.$allReceived[$i][1].'</a>';
                                echo '<p><i>'.substr($allReceived[$i][4], 0, 30).'</i></p>';
                                echo '</li>';
                            }
                        }
                    }
                    else{
                        echo "You haven't received any messages";
                    }
                    ?>
                </ul>
            </div>
            <div>
                <h4>Sent Messages:</h4>
                <ul>
                    <?php
                    if(count($allSent)>0){
                        for($i=0; $i<count($allSent);$i++){
                            echo '<li>';
                            echo '<b>To: </b>'.$allSent[$i][3].'<br/>';
                            echo '<b>Title: </b>';
                            echo '<a href="message_page.php?id='.$allSent[$i][0].'">'.$allSent[$i][1].'</a>';
                            echo '<p><i>'.substr($allSent[$i][4], 0, 30).'</i></p>';
                            echo '</li>'; 
                        }
                    }
                    else{
                        echo "You haven't sent any messages";
                    }
                    ?>
                </ul>
                
            </div>
        </div>
        <a href='index.php'>Main Page</a>
    </body>
</html>
