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
   Add Advance
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
   <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">


   <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Select Employee</label>
                     <div class="col-sm-6">
                       <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="employee" id="employee">

 <option value="0" selected></option>
                          <?php 
                           $resc = $app->allemp();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                              }
                          ?>
                 
                      </select>
                 
                     
                    </div>
                </div>

                    <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-3 control-label">Amount (ZMW)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="amount" class="form-control" id="amount" required="" value="">
                                                    
                    </div> 
                 
                    </div>

          
                <div class="form-group"><label form="" class="col-sm-3 control-label">Installments</label>

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
                    
                    <label class="col-sm-3 control-label"></label>                      
                    <div class="col-sm-6">
                       <p style="color:red;" id="payback"></p>
                                                    
                    </div> 
                 
                    </div>

         
         

                 <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_advance">

    </div>
                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Save</button>
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

    // Initialize select2
$("#employee").select2();

////////////
$('#employee').change(function(){

var eid = $('#employee').val();


$('#payback').empty(); //remove all existing options
///////
$.get('checkadvance.php',{'eid':eid},function(return_data){


  if(return_data > 0){

    $('#payback').html('Employee has a pending advance payment.');
    $("#amount").attr("disabled", "disabled");


    
  }else{

  $('#payback').html('');
}
},"text");

///////
});
/////////////////////
});
</script>
 
</body>
</html>