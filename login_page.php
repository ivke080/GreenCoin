<?php
session_start();
require('init.php');
if(!isset($_POST["username"])){
     header("Location: login.php");
 }
$username=$_POST["username"];
 if(!isset($_POST["password"])){
     header("Location: login.php");
 }
 $_SESSION['userTest'] = $username;
 
$password=$_POST["password"];
$url = 'https://apisandbox.openbankproject.com/my/logins/direct';

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Authorization: DirectLogin username=$username, password=$password, consumer_key=ihegit233kisr5fanibsgcaijubrlho0gvmz3xmq",
        'method'  => 'POST'
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { 
    header("Location: login.php");
    
}
else{
    $_SESSION["token"]=json_decode($result,true)["token"];
    $query = "SELECT id FROM users WHERE email='$username'";
    $result = mysqli_query($db, $query);
    
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    //var_dump($row);
?>
<script>
    alert(<?php echo count($row) ?>);
</script>
<?php
    if(count($row)==0){
        header("Location: signup.php");
    }else{
        $_SESSION["id"]=$row["id"];
        header("Location: index.php");
    }
//     $url1="https://apisandbox.openbankproject.com/my/accounts/private";
//     $options1 = array(
//     'http' => array(
//         'header'  => "Authorization: DirectLogin token=$result",
//         'method'  => 'GET'
//     )
// );
//     $context1  = stream_context_create($options1);
// $result1 = file_get_contents($url1, false, $context1);
//     var_dump($result1);
}
//var_dump($result);