<?php
    include_once "connection.php";
    require_once "phpqrcode/qrlib.php";

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nic = $_POST['nic'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pass = $_POST['password'];
    $repass = $_POST['repass'];
    $size = $_POST['tankSize'];
    $customerBrand = $_POST['brand'];
    $dealerBrand = $_POST['dbrand'];
    $companyCode = $_POST['companyCode'];

    $actPass = password_hash($pass,PASSWORD_DEFAULT);

    if($firstname == "" || $lastname == "" || $nic == "" || $role == "" || $email == "" || $address == "" || $pass == "" || $repass == "")
    {
        echo "require";
    }
    else if($role == "buy")
    {
        if($size == "" || $customerBrand == "")
        {
            echo "require";
        }
        else
        {
            $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$nic'");
            if(mysqli_num_rows($query) > 0)
            {
                echo "av";
            }
            else if($pass != $repass)
            {
                echo "pass";
            }
            else
            {
                $query = "INSERT INTO user_details(nic,firstName,lastName,gmail,address,password,roleId,status) VALUES('$nic','$firstname','$lastname','$email','$address','$actPass',2,1);";
                $query .= "INSERT INTO customer_gas_details(userNic,size,brand) VALUES('$nic','$size','$customerBrand')";                
                $execute = mysqli_multi_query($con,$query);
                
                $path = "temp/";
                $file = $nic.".png";
                QRcode::png($nic,$path.$file,'L',6,2);
                
                session_start();
                $_SESSION['user_id'] = $nic;
                echo "doneBuyer";
            }
        }
    }
    else
    {
        if($companyCode == "" || $dealerBrand == "")
        {
            echo "require";
        }
        else
        {
            $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$nic'");
            if(mysqli_num_rows($query) > 0)
            {
                echo "av";
            }
            else if($pass != $repass)
            {
                echo "pass";
            }
            else
            {
                $query = "INSERT INTO user_details(nic,firstName,lastName,gmail,address,password,roleId,status) VALUES('$nic','$firstname','$lastname','$email','$address','$actPass',1,1);";
                $query .= "INSERT INTO dealer_gas_details(dealerNic,code,brand) VALUES('$nic','$companyCode','$dealerBrand')";
                $execute = mysqli_multi_query($con,$query);

                session_start();
                $_SESSION['user_id'] = $nic;

                echo "doneSeller";
            } 
        }
    }


?>


