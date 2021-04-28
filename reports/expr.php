<?php
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT * FROM expenses WHERE date > '$start' AND date < '$end'";
$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


array_push($result,
array('Item'=> $row[1],
'cost'=> 'K'.number_format($row[2],2),
'date'=> $row[3]
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>