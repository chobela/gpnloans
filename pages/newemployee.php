<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
require("session.php");
require("../App.php");
include("../includes/config.php");
$app = new App;


$name = $_SESSION ['firstname'];
$eid = $_GET['eid'];
$link = $_GET['link'];
$settings = $app->appsettings();

if ($link == 'add') {



    
     $employee = ['title'=>'','fname'=>'', 'lname'=>'', 'address'=>'', 'gender'=>'', 'mobile_no'=>'', 'email'=>'', 'dob'=>'', 'city'=>'', 'state'=>'', 'country'=>'Zambia', 'photo'=>'https://x.loandisk.com/images/face_image_placeholder.png', 'idpic'=>'../dist/img/id-card.png', 'employee'=>'', 'paymethod'=>'', 'department'=>'', 'salary'=>'', 'bank'=>'', 'branchcode'=>'', 'accnumber'=>'', 'occupation'=>''];  
    
} else {
 
  $employee = $app->getEmpInfo($eid);  

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
      Employee Details
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    

 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Employee Details</h3>
              
            </div>

       <div class="box-body">
        <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="add_form">
              <div class="panel panel-default">
                  <div class="panel-body bg-gray text-bold">Personal Details: </div>
              </div>

             
              <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="title" id="title"><option value="<?php echo $employee['title'];?>"></option><option value="Mr" selected="">Mr. </option><option value="Mrs">Mrs. </option><option value="Miss">Miss </option><option value="Ms">Ms. </option><option value="Dr">Dr. </option><option value="Prof">Prof. </option><option value="Ref">Rev. </option>
                        </select>
                    </div>
                </div>

                   <div class="form-group">

                        <label form="inputBorrowerFirstName" class="col-sm-3 control-label">First Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name Only" value="<?php echo $employee['fname'];?>">
                         </div>
                     </div>

                     <div class="form-group">

                        <label form="inputBorrowerLastName" class="col-sm-3 control-label">Last Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Middle and Last Name" value="<?php echo $employee['lname'];?>">
                        </div>
                    </div>

                <div class="form-group"><label form="" class="col-sm-3 control-label">Gender</label>

                        <div class="col-sm-9">
                        <select class="form-control" name="gender" id="gender">
                            <option value="<?php echo $employee['gender'];?>"></option>
                            <option value="Male" selected="">Male</option>
                            <option value="Female">Female</option>
                        </select>
                         </div>
             </div>

                   <div class="form-group">
                    <label form="inputBorrowerDob" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control is-datepick" name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo $employee['dob'];?>">
                    </div>
                </div>

                    <div class="form-group">
                <label form="inputBorrowerUniqueNumber" class="col-sm-3 control-label">ID</label>

            <div class="col-sm-9">
                <input type="text" class="form-control" name="nrc" id="nrc" placeholder="ID" value="<?php echo $employee['nrc'];?>">
                 <p>National Registration Id /Drivers Licence / Passport</p>
            </div>

           </div>

         
         
           
           <div class="form-group">
                <div class="col-sm-12">
                    <hr>
                  
                </div>
            </div>

              <div class="panel panel-default">
                  <div class="panel-body bg-gray text-bold">Contact Details: </div>
              </div>

                     <div class="form-group">
                    <label form="inputBorrowerAddress" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $employee['address'];?>">
                    </div>
                </div>

                   <div class="form-group">
                    <label form="inputBorrowerCity" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $employee['state'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label form="inputBorrowerProvince" class="col-sm-3 control-label">Province</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="state" id="state" placeholder="Province or State" value="<?php echo $employee['state'];?>">
                    </div>
                </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="<?php echo $employee['country'];?>">
                    </div>
                </div>


      
              <div class="form-group">
                    <label form="inputBorrowerMobile" class="col-sm-3 control-label">Mobile</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control positive-integer" name="phone" id="phone" placeholder="Numbers Only" value="<?php echo $employee['mobile_no'];?>">
                                <p><b><u>Do not</u> put country code, spaces, or characters</b> in mobile otherwise you won't be able to send SMS to this mobile.</p>
                    </div>
                </div>
                

                <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $employee['email'];?>">
                    </div>
                </div>


                   <div class="form-group">
                <div class="col-sm-12">
                    <hr>
                  
                </div>
            </div>

              <div class="panel panel-default">
                  <div class="panel-body bg-gray text-bold">Payment Details: </div>
              </div>


               <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Employer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="employer" id="employer" placeholder="Employer" value="<?php echo $employee['employer'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Department</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="department" id="department" placeholder="Department" value="<?php echo $employee['department'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Job Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Job Title" value="<?php echo $employee['occupation'];?>">
                    </div>
                </div>

                  <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">SS Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ssnumber" id="ssnumber" placeholder="Social Security Number" value="<?php echo $employee['ssnumber'];?>">
                    </div>
                </div>


                <div class="form-group"><label form="" class="col-sm-3 control-label">Payment Method</label>

                        <div class="col-sm-9">
                        <select class="form-control" name="paymethod" id="paymethod">
                            <option value="<?php echo $employee['paymethod'];?>"></option>
                            <option value="1" selected="">Cash</option>
                            <option value="2">Bank Transfer</option>
                             <option value="3">Mobile Money</option>
                        </select>
                        </div>
                </div>

                  <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Basic Salary</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="salary" id="salary" placeholder="Basic Salary" value="<?php echo $employee['salary'];?>">
                    </div>
                </div>

                   <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Bank Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="bank" id="bank" placeholder="Bank Name" value="<?php echo $employee['bank'];?>">
                    </div>
                </div>

                  <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Branch Code</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="branchcode" id="branchcode" placeholder="Basic Salary" value="<?php echo $employee['branchcode'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label form="inputBorrowerEmail" class="col-sm-3 control-label">Acc Number</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="accnumber" id="accnumber" placeholder="Account Number" value="<?php echo $employee['accnumber'];?>">
                    </div>
                </div>

            

                <div class="form-group">
                 <label form="" class="col-sm-3 control-label">Employee Photo</label>

                 <div class="col-sm-1">
                  <a href="<?php echo $employee['photo'];?>">
                    <img src="<?php echo $employee['photo'];?>" style="width:50px;height:50px;" class="img-circle" alt="User Image">  
                  </a>
                 </div>
                   <div class="col-sm-8 pull-left">
                  <input type="file" id="bpic" name="bpic">
                  <p class="help-block">Upload photo</p>
                </div>
                </div>

                  <div class="form-group">
                 <label form="" class="col-sm-3 control-label">Employee ID</label>

    <div class="col-sm-1">
                    <img src="<?php echo $employee['idpic'];?>" style="width:50px;height:50px;" class="img-circle" alt="User Image">  
                 </div>


                   <div class="col-sm-8">
                  <input type="file" id="bid" name="bid">

                  <p class="help-block">Upload ID</p>
                </div>
                </div>



    <input type="hidden" id="mm_insert" name="mm_insert" value="<?php if ($link == 'edit') { echo 'update_employee';} else {echo 'add_employee';
                 }?>" />
                     <input type="hidden" id="eid" name="eid" value="<?php echo $eid;?>"/>
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

 
</body>
</html>