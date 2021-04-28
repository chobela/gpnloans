<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_PASSWORD', 'theresa1');


$db = mysqli_connect(DB_SERVER, $_SESSION['dbusername'],DB_PASSWORD,$_SESSION['datadb']);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

?>
