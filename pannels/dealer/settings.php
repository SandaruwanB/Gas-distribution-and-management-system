<?php
    include_once "dbworks/connection.php";

    session_start();
    $nic = $_SESSION['user_id'];
    
    if($nic == ""){
        header("location: /login.php");
    }
    else{
        $query = mysqli_query($con,"SELECT * FROM user_details,dealer_gas_details WHERE dealer_gas_details.dealerNic = user_details.nic AND nic = '$nic'");
        $row = mysqli_fetch_assoc($query);
        $user = $row['firstName'] . " " . $row['lastName'];
        $fname = $row['firstName'];
        $lname = $row['lastName'];
        $mail = $row['gmail'];
        $gasType = $row['brand'];

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

    <title>Settings</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/styles/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- font awesome style -->
    <link href="/styles/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="styles/styles.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="/styles/css/responsive.css" rel="stylesheet" />
</head>

<body>

<div class="container" style="margin-top: 8vh;">
        <div class="wrapper bg-white mt-sm-5">
            <a href="#" onclick="javascript:window.history.back(-1);return false;" style="font-size: 2rem; margin-top: 50%;" style="margin-left: 2%;"><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Go Back</a><h4 class="pb-4 border-bottom text-center" style="font-weight: bold; font-size: 2rem;">Account settings</h4>
            <div class="d-flex align-items-start py-3 border-bottom">
                <div class="pl-sm-4 pl-2" id="img-section" style="position: relative;">
                    <h3><i class="fa fa-user" aria-hidden="true" style="color: darkblue;"></i>&nbsp;&nbsp;<?php echo $user; ?></h3>
                    <h6><i class="fa fa-envelope" aria-hidden="true" style="color: darkblue;"></i>&nbsp;&nbsp;<?php echo $mail; ?></h6>
                </div>
            </div>
            <div class="py-2">
                <div class="alert alert-danger d-none" id="pErrPrint2" style="text-align: center;"></div>
                <div class="row py-2">
                    <div class="col-md-6">
                        <label for="firstname">First Name</label>
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $fname; ?>" id="fname">
                    </div>
                    <div class="col-md-6 pt-md-0 pt-3">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $lname; ?>" id="lname">
                    </div>
                </div>
                <div class="py-3 pb-4 border-bottom">
                    <button class="btn btn-primary mr-3" id="changeName">Change Name</button>
                    <button class="btn border button" id="cleanName">Cancel</button>
                </div>
                <div class="alert alert-danger mt-2 d-none" id="pErrPrint3" style="text-align: center;"></div>
                <div class="row py-2">                    
                    <div class="col-md-6 pt-md-0" id="lang">
                        <label for="language">Type</label>
                        <div class="arrow">
                            <select name="language" id="type" class="bg-light" onchange="typeChanged(this.value)">
                                <?php
                                    if($gasType == "litro"){
                                        echo '<option value="litro" selected>Litro</option>
                                        <option value="laughfs">Laughfs</option>
                                        <option value="all">All</option>';
                                    }
                                    else if($gasType == "all"){
                                        echo '<option value="litro">Litro</option>
                                        <option value="laughfs">Laughfs</option>
                                        <option value="all" selected>All</option>';
                                    }
                                    else{
                                        echo '<option value="litro">Litro</option>
                                        <option value="laughfs" selected>Laughfs</option>
                                        <option value="all">All</option>';
                                    }
                    
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pt-md-0 pt-3">
                        <label for="lastname">Shop Registration Number</label>
                        <input type="text" class="bg-light form-control" placeholder="your shop registration code" id="shopNo">
                    </div>
                </div>
                <div id="alertSetter" class="alert alert-primary text-center mt-4 d-none">Please Enter Your New Gas Lot Details</div>
                <div class="row py-2 d-none" id="lot-taker">
                    <div class="col-md-4">
                        <label for="firstname">2kg Tanks</label>
                        <input type="number" class="bg-light form-control" placeholder="2kg gas tanks" id="twoTanks">
                    </div>
                    <div class="col-md-4 pt-md-0 pt-3">
                        <label for="lastname">5kg Tanks</label>
                        <input type="number" class="bg-light form-control" placeholder="5kg gas tanks" id="fiveTanks">
                    </div>
                    <div class="col-md-4 pt-md-0 pt-3">
                        <label for="lastname">12.5kg Tanks</label>
                        <input type="number" class="bg-light form-control" placeholder="12.5kg gas tanks" id="twelveT">
                    </div>
                </div>
                <div class="py-3 pb-4 border-bottom">
                    <button class="btn btn-primary mr-3" id="txtSave" onclick="testFunc()">Change Details</button>
                    <button class="btn border button" id="cancelUN">Cancel</button>
                </div>

                <div class="py-2">
                    <div class="alert alert-danger d-none" id="pErrPrint" style="text-align: center;"></div>
                    <div class="row py-2">
                        <div class="col-md-6">
                            <label for="firstname">Old Password</label>
                            <input type="password" class="bg-light form-control" placeholder="old password" id="oldPw">
                        </div>
                        <div class="col-md-6 pt-md-0 pt-3">
                            <label for="lastname">New Password</label>
                            <input type="password" class="bg-light form-control" placeholder="new password" id="newPw">
                            <p id="password-error" style="color: red; margin-left: 2%;"></p>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-6">
                            <label for="firstname">Re-Enter New Password</label>
                            <input type="password" class="bg-light form-control" placeholder="re-new password" id="rnewPw">
                            <p id="password-error2" style="color: red; margin-left: 2%;"></p>
                        </div>
                    </div>
                    <input type="checkbox" style="margin-left: 3%; height: 20px; width: 20px;" id="showpw" onclick="showPW()">&nbsp;&nbsp;<span>Show Passwords</span>
                    <div class="py-3 pb-4 border-bottom">
                        <button class="btn btn-primary mr-3" id="changePw">Change Password</button>
                        <button class="btn border button" id="clearPW">Cancel</button>
                    </div>
                </div>
                <div class="d-sm-flex align-items-center pt-3" id="deactivate">
                    <div>
                        <b>Delete My Account</b>
                        <p>This will remove your account permanatly</p>
                    </div>
                    <div class="ml-auto">
                        <button class="btn danger" id="delAcc">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center p-4 mt-5" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="#">Group SNR (GROUP 1)</a>
    </div>

    <div class="alertz hide" id="alertPOP" >
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <span class="msg">Successfully Changed</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>

    <!-- jQery -->
    <script src="/styles/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <!-- bootstrap js -->
    <script src="/styles/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" ></script>

    <script src="styles/custom.js"></script>

</body>

</html>