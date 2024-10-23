<div class="my-accout-container">
    <div class="header-cjkf"><h1 class="cdnjkd">My Account</h1></div>
    <div class="account-infomautinc">
        <div class="profile-pics">
            <img src="<?php echo $profileUrl?>" alt="" id="image" class="account-imah">
            <div class="myname-info">
            <div class="user-nameccdd"><?php echo $user['username']?></div>
            <div class="myname-dhbjc"><?php echo $user['fname'] ." " . $user['lname']?></div>
        </div>
        <div class="followers-inco">
            <div class="flex-folloers">
                <div class="numbercou" id="followercount"><a href="followers.php?user_id=<?php echo $user['user_id']?>">
                <?php echo $user['followers']?>
                </a></div> 
                <div class="fncjk">Followers</div>
            </div>
            <div class="flex-folloers">
                <div class="numbercou"><?php echo $user['posts']?></div> 
                <div class="fncjk">Posts</div>
            </div>
        </div>
        </div>
        
        
        <div class="see-activity-lisnk">
            <a href="edit.php">
                <div class="see-cdnjk" id="eddit-profile">Edit Profile</div>
            </a>
            <a href="activity.php">
                <div class="see-cdnjk">See your activity</div>
            </a>
        </div>
        <div class="app-contentsss">
            <a href="password.php">
                <div class="app-contaienrbjh">
                    <div class="icjnkcd"><i class="fa-solid fa-lock"></i></div>
                    <div class="app-cconsvdjjh">Change Password</div>
                </div>
            </a>
            <a href="">
                <div class="app-contaienrbjh">
                    <div class="icjnkcd"><i class="fa-solid fa-check"></i></div>
                    <div class="app-cconsvdjjh">Request Verification</div>
                </div>
            </a>
            <a href="">
                <div class="app-contaienrbjh">
                    <div class="icjnkcd"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <div class="app-cconsvdjjh">Log Out</div>
                </div>
            </a>
            
        </div>
    </div>
</div>