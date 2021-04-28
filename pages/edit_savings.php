<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;

$idd = $_GET['idd'];
$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$product = $app->getsavingstypeById($idd);

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
   Edit Savings Product
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-warning">
 	 <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
	


 	 	 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Name of Savings Account</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="sname" class="form-control" id="sname" required="" value="<?php echo $product['name'];?>">
                          
                    </div> 
         </div>

           <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Account Code</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="scode" class="form-control" id="scode" required="" value="<?php echo $product['scode'];?>">
                          <p>Three(3) Characters that will be appended to the account number to be identified with this account. e.g, if code here is ABC, Then acc number will be ABC123456</p>
                          
                    </div> 
         </div>

               <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Savings Duration (Days)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="duration" class="form-control" id="duration" required="" value="<?php echo $product['duration'];?>">
                          
                    </div> 
              </div>

          

          	 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Minimum Balance</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="minbalance" class="form-control" id="minbalance" required="" value="<?php echo $product['minbalance'];?>">
                          <p>The lowest amount of money that one can have in the account, and cannot be withdrawn unless on account duration end.</p>
                    </div> 
         </div>

         <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Interest Earned</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="int_period" id="int_period">
                        	
                          <option value="<?php echo $product['intperiod'];?>" selected=""><?php echo $product['period'];?></option>
                        	<option value="1">Daily</option>
                        	<option value="2">Weekly</option>
                        	<option value="3">Bi-Weekly</option>
                          <option value="4">Monthly</option>
                          <option value="5">Annually</option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Interest earned on Savings (%)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="interest" class="form-control" id="interest" required="" value="<?php echo $product['interest'];?>">
                          <p>The percentage of Interest to be earned on savings.</p>
                    </div> 
                </div>
                           

                     <div class="form-group">
                    
                    <label for="sms" class="col-sm-3 control-label">SMS Notification when interest has been automatically topped up</label>                      
                    <div class="col-sm-6">
                        
                       <textarea class="form-control" rows="3" name="notification"><?php echo $product['notification'];?></textarea>
                      
                    </div> 
                </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_product">
                   <input type="hidden" name="idd" class="form-control" id="idd" value="<?php echo $product['idd']?>">

                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location='loantypes.php'">Back</button>
                    <button type="submit" class="btn btn-warning pull-right submit-button">Update</button>
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