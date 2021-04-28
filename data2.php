<?php
header('Content-Type: application/json');

require_once('config.php');

$sqlQuery = "SELECT SUM(loan_types.interest / 100 * payments.amount) AS interest, DATE_FORMAT(payments.date, '%d/%m/%Y') AS type FROM loan_types JOIN loans ON loan_types.id = loans.loantype RIGHT JOIN payments ON loans.id = payments.loanid GROUP BY payments.date ORDER BY payments.date DESC LIMIT 20";

$result = mysqli_query($db,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($db);

echo json_encode($data);
//echo array_sum($data['interest']);
?>