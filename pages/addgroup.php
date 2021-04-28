<?php
//error_reporting(E_ALL);
//session_start();
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
   Add New Group
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
     <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    

                <div class="form-group">
                    <label for="groupname" class="col-sm-3 control-label">Group Name</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="groupname" class="form-control" id="groupname" placeholder="Group Name" value="">
                    </div>
                </div>


                 <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Group Leader</label>
                     <div class="col-sm-6">
                       <select class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="leader" id="leader">
                           
                            <option selected value="0"></option>

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
                    <label form="" class="col-sm-3 control-label">Group Members</label>
                     <div class="col-sm-6">
                       <select class="form-control select2" style="width: 100%; color: #000000;" name="members[]" id="members" multiple="multiple">

                          <?php 
                           $resc = $app->getdebtornames();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                              }
                          ?>
                 
                      </select>
                       <p>* The Group Leader gets added to the group automatically and shouldn't be added as a member again.</p>
                     
                    </div>
                </div>

            </div>


                
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="add_group">


                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Submit</button>
                </div><!-- /.box-footer -->
     </form>
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
  $("#leader").select2();

});

</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#members').select2();
});
</script>

 <?php
 include ('scripts.html');
 ?>


 
</body>
</html>