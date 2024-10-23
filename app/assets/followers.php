<?php
    if(!isset($_GET['user_id'])){
        ?>
        <script>location.href="./"</script>
        <?php
    }else{
        $userId = $_GET['user_id'];
        $uquery = mysqli_query($conn, "SELECT username, user_id, profile, fname, lname, followers, posts FROM users WHERE user_id = '{$userId}'");
        if(mysqli_num_rows($uquery)){
            $userDetails = mysqli_fetch_assoc($uquery);
        }else{
            ?>
            <script>location.href="./"</script>
            <?php
        }
    }
?>
<div class="my-accout-container">
    <div class="header-cjkf"><h1 class="cdnjkd">Profile</h1></div>
    <div class="account-infomautinc">
        <div class="profile-pics">
            <img src="../media/profiles/<?php echo $userDetails['profile']?>" alt="" class="account-imah">
            <div class="myname-info">
            <div class="user-nameccdd"><?php echo $userDetails['username']?></div>
            <div class="myname-dhbjc"><?php echo $userDetails['fname'] ." ".$userDetails["lname"] ?></div>
        </div>
        <div class="followers-inco">
            <div class="flex-folloers">
                <div class="numbercou" id="followercount"><a href="followers.php?user_id=<?php echo $userDetails['user_id']?>">
                <?php echo $userDetails['followers']?>
                </a></div> 
                <div class="fncjk">Followers</div>
            </div>
            <div class="flex-folloers">
                <div class="numbercou"><?php echo $userDetails['posts']?></div> 
                <div class="fncjk">Posts</div>
            </div>
        </div>
        </div>
        <div class="list-of-members">
            <?php
                $query_members  = mysqli_query($conn, "SELECT profile,user_id, fname, lname, username FROM users WHERE user_id IN (SELECT follower_id FROM  followers WHERE `following_id` = '$userId')");
                if(mysqli_num_rows($query_members) > 0){
                    while($row = mysqli_fetch_assoc($query_members)){
                        echo '<a href="profile.php?user_id=' . $row['user_id'] . '">
                        <div class="user-info-container">
                            <div class="image-contehsjhe">
                                <img class="result-image" src="../media/profiles/' . $row['profile'] . '" alt="">
                            </div>
                            <div class="user-contenin-info">
                                <div class="usernamecdd">' . htmlspecialchars($row['username']) . '</div>
                                <div class="fullnamecd">' . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . '</div>
                            </div>
                        </div>
                    </a>';
                    }
                }else{
                    echo "No followers available yet!";
                }
            ?>
        </div>
        </div>
    </div>
</div>