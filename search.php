<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("config.php");



if ($_POST['debtor']!=""){

$debtor = $_POST['debtor'];

	$sql = "SELECT id FROM debtors WHERE MATCH ( `fname`, `lname` ) AGAINST ('$debtor') LIMIT 1";
	$result = mysqli_query($db, $sql);

	$row = mysqli_fetch_assoc($result);

if ($sql) {
    header('Location: pages/singleloans.php?did='.$row['id']);
}
	
}
	
?>