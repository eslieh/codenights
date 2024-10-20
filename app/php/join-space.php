<?php
    include("../../conn/config.php");
    session_start();
    $userid = $_SESSION['user_id'];
    $now = date('y-m-d h:i:s');
    if (isset($_POST['space_id'])) {
        $space_id = mysqli_real_escape_string($conn, $_POST['space_id']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        // Check if the user is already a member of the space
        $check_member_query = mysqli_query($conn, "SELECT user_id FROM space_membership WHERE space_id = '$space_id' AND user_id = '$userid'");
        
        if (mysqli_num_rows($check_member_query) == 0) {
            // If not a member, insert the user into the space_members table
            $join_query = mysqli_query($conn, "INSERT INTO space_membership (space_id, user_id, date_happened) VALUES ('$space_id', '$userid', '$now')");
            if ($join_query) {
                mysqli_query($conn, "UPDATE spaces SET members  = members + 1 WHERE space_id = '$space_id'");
                $thread = "Joined your space";
                mysqli_query($conn, "INSERT INTO notifications(user_id, thread, from_user_id,date_happened)
                    VALUES('$user_id','$thread', '$userid', '$now') ");
                echo json_encode(['status' => 'success', 'message' => 'Joined successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to join space']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'You are already a member']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
?>
