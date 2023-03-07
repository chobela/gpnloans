<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME','u471266640_userone');
define('DB_PASSWORD', 'Theres@1#');
define('DB_DATABASE', 'u471266640_dbone');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}


$branch = $_GET['branch'];

$sql= "SELECT branchname, username, datadb FROM branches WHERE id = '$branch'";

$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);   

session_unset();
session_start();
$_SESSION['dbusername'] = $row['username'];
$_SESSION['datadb'] = $row['datadb'];
$_SESSION['branchname'] = $row['branchname'];

echo $row['branchname'];
?>