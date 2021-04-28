<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME','u859960976_user');
define('DB_PASSWORD', 'theresa1');
define('DB_DATABASE', 'u859960976_gpn');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}


$branch = $_GET['branch'];

$sql= "SELECT username, datadb FROM branches WHERE id = '$branch'";

$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);   


session_start();
$_SESSION['dbusername'] = $row['username'];
$_SESSION['datadb'] = $row['datadb'];

echo $_SESSION['datadb'];
?>