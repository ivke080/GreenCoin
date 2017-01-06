<?php
    require("header.php");
?>
            
            <div class='row articles' style='margin:0;float:left;'>
                <div id='main-left' class='col-lg-8'>

                    <?php
                        $id = $_SESSION['id'];

                        $query = "SELECT * FROM friends WHERE friend_one = '$id' OR friend_two = '$id'";
                        $result = mysqli_query($db, $query);
                        $find = array();
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            

                            if($row['friend_one'] == $id){
                                $find[] = $row['friend_two'];
                            } else {
                                $find[] = $row['friend_one'];
                            }
                        }
                        $query = "SELECT * FROM posts WHERE disabled = 0";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            
                            $userid = $row['user_id'];
                            
                            // echo "(".$row['user_id'].")</br>";
                            if(in_array($userid,$find)){
                                
                                $query1 = "SELECT username,id FROM users WHERE id = '$userid'";
                                $result1 = mysqli_query($db, $query1);
                                ?>
                                
                                    <div class='main-article'>
                                        <h2 class='main-article-name'>
                                        <?php
                                            while($row1 = mysqli_fetch_array($result1)){
                                                $usr = $row1['username'];
                                                echo "<a href='post.php?id=".$row['id']."'>".$usr."</a>";
                                            }
                                        ?>
                                        </h2>
                                        <!--Today at 18:54-->
                                        <span class='main-article-date'><?php echo date('Y-m-d H:i', strtotime($row['vreme'])); ?></span>
                                        <div class='main-article-text'>
                                            <div class='main-article-shadow main-article-down'>
                                                <div class='main-more glyphicon glyphicon-chevron-down'></div>
                                            </div>
                                            <?php echo $row['content'];?>
                                        </div>
                                        <div class='main-article-image'>
                                            <a href='post.php?id=<?php echo $row["id"];?>'><img class="img img-responsive" src='images/posts/<?php echo $row['img'] ?>'></img></a>
                                        </div>
                                        <div class='main-desno'>
                                            <div class='main-article-money'>
                                                <?php echo $row['current_money'] ?>&euro;</br>
                                                (<?php echo $row['money'] ?>&euro;)</br>
                                            </div>
                                            <div class='input-box'>
                                                <form action='wallet.php' method='POST'>
                                                    <input type='hidden' name="userid" value="<?php echo $row['user_id']?>"/>
                                                    <input class='search-box form-control' placeholder='Cash' name="cash"></input>
                                                    <button type="submit" class='search-btn btn btn-green glyphicon glyphicon-send'></button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                            $percentage = $row['current_money']/$row['money'];
                                        ?>
                                        <div class="circle" id='<?php echo $row["id"]; ?>' percentage='<?php echo $percentage; ?>' loaded='0'>
                                            <div class="circle<?php echo $row['id']; ?>">
                                                <strong></strong>
                                            </div>
                                        </div>
                                    </div> 
                                <?php
                                
                            }
                        }
                    ?>
                   
                </div>
                <div id="main-right" class='col-lg-4'>
                    <div class='right-article'>
                        <img src="images/friends/asseco.jpg"></img>
                    </div>
                    <div class='right-article'>
                        <img src="images/friends/best-logo.png"></img>
                    </div>
                    <div class='right-article'>
                        <img src="images/friends/s&t.png"></img>
                    </div>
                    <div class='right-article'>
                        <img src="images/friends/AlfaUniverzitet.png"></img>
                    </div>
                    <div class='right-article'>
                        <img src="images/friends/gnezdo.jpg"></img>
                    </div>
                    <div class='right-article'>
                        <img src="images/friends/mangonel.png"></img>
                    </div>
                </div>
            </div>
            
        </div>
        
        
<?php
    require("footer.php");
?>