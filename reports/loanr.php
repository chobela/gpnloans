<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../App.php");
include("../config.php");

$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$app = new App();

$sql = "SELECT loan_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE loans.due_date > '$start' AND loans.due_date < '$end'";
$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){

 $amount =  $row[8];
 $interest =  $row[7];
 $x = $amount * $interest/100;
 $due = $amount + $x;

$paid = 'K '.number_format($app->getallpayments($row[1]),2);
$lastpay = $app->lastpaydate($row[1]);
  

array_push($result,
array('Release Date'=> $row[0],
'Borrower'=> $row[3].'.'. ' '.$row[4].' '.$row[5],
'Loan Type'=> $row[6],
'Principal'=> 'K '.number_format($row[8],2),
'Interest Rate'=> 'k '. number_format($row[7],2),
'Amount Due'=> 'K '.number_format($due,2),
'Paid'=> $paid,
'Balance'=> 'K '.number_format($row[9],2),
'Last Payment'=> $lastpay,
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>

