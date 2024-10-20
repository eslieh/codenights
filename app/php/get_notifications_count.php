<?php
include("../../conn/config.php");
session_start();

$userId = $_SESSION['user_id']; // Assuming the user is logged in
$get_last_id = mysqli_query($conn, "SELECT lat_not_id FROM users WHERE user_id = '$userId'");
$data = mysqli_fetch_assoc($get_last_id);
$last_is = $data['lat_not_id'];
// Fetch the count of unread notifications
$query = "SELECT COUNT(*) AS count FROM notifications WHERE user_id = '$userId' AND id  >  '$last_is'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode(['count' => $row['count']]);
?>
