<?php
include_once("config.php");
$sqlEvents = "SELECT id, title, start_date, end_date, class FROM events";
$resultset = mysqli_query($db, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
// convert date to milliseconds
$start = strtotime($rows['start_date']) * 1000;
$end = strtotime($rows['end_date']) * 1000;
$class = $rows['class'];
$calendar[] = array(
'id' =>$rows['id'],
'title' => $rows['title'],
'url' => "#",
"class" => "$class",
'start' => "$start",
'end' => "$end"
);
}
$calendarData = array(
"success" => 1,
"result"=>$calendar);
echo json_encode($calendarData);
?>