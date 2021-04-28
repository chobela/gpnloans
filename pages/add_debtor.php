<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$did = $_GET['did'];
$link = $_GET['link'];
$settings = $app->appsettings();

if ($link == 'add') {

    
     $debtor = ['fname'=>'','lname'=>'', 'gender'=>'', 'country'=>'', 'title'=>'', 'mobile_no'=>'', 'email'=>'', 'unique_no'=>'', 'dob'=>'', 'address'=>'', 'city'=>'', 'province_state'=>'', 'zipcode'=>'10101', 'landline'=>'', 'business_name'=>'', 'working_status'=>'', 'photo'=>'https://x.loandisk.com/images/face_image_placeholder.png', 'idpic'=>'../dist/img/id-card.png'];  
    
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
      Borrower Details
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Borrower Details</h3>
              
            </div>

       <div class="box-body">
        <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="add_form">
              <div class="panel panel-default">
                  <div class="panel-body bg-gray text-bold">Compulsory Fields: </div>
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



    <input type="hidden" id="mm_insert" name="mm_insert" value="<?php if ($link == 'update') { echo 'update_debtor';} else {echo 'add_debtor';
                 }?>" />
                     <input type="hidden" id="did" name="did" value="<?php echo $did;?>"/>
                <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location=''">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Submit</button>
                </div><!-- /.box-footer -->

          </form>
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
    
$(document).ready(function(){
$("#uid").change(function(){


var uid = $("#uid").val();


var ddataString = 'mm_insert=checkuser&uid='+ uid;


// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "formposts.php",
data: ddataString,
cache: false,
success: function(result){

    if (result == 'success') {

     alert("This user already exists.");
      console.log(result);

    } else {

     console.log(result);
    }

                
}
});

return false;
});
});

</script>

<script>
  $(function(){
  
    // First register any plugins
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    // Turn input element into a pond
    $('.my-pond').filepond();

    // Set allowMultiple property to true
    $('.my-pond').filepond('allowMultiple', true);
  
    // Listen for addfile event
    $('.my-pond').on('FilePond:addfile', function(e) {
        console.log('file added event', e);
    });

    // Manually add a file using the addfile method
    /*$('.my-pond').first().filepond('addFile', 'index.html').then(function(file){
      console.log('file added', file);
    });*/
  
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.add_more').click(function(e){
        e.preventDefault();
        $(this).before("<input name='file[]' type='file' />");
    });
});
</script>
 
</body>
</html>