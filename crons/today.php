<?php
include('../pages/SMS.php');
$link = mysqli_connect("localhost", "u859960976_user", "theresa1", "u859960976_gpn");

/* check connection */
if (mysqli_connect_errno()) {

    exit();
}

$date = date('Y-m-d');
$sms = new SMS();

$query = "SELECT debtors.id AS did, fname, lname, mobile_no AS number, loans.balance FROM debtors LEFT JOIN loans on debtors.id = loans.debtor WHERE loans.due_date = '$date'";


$result = mysqli_query($link, $query);

/********** Begin Send SMS *********/


  while($row=mysqli_fetch_array($result)){

      $sms->Debtor = $row['did'];

      $sms->Destination = $row['mobile_no'];
      
      $sms->SenderAddress = 'gpn loans';
      
      $sms->Message  = 'Hello '.$row['fname'].' '.$row['lname'].'. Your loan of K'.$row['balance']. ' is due today. Please make payment today. Thank you.';
      
      $sms->sendSMS();
    
  }
  
  
/********** End Send SMS *********/

/* close connection */
mysqli_close($link);
?>