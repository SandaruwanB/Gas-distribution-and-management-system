<!DOCTYPE html>
<html lang="en">
<?php
    include_once "database/connection.php";

    session_start();
    $userNic = $_SESSION['user_id'];

    if($userNic == ""){
        header("location: /login.php");
    }

    $mainTankCount = 0;

    $query = mysqli_query($con, "SELECT * FROM user_details,admin_privileges WHERE admin_privileges.adminNic = user_details.nic AND nic = '$userNic'");
    $rowuser = mysqli_fetch_assoc($query);
    $name = $rowuser['firstName'] . " " . $rowuser['lastName'];

    $query2 = mysqli_query($con, "SELECT * FROM user_details WHERE roleId = 2");
    $buyerCount = mysqli_num_rows($query2);

    $query2 = mysqli_query($con, "SELECT * FROM user_details WHERE roleId = 1");
    $dealerCount = mysqli_num_rows($query2);

    $query2 = mysqli_query($con, "SELECT * FROM main_stock");
    $row2 = mysqli_fetch_assoc($query2);
    $mainTankCount = $row2['laughfs2kg'] + $row2['laughfs5kg'] + $row2['laughfs12kg'] + $row2['litro2kg'] + $row2['litro5kg'] + $row2['litro12kg'];

    $query2 = mysqli_query($con, "SELECT * FROM issue_history");
    $soldCount = mysqli_num_rows($query2);
?>


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
    <title>Dashboard</title>
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

   <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sellers <span>| All</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $dealerCount ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Buyers <span>| All</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $buyerCount ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Main Stock <span>| All Tanks</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-archive-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $mainTankCount ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sold Tanks <span>| Total</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-archive-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $soldCount ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Slaes <span>| This Year</span></h5>
                                    <div id="reportsChart"></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Litro Gas',
                                                    data: [
                                                        31,
                                                        0,
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0,
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0
                                                    ]
                                                        ,
                                                }, {
                                                    name: 'Laughfs Gas',
                                                    data: [
                                                        11, 
                                                        0,
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0,
                                                        0, 
                                                        0, 
                                                        0, 
                                                        0
                                                    ]
                                                }
                                                ],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 7
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'month',
                                                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "nov", "Dec"]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'MM'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Gas Requets</h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Seller</th>
                                                <th scope="col">Brand</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Requested Lot Size</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $loop = 1;
                                                $query = mysqli_query($con, "SELECT * FROM user_details,gas_requests WHERE gas_requests.userNic = user_details.nic");
                                                if(mysqli_num_rows($query) > 0){
                                                    while($row = mysqli_fetch_assoc($query)){
                                                        echo '
                                                        <tr>
                                                            <th scope="row"><a href="#">#'.$loop.'</a></th>
                                                            <td>'.$row['firstName'].'   '.$row['lastName'].'</td>
                                                            <td><a href="#" class="text-primary">'.$row['tankType'].'</a></td>
                                                            <td>'.$row['tankSize'].'kg</td>
                                                            <td>'.$row['lotSize'].'</td>
                                                            <td>'.($row['aprovel'] == 0 ? '<span class="badge bg-danger">Not Approved</span>': '<span class="badge bg-success">Approved</span>').'</td>
                                                        </tr>';
                                                    }
                                                    echo '<td class="text-center" colspan="6"><a href="gasRequests.php">View All</a></td>';
                                                }
                                                else{
                                                    echo '<td class="text-center" colspan="6">No Data Available</td>';
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>LPG Smart Service</span></strong>
        </div>
    </footer>

    <script src="vendor/apexcharts/apexcharts.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/chart.umd.js"></script>
    <script src="vendor/echarts/echarts.min.js"></script>
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="styles/main.js"></script>
</body>

</html>