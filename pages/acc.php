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
$id = $_GET['did'];
$accnum = $_GET['accnum'];
$debtor = $app->singledebtor($id);
$balance = $app->balance($accnum);
$obalance = $app->obalance($accnum);
$acctype = $app->acctype($accnum);




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
      <h3>
      Savings Account under <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?>
      </h3>

     
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
                             
                                  <div class="form-group">
                                    <label form="" class="col-sm-3 control-label">Transaction Type</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="trans" id="trans">
                                          
                                          <option value="0" selected=""></option>
                                          <option value="1">Deposit</option>
                                          <option value="2">Withdrawal</option>
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-sm-3 control-label">Amount(K)</label>                      
                                    <div class="col-sm-6">
                                        <input type="number" name="amount" class="form-control" id="amount" required=""></input>
                                    </div>
                                </div>   



                             
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Transaction Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="" autocomplete="off">
                        </div>
                    </div>
                </div> 

                                 <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $debtor['id'];?>"></input>

                                 <input type="hidden" name="accnum" class="form-control" id="accnum" value="<?php echo $accnum;?>"></input>

                                  <input type="hidden" name="acctype" class="form-control" id="acctype" value="<?php echo $acctype;?>"></input>

                                 <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_trans">

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

<!--Transfer Modal-->
  <div class="modal fade" id="modal-transfer">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transfer Funds</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    
                    <label  class="col-sm-3 control-label">Amount (ZMW)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="amountt" class="form-control" id="amountt" required="" value="">
                         
                    </div> 
                </div>
                             
                  <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Select Loan</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="loanid" id="loanid">

                        </select>
                        <p id=msg></p>
                      
                    </div>      
                </div>


                    <input type="hidden" name="debtorr" class="form-control" id="debtorr" value="<?php echo $id;?>"></input>

                    <input type="hidden" name="accnum" class="form-control" id="accnum" value="<?php echo $accnum;?>"></input>

                    <input type="hidden" name="acctype" class="form-control" id="acctype" value="<?php echo $acctype;?>"></input>

                    <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="make_trans">

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
                        
                        <li><b>Acc TYpe: </b> <?php echo $acctype;?></li>
                        <li><b>Acc Number:</b> <?php echo $accnum;?></li>
                         <li><b>Opening Balance:</b> <?php echo 'K'.number_format($obalance,2);?></li>
                        
                        </ul>
                    </div>

<div class="col-sm-3">

            
              <div class="color-palette-set">
                <div class="bg-orange-active color-palette text-center"><span style="font-weight: bold;">Balance : <?php echo 'K'.number_format($balance,2);?></span></div>
              </div>
            
</div>


                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-8">
        
                  
               <a data-toggle="modal" data-target="#modal-default" class="btn bg-olive" role="button">Add Transaction</a>
     
                <a type="button" class="btn bg-blue margin" href="">Print Statement</a>
                <a data-toggle="modal" data-target="#modal-transfer" class="btn bg-purple" role="button">Transfer money to Loan Account</a>
            </div>
          
                    </div>
  
                </div>             
            </div> 
        </div>



<div class="box box-warning">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Transaction History</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example" class="table table-bordered table-striped">
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
            <td><?php echo $row['trans'];?></td>
            <td><?php echo 'K'.number_format($row['amount'],2);?></td>
            <td><?php echo $row['transdate'];?></td>
          
            </tr>
              <?php } ?>

                </tbody>
              
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->          
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

////////////
$('#amountt').change(function(){

var did = $('#debtorr').val();


$('#loanid').empty(); //remove all existing options
///////
$.get('getloanid.php',{'did':did},function(return_data){
  if(return_data.data.length>0){
    $('#msg').html( return_data.data.length + ' loan(s) Found');

    console.log(return_data.data);
    
$.each(return_data.data, function(key,value){
    $("#loanid").append("<option value='" + value.lid +"'>"+value.loan_name+"</option>");
  });
  }else{
  $('#msg').html('No loans Found');
}
}, "json");
///////
});
/////////////////////
});
</script>


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
    




 
</body>
</html>