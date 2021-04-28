<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$id = $_GET['did'];
$accnum = $_GET['accnum'];
$debtor = $app->singledebtor($id);




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
      <h2>
      Savings Account under <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?>
      </h2>
     
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Transaction</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_comments_form">
                                <input type="hidden" name="add_comments" value="1">
                                <input type="hidden" name="loan_id" value="1274351">
                           
                                  <div class="form-group">
                                    <label form="" class="col-sm-3 control-label">Transaction Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="role" id="role">
                                          
                                          <option value="0" selected=""></option>
                                          <option value="1">Deposit</option>
                                          <option value="2">Withdrawal</option>
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-sm-3 control-label">Amount(K)</label>                      
                                    <div class="col-sm-9">
                                        <input name="amount" class="form-control" id="amount" required=""></input>
                                    </div>
                                </div>   

                             
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Transaction Date</label>                      
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

                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_user">

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

 <div class="box">
  

    <div class="box box-widget">
            <div class="box-body with-border">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="user-block">
                            <img class="img-circle" src="https://x.loandisk.com/images/face_image_placeholder.png">
                            <span class="username">
                                 <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?>
                            </span>
                            <span class="description" style="font-size:13px; color:#000000"><br>
                                <a href="<?php if ($rights) {echo 'add_debtor.php?did='.$id.'&link=update';} else {}?>">Edit Basic Info</a><br>Create Date:  <?php echo  $debtor['creation_date'];?><br><?php echo $debtor['business_name'];?><br>Male<br>
                            </span>
                        </div><!-- /.user-block -->         
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <ul class="list-unstyled">
                        <li><b>Address: </b><?php echo $debtor['address'];?></li>
                        <li><b>City:</b> <?php echo $debtor['city'];?></li>
                        <li><b>Province:</b> <?php echo $debtor['province_state'];?></li>
                        <li><b>Mobile:</b> <?php echo $debtor['mobile_no'];?></li>
                        
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <ul class="list-unstyled">
                        
                        <li><b>Acc TYpe: </b><?php 'Tisunge';?></li>
                        <li><b>Acc Number:</b> <?php echo $accnum;?></li>
                        
                        </ul>
                    </div>

<div class="col-sm-3">

            
              <div class="color-palette-set">
                <div class="bg-orange-active color-palette text-center"><span style="font-weight: bold;">Balance : K50.00</span></div>
              </div>
            
</div>


                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-8">
            <div class="btn-group-horizontal">
               <a data-toggle="modal" data-target="#modal-default" class="btn bg-olive" role="button">Add Transaction</a>
     
                <a type="button" class="btn bg-blue margin" href="">Print Statement</a>
                <a type="button" class="btn bg-purple margin" href="">Transfer money to Loan Account</a>
            </div>
          
                    </div>
  
                </div>             
            </div> 
        </div>
            <!-- /.box-header -->
            <div class="box-header">
            
                <h3 class="box-title">Transaction History</h3>
            
            </div>
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
              
             <td>Transaction Type</td>
             <td>Amount</td>
             <td>Transaction Date</td>
              
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->singletrans($accnum);
  while($row=mysqli_fetch_array($sql))
  {
    
  ?>
             <tr>    
            <td></td>
            <td></td>
            <td></td>
          
            </tr>
              <?php } ?>

                </tbody>
                
             
               
              </table>
                
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
        fixedColumns: true,
        fixedHeader: true,
        bInfo: false,
        dom: 'Bfrtip',
       /* buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],*/
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