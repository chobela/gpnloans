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
      Savings Products
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-warning">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Savings Products</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            <div class="box-header pull-left">
          <a href="addproduct.php" class="btn btn-warning" role="button">Add New Savings Type</a>
            </div>
               <tr>
       
                  <th>Type</th>
                  <th>Duration</th>
                  <th>Min Balance</th>
                  <th>Interest Period</th>
                  <th>Interest on Savings</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>

                
                     <?php
  $sql = $app->getsavingstypes();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
   <td><?php echo $row['name']?></td>
   <td><?php echo $row['duration']?> days</td>
   <td><?php echo 'K'.number_format($row['minbalance'],2)?></td>
   <td><?php echo $row['period']?></td>
   <td><?php echo $row['interest']?>%</td>
         
            <td><a type="button" class="btn btn-default btn-xs" href="<?php if ($rights) {echo 'edit_savings.php?idd='.$row['idd'];} else {}?>">
          
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
    </a>

 <a type="button" id="<?php echo $row['idd']?>" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
    </a>
  </td>

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
    $("#example").on('click', '.mdelete', function(){

      var id = $(this).attr("id");
      
       var action = "deleteProduct";

if(confirm("Are you sure you want to delete this product and all of its accounts?")) {
    $.ajax({
      url:"formposts.php",
      method:"POST",
      data:{id:id, mm_insert:action},
      success:function(data) {          
        
              window.location.reload();

      }
    })
  } else {
    return false;
  }



    });
});
    </script>


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