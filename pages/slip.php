<?php

session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$eid = $_GET['eid'];
$emp = $app->employee($eid);
ob_start();


?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $emp['title']. ' '. $emp['fname'].' '. $emp['lname'];?></title>
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<?php include ('stylesheets.html');?>

<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>

</head>
<body>
	 

 
  <!-- Main content -->
    <section class="content">

 <div class="box box-default">

    <div  class="box-header with-border">
              
              <h3 class="box-title vertical-center"> <?php echo $settings['appname'] . ' '. 'Payslip';?></h3>

              <a href="slip?eid=<?php echo $eid;?>" style=" margin-right: 20px;" type="button" class="btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-print"></i></a>
              
    </div>

<div class="row">
  <div class="col-xs-12">&nbsp;</div>
  <div class="col-xs-12">
    <div class="row space-16">&nbsp;</div>
    <div class="row">
      <div class="col-xs-10 pull-right">
        <div class="thumbnail">
          <div class="caption text-center" onclick="">
         
          
    <div class="row">
      <div class="col-xs-3">
        <p class="boldtext">Code</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['eid'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Employer</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['employer'];?></p>
      </div>
      <div class="col-xs-3">
        <p class="boldtext">Name</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['title']. ' '. $emp['fname'].' '. $emp['lname'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Bank</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['bank'];?></p>
      </div>

        <div class="col-xs-3">
        <p class="boldtext">Department</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['department'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Branch Code</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['branchcode'];?></p>
      </div>

    <div class="col-xs-3">
        <p class="boldtext">Cost Centre</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['department'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Acc Number</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['accnumber'];?></p>
      </div>


       <div class="col-xs-3">
        <p class="boldtext">Pay Point</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['method'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Date Engaged</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['created'];?></p>
      </div>

       <div class="col-xs-3">
        <p class="boldtext">Pay method</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['method'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Period</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= date('Y-m')?></p>
      </div>

        <div class="col-xs-3">
        <p class="boldtext">Basic Salary</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= number_format($emp['salary'],2);?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Occupation</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['occupation'];?></p>
      </div>

        <div class="col-xs-3">
        <p class="boldtext">NRC No</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?= $emp['nrc'];?></p>
      </div>
       <div class="col-xs-3">
        <p class="boldtext">Pay Date</p>
      </div>
        <div class="col-xs-3">
        <p class="lighttext"><?=  date("Y-m-t", strtotime(date('Y-m-d'))); ?> </p>
      </div>


    </div>

        </div>
      </div>
    </div>


       <div class="col-xs-10 pull-right">
        <div class="thumbnail">
          <div class="caption text-center" onclick="location.href=''">


 <div class="row">
      <div class="col-xs-4">
        <p class="boldtext">EARNINGS</p>
      </div>

        <div class="col-xs-2">
        <p class="boldtext">AMOUNT</p>
      </div>

      <div class="col-xs-4">
        <p class="boldtext">DEDUCTIONS</p>
      </div>

        <div class="col-xs-2">
        <p class="boldtext">AMOUNT</p>
      </div>

       <div class="col-xs-4">
        <p class="lighttext">Basic Salary</p>
      </div>

        <div class="col-xs-2">
        <p class="lighttext"><?= number_format($emp['salary'],2);?></p>
      </div>

      <div class="col-xs-4">
        <p class="lighttext">Salary Advance</p>
      </div>

        <div class="col-xs-2">
        <p class="lighttext"><?= $app->advance($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))) ?></p>
        <input id="advance" type="hidden" value="<?= $app->advance($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))) ?>">
      </div>



      <div class="col-xs-4">
       <p class="lighttext">Allowances & Commissions</p>
      </div>

      <div class="col-xs-2">
        <p class="lighttext"><?= number_format($app->commissions($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))),2)?></p>
        <input id="comm" type="hidden" value="<?= $app->commissions($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))) ?>">
      </div>

      <div class="col-xs-4">
         <p class="lighttext">NAPSA</p>
      </div>

        <div class="col-xs-2">
         <p  class="lighttext"><?=  $app->napsa($emp['eid']); ?></p>
         <input id="napsa" type="hidden" value="<?=  $app->napsa($emp['eid']); ?>">
      </div>



       <div class="col-xs-4">
       
      </div>

      <div class="col-xs-2">
       
      </div>

      <div class="col-xs-4">
         <p class="lighttext">PAYE Calculated</p>
      </div>

        <div class="col-xs-2">
         <p class="lighttext">

          <?php 

          $paye = $app->paye($emp['eid']);
      

          echo '-'.number_format($paye,2);

          ?></p>

          <input id="paye" type="hidden" value="<?= $paye = $app->paye($emp['eid']);
           '-'.number_format($paye,2); ?>">
     
      </div>


       <div class="col-xs-4">
       
      </div>

      <div class="col-xs-2">
       
      </div>

      <div class="col-xs-4">
         <p class="lighttext">National Health Insurance</p>
      </div>

        <div class="col-xs-2">
         <p class="lighttext">
           
           <?php
           $i = 0.01;
           $salary = $emp['salary'];

           $insurance = $i * $salary;

           echo '-'.number_format($insurance,2);

           ?>
         </p>
         <input id="health" type="hidden" value=" <?php
           $i = 0.01;
           $salary = $emp['salary'];

           $insurance = $i * $salary;

           echo '-'.number_format($insurance,2);

           ?>">
      </div>



</div>

<div class="row">
      <div class="col-xs-4">
        <p class="boldtext">TOTAL</p>
      </div>

        <div class="col-xs-2">
        <p id="finaltotal" class="boldtext"></p>
        <input id="slry" type="hidden" value="<?= $emp['salary'];?>">
         <input id="finalsalary" type="hidden" value="">

      </div>

      <div class="col-xs-4">
        <p class="boldtext">TOTAL</p>
      </div>

        <div class="col-xs-2">
        <p id="deductions" class="boldtext"></p>
        <input id="deduc" type="hidden">
      </div>

    
</div>

      </div>
        </div>
      </div>

         <div class="col-xs-6 pull-right">
        <div class="thumbnail">
          <div class="caption text-center" onclick="">

<div class="row">


      <div class="col-xs-6">
        <p class="boldtext">NET PAID</p>
      </div>

        <div class="col-xs-6">
        <p id="payment" class="boldtext"></p>
      </div>

    
</div>


      </div>
        </div>
      </div>

    <div class="col-xs-12">&nbsp;</div>
  </div>
</div>
</div>

</div>


    </section>
    <!-- /.content -->
</body>

</html>
 <script type="text/javascript">
 	$(document).ready(function () {
    window.print();
});
 </script>

