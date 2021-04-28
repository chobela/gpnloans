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


    <!-- Main content -->
    <section class="content">
    

     <div class="container">

     

      <div class="row">

        <div class="page-header col-md-10">
<div class="pull-right form-inline">
<div class="btn-group">
<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
<button class="btn btn-default" data-calendar-nav="today">Today</button>
<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
</div>
<div class="btn-group">
<button class="btn btn-warning" data-calendar-view="year">Year</button>
<button class="btn btn-warning active" data-calendar-view="month">Month</button>
<button class="btn btn-warning" data-calendar-view="week">Week</button>
<button class="btn btn-warning" data-calendar-view="day">Day</button>
</div>
</div>

<h3></h3>

</div>
</div>

<div class="row">

<div class="col-md-1">
</div>
    
<div class="col-md-9">
  <div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title">My Reminders</h3>
     <div class="box-tools pull-right">
    
      <button class="btn btn-primary" href="#addevent" data-toggle="modal">Add Reminder</button>
    </div>
  </div>
<div id="showEventCalendar"></div>
</div>
</div>


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
 include ('../scripts.html');
 ?>


 
</body>
</html>