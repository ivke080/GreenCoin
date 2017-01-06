
<?php
session_start();
if(!isset($_SESSION["token"]) || isset($_SESSION["id"])){
    header("Location: index.php");
}

$url = 'https://apisandbox.openbankproject.com/obp/v2.0.0/my/accounts';

// use bank_id 'http' even if you send the request to https://...
$token=$_SESSION["token"];
//echo "asd".$token;
$options = array(
    'http' => array(
        'header'  => "Authorization: DirectLogin token=$token",
        'method'  => 'GET',
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { echo "greska!"; }
else{
    $result=json_decode($result,true);
    foreach ($result as $key => $row) {
    $bank_id[$key]  = $row['bank_id'];
    $id[$key] = $row['id'];
}

array_multisort($bank_id, SORT_ASC, $id , SORT_ASC, $result);
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>Signup Page</title>
    
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="login-body signup-body">
    <div class="container login-container">
        <form action="signup_page.php" method="POST">
            <h2 class="form-login-head">Please sign up</h2>
            
            <label for="name" class="sr-only">Username</label>
            <input type="text" id="name" name="full_name" class="form-control" placeholder="Full Name" required autofocus>
            
            <select name="account" class="form-control">
                <option>Select account</option>
                <?php
                    $prev = "nemoguca_banka";
                    for($i = 0; $i<count($result); $i++){
                        if(strcmp($result[$i]["bank_id"],$prev) != 0){
                            $prev = $result[$i]["bank_id"];
                            echo "<optgroup name='bank_id' label='".$prev."'>";
                        }
                        echo "<option name='account_id' value='".$result[$i]["id"]." ".$prev."'>".$result[$i]["id"]." ".$prev."</option>";
                    }
                ?>
                
            </select><br>
            <div class="row well" style="text-align:justify; color:black;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida risus ex, vel posuere tortor pellentesque sed. Maecenas nec pulvinar felis. Sed sit amet sapien erat. Phasellus tortor risus, ullamcorper eget suscipit sed, consequat vel libero. Sed dignissim mi in dapibus tincidunt. Aliquam erat volutpat. Donec vehicula, massa et interdum pellentesque, mi ipsum fringilla nibh, eget finibus risus est a odio. Nulla felis augue, vulputate vel libero ac, tempus facilisis turpis. Duis tempus sapien ac mattis semper. Nam libero lacus, faucibus at tempor eget, lobortis id tortor. Morbi nec varius nisi, in vehicula turpis. Sed semper, nunc eu semper consectetur, libero ipsum accumsan odio, et viverra nisl nisl maximus nunc. Donec sed condimentum tortor.
                <br><br>
                <input type="checkbox" name="checkbox" value="check" id="agree" required/> I have read and agree to the Terms and Conditions
            </div>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
        </form>
    </div>
    
</body>
</html>