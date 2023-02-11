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
    <title>Manage Stock</title>
    <style>
        a {
            text-decoration: none;
        }
        button{
            margin-left: 10px;
        }
    </style>
</head>

<body>
        <?php
            include_once "layouts/topnav.php";
            include_once "layouts/sidenavbar.php";
        ?>

    <main id="main" class="main stock-view">
        <div class="pagetitle">
            <h1>Stock Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Stock Management</li>
                </ol>
            </nav>
        </div>
        <div class="text-center">
            <button class="btn btn-primary btn-md mb-3" id="update-stock">Update Stock Data</button>
        </div>

        <?php
            $query = mysqli_query($con,"SELECT * FROM main_stock");
            $row = mysqli_fetch_assoc($query);
        ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Main Stock</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">2kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['laughfs2kg'] ?></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">5kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['laughfs5kg'] ?></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">12.5kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['laughfs12kg'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Litro Main Stock</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">2kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['litro2kg'] ?></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">5kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['litro5kg'] ?></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card"  style="border: solid 5px rgb(14, 97, 36);">
                                        <h5 class="card-title font-weight-bold text-center">12.5kg Tanks</h5>
                                        <p style="margin-left: 10%;">Tank Count <span style="margin-left: 10%; font-size: 1rem; font-weight: bold;"><?= $row['litro12kg'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="container">
                    <h3 class="text-center">Recent Gas Requests</h3>
                    <div class="card container recent-sales overflow-auto">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Tank Count</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $loop = 1;
                                        $query = mysqli_query($con, "SELECT * FROM gas_requests,user_details WHERE user_details.nic = gas_requests.userNic ORDER BY id DESC LIMIT 5");
                                        while($row = mysqli_fetch_assoc($query)){
                                            echo '
                                                <tr>
                                                    <th scope="row"><a href="#">'.$loop.'</a></th>
                                                    <td>'.$row['firstName'].' '.$row['lastName'].'</td>
                                                    <td>'.$row['tankType'].'</td>
                                                    <td>'.$row['tankSize'].'</td>
                                                    <td>'.$row['lotSize'].'</td>
                                                    <td>'.$row['date'].'</td>
                                                </tr>';

                                            ++$loop;
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center" id="view-all-requests"><a href="#">View All</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <main class="main stock-add d-none" id="main">
        <div class="pagetitle">
            <h1>Update Stock Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="stockManage.php">Stock Management</a></li>
                    <li class="breadcrumb-item active">Update Stock Details</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Update Stock Details</h5>
                        <form class="row g-3 mt-5 justify-content-center" id="stockupForm">
                            <div class="col-md-12 text-center admnaddAlert d-none">
                                <div class="alert alert-danger addAlert"></div>
                            </div>
                            <div class="col-md-8">
                                <select class="form-select" name="gasbrand">
                                    <option selected>Choose Brand</option>
                                    <option value="litro">Litro Gas</option>
                                    <option value="laughfs">Laughfs Gas</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control" placeholder="Tanks Count" name="count">
                            </div>
                            <div class="col-md-8">
                                <select class="form-select" name="tank-size">
                                    <option selected>Choose Tank Size</option>
                                    <option value="2">2kg Tanks</option>
                                    <option value="5">5kg Tanks</option>
                                    <option value="12.5">12.5kg Tanks</option>
                                </select>
                            </div>

                            <div class="text-center mt-3">
                                <button id="updateStock" class="btn btn-primary">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="alertz hide" >
        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
        <span class="msg">Success</span>
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