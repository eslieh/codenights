<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/e6755db976.js" crossorigin="anonymous"></script>
    <title> </> CodeNights Login</title>
</head>
<body>
    <?php
        include('../conn/config.php');
        if(isset($_COOKIE['user_id'])){
            session_start();
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            ?>
            <script>location.href="../app"</script>
            <?php
        }else{
            
        }
    ?>
    <div class="login-app-container">
        <div class="icon-side">
            <div class="icon-holder-">
                <div class="icon-wrappe">
                    <span class="cinkl">Code<div class="hjf">nights</div></span><span class="byrhbjs">By Vick</span>
                </div>
            </div>
        </div>
        <div class="login-wrapeer">
            <form action="#" method="post" class="loginwarper">
                <h3 class="ncdnjk">Login</h3>
                <div class="error-text" style="display: none;">Wring password</div>
                <input type="text" name="email" placeholder="Enter Your Mail or userName" class="authinputs">
                <input type="password" name="password" id="pass" placeholder="Enter your password" class="authinputs">
                <button class="loginBtn">Login</button>
                <span class="Helkle">New here?<a href="signup.php">Signup Now</a> </span>
            </form>
            <script src="scripts/login.js"></script>
        </div>
    </div>
</body>
</html>