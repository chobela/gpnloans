<?php
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT SUM(loan_types.interest / 100 * payments.amount) AS interest FROM loan_types JOIN loans ON loan_types.id = loans.loantype RIGHT JOIN payments ON loans.id = payments.loanid WHERE payments.date > '$start' AND payments.date < '$end'";
$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


array_push($result,
array('Total Earnings'=> 'K'.number_format($row[0],2)
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>

