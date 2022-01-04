<?php 

namespace app;

class MSG91 {

    function __construct() {

    }
   
    private $API_KEY = '371459AbDwoVZJM9US61d3ea2eP1';
    private $SENDER_ID = "SAFESP";
    private $ROUTE_NO = 4;
    private $RESPONSE_TYPE = 'json';

    public function sendSMS($otp, $mobileNumber){
        $isError = 0;
        $errorMessage = true;

        $message = urldecode("Welcome to Safespace , Your OTP is : $otp");

        $postData = array(
            'authkey' => $this->API_KEY,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' =>  $this->SENDER_ID,
            'route' =>   $this->ROUTE_NO,
            'response' =>$this->RESPONSE_TYPE,
        );

        $url = "https://control.msg91.com/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch , array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        $output = curl_exec($ch);

        if(curl_errno($ch)){
           $isError = true;
           $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return response()->json(['message' =>$errorMessage]);
        }else{
            return response()->json(['error' => 0]);
        }
    }
}

?>