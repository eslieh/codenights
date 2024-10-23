<?php
    if (isset($_GET['space_id'])) {
        $spaceq = mysqli_query($conn, "SELECT * FROM spaces WHERE space_id = '{$_GET['space_id']}'");
        if(mysqli_num_rows($spaceq) > 0){
            $space_data = mysqli_fetch_assoc($spaceq);
        }
    } else {
        ?>
        <script>location.href="./"</script>
        <?php
    }
?>

<div class="space-container-if">
    <div class="space-name">
        <h1 class="spancena"><?php echo $space_data['space_name']?></h1>
        <span class="about-space"><?php echo $space_data['space_description']?></span>
    </div>
    <div class="members-list">
        <h2 class="membess">Members</h2>
        <div class="list-of-members">
            <?php
                $query_members  = mysqli_query($conn, "SELECT profile,user_id, fname, lname, username FROM users WHERE user_id IN (SELECT user_id FROM space_membership WHERE space_id = '{$space_data['space_id']}')");
                if(mysqli_num_rows($query_members) > 0){
                    while($row = mysqli_fetch_assoc($query_members)){
                        echo '<a href="profile.php?user_id=' . $row['user_id'] . '">
                        <div class="user-info-container">
                            <div class="image-contehsjhe">
                                <img class="result-image" src="../media/profiles/' . $row['profile'] . '" alt="">
                            </div>
                            <div class="user-contenin-info">
                                <div class="usernamecdd">' . htmlspecialchars($row['username']) . '</div>
                                <div class="fullnamecd">' . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . '</div>
                            </div>
                        </div>
                    </a>';
                    }
                }else{
                    echo "No members available yet!";
                }
            ?>
        </div>
    </div>
</div>