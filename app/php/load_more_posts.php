<?php
     // Make sure to include your database connection
    include("../../conn/config.php");
    $limit = 10; // Posts per page
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // Get the offset from the GET request

    // Modify the SQL query to use LIMIT and OFFSET
    $getfeeds = mysqli_query($conn, "
    SELECT * FROM feeds 
    WHERE space_id IN (SELECT space_id FROM space_membership WHERE user_id = '{$user['user_id']}')
    OR user_id IN (SELECT following_id FROM followers WHERE follower_id = '{$user['user_id']}')
    ORDER BY date_done DESC 
     LIMIT $limit OFFSET $offset
");
    
    // Check if there are posts to return
    if (mysqli_num_rows($getfeeds) > 0) {
        while ($feeddata = mysqli_fetch_assoc($getfeeds)) {
            include("post-data.php");
        }
    } else {
        echo "No more posts.";
    }
?>
