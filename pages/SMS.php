<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class SMS{
    var $Debtor = "" ;
    var $SenderAddress = "" ;   
    var $Destination = "" ;
    var $Message = "" ;
    var $objResult = "" ;


    public $dbHost     = "localhost";
    public $dbPassword = "Theres@1#";
  
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

    function bulkSMS() {

         $sql = "SELECT id, mobile_no AS number FROM debtors";
         $result = $this->db->query($sql);
         return $result;
  
    }

    function sendSMS() {
      
      $fields = array(
        'type' => 0, 
        'dlr' => 1,
        'destination' => '' . $this->Destination  . '', 
        'source' => ''. $this->SenderAddress .'',
        'message' => ''. $this->Message . '', 
        'username' => 'chobela12', 
        'password' => 'theresa1'
      );      
      
      $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($fields),
        ),
      );
      $context  = stream_context_create($options);
      $result = file_get_contents(base64_decode("aHR0cDovL2FwaS5ybWxjb25uZWN0Lm5ldC9idWxrc21zL2J1bGtzbXM="), false, $context);
      
 
      
      $postresult = explode("|", trim($result)) ;

     
      $number = $postresult[1];
      $smsid = $postresult[2];
      $debtor = $this->Debtor;
      $message = $this->Message;

switch ($postresult[0]) {
  case ('1701'):
     $status = 'Message Delivered';
    break;
  case ('1702'):
    $status = 'Failed : Parameter missing';
    break;
  case ('1703'):
     $status = 'Failed : Invalid username and password';
    break;
    case ('1704'):
     $status = ' Failed : Invalid message type';
    break;
     case ('1705'):
     $status = 'Failed : Invalid message';
    break;
     case ('1706'):
     $status = 'Failed : Invalid Destination';
    break;
     case ('1707'):
     $status = 'Failed : Invalid Sender ID';
    break;
     case ('1708'):
     $status = 'Failed : Invalid Dir Value';
    break;
     case ('1709'):
     $status = 'User Validation failed';
    break;
     case ('1710'):
     $status = 'Failed : Internal error.';
    break;
      case ('1715'):
     $status = 'Failed : Response timeout.';
    break;
      case ('1025'):
     $status = 'Failed : Insufficient credit.';
    break;
       case ('1032'):
     $status = 'DND reject.';
    break;
       case ('1028'):
     $status = 'Spam message.';
    break;
}
     
  
                      
      $sql = "INSERT INTO sentmessages (debtor, number, message, poststatus, smsid, sent_on) VALUES ('$debtor', '$number', '$message', '$status', '$smsid', NOW())";

      $result = $this->db->query($sql);

      if ($status = '1701') {
        $sql2 = "UPDATE config SET sms = sms - 1";
        $this->db->query($sql2);
      } else {

      }

       if ($result) {
             return $status;
         } else {
             return $this->db->error;
         }
 
    }
}
?>