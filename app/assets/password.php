<div class="my-accout-container">
    <div class="header-cjkf"><h1 class="cdnjkd">Edit Profile</h1></div>
    <div class="account-infomautinc">
        <div class="profile-pics">
            <img src="<?php echo $profileUrl?>" alt="" id="image" class="account-imah">
            <div class="myname-info">
            <div class="user-nameccdd"><?php echo $user['username']?></div>
            <div class="myname-dhbjc"><?php echo $user['fname'] ." " . $user['lname']?></div>
        </div>
    </div>
    <div class="eddit-acount">
        <form action="#" method="post" class="andjk">
            <label for="nckjd">Edit Password</label>
            <div class="error-text" style="display: none;">Wring password</div>       
            <input type="password" name="old"  placeholder="Enter Old Password" class="authinputs">
            <input type="password" name="new" placeholder="Enter New" class="authinputs">
            <input type="password" name="cnew"  placeholder="Confirm New password" class="authinputs">
            <button class="loginBtn">Change Password</button>
        </form>
        <script src="js/password.js"></script>
    </div>
</div>
