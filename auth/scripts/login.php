<?php
    include("../../conn/config.php");
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $ecnpass = md5($password);
        // check for users
        $checkQ = mysqli_query($conn, "SELECT user_id, password FROM users WHERE email = '$email' OR username = '$email'");
        if(mysqli_num_rows($checkQ) > 0){
            $data = mysqli_fetch_assoc($checkQ);
            $userpass = $data['password'];
            if($userpass === $ecnpass){
                $userid = $data['user_id'];
                $expire = time() + (60 * 60 * 24) * 7;        
                setcookie("user_id", $userid, $expire, "/", "", true);
                $_SESSION['user_id'] = $userid;
                echo "success";
            }else{
                echo "Incorect password, Try again";
            }
        }else{
            echo "user with $email was not found";
        }

    }else{
        echo "All inputs are required";
    }
?>