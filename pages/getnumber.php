<?php
include('../config.php');

$did = '229';

$sql = mysql_query($db,"SELECT mobile_no AS number FROM debtors WHERE id = '$did'");

$result = mysqli_fetch_accoc($sql);

echo $result['number'];


?>