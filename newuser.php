<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$p=$_POST['password'];
$password = md5($p);

$sqlQuery = "INSERT INTO users (firstname, lastname, email, phone, password, date) values ('$firstname', '$lastname', '$email','$phone', '$password', NOW())";

mysqli_query($db,$sqlQuery);


?>