<?php
    require("header.php");
    $userId = $_SESSION['id'];
    
    $query = "SELECT * FROM friends WHERE friend_one='$userId' OR friend_two='$userId'";
    $result = mysqli_query($db, $query);
    
    $friends = array();
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (intval($row['friend_one']) == $userId)
            $friends[] = $row['friend_two'];
        else
            $friends[] = $row['friend_one'];
    }
    
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query);
    
    
?>

<div class='row friends'>
    <?php
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if(in_array($row['id'], $friends)) {
    ?>
    <div class='col-lg-6 <?php echo $row['id']; ?>'>
        <div class='friends-article'>
            <div class='friends-img'>
                <a href="<?php echo '/profile.php?id='.$row['id']; ?>"><img src='images/users/<?php echo $row['img']; ?>' width=100px; height:100px; alt="Cinque Terre"></a>
            </div>
            <div class='friends-right'>
                <div class='friends-name'>
                    <a href="<?php echo '/profile.php?id='.$row['id']; ?>"><h3><?php echo $row['username']; ?></h3></a>
                </div>
                <div class='friends-options'>
                    <div class='friends-view-profile'>
                        <span style='color:#1DAB5D;' class='glyphicon glyphicon-user'></span>
                        <span class='view-hide'><a href="<?php echo '/profile.php?id='.$row['id']; ?>">View Profile</a></span>
                    </div>
                    <div class='trash' style='float:right'>
                        <span class='glyphicon glyphicon-trash'></span>
                        <span class='view-hide remove-friend <?php echo $row['id']; ?>'>Unfriend</span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
        }
    ?>

<?php
require("footer.php");
?>