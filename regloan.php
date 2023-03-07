<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
$_SESSION['dbusername'] = "u471266640_userone";
$_SESSION['datadb'] = "u471266640_dbone";
require("App.php");
include("includes/config.php");
$app = new App;



$did = $_GET['did'];
$link = $_GET['link'];
$settings = $app->appsettings();

if ($link == 'add') {

    
     $debtor = ['fname'=>'','lname'=>'', 'gender'=>'', 'country'=>'', 'title'=>'', 'mobile_no'=>'', 'email'=>'', 'unique_no'=>'', 'dob'=>'', 'address'=>'', 'city'=>'', 'province_state'=>'', 'zipcode'=>'10101', 'landline'=>'', 'business_name'=>'', 'working_status'=>'', 'photo'=>'https://x.loandisk.com/images/face_image_placeholder.png', 'idpic'=>'dist/img/id-card.png'];  
    
} else {
  $debtor = $app->getDebtorInfo($did);  

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
  background-image: url("img/back.jpg");

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
      <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">TERMS AND CONDITIONS</h4>
              </div>
              <div class="modal-body">
                <p>

The loan is calculated at a fixed rate of 25% per month

When the client fails to pay back on the agreed date automatically an interest turns to principal.<br>

In a situation where the client fails to comply with the agreement the cost interest recovering shall be done.<br>

Providing false and misleading information when obtaining a loan is a crime anyone found shall be prosecuted.<br>

The client is advised to stick to the agreement to avoid unnecessary charges and cost.<br>

In the event of the death of the client or declaration of the bankrupt and incapability perform their duties to any cause estate is to the unpaid amount and other accrued.<br>

Minimum amount for the loan  100 ZMW – Max K 10000.00

 If the form is not fully filed up, it shall not be considered.<br><br>

THE FORM COSTS A NON REFUNDABLE FEE OF K20<br>

REQUIREMENTS (II)<br><br>
 
Strictly we stick to Collateral<br>

Certified copy of NRC<br>

Proof of residence<br>

Size photo (portrait)<br>

Latest pay slip<br>

Guarantor eg. admistrator / supervisor/ headman <br>

The client should declare collateral e.g. valuable house goods or movable assets and the documents should be attached to the form.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Okay</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<div style=" height:100%; width:100%;margin:0; display:flex;">
 

  

<div style="margin:auto;" class="col-md-9">

   <div class="login-logo">
    <a  href="../index.php" style="color:white; font-weight: bold;"><?php echo $settings['appname']?></a>
  </div>
  <!-- /.login-logo -->
<div class="box box-danger">
            <div class="box-header">
              
              <h3 id="response" class="box-title center-block">Mwase Branch - Loan Application</h3>
              
            </div>

      

 <div class="box box-info">
     <form action="pages/formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">

    <div class="form-group"><label form="" class="col-sm-3 control-label">Branch</label>

                        <div class="col-sm-6">
                        <select class="form-control" name="branch" id="branch">
                 
                          <?php 
                           $resc = $app->getbranches();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[branchname]</option>";
                              }
                          ?>
                       
                    </select>
                        </div>
            </div>
    


               <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Loan Type</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="loantype" id="loantype">

                            <?php 
                           $resc = $app->getloantypes();
                              foreach($resc as $r) { 
                                echo "<option value=\"$r[id]\">$r[loan_name]</option>";
                              }
                          ?>
                          
                     
                        </select>
                       
                    </div>
                      
                </div>



                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">NRC Number</label>                      
                    <div class="col-sm-6">
                        <input  name="nrc" class="form-control" id="nrc" placeholder="000000/00/0" autocomplete="off">
                        <p id="debtorname"></p>
                    </div>
                </div>


        
                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Amount</label>                      
                    <div class="col-sm-6">
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" autocomplete="off">
                    </div>
                </div>


                <div id="installmentspart" class="form-group"><label form="" class="col-sm-3 control-label">Installments</label>

                        <div class="col-sm-6">
                        <select class="form-control" name="installments" id="installments">
                          
                            <option value="0" selected=""></option>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                        </select>
                         </div>
               </div>


                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Loan Date</label>                      
                    <div class="col-sm-6">
                        <div class="input-group date">
                            
                        
                         <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                        <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" value="">
                        </div>
                    </div>
                </div>

            

                 <hr>

  

            </div>

            <div class="panel panel-default"><div class="panel-body bg-gray text-bold">Collateral | (optional fields):</div>
                   </div>

                      <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Name of Collateral</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="col_name" class="form-control" id="col_name" placeholder="Collateral Name" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCollateralSerialNumber" class="col-sm-3 control-label">Serial Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="serial" class="form-control" id="serial" placeholder="Serial Number" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelName" class="col-sm-3 control-label">Model Name</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelname" class="form-control" id="modelname" placeholder="Model Name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralModelNumber" class="col-sm-3 control-label">Model Number</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="modelnumber" class="form-control" id="modelnumber" placeholder="Model Number" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCollateralColour" class="col-sm-3 control-label">Colour</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="color" class="form-control" id="color" placeholder="Color" value="">
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputCollateralCondition" class="col-sm-3 control-label">Condition</label>                      
                    <div class="col-sm-4">
                        <select class="form-control" name="col_condition" id="col_condtion">
                            <option value="0"></option>
                            <option value="1">Excellent</option>
                            <option value="2">Good</option>
                            <option value="3">Fair</option>
                            <option value="4">Damaged</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                
                    <label for="inputCollateralAddress" class="col-sm-3 control-label">Collateral Address</label>                      
                    <div class="col-sm-6">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="">
                  
                    </div>
                </div>

                   <div class="form-group">
                
                    <label  class="col-sm-3 control-label"></label>                      
                    <div class="col-sm-6">
                         <input type="checkbox"><span><a href="" data-toggle="modal" data-target="#modal-default"> I accept the Terms and Conditions</a></span>
                    </div>
                </div>


          <input type="hidden" name="debtor" class="form-control" id="debtor" value="hello">
         
          <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="application">


                   <div class="box-footer">
               
                
                 <button type="submit" class="btn btn-info pull-right submit-button">Submit</button>
                    
                </div>
</form>
</div>



      

</div>

</div>



  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include("scripts.html");?>

<script type="text/javascript">
  
$(document).ready(function() 
{
    $("#nrc").change(function() 
    {

       var link = 'utils/check.php?nrc='+ $(this).val();

        $.ajax({
        url: link,
        type: "GET",
        dataType: "html",

        success: function(html) 
        {
           
              $("#debtorname").html(html);
              $("#debtor").val(html);
             
        } 
      });
    });
});


</script>

</body>
</html>
