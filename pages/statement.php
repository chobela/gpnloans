<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require("../App.php");
include("../includes/config.php");
$app = new App;



$settings = $app->appsettings();
$id = $_GET['did'];
$lid = $_GET['lid'];
$debtor = $app->singledebtor($id);
$paid = $app->addmypayments($id);
$lastpay = $app->lastpay($id);

ob_start();


?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?></title>
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<?php include ('stylesheets.html');?>
<style type="text/css">.fit-image{
width: 70px;
object-fit: cover;
height: 70px; /* only if you want fixed height */
}</style>
</head>
<body>
	 <section class="content">

	 <div class="box">
  

    <div class="box box-widget">
            <div class="box-body with-border">
                <div class="row">
           
                    <div class="col-sm-4">
                        <ul class="list-unstyled">
                              <div class="pull-right">
                     <img src="../dist/img/374images.png" class="fit-image">
                     
                    </div><!-- /.col -->
                          <h3>
                                 <?php echo  $debtor['title'].'.'. ' '.$debtor['fname'].' '.$debtor['lname'];?></h3>
                        <li><b>Business:</b> <?php echo $debtor['business_name'];?></li>
                        <li><b>Address:</b> <?php echo $debtor['address'];?></li>
                        <li><b>City:</b> <?php echo $debtor['city'];?></li>
                        <li><b>Province:</b> <?php echo $debtor['province_state'];?></li>
                        
                        </ul>
                    </div>

                
                
                </div><!-- /.row -->
                    
            </div> 
        </div>
            <!-- /.box-header -->
                <div class="box-header">
                  <div class="title">
                  LOAN STATEMENT
                </div>
                </div>
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
            
               <tr>
       
          
             <td>Action</td>           
             <td>Principal Amount</td>
             <td>Balance</td>
             <td>Action Date</td>
             <td>Loan Date</td>
             <td>Due Date</td>
            
                  
                </tr>
                </thead>
             <tbody>

                   <?php
  $sql = $app->getstatement($lid);
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>
 
            <td><?php echo $row['actionname']?></td>
            <td><?php echo 'K '.number_format($row['amount'],2)?></td>
            <td><?php echo 'K '.number_format($row['balance'],2)?></td>
            <td><?php echo $row['actiondate']; ?></td>
            <td><?php echo $row['actiondate']; ?></td>
            <td><?php echo $row['duedate']; ?></td>
            
          
                </tr>
              <?php } ?>

                </tbody>
                 
               
              </table>
                
            </div>


<!-- /.box-header -->
            

          
          </div>
           
          <!-- /.box -->
      </section>

     

</body>

</html>
 <script type="text/javascript">
 	$(document).ready(function () {
    window.print();
});
 </script>

