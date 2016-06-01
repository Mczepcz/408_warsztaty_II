<?php

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
            $rowUser = $result->fetch_assoc();
            $this->id = $rowUser['id'];
            $this->user_id = $rowUser['user_id'];
            $this->text = $rowUser['text'];
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
            $sql = "UPDATE Tweets SET user_id = '{$this->user_id}', text ='{$this->text}', active= {$this->active} WHERE id = {$this->id}";
            
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }
    public function getAllComments(){
        
    }
   
}