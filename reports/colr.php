<?php
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT SUM(loans.amount) AS principal, SUM(payments.amount) AS collected, date FROM payments LEFT JOIN loans ON payments.loanid = loans.id WHERE date > '$start' AND date < '$end' GROUP BY date ORDER BY date ASC";
$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


array_push($result,
array('principal'=> 'K'.number_format($row[0],2),
'collected'=> 'K'.number_format($row[1],2),
'date'=> $row[2]
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>

