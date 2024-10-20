<div class="notification-contet">
    <h1 class="jnkcdn">Notifications</h1>
    <div class="notification-list">
        <div class="new-nots">
            <h3 class="cnkdj">New Notifications</h3>
            <?php
                $lastNot = $user['lat_not_id']; // Assuming the correct field is 'last_not_id'

                // Query to get new notifications
                $notQ = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = '{$user['user_id']}' AND id > '{$lastNot}' ORDER BY date_happened DESC LIMIT 12");

                if (mysqli_num_rows($notQ) > 0) {
                    
                    while ($notData = mysqli_fetch_assoc($notQ)) { 
                        $userQ = mysqli_query($conn, "SELECT fname, profile FROM users WHERE user_id = '{$notData['from_user_id']}' ");
                        $userDataN = mysqli_fetch_assoc($userQ);

                        // Display the notification content
                        ?>
                           <a href="profile.php?user_id=<?php echo $notData['from_user_id']?>">
                           <div class="container-cnosi">
                                <div class="user-profile">
                                    <img src="../media/profiles/<?php echo $userDataN['profile']?>" alt="" class="user-profile">
                                </div>
                                <div class="notifcation-thread">
                                    <div class="user-namecd"><?php echo $userDataN['fname']?></div>
                                    <?php echo $notData['thread']?>
                                    <div class="time-dnoids">6h</div> <!-- Update this with actual time -->
                                </div>
                            </div>
                           </a>
                        <?php

                        // Capture the last notification ID
                        $lastNotificationId = $notData['id'];
                    }
                    $notQss = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = '{$user['user_id']}' AND id > '{$lastNot}' ORDER BY date_happened DESC LIMIT 12");
                    $lastData = mysqli_fetch_assoc($notQss);
                    $last_id = $lastData['id'];
                    mysqli_query($conn, "UPDATE users SET lat_not_id = '$last_id' WHERE user_id = '{$user['user_id']}'");

                } else {
                    echo "No new notifications!";
                }
            ?>

        </div>
    </div>
</div>