<?php

class Tweet{
    private $id;
    private $user_id;
    private $text;
    
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
   
}