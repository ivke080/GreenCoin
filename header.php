<?php
    require('init.php');
    if (!isset($_SESSION['id']))
        header("Location: login.php");
    $headId = $_SESSION['id'];
    $result = mysqli_query($db, "SELECT * FROM users WHERE id = '$headId'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="js/circle-progress.js"></script>
        <script src="js/script.js"></script>
        
        <title>
            Green Coin v1.0.0
        </title>
    </head>
    <body>
        <div id='splashscreen'>
            <div id='splash-in'></div>
        </div>
        
        <div class='header-line'></div>

        <?php
            $page = substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], "/") + 1);
        ?>

        <div class='container'>
            <div id='header' class='row'>
                <div class='col-md-9 col-sm-12 col-xs-12 nopadding'>
                    <a href='index.php'>
                        <div class='header-article <?php if($page == 'index.php') echo "header-active"?>' style='border-top-left-radius:4px;'>
                            <span class='glyphicon glyphicon-home'></span>
                            Home
                        </div>
                    </a>
                    <a href='friends.php'>
                        <div class='header-article <?php if($page == 'friends.php') echo "header-active"?>'>
                            <span class='glyphicon glyphicon-heart'></span>
                            Friends
                        </div>
                    </a>
                    <!-- SLIDE DOWN ISPOD -->
                    <div class='header-article new-trigger article-border-right'>
                        <span class='glyphicon glyphicon-plus'></span>
                        New Post 
                    </div>
                    
                    <div id='new-post'>
                        <form action="new_post.php" method="POST" enctype="multipart/form-data">
                            <textarea name="content" required></textarea>
                                <div style='width:100%;float:left;margin-bottom:10px;'>
                                    <div class='main-article-image'>
                                        <img class="img img-responsive" id="imgprev" onError="this.src='images/no-image.jpg'"></img>
                                    </div>
                                </div>
                                <label for="imgInp">
                                    <span class="img-upload glyphicon glyphicon-picture" aria-hidden="true">Image</span>
                                    <input type="file" id="imgInp" name="imgInp" accept="image/*" style="display:none" required>
                                </label>
                                <input class='price' name="cash" placeholder="Cash" type="text">
                                <label for="send" style='float:right'>
                                    <span class="img-upload glyphicon glyphicon-send" aria-hidden="true">Send</span>
                                    <input type="submit" id="send" style="display:none" name="send">
                                </label>
                        </form>
                    </div>
                    
                    <!-- DO OVDE -->
                    <a href='profile.php'>
                        <div class='header-article unhide-sm <?php if($page == 'profile.php') echo "header-active"?>' style='border-top-right-radius:4px;visibility: hidden;'>
                            <span class='glyphicon glyphicon-user'></span>
                            Profile 
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3 col-sm-12 col-xs-12 nopadding">
                    <div class="input-group">
                      <input type="text" class="search-box form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="search-btn btn btn-green glyphicon glyphicon-search" type="button"></button>
                      </span>
                    </div>
                    <div id='profile' class='hide-sm'>
                        <a href='profile.php' style='color:#fff;'>
                            <div class='profile-hover'>
                                <div>
                                    <?php
                                        if (strlen($row['img']))
                                            echo "<img src='images/users/{$row['img']}'/>";
                                        else
                                            echo "<img src='images/no-image.jpg'>";
                                    ?>
                                </div>
                                    <span class='profile-name'><?php echo $row['username']; ?></span>
                            </div>
                        </a>
                          
                          <div class='sign-out'>
                            <span class='glyphicon glyphicon-log-out'></span>
                            <span><a href="signout.php">Sign Out</a></span>
                        </div>
                    </div>
                </div>
                
                <div class='header-line hide-sm'></div>
            </div>