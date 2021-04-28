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
      Office Purchases
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
                <h4 class="modal-title">Add Payment</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_acc">
                                  

                  <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Amount(K)</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="iamount" class="form-control" id="iamount" placeholder="Amount">
                    </div>
                </div>
                              <input type="hidden" name="saleid" class="form-control" id="saleid">

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


        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Purchase</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="">
                                
                      <div class="form-group">
                          <label for="item" class="col-sm-3 control-label">Item</label>                      
                          <div class="col-sm-6">
                              <input name="item" class="form-control" id="item" required=""></input>
                          </div>
                      </div>



                      <div class="form-group">
                          <label for="cost" class="col-sm-3 control-label">Amount(K)</label>                      
                          <div class="col-sm-6">
                              <input type="number" name="amount" class="form-control" id="amount" required=""></input>
                          </div>
                      </div> 

                         <div class="form-group">
                          <label for="cost" class="col-sm-3 control-label">Price per Bag (K)</label>                      
                          <div class="col-sm-6">
                              <input type="number" name="price" class="form-control" id="price" required=""></input>
                          </div>
                      </div> 

                          <div class="form-group">
                          <label for="cost" class="col-sm-3 control-label">Number of bags</label>                      
                          <div class="col-sm-6">
                              <input type="number" name="bags" class="form-control" id="bags" required=""></input>
                          </div>
                      </div> 

                           

                      <div class="form-group">
                        <label form="" class="col-sm-3 control-label">Select Buyer</label>
                         <div class="col-sm-6">
                           <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="debtor" id="debtor">


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
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Purchase Date</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="pdate" class="form-control" id="datepicker" placeholder="Release Date" value="">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Return of Yield</label>                      
                    <div class="col-sm-6">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="ydate" class="form-control" id="datepicker2" placeholder="Return date" value="">
                        </div>
                    </div>
                </div>

                  

                 <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_purchase">

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
        <h3 class="modal-title" id="exampleModalLabel">Delete Purchase</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You are about to delete this Purchase from the system.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>
    

 <!-- Info boxes -->
      <div class="row">

        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Spent</span>
              <span class="info-box-number"><?php echo 'K'. $app->sumpurchases();?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-balance-scale"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Items Purchased</span>
              <span class="info-box-number"><?php echo $app->countbags() . ' bags';?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


   
      </div>
      <!-- /.row -->


 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Purchases</h3>
                
            </div>


  
    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border" style="width:100%">
                <thead>
               <div class="box-header pull-left">
          <a data-toggle="modal" data-target="#modal-default" class="btn btn-info" role="button">Add Purchase</a>
            </div>
               <tr>

             <th></th>
              <th>Crops to be returned</th>
             <th>Purchase Amount</th>
            
             <th>Seller</th>
             <th>Date of Purchase</th>
             <th>Return of Yield</th>
             <th>Status</th>
             <th>Action</th>
             
                  
                </tr>
                </thead>
               
                
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
    var table =  $('#example').DataTable( {
        ajax: "ajax/getpurchases.php",
        columns: [
            {
                "className":'details-control',
                "orderable":false,
                "data":null,
                "defaultContent":''
            },
           
            { "data": "item" },
            { "data": "amount" },
            { "data": "seller"},
            { "data": "pdate" },
            { "data": "ydate" },
            { "data": "st" },
            { "data": "action" }],
        order: [[1, 'asc']],
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


     // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

        function format ( d ) {
      /* Formatting function for row details - modify as you need */
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Number of Bags:</td>'+
            '<td>'+d.bags+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Price per Bag:</td>'+
            '<td>'+d.price_per_bag+'</td>'+
        '</tr>'+
    '</table>';
}

} );

    </script>
    
    <script type="text/javascript">

$(document).ready(function() {
    $("#example").on('click', '.mdelete', function(){

      var id = $(this).attr("id");
      
       var action = "deletePurchase";

if(confirm("Are you sure you want to delete this Purchase?")) {
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
  
$(document).ready(function(){
 
  // Initialize select2
  $("#debtor").select2();

});

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
   $("#makepay").click(function(){ // Click to only happen on announce links
     $("#saleid").val($(this).data('id'));
     $('#payment-modal').modal('show');
   });
});
</script>
 
</body>
</html>