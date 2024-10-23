

<div class="feed-container" data-post-id="<?php echo $feeddata['feed_id']; ?>"
    data-user-id="<?php echo $feeddata['user_id']; ?>">
    <div class="user-contenjsk">
        <div class="image-holder-sjk">
        <img src="../media/profiles/<?php echo htmlspecialchars($userdata['profile']); ?>" alt="" class="user-image">
        
        </div>
        <div class="post-contentss">
            <div class="user-contents">
                <a href="profile.php?user_id=<?php echo $feeddata['user_id']; ?>">
                    <div class="user-infomation">
                        <div class="user-name"><?php echo htmlspecialchars($userdata['username']); ?></div>
                        <div class="usernames-cn">
                            <?php echo htmlspecialchars($userdata['fname'] . " " . $userdata['lname']); ?> · 
                            <?php 
                                $start_date = new DateTime();
                                $since_start = $start_date->diff(new DateTime($feeddata['date_done']));
                                $minutes = $since_start->days * 24 * 60;
                                $minutes += $since_start->h * 60;
                                $minutes += $since_start->i;
                                if($minutes > 10079){
                                    $calc = $minutes / 10080;
                                    echo round($calc, 0);
                                    echo "w";
                                }elseif($minutes > 1439){
                                    $calc = $minutes / 1440;
                                    echo round($calc, 0);
                                    echo "d";
                                }elseif($minutes > 59){
                                    $calc = $minutes / 60;
                                    echo round($calc, 0);
                                    echo "h";
                                }else{
                                    $calc = 60 - $minutes;
                                    echo round($calc, 0);
                                    echo "m";
                                }
                            ?>
                        </div>
                    </div>
                </a>
                <div class="time-posts">
                    <a href="space.php?space_id=<?php echo $feeddata['space_id']; ?>">
                        <span class="spacena"><?php echo htmlspecialchars($spacedata['space_name']); ?></span>
                    </a>
                </div>
            </div>
            <div class="content-posts">
                <p class="contenjs"><?php echo htmlspecialchars($feeddata['thread']); ?></p>
                <?php
                $image_url = $feeddata['image_url'];
                if (!empty($image_url)) { // Check if image URL is not empty
                    ?>
                    <img src="../media/profiles/<?php echo htmlspecialchars($image_url); ?>" alt="" class="post-image">
                    <?php
                }
                ?>
            </div>
            <div class="engage-ment">
                <?php
                $getQ = mysqli_query($conn, "SELECT id FROM likers WHERE user_id = '{$user['user_id']}' AND feed_id = '{$feeddata['feed_id']}'");
                if (mysqli_num_rows($getQ) > 0) {
                    $likes = "liked";
                    $message = "liked";
                } else {
                    $likes = "";
                    $message = "like";
                }
                ?>
                <button class="like <?php echo $likes; ?>"><?php echo $message; ?> (<?php echo htmlspecialchars($feeddata['likes']); ?>)</button>
                <div class="engage">See activity (<?php echo htmlspecialchars($feeddata['activity']); ?>)</div>
            </div>
        </div>
    </div>
</div>
