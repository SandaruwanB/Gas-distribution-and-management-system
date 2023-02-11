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
    <link rel="shortcut icon" href="src/images/favicon.png" type="image/x-icon">

    <title>LPG SS Contact Us</title>

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
</head>

<body class="sub_page" onload="loader()">
    <div class="holder">
        <div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="all" style="display: none;">
        <div class="hero_area">
            <div class="hero_bg_box">
                <img src="src/images/bgimage.jpg" alt="">
            </div>
            <!-- header section strats -->
            <?php include_once "layouts/navbar.html"; ?>
            <!-- end header section -->
        </div>

    <!-- contact section -->
        <section class="contact_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mx-auto">
                        <div class="form_container">
                            <div class="heading_container heading_center">
                                <h2>Get in Touch</h2>
                            </div>
                            <form method="POST" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="email" class="form-control" placeholder="E-mail Address" id="email" name="email"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="text" class="message-box form-control" placeholder="Message" id="message" name="message" style="height: 150px;"/>
                                    </div>
                                </div>
                                <div class="btn_box">
                                    <button name="submit" id="sendMail">
                                        SEND
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 mt-5">
                        <div class="heading_container heading_center">
                            <h2>Contact Details</h2>
                            <div class="mt-4">
                                <div class="header">
                                    <div class="">
                                        <h3><i class="fa fa-envelope mr-2"></i> E-mail Address</h3>
                                        <p class="ml-7"><a href="mailto: //lpgsmartservice.org@gmail.com">lpgsmartservice.org@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="header">
                                    <div class="">
                                        <h3><i class="fa fa-phone mr-2"></i> Contact Number</h3>
                                        <p class="ml-7"><a href="tel: +94776334606">+94 77 633 4606</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="header">
                                    <div class="">
                                        <h3><i class="fa fa-address-card mr-2"></i> Address</h3>
                                        <p class="ml-7"><a href="#">NO 267, Union Place, Colombo 02, Sri Lanka.</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact section -->

        <?php include_once "layouts/footer.html"; ?>
    </div>
    <div class="alertz hide" >
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <span class="msg">Successfully Submited</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>
    <!-- jQery -->
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
    <script src="styles/js/custom.js"></script>
    <script>
        var loop;
        function loader(){
            loop = setTimeout(show, 1000);
        }
        function show(){
            document.querySelector('.holder').style.display = "none";
            document.querySelector('.all').style.display = "block";
        }

        $("#sendMail").click(function (e) { 
            e.preventDefault();
            var name = $("#name").val();
            var email = $("#email").val();
            var subject = $("#subject").val();
            var message = $("#message").val();

            $.ajax({
                type: "post",
                url: "database/others.php",
                data: {
                    adminMsg: "yes",
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                dataType: "text",
                success: function (response) {
                    var val = $.trim(response);
                    if(val == "success"){
                        $(".alertz").removeClass("hide");
                        $(".alertz").addClass("show");
                        setTimeout(function(){
                            $(".alertz").removeClass("show");
                            $(".alertz").addClass("hide");
                        },3000);
                    }
                    $("#name").val("");
                    $("#email").val("");
                    $("#subject").val("");
                    $("#message").val("");
                 }
            });
           
        });
        $("#closeAlert").click(function () { 
            $(".alertz").removeClass("show");
            $(".alertz").addClass("hide");
        });
    </script>
</body>

</html>