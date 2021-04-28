<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$uid = $_GET['uid'];
$uname = $_GET['uname'];
$settings = $app->appsettings();


$user = $app->singleuser($uid);


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
  Edit App User : <?php echo $uname;?>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
     <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    




   <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">FirstName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="FirstName" value="<?php echo $user['firstname']?>" name="firstname" id="firstname">
     
                    </div>
                </div>

                  <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">LastName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="LastName" value="<?php echo $user['lastname']?>" name="lastname" id="lastname">
     
                    </div>
                </div>
    


                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Role</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="role" id="role">
                        <option value="<?php echo $user['groupe']?>" selected><?php echo $user['role']?></option>
                            <?php 
                           $types = $app->getroletypes();
                              foreach($types as $r) { 
                                echo "<option value=\"$r[id]\">$r[role]</option>";
                              }
                          ?>
                                 
                        </select>
                        
                    </div>
                      
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">UserName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="UserName" value="<?php echo $user['username']?>" name="username" id="username">
     
                    </div>
                </div>


               <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Password</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Password" value="<?php echo $user['password']?>" name="password" id="password">
     
                    </div>
                </div>

             <div class="form-group">
                    <label form="" class="col-sm-3 control-label">User Rights</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="rights" id="rights">
                        <option value="<?php echo $user['rights']?>" selected><?php if($user['rights']) {echo 'Can Edit';} else {echo 'Cannot Edit';} ?></option>
                            <?php 
                           $rights = $app->getrights();
                              foreach($rights as $r) { 
                                echo "<option value=\"$r[idd]\">$r[rightt]</option>";
                              }
                          ?>
                                 
                        </select>
                        
                    </div>
                      
                </div>
      
                 <hr>

            </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_user">
                  <input type="hidden" name="uid" class="form-control" id="uid" value="<?php echo $user['uid']?>">
                 
                  
                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Update</button>
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


 <?php
 include ('scripts.html');
 ?>


 
</body>
</html>