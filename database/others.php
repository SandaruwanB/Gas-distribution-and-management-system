<?php

    include_once "connection.php";
    

    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/PHPMailer.php";
    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/SMTP.php";
    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\POP3;
    use PHPMailer\PHPMailer\SMTP;

    $array = array();
    $rand = rand(11111,99999);

    if(isset($_POST['resetnic'])){
        $nic = $_POST['resetnic'];
        $query = mysqli_query($con,"SELECT * FROM user_details WHERE nic='$nic'");
        if($query){
            if(mysqli_num_rows($query)>0){
                $array[$nic] = $rand;
                
                $mail = new PHPMailer(true);
                // set to use smtp
                $mail -> isSMTP();
                // define smtp host
                $mail -> Host = "smtp.gmail.com";
                // authentication
                $mail -> SMTPAuth = "true";
                // set encryption type
                $mail -> SMTPSecure = "tls";
                // set port
                $mail -> Port = "587";
                // email username
                $mail -> Username = "lpgsmartservice.org@gmail.com";
                // password
                $mail -> Password = "bmvfspfycgcfdwnl";
                // subject
                $mail -> Subject = "Account Recovery LPG SMART SERVICE";
                // from set
                $mail -> setFrom("lpgsmartservice.org@gmail.com", "LPG SMART SERVICE");
                
                $email = "sandarusbandara110@gmail.com";
                $message = "verification code is ".$array[$nic];
                // body
                $mail -> isHTML(true);
                $mail -> CharSet = "UTF-8";
                $mail -> Body = $message;
                // recipient
                $mail -> addAddress($email);
                
                
                $mail -> Send();
                $mail ->  smtpClose();

                echo $array[$nic].$nic;
            
            }
            else{
                echo "noAcc";
            }
        }
    }

    else if(isset($_POST['verCode'])){
        $code = $_POST['verCode'];
        $resetNic = $_POST['changeNic'];
        $sendedCode = substr($resetNic, 0, 5);
        
        if($code == $sendedCode){
            echo "success";
        }
        else{
            echo "unsuccess";
        }
    }

    else if(isset($_POST['pass'])){
        $password = $_POST['pass'];
        $repassword = $_POST['repass'];
        $userNic = substr($_POST['changeNic'], 5);
        $encryptPass = password_hash($password,PASSWORD_DEFAULT);

        if($password != $repassword){
            echo "notMatch";
        }
        else if($password == "" || $repassword == ""){
            echo "valerr";
        }
        else{
            $query = mysqli_query($con, "SELECT * FROM password_resets WHERE userNic='$userNic'");
            $row = mysqli_fetch_assoc($query);
            $times = $row['times'];
            if(mysqli_num_rows($query) > 0){
                ++$times;
                $query = mysqli_query($con, "UPDATE password_resets SET times=$times , changedTime = NOW() WHERE userNic='$userNic'");
            }
            else{
                $query = mysqli_query($con, "INSERT INTO password_resets(userNic,times) VALUES('$userNic',1)");
            }
            $query = mysqli_query($con, "UPDATE user_details SET password = '$encryptPass' WHERE nic = '$userNic'");
            if($query){

                $mail = new PHPMailer(true);
                // set to use smtp
                $mail -> isSMTP();
                // define smtp host
                $mail -> Host = "smtp.gmail.com";
                // authentication
                $mail -> SMTPAuth = "true";
                // set encryption type
                $mail -> SMTPSecure = "tls";
                // set port
                $mail -> Port = "587";
                // email username
                $mail -> Username = "lpgsmartservice.org@gmail.com";
                // password
                $mail -> Password = "bmvfspfycgcfdwnl";
                // subject
                $mail -> Subject = "Account Recovery LPG SMART SERVICE";
                // from set
                $mail -> setFrom("lpgsmartservice.org@gmail.com", "LPG SMART SERVICE");
                
                $email = "sandarusbandara110@gmail.com";
                $message = "Your Account Password Changed.";
                // body
                $mail -> isHTML(true);
                $mail -> CharSet = "UTF-8";
                $mail -> Body = $message;
                // recipient
                $mail -> addAddress($email);
                
                
                $mail -> Send();
                $mail ->  smtpClose();
                echo "success";
            }
        }
    }

    else if(isset($_POST['adminMsg'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $today = date("Y-m-d");

        $query = mysqli_query($con,"INSERT INTO contact_messages(email,name,subject,message,date) VALUES('$email','$name','$subject','$message','$today')");
        if($query){
            $message = '
                <body>
                    <div style="width: 100%; background: linear-gradient(to right, #000555, #1C51AC); padding: 20px; color: #fff; text-align: center; text-transform: uppercase;">
                        <h2>liquified petrolium gas smart service</h2>
                    </div>
                    <div style="display: flex; justify-content: center; margin-bottom: 30px; margin-left: 42%;">
                        <img src="https://lh6.googleusercontent.com/X_hybh4gonllRAaB8wrOR7O3pKXfRbzXeVlV9HLfQrECrcWBFH3BbNXCEFNkvZQeTrw=w1200-h630-p" style="width: 150px; display: block;" />
                    </div>
                    <div>Dear '.$name.'</div>
                    <div style="text-align: center;">
                        <h1>Thanks for your Message<h1>
                        <p style="font-size: 1rem;">Your message submitted to our admin pannel. Wait for reply. Thank You.</p> 
                    </div>
                </body>';

            // initialize phpmailer
            $mail = new PHPMailer(true);
            // set to use smtp
            $mail -> isSMTP();
            // define smtp host
            $mail -> Host = "smtp.gmail.com";
            // authentication
            $mail -> SMTPAuth = "true";
            // set encryption type
            $mail -> SMTPSecure = "tls";
            // set port
            $mail -> Port = "587";
            // email username
            $mail -> Username = "lpgsmartservice.org@gmail.com";
            // password
            $mail -> Password = "bmvfspfycgcfdwnl";
            // subject
            $mail -> Subject = "Thanks For Messaging to Us";
            // from set
            $mail -> setFrom("lpgsmartservice.org@gmail.com", "LPG SMART SERVICE");

            // body
            $mail -> isHTML(true);
            $mail -> CharSet = "UTF-8";
            $mail -> Body = $message;
            // recipient
            $mail -> addAddress($email);
            
            
            $mail -> Send();
            $mail ->  smtpClose();
            echo "success";
        }
    }
