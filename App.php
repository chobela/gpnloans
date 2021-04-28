<?php

class App{
    public $dbHost     = "localhost";
    public $dbPassword = "theresa1";
  
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
          //session_start();
$conn = new mysqli($this->dbHost, $_SESSION['dbusername'], $this->dbPassword, $_SESSION['datadb']);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }


    function appsettings() {
    
     $sql = "SELECT * FROM config";
           $result = $this->db->query($sql);
  
     while ($row = mysqli_fetch_array($result)) {

                 return  $row;
     }
   }  

   function getPurchase_bi_id($id){

        $sql = "SELECT purchases.*, statuses.status AS st, debtors.id AS did, debtors.title, debtors.fname, debtors.lname FROM purchases LEFT JOIN statuses ON purchases.status = statuses.id LEFT JOIN debtors ON purchases.buyer_id = debtors.id WHERE purchases.id = '$id'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }



   
     function getDebtorInfo($did) {
    
     $sql = "SELECT * FROM debtors WHERE id = $did";
           $result = $this->db->query($sql);
  
     while ($row = mysqli_fetch_array($result)) {

                 return  $row;
     }
   }  

        function getEmpInfo($eid) {
    
     $sql = "SELECT * FROM employees WHERE id = $eid";
           $result = $this->db->query($sql);
  
     while ($row = mysqli_fetch_array($result)) {

                 return  $row;
     }
   }  

   function reminder(){

     $date = date('Y-m-d');

      $sql = "SELECT debtors.id, debtors.title, debtors.fname, debtors.lname, debtors.mobile_no, loans.balance, loans.due_date FROM loan_types LEFT JOIN loans ON loan_types.id = loans.loantype LEFT JOIN debtors ON loans.debtor = debtors.id WHERE DATE_SUB(loans.due_date, INTERVAL loan_types.msg1 DAY) = '$date' AND loans.balance > '0'";

         $result = $this->db->query($sql);
         return $result;

   }

   function gpnreminder(){

        $date = date('Y-m-d');

         $sql = "SELECT SUM(loans.balance) AS balance FROM loans WHERE loans.due_date = '$date'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['balance'];

   }



     function viewdebtors() {
        
         $sql = "SELECT *, debtors.id AS did, accounts.accnumber FROM debtors LEFT JOIN accounts ON debtors.id = accounts.debtor ORDER BY debtors.id DESC";
         $result = $this->db->query($sql);
         return $result;
    
   } 

 

      function viewaccs() {
        
         $sql = "SELECT debtor, accnumber, balance, lastrans, title, fname, lname, products.name AS acctype FROM accounts LEFT JOIN debtors ON accounts.debtor = debtors.id LEFT JOIN products ON accounts.accid = products.id";
         $result = $this->db->query($sql);
         return $result;
   } 

         function alltrans() {
        
         $sql = "SELECT * FROM transactions LEFT JOIN transtypes ON transactions.transtype = transtypes.id";
         $result = $this->db->query($sql);
         return $result;
   } 

         function allemp() {
        
         $sql = "SELECT * FROM employees";
         $result = $this->db->query($sql);
         return $result;
   } 


     function getusers() {
        
         $sql = "SELECT *, users.id AS uid FROM users LEFT JOIN usergroups ON users.groupe = usergroups.id ORDER BY groupe ASC";
         $result = $this->db->query($sql);
         return $result;
    
   }

        function singleuser($uid) {
        
         $sql = "SELECT *, users.id AS uid FROM users LEFT JOIN usergroups ON users.groupe = usergroups.id WHERE users.id = '$uid' ORDER BY groupe ASC";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
    
   }  

         function get_debtor_phone($did) {
        
         $sql = "SELECT mobile_no AS phone FROM debtors WHERE id = $did";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['phone'];
    
   }  

      function get_interest_20day() {
        
         $sql = "SELECT SUM(loan_types.interest / 100 * payments.amount) AS interest FROM loan_types JOIN loans ON loan_types.id = loans.loantype RIGHT JOIN payments ON loans.id = payments.loanid WHERE payments.date > DATE_ADD(CURDATE(), INTERVAL -20 DAY)";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return 'K'.number_format($row['interest']);
    
   }  

         function get_collections_20day() {
        
         $sql = "SELECT SUM(payments.amount) AS collected FROM payments WHERE payments.date > DATE_ADD(CURDATE(), INTERVAL -20 DAY)";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return 'K'.number_format($row['collected']);
    
   }  

            function get_cashouts_20day() {
        
         $sql = "SELECT SUM(loans.amount) AS principal FROM loans WHERE loan_date > DATE_ADD(CURDATE(), INTERVAL -20 DAY)";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return 'K'.number_format($row['principal']);
    
   }  

        function employee($eid) {
        
         $sql = "SELECT *, employees.id AS eid FROM employees LEFT JOIN paymethods ON employees.paymethod = paymethods.id WHERE employees.id = '$eid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
    
   }  

       function groupdebtors($id) {
        
         $sql = "SELECT *, debtors.id AS did FROM debtors JOIN groupmembers ON debtors.id = groupmembers.member WHERE groupmembers.groupid = '$id'";
         $result = $this->db->query($sql);
         return $result;
    
   } 

        function collateral() {
        
      $sql = "SELECT debtors.title, debtors.fname, debtors.lname, loans.id, col_name, conditions.condition, amount, col_status, col_status.col_desc FROM debtors JOIN loans ON debtors.id = loans.debtor JOIN conditions ON loans.col_condition = conditions.id LEFT JOIN col_status ON loans.col_status = col_status.id WHERE loans.col_status < 3";
         $result = $this->db->query($sql);
         return $result;
   } 

      function sold($lid){

        $sql = "SELECT amount FROM salesx WHERE loanid = '$lid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['amount'];

   }

   function debtorcollateral($id) {
        
         $sql = "SELECT debtors.id, debtors.title, debtors.fname, debtors.lname, loans.id, col_name, conditions.condition, balance FROM debtors JOIN loans ON debtors.id = loans.debtor JOIN conditions ON loans.col_condition = conditions.id WHERE debtors.id = '$id'";
         $result = $this->db->query($sql);
         return $result;
   } 

      function debtorsms($id) {
        
         $sql = "SELECT * FROM sentmessages WHERE debtor = '$id'";
         $result = $this->db->query($sql);
         return $result;
   } 

         function debtordocs($id) {
        
         $sql = "SELECT * FROM documents WHERE uid = '$id'";
         $result = $this->db->query($sql);
         return $result;
   } 


        function debtorbalance($loanid) {
        
         $sql = "SELECT balance FROM loans WHERE id = '$loanid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['balance'];
    
   } 

          function totalcollections() {
        
         $sql = "SELECT SUM(amount) AS collected FROM payments";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return 'K'.number_format($row['collected'],2);
    
   } 

     function totalpaid() {
        
         $sql = "SELECT SUM(amount) AS total FROM payments";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['total'], 2);
   }

    function itemsdue() {
        
         $sql = "SELECT SUM(owing) AS total FROM sales";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['total'], 2);
   }

     function sumitems() {
        
         $sql = "SELECT SUM(price) AS total FROM sales";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['total'], 2);
   }

        function sumitemsx() {
        
          $sql = "SELECT SUM(amount) AS total FROM loans WHERE col_status != '2'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['total'], 2);
   }


   function sale_paymentx($loanid,$amount, $date) {
        
     $sql = "INSERT INTO salesx (loanid, amount, date) VALUES ('$loanid', '$amount', '$date')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

      function stock_update($loanid) {
        
     $sql = "UPDATE loans SET col_status = '2' WHERE id = '$loanid'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }  

        function sumpurchases() {
        
         $sql = "SELECT SUM(amount) AS total FROM purchases";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['total'], 2);
   }

     function checkuser($uid) {
        
         $sql = "SELECT COUNT(*) AS user FROM u859960976_branch2.debtors WHERE unique_no = '$uid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();


         if($row['user'] > 0) {

            return 'success';

         } else {

            return $this->db->error;

         }


       
   }

     function countitems() {
        
         $sql = "SELECT COUNT(*) AS items FROM sales";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['items'];
   }

     function countbags() {
        
         $sql = "SELECT SUM(bags) AS items FROM purchases";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['items'];
   }
            function addmypayments($id) {
        
         $sql = "SELECT SUM(amount) AS paid FROM payments WHERE loanid = '$id'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return number_format($row['paid'],2);
   }  

 function totalbalance() {
        
         $sql = "SELECT SUM(balance) AS balance FROM loans";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return  $row['balance'];
   } 

    function get_number($did) {
        
         $sql = "SELECT mobile_no AS number FROM debtors WHERE id = '$did'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['number'];
   } 

       function loan_balance($loanid) {
        
         $sql = "SELECT balance FROM loans WHERE id = '$loanid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['balance'];
   } 

    function singledebtorname($id) {
        
         $sql = "SELECT title, fname, lname FROM debtors WHERE id = '$id'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'];
   } 


    function getpaytype($loanid) {
        
         $sql = "SELECT loan_name FROM loan_types LEFT JOIN loans ON loans.loantype = loan_types.id WHERE loans.id = '$loanid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['loan_name'];
   } 

      function earnings() {
        
         $sql = "SELECT SUM(loan_types.interest / 100 * payments.amount) AS interest, payments.date AS type FROM loan_types JOIN loans ON loan_types.id = loans.loantype RIGHT JOIN payments ON loans.id = payments.loanid ORDER BY payments.id DESC LIMIT 20";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return 'k'.number_format($row['interest'],2);
   } 

   function viewpayments(){
         $sql = "SELECT * FROM payments";
         $result = $this->db->query($sql);
         return $result;
   }

      function getexpenses(){
         $sql = "SELECT * FROM expenses";
         $result = $this->db->query($sql);
         return $result;
   }

        function getsales(){
         $sql = "SELECT *, sales.id AS sid, statuses.status AS st FROM `sales` LEFT JOIN debtors ON sales.debtor = debtors.id JOIN statuses ON sales.status = statuses.id";

         $result = $this->db->query($sql);
         return $result;
   }

          function getpurchases(){
         $sql = "SELECT purchases.*, statuses.status AS st, debtors.title, debtors.fname, debtors.lname FROM purchases LEFT JOIN statuses ON purchases.status = statuses.id LEFT JOIN debtors ON purchases.buyer_id = debtors.id";

         $result = $this->db->query($sql);
         return $result;
   }

      function getbranches(){
         $sql = "SELECT * FROM branches";
         $result = $this->db->query($sql);
         return $result;
   }


    function singlepayments($id){
        $sql = "SELECT * FROM payments WHERE debtor = '$id'";
         $result = $this->db->query($sql);
         return $result;
   }

     function getgroups(){
         $sql = "SELECT * FROM loangroups LEFT JOIN debtors ON loangroups.leader = debtors.id";
         $result = $this->db->query($sql);
         return $result;
   }

     function add_debtor($firstname, $lastname, $business, $uid, $gender, $title, $phone, $email, $dob, $address, $city, $province, $landline, $status, $photo, $photoname, $idpic, $idpicname, $docs) {

         $pic = rand(1000,9999). basename($photoname);
         $path = "../uploads/photos/".$pic;
         move_uploaded_file($photo['tmp_name'], $path);

         $iddd = rand(1000,9999). basename($idpicname);
         $idpath = "../uploads/ids/".$iddd;
         move_uploaded_file($idpic['tmp_name'], $idpath);

 

        $sql = "INSERT INTO debtors (fname, lname, gender, country, title, mobile_no, email, unique_no, dob, address, city, province_state, zipcode, landline, business_name, working_status, photo, idpic, creation_date)
VALUES ('$firstname', '$lastname', '$gender', 'Zambia', '$title', '$phone', '$email', '$uid', '$dob', '$address', '$city', '$province', '10101', '$landline', '$business', '$status', '$path', '$idpath', NOW())";

    
         $result = $this->db->query($sql);
         
         if ($result) {
      
          $last_id = $this->db->insert_id;

        if (count($docs) > 0){

           for($i=0; $i<count($docs); $i++){
            $target_path = "../uploads/docs/";
            $ext = explode('.', basename($docs[$i]));
            $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext)-1]; 

            move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path);

            $sqdoc = "INSERT INTO documents (uid, file) VALUES ('$last_id', '$target_path')";
            $this->db->query($sqdoc);
          
             }

         } else {

 
       }

        return $last_id;


         } else {
             echo 'failed';
         }

   }  



        function add_employee($title, $fname, $lname, $address, $gender, $phone, $nrc, $email, $dob, $city, $state, $country, $employer, $paymethod, $department, $salary, $occupation, $bank, $branchcode, $accnumber, $photo, $photoname, $idpic, $idpicname) {

         $pic = rand(1000,9999). basename($photoname);
         $path = "../uploads/photos/".$pic;
         move_uploaded_file($photo['tmp_name'], $path);

         $iddd = rand(1000,9999). basename($idpicname);
         $idpath = "../uploads/ids/".$iddd;
         move_uploaded_file($idpic['tmp_name'], $idpath);

        

        $sql = "INSERT INTO employees (title, fname, lname, address, gender, mobile_no, nrc, email, dob, city, state, country, photo, id_pic, employer, paymethod, department, salary, occupation, bank, branchcode, accnumber, created)
VALUES ('$title', '$fname', '$lname', '$address', '$gender', '$phone', '$nrc', '$email', '$dob', '$city', '$state', '$country', '$path', '$idpath', '$employer', '$paymethod', '$department', '$salary', '$occupation', '$bank', '$branchcode', '$accnumber', NOW())";

    
         $result = $this->db->query($sql);
         
         if ($result) {
             echo 'success';
         } else {
             echo 'failed';
         }

   }  

           function update_employee($eid, $title, $fname, $lname, $address, $gender, $phone, $nrc, $email, $dob, $city, $state, $country, $employer, $paymethod, $department, $salary, $occupation, $bank, $branchcode, $accnumber, $photo, $photoname, $idpic, $idpicname) {

         $pic = rand(1000,9999). basename($photoname);
         $path = "../uploads/photos/".$pic;
         move_uploaded_file($photo['tmp_name'], $path);

         $iddd = rand(1000,9999). basename($idpicname);
         $idpath = "../uploads/ids/".$iddd;
         move_uploaded_file($idpic['tmp_name'], $idpath);

        

        $sql = "UPDATE employees SET title = '$title', fname = '$fname', lname = '$lname', address = '$address', gender = '$gender', mobile_no = '$phone', nrc = '$nrc', email = '$email', dob = '$dob', city = '$city', state = '$state', country = '$country', photo = '$path', id_pic = '$idpath', employer = '$employer', paymethod = '$paymethod', department = '$department', salary = '$salary', occupation = '$occupation', bank = '$bank', branchcode = '$branchcode', accnumber = '$accnumber' WHERE id = '$eid'";

    
         $result = $this->db->query($sql);
         
         if ($result) {
            return $result;
         } else {
             return $this->db->error;
         }

   }  

    function deleteDebtor($id) {
        
         $sql = "DELETE FROM debtors WHERE id = '$id'";
         $this->db->query($sql);
         
         if($sql) {
         $sql2 = "DELETE FROM loans WHERE debtor = '$id'";
         $this->db->query($sql2);
         }
         
   }   


    function deleteEmp($id) {
        
         $sql = "DELETE FROM employees WHERE id = '$id'";
         $sql .= "DELETE FROM advances WHERE eid = '$id'";
         $sql .= "DELETE FROM commisions WHERE employee = '$id'";
         
         $this->db->multi_query($sql);

   }   


    function freezeLoan($id, $f) {
        
         $sql = "UPDATE loans SET frozen = '$f' WHERE id = '$id'";
         $this->db->query($sql);  
   }   

    function resetBalance($id) {
        
         $sql = "UPDATE loans SET balance = 0 WHERE id = '$id'";
         $result = $this->db->query($sql);
     if ($result) {
             echo 'success';
         } else {
             echo 'failed';
         }


   }   


    function deleteProduct($pid) {
        
         $sql = "DELETE FROM products WHERE id = '$pid'";
         $this->db->query($sql);
   }   


    function deleteUser($uid) {
        
         $sql = "DELETE FROM users WHERE id = '$uid'";
         $this->db->query($sql);        
   }   

       function deleteExpense($exp) {
        
         $sql = "DELETE FROM expenses WHERE id = '$exp'";
         $this->db->query($sql);        
   }   

          function deleteSale($sale) {
        
         $sql = "DELETE FROM sales WHERE id = '$sale'";
         $this->db->query($sql);        
   }   

   function deletePurchase($p) {
        
         $sql = "DELETE FROM purchases WHERE id = '$p'";
         $this->db->query($sql);        
   }   

       function deleteFromGroup($id) {
        
         $sql = "DELETE FROM groupmembers WHERE member = '$id'";
         $this->db->query($sql);    
   }   

       function deleteGroup($id) {
        
         $sql = "DELETE FROM loangroups WHERE groupid = '$id'";

         $sql2 = "DELETE FROM groupmembers WHERE groupid = '$id'";
         
         $this->db->query($sql);
         $this->db->query($sql2);    
   }   

      function getdebtornames() {
        
         $sql = "SELECT id, title, fname, lname FROM debtors";
         $result = $this->db->query($sql);

         return  $result;
   }   

        function getstatuses() {
        
         $sql = "SELECT * FROM statuses";
         $result = $this->db->query($sql);

         return  $result;
   }   



 function getmonths() {
        
         $sql = "SELECT * FROM months";
         $result = $this->db->query($sql);

         return  $result;
   }   

         function getaccs() {
        
         $sql = "SELECT *, id AS accid FROM products";
         $result = $this->db->query($sql);

         return  $result;
   }   


      function getevents() {
        
         $sql = "SELECT title FROM events WHERE CAST(start_date as date) = CAST(NOW() as date)";
         $result = $this->db->query($sql);

         return  $result;
   }   

     function update_debtor($id, $firstname, $lastname, $business, $uid, $gender, $title, $phone, $email, $dob, $address, $city, $province, $landline, $status, $photo, $photoname, $idpic, $idpicname, $docs) {


      if (!empty($photo && $photoname) && empty($idpic && $idpicame)) {
         $pic = rand(1000,9999). basename($photoname);
         $path = "../uploads/photos/".$pic;
         move_uploaded_file($photo['tmp_name'], $path);

           $sql = "UPDATE debtors SET fname = '$firstname', lname = '$lastname', gender = '$gender', country = 'Zambia', title='$title', mobile_no='$phone', email='$email', unique_no = '$uid', dob='$dob', address = '$address', city = '$city', province_state = '$province', zipcode = '10101', landline = '$landline', business_name = '$business', working_status = '$status', photo = '$path' WHERE id = '$id'";



      } else if (!empty($idpic && $idpicname)&&empty($photo && $photoname)) {
         
         $iddd = rand(1000,9999). basename($idpicname);
         $idpath = "../uploads/ids/".$iddd;
         move_uploaded_file($idpic['tmp_name'], $idpath);

        $sql = "UPDATE debtors SET fname = '$firstname', lname = '$lastname', gender = '$gender', country = 'Zambia', title='$title', mobile_no='$phone', email='$email', unique_no = '$uid', dob='$dob', address = '$address', city = '$city', province_state = '$province', zipcode = '10101', landline = '$landline', business_name = '$business', working_status = '$status', idpic = '$idpath' WHERE id = '$id'";
      }

      else if (!empty($idpic && $idpicname) && !empty($photo && $photoname)) {

         $pic = rand(1000,9999). basename($photoname);
         $path = "../uploads/photos/".$pic;
         move_uploaded_file($photo['tmp_name'], $path);

         $iddd = rand(1000,9999). basename($idpicname);
         $idpath = "../uploads/ids/".$iddd;
         move_uploaded_file($idpic['tmp_name'], $idpath);

            $sql = "UPDATE debtors SET fname = '$firstname', lname = '$lastname', gender = '$gender', country = 'Zambia', title='$title', mobile_no='$phone', email='$email', unique_no = '$uid', dob='$dob', address = '$address', city = '$city', province_state = '$province', zipcode = '10101', landline = '$landline', business_name = '$business', working_status = '$status', photo = '$path', idpic = '$idpath' WHERE id = '$id'";

      } else if (empty($idpic && $idpicname) && empty($photo && $photoname)){
            $sql = "UPDATE debtors SET fname = '$firstname', lname = '$lastname', gender = '$gender', country = 'Zambia', title='$title', mobile_no='$phone', email='$email', unique_no = '$uid', dob='$dob', address = '$address', city = '$city', province_state = '$province', zipcode = '10101', landline = '$landline', business_name = '$business', working_status = '$status' WHERE id = '$id'";
      }
       
        
         $result = $this->db->query($sql);

           if ($result) {
      
        
        if (count($docs) > 0){

           for($i=0; $i<count($docs); $i++){
            $target_path = "../uploads/docs/";
            $ext = explode('.', basename($docs[$i]));
            $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext)-1]; 

            move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path);

            $sqdoc = "INSERT INTO documents (uid, file) VALUES ('$id', '$target_path')";
            $this->db->query($sqdoc);
          
             }

         } else {

 
       }
         
         if ($result) {
             echo 'success';
         } else {
             echo 'failed';
         }
       }
   }     




   function add_loantype($name, $days, $minamount, $collateral, $intrate, $grace, $intdefault, $paybackperiod, $msg1, $msg2txt) {

        $sql = "INSERT INTO loan_types (loan_name, days, min_principal_amount, collateral_based, grace_period, interest, penalty_interest_rate, penalty_payment_period, msg1, msg2text) VALUES ('$name', '$days', '$minamount', '$collateral', '$grace', '$intrate', '$intdefault', '$paybackperiod', '$msg1', '$msg2txt')";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

      function action($name, $action) {

        $sql = "INSERT INTO activity (user, action) VALUES ('$name', '$action')";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   } 

     function edit_loantype($loantypeid, $name, $days, $minamount, $collateral, $intrate, $grace, $intdefault, $paybackperiod, $msg1, $msg2txt) {

        $sql = "UPDATE loan_types SET loan_name = '$name', days = '$days', min_principal_amount = '$minamount', collateral_based = '$collateral', grace_period = '$grace', interest = '$intrate', penalty_interest_rate = '$intdefault', penalty_payment_period = '$paybackperiod', msg1 = '$msg1', msg2text = '$msg2txt' WHERE id = '$loantypeid'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

        function edit_groupname($groupid, $groupname) {

        $sql = "UPDATE loangroups SET groupname = '$groupname' WHERE groupid = '$groupid'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

    function edit_menus($menus, $uid) {

        $sql = "UPDATE users SET menus = '$menus' WHERE id = '$uid'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

       function edit_branches($branches, $uid) {

        $sql = "UPDATE users SET branchaccess = '$branches' WHERE id = '$uid'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

     function get_menus($uid) {

        $checked_arr = array();

        $sql = "SELECT menus FROM users WHERE id = '$uid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();

         $checked_arr = explode(",",$result['menus']);
         return $checked_arr;
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

        function changeskin($skin) {

        $sql = "UPDATE config SET appcolor = '$skin'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

//$appname, $denderid, $file, $filename
        function edit_app($appname, $senderid, $file, $filename) {

          $logo = rand(100,999). basename($filename);

        $sql = "UPDATE config SET appname = '$appname', senderid = '$senderid', logo = '$logo'";

        $path = "../dist/img/".$logo;
        move_uploaded_file($file['tmp_name'], $path);

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return 'failed';
         }
   }  

     function getroletypes() {
        
         $sql = "SELECT * FROM usergroups";
         $result = $this->db->query($sql);
         return $result;
   }    

        function getrights() {
        
         $sql = "SELECT * FROM userrights";
         $result = $this->db->query($sql);
         return $result;
   }    

        function getloantypes() {
        
         $sql = "SELECT * FROM loan_types";
         $result = $this->db->query($sql);
         return $result;
   }    

         function getsavingstypes() {
        
         $sql = "SELECT *,products.id AS idd FROM products LEFT JOIN intperiods ON intperiods.id = products.intperiod";
         $result = $this->db->query($sql);
         return $result;
   }    

         function getsavingstypeById($idd) {
        
         $sql = "SELECT *,products.id AS idd FROM products LEFT JOIN intperiods ON intperiods.id = products.intperiod WHERE products.id = '$idd'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();

         return $row;
   }    

      function getcommentsbyid($id) {
        
         $sql = "SELECT * FROM comments WHERE debtor = '$id'";
         $result = $this->db->query($sql);
         return $result;
   } 
  
     /*


      function add_advance($employee, $amount, $inst) {


        $c = date('Y-m-d');  
        $payment = $amount / $inst;

       

        for ($i = 0; $i < $inst; $i++) 
        {
         
            $c = date('Y-m-d', strtotime("+ 30 days", strtotime($c)));

          
            $sql = "INSERT INTO advances (eid, amount, paydate) VALUES ('$employee', '$payment', '$d')";
            $result = $this->db->query($sql);

        }
   }
   */

   function add_loan($loantype, $debtor, $amount, $date, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address, $inst) {

       $s = "SELECT interest, days FROM loan_types WHERE id = '$loantype'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       $int = $row['interest'];
       $days = $row['days'];
       // return $days;

       if ($s){

       $balance = ($amount * $int/100) + $amount; 
     
      

       
           for ($i = 1; $i <= $inst; $i++) 
        {
            $next = $i * 30;
         
            $due = date('Y-m-d', strtotime($date. ' + '.$next.' days'));
          

            $initial = $amount / $inst;
            $owe = $balance / $inst;

          
            $sql = "INSERT INTO loans (loantype, debtor, amount, balance, col_name, serialnumber, model_name, modelnumber, color, col_condition, address, loan_date, due_date) VALUES ('$loantype', '$debtor', '$initial', '$owe', '$colname', '$serial', '$modelname', '$modelnumber', '$color', '$col_condition', '$address', '$date', '$due')";

       $this->db->query($sql);

        }

    

       }   
   }  

      function add_payment($loanid, $debtor, $amount, $date) {


        $sql = "INSERT INTO payments (loanid, debtor, amount, date) VALUES ('$loanid','$debtor', '$amount', '$date')";
        $sql2 = "UPDATE loans SET balance = (balance - '$amount') WHERE debtor = '$debtor' AND id = '$loanid'";

          $this->db->query($sql);
          $this->db->query($sql2);
       
   }  


      function add_comment($debtor, $comment) {


        $sql = "INSERT INTO comments (debtor, comment, date) VALUES ('$debtor','$comment', NOW())";
     
          $this->db->query($sql);
    
   }  



   function countloans ($id) {

       $s = "SELECT COUNT(*) AS numloans FROM loans WHERE debtor = '$id' AND balance > 0";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numloans'];
   }

     function countsavings ($id) {

       $s = "SELECT COUNT(*) AS numaccs FROM accounts WHERE debtor = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numaccs'];
   }

        function user_firstname ($uid) {

       $s = "SELECT firstname FROM users WHERE id = '$uid'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['firstname'];
   }



      function countevents () {

       $s = "SELECT COUNT(*) AS numevents FROM events WHERE CAST(start_date as date) = CAST(NOW() as date)";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numevents'];
   }


      function accbalance () {

       $s = "SELECT COUNT(*) AS numevents FROM events WHERE CAST(start_date as date) = CAST(NOW() as date)";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numevents'];
   }

        function countloanstoday () {

       $s = "SELECT COUNT(*) AS numloans FROM loans WHERE due_date = CURDATE()";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numloans'];
   }


    function countpay ($id) {

       $s = "SELECT COUNT(*) AS numpay FROM payments WHERE debtor = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numpay'];
   }

     function countcol ($id) {

       $s = "SELECT COUNT(*) AS numcol FROM loans WHERE col_condition > 0 AND debtor = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numcol'];
   }

     function countsms ($id) {

       $s = "SELECT COUNT(*) AS numsms FROM sentmessages WHERE debtor = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numsms'];
   }

        function countdocs ($id) {

       $s = "SELECT COUNT(*) AS numdocs FROM documents WHERE uid = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numdocs'];
   }

        function countcom ($id) {

       $s = "SELECT COUNT(*) AS numcom FROM comments WHERE debtor = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['numcom'];
   }

   function numgroupdebtors ($id) {

       $s = "SELECT COUNT(*) AS num FROM groupmembers WHERE groupid = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['num'];
   }

     function group_principal ($id) {

       $s = "SELECT SUM(amount) AS p FROM loans JOIN groupmembers ON loans.debtor = groupmembers.member WHERE groupmembers.groupid = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['p'];
   }

        function group_debt ($id) {

       $s = "SELECT SUM(balance) AS d FROM loans JOIN groupmembers ON loans.debtor = groupmembers.member WHERE groupmembers.groupid = '$id'";
       $rs = $this->db->query($s);
       $row = $rs -> fetch_assoc();
       
       return $row['d'];
   }


   function edit_loan($loanid, $loantype, $debtor, $amount, $newbalance, $date, $colname, $serial, $modelname, $modelnumber, $color, $col_condition, $address) {

    $due = date('Y-m-d', strtotime($date. ' + 30 days'));

        $sql = "UPDATE loans SET loantype = '$loantype', debtor = '$debtor', amount = '$amount', balance = $newbalance, col_name = '$colname', serialnumber = '$serial', model_name = '$modelname', modelnumber = '$modelnumber', color = '$color', col_condition = '$col_condition', address = '$address', loan_date = '$date', due_date = '$due' WHERE id = '$loanid'";

         $result = $this->db->query($sql);
         
         if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }
   }  
   
        function getloans() {
        
         $sql = "SELECT loan_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE loans.balance > 0";
         $result = $this->db->query($sql);
         return $result;
   }    

           function closedloans() {
        
         $sql = "SELECT loan_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE balance < 1";
         $result = $this->db->query($sql);
         return $result;
   }    

            function frozenloans() {
        
         $sql = "SELECT loan_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE frozen = 1";
         $result = $this->db->query($sql);
         return $result;
   }    

           function getloanstoday() {
        
         $sql = "SELECT loan_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE loans.due_date = CURDATE()";
         $result = $this->db->query($sql);
         return $result;
   }    

    function getoverdue() {
        
         $sql = "SELECT due_date, debtors.id AS ddid, loans.id AS loanid, debtors.title, debtors.fname, debtors.lname, loan_types.loan_name, loan_types.interest, loans.amount, loans.balance, reloan FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE reloan > 0 AND balance > 0 AND frozen = 0";
         $result = $this->db->query($sql);
         return $result;
   }    
   
    function getbalance($id) {
        
         $sql = "SELECT amount FROM loans WHERE debtor = '$id'";
         $result = $this->db->query($sql);
         return $result;
   }   
   
   function getallpayments($id){
         $sql = "SELECT SUM(amount) AS total FROM payments WHERE debtor = '$id'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['total'];
   }
   
      function lastpaydate($id){
         $sql = "SELECT date FROM payments WHERE debtor = '$id' ORDER BY id DESC LIMIT 1";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['date'];
   }
   
    function numdebtors() {
        
         $sql = "SELECT COUNT(id) AS cb FROM debtors";
         $result = $this->db->query($sql);
         
             while ($row = mysqli_fetch_array($result)) {

                 return  $row['cb'];
     }

   }    
   
    
    function sumprincipal() {
        
         $sql = "SELECT SUM(amount) AS total FROM loans WHERE balance > 0";
         $result = $this->db->query($sql);
         
             while ($row = mysqli_fetch_array($result)) {

                 return $row['total'];
     }

   }   
   
   
       function sumprincipalsingle($id) {
        
         $sql = "SELECT SUM(amount) AS total FROM loans WHERE loans.debtor = '$id' AND loans.balance > '0'";
         $result = $this->db->query($sql);
         
             while ($row = mysqli_fetch_array($result)) {

                 return  number_format($row['total']);
     }

   }   
   
   function sumdebt() {
        
         $sql = "SELECT SUM(balance) AS totaldebt FROM loans WHERE loans.balance > 0";
         $result = $this->db->query($sql);
         
             while ($row = mysqli_fetch_array($result)) {


                 return  number_format($row['totaldebt']);
     }

   }    
   
      function sumdebtsingle($id) {
        
         $sql = "SELECT SUM(balance) AS totaldebt FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id WHERE loans.debtor = '$id' AND loans.balance > '0'";
         $result = $this->db->query($sql);
         
             while ($row = mysqli_fetch_array($result)) {


                 return  number_format($row['totaldebt']);
     }

   }    
   
      function suminterest() {
        
       $suminterest = $this->totalbalance() - $this->sumprincipal();

                 return $suminterest;
     
   }   


        function singleloans($idd) {
        
            $sql = "SELECT loans.id AS lid, loans.frozen, loans.balance, loans.loan_date, loans.due_date, loan_types.loan_name,loans.amount, loan_types.interest FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id WHERE loans.debtor = '$idd' AND loans.balance > 0";
         $result = $this->db->query($sql);
         return $result;
   }    


        function singletrans($accnum) {
        
            $sql = "SELECT * FROM transactions LEFT JOIN transtypes ON transactions.transtype = transtypes.id WHERE accnumber = '$accnum'";
         $result = $this->db->query($sql);
         return $result;
   }    
   
         function singledebtor($id) {
        
            $sql = "SELECT * FROM debtors WHERE id = '$id'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }    


    function singleloan($loanid) {
        
         $sql = "SELECT * FROM loans LEFT JOIN conditions ON loans.col_condition = conditions.id WHERE loans.id = '$loanid'";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }  

       function lastpay($id) {
        
         $sql = "SELECT date FROM payments WHERE debtor = '$id' ORDER BY id DESC limit 1";
         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }    

      function singleloantype($loanid) {
        
            $sql = "SELECT loan_types.id AS loantypeid, loan_types.loan_name, loan_types.interest FROM loan_types LEFT JOIN loans ON loan_types.id = loans.loantype WHERE loans.id = '$loanid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

  

       function getloandebtor($loanid) {
        
            $sql = "SELECT *, debtors.id AS did FROM loans LEFT JOIN debtors ON loans.debtor = debtors.id WHERE loans.id = '$loanid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

        function singleloantypes($loantypeid) {
        
            $sql = "SELECT * FROM loan_types WHERE id = '$loantypeid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }  

        function singleloandebtor($loanid) {
        
            $sql = "SELECT * FROM debtors LEFT JOIN loans ON debtors.id = loans.debtor WHERE loans.id = '$loanid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

         function singleamount($loanid) {
        
            $sql = "SELECT amount, balance FROM loans WHERE loans.id = '$loanid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

     function singledate($loanid) {
        
            $sql = "SELECT loan_date FROM loans WHERE loans.id = '$loanid'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

        function amountpaid($id) {
        
            $sql = "SELECT SUM (amount) AS paid FROM payments WHERE debtor = '$id'";

         $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row;
   }   

  

      function add_group($groupid, $groupname, $leader, $members) {
        
$sql = "INSERT INTO loangroups (groupid, groupname, leader) VALUES ('$groupid', '$groupname', '$leader')";

           $this->db->query($sql);

         
   }    

     function add_member($groupid, $member) {
        
$sql = "INSERT INTO groupmembers (groupid, member) VALUES ('$groupid', '$member')";

           $this->db->query($sql);

   }    

//$firstname, $lastname, $role, $username, $password, $menus, $rights
     function add_user($firstname, $lastname, $role, $username, $password, $menus, $rights) {

      $m = implode(",",$menus);
        
$sql = "INSERT INTO users (firstname, lastname, groupe, username, password, menus, rights) VALUES ('$firstname', '$lastname', '$role', '$username', '$password', '$m', '$rights')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }         

   function add_product($sname, $scode, $duration, $minbalance, $intperiod, $interest, $notification) {

        
$sql = "INSERT INTO products (name, scode, duration, minbalance, intperiod, interest, notification) VALUES ('$sname', '$scode', '$duration', '$minbalance', '$intperiod', '$interest', '$notification')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   } 

      function add_advance($employee, $amount, $inst) {


        $a_date = date('Y-m-d');
        $payment = $amount / $inst;

        //START DATE
        $c = date("Y-m-t", strtotime($a_date));

        for ($i = 0; $i < $inst; $i++) 
        {
         
            $c = date('Y-m-d', strtotime("+ 30 days", strtotime($c)));

            $d = date("Y-m-t", strtotime($c));

            $sql = "INSERT INTO advances (eid, amount, paydate) VALUES ('$employee', '$payment', '$d')";
            $result = $this->db->query($sql);

        }
   }

   function commission($emp, $amount, $date){

      $sql = "INSERT INTO commissions (employee, amount, date) VALUES ('$emp', '$amount', '$date')";
      $this->db->query($sql);

   } 

   function advance($emp,$date){
 
       $sql = "SELECT * FROM advances WHERE paydate = '$date' AND eid = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
       $rowcount=mysqli_num_rows($result);

       if ($rowcount > 0) {
         return $row['amount'];
       } else {
          return $rowcount;
       }

   }

     function get_advance($emp,$date){
 
       $sql = "SELECT * FROM advances WHERE paydate = '$date' AND eid = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
       $rowcount=mysqli_num_rows($result);


            if ($rowcount > 0) {
         return number_format($row['amount'],2);
       } else {
          return $rowcount;
       }

   }


   function monthly_interest($month,$year){

       $sql = "SELECT SUM(loan_types.interest / 100 * payments.amount) AS interest FROM loan_types JOIN loans ON loan_types.id = loans.loantype RIGHT JOIN payments ON loans.id = payments.loanid WHERE MONTH(payments.date) = '$month' AND YEAR(payments.date) = '$year'";

       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
       
       return number_format($row['interest'],2);
      
   }

      function commissions($emp,$date){
 
       $sql = "SELECT SUM(amount) AS comm FROM commissions WHERE date = '$date' AND employee = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
       $rowcount=mysqli_num_rows($result);

       return $row['comm'];

   }

      function napsa($emp){
 
       $sql = "SELECT salary FROM employees WHERE id = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
     
       $napsa = $row['salary'] * 0.05;

       return $napsa;

   }

     function get_napsa($emp){
 
       $sql = "SELECT salary FROM employees WHERE id = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();
     
       $napsa = $row['salary'] * 0.05;

       return number_format($napsa,2);

   }


    function paye($emp){
 
       $sql = "SELECT salary FROM employees WHERE id = '$emp'";
       $result = $this->db->query($sql);
       $row = $result -> fetch_assoc();

       $salary = $row['salary'];

   if ($salary < 4000.01){

    return 0;

   } elseif ($salary > 4000.00 && $salary < 4800.01) {
     
     $p = 0.25;
     $d = (($salary - 4000) * $p) + 200;
     return $d;
 
   } elseif ($salary > 4800.00 && $salary < 6900.01) {

     $p = 0.3;

     $d = (($salary - 4800) * $p) + 360;
     
     return $d;
 
   } elseif ($salary > 6900.00) {
    
      $p = 0.375;

       $d = ($salary - 6900) * $p;

       return $d;
   }

         
}

  
   
   
   
   function edit_product($idd, $sname, $scode, $duration, $minbalance, $intperiod, $interest, $notification) {

        
$sql = "UPDATE products SET name = '$sname', scode = '$scode', duration = '$duration', minbalance = '$minbalance', intperiod = '$intperiod', interest = '$interest', notification = '$notification' WHERE id = '$idd'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }  

      function add_acc($debtor, $accid, $obalance) {

        $code = $this-> getcode($accid);
        $number = rand(100000,999999);
        $accnumber = $code.$number;

        
     $sql = "INSERT INTO accounts (debtor, accid, accnumber, obalance, balance, initial_date, lastrans) VALUES ('$debtor', '$accid', '$accnumber', '$obalance', '$obalance', NOW(), NOW())";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }        


   function sale_payment($saleid,$amount) {
        
     $sql = "UPDATE sales SET owing = owing - '$amount' WHERE id = '$saleid'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

         function add_expense($item, $cost, $date) {

        
     $sql = "INSERT INTO expenses (item, cost, date) VALUES ('$item', '$cost', '$date')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

               function add_income($item, $cost, $date) {

        
     $sql = "INSERT INTO income (item, cost, date) VALUES ('$item', '$cost', '$date')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

//price debtor  owing inst  date_borrowed next_date status

            function add_sale($item, $price, $debtor, $owing, $inst, $sdate, $next) {

        
     $sql = "INSERT INTO sales (item, price, debtor, owing, inst, date_borrowed, next_date, status) VALUES ('$item', '$price', '$debtor', '$owing', '$inst', '$sdate', '$next', '1')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   


    function add_purchase($item, $amount,$price,$bags, $debtor, $pdate, $ydate) {

        
     $sql = "INSERT INTO purchases (item, amount, price_per_bag, bags, buyer_id, pdate, ydate, status) VALUES ('$item', '$amount', '$price', '$bags', '$debtor', '$pdate', '$ydate', '5')";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

     function edit_purchase($id, $item, $amount,$price,$bags, $debtor, $pdate, $ydate, $status) {

        
     $sql = "UPDATE purchases SET item = '$item', amount = '$amount', price_per_bag = '$price', bags = '$bags', buyer_id = '$debtor', pdate = '$pdate', ydate = '$ydate', status = '$status' WHERE id = '$id'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }   

      function add_trans($acctype, $trans, $amount, $date, $debtor, $accnum) {


  if ($trans == '1'){

       $sql = "UPDATE accounts SET balance = balance + '$amount' WHERE accnumber = '$accnum'";
       $this->db->query($sql);


       $sql2 = "INSERT INTO transactions (acctype, accnumber, transtype, amount, transdate) VALUES ('$acctype', '$accnum', '$trans', '$amount', '$date')";

       $result = $this->db->query($sql2);

                if ($result) {
           return 'Account has been credited';
         } else {
             return $this->db->error;
         }

      } else if ($trans == '2') {

        $curbalance = $this->balance($accnum);

        if ($curbalance < $amount) {

          return 'Insufficient Funds';

        } else {

       $sql = "UPDATE accounts SET balance = balance - '$amount' WHERE accnumber = '$accnum'";
       $this->db->query($sql);

       $sql2 = "INSERT INTO transactions (acctype, accnumber, transtype, amount, transdate) VALUES ('$acctype', '$accnum', '$trans', '$amount', '$date')";

       $this->db->query($sql2);

       return 'Account has been debited';
        
            }    
        }     
   }   

    function make_trans($loanid, $acctype, $trans, $amount, $debtor, $accnum) {


       $sql = "UPDATE accounts SET balance = balance - '$amount', lastrans = CURDATE() WHERE accnumber = '$accnum'";
       $this->db->query($sql);


       $sql2 = "INSERT INTO transactions (acctype, accnumber, transtype, amount, transdate) VALUES ('$acctype', '$accnum', '3', '$amount', NOW())";
        $this->db->query($sql2);


       $sql3 = "UPDATE loans SET balance = balance - '$amount' WHERE id = '$loanid'";
       $this->db->query($sql3);


        $sql4 = "INSERT INTO payments (loanid, debtor, amount, date) VALUES ('$loanid', '$debtor', '$amount', NOW())";

       $result = $this->db->query($sql4);

                if ($result) {
           return 'Amount has been tranfered';
         } else {
             return $this->db->error;
         }

    
   }   
  
      public function getcode($accid){

          $sql = "SELECT scode FROM products WHERE id = '$accid'";

        $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['scode'];
      }

      //accbalance
    public function balance($accnum){

          $sql = "SELECT balance FROM accounts WHERE accnumber = '$accnum'";

        $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['balance'];
      }

       public function obalance($accnum){

          $sql = "SELECT obalance FROM accounts WHERE accnumber = '$accnum'";

        $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['obalance'];
      }

    public function acctype($accnum){

          $sql = "SELECT name FROM products LEFT JOIN accounts ON products.id = accounts.accid WHERE accounts.accnumber = '$accnum'";

        $result = $this->db->query($sql);
         $row = $result -> fetch_assoc();
         return $row['name'];
      }


        function edit_user($uid, $firstname, $lastname, $role, $username, $password, $rights) {

$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', groupe = '$role', username = '$username', password = '$password', rights = '$rights' WHERE id = '$uid'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }    

         function edit_branch($bid, $branchname) {

$sql = "UPDATE branches SET branchname = '$branchname' WHERE id = '$bid'";

        $result = $this->db->query($sql);

              if ($result) {
             return 'success';
         } else {
             return $this->db->error;
         }

   }    
   
   

}


   
?>