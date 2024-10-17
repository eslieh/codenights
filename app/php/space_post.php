<?php
header('Content-Type: application/json');
include("../../conn/config.php");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if session has user_id
    if (!isset($_SESSION['user_id'])) {
        $response['status'] = 'error';
        $response['message'] = 'User not authenticated.';
        echo json_encode($response);
        exit;
    }

    $userid = $_SESSION['user_id'];
    $space_id = isset($_POST['space_id']) ? mysqli_real_escape_string($conn, $_POST['space_id']) : null;
    $thread = isset($_POST['thread']) ? mysqli_real_escape_string($conn, $_POST['thread']) : null;
    $now = date("Y-m-d H:i:s");

    // Function to generate a random feed ID
    function generateUserId($length = 10, $prefix = '') {
        $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $prefix . $randomString;
    }

    $feed_id = generateUserId();

    // Validate text thread content
    if (empty($thread)) {
        $response['status'] = 'error';
        $response['message'] = 'Please enter some text for the post.';
        echo json_encode($response);
        exit;
    }

    // Handle image upload (if any)
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../media/feeds/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if file is an image
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert post data into database
                $
                $sql = "INSERT INTO feeds (feed_id, user_id, space_id, image_url, thread, likes, activity, date_done)
                        VALUES ('$feed_id', '$userid', '$space_id', '$fileName', '$thread', 0, 0, '$now')";

                if (mysqli_query($conn, $sql)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Post created successfully with image!';
                    $response['image_url'] = $targetFilePath; // Return image URL if needed
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Database error: ' . mysqli_error($conn);
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to upload the image.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
        }
    } else {
        // If no image is uploaded, just insert the thread content
        $sql = "INSERT INTO feeds (feed_id, user_id, space_id, thread, likes, activity, date_done)
                VALUES ('$feed_id', '$userid', '$space_id', '$thread', 0, 0, '$now')";

        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'Post created successfully!';
            $response['image_url'] = ''; // No image URL since no image was uploaded
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Database error: ' . mysqli_error($conn);
        }
    }

    echo json_encode($response);
}
?>
