<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;
$settings = $app->appsettings();


$id = $_GET['id'];


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
  Edit Purchase
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
     <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    
<?php

$p = $app-> getPurchase_bi_id($id);

?>



   <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Item</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Item" value="<?php echo $p['item']?>" name="item" id="item">
     
                    </div>
                </div>

                  <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Amount</label>                      
                    <div class="col-sm-6">
                        <input type="number" class="form-control" placeholder="Amount" value="<?php echo $p['amount']?>" name="amount" id="amount">
     
                    </div>
                </div>

                   <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Price per Bag</label>                      
                    <div class="col-sm-6">
                        <input type="number" class="form-control" placeholder="Price per Bag" value="<?php echo $p['price_per_bag']?>" name="price" id="price">
     
                    </div>
                </div>

                   <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Number of Bags</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Bags" value="<?php echo $p['bags']?>" name="bags" id="bags">
     
                    </div>
                </div>

                    <div class="form-group">
                        <label form="" class="col-sm-3 control-label">Edit Seller</label>
                         <div class="col-sm-6">
                           <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="debtor" id="debtor">


                              <?php 
                               $resc = $app->getdebtornames();
                                  foreach($resc as $r) { 
                                    echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                                  }
                              ?>

                              <option value="<?php echo $p['did']?>" selected><?php echo  $p['title'].' '.$p['fname'].' '. $p['lname'];?></option>
                     
                          </select>
                         
                        </div>
                    </div>

                          <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Purchase Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="pdate" class="form-control" id="datepicker" placeholder="Release Date" value="<?php echo date("d/m/Y",strtotime($p['pdate']));?>">
                        </div>
                    </div>
                </div>


            <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Return of Yield</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="ydate" class="form-control" id="datepicker2" placeholder="Return date" value="<?php echo date("d/m/Y",strtotime($p['ydate']));?>">
                        </div>
                    </div>
                </div>


                         <div class="form-group">
                        <label form="" class="col-sm-3 control-label">Edit Status</label>
                         <div class="col-sm-6">
                           <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="status" id="status">


                              <?php 
                               $resc = $app->getstatuses();
                                  foreach($resc as $r) { 
                                    echo "<option value=\"$r[id]\">$r[status]</option>";
                                  }
                              ?>

                              <option value="<?php echo $p['status']?>" selected><?php echo  $p['st'];?></option>
                     
                          </select>
                         
                        </div>
                    </div>

      
                 <hr>

            </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_purchase">
                  <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $id?>">
                 
                  
                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Update</button>
                </div>
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