<?php
    include_once "database/connection.php";

    session_start();
    $userNic = $_SESSION['user_id'];

    if($userNic == ""){
        header("location: /login.php");
    }

    $query = mysqli_query($con, "SELECT * FROM user_details,admin_privileges WHERE admin_privileges.adminNic = user_details.nic AND nic = '$userNic'");
    $rowuser = mysqli_fetch_assoc($query);
    $name = $rowuser['firstName'] . " " . $rowuser['lastName'];

    $loop = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="vendor/quill/quill.bubble.css">
    <link rel="stylesheet" href="vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="vendor/simple-datatables/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link rel="shortcut icon" href="/src/images/favicon.png" type="image/x-icon">
    <title>Messages</title>
    <style>
        a {
            text-decoration: none;
        }
        .btns{
            position: absolute;
            right: 2%;
            top: 50%;
        }
        .btns button{
            margin-right: 10px;
        }
    </style>
</head>

<body>
        <?php
            include_once "layouts/topnav.php";
            include_once "layouts/sidenavbar.php";
        ?>

    <main id="main" class="main allMsgs-view">
        <div class="pagetitle">
            <h1>Messages</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Messages</li>
                </ol>
            </nav>
        </div>

        <div class="container mt-5">
        <?php

            $query = mysqli_query($con,"SELECT * FROM contact_messages ORDER BY read_flag ASC");
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['read_flag'] == 1){
                        echo '
                        <div class="card notific" style="position: relative;">
                            <div class="card-body">
                                <span class="d-block" style="font-weight: bold;">'.$row['subject'].'</span>
                                <span class="d-block">'.$row['name'].'</span>
                                <span class="d-block">'.$row['date'].'</span>
                                <span class="d-block mt-1">'.$row['message'].'</span>
                            </div>
                            <div class="btns">
                                <button class="btn btn-sm btn-success" id="sComOpen" value="'.$row['id'].'" onClick="viewMessage(this.value)" title="view"><i class="bi bi-envelope-open-fill"></i></button>'.($row['read_flag'] == 1 ? '<button class="btn btn-sm btn-secondary disabled ml-3" id="sComMark" ><i class="bi bi-check2-all"></i></button>': '<button class="btn btn-sm btn-secondary ml-3" id="sComMark" value="'.$row['id'].'" onclick="messageMark(this.value)" title="Mark as Read"><i class="bi bi-check2-all"></i></button>').'<button class="btn btn-sm btn-primary ml-3" id="sComDel" value="'.$row['id'].'" onClick="replyMail(this.value)" title="Reply Mail"><i class="bi bi-reply"></i></button><button class="btn btn-sm btn-danger ml-3" id="sComDel" value="'.$row['id'].'" onClick="deleteMessage(this.value)" title="Delete"><i class="bi bi-trash3-fill"></i></button>
                            </div>
                        </div>';
                    }
                    else{
                        echo '
                        <div>
                            <div class="card notific" style="position: relative; border: 2px solid #112A6D;">
                                <div class="card-body">
                                    <span class="d-block" style="font-weight: bold;">'.$row['subject'].'</span>
                                    <span class="d-block">'.$row['name'].'</span>
                                    <span class="d-block">'.$row['date'].'</span>
                                    <span class="d-block mt-1">'.$row['message'].'</span>
                                </div>
                                <div class="btns">
                                    <button class="btn btn-sm btn-success" id="sComOpen" value="'.$row['id'].'" onClick="viewMessage(this.value)" title="view"><i class="bi bi-envelope-open-fill"></i></button>'.($row['read_flag'] == 1 ? '<button class="btn btn-sm btn-secondary disabled ml-3" id="sComMark" ><i class="bi bi-check2-all"></i></button>': '<button class="btn btn-sm btn-secondary ml-3" id="sComMark" value="'.$row['id'].'" onclick="messageMark(this.value)" title="Mark as Read"><i class="bi bi-check2-all"></i></button>').'<button class="btn btn-sm btn-primary ml-3" id="sComDel" value="'.$row['id'].'" onClick="replyMail(this.value)" title="Reply Mail"><i class="bi bi-reply"></i></button><button class="btn btn-sm btn-danger ml-3" id="sComDel" value="'.$row['id'].'" onClick="deleteMessage(this.value)" title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                </div>
                            </div>
                        </div>';
                    }
                }
            }
            else{
               echo '
                <div class="card notific">
                    <div class="card-body">
                        No Messages Available
                    </div>
                </div>';
            }
        ?>
        </div>
    </main>

    <main id="main" class="main d-none msg-view">
        <div class="pagetitle">
            <h1>Read Message</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="messages.php">Messages</a></li>
                    <li class="breadcrumb-item active">Read Message</li>
                </ol>
            </nav>
        </div>
        <div class="container w-50" id="msgBodyContent" >

        </div>
    </main>

    <main id="main" class="main d-none rply-mail">
        <div class="pagetitle">
            <h1>Send Reply Mail</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="messages.php">Messages</a></li>
                    <li class="breadcrumb-item active">Send Reply Mail</li>
                </ol>
            </nav>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form w-75">                
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <h2 class="text-center mb-5">Reply Mail</h2>
                        <div class="form mb-3">
                            <input type="email" class="form-control msg-email" id="floatingInput" placeholder="Gmail Address">
                        </div>
                        <div class="form mb-3">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Subject">
                        </div>
                        <div class="form mb-5">
                            <textarea class="form-control" placeholder="Message" id="floatingTextarea" style="height: 100px;"></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-md btn-primary" id="mailSend">Send</button>
                            <button class="btn btn-md btn-primary d-none" id="mail-loader">
                                <div class="spinner-border text-warning" role="status">                                    
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <div class="alertz hide" >
        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
        <span class="msg">Success</span>
        <span class="close-btn" id="closeAlert">
            <span><i class="fa fa-times"></i></span>
        </span>
    </div>

    <script src="vendor/apexcharts/apexcharts.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/chart.umd.js"></script>
    <script src="vendor/echarts/echarts.min.js"></script>
    <script src="vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="styles/main.js"></script>
</body>
</html>