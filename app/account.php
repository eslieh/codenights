<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/e6755db976.js" crossorigin="anonymous"></script>
    <title> </> CodeNights</title>
</head>
<body class="home-feed">
    <?php include("assets/nav-bar.php")?>
    <section class="homecontents">
        <?php include("assets/my-account.php")?>
    </section>
    
    <?php include("assets/controls.php")?>
    <section class="rightcenter">
        <div class="content-feed-display">
            <?php include("assets/myinfo.php")?>
        </div>
    </section>
</body>
<style>
    div#account {
    background: #272727;
    color: white;
}
@media only screen and (max-width: 600px) {

div#account {
background: #27272700;
color: white;
}
}
</style>
</html>