<div class="home-feed">
    <?php
        while($feeddata = mysqli_fetch_assoc($getfeeds)){
            $userq = mysqli_query($conn,"SELECT username, profile, fname,lname FROM users  WHERE user_id = '{$feeddata['user_id']}'");
            $userdata = mysqli_fetch_assoc($userq);
            $spaceq = mysqli_query($conn, "SELECT space_name FROM spaces WHERE space_id = '{$feeddata['space_id']}'");
            $spacedata = mysqli_fetch_assoc($spaceq);
            include('php/post-data.php');
        }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle the like button click
        $('.like').click(function (e) {
            e.preventDefault();

            // Get the current button and post information
            let likeButton = $(this);
            let postId = likeButton.closest('.feed-container').data('post-id');
            let userId = likeButton.closest('.feed-container').data('user-id'); // Corrected to user_id
            let isLiked = likeButton.hasClass('liked'); // Check if post is already liked

            // AJAX request to update likes
            $.ajax({
                url: 'php/like.php', // Replace with your like handling PHP script
                type: 'POST',
                data: {
                    post_id: postId,
                    action: isLiked ? 'unlike' : 'like', // Switch action between like and unlike
                    user_id: userId // Ensure this outputs correctly
                },
                success: function (response) {
                    // Log the response before parsing it
                    console.log('Raw response: ', response);

                    // Parse the JSON response
                    let jsonResponse;
                    try {
                        jsonResponse = JSON.parse(response);
                    } catch (e) {
                        alert('Error parsing response: ' + response);
                        return;
                    }

                    // Check if the response indicates success
                    if (jsonResponse.success) {
                        // Toggle like state and update count
                        let currentLikes = parseInt(likeButton.text().match(/\d+/)[0]);
                        if (isLiked) {
                            likeButton.text(`Like (${currentLikes - 1})`);
                            likeButton.removeClass('liked');
                        } else {
                            likeButton.text(`Liked (${currentLikes + 1})`);
                            likeButton.addClass('liked');
                        }
                    } else {
                        alert('Something went wrong: ' + jsonResponse.message); // Show any error message from the server
                    }
                },
                error: function (xhr, status, error) {
                    console.log('AJAX Error: ', status, error);
                    alert('Error in liking the post.');
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        // Handle the "See activity" button click
        $('.engage').click(function (e) {
            e.preventDefault();

            // Get the post ID
            let postId = $(this).closest('.feed-container').data('post-id');
            
            // Check if the activity content is already loaded (prevent multiple loads)
            if ($(this).closest('.feed-container').find('.feed-container').length === 0) {

                // AJAX request to load the activity content from an external PHP file
                $.ajax({
                    url: 'assets/activity.php', // External PHP file to load activity data
                    type: 'POST',
                    data: {
                        post_id: postId // Pass the postId to the PHP file
                    },
                    success: function (response) {
                        // Append the response (activity content) to the DOM inside the post
                        let activityContent = response;
                        // Append the activity content to the post container
                        $('.content-feed-display').append(activityContent);
                    },
                    error: function () {
                        alert('Error loading activity content.');
                    }
                });
            } else {
                // If already loaded, you can toggle the visibility, if desired
                document.querySelector("section.rightcenter").style.display = "flex";
                $(this).closest('.feed-container').find('.activity-content').toggle();
            }
        });
    });
</script>
