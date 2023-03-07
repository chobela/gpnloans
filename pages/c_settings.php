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
   Company Settings
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
   <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">




      <div class="form-group">
                    
                    <img class="col-sm-5 pull-left" src="../dist/img/<?php echo $settings['logo']?>" alt="Company logo" style="width:160px;height:160px;">    

              
         </div>

         <hr>


         <div class="form-group">
                 <label form="" class="col-sm-4 control-label">Update Company Logo</label>
                   <div class="col-sm-8">
                  <input type="file" id="file" name="file">

                </div>
         </div>



     <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-4 control-label">Company Name</label>                      
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="name" required="" value="<?php echo $settings['appname']?>">
                          
                    </div> 
         </div>

             <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-4 control-label">Opening Cash Balance</label>                      
                    <div class="col-sm-8">
                        <input type="text" name="obalance" class="form-control" id="obalance" value="<?php echo $settings['obalance']?>">
                        
                          
                    </div> 
         </div>

            <div class="form-group">
                <div class="col-sm-4"></div>
                     <div class="checkbox col-sm-8">
                  <label>
                    <input name="sms1" type="checkbox" <?php if($settings['sms1'] == '1'){echo 'checked';}?> > Send SMS when adding a new Borrower
                  </label>
                </div>
            </div>

             <div class="form-group">
                <div class="col-sm-4"></div>
                     <div class="checkbox col-sm-8">
                  <label>
                    <input name="sms2" type="checkbox" <?php if($settings['sms2'] == '1'){echo 'checked';}?>> Send SMS when giving a loan
                  </label>
                </div>
            </div>

             <div class="form-group">
                <div class="col-sm-4"></div>
                     <div class="checkbox col-sm-8">
                  <label>
                    <input name="sms3" type="checkbox" <?php if($settings['sms3'] == '1'){echo 'checked';}?>> Send SMS when entering payment
                  </label>
                </div>
            </div>
         

            </div>

                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="update_config">
              

                   <div class="box-footer">
                  
                    <button type="submit" class="btn btn-info pull-right submit-button">Update</button>
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