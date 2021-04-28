<?php
session_start();
require("../session.php");

include('../../App.php');

$app = new App();

$res = $app->getpurchases();

$result = array();
while($row = mysqli_fetch_array($res)){

	 // Update Button
    $updateButton = '<a  href="editpurchase.php?id='.$row['id'].'" role="button" id="editpurchase" class="btn btn-default btn-xs">
      <span class="fa fa-edit" aria-hidden="true"></span> 
    </a>';

     // Delete Button
     $deleteButton = '<a type="button" id="'.$row['id'].'" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
    </a>';


     $action = $updateButton." ".$deleteButton;
    

array_push($result,
array('id'=> $row[0],
'item'=> $row[1],
'amount'=> $row[2],
'price_per_bag'=> $row[3],
'bags'=> $row[4],
'buyer_id'=> $row[5],
'pdate'=> $row[6],
'ydate'=> $row[7],
'status'=> $row[8],
'st'=> $row[9],
'seller'=> $row[10].' '.$row[11].' '.$row[12],
'action'=>$action
));
}

echo json_encode(array("data"=>($result)));


?>