<?php
    require("header.php");

    if(isset($_GET['id']))
        $id = $_GET['id'];
    else {
        $id = $_SESSION['id'];
    } // zatvorio sam ovde
    
    if (isset($_FILES['profImg'])) {
        $uploadDir = "images/users/";
        $allowedExts = array('jpg','jpeg','png');
        
        $extension = end(explode('.',$_FILES['profImg']['name']));
        
        if (!in_array($extension, $allowedExts)) {
            echo "Invalid image format. <br>";
            exit();
        }
        if ($_FILES['profImg']['size'] > 2097152) {
             echo "Image too large. <br>";
        }
        $imagePath = $uploadDir.$id.'.'.$extension;
        $imageLink = $id.'.'.$extension;
        
        // if (!file_exists($imagePath)) {
            move_uploaded_file($_FILES['profImg']['tmp_name'], $imagePath);
        // }
        
        $query = "UPDATE users SET img='$imageLink' WHERE id='$id'";
        $result = mysqli_query($db, $query);
        
    }
?>

<div class='row' id="profil-first-line">
    <div class='col-md-4 profil-slika'>
        <?php
            $query = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            if (strlen($row['img']))
                echo "<img id='imgprev2' src='images/users/{$row['img']}'/>"; //onError="this.src='images/no-image.jpg'
            else
                echo "<img id='imgprev2' src='images/no-image.jpg'>";
        ?>
        
        <?php if($id == $_SESSION['id']){ ?>
        <div class='dugmad-ispod'>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="profImg">
                    <span class="img-upload glyphicon glyphicon-picture" aria-hidden="true">Update</span>
                    <input type="file" name="profImg" id="profImg" accept="image/*" style='display:none'>
                </label>
                <button type="submit" class='search-btn btn glyphicon glyphicon-send' style='background:transparent;border:1px solid #fff;'></button>
            </form>
        </div>
        <?php } ?>
    </div>
    
    <div class='col-md-8 profil-informacije'>
        <h2><?php echo $row['username']; ?></h2>
        <div class='profil-informacije-pola'>
            Username: <?php echo $row['username']; ?> <br />
            Money: <?php echo $row['wallet'] ?> &euro; <br />
            Green Money: <?php echo $row['ballance']; ?> &euro;
        </div>
        <div class='profil-informacije-pola'>
<?php
    if($id == $_SESSION['id']){
        
?>
            Acoount: <?php echo $row['bank_acc']; ?> </br>
            Bank: <?php echo $row['bank_id']; ?>
<?php
} else { 
?>
    <!--<div class='profil-friend-loan' style='color:#1DAB5D;'>-->
    <!--    + 20&euro;-->
    <!--</div>-->
<?php
}
?>
        </div>
    </div>
</div>
<?php
    if($id == $_SESSION['id']){
?>
        <div class='row profil-second-line'>
            <div class='col-md-4'>
                <?php
                   $query = "SELECT * FROM friends WHERE friend_one='$id' OR friend_two='$id'";
                    $result = mysqli_query($db, $query);
                    
                    $friends = array();
    
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        if (intval($row['friend_one']) == $id)
                            $friends[] = $row['friend_two'];
                        else
                            $friends[] = $row['friend_one'];
                    }
                    
                    $query = "SELECT * FROM users ORDER BY id DESC";
                    $result = mysqli_query($db, $query);
                ?>
                <span  class='padding-5'>Top Friends</span>
                <?php
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        if (in_array($row['id'], $friends)) {
                ?>
                <a href="profile.php?id=<?php echo $row['id'] ?>">
                    <div class='friend-article'>
                        <img src='images/users/<?php echo $row['img']; ?>'/>
                        <div class='friend-article-name'><?php echo $row['username']; ?></div>
                    </div>
                </a>
                <?php
                        }
                    }
                ?>
            </div>
            <div class='col-md-8 profil-mid'>
                <span  class='padding-5'>Posts</span>
                <?php
                    $query = "SELECT * FROM posts WHERE user_id='$id'";
                    $result = mysqli_query($db, $query);
                    
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                ?>
                <a href="post.php?id=<?php echo $row['id'];?>">
                    <div class='profil-post-article'>
                        <img src="<?php echo 'images/posts/'.$row['img']; ?>"/>
                        <div class='friend-article-price'>Donated: <?php echo $row['current_money']; ?>&euro;</br>Goal: <?php echo $row['money']; ?>&euro;</div>
                        <div class='friend-article-text'>
                            <?php echo $row['content'];?>
                        </div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
<?php
    } else { //i ako je prijatelj
?>
<div class='row profil-second-line'>
    <?php
        $query = "SELECT * FROM posts WHERE user_id='$id'";
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    ?>
    <div class='col-md-6 profil-mid'>
        <div class='profil-post-article'>
            <img src='images/posts/<?php echo $row['img'] ?>'></img>
            <div class='friend-article-price'>Donated: <?php echo $row['current_money'] ?>&euro;</br>Goal: <?php echo $row['money'] ?>&euro;</div>
            <div class='friend-article-text'>
                <?php echo $row['content'];?>
            </div>
        </div>
    </div>
    
    
    
     <!--<span class='main-article-date'><?php echo date("d.m.Y.", $row['vreme'])." at ".date("H:m", $row['vreme']);?></span>-->
     <!--   <div class='main-article-text'>-->
     <!--       <div class='main-article-shadow main-article-down'>-->
     <!--           <div class='main-more glyphicon glyphicon-chevron-down'></div>-->
     <!--       </div>-->
     <!--       <?php echo $row['content'];?>-->
     <!--   </div>-->
     <!--   <div class='main-article-image'>-->
     <!--       <a href='post.php?id=<?php echo $row["id"];?>'><img class="img img-responsive" src='images/posts/<?php echo $row['img'] ?>'></img></a>-->
     <!--   </div>-->
     <!--   <div class='main-desno'>-->
     <!--       <div class='main-article-money'>-->
     <!--           <?php echo $row['current_money'] ?>&euro;</br>-->
     <!--           (<?php echo $row['money'] ?>&euro;)</br>-->
     <!--       </div>-->
     <!--       <div class='input-box'>-->
     <!--           <form action='transaction.php' method='post'>-->
     <!--               <input type='hidden' name="userid" value="<?php echo $row['user_id']?>"/>-->
     <!--               <input class='search-box form-control' placeholder='Cash' name="cash"></input>-->
     <!--               <a href="transaction.php"><button class='search-btn btn btn-green glyphicon glyphicon-send'></button></a>-->
     <!--           </form>-->
     <!--       </div>-->
     <!--   </div>-->
    
    
    
    <?php } ?>
    
</div>
<?php
    }
?>
<?php
    require("footer.php");
?>