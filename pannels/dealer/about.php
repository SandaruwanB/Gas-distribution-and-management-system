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

    <title>About us</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/styles/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="/styles/css/font-awesome.min.css" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="styles/styles.css" rel="stylesheet" />
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

  <!-- about section -->

    <section class="about_section layout_padding mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box pr-md-2">
                        <div class="heading_container">
                            <h2 class="">
                                About Us
                            </h2>
                        </div>
                        <p class="detail_p_mt">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LPG Smart Service is simply an effort to provide a highly reliable service to the people of Sri Lanka by increasing the convenience of their gas consumption needs. By this, our aim is to increase the confidence of the customer by reducing the awkward situations in gas transportation to the customer.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Our nation-wide sales and distribution network is supported by a modern fleet of LPG tankers and storage and filling facility operated with the highest international safety standards.
                            And the priority is to provide a comfortable service with a new experience to all the stakeholders related to us by mixing with the new modern technologies in the world and being equipped with new designs .Combining the full knowledge and experience of our members with the ability to operate sustainably, responsibly, ethically and transparently will enhance our future approach.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="img-box ">
                        <img src="/src/images/bg1.jpg" class="box_img" alt="about img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about section ends -->

    <?php include_once "layouts/footer.html"; ?>
    <!-- footer section -->

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