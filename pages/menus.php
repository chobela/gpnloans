<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;



$settings = $app->appsettings();
$uuid = $_GET['uid'];
$name = $app->user_firstname($uuid);

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
      Menu Settings for <?php echo $name;?>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

    
   <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Menus</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="formposts.php" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php

$checked_arr = array();

    // Fetch checked values
    $menus = mysqli_query($db,"SELECT menus FROM users WHERE id = '$uuid'");
    
      $result = mysqli_fetch_assoc($menus);
      $checked_arr = explode(",",$result['menus']);

      $menus_arr = array('1','2','3','4','5','8','9','11','12');


    foreach($menus_arr as $menu){


switch ($menu) {
  case '1':
    $label = 'Home';
    break;

  case '2':
    $label = 'Members';
    break;

  case '3':
    $label = 'Loans';
    break;

     case '4':
    $label = 'Collections';
    break;

  case '5':
    $label = 'Collateral Register';
    break;

     case '8':
    $label = 'Savings';
    break;

     case '9':
    $label = 'Office';
    break;

     case '11':
    $label = 'Reports';
    break;

     case '12':
    $label = 'Settings';
    break;
}

      $checked = "";
      if(in_array($menu,$checked_arr)){
        $checked = "checked";
      } else {
        $checked = "";
      }
      echo '<div class="form-group checkbox">
<label>
<input type="checkbox" name="menu[]" value="'.$menu.'" class="flat-red" '.$checked.'>'.'  '.$label.'
</label>
    </div>';

    //'<input type="checkbox" name="lang[]" value="'.$language.'" '.$checked.' > '.$language.' <br/>';
    }
    ?>
  
  <input type="hidden" name="uid" class="form-control" id="uid" value="<?php echo $uuid;?>">
  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_menus">
              
             
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Save</button>
              </div>
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

    
    <script type="text/javascript">

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    </script>

 
</body>
</html>