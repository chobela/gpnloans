<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$dbusername = $_SESSION ['dbusername'];
$datadb = $_SESSION ['datadb'];


define('DB_SERVER', 'localhost');
define('DB_USERNAME', $dbusername);
define('DB_PASSWORD', 'Theres@1#');
define('DB_DATABASE', $datadb);

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}


$nrc = $_GET['nrc'];


$sql= "SELECT id FROM debtors WHERE unique_no = '$nrc'";

$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);   

	


if(!isset($row['id'])){

	echo "You do not qualify to apply. <a href='https://gpnloans.com/admin/register.php?link=add&did=0'>Click here to create an account.</a>";

} else {

	$did = $row['id'];


    $sql2 = "SELECT SUM(balance) AS balance, debtor FROM loans WHERE debtor = '$did' AND balance > '0'";

    $result2 = mysqli_query($db,$sql2);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

    	if(isset($row2['balance'])){

    		echo 'You do not qualify to apply. You still have an outstanding balance of ' . '<span style="color:red">K'.$row2['balance'].'</span>';

    	} else {

         echo $did;
      }

}




?>