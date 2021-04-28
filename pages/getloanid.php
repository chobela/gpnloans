<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$did= $_GET['did'];
//Checking injection attack
if(!is_numeric($did)){
echo "Data Error";
exit;
 }
/// end of checking injection attack ////

require ("../config.php");

$sql = "SELECT loans.id AS lid, loan_name FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id WHERE loans.debtor = '$did' AND loans.balance > 0 ORDER BY lid ASC";

$main = array();
$res = mysqli_query($db,$sql);
//$result = mysqli_fetch_array($res,MYSQLI_NUM);


while($row = mysqli_fetch_array($res,MYSQLI_NUM)){
array_push($main,
array('lid'=>$row[0],
'loan_name'=>$row[1]
));
}


$final = array("data"=>$main);

echo json_encode($final);



header('Content-Type: application/json');


mysqli_close($db);

?>