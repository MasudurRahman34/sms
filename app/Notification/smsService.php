<?php
namespace App\Notification;
 class smsService  implements notificationProcess
 {
    public function notification($contact, $msg){



  $url = "http://sms.aroenterprisebd.com/smsapi";
  $data = [
    "api_key" => "C20058955e53bd217e7da0.61071270",
    "type" => "text",
    "contacts" => $contact,
    "senderid" => "8809601000500",
    "msg" => $msg,
  ];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;

        //https://alpha.net.bd/SMS/API/
        //get method
    //     $username = "YourUserNameHere";
    // $hash = "YourTokenCodeHere"; //generate token from the control panel
    // $numbers = "017xxxxxxxx,018xxxxxxxx"; //Recipient Phone Number multiple number must be separated by comma
    // $message = "Simple text message.";


    // $params = array('app'=>'ws', 'u'=>$username, 'h'=>$hash, 'op'=>'pv', 'to'=>$numbers, 'msg'=>$message);

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?".http_build_query($params, '', '&'));
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Accept:application/json"));
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    // $response = curl_exec($ch);
    // curl_close ($ch);

    // //post method
    // $username = "YourUserNameHere";
    // $hash = "YourTokenCodeHere"; //generate token from the control panel
    // $numbers = "017xxxxxxxx,018xxxxxxxx"; //Recipient Phone Number multiple number must be separated by comma
    // $message = "Simple text message.";

    // $params = array('u'=>$username, 'h'=>$hash, 'op'=>'pv', 'to'=>$numbers, 'msg'=>$message);

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?app=ws");
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // $response = curl_exec($ch);
    // curl_close ($ch);

    // }
 }
}

