<?php
    include_once "connection.php";
    $today = date("Y-m-d");
    session_start();
    $nic = $_SESSION['user_id'];

    if(isset($_POST['logoutC'])){
        $query = mysqli_query($con,"UPDATE user_details SET status = 0 WHERE nic = '$nic'");
        if($query){
            $value = session_destroy();
            if($value){
                echo "ok";
            }
        }
    }

    else if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
        $reason = $_POST['reason'];
        $message = $_POST['message'];

        if($subject == "" || $reason == "" || $message == ""){
            echo "noVal";
        }
        else{
            $query = mysqli_query($con,"INSERT INTO complains(comid,subject,reason,message,date) VALUES('$nic','$subject','$reason','$message','$today')");
            echo "success";
        }
    }

    else if(isset($_POST['nameChange'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $query = mysqli_query($con,"UPDATE user_details SET firstName = '$fname', lastName = '$lname' WHERE nic = '$nic'");
        if($query){
            echo "success";
        }
    }

    else if(isset($_POST['typeChange'])){
        $type = $_POST['type'];
        $size = $_POST['size'];

        $query = mysqli_query($con, "SELECT * FROM customer_gas_details WHERE userNic = '$nic'");
        $row = mysqli_fetch_assoc($query);

        if($type != $row['brand'] && $size != $row['size']){
            $query = mysqli_query($con, "UPDATE customer_gas_details SET size = $size, brand = '$type' WHERE userNic = '$nic'");
            echo "done";
        }
        else if($type != $row['brand'] && $size == $row['size']){
            $query = mysqli_query($con, "UPDATE customer_gas_details SET brand = '$type' WHERE userNic = '$nic'");
            echo "done";
        }
        else if($type == $row['brand'] && $size != $row['size']){
            $query = mysqli_query($con, "UPDATE customer_gas_details SET size = $size WHERE userNic = '$nic'");
            echo "done";
        }
        else{
            echo "equel";
        }
    }

    else if(isset($_POST['newrp'])){
        $oldp = $_POST['oldp'];
        $newp = $_POST['newp'];
        $renewp = $_POST['newrp'];
        $pass = password_hash($newp, PASSWORD_DEFAULT);

        $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$nic'");
        $row = mysqli_fetch_assoc($query);

        if($oldp == "" || $newp == "" || $renewp == ""){
            echo "empty";
        }
        else{
            if(password_verify($oldp,$row['password'])){
                if($newp == $renewp){
                    $query = mysqli_query($con, "UPDATE user_details SET password = '$pass' WHERE nic = '$nic'");
                    echo "success";
                }
                else{
                    echo "pass";
                }
            }
            else{
                echo "no";
            }
        }

    }

    else if(isset($_POST['getNotificCount'])){
        $query = mysqli_query($con, "SELECT * FROM gas_issue_history WHERE toWhom = '$nic' AND readFlag = 0");
        $rows = mysqli_num_rows($query);

        echo $rows;
    }

    else if(isset($_POST['notificationsReadMarkId'])){
        $notificId = $_POST['notificationsReadMarkId'];

        $query = mysqli_query($con, "UPDATE gas_issue_history SET readFlag = 1 WHERE id = $notificId");
        echo "success";
    }

    else if(isset($_POST['notificationDeleteId'])){
        $notificId = $_POST['notificationDeleteId'];

        $query = mysqli_query($con, "DELETE FROM gas_issue_history WHERE id = $notificId");
        echo "success";
    }