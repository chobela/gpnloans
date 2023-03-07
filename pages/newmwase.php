<?php
$link = mysqli_connect("localhost", "u471266640_userone", "Theres@1#", "u471266640_dbone");

/* check connection */
if (mysqli_connect_errno()) {

    exit();
}

  $loanid = $_POST['loanid'];
  $loantype = $_POST['loantype'];
  $debtor = $_POST['debtor'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $duedate = $_POST['due_date'];
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

  $loan_date = date('Y-m-d', strtotime($date));
  $due = date('Y-m-d', strtotime($duedate));


  $query = "INSERT INTO loans (loantype, debtor, amount, balance, col_name, serialnumber, model_name, modelnumber, color, col_condition, address, loan_date, due_date) VALUES ('$loantype', '$debtor', '$amount', '$balance', '$colname', '$serial', '$modelname', '$modelnumber', '$color', '$col_condition', '$address', '$loan_date', '$due')";

  mysqli_query($link, $query);

/* close connection */
mysqli_close($link);

  header('location:editloan.php?lid='.$loanid);
?>