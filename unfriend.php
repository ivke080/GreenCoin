<?php
    require('init.php');
    $id = $_POST['id'];
    
    $query = "DELETE FROM friends WHERE (friend_one='$id' OR friend_two='$id')";
    $result = mysqli_query($db, $query);