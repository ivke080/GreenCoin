<?php
session_start();
require('init.php');

$token=$_SESSION["token"];

$url = 'https://apisandbox.openbankproject.com/obp/v2.0.0/my/banks/obp-banky-n/accounts/37749aba-59f1-4641-9af2-076c5c3a1056/account';

//var_dump($jsonToSend);
$options = array(
    'http' => array(
        'header'  => "Authorization: DirectLogin token=$token",
        'method'  => "GET",
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);
echo "</br>";
?>