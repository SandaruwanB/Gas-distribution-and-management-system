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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="src/images/favicon.png" type="image/x-icon">

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
    <title>Reset Your Password</title>
</head>
<body style="height: 100vh;">
    <div class="d-flex justify-content-center"  id="form1">
        <div class="col col-sm-8 d-block" id="form1-in">
            <div style="height: 100%; width: 100%; margin-top: 10%; text-align: center;">
                <img src="src/images/favicon.png" class="rounded mx-auto d-block" style="width: 120px;">
                <p class="h1 mt-5">Reset Your Password</p>
                <p class="mt-3" style="width: 80%; text-align: left; margin-left: 10%;">Fear not. We'll email you some featured code to reset your password. If you don't have access to your account anymore, You can try <a href="#">Reset Password.</a></p>
                <div class="row d-flex justify-content-center mt-5">
                    <div class="alert alert-danger w-50 " style="display: none;" id="resetNic-error">

                    </div>
                </div>
                <form class="mt-3" id="resetForm1">
                    <div class="row d-flex justify-content-center">
                        <div class="form-group mb-2">    
                            <input type="text" class="form-control" id="resetnic" placeholder="Your NIC " name="resetnic">
                        </div>
                    </div>
                    <div class="row mt-1 d-flex justify-content-center">
                        <p class="resetnic-error" style="color: red;"></p>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" id="resetBtn" class="btn btn-primary mt-2" ><span class="" id="rname">Reset Password</span><i class="fa fa-spinner fa-pulse fa-3x fa-fw d-none" id="rloader" style="font-size: 1.5rem;font-weight: bold;"></i></button>
                        <a href="login.php" class="mt-3 ml-3">Return to Login</a>
                    </div>                    
                </form>
            </div>
        </div>

        <div class="col col-sm-8 d-none"  id="form2-in">
            <div style="height: 100%; width: 100%; margin-top: 10%; text-align: center;">
                <img src="src/images/favicon.png" class="rounded mx-auto d-block" style="width: 120px;">
                <p class="h1 mt-5">Veryfy It's You</p>
                <p class="mt-3" style="width: 80%; text-align: left; margin-left: 10%;">Fear not. We emailed you a verification code to reset your password. Please check your gmail and paste your code here.</p>
                <div class="row d-flex justify-content-center mt-5">
                    <div class="alert alert-danger w-50 " style="display: none;" id="resetver-error">

                    </div>
                </div>
                <form class="mt-3" id="resetForm1">
                    <div class="row d-flex justify-content-center">
                        <div class="form-group mb-2">    
                            <input type="text" class="form-control" id="verify" placeholder="Verification Code" name="verifycode">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" id="resetBtn2" class="btn btn-primary mt-2">Done</button>
                        <a href="login.php" class="mt-3 ml-3">Return to Login</a>
                    </div>                    
                </form>
            </div>
        </div>

        <div class="col col-sm-8 d-none"  id="form3-in">
            <div style="height: 100%; width: 100%; margin-top: 10%; text-align: center;">
                <img src="src/images/favicon.png" class="rounded mx-auto d-block" style="width: 120px;">
                <p class="h1 mt-5">Enter Your New Password</p>
                <p class="mt-3" style="width: 80%; text-align: left; margin-left: 10%;">Fear not. Your new password will be add to your account and you can use this password after compleating the form.</p>
                <div class="row d-flex justify-content-center mt-5">
                    <div class="alert alert-danger w-50 " style="display: none;" id="pass-error">

                    </div>
                </div>
                <form class="mt-3" id="resetForm1">
                    <div class="row d-flex justify-content-center">
                        <div class="form-group mb-2">    
                            <input type="password" class="form-control" id="pass" placeholder="New Password" name="verifycode">
                        </div>
                    </div>
                    <div class="row mt-1 d-flex justify-content-center">
                        <p class="password-error1" style="color: red;"></p>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="form-group mb-2">    
                            <input type="password" class="form-control" id="repass" placeholder="Re-Enter Password" name="verifycode">
                        </div>
                    </div>
                    <div class="row mt-1 d-flex justify-content-center">
                        <p class="repassword-error" style="color: red;"></p>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" id="resetBtn3" class="btn btn-primary mt-2">Done</button>
                        <a href="login.php" class="mt-3 ml-3">Return to Login</a>
                    </div>                    
                </form>
            </div>
        </div>
        <div class="col col-sm-8 d-none"  id="form4-in">
            <div style="height: 100%; width: 100%; margin-top: 10%; text-align: center;">
                <img src="src/images/favicon.png" class="rounded mx-auto d-block" style="width: 120px;">
                <p class="h1 mt-5">Success</p>
                <p class="mt-3" style="width: 80%; text-align: left; margin-left: 10%;">Congratulations. Your password changed successfully. please use new password to login to your account.</p>
                <div class="row d-flex justify-content-center mt-5">
                    <a href="login.php"><button type="submit" id="resetBtn3" class="btn btn-primary mt-2">Return to Login</button></a>
                </div>                    
                </form>
            </div>
        </div>
    </div>


    <footer class="footer_section" style="margin-top: 230px;">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#">Group SNR (Group 1)</a>
            </p>
        </div>
    </footer>


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