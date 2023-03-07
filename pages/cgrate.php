<?php

$issuer = 'Airtel';
$amount = 1;
$recphone = '0979825070';


	//send money
	$url    = 'https://543.cgrate.co.zm/Konik/KonikWs?wsdl';
$headers  = array(
   'Content-Type: text/xml'
);

$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:kon="http://konik.cgrate.com">
      <soapenv:Header>
         <wsse:Security soapenv:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <wsse:UsernameToken wsu:Id="UsernameToken-1" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
               <wsse:Username>1602070015602</wsse:Username>
               <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">gLwdyQR6</wsse:Password>
            </wsse:UsernameToken>
         </wsse:Security>
   </soapenv:Header>
<soapenv:Body>
<kon:processCashDeposit>
<transactionAmount>'.$amount.'</transactionAmount>
<customerAccount>'.$recphone.'</customerAccount>
<issuerName>'.$issuer.'</issuerName>
</kon:processCashDeposit>
</soapenv:Body>
</soapenv:Envelope>';




$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
$response = curl_exec($curl);
curl_close($curl);

$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
$x = new SimpleXMLElement($response);
$body = $x->xpath('//envBody')[0];
$array = json_decode(json_encode((array)$body), TRUE); 

$data = $array['ns2processCashDepositResponse']['return'];

// Do as you wish with $data
print_r($data);
echo 'response code is ' . $data['responseCode'];




?>

