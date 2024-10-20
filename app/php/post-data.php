<div class="feed-container" data-post-id="<?php echo $feeddata['feed_id'];?>" data-user-id="<?php echo $feeddata['user_id']?>">
    <div class="user-contenjsk">
        <img src="../media/profiles/<?php echo $userdata['profile']?>" alt="" class="user-image">
        <div class="user-contents">
            <a href="profile.php?user_id=<?php echo $feeddata['user_id']?>"><div class="user-name"><?php echo $userdata['username']?></div></a>
            <div class="time-posts">
                <a href="space.php?space_id=<?php echo $feeddata['space_id']?>"><span class="spacena"><?php echo $spacedata['space_name']?></span></a>
            </div>
        </div>
    </div>
    <div class="content-posts">
        <p class="contenjs"><?php echo $feeddata['thread']?></p>
        <?php
            $image_url = $feeddata['image_url'];
            if($image_url !== null){
                ?>
                <img src="../media/profiles/<?php echo $image_url?>" alt="" class="post-image">
            <?php
            }
        ?>
    </div>
    <div class="engage-ment">
        <?php
            $getQ = mysqli_query($conn, "SELECT id FROM likers WHERE user_id = '{$user['user_id']}' AND feed_id = '{$feeddata['feed_id']}'");
            if(mysqli_num_rows($getQ) > 0){
                $likes = "liked";
                $message = "liked";
            }else{
                $likes = "";
                $message = "like";
            }
        ?>
        <button class="like <?php echo $likes?>"><?php echo $message?> (<?php echo $feeddata['likes']?>)</button>
        <div class="engage">See activity (<?php echo $feeddata['activity']?>)</div>
    </div>
</div>