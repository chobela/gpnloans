<?php
include("../config.php");
include("../App.php");

$app = new App();

$var = $_GET['paydate']; 

$x = date('Y-m-d H:i:s', strtotime($var));
$paydate = date("Y-m-t", strtotime($x));

$sql = "SELECT id AS emp, title, fname, lname, salary + allowance AS fullsalary FROM employees";
$res = mysqli_query($db,$sql);


$result = array();
while($row = mysqli_fetch_array($res)){

$emp = $row[0];
$salary = $row[4];
$name = $row[1] .' '. $row[2] .' '. $row[3];
$paye = $app->paye($emp);
$napsa = $app->napsa($emp);

$i = 0.01;
$insurance = $i * $salary;

$advance = $app->advance($emp,$paydate);
$commission = $app->commissions($emp, $paydate);

$payout = $salary + $commission - $paye + $napsa - $insurance + $advance;


array_push($result,
array('name'=> $name,
'basic salary'=> number_format($salary,2),
'paye'=> -abs(number_format($paye,2)),
'napsa'=> $napsa,
'health'=> -abs(number_format($insurance,2)),
'advance'=> $advance,
'commission'=> number_format($commission,2),
'net'=> number_format($payout,2),
'netx'=> $payout
));
}
//echo json_encode(array("data"=>($result)));
//header('Content-type: application/json; charset=utf-8');

//$rz = $result[7];

//echo array_map('array_sum', $result[7]);
echo array_sum(array_column($result, 'netx'));

mysqli_close($db);
?>

