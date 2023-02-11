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

    <title>Scan QR</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/styles/css/bootstrap.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
    <link href="/styles/css/font-awesome.min.css" rel="stylesheet" />

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
  <!-- contact section -->
    <section class="contact_section layout_padding mt-5">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>QR Scanner</h2>
                <p>After Scanning QR Code You Can View Dealer Details.<br>Then You Can Take Actions (Give Tank or Not).</p>
            </div>
            <div class="alert alert-danger text-center" style="display: none;" id="QRerror" role="alert"></div>
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>
                </div>
                <div class="col-md-6" id="text" style="position: relative;">
                    <div class="card">
                        <div class="card-header" style="text-align: center;">
                            <h5 class="card-title">QR Code Details</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Scan QR Code to View Customer Details</h6>
                        </div>
                        <br>
                        <div class="card-body">
                            <h5 class="card-title" id="qrHead">Inside QR Code,</h5>

                            <p class="card-text">Customer NIC Number, Name , Last Bought Date , Quota , Gas Tanks Size and Type Included. Please Scan QR to View That Data.</p>
                            <br>
                            <div style="text-align: center;">
                                <a href="dhome.php" class="btn btn-primary" id="back-btn">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
    
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">QR Code Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-none text-center" id="issueError"></div>
                <div class="card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush" id="qrDetails">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>  
    <div class="alertz hide" >
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <span class="msg">Success</span>
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

        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0 ){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            $("#issueError").addClass("d-none");
            let nic = c;
            $.ajax({
                type: "POST",
                url: "dbworks/dbworks.php",
                data: {
                    nic: nic,
                },
                dataType: "text",
                success: function (response) {
                    var value = $.trim(response);
                    if(value == "invalid"){
                        $("#QRerror").text("Scanned QR Code is Invalid");
                        $("#QRerror").css("display", "block");
                    }
                    else{
                        $("#QRerror").text("");
                        $("#QRerror").css("display", "none");
                        $('#myModal').modal('show');
                        $("#qrDetails").html(response);
                    }                    
                }
            });
        });

        function issueGas(nic){
            $.ajax({
                type: "POST",
                url: "dbworks/dbworks.php",
                data: {
                    usernic: nic,
                },
                dataType: "text",
                success: function (response) {
                    var value = $.trim(response);

                    if(value == "sizeAlloc"){
                        $("#issueError").text("Cannot Issue Out of Stock.");
                        $("#issueError").removeClass("d-none");
                    }
                    else if(value == "success"){
                        $('#myModal').modal('hide');
                        $(".alertz").removeClass("hide");
                        $(".alertz").addClass("show");
                        setTimeout(function(){
                            $(".alertz").removeClass("show");
                            $(".alertz").addClass("hide");
                        },5000);
                    }
                    else{
                        $("#issueError").text("You don't have " + value + " Gas Tanks.");
                        $("#issueError").removeClass("d-none");
                    }
                    console.log(value);
                }
            });
        }
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