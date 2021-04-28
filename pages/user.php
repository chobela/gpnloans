<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$userphone = $_SESSION ['username'];
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
      Borrowers
      </h1>
      <input type="hidden" id="rights" value="<?php echo $rights;?>">
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Delete Member</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You are about to delete this borrower from the system.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Members</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
                  <th>View</th>
                  <th>ID</th>
                  <th>Full Name</th>
                  <th>Business</th>
                  <th>NRC</th>
                  <th>Mobile</th>
                  <th>Loans Active</th>
                  <th>Savings Accs</th>
                
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->viewdebtorsbyid($userphone);
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>

            <td><a type="button" class="btn-xs bg-olive margin-right" href="singleloans.php?did=<?php echo $row['did']?>">Loans</a> <a type="button" class="btn-xs bg-blue margin-right" href="acc.php?accnum=<?php echo $row['accnumber']?>&did=<?php echo $row['did']?>">Savings</a></td>
             <td><?php echo 'GPN'.$row['did']?></td>
            <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
            <td><?php echo $row['business_name']?></td>
          
            <td><?php echo $row['unique_no']?></td>
            <td><?php echo $row['mobile_no']?></td>
            <td class="text-center"><?php echo $app->countloans($row['did'])?></td>
             <td class="text-center"><?php echo $app->countsavings($row['did'])?></td>
    
          
                </tr>
              <?php } ?>

                </tbody>
                <tfoot class="bg-gray">
                     <tr>
                        <th style="text-align:right" class="text-right" rowspan="1" colspan="1">Total</th>
                        <th style="text-align:right" rowspan="1" colspan="1"></th>
                        <th style="text-align:right" rowspan="1" colspan="1"></th>
                        <th style="text-align:right" rowspan="1" colspan="1"></th>
                         <th style="text-align:right" rowspan="1" colspan="1"></th>
                        <th style="text-align:right" rowspan="1" colspan="1"></th>
                        <th style="text-align:right" rowspan="1" colspan="1"></th>
                      
                        
                      </tr>
                  </tfoot>
               
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
      
       var action = "deleteDebtor";

       var rights = document.getElementById('rights').value;

       if (rights) {
    if(confirm("Are you sure you want to delete this borrower?")) {
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