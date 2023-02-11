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
    <title>Gas Requests</title>
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

    <main class="main request-view" id="main">
        <div class="pagetitle">
            <h1>Requested Tanks Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="stockManage.php">Stock Management</a></li>
                    <li class="breadcrumb-item active">Requested Tank Details</li>
                </ol>
            </nav>
        </div>
        <div class="row mt-5">
            <div class="container">
                <div class="card container recent-sales overflow-auto">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Size</th>
                                    <th class="text-center" scope="col">Requested Tanks</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $loop = 1;
                                    $query = mysqli_query($con, "SELECT * FROM gas_requests,user_details WHERE user_details.nic = gas_requests.userNic ORDER BY aprovel ASC,id DESC");
                                    
                                    if(mysqli_num_rows($query) > 0){
                                        while($row = mysqli_fetch_assoc($query)){
                                            echo '
                                                <tr>
                                                    <th scope="row"><a href="#">'.$loop.'</a></th>
                                                    <td>'.$row['firstName'].' '.$row['lastName'].'</td>
                                                    <td>'.$row['tankType'].'</td>
                                                    <td>'.$row['tankSize'].'kg</td>
                                                    <td class="text-center">'.$row['lotSize'].'</td>
                                                    <td>'.$row['date'].'</td>
                                                    <td>'.($row['aprovel'] == 0 ? '<span class="badge bg-danger">Pending</span>': '<span class="badge bg-success">Issued</span>').'</td>
                                                    <td class="text-center">'.($row['aprovel'] == 0 ? '<button class="btn btn-sm btn-info" value="'.$row['id'].'" id="issueLot">Issue</button>': '<button class="btn btn-sm btn-info" value="'.$row['id'].'" id="issueLot" disabled>Issue</button>').' '.($row['aprovel'] == 0 ? '<button class="btn btn-sm btn-danger" value="'.$row['id'].'" onclick="rejectLot(this.value)" data-bs-toggle="modal" data-bs-target="#basicModal">Reject</button>': '<button class="btn btn-sm btn-danger" value="'.$row['id'].'" onclick="removeRLot(this.value)">Remove</button>').'</td>
                                                </tr>';

                                                ++$loop;
                                        }
                                    }
                                    else{
                                        echo '
                                        <td colspan="8" class="text-center">No Data Found</td>';
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="main issue-add d-none" id="main">
        <div class="pagetitle">
            <h1>Issue Stock</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="stockManage.php">Stock Management</a></li>
                    <li class="breadcrumb-item"><a href="gasRequests.php">Requested Tank Details</a></li>
                    <li class="breadcrumb-item active">Issue Stock</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Issue Lot</h5>
                        <div class="row g-3 mt-5 justify-content-center" id="stockupForm">
                            <div class="col-md-12 text-center admnaddAlert d-none">
                                <div class="alert alert-danger addAlert"></div>
                            </div>
                            <div class="col-md-8">
                                <span>Recieving Date to Seller</span>
                                <input type="date" class="form-control" placeholder="Arrivel Date to Seller" name="arrDate" id="recDate">
                            </div>
                            <div class="col-md-8">
                                <span>Tanks Count</span>
                                <input type="number" class="form-control" placeholder="Tanks Count" name="issueCount" id="issueCount">
                            </div>
                            <div class="col-md-8">
                                <span>Send with Message</span>
                                <input type="text" class="form-control" placeholder="Your Message" name="message" id="messageD">
                            </div>
                            <div class="text-center mt-3">
                                <button id="issueLotcon" class="btn btn-primary" onclick="issueTanks()">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>    

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Seller Tank Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="justify-content-center">
                        <div class="alert alert-danger text-center d-none rejectAlert"></div>
                        <span class="d-block">Enter Reason</span>
                        <textarea name="" id="rejectReason" cols="42" rows="4" style="padding: 8px 10px; border: 2px solid rgb(150, 153, 151); border-radius: 5px;" requred></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="rejectConfirmation" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </div>
    </div>

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