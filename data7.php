<?php
header('Content-Type: application/json');

require_once('config.php');

$sqlQuery = "SELECT SUM(loans.amount) AS principal, DATE_FORMAT(loan_date, '%d/%m/%Y') AS type FROM loans GROUP BY loan_date ORDER BY loan_date DESC LIMIT 20";

$result = mysqli_query($db,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($db);

echo json_encode($data);
//echo array_sum($data['interest']);
?>