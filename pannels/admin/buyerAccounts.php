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
    <title>Sellers Accounts</title>
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
        <?php
            include_once "layouts/topnav.php";
            include_once "layouts/sidenavbar.php";
        ?>

   <main id="main" class="main alluser-data">
        <div class="pagetitle">
            <h1>Buyer Accounts Control</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Buyer Accounts Control</li>
                </ol>
            </nav>
        </div>

        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">NIC Number</th>
                    <th scope="col">Location</th>
                    <th class="text-center" scope="col">Gas Type</th>
                    <th scope="col">Member Since</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = mysqli_query($con, "SELECT * FROM user_details,roles,customer_gas_details WHERE customer_gas_details.userNic = user_details.nic AND roles.id = user_details.roleId AND roles.name = 'customer'");
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '
                                <tr>
                                    <th scope="row">'.$loop.'</th>
                                    <td>'.$row['firstName'].' '.$row['lastName'].'</td>
                                    <td>'.$row['gmail'].'</td>
                                    <td>'.$row['nic'].'</td>
                                    <td>'.$row['address'].'</td>
                                    <td class="text-center">'.($row['brand']== "all"? "Litro/Laughfs": $row['brand']).'</td>
                                    <td>'.date("Y-m-d", strtotime($row['registerd'])).'</td>
                                    <td class="text-center">'.($row['status'] == 0 ? "<p style='background: #f00; color: #fff; border-radius:5px;'>Inactive</p>": "<p style=' background: #0f0;color: #fff; border-radius: 5px'>Active</p>").'</td>
                                    <td class="text-center"><button id="stoc-details" value='.$row['nic'].' class="btn btn-sm btn-primary" onClick="viewDetails(this.value)">View Details</button><button class="btn btn-danger btn-sm" style="margin-left: 10px;" value='.$row['nic'].' id="urmove-btn" onClick="delBuyer(this.value)">Remove</button></td>
                                </tr>
                            ';
                            ++$loop;
                        }
                    }   
                    else{
                        echo '<tr class="text-center">
                            <td colspan="8">No Users Found</td>
                        </tr>';
                    }             
                ?>

            </tbody>
        </table>
    </main>

    <main id="main" class="main userD-data d-none">
        <div class="pagetitle">
            <h1>Buyer Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="buyerAccounts.php">Buyer Accounts Control</a></li>
                    <li class="breadcrumb-item active">Buyer Details</li>
                </ol>
            </nav>
        </div>
        <div class="cont">

        </div>
    </main>

    <div class="alertz hide" >
        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
        <span class="msg">Successfully Removed</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>



    <script src="vendor/apexcharts/apexcharts.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/chart.umd.js"></script>
    <script src="vendor/echarts/echarts.min.js"></script>
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="styles/main.js"></script>
</body>
</html>