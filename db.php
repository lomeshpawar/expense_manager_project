<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "expense_manager";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Connection Failed");
}

?>