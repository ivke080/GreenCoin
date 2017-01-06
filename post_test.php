<?php
    require('init.php');
    
    $userId = $_SESSION['id'];
    
    $query = "SELECT * FROM friends WHERE friend_one='$userId' OR friend_two='$userId'";
    $result = mysqli_query($db, $query);
    $friends = array();
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (intval($row['friend_one']) == $userId)
            $friends[] = intval($row['friend_two']);
        else
            $friends[] = intval($row['friend_one']);
    }
    
    $query = "SELECT * FROM posts";
    $result = mysqli_query($db, $query);
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (in_array($row['user_id'], $friends));
            echo $row['content'];
    }
    
    