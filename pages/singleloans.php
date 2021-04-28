<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();
$id = $_GET['did'];
$debtor = $app->singledebtor($id);
$lastpay = $app->lastpay($id);
$countpay = $app->countpay($id);
$countcol = $app->countcol($id);
$countcom = $app->countcom($id);
$countsms = $app->countsms($id);
$countdocs = $app->countdocs($id);


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
      Active Loans under <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?>
      </h2>
      <input type="hidden" id="rights" value="<?php echo $rights;?>">
    </section>

    <!-- Main content -->
    <section class="content">


  <div class="modal fade" id="modal-sms">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New SMS</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data">
                             


                                <div class="form-group">
                                    <label for="amount" class="col-md-3 control-label">Message</label>                      
                                    <div class="col-md-9">
                                      <textarea name="message" class="form-control" id="message"></textarea>
                                     
                                    </div>
                                </div>   

                             
             
                                 <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $id ?>"></input>

                                 <input type="hidden" name="phone" class="form-control" id="phone" value="<?php echo $debtor['mobile_no']; ?>"></input>

                                 
                              <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="send_sms">

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



        
                  <div class="modal fade" id="modal-payment">
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
                    <label form="" class="col-md-3 control-label">Select Loan</label>
                    <div class="col-md-6">
                        <select class="form-control" name="loanid" id="loanid">

                        </select>
                        <p id=msg></p>
                      
                    </div>
                      
                </div>


                                <div class="form-group">
                                    <label for="amount" class="col-md-3 control-label">Amount(K)</label>                      
                                    <div class="col-md-6">
                                        <input type="text" name="amount" class="form-control" id="amount" required=""></input>
                                    </div>
                                </div>   


           <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-md-3 control-label">Collection Date</label>                      
                    <div class="col-md-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="">
                        </div>
                    </div>
                </div>
                             
             
                                 <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $id ?>"></input>

                                 
                              <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_payment">

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

          <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Comment</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_comments_form">
                                <input type="hidden" name="add_comments" value="1">
                               
                                <div class="form-group">
                                
                                    <label for="inputcommentsStaff" class="col-md-3 control-label">By</label>                      
                                    <div class="col-md-9">
                                        <div style="margin:7px 0 0 0;"><?php echo $name?></div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="inputcommentsDescription" class="col-md-3 control-label">Comments</label>                      
                                    <div class="col-md-9">
                                        <textarea name="comment" class="form-control" id="comment" rows="4" required=""></textarea>
                                    </div>
                                </div>   

                                 <input type="hidden" name="debtor" class="form-control" id="debtor" value="<?php echo $id; ?>">

                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_comment">

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
  

    <div class="box box-widget">
            <div class="box-body with-border">
                <div class="row">
                <div class="col-md-4 flex-container">
                        
                        <div>

                          <a href="<?php echo $debtor['photo']?>">
                            <img class="img-box" src="<?php echo $debtor['photo']?>">
                          </a>

                        </div>

                        <div style="margin-left: 20px">
                   
                            <span class="username">
                                 <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?>
                            </span>
                            <span class="description" style="font-size:13px; color:#000000"><br>
                                <a href="<?php if ($rights) {echo 'add_debtor.php?did='.$id.'&link=update';} else {}?>">Edit Basic Info</a><br>Create Date:  <?php echo  $debtor['creation_date'];?><br><?php echo $debtor['business_name'];?><br>Male<br>
                            </span>
                        </div><!-- /.user-block --> 
                           
                                
                    </div><!-- /.col -->
     
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                        <li><b>Address: </b><?php echo $debtor['address'];?></li>
                        <li><b>City:</b> <?php echo $debtor['city'];?></li>
                        <li><b>Province:</b> <?php echo $debtor['province_state'];?></li>
                        <li><a href="<?php echo $debtor['idpic']?>">View ID</a></li>
                        
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                        
                        
                        <li><b>Mobile:</b> <?php echo $debtor['mobile_no'];?>
            <div class="btn-group-horizontal">
                <a data-toggle="modal" data-target="#modal-sms" class="btn-xs bg-red" role="button">Send SMS</a>
            
            </div></li>
                        
                        </ul>
                    </div>
                </div><!-- /.row -->
                <div style="margin-top: 20px" class="row">
                    <div class="col-md-8">
                         
                          <div class="btn-group-horizontal">
                              <a type="button" class="btn bg-blue" href="addnewloan.php?did=<?php echo $id?>">Add Loan</a>
                              <a data-toggle="modal" data-target="#modal-payment" class="btn bg-blue" role="button">Add Payment</a>
                              <a type="button" class="btn bg-blue" href="statement.php?did=<?php echo $id?>">Print Statement</a>
                                
                          </div>

          
                    </div>
  
                </div>             
            </div> 
        </div>
            <!-- /.box-header -->
            <div class="box-header">
            
                <h3 class="box-title">Active Loans</h3>
            
            </div>
            <div class="box-body">
              <table id="examplef" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
             <td>Edit Loan</td>
             <td>Release Date</td>         
             <td>Due Date</td>         
             <td>Loan type</td>
             <td>Principal</td>
             <td>Intrest rate</td>
             <td>Amount due</td>
             <td>Paid</td>
             <td>Balance</td>
             <td>Last payment</td>
             <td>Freeze | Unfreeze</td>
           
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->singleloans($id);
  while($row=mysqli_fetch_array($sql))
  {
    $paid = $app->addmypayments($row['lid']);
  ?>

               

<tr>
            <td>
    
    <a type="button" class="btn btn-default btn-xs" href="<?php if ($rights) {echo 'editloan.php?lid='.$row['lid'];} else {}?>">
    
      <span class="glyphicon glyphicon-pencil" aria-hidden="true">
          
      </span> 
    </a>
    
    
    </td>
            <td><?php echo $row['loan_date']?></td>
             <td><?php echo $row['due_date']?></td>
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
            <td><?php echo 'K '. $paid?></td>
            <td>
            <?php echo 'K'. $app->debtorbalance($row['lid']);?>
            </td>
            <td><?php echo $lastpay['date']; ?></td>
            <td><a type="button" id="<?php echo $row['lid']?>" name="<?php if($row['frozen']) {
        echo "munfreeze";} else {echo "mfreeze";} ?>"  class="btn btn-default btn-xs <?php if($row['frozen']) {
        echo "munfreeze";} else {echo "mfreeze";} ?>">
      <span aria-hidden="true" class="<?php if($row['frozen']) {
        echo "glyphicon glyphicon-play";} else if (!$row['frozen']) {echo "glyphicon glyphicon-pause";} ?>"></span> 
    </a></td>
            
          
                </tr>
              <?php } ?>

                </tbody>
                
             
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->
          <div class="row">
            

         
<div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Payments <span style="color: #7807a2"><?php echo '('. $countpay . ')'?></span></a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Loan Comments <span style="color: #7807a2"><?php echo '('. $countcom . ')'?></span></a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Loan Collateral <span style="color: #7807a2"><?php echo '('. $countcol . ')'?></span></a></li>
               <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">SMS History<span style="color: #7807a2"><?php echo '('. $countsms . ')'?></span></a></li>

                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Documents<span style="color: #7807a2"><?php echo '('. $countdocs . ')'?></span></a></li>
            
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
            

              <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <?php echo $countpay?> Payments made by <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">

               <thead>
            
                <tr>
 
                  <th>Payment Type</th>
                  <th>Amount</th>                  
                  <th>Collection Date</th>
                  <th>Balance</th>

                
                </tr>
                </thead>

                <tbody>
  <?php
  $sql = $app->singlepayments($id);
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
           
            <td><?php echo $app->getpaytype($row['loanid']);?></td>
            <td><?php echo 'K'. number_format($row['amount'], 2)?></td>
            <td><?php echo $row['date']?></td>
            <td><?php echo 'K'. $app->debtorbalance($row['loanid']);?></td>
         
                 
                </tr>
  <?php } ?>



               </tbody>


            </table>
            </div>
            <!-- /.box-body -->
          </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
            

 <div class="box">
            <div class="box-header">
              <div>
                <h3 class="box-title"> <?php echo $countpay?> Comments Under <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?></h3>
                </div>
                <div>
             <button type="button" class="btn bg-olive pull-right" data-toggle="modal" data-target="#modal-default">
                Add Comment
              </button>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">

               <thead>
            
                <tr>
 
                  <th>Comment</th>
                  <th>Date</th>                  
                 
                </tr>
                </thead>

                <tbody>
  <?php
  $sql = $app->getcommentsbyid($id);
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
           
            <td><?php echo $row['comment']?></td>
               <td><?php echo $row['date']?></td>
         
                 
                </tr>
  <?php } ?>



               </tbody>


            </table>
            </div>
            <!-- /.box-body -->
          </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                              <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <?php echo $countcol?> Collateral Under <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="example" class="table table-striped">

               <thead>
            
                <tr>
 
                <th>Item</th>
                <th>Condition</th>
                <th>Amount Due</th>
                
                </tr>
                </thead>

                <tbody>
  <?php
  $sql = $app->debtorcollateral($id);
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
           
               <td><?php echo $row['col_name']?></td>
             <td><?php echo $row['condition']?></td>
            <td><?php echo 'K'. number_format($row['balance'],2)?></td>
                 
                </tr>
  <?php } ?>



               </tbody>


            </table>
            </div>
            <!-- /.box-body -->
          </div>
              </div>
                <div class="tab-pane" id="tab_4">


        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <?php echo $countsms?> SMS in message History</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="example" class="table table-striped">

               <thead>
            
                <tr>
 
                <th>Number</th>
                <th>Message</th>
                <th>Status</th>
                <th>Sent On</th>
                
                </tr>
                </thead>

                <tbody>
  <?php
  $sql = $app->debtorsms($id);
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
           
             <td><?php echo $row['number']?></td>
             <td><?php echo $row['message']?></td>
             <td><?php echo $row['poststatus']?></td>
             <td><?php echo $row['sent_on']?></td>
           
                 
                </tr>
  <?php } ?>



               </tbody>


            </table>
            </div>
            <!-- /.box-body -->
          </div>
               
              </div>
              <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_5">


        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <?php echo $countdocs;?> Found</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="example" class="table table-striped">

               <thead>
            
                <tr>
 
                <th>Documents</th>
               
                
                </tr>
                </thead>

                <tbody>
  <?php
  $sql = $app->debtordocs($id);
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
           
             <td><a href="<?php echo $row['file']?>">File <?php echo $row['id']?></a></td>
            
           
                 
                </tr>
  <?php } ?>



               </tbody>


            </table>
            </div>
            <!-- /.box-body -->
          </div>
               
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
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

     <script>
$(document).ready(function() {


var did=$('#debtor').val();
$('#loanid').empty(); //remove all existing options
///////
$.get('getloanid.php',{'did':did},function(return_data){
  if(return_data.data.length>0){
    $('#msg').html( return_data.data.length + ' loan(s) Found');

    console.log(return_data.data.lid);
    
$.each(return_data.data, function(key,value){
    $("#loanid").append("<option value='" + value.lid +"'>"+value.loan_name+"</option>");
  });
  }else{
  $('#msg').html('No loans Found');
}
}, "json");

/////////////////////
});
</script>

      <script type="text/javascript">

$(document).ready(function() {
    $("#examplef").on('click', '.mfreeze', function(){

      var id = $(this).attr("id");
      console.log(id);
       var f = 1;
      
       var action = "freezeLoan";

       var rights = document.getElementById('rights').value;

    if (rights) {

    if(confirm("Are you sure you want to freeze this loan?")) {

    $.ajax({
      url:"formposts.php",
      method:"POST",
      data:{id:id, f:f, mm_insert:action},
      success:function(data) {          
        
              window.location.reload();

            //  console.log(data);
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

      <script type="text/javascript">

$(document).ready(function() {
    $("#examplef").on('click', '.munfreeze', function(){

      var id = $(this).attr("id");
      var f = 0;
      
       var action = "freezeLoan";

       var rights = document.getElementById('rights').value;

    if (rights) {

    if(confirm("You are about to Unfreeze this loan!")) {
      
    $.ajax({
      url:"formposts.php",
      method:"POST",
      data:{id:id, f:f, mm_insert:action},
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



  <script type="text/javascript">

$(document).ready(function() {
    $('#examplef').DataTable( {
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