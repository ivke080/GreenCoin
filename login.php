<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>Login page</title>
    
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    
</head>
<body class="login-body">
    <div class="container login-container">

        <form action="login_page.php" method="POST">
            <h2 class="form-login-head">OBP account</h2>
            <label for="user" class="sr-only">Username</label>
            <input type="text" id="user" name="username" class="form-control" placeholder="Email" required autofocus>
            <label for="pass" class="sr-only">Password</label>
            <input type="password" id="pass" name="password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
        </form>

    </div>
</body>
</html>