<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$eid= $_GET['eid'];

/// end of checking injection attack ////

require ("../config.php");

$sql = "SELECT * FROM advances WHERE eid = '$eid' AND paydate > CURDATE()";

$res = mysqli_query($db,$sql);
$rowcount=mysqli_num_rows($res);

echo $rowcount;


?>