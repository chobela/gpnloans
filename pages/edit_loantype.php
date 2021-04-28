<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$loanid = $_GET['id'];

$loantype = $app->singleloantypes($loanid);

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
   Edit Loan-Type <?php echo '('.$loantype['loan_name'].')'?>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
   <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
  


     <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Name of Loan</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name" required="" value="<?php echo $loantype['loan_name']?>">
                          <p>The name of the loan. e.g : Business Loan / Personal Loan / Student Loan, etc..</p>
                    </div> 
         </div>

             <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Loan Duration (Days)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="days" class="form-control" id="days" required="" value="<?php echo $loantype['days']?>">
                          
                    </div> 
         </div>


             <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Minimum Principal Amount</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="minamount" class="form-control" id="minamount" required="" value="<?php echo $loantype['min_principal_amount']?>">
                          <p>The lowest amount of money that one can borrow under this loan type.</p>
                    </div> 
         </div>

         <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Collateral Based</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="collateral" id="collateral">
                          
        <option selected value="<?php echo $loantype['collateral_based']?>">

       <?php

        if ($loantype['collateral_based'] = 1) {
          echo 'Yes';
        } else {
          echo 'No';
        }


       ?>
          

        </option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                         
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Interest Rate(%)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="intrate" class="form-control" id="intrate" required="" value="<?php echo $loantype['interest']?>">
                          <p>The percentage of Interest to be charged on this loan</p>
                    </div> 
                </div>
                 <hr>

        <div class="panel panel-default"><div class="panel-body bg-gray text-bold">Penalty Settings (Required fields):</div>



    </div>

            </div>

              <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Grace Period</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="grace" class="form-control" id="grace" required="" value="<?php echo $loantype['grace_period']?>">
                          <p>Number of Days of Grace Period of defaulting the loan.</p>
                    </div> 
                </div>

                 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Interest Rate after default.</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="intdefault" class="form-control" id="intdefault" required="" value="<?php echo $loantype['penalty_interest_rate']?>">
                          <p>The interest rate charged on initial interest.</p>
                    </div> 
                </div>

                 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Penalty Pay back period</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="paybackperiod" class="form-control" id="paybackperiod" required="" value="<?php echo $loantype['penalty_payment_period']?>">
                          <p>Number of days of penalty payback. <strong>(Default days  is '0')</strong> if the whole amount is to be re-loaned</p>
                    </div> 
                </div>

               <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">SMS & Eamil Reminder</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="msg1" class="form-control" id="msg1" required="" value="<?php echo $loantype['msg1']?>">
                          <p>Enter the number of days before the due date, when reminder should be sent. Default is <strong>7</strong> days before.</p>
                          <p>* An automatic reminder is sent by the system on the due date of the Loan.</p>
                    </div> 
                </div>

                     <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">SMS & Eamil Message</label>                      
                    <div class="col-sm-6">
                        
                       <textarea class="form-control" rows="3" name="msg2txt"><?php echo $loantype['msg2text']?></textarea>
                      
                          <p>Message to be sent out at 09hrs on the due date.</p>
                    </div> 
                </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_loantype">
                  <input type="hidden" name="loanid" class="form-control" id="loanid" value="<?php echo $loanid ?>">

                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location='loantypes.php'">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Submit</button>
                </div><!-- /.box-footer -->
   </form>
</div>
<!-- /.box -->


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