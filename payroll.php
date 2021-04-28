<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require("session.php");
require("App.php");
include("includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$settings = $app->appsettings();

//SELECT SUM(loans.amount) AS principal, SUM(payments.amount) AS collected, date FROM payments LEFT JOIN loans ON payments.loanid = loans.id GROUP BY date

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


  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=19472395a2969da78c8a4c707e72123a">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
     <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
     
     
  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

 <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.print.min.js"></script>




</head>
<body class="hold-transition <?php echo $settings['appcolor'];?> fixed sidebar-mini">
<div class="wrapper">

<?php
include ('includes/header.php');
include ('includes/index_sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    

        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Payroll Date</h3>
            </div>
                <div class="box-body">
                    <div class="row">

                    <div class="col-sm-5">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                       </div>
                        <input type="text" name="startdate" class="form-control" id="startpicker" placeholder="Start Date" value="" autocomplete="off">
                        </div>
                    </div>
                 
            


                     </div>
                    <div class="row search_str">
                        <br>
                    
                    </div>    
                </div>
                  <div class="box-body">
                       <div class="row">
                            <div class="col-xs-2">
                                <span class="input-group-btn">
                                  <button onclick="getDT()" class="btn bg-olive btn-flat">Prepare</button>
                                </span>
                                <span class="input-group-btn">
                                  <button class="btn bg-purple  btn-flat pull-right"  onclick="clearDT()">Reset!</button>
                                </span>
                            </div>
                        </div>
                  </div><!-- /.box-body -->
            </div>

             <div class="box box-success">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Payroll</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include ('includes/footer.php');
 ?>
 
</div>


<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
      var columns = [];

function getDT() {
    
     d = 'reports/payr.php';
     startdate = document.getElementById('startpicker').value;

     console.log(startdate);
     
    
    $.ajax({

      url: d+"?paydate="+startdate,

      
      //data:{startdate:startdate, enddate:enddate},
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);

        columnNames = Object.keys(data.data[0]);
        for (var i in columnNames) {
          columns.push({data: columnNames[i], 
                    title: capitalizeFirstLetter(columnNames[i])});
        }
      $('#example').DataTable( {
        bSort:false,
        bFilter: true, 
        filter: true,
        bInfo: true,
        serverSide: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: d+"?paydate="+startdate,
        columns: columns
      } );
      }

    });
}

function clearDT() {
    console.log('cleared');
    
  location.reload();
    
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

    </script>
        <!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
 //Date picker
    $('#startpicker').datepicker({
      autoclose: true
    })
</script>

 
</body>
</html>