<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "appevent";

$db = mysqli_connect($serverName,$userName,$password,$dbName);
if(!$db){
    die("Connection failed".mysqli_connect_error());
}
// echo"Connected Successfully";
?>