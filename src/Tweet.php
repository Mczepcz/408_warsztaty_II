<?php
require_once 'connection.php';

class Tweet{
    
    public static function showTweet (mysqli $conn, $id){
        $sql = "SELECT * FROM Tweets WHERE id = '$id'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc();

        }
        else{
            return false;
        }
    }
    
    
    private $id;
    private $user_id;
    private $text;
    

    public function __construct() {
        $this->id = -1;
        $this->user_id = 0;
        $this->text = "";
    }
    
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    
     public function getUserId(){
        return $this->user_id;
    }
    
    public function setText($text){
        if(is_string($text) && strlen($text)<140){
            $this->text = $text;
        }
    }
    public function getText(){
        return $this->text;
    }
    
    public function getId(){
        return $this-> id;
    }
    
    public function loadFromDB(mysqli $conn, $id){
        $sql = "SELECT * FROM Tweets WHERE id = $id";
        $result = $conn->query($sql);
        if($result->num_rows ==1) {
            $rowTweet = $result->fetch_assoc();
            $this->id = $rowTweet['id'];
            $this->user_id = $rowTweet['user_id'];
            $this->text = $rowTweet['text'];
        }
        return false;
    }
    public function saveToDB(mysqli $conn){
        if($this->id == -1) {
            $sql = "INSERT INTO Tweets (user_id, text)"
                    . "VALUES ('{$this->user_id}','{$this->text}')";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $sql = "UPDATE Tweets SET user_id = '{$this->user_id}', text ='{$this->text}' WHERE id = {$this->id}";
            
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }
    public function getAllComments(mysqli $conn){
        $sql = "SELECT * FROM Comments WHERE tweet_id = '$this->id' ORDER BY creation_date DESC";
        $result = $conn->query($sql);
        $allComments = [];
        if($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()){
                $allComments[] = [$row['id'],$row['user_id'],$row['tweet_id'],$row['creation_date'],$row['comment_text']];
            }
            return $allComments;
        }
        else{
            return false;
        }
    }
   
}