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
<div style=" height:100%; width:100%;margin:0; display:flex;">
 

  

<div style="margin:auto;" class="col-md-9">

   <div class="login-logo">
    <a  href="index.php" style="color:white; font-weight: bold;"><?php echo $settings['appname']?></a>
  </div>
  <!-- /.login-logo -->
<div class="box box-danger">
            <div class="box-header">
              
              <h3 id="response" class="box-title center-block">MWASE BRANCH Registration</h3>
              
            </div>

      <div class="box-body">
        <form action="pages/formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="add_form">
              <div class="panel panel-default">
                  <div class="panel-body bg-gray text-bold">Compulsory Fields: </div>
              </div>


   <div class="form-group"><label form="" class="col-sm-3 control-label">Branch</label>

                        <div class="col-sm-9">
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

                        <label form="inputBorrowerFirstName" class="col-sm-3 control-label">First Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name Only" value="<?php echo $debtor['fname'];?>">
                         </div>
                     </div>

                     <div class="form-group">

                        <label form="inputBorrowerLastName" class="col-sm-3 control-label">Middle / Last Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Middle and Last Name" value="<?php echo $debtor['lname'];?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9"><i>AND/OR</i></div>
                    </div>

            <div class="form-group">
                    <label form="inputBorrowerBusinessName" class="col-sm-3 control-label">Business Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="business" id="business" placeholder="Business Name" value="<?php echo $debtor['business_name'];?>">
                </div>
            </div>

  <div class="form-group">
                <div class="col-sm-12">
                    <hr>
                    <p class="text-blue"><b>All of the below fields are optional, except Unique Number:</b></p>
                </div>
            </div>

            <div class="form-group">
                <label form="inputBorrowerUniqueNumber" class="col-sm-3 control-label">Unique Number</label>

            <div class="col-sm-9">
                <input type="text" class="form-control" name="uid" id="uid" placeholder="Unique Number" value="<?php echo $debtor['unique_no'];?>">
                 <p>You can enter unique number to identify the borrower using National Registration Id</p>
            </div>

           </div>

            <div class="form-group"><label form="" class="col-sm-3 control-label">Gender</label>

                        <div class="col-sm-9">
                        <select class="form-control" name="gender" id="gender">
                            <option value="<?php echo $debtor['gender'];?>"></option>
                            <option value="Male" selected="">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        </div>
            </div>

                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="title" id="title"><option value="<?php echo $debtor['title'];?>"></option><option value="Mr" selected="">Mr. </option><option value="Mrs">Mrs. </option><option value="Miss">Miss </option><option value="Ms">Ms. </option><option value="Dr">Dr. </option><option value="Prof">Prof. </option><option value="Ref">Rev. </option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label form="inputBorrowerMobile" class="col-sm-3 control-label">Mobile</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control positive-integer" name="phone" id="phone" placeholder="Numbers Only" value="<?php echo $debtor['mobile_no'];?>">
                                <p><b><u>Do not</u> put country code, spaces, or characters</b> in mobile otherwise you won't be able to send SMS to this mobile.</p>
                    </div>
                </div>

                

                <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $debtor['email'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerDob" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control is-datepick" name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo $debtor['dob'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerAddress" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $debtor['address'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerCity" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $debtor['city'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label form="inputBorrowerProvince" class="col-sm-3 control-label">Province</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="province" id="province" placeholder="Province or State" value="<?php echo $debtor['province_state'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerLandline" class="col-sm-3 control-label">Landline Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="landline" id="landline" placeholder="Landline Phone" value="<?php echo $debtor['landline'];?>">
                    </div>
                </div>

      

                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Working Status</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status" id="status">
                            <option value="<?php echo $debtor['working_status'];?>" selected="">
                                <?php echo $debtor['working_status'];?>
                            </option>
                            <option value="Employee">Employee</option>
                            <option value="Government Employee">Government Employee</option>
                            <option value="Private Sector Employee">Private Sector Employee</option>
                            <option value="Owner">Owner</option>
                            <option value="Student">Student</option>
                            <option value="Overseas Worker">Overseas Worker</option>
                            <option value="Pensioner">Pensioner</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                 <label form="" class="col-sm-3 control-label">Borrower Photo</label>

                 <div class="col-sm-1">
                  <a href="<?php echo $debtor['photo'];?>">
                    <img src="<?php echo $debtor['photo'];?>" style="width:50px;height:50px;" class="img-circle" alt="User Image">  
                  </a>
                 </div>
                   <div class="col-sm-8 pull-left">
                  <input type="file" id="bpic" name="bpic">
                  <p class="help-block">Upload photo</p>
                </div>
                </div>

                  <div class="form-group">
                 <label form="" class="col-sm-3 control-label">Borrower ID</label>

                 <div class="col-sm-1">
                    <img src="<?php echo $debtor['idpic'];?>" style="width:50px;height:50px;" class="img-circle" alt="User Image">  
                 </div>


                   <div class="col-sm-8">
                  <input type="file" id="bid" name="bid">

                  <p class="help-block">Upload ID</p>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerLandline" class="col-sm-3 control-label">Other Documents</label>
                    <div class="col-sm-9">
                        <!--<input type="file" class="my-pond" name="filepond"/>-->
                         <input name="file[]" type="file" />
                         <button class="add_more">Add More Files</button>
                    </div>
                </div>



                </div>



    <input type="hidden" id="mm_insert" name="mm_insert" value="<?php if ($link == 'update') { echo 'update_debtor';} else {echo 'reg_debtor';
                 }?>" />
                     <input type="hidden" id="did" name="did" value="<?php echo $did;?>"/>
                <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Submit</button>
                </div><!-- /.box-footer -->

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
           
              $("#response").text(html);
        } 
   });
    });
});


</script>

</body>
</html>
