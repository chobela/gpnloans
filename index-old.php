<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
session_start();
require("session.php");
require("App.php");
include("includes/config.php");
$app = new App;


//Get the current location
$link = $_SERVER['PHP_SELF'];
//send php self of index file to server for loading logo purposes
mysqli_query($db, "update config set index_php_self='$link'");

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
<!-- DataTables -->
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
    
      <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.bootstrap.min.css">


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css">

</head>
<body class="hold-transition <?php echo $settings['appcolor'];?> fixed sidebar-mini">
<div class="wrapper">

<?php
include ('includes/index_header.php');
include ('includes/index_sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overview
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $app->numdebtors();?></h3>

              <p>Borrowers</p>
            </div>
            <div class="icon">
              <i class=""></i>
            </div>
            <a href="pages/debtors.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo 'K'. number_format($app->sumprincipal());?></h3>

              <p>Total Principal Released</p>
            </div>
            <div class="icon">
               
              <i class=""></i>
            </div>
            <a href="pages/viewloans.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo 'K'. number_format($app->totalbalance());?></h3>

              <p>Total Outstanding Loans</p>
            </div>
            <div class="icon">
              <i class=""></i>
            </div>
            <a href="pages/viewloans.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo 'K'. number_format($app->suminterest());?></h3>

              <p>Interest Outstanding</p>
            </div>
            <div class="icon">
              <i class=""></i>
            </div>
            <a href="pages/viewloans.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Applications Pending Aproval</h3>
              
            </div>
         
                <div class="box">
    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
            
               <tr>
       
             <td></td>
             <td>Application Date</td>
             <td>Name</td>
             <td>Loan type</td>
             <td>Principal</td>
             <td>Interest rate</td>
             <td>Amount due</td>
             <td>Phone Number</td>
        
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->getapplications();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>
    <td>
    
        <a type="button" class="btn btn-default btn-xs" href="<?php echo 'pages/newapplication.php?lid='.$row['loanid']; ?>">

          <span class="glyphicon glyphicon-eye-open" aria-hidden="true">
              
          </span> 
        </a>

    
    </td>
            <td><?php echo $row['loan_date']?></td>
            <td><?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];?></td>
            <td><?php echo $row['loan_name']?></td>
            <td><?php echo 'K '.number_format($row['amount'],2)?></td>
            <td><?php echo $row['interest'].'%'?></td>
            <td>
                <?php 
                $amount =  $row['amount'];
                $interest =  $row['interest'];
                $x = $amount * $interest/100;
                $due = $amount + $x;
                echo 'K '.number_format($due,2);
                ?>
            </td>
            <td><?php echo  $app->get_debtor_phone($row['ddid']);?></td>
            
            
            
          
                </tr>
              <?php } ?>

                </tbody>
              
               
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->



        </div>
    </div>
</div>


            <div class="row">
              <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
                        <div class="box-header with-border">

            <h5><b><span>Last 20 collections : </span><span style="color: #14bdf3"><?php echo $app->get_collections_20day()?></span></b></h5>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                          
                                          </div>
                          </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="lineChart2" style="height:280px"></canvas>
                            </div>
                          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
                 <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
                        <div class="box-header with-border">

            <h5><b><span>Interest Earnings from last 20 collections : </span><span style="color: #17b217"><?php echo $app->get_interest_20day()?></span></b></h5>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                          
                                          </div>
                          </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="lineChart" style="height:280px"></canvas>
                            </div>
                          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

                 
      <div class="row">
         <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
                        <div class="box-header with-border">

                         <h5><b><span>Last 20 Cashouts Total : </span><span style="color: #1d4e8f"><?php echo $app->get_cashouts_20day()?></span></b></h5>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                          
                                          </div>
                          </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="lineChart3" style="height:280px"></canvas>
                            </div>
                          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
  

      <div class="row">
         <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
                        <div class="box-header with-border">

                          <h5><b><span style="color: #1d4e8f">Principal Released</span> vs <span style="color: #427131">Amount Due</span> (Last 12 Months)</b></h5>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                          
                                          </div>
                          </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="barChart" style="height:280px"></canvas>
                            </div>
                          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include ('includes/footer.php');
 ?>
 
</div>


 <?php
 include ('scripts.html');
 ?>



 <script>



        $(document).ready(function () {
            showGraph();
            showGraph2();
            showGraph3();
            showGraph4();

        });


                        function showGraph4()
        {
            {
                $.post("data7.php",
                function (data)
                {
                   //console.log(data);
                     var type = [];
                     var principal = [];
                     
                   
                    for (var i in data) {
                        type.push(data[i].type);
                        principal.push(data[i].principal);
                    }

                
                    var chartdata = {
                        labels: type,
                        datasets: [
                            
                             {
                                label: 'Cash Releaased',
                                borderColor: '#1d4e8f',
                                fill: false,
                                hoverBorderColor: '#666666',
                                data: principal

                            }
                        ]
                    };

                    var graphTarget = $("#lineChart3");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        borderColor: '#1d4e8f',
                        fill: false,
                            options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'K' + value;
                    }
                }
            }]
        }
    }
                    });
                });
            }
        }


                        function showGraph3()
        {
            {
                $.post("data2.php",
                function (data)
                {
                   //console.log(data);
                     var type = [];
                     var interest = [];
                     
                   
                    for (var i in data) {
                        type.push(data[i].type);
                        interest.push(data[i].interest);
                    }

                
                    var chartdata = {
                        labels: type,
                        datasets: [
                            
                             {
                                label: 'Interest Earned',
                                borderColor: '#17b217',
                                fill: false,
                                hoverBorderColor: '#666666',
                                data: interest

                            }
                        ]
                    };

                    var graphTarget = $("#lineChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        borderColor: '#DD4B39',
                        fill: false,
                            options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'K' + value;
                    }
                }
            }]
        }
    }
                    });
                });
            }
        }

                function showGraph2()
        {
            {
                $.post("data2.php",
                function (data)
                {
                   //console.log(data);
                     var type = [];
                     var interest = [];
                     
                   
                    for (var i in data) {
                        type.push(data[i].type);
                        interest.push(data[i].interest);
                    }

                
                    var chartdata = {
                        labels: type,
                        datasets: [
                            
                             {
                                label: 'Interest Earned',
                                borderColor: '#17b217',
                                fill: false,
                                hoverBorderColor: '#666666',
                                data: interest

                            }
                        ]
                    };

                    var graphTarget = $("#lineChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        borderColor: '#DD4B39',
                        fill: false,
                            options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'K' + value;
                    }
                }
            }]
        }
    }
                    });
                });
            }
        }

                        function showGraph3()
        {
            {
                $.post("data3.php",
                function (data)
                {
                   //console.log(data);
                     var type = [];
                     var interest = [];
                     
                   
                    for (var i in data) {
                        type.push(data[i].type);
                        interest.push(data[i].interest);
                    }

                
                    var chartdata = {
                        labels: type,
                        datasets: [
                            
                             {
                                label: 'Collections',
                                borderColor: '#14bdf3',
                                fill: false,
                                hoverBorderColor: '#666666',
                                data: interest

                            }
                        ]
                    };

                    var graphTarget = $("#lineChart2");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        borderColor: '#14bdf3',
                        fill: false,
                            options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'K' + value;
                    }
                }
            }]
        }
    }
                    });
                });
            }
        }


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                  // console.log(data);
                     var type = [];
                     var principal = [];
                     var balance = [];
                     
                   
                    for (var i in data) {
                        type.push(data[i].type);
                        principal.push(data[i].principal);
                        balance.push(data[i].balance);
                    }

                
                    var chartdata = {
                        labels: type,
                        datasets: [
                            {
                                label: 'Principal Released',
                                backgroundColor: '#1d4e8f',
                                borderColor: '#1d4e8f',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: principal

                            },
                             {
                                label: 'Amount Due',
                                backgroundColor: '#427131',
                                borderColor: '#427131',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: balance

                            }
                        ]
                    };

                    var graphTarget = $("#barChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                                                  options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'K' + value;
                    }
                }
            }]
        }
    }
                    });
                });
            }
        }
        </script>
         <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
          <script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        bSort:false,
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

</body>
</html>