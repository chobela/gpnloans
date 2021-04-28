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

<style>
.ck-editor__editable_inline {
    min-height: 175px;
}
</style>


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
      Bulk Email
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    
 
     
          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
         
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="mymail.php" method="POST">
         
                <div class="form-group">
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                </div>
                <div id="editor">

                  <textarea id="message" name="message" class="textarea" placeholder="Message"
                            style="width: 100%; height: 175px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">            
                  </textarea>
                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </form>
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

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
                        CKEDITOR.replace( 'message' );
                </script>

 <?php
 include ('scripts.html');
 ?>



 
</body>
</html>