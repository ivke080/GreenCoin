<?php
    session_start();
    
    DEFINE('HOST', '127.0.0.1');
    DEFINE('USER', 'sevic6');
    DEFINE('PASSWORD', 'cistodaimamo');
    DEFINE('DATABASE', 'codebeyond' );
    
    $db = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $db->query("SET NAMES 'utf8'");
    
    if (mysqli_errno($db))
        die ("Couldn't connect to the database: " . mysqli_error());
    
    