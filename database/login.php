<?php
    include_once "connection.php";

    $nic = $_POST['nic'];
    $pass = $_POST['password'];
    $hashpassword;
    $role;

    $query = mysqli_query($con, "SELECT * FROM user_details,roles WHERE nic = '$nic' AND user_details.roleId = roles.id");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $hashpassword = $row['password'];
        $role = $row['name'];
        $id = $row['nic'];

        if(password_verify($pass,$hashpassword)){
            $query = mysqli_query($con,"UPDATE user_details SET status=1 WHERE nic='$id'");
            if($role == "dealer"){
                session_start();
                $_SESSION['user_id'] = $nic;
                echo "d";
            }
            else if($role == "customer"){
                session_start();
                $_SESSION['user_id'] = $nic;
                echo "b";
            }
            else{
                session_start();
                $_SESSION['user_id'] = $id;
                echo "a";
            }
        }
        else{
            echo "passMatch";
        }
    }
    else{
        echo "noAcc";
    }