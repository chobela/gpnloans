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
      Loan Types
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Loans Types</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example" class="table table-bordered table-striped">
                <thead>
            <div class="box-header pull-left">
          <a href="add_loantype.php" class="btn btn-info" role="button">Add New Loan Type</a>
            </div>
               <tr>
       
                  <th>Type</th>
                  <th>Duration</th>
                  <th>Grace Period (After Default)</th>
                  <th>Interest Rate</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>

                
                     <?php
  $sql = $app->getloantypes();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
   <td><?php echo $row['loan_name']?></td>
   <td><?php echo $row['days']?> days</td>
   <td><?php echo $row['grace_period']?> days</td>
   <td><?php echo $row['interest'] .'%'?></td>
         
            <td><a type="button" class="btn btn-default btn-xs" href="<?php if ($rights) {echo 'edit_loantype.php?id='.$row['id'];} else {}?>">
          
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
    </a>
   <a type="button" actionconfirm="delete loan type" class="btn btn-default btn-xs confirm_action" href="">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
    </a></td>

<tr>
     <?php } ?>
  
                </tr>

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