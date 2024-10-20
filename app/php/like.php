<?php
    include("../../conn/config.php");
    session_start();
    $userid = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    $poster = $_POST['user_id'];
    $now = date('y-m-d h:i:s');
    // Process like or unlike
    if ($action == 'like') {
        mysqli_query($conn, "UPDATE feeds SET likes = likes + 1 WHERE feed_id = '$post_id'");
        mysqli_query($conn, "INSERT INTO likers (user_id, feed_id, date_happened)
            VALUES('$userid', '$post_id', '$now')");
        if($poster === $userid){
            echo json_encode(['success' => true]);
        }else{
            $thread = "Liked your post";
            mysqli_query($conn, "INSERT INTO notifications(user_id, thread, from_user_id,date_happened)
                VALUES('$poster','$thread', '$userid', '$now') ");
            echo json_encode(['success' => true]);
        }
        
    } elseif ($action == 'unlike') {
        mysqli_query($conn, "UPDATE feeds SET likes = likes - 1 WHERE feed_id = '$post_id'");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
