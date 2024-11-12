<?php
$host = "localhost";
$user = "root";
$pass = "renan1520";
$database = "donationdb";

$conn = mysqli_connect($host,$user,$pass,$database);

if(!$conn){
    die("Connection Failed" . mysqli_connect());
}
?>
