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

    $limit = 12;
    $page = isset($_GET['pid']) ? $_GET['pid'] : 1 ;
    $start = ($page - 1) * $limit;
    $query2 = mysqli_query($con, "SELECT * FROM issue_history WHERE dealerNic = '$nic'");
    $count = mysqli_num_rows($query2);
    $pages = ceil($count/$limit);

    $previous = $page - 1;
    $next = $page + 1;

    $query = mysqli_query($con, "SELECT * FROM user_details,issue_history,customer_gas_details WHERE customer_gas_details.userNic = issue_history.userNic AND issue_history.userNic = user_details.nic AND issue_history.dealerNic = '$nic' ORDER BY issue_history.date DESC LIMIT $start,$limit");
    $data = mysqli_fetch_all($query);
    

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

    <title>Sales History</title>

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
            <form class="form-inline  justify-content-center mt-1 mb-5">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchBar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <div class="container mt-2 mb-3">
                <h5>Page No. <?= $page; ?></h5>
            </div>
            <div id="table-show">
                <table class="table container" id="data-table">
                    <thead class="thead-light">
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer NIC</th>
                        <th scope="col">Customer Mail</th>
                        <th scope="col">Gas Tank Type</th>
                        <th scope="col">Gas Tank Size</th>
                        <th scope="col">Issued Date</th>
                    </thead>
                    <tbody>
                        <?php
                            $loop = 1;
                            if(count($data) <= 0){
                                echo "<tr>
                                    <td colspan='6' class='text-center'>No Data to View</td>
                                </tr>";
                            }
                            foreach($data as $d){
                                echo '
                                    <tr>
                                <th scope="row">'.$loop.'</th>
                                <td>'.$d[1].' '.$d[2].'</td>
                                <td>'.$d[0].'</td>
                                <td>'.$d[3].'</td>
                                <td>'.$d[15].' Gas</td>
                                <td class="text-center">'.$d[14].'Kg</td>
                                <td>'.$d[16].'</td>
                                </tr>';
                                ++$loop;
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation mt-5" style="margin-top: 10vh;" id="pagnition">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="history.php?pid=<?= $previous; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $pages; $i++){
                        echo '<li class="page-item"><a class="page-link" href="history.php?pid='.$i.'">'.$i.'</a></li>';
                    } 
                    ?>


                    <li class="page-item">
                        <a class="page-link" href="history.php?pid=<?= $next; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
    <?php include_once "layouts/footer.html";  ?>

    <script>
        $(document).ready(function () {
            $("#searchBar").keyup(function (e) { 
                var data = $(this).val();
                if(data != ""){
                    $("#data-table").addClass("d-none");
                    $("#pagnition").addClass("d-none");
                    $.ajax({
                        type: "post",
                        url: "dbworks/dbworks.php",
                        data: {
                            searchText: data
                        },
                        dataType: "text",
                        success: function (response) {
                            $("#table-show").html(response);
                            console.log(response);
                        }

                    });
                }
                else{
                    $("#data-table2").addClass("d-none");
                    $("#data-table").removeClass("d-none");
                    $("#pagnition").removeClass("d-none");
                }
            });
        });
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

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>