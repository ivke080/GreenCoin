<?php
    require('init.php');
    
    $user = $_SESSION['id'];
    $user2 = $_POST['userid'];
    $cash = $_POST['cash'];
    
    
    
    $query = "SELECT wallet, ballance FROM users WHERE id='$user'";
    $result = mysqli_query($db, $query);
    
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $updateUsr = $row['wallet'] - $cash;
    $updateBalance = $row['ballance'] + $cash;
    
    mysqli_query($db, "UPDATE users SET wallet='$updateUsr', ballance='$updateBalance' WHERE id='$user'");
    
    $result = mysqli_query($db, "SELECT current_money FROM posts WHERE user_id='$user2'");
    $row = mysqli_fetch_array($result,MYSQLI_NUM);
    
    $newCash = $row[0] + $cash;
    
    mysqli_query($db, "UPDATE posts SET current_money='$newCash' WHERE user_id='$user2'");
    
    $result = mysqli_query($db, "SELECT money, current_money FROM posts WHERE user_id='$user2'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    if ($row['current_money'] >= $row['money']) {
        mysqli_query($db, "UPDATE posts SET disabled=1 WHERE user_id='$user2'");
    }
    
    $result = mysqli_query($db, "SELECT wallet, ballance FROM users WHERE id='$user2'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $updateUsr = $row['wallet'] + $cash;
    $updateBalance = $row['ballance'] - $cash;
    
    mysqli_query($db, "UPDATE users SET wallet='$updateUsr', ballance='$updateBalance' WHERE id='$user2'");
    
    header("Location: index.php");
    