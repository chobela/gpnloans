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
      Employees
      </h1>
       <input type="hidden" id="rights" value="<?php echo $rights;?>">
     
    </section>

    <!-- Main content -->
    <section class="content">

 <div class="box box-primary">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Employees</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
        
               <tr>
       
               <th>Name</th>
               <td>Department</td>
               <td>Occupation</td>
               <td>Basic Salary</td>
               <td>Payslip</td>  
               <td>View more</td>   
                <td>Action</td>               
                
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->allemp();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

            <tr>
  
              <td><?php echo $row['title'].' '.$row['fname'].' '.$row['lname'];?></td>
              <td><?php echo $row['department']?></td>
              <td><?php echo $row['occupation']?></td>
              <td><?php echo 'K'.number_format($row['salary'],2)?></td>
              <td><a href="payslip?eid=<?php echo $row['id']?>">Payslip</a></td>
               <td><a type="button" class="btn btn-default btn-xs" href=""><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a></td>
                    <td><a type="button" class="btn btn-default btn-xs" href="newemployee?link=edit&eid=<?php  echo $row['id'];?>">
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
    </a>
   <a type="button" id="<?php echo $row['id'];?>" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
    </a></td>
           
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

     <script type="text/javascript">

$(document).ready(function() {
    $("#example").on('click', '.mdelete', function(){

      var id = $(this).attr("id");
      
       var action = "deleteEmp";

       var rights = document.getElementById('rights').value;

       if (rights) {
    if(confirm("Are you sure you want to delete this employee?")) {
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
       } else {
    
       }

    });
});
    </script>


 
</body>
</html>