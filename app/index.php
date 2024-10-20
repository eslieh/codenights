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
        
    <?php
        $limit = 10; // Number of posts per page
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // Default offset is 0 if not provided
    
        // Modify the query to include LIMIT and OFFSET
        // Query to get feeds from spaces the user is a member of OR from users they follow
        $getfeeds = mysqli_query($conn, "
            SELECT * FROM feeds 
            WHERE space_id IN (SELECT space_id FROM space_membership WHERE user_id = '{$user['user_id']}')
            OR user_id IN (SELECT following_id FROM followers WHERE follower_id = '{$user['user_id']}')
            ORDER BY date_done DESC 
             LIMIT $limit OFFSET $offset
        ");

        if(mysqli_num_rows($getfeeds) > 0){
            include('assets/home-feed.php');
        }
        ?>
        <div id="loading" style="display: none;">Loading...</div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Set initial offset for the first page
    let offset = 10; // Assuming the first 10 posts are already loaded

    // Load more posts when the user scrolls to the bottom of the feed
    $('.home-feed').scroll(function () {
        // Check if the user has scrolled to the bottom of the .home-feed container
        if ($('.home-feed').scrollTop() + $('.home-feed').height() >= $('.home-feed')[0].scrollHeight) {
            // Make an AJAX request to fetch more posts
            loadMorePosts(offset);
        }
    });

    // Function to load more posts
    function loadMorePosts(offset) {
        $.ajax({
            url: 'php/load_more_posts.php', // Endpoint to fetch more posts
            type: 'GET',
            data: {
                offset: offset // Pass the current offset to get the next set of posts
            },
            beforeSend: function() {
                // Show a loading spinner while the request is being processed
                $('#loading').show();
            },
            success: function(response) {
                // Hide the loading spinner
                $('#loading').hide();
                
                // Append the new posts to the feed
                if (response) {
                    $('.home-feed').append(response);
                    offset += 10; // Increase the offset for the next set of posts
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
});


</script>

    </section>
    
    <?php include("assets/controls.php")?>
    <section class="rightcenter">
        <div class="content-feed-display">
            <?php include("assets/myinfo.php")?>
        </div>
    </section>
</body>
<style>
    div#home {
    background: #272727;
    color: white;
}
@media only screen and (max-width: 600px) {

    div#home {
    background: #27272700;
    color: white;
}
}
</style>
</html>