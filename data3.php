<?php
header('Content-Type: application/json');

require_once('config.php');

$sqlQuery = "SELECT SUM(payments.amount) AS interest, DATE_FORMAT(payments.date, '%d/%m/%Y') AS type FROM payments GROUP BY payments.date ORDER BY payments.date DESC LIMIT 20";

$result = mysqli_query($db,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($db);

echo json_encode($data);
//echo array_sum($data['interest']);
?>