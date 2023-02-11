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
    $colVal = "";
    $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$nic'");
    $row = mysqli_fetch_assoc($query);
    if($row['brand'] == "all"){
        $colVal = "container-fluid";
    }
    else{
        $colVal = "container";
    }

    $limit = 12;
    $page = isset($_GET['rid']) ? $_GET['rid'] : 1 ;
    $start = ($page - 1) * $limit;
    $query2 = mysqli_query($con, "SELECT * FROM gas_requests WHERE userNic = '$nic'");
    $count = mysqli_num_rows($query2);
    $pages = ceil($count/$limit);

    $previous = $page - 1;
    $next = $page + 1;
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

    <title>Stock Manage</title>

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

  <!-- about section -->

    <section class="about_section layout_padding mt-5">
        <h1 class="text-center">My Stock</h1>
        <p class="text-center mb-5">Manage Your Stock With Smartestly With Us. Heare your Stock Details</p>
        <div class="text-center">
            <button class="modelOpen-btn" id="modelOpen">Request New Gas Lot</button>
        </div>
        <div class="<?= $colVal; ?>">
            <div class="row mt-4">
            <?php 
            if($row['brand'] == "all"){
                $query2 = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$nic'");
                $row2 = mysqli_fetch_assoc($query2);
                echo '
                <div class="col-sm-2">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                        </div>
                    </div>
                </div>';
                $query2 = mysqli_query($con,"SELECT * FROM litro_dealer_stock WHERE dealernic = '$nic'");
                $row2 = mysqli_fetch_assoc($query2);
                echo '
                    <div class="col-sm-2">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                            <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                            </div>
                        </div>
                    </div>';
            }
            else if($row['brand'] == "litro"){
                $query2 = mysqli_query($con,"SELECT * FROM litro_dealer_stock WHERE dealernic = '$nic'");
                $row2 = mysqli_fetch_assoc($query2);
                echo '
                    <div class="col-sm-4">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                            <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">Litro Details</h5>
                                <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                            </div>
                        </div>
                    </div>';
            }
            else{
                $query2 = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$nic'");
                $row2 = mysqli_fetch_assoc($query2);
                echo '
                <div class="col-sm-4">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>2kg</b> Tanks <br>'.($row2['twoTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twoTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twoTanks']."</span>").'
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>5kg</b> Tanks <br>'.($row2['fiveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['fiveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['fiveTanks']."</span>").'
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card"  style="border: solid 5px rgb(4, 10, 128);">
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold">Laughfs Details</h5>
                            <p class="card-text text-center">Available <b>12.5kg</b> Tanks <br>'.($row2['twelveTanks'] <= 3 ? "<span style='color: rgb(190, 3, 3); font-weight: bold;font-size: 1.5rem'>".$row2['twelveTanks']."</span>": "<span style='color: rgb(2, 89, 22); font-weight: bold; font-size: 1.5rem'>".$row2['twelveTanks']."</span>").'
                        </div>
                    </div>
                </div>';
            }

            ?>
            </div>
        </div>
        <div class="container" style="margin-top: 10vh;">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3 style="color: rgb(4, 10, 128); font-weight: bold;">Request History</h3>
                    <div class="form-inline justify-content-center mb-3 mt-5">
                        <input class="form-control mr-sm-2 w-25" type="date" placeholder="Search" aria-label="Search" id="searchBar">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <div id="table-show">
                <table class="table container" id="data-table">
                    <thead class="thead-light">
                        <th scope="col">#</th>
                        <th scope="col">Gas Tank Type</th>
                        <th scope="col">Tank Size</th>
                        <th scope="col">Requested Date</th>
                        <th scope="col">Requested Tank Lot Size</th>
                        <th scope="col">Admin Approvel</th>
                    </thead>
                    <tbody>
                        <?php
                            $loop = 1;
                            $query3 = mysqli_query($con,"SELECT * FROM gas_requests WHERE userNic = '$nic' ORDER BY date DESC LIMIT $start, $limit");
                            if(mysqli_num_rows($query3)>0){
                                while($row3 = mysqli_fetch_assoc($query3)){
                                    echo '<tr>
                                        <th scope="row">'.$loop.'</th>
                                        <td>'.$row3['tankType'].'</td>
                                        <td>'.$row3['tankSize'].'kg</td>
                                        <td>'.$row3['date'].'</td>
                                        <td class="text-center">'.$row3['lotSize'].'</td>
                                        <td>'.($row3['aprovel'] == 0 ? "<p style='color: rgb(190, 3, 3);'>Pending</p>": "<p style='color: rgb(2, 89, 22);'>Aproved</p>").'</td>
                                    </tr>';
                                    ++$loop;
                                }
                            }
                            else{
                                echo "
                                <tr>
                                    <td colspan='5' class='text-center'>No Data to View</td>
                                </tr>
                                ";
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation mt-5" style="margin-top: 10vh;" id="pagnition">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="mystock.php?rid=<?= $previous; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $pages; $i++){
                        echo '<li class="page-item"><a class="page-link" href="mystock.php?rid='.$i.'">'.$i.'</a></li>';
                    } 
                    ?>


                    <li class="page-item">
                        <a class="page-link" href="mystock.php?rid=<?= $next; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <div class="model d-none" id="model">
        <div class="model-bg">
            <h1 id="model-closer">+</h1>
            <h4>Request Tanks</h4>
            <div class="container mt-4">
                <div class="text-center mb-1" style="color: red; font-weight: bold;" id="errprint"></div>
                <input class="form-control form-control-md" type="number" placeholder="How Many Tanks Do You Want?" id="tankCount">
                <select class="form-control form-control-sm mt-4 w-100" id="tankType">
                    <option >Select Gas Type</option>
                    <?php 
                        if($row['brand'] == "all"){
                            echo '
                            <option value="laughfs">Laughfs</option>
                            <option value="litro">Litro</option>';
                        }
                        else if($row['brand'] == "litro"){
                            echo '<option value="litro">Litro</option>';
                        }
                        else{
                            echo '<option value="laughfs">laughfs</option>';
                        }
                    ?>

                </select>
                <select class="form-control form-control-sm mt-4 w-100" id="size">
                    <option >Select Tank Size</option>
                    <option value="2">2Kg Tanks</option>
                    <option value="5">5Kg Tanks</option>
                    <option value="12.5">12.5Kg Tanks</option>
                </select>
            </div>
            <div class="text-center" style="position: absolute;bottom: 45px;left: 35%;">
                <button class="btn btn-primary" onclick="requestLot()">Request Now</button>
            </div>
        </div>
    </div>
    <div class="alertz hide" >
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <span class="msg">Successfully Sended</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>
    <?php include_once "layouts/footer.html"; ?>
        <!-- popper js -->
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
        $("#modelOpen").click(function () { 
            $("#model").removeClass("d-none");
        });
        $("#model-closer").click(function () { 
            $("#model").addClass("d-none");            
        });
        function requestLot() { 
            var tankCount = $("#tankCount").val();
            var tankType = $("#tankType").val();
            var tankSize = $("#size").val();

            if(tankCount == "" || tankType == "" || tankSize == ""){
                $("#errprint").text("All Fields are Required");
                $("#errprint").removeClass("d-none");
            }
            else{
                $("#errprint").addClass("d-none");
                $.ajax({
                    type: "post",
                    url: "dbworks/dbworks.php",
                    data: {
                        tankCount: tankCount,
                        tankSize: tankSize,
                        tankType: tankType
                    },
                    dataType: "text",
                    success: function (response) {
                        console.log(response);
                        var res = $.trim(response);
                        if(res == 'success'){
                            $("#model").addClass("d-none");
                            $(".alertz").removeClass("hide");
                            $(".alertz").addClass("show");
                            setTimeout(function(){
                                $(".alertz").removeClass("show");
                                $(".alertz").addClass("hide");
                            },5000);
                        }
                        else{
                            $("#errprint").removeClass("d-none");
                            $("#errprint").text("You Already Requested This Lot Today");
                        }
                    }
                });
            }
        }
        $("#closeAlert").click(function () { 
            $(".alertz").removeClass("show");
            $(".alertz").addClass("hide");
        });
    </script>
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