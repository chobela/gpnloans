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

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Account</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_acc">
                                
         


       <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Select Borrower</label>
                     <div class="col-sm-6">
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="debtor" id="debtor">

 <option value="0" selected></option>
                          <?php 
                           $resc = $app->getdebtornames();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                              }
                          ?>
                 
                      </select>
                     
                    </div>
                </div>

                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Savings Acc Type</label>
                     <div class="col-sm-6">
                       <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="accid" id="accid">

                       <option value="0" selected></option>
                          <?php 
                           $resc = $app->getaccs();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[accid]\">$r[name]</option>";
                              }
                          ?>
                 
                      </select>
                     
                    </div>
                </div>

                  <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Oppening Balance(K)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="obalance" class="form-control" id="obalance" placeholder="Oppening Balance" value="">
                    </div>
                </div>


                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_acc">

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
    

 <div class="box box-warning">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Savings</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
                   <div class="box-header pull-left">
          <a data-toggle="modal" data-target="#modal-default" class="btn btn-warning" style="width:100%" role="button">New Account</a>
            </div>
               <tr>
       
                  <th>Acc Holder</th>
                  <th>Acc Type</th>
                  <th>Acc Number</th>
                  <th>Acc Balance</th>
                  <th>Trans History</th>
                 
                
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->viewaccs();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

            <tr>
  
              <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
              <td><?php echo $row['acctype']?></td>
              <td><?php echo $row['accnumber']?></td>
              <td><?php echo 'K'.number_format($row['balance'],2)?></td>
  <td><a type="button" class="btn btn-default btn-xs" href="acc.php?accnum=<?php echo $row['accnumber']?>&did=<?php echo $row['debtor']?>">
    
      <span class="fa fa-history" aria-hidden="true">
          
      </span> 
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
<script type="text/javascript">
  
$(document).ready(function(){
 
  // Initialize select2
   $("#accid").select2();
  $("#debtor").select2();


});

</script>

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