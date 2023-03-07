<?php
ini_set('display_errors', 0);
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', $_SESSION['dbusername']);
define('DB_PASSWORD', 'Theres@1#');
define('DB_DATABASE', $_SESSION['datadb']);

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo 'ACCESS DENIED';
}
?>

