<?php
header('Content-Type: application/json');

require_once('config.php');

#$sqlQuery = "SELECT Month(loans.loan_date), SUM(loans.amount) AS principal, SUM(loans.balance) AS balance, months.monthname AS type FROM loans JOIN months ON Month(loans.loan_date) = months.id GROUP BY Month(loans.loan_date), type ORDER BY Month(loans.loan_date) ASC";

$sqlQuery = "SELECT SUM(loans.amount) AS principal, SUM(loans.balance) AS balance, YEAR(loan_date) AS year, MONTH(loan_date) AS month, CONCAT(MONTHNAME(loan_date),', ', YEAR(loan_date)) AS type FROM loans GROUP BY YEAR(loan_date), MONTH(loan_date) ORDER BY year DESC, month DESC LIMIT 12";

$result = mysqli_query($db,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($db);

echo json_encode($data);
?>