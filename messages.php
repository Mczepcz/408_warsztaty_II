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
        
        $sqlReceived = "SELECT * FROM Messages WHERE receiver_id = '$loggedUserId'";
        $sqlSent = "SELECT * FROM Messages WHERE sender_id = '$loggedUserId'";
        
        $resultReceived = $conn->query($sqlReceived);
        $resultSent = $conn->query($sqlSent);
        
        if($resultReceived->num_rows > 0){
            
            while($rowReceived = $resultReceived->fetch_assoc()){
                $allReceived[] = [$rowReceived['id'],$rowReceived['title'],$rowReceived['is_read']];
            }
        }
        
        if($resultSent->num_rows > 0){
            
            while($rowSent = $resultSent->fetch_assoc()){
                 $allSent[] = [$rowSent['id'],$rowSent['title'],$rowSent['is_read']];
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
                                echo '<li><a href="linkzgetem"><b>Tytul</b></a></li>';
                            }
                            else{
                                echo '<li><a href="linkzgetem">Tytul</a></li>';
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
                            if($allSent[$i][2]){
                                echo '<li><a href="linkzgetem"><b>Tytul</b></a></li>';
                            }
                            else{
                                echo '<li><a href="linkzgetem">Tytul</a></li>';
                            }
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
