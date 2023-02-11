<?php

    include_once "dbworks/connection.php";
    
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

    <title>Post Complain</title>

    <!-- bootstrap core css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
            <img src="/src/images/bgimage.jpg" alt="">
        </div>
        <!-- header section strats -->
        <?php include_once "layouts/navbar.php"; ?>
        <!-- end header section -->


  <!-- contact section -->
    <section class="contact_section layout_padding mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="form_container">
                        <div class="heading_container heading_center">
                            <h1 style="font-weight: bold; color : red;">Unsatified ?</h1>
                            <h2>Complaint Form</h2>
                            <p>After Submitting Your Complain, We Can Get Action For Your Problem.</p>
                        </div>

                        <form method="POST" class="" id="complainForm">
                            <div class="form-row justify-content-center">
                                <div class="form-group col-lg-8" style="width: 100%;">
                                    <div class="alert alert-danger d-none text-align-center" id="errorSpace"></div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-8">
                                    <input type="text" class="form-control" placeholder="Subject" name="subject" id="name"/>
                                </div>
                            </div>
                            <div class="form-row justify-content-center" >
                                <div class="form-group col-sm-8">
                                    <input type="text" class="form-control" placeholder="Reason" name="reason" id="email"/>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-8">
                                    <input type="text" class="message-box form-control" placeholder="Message" name="message" id="message" style="height: 150px;"/>
                                </div>
                            </div>
                            <div class="btn_box">
                                <button name="submit" id="dealerComplain" name="complainPost">
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->
    <div class="alertz hide" >
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <span class="msg">Successfully Submitted</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>

    <?php include_once "layouts/footer.html"; ?>

    <script>
        $(document).ready(function () {
            $.ajax({
                type: "post",
                url: "dbworks/dbworks.php",
                data: {
                    getNotifications: "yes"
                },
                dataType: "text",
                success: function (response) {
                    var resp = $.trim(response);
                    if(resp < 9 && resp > 0){
                        $("#nots").text(resp);
                        $("#notsd").removeClass("d-none");
                    }
                    else if(resp == 0){
                        $("#notsd").addClass("d-none");
                    }
                    else{
                        $("#nots").text("9+");
                        $("#notsd").removeClass("d-none");
                    }
                }
            });
        });
        $("#dealerComplain").click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "dbworks/dbworks.php",
                data: $("#complainForm").serialize(),
                dataType: "text",
                success: function (response) {
                    var val = $.trim(response);
                    if(val == "val"){
                        $("#errorSpace").text("All Fields Are Required.");
                        $("#errorSpace").removeClass("d-none");
                        $("#errorSpace").addClass("d-inline");
                    }
                    else{
                        $("#name").val("");
                        $("#email").val("");
                        $("#message").val("");
                        $("#errorSpace").removeClass("d-inline");
                        $("#errorSpace").addClass("d-none");
                        $(".alertz").removeClass("hide");
                            $(".alertz").addClass("show");
                            setTimeout(function(){
                                $(".alertz").removeClass("show");
                                $(".alertz").addClass("hide");
                        },5000);
                    }
                }
            });
        });
        $("#closeAlert").click(function () { 
            $(".alertz").removeClass("show");
            $(".alertz").addClass("hide");
        });

    </script>
    <!-- jQery -->
    <script src="/styles/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="/styles/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="/styles/js/custom.js"></script>
</body>

</html>