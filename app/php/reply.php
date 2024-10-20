<?php
header('Content-Type: application/json');
include("../../conn/config.php");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$response = [];
if(empty($_POST['thread'])){
    $response['status'] = 'error';
    $response['message'] = 'input a reply text!';
}else{
    $thread = $_POST['thread'];
    $feed_id = $_GET['feed_id'];
    $myid = $_SESSION['user_id'];
    $user_id = $_GET['user_id']; 
    $now = date('y-m-d h:i:s');
    $post = mysqli_query($conn, "INSERT INTO reply(feed_id, user_id, thread, likes,date_done)
        VALUES('$feed_id', '$myid', '$thread', 0, '$now' )");
    if($post){  
        mysqli_query($conn,"UPDATE feeds SET activity = activity + 1 WHERE feed_id = '$feed_id'");
        if($user_id === $myid){
            $response['status'] = 'success';
            $response['message'] = 'connected!';
        }else{
            $message = "responded to your post";
            mysqli_query($conn, "INSERT INTO notifications(user_id, thread, from_user_id,  date_happened)
                VALUES('$user_id', '$message', '$myid', '$now')");
             $response['status'] = 'success';
             $response['message'] = 'connected!';
        }
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Error posting reply';
    }
}
// $sql2 = mysqli_query($conn, "UPDATE users SET posts = posts +1 WHERE user_id = '$userid'");


echo json_encode($response);