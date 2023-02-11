<?php
    include_once "database/connection.php";

    session_start();
    $userNic = $_SESSION['user_id'];

    if($userNic == ""){
        header("location: /login.php");
    }

    $query = mysqli_query($con, "SELECT * FROM user_details,admin_privileges WHERE admin_privileges.adminNic = user_details.nic AND nic = '$userNic'");
    $rowuser = mysqli_fetch_assoc($query);
    $name = $rowuser['firstName'] . " " . $rowuser['lastName'];

    $loop = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="vendor/quill/quill.bubble.css">
    <link rel="stylesheet" href="vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="shortcut icon" href="/src/images/favicon.png" type="image/x-icon">
    <title>Notifications</title>
    <style>
        a {
            text-decoration: none;
        }
        .btns{
            position: absolute;
            right: 2%;
            top: 40%;
        }
        .btns button{
            margin-right: 10px;
        }
    </style>
</head>

<body>
        <?php
            include_once "layouts/topnav.php";
            include_once "layouts/sidenavbar.php";
        ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Notifications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </nav>
        </div>

        <div class="container mt-5">
        <?php

            $query = mysqli_query($con,"SELECT * FROM gas_requests,user_details WHERE gas_requests.userNic = user_details.nic ORDER BY date ASC, aprovel ASC");
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['noific'] == 0){
                        echo '
                        <div class="card notific" style="position: relative; border: 2px solid #112A6D">
                            <div class="card-body">
                                <span class="d-block" style="font-weight: bold;">'.$row['subject'].'</span>
                                <span class="d-block">'.$row['firstName'].' Requested '.$row['tankType'].' '.$row['tankSize'].'kg '.$row['lotSize'].' tanks on '.$row['date'].'. his location is '.$row['address'].'.</span>
                            </div>
                            <div class="btns">
                                <button class="btn btn-sm btn-success" id="sComOpen" value="'.$row['id'].'" onClick="openNotific(this.value)" title="Open"><i class="bi bi-forward"></i></button>'.($row['noific'] == 1 ? '<button class="btn btn-sm btn-secondary disabled ml-3" id="sComMark" ><i class="bi bi-check2-all"></i></button>': '<button class="btn btn-sm btn-secondary ml-3" id="sComMark" value="'.$row['id'].'" onclick="notificMark(this.value)" title="Mark as Read"><i class="bi bi-check2-all"></i></button>').'
                            </div>
                        </div>';
                    }
                    else{
                        echo '
                        <div class="card notific" style="position: relative;">
                        <div class="card-body">
                            <span class="d-block" style="font-weight: bold;">'.$row['subject'].'</span>
                            <span class="d-block">'.$row['firstName'].' Requested '.$row['tankType'].' '.$row['tankSize'].'kg '.$row['lotSize'].' tanks on '.$row['date'].'</span>
                        </div>
                        <div class="btns">
                            <button class="btn btn-sm btn-success" id="sComOpen" value="'.$row['id'].'" onClick="openNotific(this.value)" title="Open"><i class="bi bi-forward"></i></button>'.($row['noific'] == 1 ? '<button class="btn btn-sm btn-secondary disabled ml-3" id="sComMark" ><i class="bi bi-check2-all"></i></button>': '<button class="btn btn-sm btn-secondary ml-3" id="sComMark" value="'.$row['id'].'" onclick="notificMark(this.value)" title="Mark as Read"><i class="bi bi-check2-all"></i></button>').'
                        </div>
                    </div>';
                    }
                }
            }
            else{
               echo '
                <div class="card notific">
                    <div class="card-body">
                        No Notifications Available
                    </div>
                </div>';
            }
        ?>
        </div>
    </main>

    <script src="vendor/apexcharts/apexcharts.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/chart.umd.js"></script>
    <script src="vendor/echarts/echarts.min.js"></script>
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="styles/main.js"></script>
</body>
</html>