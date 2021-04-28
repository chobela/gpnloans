<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$eid = $_GET['eid'];
$emp = $app->employee($eid);

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
<script src="../js/html2pdf.bundle.min.js"></script>


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
  
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

 <div  class="box box-default">

    <div  class="box-header">
              

              <a onclick="myPrint()"  style=" margin-right: 20px;" type="button" class="btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-print"></i></a>
              
    </div>

<div id="element-to-print">


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
        <p class="lighttext"><?= '-'. number_format( $app->advance($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))),2) ?></p>
        <input id="advance" type="hidden" value="<?= -1 * $app->advance($emp['eid'], date("Y-m-t", strtotime(date('Y-m-d')))) ?>">
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
         <p  class="lighttext"><?=  '-'.  number_format($app->napsa($emp['eid']),2); ?></p>
         <input id="napsa" type="hidden" value="<?= -1 * $app->napsa($emp['eid']); ?>">
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

          <input id="paye" type="hidden" value="
          <? 

          $paye = $app->paye($emp['eid']);
           echo -1 * $paye; ?>">
     
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

           echo -1* $insurance;

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

</div>


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
  <script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        bSort:false,
        bFilter: true, 
        filter: true,
        scrollX : true,
        bInfo: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    } );
} );

    </script>

    <script type="text/javascript">

     

      var finalsalary =  Number($('#slry').val()) + Number($('#comm').val());
       $('#finaltotal').text(finalsalary.toFixed(2));
        $('#finalsalary').val(finalsalary);

         // var deductions = Number($('#napsa').val()) + Number($('#advance').val()) + -Math.abs(Number($('#paye').val())) + Number($('#health').val());
      var deductions =  Number($('#napsa').val()) + Number($('#paye').val()) + Number($('#health').val()) + Number($('#advance').val());

       $('#deductions').text(deductions.toFixed(2));
      $('#deduc').val(deductions);


      var total = finalsalary + deductions;
      $('#payment').text('K'+total.toFixed(2));
     

    </script>

    <script type="text/javascript">
      
function myPrint() {
  var element = document.getElementById('element-to-print');
html2pdf(element);
}
    </script>

 
</body>
</html>