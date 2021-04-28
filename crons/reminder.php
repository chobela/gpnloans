<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
$dir = realpath(__DIR__ . '/..');

session_start();
$_SESSION['dbusername'] = "u859960976_user";
$_SESSION['datadb'] = "u859960976_gpn";

include ($dir.'/App.php');
include ($dir.'/pages/SMS.php');

$app = new App();
$sms = new SMS();



  $sql = $app->reminder();

  while($res=mysqli_fetch_array($sql))

  {

  	// Creating timestamp from given date
$timestamp = strtotime($res['due_date']);
$new_date = date("d-m-Y", $timestamp);

$debtor = $res['title'].' '.$res['fname'].' '.$res['lname'];

$msg = 'Hello '.$debtor.','.' Please be reminded that your balance of K'.number_format($res['balance']).' is due on '.$new_date.'. GPN Loans - Your Business partner!' ;

/********** Begin Send SMS *********/
      $sms->Debtor = $res['id'];

      $sms->Destination = $res['mobile_no'];
      
      $sms->SenderAddress = 'GPN loans';
      
      $sms->Message  = $msg;
      
      $sms->sendSMS();
  
/********** End Send SMS *********/


  	
  }


?>