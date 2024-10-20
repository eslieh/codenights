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
            <label for="nckjd">Edit Your Details</label>
            <div class="error-text" style="display: none;">Wring password</div>       
            <div class="namesvfv"><input type="text" name="fname" class="fname" value="<?php echo $user['fname']?>" placeholder="Fisrt Name"><input type="text" value="<?php echo $user['lname']?>" name="lname" class="lname" placeholder="Last name"></div>
            <input type="text" name="username" value="<?php echo $user['username']?>" placeholder="Edit Username" class="authinputs">
            <button class="loginBtn">Save Changes</button>
        </form>
        <script src="js/details.js"></script>
    </div>
</div>
<form id="upload-form" method="post" enctype="multipart/form-data" style="display: none;">
    <input type="file" id="file-input" name="profile_photo" accept="image/*">
</form>
<script src="js/profile.js"></script>
