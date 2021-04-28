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
      All Loans Today
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Delete Borrower</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You are about to delete this Loan from the system.
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
              
              <h3 id="response" class="box-title">All Loans Today</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
             <td></td>
             <td>Released</td>
             <td>Name</td>
             <td>Loan type</td>
             <td>Principal</td>
             <td>Interest rate</td>
             <td>Amount due</td>
             <td>Paid</td>
             <td>Balance</td>
             <td>Last payment</td>
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->getloanstoday();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>
            <td>
    
    <a type="button" class="btn btn-default btn-xs" href="<?php if ($rights) {echo 'editloan.php?lid='.$row['loanid'];} else {}?>">

      <span class="glyphicon glyphicon-pencil" aria-hidden="true">
          
      </span> 
    </a>
   
    
    </td>
            <td><?php echo $row['loan_date']?></td>
            <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
            <td><?php echo $row['loan_name']?></td>
            <td><?php echo 'K '.number_format($row['amount'],2)?></td>
            <td><?php echo $row['interest'].'%'?></td>
            <td>
                <?php 
                $amount =  $row['amount'];
                $interest =  $row['interest'];
                $x = $amount * $interest/100;
                $due = $amount + $x;
                echo 'K '.number_format($due,2);
                ?>
            </td>
            <td><?php echo 'K '.number_format($app->getallpayments($row['ddid']),2);?></td>
            <td><?php echo 'K '.number_format($row['balance'],2)?></td>
            <td><?php echo $app->lastpaydate($row['ddid']);?></td>
            
          
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
        language: {
        emptyTable: "There are no loans due today",
        },
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

if(confirm("Are you sure you want to delete this loan?")) {
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

 
</body>
</html>