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
$gid = $_GET['gid'];
$groupname = $_GET['gname'];

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
  Group Borrowers of <?php echo $groupname;?>
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
                <h4 class="modal-title">New Member(s)</h4>
              </div>
              <div class="modal-body">
                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_members_form">

                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Group Member(s)</label>



                     <div class="col-sm-6">
                       <select class="form-control select2" style="width: 100%; color: #000000;" name="members[]" id="members" multiple="multiple">

                          <?php 
                           $resc = $app->getdebtornames();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                              }
                          ?>
                 
                      </select>
                       
                     
                    </div>
                </div>
                              
  <input type="hidden" name="gid" class="form-control" id="gid" value="<?php echo $_GET['gid']?>">
  <input type="hidden" name="gname" class="form-control" id="gname" value="<?php echo $_GET['gname']?>">
     
                               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_groupdebtors">

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
        You are about to delete this borrower from this group.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>
    

 <div class="box">
     
         
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
                   <div class="box-header pull-left">
          <a data-toggle="modal" data-target="#modal-default" class="btn bg-olive" role="button">Add Group member(s)</a>
            </div>
            
               <tr>
       
                  <th>View</th>
                  <th>Full Name</th>
                  <th>Business</th>
                  <th>Unique#</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Loans Active</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->groupdebtors($gid);
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>

            <td><a type="button" class="btn-xs bg-olive margin-right" href="singleloans.php?did=<?php echo $row['did']?>">Loans</a> <a type="button" class="btn-xs bg-blue margin-right" href="singleloans.php?did=<?php echo $row['did']?>">Savings</a></td>
            <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
            <td><?php echo $row['business_name']?></td>
            <td><?php echo $row['unique_no']?></td>
            <td><?php echo $row['mobile_no']?></td>
            <td><?php echo $row['email']?></td>
            <td class="text-center"><?php echo $app->countloans($row['did'])?></td>
          
            <td><a type="button" class="btn btn-default btn-xs" href="add_debtor.php?did=<?php echo $row['did']?>&link=update">
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
    </a>
   <a type="button" id="<?php echo $row['did']?>" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
    </a></td>
          
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
      
       var action = "deleteFromGroup";

if(confirm("Are you sure you want to delete this borrower from this group?")) {
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
  $(document).ready(function() {
    $('#members').select2();
});
</script>

 
</body>
</html>