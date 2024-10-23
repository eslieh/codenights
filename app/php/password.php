<?php
    include("../../conn/config.php");
    session_start();
    $userid = $_SESSION['user_id'];
    if(!empty($_POST['old']) && !empty($_POST['new']) && !empty($_POST['cnew']) ){
        $old = mysqli_real_escape_string($conn, $_POST['old']);
        $new = mysqli_real_escape_string($conn, $_POST['new']);
        $cnew = mysqli_real_escape_string($conn, $_POST['cnew']);
        $encold =md5($old);
        $checkQ = mysqli_query($conn, "SELECT password FROM users WHERE user_id = '$userid'");
        if(mysqli_num_rows($checkQ) > 0){
            $data = mysqli_fetch_assoc($checkQ);
            $datapass = $data['password'];
            if($datapass === $encold){
                if($cnew === $new){
                    $ecnNew = md5($new);
                    $update = mysqli_query($conn, "UPDATE users SET password = '$ecnNew' WHERE user_id = '$userid'");
                    if($update){
                        echo "success";
                    }else{
                        echo "something went wrong";
                    }
                }else{
                    echo "the two passwords dont match!";
                }
                
            }else{
                echo "incorect old password";
            }
        }else{
            echo "something went wrong";
        }
    }else{
        echo "all inputs are required!";
    }
?>
