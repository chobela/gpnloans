<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 0);
session_start();
$_SESSION['dbusername'] = "u859960976_user";
$_SESSION['datadb'] = "u859960976_gpn";


include('includes/config.php');
require("App.php");


$app = new App;

$settings = $app->appsettings();


 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);
      $branch = mysqli_real_escape_string($db,$_POST['branch']);//2
      
      $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);    

         $id = $row['id'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $email = $row['email'];
      $rights = $row['rights'];
      $branchaccess = $row['branchaccess']; //2

      $sql2= "SELECT branchname, username, datadb FROM branches WHERE id IN ($branchaccess) AND id = '$branch'";

   


      $result2 = mysqli_query($db,$sql2);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);  

      $branchname = $row2['branchname'];
      $dbuser = $row2['username'];
      $datadb = $row2['datadb'];   

     
    
 
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
      	session_unset();
      	session_start();
         
         $_SESSION['id'] = $id;
         $_SESSION['username'] = $username;
         $_SESSION['password'] = $password;
         $_SESSION['firstname'] = $firstname;
         $_SESSION['lastname'] = $lastname;
         $_SESSION['email'] = $email;
         $_SESSION['rights'] = $rights;
         $_SESSION['branchname'] = $branchname;
         $_SESSION['dbusername'] = $dbuser;
         $_SESSION['datadb'] = $datadb;
     
         header("location: index.php");
      }else {

         echo '<strong>Username or Password is invalid</strong>';
      }
   }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $settings['appname']?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php include("stylesheets.html");?>
<style type="text/css">
	body, html {
  height: 100%;
}

.bg {
  /* The image used */
  background-image: url("img/background.jpg");

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body class="hold-transition login-page bg">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><?php echo $settings['appname']?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="POST">

  
                <div class="form-group has-feedback">
                    <select class="form-control" name="branch" id="branch">
                 
                          <?php 
                           $resc = $app->getbranches();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[branchname]</option>";
                              }
                          ?>
                       
                    </select>
                </div>
           

      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include("scripts.html");?>

<script type="text/javascript">
  
$(document).ready(function() 
{
    $("#branch").change(function() 
    {

       var link = 'appsession.php?branch='+ $(this).val();

        $.ajax({
        url: link,
        type: "GET",
        dataType: "html",

        success: function(html) 
        {
              // $('#message').html(html);
              console.log(html);
        } 
   });
    });
});


</script>

</body>
</html>
