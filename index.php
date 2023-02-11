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

    <title>LPG Smart Service</title>

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
<body style="background: #FFFAFA;" onload="loader()">
    <div class="holder">
        <div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="all" style="display: none;">
        <div class="hero_area">
            <div class="hero_bg_box" id="main-bg-img">
                <img src="/src/images/bgimage.jpg" alt="" >
            </div>
            <!-- header section strats -->
            <?php include_once "layouts/navbar.html" ?>
            <!-- end header section -->
            <!-- slider section -->

            <div id="slide">
            <section class="slider_section" id="slider-mid">
                <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-lg-8 col-md-11 mx-auto align-text-top">
                                        <div class="detail-box">
                                            <h1>
                                                Online Order <br>
                                                LP Gas
                                            </h1>
                                            <p>
                                                First give your information and register and then book the respective order station to buy gas.
                                            </p>
                                            <div class="btn-box">
                                                <a href="" class="btn1">
                                                    Contact Us
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10 col-md-11 mx-auto">
                                        <div class="detail-box">
                                            <h1>                                            
                                                Search Dealer <br>
                                                Anywhere
                                            </h1>
                                            <p>
                                                Check the required customer service station and check gas availability.    
                                            </p>
                                            <div class="btn-box">
                                                <a href="" class="btn1">
                                                    Check Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-lg-10 col-md-11 mx-auto">
                                        <div class="detail-box">
                                            <h1>
                                                Scan QR <br>
                                                and Buy Gas
                                            </h1>
                                            <p>
                                                Obtaining gas related to the order by scanning the QR code received by the customer through registration.
                                            </p>
                                            <div class="btn-box">
                                                <a href="" class="btn1">
                                                    Contact Us
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_btn-box">
                        <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>
            </div>
        </div>

        <section class="about_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-box pr-md-2">
                            <div class="heading_container">
                                <h2 class="">
                                    Who we are?
                                </h2>
                            </div>
                            <p class="detail_p_mt">
                                LPG Smart Service is simply an effort to provide a highly reliable service to the people of Sri Lanka by increasing the convenience of their gas consumption needs. By this, our aim is to increase the confidence of the customer by reducing the awkward situations in gas transportation to the customer.
                            </p>
                            <a href="/about.php" class="">
                                Read More
                            </a>
                        </div>
                    </div>
                <div class="col-md-6 ">
                    <div class="img-box ">
                        <img src="/src/images/bg1.jpg" class="box_img" alt="about img">
                    </div>
                </div>
            </div>
        </section>


        <section class="service_section layout_padding-bottom">
            <div class="container-fluid">
                <div class="heading_container heading_center ">
                    <h2 class="">
                        Our Service
                    </h2>
                    <p class="col-lg-8 px-0">
                        The service is provided to the customer to obtain domestic gas in a safe and efficient manner in connection with the LPG smart service. And this also provides an opportunity to express the opinions of the customer in this regard.
                    </p>
                </div>
                <div class="service_container">
                    <div class="carousel-wrap ">
                        <div class="service_owl-carousel owl-carousel">
                            <div class="item">
                                <div class="box">
                                    <div class="img-box">
                                        <img src="/src/images/s1.png" alt="" />
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            Electrical Repairs
                                        </h5>
                                        <p>
                                            Repellat perspiciatis sint in minus! Quaerat numquam nobis expedita debitis aut optio omnis voluptas quos voluptatem possimus reprehenderit repellendus mollitia.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <div class="item">
                            <div class="box ">
                                <div class="img-box">
                                    <img src="/src/images/s2.png" alt="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Equipment Installation
                                    </h5>
                                    <p>
                                        Repellat perspiciatis sint in minus! Quaerat numquam nobis expedita debitis aut optio omnis voluptas quos voluptatem possimus reprehenderit repellendus mollitia.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box ">
                                <div class="img-box">
                                    <img src="src/images/s4.png" alt="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Electrical Security
                                    </h5>
                                    <p>
                                        Repellat perspiciatis sint in minus! Quaerat numquam nobis expedita debitis aut optio omnis voluptas quos voluptatem possimus reprehenderit repellendus mollitia.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box ">
                                <div class="img-box">
                                    <img src="src/images/s5.png" alt="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Lighting
                                    </h5>
                                    <p>
                                        Repellat perspiciatis sint in minus! Quaerat numquam nobis expedita debitis aut optio omnis voluptas quos voluptatem possimus reprehenderit repellendus mollitia.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">
                    Read More
                </a>
            </div>
        </section>


        <section class="why_us_section layout_padding">
            <div class="why_bg_box">

            </div>
            <div class="why_us_container">
                <div class="container">
                    <div class="heading_container heading_center">
                        <h2>
                            Our Expansion
                        </h2>
                        <p>
                            Extending services related to our mission
                        </p>
                    </div>
                </div>
            </div>        
            <div class="box_container">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="box">
                            <div class="num-box">
                                <span id="countDay" class="count">
                                    1472
                                </span>
                            </div>
                            <h5>
                                Litro Dealers
                            </h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="box">
                            <div class="num-box">
                                <span id="countHour" class="count">
                                    1025
                                </span>
                            </div>
                            <h5>
                                Laughfs Dealers
                            </h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="box">
                            <div class="num-box">
                                <span id="countMin" class="count">
                                    1200
                                </span>
                            </div>
                            <h5>
                                Satisfied Clients
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="btn-box ">
                    <a href="/about.php">
                        Read More
                    </a>
                </div>
            </div>
        </section>


        <section class="client_section layout_padding">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Testimonial
                    </h2>
                    <hr>
                </div>
                <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-7 col-md-9 mx-auto">
                                    <div class="client_container ">
                                        <div class="detail-box">
                                            <p>
                                                Editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by
                                            </p>
                                            <span>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="client_id">
                                            <div class="img-box">
                                                <img src="src/images/sira.jpg" alt="">
                                            </div>
                                            <div class="client_name">
                                                <h5>
                                                    Ehantha Sirisena
                                                </h5>
                                                <h6>
                                                    Engineer
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-9 mx-auto">
                                    <div class="client_container ">
                                        <div class="detail-box">
                                            <p>
                                                Editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by
                                            </p>
                                            <span>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="client_id">
                                            <div class="img-box">
                                                <img src="/src/images/sira 2.jpg" alt="">
                                            </div>
                                            <div class="client_name">
                                                <h5>
                                                    Teshan Wijeweera
                                                </h5>
                                                <h6>
                                                    Business Co-Ordinate
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-9 mx-auto">
                                    <div class="client_container ">
                                        <div class="detail-box">
                                            <p>
                                                Editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by
                                            </p>
                                            <span>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="client_id">
                                            <div class="img-box">
                                                <img src="src/images/sira 3.png" alt="">
                                            </div>
                                            <div class="client_name">
                                                <h5>
                                                    Nishantha Gunapala
                                                </h5>
                                                <h6>
                                                    Manager
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_btn-box">
                        <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
                            <span>
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
                            <span>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once "layouts/footer.html";  ?>
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        var loop;
        function loader(){
            loop = setTimeout(show, 3000);
        }
        function show(){
            document.querySelector('.holder').style.display = "none";
            document.querySelector('.all').style.display = "block";
        }
    </script>
</body>

</html>