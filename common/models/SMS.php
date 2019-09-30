<?php
/**
 * Created by PhpStorm.
 * User: UMER ZAMAN
 * Date: 17/07/2019
 * Time: 10:09
 */

namespace common\models;

class SMS
{

    // define basic variables
public $contact_number="966594078099";
public  $messageBody;
public  $headerLentgh;

    // define constructor to initialize basic variables
    public function __construct($contact)
    {
       $this->contact_number="966594078099";
       $this->contact_number= $contact;
        $this->messageBody    =   'عميلنا العزيز،،،'.'\n';
        $this->messageBody    .=   'نأمل منكم تقييم الخدمه المقدمه لكم من قبل موظف المبيعات'.'\n';
        $this->messageBody    .=   'https://survey.stcchannels.com.sa/Opinion/Mydani \n\n\n';
        $this->messageBody    .=   'آراؤكم محل  أهتمامنا دائماً...';
        $this->headerLentgh   =464;
        $this->headerLentgh   +=  strlen($this->messageBody);

    }

// define function to send SMS and return true or false

    public function SendMessage(){
        $ch = curl_init();
        $random_string  =   self::random_string(1);
//            echo $headerLentgh;exit;
        curl_setopt($ch, CURLOPT_URL, 'https://api.stcchannels.com.sa:7287/api/rest/v/1.0/HR/SendSMS');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"sendSmsRq\" : {\n    \"header\" : {\n      \"messageId\" : \"SendmsgTest123\",\n      \"businessServiceName\" : \"HumanResources\",\n      \"senderId\" : \"Middleware\",\n      \"functionId\" : \"SendSMSNotification\",\n      \"timestamp\" : \"2019-01-09T01:10:44\",\n      \"userId\" : \"Maydani\",\n      \"language\" : \"ENGLISH\"\n    },\n    \"body\" : {\n      \"senderName\" : \"STCCSurvey\",\n      \"messageDetails\" : {\n        \"message\" : \"$this->messageBody\",\n        \"number\" : [ \"$this->contact_number\"]\n      }\n    }\n  }\n}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'Accept-Encoding: gzip, deflate';
        $headers[] = 'Authorization: Basic bWF5ZGFuaTptYXlkYW5pI3N0Y2Mx';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Connection: keep-alive';
        $headers[] = "Content-Length:".$this->headerLentgh;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Host: api.stcchannels.com.sa:7287';
        $headers[] = 'Postman-Token: 9b1fe912-5b6f-4ccd-ae1c-9af7b7da8107,a12dc3d5-ead1-495a-a787-c9c7c522664c';
        $headers[] = 'User-Agent: PostmanRuntime/7.15.2';
        $headers[] = 'X-Gateway-Apikey: a01943e4-7990-4c8e-a886-3302673ffdb0';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response=true;
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
            $response=false;
        }
        curl_close($ch);

        return $response;

    }

    private static function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }


}