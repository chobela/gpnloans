<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$branch = $_SESSION['branchname'];
$lid = $_GET['lid'];
$settings = $app->appsettings();

$loantype = $app->singleloantype($lid);
$d = $app->singleloandebtor($lid);
$amount = $app->applicationamount($lid);
$date = $app->applicationdate($lid);
$duedate = $app->applicationduedate($lid);
$col = $app->appliedloans($lid);
$loandebtor = $app->getapplieddebtor($lid);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $settings['appname']?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<?php include ('stylesheets.html');?>


</head>
<body class="hold-transition <?php echo $settings['appcolor'];?> fixed sidebar-mini">
<div class="wrapper">

<?php
include ('../includes/header.php');
include ('../includes/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
   Edit Loan Details for <?php echo  $d['title'].'.'. ' '.$d['fname'].' '.$d['lname'];?>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
     <form action="<?php

     if($branch == 'OLD MWASE'){
        echo 'newmwase.php';
        } else {
        echo 'formposts.php';
        }
 ?>" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    


 <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Loan Type</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="loantype" id="loantype">
                        <option value="<?php echo $loantype['loantypeid']?>" selected><?php echo $loantype['loan_name']?></option>
                            <?php 
                           $resc = $app->getloantypes();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[loan_name]</option>";
                              }
                          ?>
                          
                     
                        </select>
                        <p>Edit Loan Types <a href="loantypes.php">here</a></p>
                    </div>
                      
                </div>

             
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Principal Amount(K)</label>                      
                    <div class="col-sm-6">
                        <input type="number" class="form-control" placeholder="Amount" value="<?php echo $amount['amount']?>" name="amount" id="amount">
     
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Balance(K)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="xbalance" class="form-control" placeholder="Balance" value="<?php echo $amount['balance']?>" name="balance" id="xbalance">
      
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Loan Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="<?php
                              // Creating timestamp from given date
                              $timestamp = strtotime($date['loan_date']);
                               
                              // Creating new date format from that timestamp
                              $new_date = date("m/d/Y", $timestamp);
                              echo $new_date; // Outputs: 31-03-2019

                        ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Due Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="due_date" class="form-control" id="datepicker44" placeholder="Date" value="<?php
                              // Creating timestamp from given date
                              $timestamp = strtotime($duedate['due_date']);
                               
                              // Creating new date format from that timestamp
                              $due_date = date("m/d/Y", $timestamp);
                              echo $due_date; // Outputs: 31-03-2019

                        ?>">
                        </div>
                    </div>
                </div>


            

                 <hr>

  

            </div>


              
              <div class="panel panel-default"><div class="panel-body bg-gray text-bold">Collateral | (optional fields):</div>
                   </div>

                      <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Name of Collateral</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="col_name" class="form-control" id="col_name" placeholder="Collateral Name" value="<?php echo $col['col_name']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Serial Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="serial" class="form-control" id="serial" placeholder="Serial Number" value="<?php echo $col['serialnumber']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelName" class="col-sm-3 control-label">Model Name</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelname" class="form-control" id="modelname" placeholder="Model Name" value="<?php echo $col['model_name']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelNumber" class="col-sm-3 control-label">Model Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelnumber" class="form-control" id="modelnumber" placeholder="Model Number" value="<?php echo $col['modelnumber']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralColour" class="col-sm-3 control-label">Colour</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="color" class="form-control" id="color" placeholder="Color" value="<?php echo $col['color']?>">
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputCollateralCondition" class="col-sm-3 control-label">Condition</label>                      
                    <div class="col-sm-4">
                        <select class="form-control" name="col_condition" id="col_condtion">
                            <option value="<?php echo $col['col_condition']?>" selected><?php echo $col['condition']?></option>
                            <option value="0"></option>
                            <option value="1">Excellent</option>
                            <option value="2">Good</option>
                            <option value="3">Fair</option>
                            <option value="4">Damaged</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                
                    <label for="inputCollateralAddress" class="col-sm-3 control-label">Address</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?php echo $col['address']?>">
                        <p>If collateral is with borrower, you should enter the address where it is located</p>
                    </div>
                </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_loan">
                  <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $loandebtor['did']?>">
                  <input type="hidden" name="loanid" class="form-control" id="loanid" value="<?php echo $lid?>">
                  <input type="hidden" name="interest" class="form-control" id="interest" value="<?php echo $loantype['interest']?>">

            <input type="hidden" name="balance" class="form-control" id="balance" value="<?php echo $amount['balance']?>">
                   
            <input type="hidden" class="form-control" value="<?php echo $amount['amount']?>" name="oldprincipal" id="oldprincipal">
                  


                   <div class="box-footer">
            <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>

            <?php

            if($branch == 'OLD MWASE'){

                echo ' <button type="submit" class="btn btn-warning pull-right  submit-button">Send to New Mwase</button>';

            } else {

                 echo ' <button type="submit" class="btn btn-primary pull-right  submit-button">Save Changes</button>';
            }

            ?>
           
                  
                </div><!-- /.box-footer -->
     </form>
</div>
<!-- /.box -->
  <div class="box-footer"></div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include ('../includes/footer.php');
 ?>
 
</div>


 <?php
 include ('scripts.html');
 ?>


 
</body>
</html>