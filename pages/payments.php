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
include ('includes/header.php');
include ('../includes/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Collections
      </h1>
       <input type="hidden" id="rights" value="<?php echo $rights;?>">
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Collections</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
         <th>did</th>
                 <th>Borrower</th>
                  <th>Payment Type</th>
                  <th>Amount Paid</th>                  
                  <th>Collection Date</th>
                  <th>Balance</th>
                  <th>Reset Balance</th>
                  
                  
                  
                
                </tr>
                </thead>
                <tbody>

                  <?php
  $sql = $app->viewpayments();
  while($row=mysqli_fetch_array($sql))
  {
  ?>

<tr>
            <td><?php echo $row['debtor'];?></td>
            <td><?php echo $app->singledebtorname($row['debtor']);?></td>
            <td><?php echo $app->getpaytype($row['loanid']);?></td>
            <td><?php echo 'K'. number_format($row['amount'], 2)?></td>
            <td><?php echo $row['date']?></td>
            <td><?php echo 'K'. $app->debtorbalance($row['loanid']);?></td>
         
             <td>
    
    <a type="button" id="<?php echo $row['loanid'];?>" class="btn btn-default btn-xs reset" >

      <span class="glyphicon glyphicon-repeat" aria-hidden="true">
          
      </span> 
    </a>
   
    
    </td>
          
                </tr>
  <?php } ?>
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
    $('#example').DataTable( {
        bFilter: true, 
        filter: true,
        scrollX : true,
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

          <script type="text/javascript">

$(document).ready(function() {
    $("#example").on('click', '.reset', function(){

      var id = $(this).attr("id");
     
      
       var action = "reset";

       var rights = document.getElementById('rights').value;

    if (rights) {

    if(confirm("You are about to reset the loan balance to Zero(0)")) {
      
    $.ajax({
      url:"formposts.php",
      method:"POST",
      data:{id:id, mm_insert:action},
      success:function(result) {          
        
             //window.location.reload();
             if(result == 'success'){

                   swal({
                    //title: "Thanks!",
                    text: "Loan Balance Reset Successful",
                    icon: "success"
                    }).then(function() {
   window.location.reload();
});

} else {
    window.alert('Oops! Something went wrong.');
}


      }
    })
  } else {
    return false;
  }
       } else {
    
       }

    });
});
</script>

 
</body>
</html>