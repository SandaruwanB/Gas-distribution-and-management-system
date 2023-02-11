<?php
    include_once "database/connection.php";

    session_start();
    $nic = $_SESSION['user_id'];
    if($nic != ""){
        $query = mysqli_query($con, "SELECT * FROM user_details,roles WHERE user_details.roleId = roles.id AND nic = '$nic'");
        $row = mysqli_fetch_assoc($query);
        if($row['name'] == "dealer"){
            header("location: pannels/dealer/dhome.php");
        }
        else if($row['name'] == "customer"){
            header("location: pannels/customer/chome.php");
        }
        else{
            header("location: pannels/admin/dashboard.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="shortcut icon" href="src/images/favicon.png" type="image/x-icon">

    <title>LPG SS Log In</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="styles/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="styles/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="styles/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="styles/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles/css/login.css">
    <style>
        .mid{
            display: flex;
            position: relative;
            flex-direction: row;
            justify-content: center;
        }
        #login-form p{
            font-size: 14px;
            color: red;
            display: block;
            padding: 0;
        }
    </style>
</head>
<body class="sub_page">
    <div class="hero_area">
        <div class="hero_bg_box">
            <img src="src/images/bgimage.jpg" alt="">
         </div>
        <!-- header section strats -->
            <?php include_once "layouts/navbar.html"; ?>
        <!-- end header section -->
    </div>
    <section class="contact_section layout_padding-bottom" style="margin-top: 40px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="form_container">
                        <div class="heading_container heading_center">
                            <h2>Log In</h2>
                        </div>
                        <div style="text-align: center; margin-bottom: 20px;">
                            New to LPG Smart Service? <a href="register.php">register now</a>
                        </div>
                        <div class='alert alert-danger' id="loginerr" role='alert' style='margin-bottom: 20px; display: none; text-align: center;'>
                            
                        </div>
                        <div class="mid">
                            <form method="POST" id="login-form">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="NIC Number" name="nic" id="login-nic"/>
                                        <p class="login-nic-error"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col" id="main">
                                        <input type="password" class="form-control" id="loginPass" placeholder="Password" name="password"/>
                                        <div class="icon">
                                            <ion-icon class="open" name="eye-outline" onclick="loginshow()"></ion-icon>
                                            <ion-icon class="close" name="eye-off-outline" onclick="loginhide()"></ion-icon>
                                        </div>
                                        <p class="nic-error"></p>
                                    </div>
                                </div>
                                <div style="text-align: left; margin-top: 10px; margin-left: 20px; margin-bottom: 20px;">
                                    <a href="passwordreset.php">Forgot Password? </a>
                                </div>
                                <div class="btn_box">
                                    <button name="login" id="sign-btn">
                                        Log In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "layouts/footer.html"; ?>

    <script src="styles/js/jquery-3.4.1.min.js"></script>
    <script src="styles/js/ajax.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="styles/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="styles/js/custom.js"></script>
    <script src="styles/js/forms.js"></script>
</body>
</html>   