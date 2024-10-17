<?php
    include("../../conn/config.php");
    session_start();
    $userid = $_SESSION['user_id'];
    if(!empty($_POST['spacename']) && !empty($_POST['about']) && !empty($_POST['theme']) ){
        $space_name = mysqli_real_escape_string($conn, $_POST['spacename']);
        $about = mysqli_real_escape_string($conn, $_POST['about']);
        $theme = mysqli_real_escape_string($conn, $_POST['theme']);
        function generateUserId($length = 10, $prefix = '') {
            // Define the characters that can be used in the user ID
            $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            // Generate a random string of the specified length
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            // Return the final user ID with an optional prefix
            return $prefix . $randomString;
        }
        $space_id = generateUserId();
        $now = date("y-m-d h:i:s");
        $query = mysqli_query($conn, "INSERT INTO spaces (space_id, space_name, space_description, them_color, admin, date_created, members, activity)
            VALUES('$space_id', '$space_name', '$about', '$theme','$userid', '$now', 1, 0)");
        if($query){
            // add membership
            $membership = mysqli_query($conn, "INSERT INTO space_membership(space_id, user_id, date_happened)
                VALUES('$space_id', '$userid', '$now')");
            echo "success";
        }else{
            echo "something went wrong!";
        }
    }else{
        echo "All inputs are required";
    }
?>