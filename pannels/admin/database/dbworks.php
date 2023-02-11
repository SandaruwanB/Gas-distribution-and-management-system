<?php

    include_once "connection.php";

    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/PHPMailer.php";
    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/SMTP.php";
    require "/media/sandaruwan/New Volume/My Projects/php/LPG/phpmailer/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\POP3;
    use PHPMailer\PHPMailer\SMTP;

    $today = date("Y-m-d");

    session_start();
    $nic = $_SESSION['user_id'];


    if(isset($_POST['logout'])){
        $query = mysqli_query($con,"UPDATE user_details SET status = 0 WHERE nic = '$nic'");
        if($query){
            $value = session_destroy();
            if($value){
                echo "ok";
            }
        }
    }

    else if(isset($_POST['getNotifications'])){
        $notifications = 0;

        $query = mysqli_query($con, "SELECT * FROM gas_requests WHERE noific = 0");
        $notifications = mysqli_num_rows($query);

        echo ($notifications <= 0 ? "no": $notifications);

    }
    
    else if(isset($_POST['getNotificationContent'])){
        $notificationDetails = '<li>
                <hr class="dropdown-divider">
            </li>';
        $query = mysqli_query($con, "SELECT * FROM gas_requests,user_details WHERE user_details.nic = gas_requests.userNic AND noific = 0 LIMIT 5");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $notificationDetails .= '                
                    <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <a href="notifications.php">
                            <h4>Gas Tanks Request</h4>
                            <p>'.$row['firstName'].' '.$row['lastName'].'</p>
                            <p>'.($row['date'] == $today ? "Today": $row['date']).'</p>
                        </a>
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>';
            }
            echo $notificationDetails;
        }
        else{
            echo "no";
        }
    }

    else if(isset($_POST['getMessageCount'])){
        $messages = 0;

        $query = mysqli_query($con, "SELECT * FROM contact_messages WHERE read_flag = 0");
        $messages = mysqli_num_rows($query);

        echo ($messages <= 0 ? "no": $messages);
    }

    else if(isset($_POST['getMessageContent'])){
        $messagesDetails = '<li>
                <hr class="dropdown-divider">
            </li>';

        $query = mysqli_query($con, "SELECT * FROM contact_messages WHERE read_flag = 0 LIMIT 2");
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $messagesDetails .= '
                    <li class="message-item">
                        <a href="messages.php">
                            <div>
                                <h4>'.$row['name'].'</h4>
                                <p>'.$row['subject'].'</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>';
            }
            $query = mysqli_query($con, "SELECT * FROM messages,user_details WHERE messages.fromNic = user_details.nic AND readflag = 0 LIMIT 3");
            while($row = mysqli_fetch_assoc($query)){
                $messagesDetails .= '
                    <li class="message-item">
                        <a href="messages.php">
                            <div>
                                <h4>'.$row['firstName'].' '.$row['lastName'].'</h4>
                                <p>To Message Box</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>';
            }
            echo $messagesDetails;
        }
        else{
            echo "no";
        }
    }

    else if(isset($_POST['deleteId'])){
        $delId = $_POST['deleteId'];
        $query = mysqli_query($con, "DELETE FROM user_details WHERE nic = '$delId'");
        echo "success";
    }

    else if(isset($_POST['stockViewId'])){
        $dnic = $_POST['stockViewId'];
        $outputData = "";
        $loop = 1;

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$dnic'");
        $row = mysqli_fetch_assoc($query);
        $brand = $row['brand'];

        if($brand == "all"){
            $query = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$dnic'");
            $row2 = mysqli_fetch_assoc($query);
            $outputData .= '
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                            </div>
                        </div>
                    </div>';

            $query = mysqli_query($con, "SELECT * FROM litro_dealer_stock WHERE dealernic = '$dnic'");
            $row2 = mysqli_fetch_assoc($query);
            $outputData .= '
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-2">
                            <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                    <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

        }else{
            if($brand == "laughfs"){
                $query = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$dnic'");
                $row2 = mysqli_fetch_assoc($query);
                $outputData .= '
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                                <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                </div>';
            }
            else{
                $query = mysqli_query($con, "SELECT * FROM litro_dealer_stock WHERE dealernic = '$dnic'");
                $row2 = mysqli_fetch_assoc($query);
                $outputData .= '
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        $outputData .= '
            <h3 class="text-center mt-5">Issued History</h3>
            <table class="table container mt-3" id="data-table">
                <thead class="thead-light">
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer NIC</th>
                    <th scope="col">Customer Mail</th>
                    <th class="text-center" scope="col">Gas Tank Type</th>
                    <th class="text-center" scope="col">Gas Tank Size</th>
                    <th scope="col">Issued Date</th>
                </thead>
                <tbody>
        ';

        $query = mysqli_query($con, "SELECT * FROM user_details,issue_history,customer_gas_details WHERE customer_gas_details.userNic = issue_history.userNic AND issue_history.userNic = user_details.nic AND issue_history.dealerNic = '$dnic' ORDER BY issue_history.date DESC");
        if(mysqli_num_rows($query) > 0){                    
            while($row = mysqli_fetch_assoc($query)){
                $outputData .= '
                    <tr>
                        <th scope="row">'.$loop.'</th>
                        <td>'.$row['firstName'].'  '.$row['lastName'].'</td>
                        <td>'.$row['nic'].'</td>
                        <td>'.$row['gmail'].'</td>
                        <td class="text-center">'.$row['brand'].'</td>
                        <td class="text-center">'.$row['size'].'kg</td>
                        <td>'.$row['date'].'</td>
                    </tr>';
                    ++$loop;
            }
        }
        else{
            $outputData .= '
                <tr>
                    <td class="text-center" colspan="7">No Data to Show</td>
                </tr>';
        }
        $outputData .= '
                </tbody>
            </table>';
        echo $outputData;
    }

    else if(isset($_POST['dComMarkId'])){
        $comId = $_POST['dComMarkId'];

        $query = mysqli_query($con, "UPDATE complains SET readflag = 1 WHERE id=$comId");
        echo "success";
    }

    else if(isset($_POST['dComDId'])){
        $delId = $_POST['dComDId'];

        $query = mysqli_query($con, "DELETE FROM complains WHERE id=$delId");
        echo "success";
    }

    else if(isset($_POST['viewCom'])){
        $comId = $_POST['viewCom'];

        $query = mysqli_query($con, "UPDATE complains SET readflag = 1 WHERE id=$comId");

        $outputMessage = '
            <div class="pagetitle">
                <h1>Complain View</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="complains.php">Complains</a></li>
                        <li class="breadcrumb-item active">Complain View</li>
                    </ol>
                </nav>
            </div>
            <div class="container mt-5">';
        $query = mysqli_query($con, "SELECT * FROM complains,user_details WHERE user_details.nic = complains.comid AND complains.id = $comId");
        $row = mysqli_fetch_assoc($query);     

        $outputMessage .= '
                <div class="w-50">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="d-block">'.$row['subject'].'</h3>
                            <p class="d-block">Date : '.$row['date'].'</p>
                        </div>
                            <div class="card-body">
                                <h5 class="card-title">'.$row['reason'].'</h5>
                                <p>'.$row['message'].'</p>

                                <h5 class="card-title">User : '.$row['firstName'].'  '.$row['lastName'].'
                                <br>
                                E-mail : '.$row['gmail'].'
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        echo $outputMessage;
        
    }

    else if(isset($_POST['userDetailsId'])){
        $userId = $_POST['userDetailsId'];
        $outContent = "";
        $outContent .= '
            <div class="mt-5" style="display: flex; justify-content: center;">
                <div class="card w-50" style="border: 4px solid #09035e; box-shadow: 0 0 3px #000">
                    <div class="card-header text-center">
                        <h3>Quota Details</h3>
                    </div>
                    <div class="card-body" style="margin-left: 17%">
                        <table class="table w-75 ml-5" style="border: 1px solid #024d08;">';

                    $query = mysqli_query($con, "SELECT * FROM user_details,customer_gas_details WHERE customer_gas_details.userNic = user_details.nic AND nic = '$userId'");
                    $row = mysqli_fetch_array($query);
                    $lastDate = $row['boughtDate'];
                    $dateDiff = dateDiff($today,$lastDate);
                    $avDates;
                    if($row['size'] < 3){
                        $avDates = 14 - $dateDiff;
                    }
                    else if($row['size'] < 6){
                        $avDates = 21 - $dateDiff;
                    }
                    else{
                        $avDates = 28 - $dateDiff;
                    }
                    $inMinutes = strtotime($today.'+ '.$avDates.' days');
                    $nextDate = date("Y-m-d",$inMinutes);

                $outContent .= '
                            <tbody>
                                <tr>
                                    <th scope="row">Gas Tank Size</td>
                                    <td>'.$row['size'].'kg</td>
                                </tr>
                                <tr>
                                    <th scope="row">Gat Tank Modal</td>
                                    <td>'.$row['brand'].'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Bought Date</th>
                                    <td>'.($row['boughtDate'] == null ? "not yet bought": $row['boughtDate']).'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Quota</th>';

                                
                                if($dateDiff >= 14 || $row['boughtDate'] == null && $row['size'] < 3){
                                    $outContent .= "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                }
                                else if($dateDiff >= 21 || $row['boughtDate'] == null && $row['size'] < 6){
                                    $outContent .=  "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                }
                                else if($dateDiff >= 28 || $row['boughtDate'] == null && $row['size'] < 15){
                                    $outContent .=  "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                }
                                else{
                                    $outContent .=  "<td style='color: red;'>no quota left</td>";
                                }
                $outContent .= '
                                </tr>
                                <tr>
                                    <th scope="row">Next Buying Date</th>
                                    <td>'.($row['boughtDate'] == NULL ? $today: ($nextDate <= $today ? $today : $nextDate)).'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>';

            echo $outContent;
    }

    else if(isset($_POST['adminEditId'])){
        $adminId = $_POST['adminEditId'];
        $outputData = "";

        $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$adminId'");
        $row = mysqli_fetch_assoc($query);
        $outputData .= '
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="First Name" value="'.$row['firstName'].'" id="firstName">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Last Name" value="'.$row['lastName'].'" id="lastName">
            </div>
            <div class="col-md-12">
                <input type="email" class="form-control" placeholder="Email" value="'.$row['gmail'].'" id="nic">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Address" value="'.$row['address'].'" id="address">
            </div>';
        
        $query2 = mysqli_query($con,"SELECT * FROM admin_privileges WHERE adminNic = '$nic'");
        $row2 = mysqli_fetch_assoc($query2);

        if($row2['previlage'] == "super"){
            $outputData .= '
            <div class="col-md-6">
                <select id="edinputState" class="form-select" name="previlege">
                <option value="simple">Standard Admin</option>    
                <option value="super">Super Admin</option>
                </select>
            </div>
            ';
        }
        else{
            $outputData .= "";
        }

        $outputData .= '
            <div class="text-center">
                <button  class="btn btn-primary editAdmin" value="'.$adminId.'" onClick="editAdminData(this.value)">Done</button>
            </div>
        </div>';

        echo $outputData;
        
    }

    else if(isset($_POST['addfirstName'])){
        $fname = $_POST['addfirstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $uname = $_POST['nic'];
        $address = $_POST['address'];
        $priv = $_POST['previlege'];
        $pass = $_POST['password'];
        $repass = $_POST['repassword'];
        $encPass = password_hash($pass, PASSWORD_DEFAULT);

        $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$uname'");
        $count = mysqli_num_rows($query);

        if($fname == "" || $lname == "" || $email == "" || $uname == "" || $address == "" || $pass == "" || $repass == ""){
            echo "noData";
        }
        else if($pass != $repass){
            echo "pass";
        }
        else if($count > 0){
            echo "exist";
        }
        else{
            if($priv == "super"){
                $query = mysqli_query($con,"INSERT INTO user_details(nic,firstName,lastName,gmail,address,password,roleId) VALUES('$uname','$fname','$lname','$email','$address','$encPass',3)");
                $query = mysqli_query($con,"INSERT INTO admin_privileges(adminNic,previlage) VALUES('$uname','super')");
                echo "success";
            }
            else{
                $query = mysqli_query($con,"INSERT INTO user_details(nic,firstName,lastName,gmail,address,password,roleId) VALUES('$uname','$fname','$lname','$email','$address','$encPass',3)");
                $query = mysqli_query($con,"INSERT INTO admin_privileges(adminNic) VALUES('$uname')");
                echo "success";
            }
        }
    }

    else if(isset($_POST['editAdminData'])){
        $userNic = $_POST['editAdminData'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['uname'];
        $address = $_POST['address'];
        $previ = $_POST['prevelige'];

        if($previ == "super"){
            $query = mysqli_query($con, "UPDATE user_details SET firstName = '$fname', lastName = '$lname', address = '$address', gmail = '$email' WHERE nic = '$userNic'");
            $query = mysqli_query($con, "UPDATE admin_privileges SET previlage = 'super' WHERE adminNic = '$userNic'");
            echo "success";
        }
        else{
            $query = mysqli_query($con, "UPDATE user_details SET firstName = '$fname', lastName = '$lname', address = '$address', gmail = '$email' WHERE nic = '$userNic'");
            $query = mysqli_query($con, "UPDATE admin_privileges SET previlage = 'simple' WHERE adminNic = '$userNic'");
            echo "success";
        }
    }

    else if(isset($_POST['adminDelId'])){
        $adminId = $_POST['adminDelId'];
        $query = mysqli_query($con, "DELETE FROM user_details WHERE nic = '$adminId'");
        echo "success";
    }

    else if(isset($_POST['gasbrand'])){
        $brand = $_POST['gasbrand'];
        $count = $_POST['count'];
        $size = $_POST['tank-size'];
        $conCount = 0;

        $query = mysqli_query($con, "SELECT * FROM main_stock");
        $row = mysqli_fetch_assoc($query);

        if($brand == "litro"){
            if($size == 2){
                $conCount = $row['litro2kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET litro2kg = $conCount");
            }
            else if($size == 5){
                $conCount = $row['litro5kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET litro5kg = $conCount");
            }
            else{
                $conCount = $row['litro12kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET litro12kg = $conCount");
            }
            echo "success";
        }
        else{
            if($size == 2){
                $conCount = $row['laughfs2kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET laughfs2kg = $conCount");
            }
            else if($size == 5){
                $conCount = $row['laughfs5kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET laughfs5kg = $conCount");
            }
            else{
                $conCount = $row['laughfs12kg'] + $count;
                $query = mysqli_query($con , "UPDATE main_stock SET laughfs12kg = $conCount");
            }
            echo "success";
        }
    }

    else if(isset($_POST['rejectId'])){
        $rejId = $_POST['rejectId'];
        $reason = $_POST['reason'];
        
        $query = mysqli_query($con, "SELECT * FROM gas_requests,user_details WHERE user_details.nic = gas_requests.userNic AND gas_requests.id = $rejId");
        $row = mysqli_fetch_assoc($query);

        $dealerNic = $row['nic'];
        $subject = $row['date']." Gas Request Rejected";
        $message = 'Dear '.$row['firstName'].', Your '.$row['date'].' '.$row['tankType'].' '.$row['tankSize'].'kg gas Request Rejected. Because of '.$reason.'. Be toch with us.';
        
        $query = mysqli_query($con,"INSERT INTO notifications(toNic,subject,message,date) VALUES('$dealerNic','$subject','$message','$today')");
        $query = mysqli_query($con, "DELETE FROM gas_requests WHERE id=$rejId");
        echo "success";
    }

    else if($_POST['gasRequireId']){
        $reqId = $_POST['gasRequireId'];
        $recDate = $_POST['recdate'];
        $issuecount = $_POST['issuecount'];
        $issueMessage = $_POST['issueMessage'];

        $query = mysqli_query($con, "SELECT * FROM gas_requests,user_details WHERE user_details.nic = gas_requests.userNic AND gas_requests.id = $reqId");
        $row = mysqli_fetch_assoc($query);

        $unic = $row['nic'];
        $uname = $row['firstName'];
        $brand = $row['tankType'];
        $size = $row['tankSize'];


        if($reqId == "" || $recDate == "" || $issuecount == ""){
            echo "ferror";
        }
        else{
            $subject = 'Gas Request Approvement';
            $message = 'Dear '.$uname.', your '.$row['date'].' Gas request approved.you will recieve '.$issuecount.' '.$size.'kg tanks on '.$recDate.'. Thanks you.';
            
            $query = mysqli_query($con,"SELECT * FROM main_stock");
            $row = mysqli_fetch_assoc($query);
            if($brand == "litro"){
                if($size == 2){
                    $updatedSize = $row['litro2kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET litro2kg = $updatedSize");
                }
                else if($size == 5){
                    $updatedSize = $row['litro5kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET litro5kg = $updatedSize");
                }
                else{
                    $updatedSize = $row['litro12kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET litro12kg = $updatedSize");
                }
            }
            else{
                if($size == 2){
                    $updatedSize = $row['laughfs2kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET laughfs2kg = $updatedSize");
                }
                else if($size == 5){
                    $updatedSize = $row['laughfs5kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET laughfs5kg = $updatedSize");
                }
                else{
                    $updatedSize = $row['laughfs12kg'] - $issuecount;
                    mysqli_query($con, "UPDATE main_stock SET laughfs12kg = $updatedSize");
                }
            }

            $query = mysqli_query($con,"UPDATE gas_requests SET aprovel = 1, noific = 1 WHERE id = $reqId");
            $query = mysqli_query($con,"INSERT INTO notifications(toNic,subject,message,date) VALUES('$unic','$subject','$message','$today')");
            echo "success";
        }
    }

    else if(isset($_POST['delMessageId'])){
        $messId = $_POST['delMessageId'];

        $query = mysqli_query($con, "DELETE FROM contact_messages WHERE id = $messId");
        echo "success";
    }

    else if(isset($_POST['markMessageId'])){
        $messId = $_POST['markMessageId'];
        
        $query = mysqli_query($con, "UPDATE contact_messages SET read_flag = 1 WHERE id = $messId");
        echo "success";
    }

    else if(isset($_POST['getMessageDataId'])){
        $msgId = $_POST['getMessageDataId'];

        $query = mysqli_query($con, "UPDATE contact_messages SET read_flag = 1 WHERE id = $msgId");        
        $query = mysqli_query($con, "SELECT * FROM contact_messages WHERE id = $msgId");
        $row = mysqli_fetch_assoc($query);
        echo '
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title ">'.$row['subject'].'</h5>
                        <p class="card-text">'.$row['message'].'</p>
                        <h6 class="card-subtitle mb-2 text-muted mt-3">'.$row['name'].'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$row['email'].'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$row['date'].'</h6>
                    </div>
                </div>';
    }

    else if(isset($_POST['replyMailId'])){
        $msgId = $_POST['replyMailId'];
        
        $query = mysqli_query($con, "SELECT * FROM contact_messages WHERE id = $msgId");
        $row = mysqli_fetch_assoc($query);
        echo $row['email'];
    }

    else if(isset($_POST['postMailId'])){
        $msgId = $_POST['postMailId'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $email = $_POST['gmail'];
        
        $query = mysqli_query($con, "UPDATE contact_messages SET read_flag = 1 WHERE id = $msgId"); 
        $query = mysqli_query($con, "SELECT * FROM contact_messages WHERE id = $msgId");
        $row = mysqli_fetch_assoc($query);

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
        $mail -> Subject = $subject;
        // from set
        $mail -> setFrom("lpgsmartservice.org@gmail.com", "LPG SMART SERVICE");
        
        $email = "sandarusbandara110@gmail.com";

        $fmessage = 'Hey '.$row['name'].', '.$message;
        // body
        $mail -> isHTML(true);
        $mail -> CharSet = "UTF-8";
        $mail -> Body = $fmessage;
        // recipient
        $mail -> addAddress($email);
        
        
        $mail -> Send();
        $mail ->  smtpClose();

        echo "success";
        
    }

    else if(isset($_POST['notificIdMark'])){
        $notificId = $_POST['notificIdMark'];

        $query = mysqli_query($con, "UPDATE gas_requests SET noific = 1 WHERE id = $notificId");
        echo "success";
    }

    else if(isset($_POST['lotRequestRemoveId'])){
        $rejectLotId = $_POST['lotRequestRemoveId'];
        
        $query = mysqli_query($con, "DELETE FROM gas_requests WHERE id = $rejectLotId");
        echo "success";
    }



    function dateDiff($d1,$d2){
        $diff = strtotime($d1) - strtotime($d2);
        return abs(round($diff / 86400));
    }