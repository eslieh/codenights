<div class="space-container-if">
    <div class="space-name">
        <h1 class="spancena"><?php echo $user['username']?>'s Activity</h1>
    </div>
</div>
<div class="space-feed">
<?php
    $getfeeds = mysqli_query($conn,"SELECT * FROM feeds WHERE user_id = '{$user['user_id']}' ORDER BY date_done DESC limit 10");
    if(mysqli_num_rows($getfeeds) > 0){
        include('assets/home-feed.php');
    }
?>
</div>