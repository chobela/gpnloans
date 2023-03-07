<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
require("SMS.php");

$app = new App;
$sms = new SMS;

$form = $_POST['mm_insert'];
$systuser = $_SESSION ['firstname'];

$smstype = $app->sms_settings();

if ($form == 'add_debtor') {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $business = $_POST['business'];
  $uid = $_POST['uid'];
  $gender = $_POST['gender'];
  $title = $_POST['title'];
  $p = $_POST['phone'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $province = $_POST['province'];
  $landline = $_POST['landline'];
  $status = $_POST['status'];
  $photo = $_FILES['bpic'];
  $photoname = $photo['name'];
  $idpic = $_FILES['bid'];
  $idpicname = $idpic['name'];
  $docs = $_FILES['file']['name'];

  $phone = '26'.$p;


  $debtor = $app->add_debtor($firstname, $lastname, $business, $uid, $gender, $title, $phone, $email, $dob, $address, $city, $province, $landline, $status, $photo, $photoname, $idpic, $idpicname, $docs);

  $phone = $app->get_debtor_phone($debtor);

  if($smstype['sms1'] == '1' ){

    /********** Begin Send SMS *********/
      $sms->Debtor = $debtor;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'Dear customer, your application form was uploaded successfully. Please wait for approval through SMS in the next few minutes. GPN LOANS your business partner';
      
      $sms->sendSMS();
  
/********** End Send SMS *********/
}
  header('location:debtors.php');

} else if ($form == 'reg_debtor') {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $business = $_POST['business'];
  $uid = $_POST['uid'];
  $gender = $_POST['gender'];
  $title = $_POST['title'];
  $p = $_POST['phone'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $province = $_POST['province'];
  $landline = $_POST['landline'];
  $status = $_POST['status'];
  $photo = $_FILES['bpic'];
  $photoname = $photo['name'];
  $idpic = $_FILES['bid'];
  $idpicname = $idpic['name'];
  $docs = $_FILES['file']['name'];

  $phone = '26'.$p;


  $debtor = $app->reg_debtor($firstname, $lastname, $business, $uid, $gender, $title, $phone, $email, $dob, $address, $city, $province, $landline, $status, $photo, $photoname, $idpic, $idpicname, $docs);

  $phone = $app->get_debtor_phone($debtor);

  if($smstype['sms1'] == '1' ){

    /********** Begin Send SMS *********/
      $sms->Debtor = $debtor;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'Dear customer, your application form was uploaded successfully. Please wait for approval through SMS in the next few minutes. GPN LOANS your business partner';
      
      $sms->sendSMS();
  
/********** End Send SMS *********/
}
  header('location:../../index.php');

} 

else if ($form == 'add_employee') {


  $title = $_POST['title'];
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $p = $_POST['phone'];
  $nrc = $_POST['nrc'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $employer = $_POST['employer'];
  $paymethod = $_POST['paymethod'];
  $department = $_POST['department'];
  $salary = $_POST['salary'];
  $occupation = $_POST['occupation'];
  $ssnumber = $_POST['ssnumber'];
  $bank = $_POST['bank'];
  $branchcode = $_POST['branchcode'];
  $accnumber = $_POST['accnumber'];

  $photo = $_FILES['bpic'];
  $photoname = $photo['name'];
  $idpic = $_FILES['bid'];
  $idpicname = $idpic['name'];

  $phone = '26'.$p;


  $app->add_employee($title, $fname, $lname, $address, $gender, $phone, $nrc, $email, $dob, $city, $state, $country, $employer, $paymethod, $department, $salary, $occupation, $bank, $branchcode, $accnumber, $photo, $photoname, $idpic, $idpicname);

  header('location:employees.php');

} 

//edit_user

else if ($form == 'edit_user') {

  $uid = $_POST['uid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];
  $action = 'edited details for '.$firstname;


  $app -> edituser($uid, $firstname, $lastname, $role, $email, $username, $password, $status);

  $app-> action($systuser, $action);

   header('location:users.php');

}

else if ($form == 'deleteDebtor') {

  $id = $_POST['id'];


  $app -> deleteDebtor($id);

}

else if ($form == 'deleteEmp') {

  $id = $_POST['id'];


  $app -> deleteEmp($id);

}

else if ($form =='getEmpInfo'){

  $id = $_POST['id'];


  $app -> getEmpInfo($id);
}

 else if ($form == 'freezeLoan') {

  $id = $_POST['id'];
  $f = $_POST['f'];

  $app -> freezeLoan($id,$f);

} else if ($form == 'reset') {

  $id = $_POST['id'];
  
  echo $app -> resetBalance($id);

}
 else if ($form == 'deleteUser') {

  $uid = $_POST['id'];

  $app -> deleteUser($uid);

} else if ($form == 'deleteExpense') {

  $exp = $_POST['id'];

  $app -> deleteExpense($exp);

} else if ($form == 'deleteSale') {

  $sale = $_POST['id'];

  $app -> deleteSale($sale);

} else if ($form == 'deletePurchase') {

  $p = $_POST['id'];

  $app -> deletePurchase($p);

}

 else if ($form == 'deleteProduct') {

  $pid = $_POST['id'];

  $app -> deleteProduct($pid);

} 

 else if ($form == 'update_debtor') {

   $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $business = $_POST['business'];
  $uid = $_POST['uid'];
  $gender = $_POST['gender'];
  $title = $_POST['title'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $province = $_POST['province'];
  $landline = $_POST['landline'];
  $status = $_POST['status'];
  $photo = $_FILES['bpic'];
  $photoname = $photo['name'];
  $idpic = $_FILES['bid'];
  $idpicname = $idpic['name'];
  $docs = $_FILES['file']['name'];
  $did = $_POST['did'];
 // $action = 'edited details for '.$firstname;


  $app->update_debtor($did, $firstname, $lastname, $business, $uid, $gender, $title, $phone, $email, $dob, $address, $city, $province, $landline, $status, $photo, $photoname, $idpic, $idpicname, $docs);

   // $app-> action($systuser, $action);


  header('location:debtors.php');

} 

 else if ($form == 'update_employee') {

  $eid = $_POST['eid'];
  $title = $_POST['title'];
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $p = $_POST['phone'];
  $nrc = $_POST['nrc'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $employer = $_POST['employer'];
  $paymethod = $_POST['paymethod'];
  $department = $_POST['department'];
  $salary = $_POST['salary'];
  $occupation = $_POST['occupation'];
  $ssnumber = $_POST['ssnumber'];
  $bank = $_POST['bank'];
  $branchcode = $_POST['branchcode'];
  $accnumber = $_POST['accnumber'];

  $photo = $_FILES['bpic'];
  $photoname = $photo['name'];
  $idpic = $_FILES['bid'];
  $idpicname = $idpic['name'];

  $phone = '26'.$p;


 $app->update_employee($eid, $title, $fname, $lname, $address, $gender, $phone, $nrc, $email, $dob, $city, $state, $country, $employer, $paymethod, $department, $salary, $occupation, $bank, $branchcode, $accnumber, $photo, $photoname, $idpic, $idpicname);

 // $app-> action($systuser, $action);

  header('location:employees.php');



}

else if ($form == 'add_loantype') {

  $name = $_POST['name'];
  $days = $_POST['days'];
  $minamount = $_POST['minamount'];
  $collateral = $_POST['collateral'];
  $intrate = $_POST['intrate'];
  $grace = $_POST['grace'];
  $intdefault = $_POST['intdefault'];
  $paybackperiod = $_POST['paybackperiod'];
  $msg1 = $_POST['msg1'];
  $msg2txt = $_POST['msg2txt'];
 

  $app->add_loantype($name, $days, $minamount, $collateral, $intrate, $grace, $intdefault, $paybackperiod, $msg1, $msg2txt);

  header('location:loantypes.php');

} else if ($form == 'edit_loantype') {

  $loantypeid = $_POST['loanid'];
  $name = $_POST['name'];
  $days = $_POST['days'];
  $minamount = $_POST['minamount'];
  $collateral = $_POST['collateral'];
  $intrate = $_POST['intrate'];
  $grace = $_POST['grace'];
  $intdefault = $_POST['intdefault'];
  $paybackperiod = $_POST['paybackperiod'];
  $msg1 = $_POST['msg1'];
  $msg2txt = $_POST['msg2txt'];
 

  $app->edit_loantype($loantypeid, $name, $days, $minamount, $collateral, $intrate, $grace, $intdefault, $paybackperiod, $msg1, $msg2txt);

  header('location:edit_loantype.php?id='.$loantypeid);

} else if ($form == 'add_product') {

  $sname = $_POST['sname'];
  $scode = $_POST['scode'];
  $duration = $_POST['duration'];
  $minbalance = $_POST['minbalance'];
  $intperiod = $_POST['int_period'];
  $interest = $_POST['interest'];
  $notification = $_POST['notification'];


  $app->add_product($sname, $scode, $duration, $minbalance, $intperiod, $interest, $notification);

  header('location:products');

} else if ($form == 'add_advance') {

  $employee = $_POST['employee'];
  $amount = $_POST['amount'];
  $inst = $_POST['installments'];

  $app->add_advance($employee, $amount, $inst);

  header('location:employees');

}  else if ($form == 'com') {

  $employee = $_POST['employee'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  $app->commission($employee, $amount, $date);

  header('location:employees');

}  

else if ($form == 'edit_user') {

  $uid = $_POST['uid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $rights = $_POST['rights'];
 

  $app->edit_user($uid, $firstname, $lastname, $role, $username, $password, $rights);

  header('location:u_settings.php');

} else if ($form == 'checkuser') {

  $uid = $_POST['uid']; 

  echo $app->checkuser($uid);

  
} else if ($form == 'edit_branch') {

  $bid = $_POST['bid'];
  $branchname = $_POST['branchname'];
  
 
  $app->edit_branch($bid, $branchname);

  header('location:branches.php');

} 

 else if ($form == 'add_comment') {

  $debtor = $_POST['debtor'];
  $comment = $_POST['comment'];

  $app->add_comment($debtor, $comment);

  header('location:singleloans.php?did='.$debtor);

}  

 else if ($form == 'incomestatement') {

  $year = $_POST['year'];
  $month = $_POST['month'];

    if (isset($_POST['month']) && isset($_POST['year']) ){
    echo $app->monthly_interest($month, $year);
  }

} 

 else if ($form == 'totalwage') {

  $year = $_POST['year'];
  $month = $_POST['month'];

    if (isset($_POST['month']) && isset($_POST['year']) ){
    echo $app->monthly_wage($month, $year);
  }

}  

else if ($form == 'send_sms') {

 $did = $_POST['debtor'];
 $phone = $_POST['phone'];
 $msg = $_POST['message'];

/********** Begin Send SMS *********/
      $sms->Debtor = $did;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = $msg;
      
      $sms->sendSMS();
  
/********** End Send SMS *********/

  header('location:singleloans.php?did='.$did);

} else if ($form == 'bulk_sms') {


 $msg = $_POST['message'];

/********** Begin Send SMS *********/
      
    $sql = $sms->bulkSMS($msg);

  while($row=mysqli_fetch_array($sql)){

      $sms->Debtor = $row['id'];

      $sms->Destination = $row['number'];
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = $msg;
      
      $sms->sendSMS();
  }
  
  
/********** End Send SMS *********/

  header('location:sendsms.php');

} 


else if ($form == 'add_loan') {


  $loantype = $_POST['loantype'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $colname = $_POST['col_name'];
  $serial = $_POST['serial'];
  $modelname = $_POST['modelname'];
  $modelnumber = $_POST['modelnumber'];
  $color = $_POST['color'];
  $col_condition = $_POST['col_condition'];
  $address = $_POST['address'];
  $inst = $_POST['installments'];


  $mysql_date = date('Y-m-d', strtotime($date));

  $app->add_loan($loantype, $debtor, $amount, $mysql_date, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address, $inst);

  $phone = $app->get_debtor_phone($debtor);

  $app->action(4,(-1 * $amount),$mysql_date);

  if ($smstype['sms2'] == '1'){


  /********** Begin Send SMS *********/
      $sms->Debtor = $debtor;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'Dear customer, your loan account has been credited with K'.$amount.'. Remember to use it wisely. GPN LOANS your business partner';
      
      $sms->sendSMS();
  
/********** End Send SMS *********/
}


  header('location:viewloans.php');

} 
else if ($form == 'application') {


  $loantype = $_POST['loantype'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $colname = $_POST['col_name'];
  $serial = $_POST['serial'];
  $modelname = $_POST['modelname'];
  $modelnumber = $_POST['modelnumber'];
  $color = $_POST['color'];
  $col_condition = $_POST['col_condition'];
  $address = $_POST['address'];
  $inst = $_POST['installments'];


  $mysql_date = date('Y-m-d', strtotime($date));

  $app->add_application($loantype, $debtor, $amount, $mysql_date, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address, $inst);

  $phone = $app->get_debtor_phone($debtor);



  /********** Begin Send SMS *********/
      $sms->Debtor = $debtor;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'Dear customer thank you for your application. We will contact you as soon as your loan ia aproved';
      
      $sms->sendSMS();
  
/********** End Send SMS *********/



  header('location:../index.php');

}  

else if ($form == 'edit_loan') {

  $loanid = $_POST['loanid'];
  $loantype = $_POST['loantype'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $balance = $_POST['balance'];
  $date = $_POST['date'];
  $duedate = $_POST['duedate'];
  $colname = $_POST['col_name'];
  $serial = $_POST['serial'];
  $modelname = $_POST['modelname'];
  $modelnumber = $_POST['modelnumber'];
  $color = $_POST['color'];
  $col_condition = $_POST['col_condition'];
  $address = $_POST['address'];
  $interest = $_POST['interest'];
  $currentbalance = $_POST['balance'];
  $oldprincipal = $_POST['oldprincipal'];


  $mysql_date = date('Y-m-d', strtotime($date));
  $mysql_date2 = date('Y-m-d', strtotime($duedate));

  $app->edit_loan($loanid, $loantype, $debtor, $amount, $balance, $mysql_date, $mysql_date2, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address);



  header('location:editloan.php?lid='.$loanid);

} else if ($form == 'new_mwase') {

  $loanid = $_POST['loanid'];
  $loantype = $_POST['loantype'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $colname = $_POST['col_name'];
  $serial = $_POST['serial'];
  $modelname = $_POST['modelname'];
  $modelnumber = $_POST['modelnumber'];
  $color = $_POST['color'];
  $col_condition = $_POST['col_condition'];
  $address = $_POST['address'];
  $interest = $_POST['interest'];
  $paymethod = $_POST['paymethod'];
  $balance = $_POST['balance'];
  $oldprincipal = $_POST['oldprincipal'];




  $mysql_date = date('Y-m-d', strtotime($date));

 $app->new_mwase($loanid, $loantype, $debtor, $amount, $balance, $mysql_date, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address, $paymethod);


  header('location:editloan.php?lid='.$loanid);

} 


 else if ($form == 'add_payment') {

  $loanid = $_POST['loanid'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  $mysql_date = date('Y-m-d', strtotime($date));

  $app->add_payment($loanid, $debtor, $amount,  $mysql_date);

  $balance = $app->loan_balance($loanid);

  $phone = $app->get_number($debtor);

$app->action('5', $amount,$mysql_date);

  if($smstype['sms3'] == '1'){

  /********** Begin Send SMS *********/
      $sms->Debtor = $debtor;

      $sms->Destination = $phone;
      
      $sms->SenderAddress = 'GPN Loans';
      
      $sms->Message  = 'You have successfully made payment of K'.$amount.' on '.$date.'. Your Balance is K'.$balance.'. Please pay to avoid penalties. GPN-Loans your business partner.';
      
      $sms->sendSMS();
  
/********** End Send SMS *********/

}
  header('location:payments.php');

} else if ($form == 'update_config') {

    $appname = $_POST['name'];
  $obalance = $_POST['obalance'];
  $file = $_FILES['file'];
  $filename = $file['name'];



     if( isset($_POST['sms1'])){
    $sms1 = '1';
  } else {
    $sms1 = '0';
  }

    if( isset($_POST['sms2'])){
    $sms2 = '1';
  } else {
    $sms2 = '0';
  }

      if( isset($_POST['sms3'])){
    $sms3 = '1';
  } else {
    $sms3 = '0';
  }

  if($file['size'] == 0 ){

    $app->edit_app_nologo($appname, $obalance);

  } else {

    $app->edit_app($appname, $obalance, $file, $filename);

  }

  $app->sms_set($sms1, $sms2, $sms3);


 // header('location:c_settings.php');

} else if ($form == 'edit_menus') {

  $menus = implode(",",$_POST['menu']);
  $uid = $_POST['uid'];


  $app->edit_menus($menus, $uid);


  header('location:u_settings.php');
  //echo $menus;


} else if ($form == 'edit_branches') {

  $branches = implode(",",$_POST['branch']);
  $uid = $_POST['uid'];


  $app->edit_branches($branches, $uid);


  header('location:u_settings.php');
  //echo $menus;

}

//

 else if ($form == 'add_group') {

  $groupid = rand(10000,99999);
  $groupname = $_POST['groupname'];
  $leader = $_POST['leader'];
  $members = $_POST['members'];
    array_push($members, $leader);
  

  $app->add_group($groupid, $groupname, $leader, $members);


             foreach ($members as $member)  {
                 
            $app->add_member($groupid, $member);

        };

         

  header('location:groups.php');

}  else if ($form == 'add_groupdebtors') {

  $gname =  $_POST['gname'];
  $groupid =  $_POST['gid'];
  $members = $_POST['members'];  

             foreach ($members as $member)  {
                 
            $app->add_member($groupid, $member);

        };

         

  header('location:groupdebtors.php?gid='.$groupid.'&gname='.$gname);

} 


else if ($form == 'deleteFromGroup') {

  $id = $_POST['id'];

  $app -> deleteFromGroup($id);

} else if ($form == 'deleteGroup') {

  $gid = $_POST['id'];

  $app -> deleteGroup($gid);

}  
 else if ($form == 'add_user') {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $menus = [1,2,3,4,5,8,9,11,12];
  $rights = 1;

  if ($role == '2') {
    $menus = [1,2,3,4,5,8,9,11];
    $rights = 1;

  } else if ($role == '3') {
  $menus = [1,2,3,4,5,8,9,11];
    $rights = 0;
  }

  $app -> add_user($firstname, $lastname, $role, $username, $password, $menus, $rights);

   header('location:u_settings.php');

}  else if ($form == 'add_acc') {

  $debtor = $_POST['debtor'];
  $accid = $_POST['accid'];
  $obalance = $_POST['obalance'];


  $app -> add_acc($debtor, $accid, $obalance);

   header('location:savings.php');

} else if ($form == 'sale_payment') {

  $saleid = $_POST['saleid'];
  $amount = $_POST['iamount'];

  $app -> sale_payment($saleid, $amount);

  header('location:sales.php');

}  

else if ($form == 'sale_paymentx') {

  $loanid = $_POST['loanid'];
  $amount = $_POST['iamount'];
  $colvalue = $_POST['colvalue'];
  $colname = $_POST['colname'];
  $date = $_POST['date'];


  $mysql_date = date('Y-m-d', strtotime($date));



  $app -> sale_paymentx($loanid, $amount, $mysql_date);
  $app -> stock_update($loanid);


  if($amount > $colvalue){

    $value = $amount - $colvalue;

    $app->add_income($colname.' Sale', $value, $mysql_date);

     $app->action('7', $amount,$mysql_date);

  } else if($amount < $colvalue) {

    $value = $colvalue - $amount;

     $app->add_expense($colname.' Sale', $value, $mysql_date);

     $app->action('9',(-1 * $amount),$mysql_date);

    
  }

  header('location:collateral.php');

}  

else if ($form == 'edit_product') {

  $idd = $_POST['idd'];
  $sname = $_POST['sname'];
  $scode = $_POST['scode'];
  $duration = $_POST['duration'];
  $minbalance = $_POST['minbalance'];
  $intperiod = $_POST['int_period'];
  $interest = $_POST['interest'];
  $notification = $_POST['notification'];


  $app->edit_product($idd, $sname, $scode, $duration, $minbalance, $intperiod, $interest, $notification);

  header('location:edit_savings.php?idd='.$idd);
}

else if ($form == 'edit_groupname') {

  $groupid = $_POST['groupid'];
  $groupname = $_POST['groupname'];


  $app->edit_groupname($groupid, $groupname);

  header('location:groups.php');
}

 else if ($form == 'add_trans') {

  $acctype = $_POST['acctype'];
  $trans = $_POST['trans'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $debtor = $_POST['debtor'];
  $accnum = $_POST['accnum'];
  $mysql_date = date('Y-m-d', strtotime($date));

  $action = $app -> add_trans($acctype, $trans, $amount, $mysql_date, $debtor, $accnum);

  header('location:acc.php?accnum='.$accnum.'&did='.$debtor.'&action='.$action);

} else if ($form == 'make_trans') {

  $loanid = $_POST['loanid'];
  $acctype = $_POST['acctype'];
  $trans = $_POST['trans'];
  $amount = $_POST['amountt'];
  $debtor = $_POST['debtorr'];
  $accnum = $_POST['accnum'];
 

  $action = $app -> make_trans($loanid, $acctype, $trans, $amount, $debtor, $accnum);

  header('location:acc.php?accnum='.$accnum.'&did='.$debtor.'&action='.$action);

}

else if ($form == 'add_expense') {

  $item = $_POST['item'];
  $cost = $_POST['cost'];
  $date = $_POST['date'];
  $mysql_date = date('Y-m-d', strtotime($date));
 
   $app -> add_expense($item, $cost, $mysql_date);

  header('location:expenses.php');

}

else if ($form == 'add_sale') {

  $item = $_POST['item'];
  $price = $_POST['price'];
  $debtor = $_POST['debtor'];
  $owing = $_POST['owing'];
  $inst = $_POST['inst'];
  
  $date1 = $_POST['date'];
  $date2 = $_POST['next'];

  $sdate = date('Y-m-d', strtotime($date1));
  $next = date('Y-m-d', strtotime($date2));
 
  echo $app -> add_sale($item, $price, $debtor, $owing, $inst, $sdate, $next);

   $app->action('10', $amount ,$mysql_date);

  header('location:sales.php');

} else if ($form == 'add_purchase') {

  $item = $_POST['item'];
  $amount = $_POST['amount'];
  $price = $_POST['price'];
  $bags = $_POST['bags'];
  $p = $_POST['pdate'];
  $y = $_POST['ydate'];
  $debtor = $_POST['debtor'];


  $pdate = date('Y-m-d', strtotime($p));
  $ydate = date('Y-m-d', strtotime($y));
 
  echo $app -> add_purchase($item, $amount, $price, $bags, $debtor, $pdate, $ydate);

  header('location:purchases.php');

}

else if ($form == 'edit_purchase') {

  $id = $_POST['id'];
  $item = $_POST['item'];
  $amount = $_POST['amount'];
  $price = $_POST['price'];
  $bags = $_POST['bags'];
  $p = $_POST['pdate'];
  $y = $_POST['ydate'];
  $debtor = $_POST['debtor'];
  $status = $_POST['status'];


  $pdate = date('Y-m-d', strtotime($p));
  $ydate = date('Y-m-d', strtotime($y));
 
  echo $app -> edit_purchase($id, $item, $amount, $price, $bags, $debtor, $pdate, $ydate, $status);

  header('location:purchases.php');

}

else if ($form == 'get_number') {

  $did = $_POST['did'];
 
   echo $app -> get_number($did);
} 



?>