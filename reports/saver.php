<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

//SELECT * FROM transactions LEFT JOIN transtypes ON transactions.transtype = transtypes.id
$sql = "SELECT * FROM transactions LEFT JOIN transtypes ON transactions.transtype = transtypes.id WHERE transdate > '$start' AND transdate < '$end'";

$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){

array_push($result,
array('Acc Type'=> $row[1],
'Transaction'=> $row[7],
'Acc Number'=> $row[2],
'Amount'=> number_format($row[4],2),
'Date'=> $row[5]
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
