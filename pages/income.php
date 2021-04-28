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
<style type="text/css">
  label {
    font-weight: normal;
}
</style>


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
   Income Statement
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    
<div class="row">
        <!-- left column -->
<div class="col-md-9">
 <div class="box box-info">

 

<div class="box-body">

      <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

     <div class="form-group">
            <div class="col-md-5">
                    <label style="font-weight: bold;" class="col-md-3 control-label pull-left">Year</label>                      
                    <div class="col-md-9">
                        <select class="form-control" name="year" id="year">
                            <option value="2020">2020</option>
                             <option value="2021">2021</option>
                              <option value="2022">2022</option>
                               <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                 <option value="2025">2025</option>
                                  <option valu0="2026">2026</option>                
                        </select>
                    </div>
                </div>
      <div class="col-md-5">
                    <label style="font-weight: bold;" class="col-md-3 control-label pull-left">Month</label>                      
                    <div class="col-md-9">
                        <select class="form-control" name="month" id="month">
                            <option value="0">Select</option>
                             <?php 
                           $resc = $app->getmonths();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[monthname]</option>";
                              }
                          ?>
                        </select>
                    </div>
                </div>
                </div>

<div class="panel panel-default">
  <div class="row">
    <div style="text-align: center;" class="col-md-6 panel-heading"><label style="font-weight: bold;" class="control-label">Revenue</label>  </div>

     <div style="text-align: center;" class="col-md-6 panel-heading"><label style="font-weight: bold;" class="control-label">Expenses</label>  </div>
  </div>
  
</div>
    
   <div class="form-group">
    <div class="col-md-6">
      
   
                    <label  class="col-md-5">Interest from Collections</label>                      
                    <div class="col-md-7">
                        <input type="text" name="interest" class="form-control" id="interest" value="" disabled="">
                    </div>
                </div>

                <div class="col-md-6">
      
   
                    <label  class="col-md-5">Daily Expenses</label>                      
                    <div class="col-md-7">
                        <input type="text" name="loans" class="form-control" id="loans" value="500" disabled="">
                    </div>
                </div>
    </div>

    <div class="form-group">
    <div class="col-md-6">
       <label  class="col-md-5">Earnings from Sales</label>                      
                    <div class="col-md-7">
                        <input type="text" name="loans" class="form-control" id="loans" value="300" disabled="">
                    </div>
    </div>

<div class="col-md-6">
       <label  class="col-md-5">Salaries/Wages</label>                      
                    <div class="col-md-7">
                        <input type="text" name="wage" class="form-control" id="wage" value="">
                    </div>
    </div>


  </div>

 <div class="form-group">
  <div class="col-md-6">
     
  </div>

                     <div class="col-md-6">
      
   
                    <label  class="col-md-5">Interest in Savings</label>                      
                    <div class="col-md-7">
                        <input type="text" name="loans" class="form-control" id="loans" value="500" disabled="">
                    </div>
                    </div>
                </div>



   <div class="form-group">
    <div class="col-md-6">
       <label  class="col-md-5">Total Revenue</label>                      
                    <div class="col-md-7">
                        <input type="text" name="loans" class="form-control" id="loans" value="300" disabled="">
                    </div>
    </div>

<div class="col-md-6">
       <label  class="col-md-5">Total Expenses</label>                      
                    <div class="col-md-7">
                        <input type="text" name="loans" class="form-control" id="loans" value="" disabled="">
                    </div>
    </div>


  </div>

  <hr>

   <div class="form-group">
    <div class="col-md-6">

<label style="font-weight: bold;">Net Income : K 3400.00</label>

    </div>
  </div>
              


              </form>

 
            </div>
</div>
<!-- /.box -->
</div>
</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include ('../includes/footer.php');
 ?>
 
</div>

<script type="text/javascript">
  
$(document).ready(function(){
 
  // Initialize select2
  $("#debtor").select2();

});

</script>

<script type="text/javascript">


$("#month").change(function(){

var year = $('#year').val();
var month = $('#month').val();



 $.post("formposts.php",
    {
      mm_insert: "incomestatement",
      month: month,
      year: year
    },
    function(data){
     $('#interest').val(data);
    
  
    }, "text");
});

$("#year").change(function(){


var year = $('#year').val();
var month = $('#month').val();



 $.post("formposts.php",
    {
      mm_insert: "incomestatement",
      month: month,
      year: year
    },
    function(data,status){
      $('#interest').val(data);
    });

});

</script>

<script type="text/javascript">
  
$("#interest").change(function(){

var year = $('#year').val();
var month = $('#month').val();


 $.post("formposts.php",
    {
      mm_insert: "totalwage",
      month: month,
      year: year
    },
    function(data){
     $('#wage').val(data);
    
  
    }, "text");
});


</script>


 <?php
 include ('scripts.html');
 ?>


 
</body>
</html>