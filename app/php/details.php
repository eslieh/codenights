<?php
    include("../../conn/config.php");
    session_start();
    $userid = $_SESSION['user_id'];
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['username']) ){
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $checkQ = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' AND user_id != '$userid'");
        if(mysqli_num_rows($checkQ) > 0){
            echo "$username is not available";
        }else{
            function isValidUsername($username) {
                if (strlen($username) < 3 || strlen($username) > 20) {
                    return false;
                }
                if (!preg_match('/^[a-zA-Z]/', $username)) {
                    return false;
                }
                if (!preg_match('/^[a-zA-Z0-9._]+$/', $username)) {
                    return false;
                }
                if (preg_match('/[_.]{2,}/', $username)) {
                    return false;
                }
                if (preg_match('/[._]$/', $username)) {
                    return false;
                }
                return true;
            }
            $isvalid = isValidUsername($username);
            if($isvalid === true){
                $postdata = mysqli_query($conn, "UPDATE users SET fname = '$fname', lname = '$lname',username = '$username'");
                if($postdata){
                    echo "success";
                }else{
                    echo "something went wrong";
                }
            }else{
                echo "$username cannot be used as a username";
            }
        }
    }else{
        echo "all inputs are required";
    }
?>