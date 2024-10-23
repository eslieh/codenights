<?php
include("../../conn/config.php"); // Adjust the path as needed

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    
    // Search users
    $userResults = '';
    $userQuery = "SELECT user_id, username, fname, lname, profile FROM users WHERE username LIKE '%$query%' OR fname LIKE '%$query%' OR lname LIKE '%$query%' LIMIT 5";
    $userResult = mysqli_query($conn, $userQuery);
    
    while ($row = mysqli_fetch_assoc($userResult)) {
        $userResults .= '
        <a href="profile.php?user_id=' . $row['user_id'] . '">
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

    // Search spaces
    $spaceResults = '';
    $spaceQuery = "SELECT space_id, space_name FROM spaces WHERE space_name LIKE '%$query%' LIMIT 5";
    $spaceResult = mysqli_query($conn, $spaceQuery);
    
    while ($row = mysqli_fetch_assoc($spaceResult)) {
        $spaceResults .= '
        <a href="space-info.php?space_id=' . $row['space_id'] . '">
            <div class="space_container-ingo">
                <div class="space_name">' . htmlspecialchars($row['space_name']) . '</div>
            </div>
        </a>';
    }

    // Combine results
    echo '<div class="user-results">' . $userResults . '</div>';
    echo '<div class="space-results">' . $spaceResults . '</div>';
}
?>
