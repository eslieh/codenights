<?php
    include("../conn/config.php");
    session_start();
    if(!isset($_SESSION['user_id'])){
        ?>
        <script>location.href="../auth"</script>
        <?php
    }else{
        $q = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}'");
        if(mysqli_num_rows($q) > 0){
            $user = mysqli_fetch_assoc($q);
            $profile = $user['profile'];
            if($profile == null){
                $profileUrl = "https://i.pinimg.com/564x/b7/63/8f/b7638fef96e65cceb1a2273bd5ddd7d9.jpg";
            }else{
                $profileUrl = "../media/profiles/$profile";
            }
        }
    }
?>
<section class="navigator">
    <div class="app-labeler">code<div class="cnkd">nights</div></div>
    <nav class="navigators">
        <a href="./">
            <div class="navigator-container" id="home">
                <div class="icons0c"><i class="fa-solid fa-igloo"></i></div>
                <div class="nakme">Home</div>
            </div>
        </a>
        <a href="spaces.php">
            <div class="navigator-container" id="spaces">
                <div class="icons0c"><i class="fa-solid fa-tower-broadcast"></i></div>
                <div class="nakme">Spaces</div>
            </div>
        </a>
        <a href="account.php">
            <div class="navigator-container" id="account">
                <div class="icons0c"><i class="fa-solid fa-user"></i></div>
                <div class="nakme">Account</div>
            </div>
        </a>
    </nav>
</section>