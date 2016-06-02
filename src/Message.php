<?php
require_once 'connection.php';

class Message {
    
    public static function showMessage (mysqli $conn, $id){
        $sql = "SELECT * FROM Messages WHERE id = '$id'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc();

        }
        else{
            return false;
        }
    }
    
    private $id;
    private $sender_id;
    private $receiver_id;
    private $text_message;
    private $is_read;
    private $title;
    
    public function __construct(){
        $this->id =-1;
        $this->sender_id = 0;
        $this->receiver_id = 0;
        $this->text_message = "";
        $this->is_read = 1;
        $this->title="";
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setSenderId($SenderId){
        $this->sender_id = $SenderId;
    }
    
    public function getSenderId(){
        return $this->sender_id;
    }
    
    public function setReceiverId($receiverId){
        $this->receiver_id = $receiverId;
    }
    
    public function getReceiverId(){
        $this->receiver_id;
    }
    
    public function setTextMessage($textMessage){
        $this->text_message = $textMessage;
    }
    
    public function getTextMessage(){
        return $this->text_message;
    }
    
    public function setIsRead($flag){
        $this->is_read = $flag;
    }
    
    public function getIsRead(){
        return $this->is_read;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    
    public function loadFromDB(mysqli $conn, $id){
        $sql = "SELECT * FROM Messages WHERE id = $id";
        $result = $conn->query($sql);
        if($result->num_rows ==1) {
            $rowMess = $result->fetch_assoc();
            $this->id = $rowMess['id'];
            $this->sender_id = $rowMess['sender_id'];
            $this->receiver_id = $rowMess['receiver_id'];
            $this->text_message = $rowMess['text_message'];
            $this->is_read = $rowMess['is_read'];
            $this->title = $rowMess['title'];
        }
        return false;
    }
    
    public function saveToDB(mysqli $conn){
        if($this->id == -1) {
            $sql = "INSERT INTO Messages (sender_id, receiver_id, text_message, is_read, title)"
                    . "VALUES ('{$this->sender_id}','{$this->receiver_id}', '{$this->text_message}', '{$this->is_read}','{$this->title}')";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $sql = "UPDATE Messages SET sender_id = '{$this->sender_id}', receiver_id ='{$this->receiver_id}', text_message = '{$this->text_message}',is_read = '{$this->is_read}', title = '{$this->title}'   WHERE id = {$this->id}";
            
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
}


