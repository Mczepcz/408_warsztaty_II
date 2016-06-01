<?php

class Comment{
    private $id;
    private $user_id;
    private $tweet_id;
    private $creation_date;
    private $text; 
    
    public function __construct() {
        $this->id = -1;
        $this->user_id = 0;
        $this->tweet_id= 0;
        $this->creation_date= 0;
        $this->text = "";
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function setTweetId($tweet_id){
        $this->tweet_id = $tweet_id;
    }
    
    public function getTweetId(){
        return $this->tweet_id;
    }
    
    public function setCreationDate($date){
        $this->creation_date = $date;
    }
    
    public function getCreationDate(){
        return $this->creation_date;
    }
    
    public function setText($text){
        $this->text = $text;
    }
    
    public function getText(){
        return $this->text;
    }
    
    
    public function loadFromDB(mysqli $conn, $id){
        $sql = "SELECT * FROM Comments WHERE id = $id";
        $result = $conn->query($sql);
        if($result->num_rows ==1) {
            $rowComment = $result->fetch_assoc();
            $this->id = $rowComment['id'];
            $this->user_id = $rowComment['user_id'];
            $this->tweet_id = $rowComment['tweet_id'];
            $this->creation_date = $rowComment['creation_date'];
            $this->text = $rowComment['comment_text'];
        }
        return false;
    }
    
    public function saveToDB(mysqli $conn){
        if($this->id == -1) {
            $sql = "INSERT INTO Comments (user_id, tweet_id, creation_date, comment_text)"
                    . "VALUES ('{$this->user_id}','{$this->tweet_id}','{$this->creation_date}','{$this->text}')";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $sql = "UPDATE Comments SET user_id = '{$this->user_id}', tweet_id= '{$this->tweet_id}', creation_date='{$this->creation_date}', text ='{$this->text}' WHERE id = {$this->id}";
            
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }
}