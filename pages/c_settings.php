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
   Company Settings
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box box-info">
   <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">


      <div class="form-group">
                    
                    <img class="col-sm-5 pull-left" src="../dist/img/<?php echo $settings['logo']?>" alt="Company logo" style="width:160px;height:160px;">    

              
         </div>

         <hr>


         <div class="form-group">
                 <label form="" class="col-sm-4 control-label">Update Company Logo</label>
                   <div class="col-sm-8">
                  <input type="file" id="file" name="file">

                </div>
         </div>



     <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-4 control-label">Company Name</label>                      
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="name" required="" value="<?php echo $settings['appname']?>">
                          
                    </div> 
         </div>

             <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-4 control-label">SMS Sender ID</label>                      
                    <div class="col-sm-8">
                        <input type="text" maxlength="15" name="senderid" class="form-control" id="senderid" value="<?php echo $settings['senderid']?>">
                         <p>Max length : 15 charaters</p>
                          
                    </div> 
         </div>

            <div class="form-group">
                    
                    <label for="inputLoanApplicationId" class="col-sm-4 control-label">App Color</label>                      
                    <div class="col-sm-8">
                       
                          <div class="box-body no-padding">
                <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
                    <thead>
                    <tr>
                        <th style="width: 210px;">Skin Class</th>
                        <th>Preview</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><code>skin-blue</code>(Default)</td>
                        <td>
                            <a href="changeskin.php?skin=skin-blue" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-blue-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-blue-light" data-skin="skin-blue-light" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-yellow</code></td>
                        <td><a href="changeskin.php?skin=skin-yellow" data-skin="skin-yellow" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-yellow-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-yellow-light" data-skin="skin-yellow-light" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-green</code></td>
                        <td><a href="changeskin.php?skin=skin-green" data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-green-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-green-light" data-skin="skin-green-light" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-purple</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-purple" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-purple-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-purple-light" data-skin="skin-purple-light" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-red</code></td>
                        <td><a href="changeskin.php?skin=skin-red" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-red-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-red-light" data-skin="skin-red-light" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-black</code></td>
                        <td><a href="changeskin.php?skin=skin-black" data-skin="skin-black" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><code>skin-black-light</code></td>
                        <td>
                            <a href="changeskin.php?skin=skin-black-light" data-skin="skin-black-light" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
                    </div> 
         </div>


         

            </div>

                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="update_config">
              

                   <div class="box-footer">
                  
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