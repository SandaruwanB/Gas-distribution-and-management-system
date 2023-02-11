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

    <title>LPG SS Registration</title>

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
    <link rel="stylesheet" href="styles/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .conditions:hover{
            border-bottom: 2px solid #00f;    
        }
        #form1 p{
            font-size: 14px;
            color: red;
            display: block;
            padding: 0;
        }
        #form1 input{
            padding-bottom: 0;
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
        <div class="container-fluid" id="form1st">
                <div class="col-md-7 mx-auto">
                    <div class="form_container">
                        <div class="heading_container heading_center">
                            <h2>Registration</h2>
                        </div>
                        <div style="text-align: center; margin-bottom: 20px;">
                            Already have LPG Smart Service Account?<a class="conditions" href="login.php">&nbsp;Log In</a>
                        </div>
                            <div class="alert alert-danger" id="accAv" role="alert" style="text-align: center;margin-bottom: 20px; display: none;">
                                
                            </div>
                        <div>
                        
                            <div class="col-sm-12">
                                <form method="POST" id="form1">
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-3" id="input">
                                            <input type="text" class="form-control" placeholder="First Name" name="firstname" id="fname"/>
                                            <p class="fname-error"></p>
                                        </div>
                                        <div class="form-group col-md-3" id="input">
                                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lname"/>
                                            <p class="lname-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="input">
                                            <input type="text" class="form-control" placeholder="NIC Number" name="nic" id="nic"/>
                                            <p class="nic-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="who">
                                            <select class="form-control wide" name="role" id="role" onchange="roleFunc()">
                                                <option value="">Who are you?</option>
                                                <option value="buy">I'm Buyer</option>
                                                <option value="sell">I'm Seller</option>
                                            </select>
                                            <p class="role-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="input">
                                            <input type="text" class="form-control" placeholder="E-mail Address" id="email" name="email"/>
                                            <p class="email-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="input">
                                            <input type="text" class="form-control" placeholder="Division" name="address" id="address"/>
                                            <p class="addres-error"></p>
                                        </div>                                    
                                    </div>
                                    <div class="form-row justify-content-center" id="bcontent" style="display: none;">
                                        <div class="form-group col-md-3" id="input">
                                            <select class="form-control wide" name="tankSize" id="role">
                                                <option value="">Your Tank Size</option>
                                                <option value="2">2 Killo Gramms</option>
                                                <option value="5">5 Killo Gramms</option>
                                                <option value="12.5">12.5 Killo Gramms</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="who">
                                            <select class="form-control wide" name="brand" id="brandb">
                                                <option value="">What is the Brand?</option>
                                                <option value="litro">Litro Gas</option>
                                                <option value="laughfs">Laughfs Gas</option>
                                            </select>
                                            <p class="brandb-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center" style="display: none;" id="scontent-brand">
                                        <div class="form-group col-md-6" id="who">
                                            <select class="form-control wide" name="dbrand" id="brands">
                                                <option value="">What is the Brand?</option>
                                                <option value="litro">Litro Gas</option>
                                                <option value="laughfs">Laughfs Gas</option>
                                                <option value="all">All Brands</option>
                                            </select>
                                            <p class="brands-error"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center" id="scontent-com" style="display: none;">
                                    <div class="form-group col-md-6" id="input">
                                            <input type="text" class="form-control" placeholder="Company Registration Code" name="companyCode" id="ccode"/>
                                            <p class="ccode-error"></p>
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="mid" id="input">
                                            <input type="password" id="pass" class="form-control" placeholder="Password" name="password"/>
                                            <div class="icon">
                                                <ion-icon class="passopen" name="eye-outline" onclick="passopen()"></ion-icon>
                                                <ion-icon class="passclose" name="eye-off-outline" onclick="passclose()"></ion-icon>
                                            </div>
                                            <p class="password-error1"></p>
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-center">
                                        <div class="form-group col-md-6" id="mid" id="input">
                                            <input type="password" id="repass" class="form-control" placeholder="Re-enter Password" name="repass"/>
                                            <div class="icon">
                                                <ion-icon class="repassopen" name="eye-outline" onclick="repassopen()"></ion-icon>
                                                <ion-icon class="repassclose" name="eye-off-outline" onclick="repassclose()"></ion-icon>
                                            </div>
                                            <p class="repassword-error"></p>
                                        </div>
                                    </div>
                                    <div style="margin-top: 10px; margin-bottom: 20px; text-align: center;">
                                        by clicking Register button you agree to petrolium corporation conditions and <a href="#" class="conditions">LPG Smart Service Conditions.</a>
                                    </div>
                                    <div class="btn_box">
                                        <button name="register1" id="next" type="submit">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include_once "layouts/footer.html"; ?>


    <script src="styles/js/jquery-3.4.1.min.js"></script>
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

    <script src="styles/js/ajax.js"></script>
    <script src="styles/js/custom.js"></script>
    <script src="styles/js/forms.js"></script>  
</body>
</html>    
    
    
