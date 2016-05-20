<?php

$servername = "localhost";
$username = "root";
$password = "coderslab";
$baseName = "Twitter";

$conn = new mysqli($servername,$username,$password,$baseName);

if($conn->connect_error){
    die("Polaczenie nieudane. Blad: ".$conn->connect_error);
}else{
   //echo("Polaczenie udane</br>"); 
   echo'<hr>';
}



