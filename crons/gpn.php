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



$balance = $app->gpnreminder();


/********** Begin Send SMS *********/



      $sms->Debtor = '1234567';

      $sms->Destination = '260974115179';
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'Goodmorning GPN-LOANS, You have a total of K'.number_format($balance).' due for collection today.';
      
      $sms->sendSMS();
    
  
  
  
/********** End Send SMS *********/

?>