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
      Office Expenses
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

             <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Expenses</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_items_form">
                                
                                <div class="form-group">
                                    <label for="item" class="col-sm-3 control-label">Item</label>                      
                                    <div class="col-sm-9">
                                        <input name="item" class="form-control" id="item" required=""></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cost" class="col-sm-3 control-label">Cost(K)</label>                      
                                    <div class="col-sm-9">
                                        <input name="cost" class="form-control" id="cost" required=""></input>
                                    </div>
                                </div>   

                           

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="">
                        </div>
                    </div>
                </div>

                                 <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $id; ?>">

                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_expense">

                                <div class="box-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div><!-- /.box-footer -->
                            </form>
                   </div>
            
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>

      <!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Delete Expense</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You are about to delete this Expense from the system.
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
              
              <h3 id="response" class="box-title">Expenses</h3>
              
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
               <div class="box-header pull-left">
          <a data-toggle="modal" data-target="#modal-default" class="btn btn-info" role="button">Add Expenses</a>
            </div>
               <tr>
       
            
             <td>Item</td>
             <td>Cost</td>
             <td>Expense</td>
             <td></td>
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->getexpenses();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>
  <td><?php echo $row['item']?></td>
  <td><?php echo 'K'.number_format($row['cost'],2)?></td>
  <td><?php echo $row['date']?></td>
 
  <td>
        
   <a type="button" id="<?php echo $row['id']?>" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
    </a>
    
  </td>
            
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
      
       var action = "deleteExpense";

if(confirm("Are you sure you want to delete this Expense?")) {
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