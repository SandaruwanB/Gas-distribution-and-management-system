<?php
        include_once "dbworks/connection.php";

        $today = date("Y-m-d");
        $user = "";
        session_start();
        $nic = $_SESSION['user_id'];
    
        if($nic == ""){
            header("location: /login.php");
        }
        else{
            $query = mysqli_query($con,"SELECT * FROM user_details WHERE nic = '$nic'");
            $row = mysqli_fetch_assoc($query);
            $user = $row['firstName'] . " " . $row['lastName'];
        }
    
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="/src/images/favicon.png" type="image/x-icon">

    <title>My QR</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/styles/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="/styles/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="/styles/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/styles.css">
    <!-- responsive style -->
    <link href="/styles/css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <div class="hero_bg_box" style="height: 90px;">
            <img src="/src/images/bgimage.jpg"  alt="">
        </div>
        <!-- header section strats -->
        <?php include_once "layouts/navbar.php"; ?>
        <!-- end header section -->

  <!-- contact section -->
    <section class="contact_section layout_padding mt-5">
        <div class="container">
            <div class="container-fluid">
                <div class="heading_container heading_center">
                    <h2>Your QR Code and Quota</h2>
                    <p>After Pressing Download Button Below Your QR Code Download To Your Local Storage.<br>After Scanning It by Gas Seller, You Can Buy a Gas. Remeber to check Your Quota Before Go To the Gas Shop.</p>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card text-center" style="border: 4px solid #09035e; box-shadow: 0 0 3px #000;">
                            <div class="card-header">
                                <img src="/database/temp/<?php echo $nic; ?>.png" alt="" width="195px">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Your QR Code</h5>
                                <p class="card-text">Press Download Button to Download Your QR Code.<a href=""></a></p>
                                <a href="/database/temp/<?php echo $nic; ?>.png" class="btn btn-primary" download="">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card" style="border: 4px solid #09035e; box-shadow: 0 0 3px #000">
                            <div class="card-header text-center">
                                <h3>Quota Details</h3>
                            </div>
                            <div class="card-body">
                                <table class="table w-75 ml-5" style="border: 2px solid #024d08;">
                                    <?php

                                        $query = mysqli_query($con, "SELECT * FROM user_details,customer_gas_details WHERE customer_gas_details.userNic = user_details.nic AND nic = '$nic'");
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

                                    ?>
                                    <div class="container">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Gas Tank Size</td>
                                                <td><?php echo $row['size']; ?>kg</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Gat Tank Modal</td>
                                                <td><?php echo $row['brand']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Bought Date</th>
                                                <td><?php echo ($row['boughtDate'] == null ? "not yet bought": $row['boughtDate']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Quota</th>
                                                    <?php
                                                    
                                                    if($dateDiff >= 14 || $row['boughtDate'] == null && $row['size'] < 3){
                                                        echo "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                                    }
                                                    else if($dateDiff >= 21 || $row['boughtDate'] == null && $row['size'] < 6){
                                                        echo "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                                    }
                                                    else if($dateDiff >= 28 || $row['boughtDate'] == null && $row['size'] < 15){
                                                        echo "<td style='color: green;'>One ".$row['size']."kg Tank</td>";
                                                    }
                                                    else{
                                                        echo "<td style='color: red;'>no quota left</td>";
                                                    }
                                                    ?>
                                            </tr>
                                            <tr>
                                                <th scope="row">Next Buying Date</th>
                                                <td><?php echo ($row['boughtDate'] == NULL ? $today: ($nextDate <= $today ? $today : $nextDate)); ?></td>
                                            </tr>
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <?php include_once "layouts/footer.html"; ?>

    <script src="/styles/js/jquery-3.4.1.min.js"></script>
    <script src="/pannels/customer/styles/main.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="/styles/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="/styles/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php
    function dateDiff($d1,$d2){
        $diff = strtotime($d1) - strtotime($d2);
        return abs(round($diff / 86400));
    }
?>