<?php
$PhoneNo = '01924663948';
$msg = 'Good by';
$PhoneNo = preg_replace(array('/\-/', '/\s+/'), '', $PhoneNo);
$task = "SendTextMessage.php";
$uname = "Softworks";
$pass = "s10h97el";
$sender = "";
$data = array();
$smsId = 'OK';
$response = array();
if ($PhoneNo != '') {
    $req = new HTTP_Request("http://cp.ring.com.bd/" . $task);
    $req->setMethod(HTTP_REQUEST_METHOD_GET);
    $req->addQueryString("uname", $uname);
    $req->addQueryString("pass", $pass);
    $req->addQueryString("msg", $msg);
    if (!empty($sender))
        $req->addQueryString("Sender", $sender);
    else {
        $sender = 'Administrator';
    }

    $req->addQueryString("to", $PhoneNo);
    if (PEAR::isError($req->sendRequest())) {
        $data['success'] = false;
        $data['msg'] = "Message Sending Failed.";
    } else {
        $resp = html_entity_decode($req->getResponseBody());
        if (strpos($resp, '=') != '') {
            $h = explode('=', $resp);
            $number = (int) $h[1];
            $smsId = $smsId . $number . '+';
        }
        $reqStatus = new HTTP_Request("http://cp.ring.com.bd/GetMessageStatus.php");
        $reqStatus->setMethod(HTTP_REQUEST_METHOD_GET);
        $reqStatus->addQueryString("uname", $uname);
        $reqStatus->addQueryString("pass", $pass);
        $reqStatus->addQueryString("msg_id", $number);
        $reqStatus->sendRequest();
        if (!empty($number)) {
            $reqStatus = html_entity_decode($reqStatus->getResponseBody());
        } else {
            $reqStatus = html_entity_decode($reqStatus->getResponseBody());
        }
    }
} else {
    $data['success'] = false;
    $data['msg'] = 'No phone selected or invalid mobile number.';
}
//$response = $data;
//return $response;
//}
?>