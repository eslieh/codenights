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
           
        <div class="see-activity-lisnk">
            <?php
                // Check if the logged-in user is viewing their own profile
                if($userId === $_SESSION['user_id']){
                    ?>
                    <a href="edit.php"><div class="see-cdnjk">Edit Profile</div></a>
                    <?php
                } else {
                    // Check if the logged-in user is already following the profile being viewed
                    $checkFollow = mysqli_query($conn, "SELECT follow_id FROM followers WHERE follower_id = '{$_SESSION['user_id']}' AND following_id = '{$userId}'");
                    if (mysqli_num_rows($checkFollow) > 0) {
                        // If already following, show "Unfollow"
                        ?>
                        <div class="see-cdnjk">Unfollow</div>
                        <?php
                    } else {
                        // If not following, show "Follow"
                        ?>
                        <div class="see-cdnjk">Follow</div>
                        <?php
                    }
                }
            ?>
        </div>

        <div class="prodilekcjjke">
        <?php
                $getfeeds = mysqli_query($conn,"SELECT * FROM feeds WHERE user_id = '$userId' ORDER BY date_done DESC limit 10");
                if(mysqli_num_rows($getfeeds) > 0){
                    include('assets/home-feed.php');
                }
            ?>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", (e) => {
    e.preventDefault();
    
    let followButton = document.querySelector(".see-cdnjk");
    let followerCount = document.querySelector("#followercount");

    // Handle the "Follow/Unfollow" button click event
    followButton.addEventListener("click", function() {
        let followingId = "<?php echo $userId; ?>"; // Get the user ID of the profile being viewed

        // Send an AJAX request to follow or unfollow the user
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/follow_user.php', true); // Use the follow/unfollow PHP script
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.status === 'followed') {
                    // Change the button text to "Unfollow"
                    followButton.textContent = "Unfollow";
                    // Update the follower count
                    followerCount.textContent = parseInt(followerCount.textContent) + 1;
                } else if (response.status === 'unfollowed') {
                    // Change the button text to "Follow"
                    followButton.textContent = "Follow";
                    // Update the follower count
                    followerCount.textContent = parseInt(followerCount.textContent) - 1;
                } else {
                    alert(response.message); // Display error message
                }
            } else {
                alert('An error occurred while trying to follow/unfollow the user.');
            }
        };

        xhr.onerror = function() {
            alert('Request failed.');
        };

        // Send the request with the following_id (user being followed/unfollowed)
        xhr.send("following_id=" + followingId);
    });
});

</script>