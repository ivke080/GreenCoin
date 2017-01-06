<?php
include("init.php");
session_start();
// $senderId=$_SESSION["id"];
// $query="SELECT bank_id,bank_acc FROM users where id='$senderId'";
// $result=mysqli_query($db,$query);
// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// $senderBank = $row["bank_id"];
// $senderAccId=$row["bank_acc"];

// $receiverId=$_POST["userid"];
// $query1="SELECT bank_id,bank_acc FROM users where id='$receiverId'";
// $result1=mysqli_query($db,$query1);
// $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
// $receiverBank=$row1["bank_id"];
// $receiverAccId=$row1["bank_acc"];

//echo $receiverBank." : ".$receiverAccId;
$token=$_SESSION["token"];

//echo $token;
// $url = 'https://apisandbox.openbankproject.com/obp/v2.0.0/banks/obp-banky-n/accounts/094455a8-4d95-422d-bf3a-3566ed7af055/owner/transaction-request-types/SANDBOX_TAN/transaction-requests';
// // use key 'http' even if you send the request to https://...
// $data=array("to"=>array("bank_id"=>"obp-banky-n","account_id"=>"4187ea2a-d1f7-426d-b63e-039b38d61ba0"),"value"=>array("currency"=>"GBP","amount"=>"53"),"description"=>"A description for the transaction to be created");
// //var_dump($jsonToSend);
// $options = array(
//     'http' => array(
//         'header'  => "Authorization: DirectLogin token=$token",
//         'method'  => "POST",
//         'content-type'=>'text/json',
//         'content' => $data
//     )
// );
// //echo $_SESSION["token"];

//var_dump(json_encode($data));
//echo "</br>";

/*$header = array(
    'Authorization: DirectLogin token='.$token,
    'Content-Type: text/json',
    'Content: '.json_encode($data));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
$res = curl_exec($ch);*/

$url="https://apisandbox.openbankproject.com/banks/obp-bankx-n/accounts/1e972186-a04e-4b75-a0fe-83e03d906284/owner/transaction-request-types/SANDBOX_TAN/transaction-requests";

$data = array("to"=>array("bank_id"=>"obp-banky-n",  
  "account_id"=>"37749aba-59f1-4641-9af2-076c5c3a1056"), 
  "value"=>array("currency"=>"E","amount"=>"100.53"),
  "description"=>"A description for the transaction to be created");

$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Authorization: DirectLogin token=$token\r\n"."Content-Type: application/json\r\n"."Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );
var_dump($response);
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// var_dump($res);
?>