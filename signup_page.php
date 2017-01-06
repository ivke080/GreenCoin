<?php
require('init.php');
$id=$_SESSION["id"];
$name=$_POST["full_name"];
$accountId=$_POST["account"];
$accArray = explode(' ', $accountId);

$us = $_SESSION['userTest'];
$query="INSERT INTO users (email, username, bank_id, name, bank_acc) VALUES ('$us', '$name', '$accArray[1]','$name','$accArray[0]')";
$result = mysqli_query($db,$query);