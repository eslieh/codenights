<?php
    include("../../conn/config.php");
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password'])){
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        // check if passwords match
        if($password === $cpassword){
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
                // check if the username or mail exists
                $checkQ = mysqli_query($conn, "SELECT username, email FROM users WHERE email = '$email' OR username = '$username'");
                if(mysqli_num_rows($checkQ) > 0){
                    echo "$email or $username is already in used";
                }else{
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

                    // Example usage
                    $userid =  generateUserId(); // Random user ID with a "USER_" prefix
                    $followers = 0;
                    $posts = 0;
                    $ecnpass = md5($password);
                    $insert = mysqli_query($conn, "INSERT INTO users(user_id,email, username, fname, lname ,password, followers, posts, lat_not_id )
                        VALUES('$userid', '$email', '$username', '$fname', '$lname', '$ecnpass', '$followers', '$posts', 0)");
                    if($insert){
                        $expire = time() + (60 * 60 * 24) * 7;
                        
                        setcookie("user_id", $userid, $expire, "/", "", true);
                        $_SESSION['user_id'] = $userid;
                        echo "success";
                    }else{
                        echo "something went wrong";
                    }
                }
            }else{
                echo "$username is not a valid username";
            }
        }else{
            echo "The passwords You've entered dont match";
        }
    }else{
        echo "All inputs are required";
    }
?>