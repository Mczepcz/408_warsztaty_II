<?php

require_once 'connection.php';
class User {
    
    public static function getUserByEmail (mysqli $conn, $email){
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc();
            
        }
        else{
            return false;
        }
    }
    public static function getUserById (mysqli $conn, $id){
        $sql = "SELECT * FROM User WHERE id = '$id'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc();
            
        }
        else{
            return false;
        }
    }
    public static function login (mysqli $conn, $email, $password){
        $sql = "SELECT * FROM User WHERE email='$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $rowUser = $result->fetch_assoc();
            if(password_verify($password, $rowUser['password']) && $rowUser['active'] == 1){
                return $rowUser['id'];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    private $id;
    private $email;
    private $password;
    private $fullName;
    private $active;
    
    public function __construct(){
        $this->id = -1;
        $this->email = "";
        $this->password = "";
        $this->fullName= "";
        $this->active = 0;
    
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setEmail($email){
        $this->email = is_string($email) ? trim($email) : $this->email;
        
    }
    
    public function getEmail(){
        return $this->email;
        
    }
    public function setPassword($password, $retypedPassword){
        if ($password != $retypedPassword) {
            return false;
        }

        $this->password = is_string($password) ? password_hash($password, PASSWORD_BCRYPT) : $this->password ;
        return true;
    }
    public function setFullName($fullName){
        $this->fullName = is_string($fullName) ? trim($fullName) : $this->fullName;
    }
    public function getFullName(){
       return $this->fullName;
    }
    public function activate(){
        $this->active = 1;
    }
    public function deactivate(){
        $this->active = 0;
    }
    public function getActive(){
        return $this->active;
    }
    public function loadFromDB(mysqli $conn, $id){
        $sql = "SELECT * FROM User WHERE id = $id";
        $result = $conn->query($sql);
        if($result->num_rows ==1) {
            $rowUser = $result->fetch_assoc();
            $this->id = $rowUser['id'];
            $this->email = $rowUser['email'];
            $this->password = $rowUser['password'];
            $this->fullName = $rowUser['full_name'];
            $this->active = $rowUser['active'];
        }
        return false;
    }
    
    public function saveToDB(mysqli $conn){
        if($this->id == -1) {
            $sql = "INSERT INTO User (email, password, full_name, active)"
                    . "VALUES ('{$this->email}','{$this->password}','{$this->fullName}',{$this->active})";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $sql = "UPDATE User SET email = '{$this->email}', password='{$this->password}', full_name ='{$this->fullName}', active= {$this->active} WHERE id = {$this->id}";
            
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }
    }
    public function loadAllTweets(mysqli $conn){
        $sql = "SELECT * FROM Tweets WHERE user_id = '$this->id'";
        $result = $conn->query($sql);
        $allTweets = [];
        if($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()){
                $allTweets[] = [$row['id'],$row['text']];
            }
            return $allTweets;
        }
        else{
            return false;
        }
    }
}
