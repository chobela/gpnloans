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
      Branches
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">


    
    

 <div class="box box-warning">
          
    
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example" class="table table-bordered table-striped">
                <thead>
       
               <tr>
       
                  <th></th>
                  <th>Branch Name</th>
                  <th>Edit Name</th>
                  
                </tr>
                </thead>
                <tbody>

                
                     <?php
  $sql = $app->getbranches();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
  <td><?php echo $row['id']?></td>
   <td><?php echo $row['branchname']?></td>
   
         
  <td>
          

    <a href="#edit<?php if ($rights) {echo $row['id'];} else {}?>" data-toggle="modal" type="button" class="btn btn-default btn-xs"> <span class="fa fa-pencil" aria-hidden="true">
          
      </span> </a>


  </td>

   <div class="modal fade"  id="edit<?php echo $row['id']; ?>">
          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Branch Name</h4>

                
              </div>


              <div class="modal-body">

                 <form class="form-horizontal" action="formposts.php" method="post" enctype="multipart/form-data" id="add_comments_form">
                               
                           <div class="row">

                                <div class="form-group">
                                    <label for="inputcommentsDescription" class="col-sm-3 control-label">Branch Name</label>                      
                                    <div class="col-sm-9">
                                        <input name="branchname" value="<?php echo $row['branchname']?>" class="form-control" id="branchname" required=""></input>
                                    </div>
                                </div>

                                </div>


        <input type="hidden" name="bid" class="form-control" id="bid" value="<?php echo $row['id'] ?>">
               <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_branch">


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

 

<tr>
     <?php } ?>
  
                </tr>

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
    $("#example").on('click', '.mdelete', function(){

      var id = $(this).attr("id");
      
       var action = "deleteProduct";

if(confirm("Are you sure you want to delete this product and all of its accounts?")) {
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
    $('#example').DataTable( {
        bSort:false,
        bFilter: true, 
        filter: true,
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