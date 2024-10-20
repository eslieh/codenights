<?php
include("../../conn/config.php");
session_start();
$userid = $_SESSION['user_id']; // The user who is performing the follow/unfollow action
$now = date('y-m-d h:i:s');
if (isset($_POST['following_id'])) {
    $following_id = mysqli_real_escape_string($conn, $_POST['following_id']);

    // Check if the user is already following
    $checkFollow = mysqli_query($conn, "SELECT * FROM followers WHERE follower_id = '$userid' AND following_id = '$following_id'");

    if (mysqli_num_rows($checkFollow) > 0) {
        // If already following, unfollow
        $unfollowQuery = mysqli_query($conn, "DELETE FROM followers WHERE follower_id = '$userid' AND following_id = '$following_id'");
        
        if ($unfollowQuery) {
            mysqli_query($conn, "UPDATE users SET followers = followers - 1 WHERE user_id = '$following_id'");
            echo json_encode(['status' => 'unfollowed', 'message' => 'Unfollowed successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to unfollow user']);
        }
    } else {
        // If not following, follow the user
        $followQuery = mysqli_query($conn, "INSERT INTO followers (follower_id, following_id) VALUES ('$userid', '$following_id')");
        
        if ($followQuery) {
            $thread = "Started following you";
            mysqli_query($conn, "INSERT INTO notifications(user_id, thread, from_user_id,date_happened)
                VALUES('$following_id','$thread', '$userid', '$now') ");
            mysqli_query($conn, "UPDATE users SET followers = followers + 1 WHERE user_id = '$following_id'");
            echo json_encode(['status' => 'followed', 'message' => 'Followed successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to follow user']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
