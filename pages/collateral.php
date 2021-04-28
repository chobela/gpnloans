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
     Collateral
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">


     <div class="modal fade" id="payment-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sell this Item</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_acc">
                                  

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Amount</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="iamount" class="form-control" id="iamount" placeholder="Amount">
                    </div>
                </div>


            <div class="form-group">
                    <label  class="col-sm-3 control-label">Sale Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" autocomplete="off">
                        </div>
                    </div>
                </div>

                             
                               <input type="hidden" name="loanid" class="form-control" id="loanid">
                               <input type="hidden" name="colvalue" class="form-control" id="colvalue">
                               <input type="hidden" name="colname" class="form-control" id="colname">
                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="sale_payment">

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

       <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-balance-scale"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Collateral in Stock</span>
              <span class="info-box-number"><?php echo $app->countitems();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Collateral Stock Value</span>
              <span class="info-box-number"><?php echo 'K'. $app->sumitemsx();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


   
      </div>
      <!-- /.row -->
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Collateral</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
                <th>Collateral</th>
                <th>Borrower</th>
                <th>Condition</th>
                <th>Value</th>
                 <th>Sold At</th>
                <th>Earnings</th>
                <th>Status</th>
                <th>View</th>
                <th>Sale</th>
                <th>Edit</th>
                        
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->collateral();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
  

             <td><?php echo $row['col_name']?></td>
              <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
             <td><?php echo $row['condition']?></td>
            <td><?php echo 'K'. number_format($row['amount'],2)?></td>
              <td><?php 
              $sold = $app->sold($row['id']);
              echo 'K'. number_format($sold,2)?></td>
             <td><?php 

             $earn =  $app->sold($row['id']) - $row['amount'];
             echo 'K'. number_format($earn,2)?></td>
              <td><?php echo $row['col_desc']?></td>
            
  <td><a type="button" class="btn btn-default btn-xs" href="<?php echo 'viewcollateral.php?lid='.$row['id']; ?>">
  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
    </a>
  </td>

    <td>

    <a data-toggle="modal" data-target="#payment-modal" data-colvalue="<?php echo $row['amount']?>" data-colname="<?php echo $row['col_name']?>" data-id="<?php echo $row['id']?>"  type="button" id="makepay" class="

    <?php

    if ($row['col_status'] != '2'){

      echo 'btn btn-default btn-xs';

    }else {

     

    }?>">           
    
    <span class="<?php

    if ($row['col_status'] != '2'){

      echo 'glyphicon glyphicon-tags';

    }else {



    }?>" aria-hidden="true"></span> 
    </a>


  </td>



  <td><a type="button" class="btn btn-default btn-xs" href="<?php if ($rights) {echo 'editloan.php?lid='.$row['id'];} else {}?>">           
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
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
        fixedColumns: true,
        fixedHeader: true,
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
  
  $(document).ready(function(){
     $("#example").on('click', '#makepay', function(){
   
     $("#loanid").val($(this).data('id'));
      $("#colvalue").val($(this).data('colvalue'));
       $("#colname").val($(this).data('colname'));
    // $('#payment-modal').modal('show');
   });
});
</script>

 
</body>
</html>