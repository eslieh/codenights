<?php
header('Content-Type: application/json');
include("../../conn/config.php");
session_start();
$userid = $_SESSION['user_id'];
// Define the base URL of your website
// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    // Specify the directory where images will be saved
    $targetDir = "../../media/profiles/";
    $fileName = basename($_FILES["profile_photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $baseURL = "../media/profiles/$fileName";
    // Check if the file is a valid image
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedTypes)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFilePath)) {
            // Construct the correct URL to be used in the HTML <img> tag
            $newImageURL = $baseURL . $fileName; // e.g., /media/profiles/your_qrcode.png
            $query = mysqli_query($conn, "UPDATE users SET `profile` = '$fileName' WHERE user_id = '$userid'");
            if($query){
                echo json_encode(array(
                    "status" => "success",
                    "new_image_url" => $baseURL
                ));
            }else{
                echo json_encode(array(
                    "status" => "error",
                    "message" => "Something went wrong."
                ));
            }
        } else {
            echo json_encode(array(
                "status" => "error",
                "message" => "Error moving the file."
            ));
        }
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Invalid file type. Only JPG, JPEG, PNG & GIF are allowed."
        ));
    }
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "No file uploaded."
    ));
}
?>
