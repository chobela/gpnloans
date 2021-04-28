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
$did = $_GET['did'];


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
   Add New Loan
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
     <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    


 <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Loan Type</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="loantype" id="loantype">

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

                <?php $debtor = $app->singledebtor($did);?>

          
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Borrower</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="borrower" class="form-control" id="borrower" placeholder="" value="<?php echo $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname']; ?>" disabled>
                    </div>
                </div>

                 <div class="form-group">
                                    
                    <div class="col-sm-6">
                        <input type="hidden" name="debtor" class="form-control" id="debtor" placeholder="" value="<?php echo $debtor['id']?>">
                    </div>
                </div>

        
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Amount</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" value="">
                    </div>
                </div>

                    <div id="installmentspart" class="form-group"><label form="" class="col-sm-3 control-label">Installments</label>

                        <div class="col-sm-6">
                        <select class="form-control" name="installments" id="installments">
                          
                            <option value="0" selected=""></option>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                        </select>
                         </div>
               </div>


                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Loan Date</label>                      
                    <div class="col-sm-6">
                    	<div class="input-group date">
                    		
                    	
                    	 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="">
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
                        <input type="text" name="col_name" class="form-control" id="col_name" placeholder="Collateral Name" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Serial Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="serial" class="form-control" id="serial" placeholder="Serial Number" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelName" class="col-sm-3 control-label">Model Name</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelname" class="form-control" id="modelname" placeholder="Model Name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelNumber" class="col-sm-3 control-label">Model Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelnumber" class="form-control" id="modelnumber" placeholder="Model Number" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralColour" class="col-sm-3 control-label">Colour</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="color" class="form-control" id="color" placeholder="Color" value="">
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputCollateralCondition" class="col-sm-3 control-label">Condition</label>                      
                    <div class="col-sm-4">
                        <select class="form-control" name="col_condition" id="col_condtion">
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
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="">
                        <p>If collateral is with borrower, you should enter the address where it is located</p>
                    </div>
                </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_loan">


                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
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

<script>
$(document).ready(function() {


////////////
$('#loantype').change(function(){

var loantype = $('#loantype').val();

if (loantype == 7) {

 $('#installmentspart').hide();

} else {
   $('#installmentspart').show();
}

});

});
</script>
 
</body>
</html>