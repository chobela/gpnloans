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
      Manage Groups
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Groups</h3>
              <div class="btn-group-horizontal">
                <a type="button" class="btn bg-olive margin" href="addgroup.php">Add Group</a>
            </div>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
                  <th style="text-align:center">Group Name</th>
                  <th style="text-align:center">Num of Borrowers</th>
                  <th style="text-align:center">Group Leader</th>
                  <th style="text-align:center">Total Borrowed</th>
                  <th style="text-align:center">Group Debt</th>
                  <th style="text-align:center">View Members</th>
                  <th style="text-align:center">Action</th>  
                   
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->getgroups();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
  
            <td style="text-align:center"><?php echo $row['groupname']?></td>
            <td style="text-align:center"><?php echo $app->numgroupdebtors($row['groupid']); ?></td>          
            <td style="text-align:center"><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
             <td style="text-align:center"><?php echo 'K '. number_format($app->group_principal($row['groupid']),2); ?></td>          
             <td style="text-align:center"><?php echo 'K '. number_format($app->group_debt($row['groupid']),2); ?></td>   
             <td style="text-align:center"><a type="button" class="btn btn-default btn-xs" href="groupdebtors.php?gid=<?php echo $row['groupid'] ?>&gname=<?php echo $row['groupname'] ?>">
      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
    </a></td>
               
 <td>

<a href="#edit<?php if ($rights) {echo $row['groupid'];} else {}?>" data-toggle="modal" type="button" class="btn btn-default btn-xs"> <span class="fa fa-pencil" aria-hidden="true">
          
      </span> </a>



 <a type="button" id="<?php echo $row['groupid']?>" name="mdelete"  class="btn btn-default btn-xs mdelete">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
    </a></td>

 <div class="modal fade"  id="edit<?php echo $row['groupid']; ?>">
          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Group Name</h4>

                
              </div>


              <div class="modal-body">

                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data">
                               
                           <div class="row">

                                <div class="form-group">
                                    <label  class="col-sm-3 control-label">Group Name</label>                      
                                    <div class="col-sm-9">
                                        <input name="groupname" value="<?php echo $row['groupname']?>" class="form-control" id="groupname" required=""></input>
                                    </div>
                                </div>

                                </div>


               <input type="hidden" name="groupid" class="form-control" id="groupid" value="<?php echo $row['groupid'] ?>">
               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_groupname">


                                <div class="box-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info pull-right">Update</button>
                                </div><!-- /.box-footer -->
                  </form>

                   </div>
                   <!-- /.modal-body -->
                 </div>
                   <!-- /.modal-header -->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    
     <!-- /.modal-fade-->
              
            
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
        scrollX: true,
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
      
       var action = "deleteGroup";

if(confirm("You are about to delete this group and all its borrowers...This does not delete borrowers from the system.")) {
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