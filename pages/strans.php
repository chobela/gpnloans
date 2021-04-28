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
      Savings
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

 <div class="box box-warning">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Savings</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
        
               <tr>
       
               <th>Acc Type</th>
               <td>Transaction Type</td>
               <td>Acc Number</td>
               <td>Amount</td>
               <td>Transaction Date</td>                 
                
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->alltrans();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

            <tr>
  
              <td><?php echo $row['acctype']?></td>
              <td><?php echo $row['trans']?></td>
              <td><?php echo $row['accnumber']?></td>
              <td><?php echo 'K'.number_format($row['amount'],2)?></td>
              <td><?php echo $row['transdate']?></td>
           
            </tr>
 <?php } ?>

                </tbody>
              
               
              </table>
                
            </div>
          
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

 
</body>
</html>