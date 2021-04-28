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
      Bulk SMS
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    
   <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary" data-intro='This form lets you instantly send an SMS to all your SMS contacts' data-step='3'>
            <div class="box-header with-border">
              <h3 class="box-title">All Clients</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="formposts.php" method="POST">
              <div class="box-body">


                <div class="form-group">
                  <label for="message">Message</label>
                 
                  <textarea class="form-control area" name="message" id="message" rows="5" maxlength="640" placeholder="Message ..."></textarea>
                </div>
                  <!--<div><p id="chars">160 chars remaining.</p></div>-->
                   <div><p id="chars">160 chars = 1 SMS</p></div>
                    <div><p id="num"></p></div>

                 
               </div>
            <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="bulk_sms">

              <div class="box-footer">
                <button type="submit" class="btn btn-default">Send Now</button>
              </div>
            </form>
          </div>
       </div>

        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Single Client</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="formposts.php" method="POST">
              <div class="box-body">

                <div class="form-group">
                    <label>Select Borrower</label>
                     
                       <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="debtor" id="debtor" onchange="showNumber(this.value)">

                       <option value="" selected></option>
                          <?php 
                           $resc = $app->getdebtornames();
                              foreach($resc as $r) { 
                              
                                echo "<option value=\"$r[id]\">$r[title] $r[fname] $r[lname]</option>";
                              }
                          ?>
                 
                      </select>
                  
                </div>

                   <div class="form-group">
                                    <label>Phone</label>                      
                                   
                                        <input type="text" name="myphone" class="form-control" id="myphone" disabled></input>
                                    
                                </div>   
            

                <div class="form-group">
                  <label for="message">Message</label>
                 
                  <textarea class="form-control textarea2" name="message" id="message" rows="5" maxlength="640" placeholder="Message ..."></textarea>
                </div>

                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="send_sms">


             <input type="hidden" name="phone" class="form-control" id="phone">

      
                <!--  <div><p id="chars2">160 chars remaining.</p></div>-->

                   <div><p id="chars2">160 chars = 1 SMS</p></div>
                    
                    <div><p id="num2"></p></div>

                 
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-default">Send Now</button>
              </div>
            </form>
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
 include ('scripts.html');
 ?>

 <script type="text/javascript">
  
$(document).ready(function(){
 
  // Initialize select2
  $("#debtor").select2();

});

</script>


<script>
function showNumber(did) {
  if (did == "") {
    document.getElementById("myphone").innerHTML = "";
    return;
  } else {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("myphone").value = this.responseText;
        document.getElementById("phone").value = this.responseText;
       
        console.log(this.responseText);
      }
    };
    var url = 'formposts.php';
    var params = 'did='+did+'&mm_insert=get_number';
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
  }
}
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