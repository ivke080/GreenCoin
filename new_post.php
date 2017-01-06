<?php
    require('init.php');
    
    if (isset($_POST['send'])) {
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $cash = floatval(trim($_POST['cash']));
        
       
        /*$query = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($db, $query);
        $postId = mysqli_fetch_array($result,MYSQLI_NUM)[0];*/
        
        
        $uploadDir = "images/posts/";
        $allowedExts = array('jpeg','jpg','png');
        
        if (isset($_FILES['imgInp'])) {
            
            $query = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($db, $query);
            $postId = mysqli_fetch_array($result, MYSQLI_NUM)[0] + 1;
            $userId = $_SESSION['id'];
            
            $extension = end(explode('.',$_FILES['imgInp']['name']));
            $tmpName = $_FILES['imgInp']['tmp_name'];
            
            if (!in_array($extension, $allowedExts)) {
                echo "Invalid image format. <br>";
                exit();
            }
            if ($_FILES['imgInp']['size'] > 2097152) {
                echo "Image too large. <br>";
            }
            $imagePath = $uploadDir.$postId.'.'.$extension;
            if (!file_exists($imagePath)) {
                move_uploaded_file($_FILES['imgInp']['tmp_name'], $imagePath);
                
            }
            
            $imgLink = $postId.'.'.$extension;
            $query = "INSERT INTO posts (content, img, money, user_id) 
                VALUES('$content','$imgLink','$cash', '$userId')";
            $result = mysqli_query($db, $query);
            if ($result->num_rows) {
                echo "Error writing into database<br>";
                exit();
            }
        } else {
            echo "Error uploading image. <br>";
        }
        header("Location: index.php");
    }