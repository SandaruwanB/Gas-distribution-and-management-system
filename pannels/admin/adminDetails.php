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
    <title>Admin Details</title>
    <style>
        a {
            text-decoration: none;
        }
        button{
            margin-left: 10px;
        }
    </style>
</head>

<body>
        <?php
            include_once "layouts/topnav.php";
            include_once "layouts/sidenavbar.php";
        ?>

   <main id="main" class="main aaccounts-view">
        <div class="pagetitle">
            <h1>Admin Accounts Control</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Admin Accounts Control</li>
                </ol>
            </nav>
        </div>
        <div class="justify-content-right">
            <button class="btn btn-sm btn-success" style="margin-left: 85%;"  id="newAdmin"><i style="font-size: 1rem;" class="bi bi-person-add"></i>&nbsp;&nbsp;Add Admin</button>
        </div>
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Admin Since</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($con, "SELECT * FROM admin_privileges WHERE adminNic = '$userNic'");
                    $row2 = mysqli_fetch_assoc($query);
                    if($row2['previlage'] == "simple"){
                        $query = mysqli_query($con, "SELECT * FROM user_details,roles,admin_privileges WHERE admin_privileges.adminNic = user_details.nic AND roles.id = user_details.roleId AND roles.name = 'admin' AND nic <> '$userNic'"); // 
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_assoc($query)){
                                if($row['previlage'] == "super"){
                                    continue;
                                }
                                else{
                                    echo '
                                    <tr>
                                        <th scope="row">'.$loop.'</th>
                                        <td>'.$row['firstName'].'  '.$row['lastName'].'</td>
                                        <td>'.$row['gmail'].'</td>
                                        <td>'.$row['nic'].'</td>
                                        <td>'.date("Y-m-d",strtotime($row['registerd'])).'</td>
                                        <td class="text-center">'.($row['status'] == 0 ? "<p style='background: #f00; color: #fff; border-radius:5px;'>Inactive</p>": "<p style=' background: #0f0;color: #fff; border-radius: 5px'>Active</p>").'</td>
                                        <td class="text-center"><button class="btn btn-sm btn-primary" value="'.$row['nic'].'" onClick="editAdmin(this.value)">Edit</button> <button class="btn btn-sm btn-danger" value="'.$row['nic'].'" id="rmAdminV" onClick="deleteAdmin(this.value)">Remove</button></td>
                                    </tr>';
                                    ++$loop;
                                }
                            }
                        }
                        else{
                            echo '<tr>
                                <td colspan="7" class="text-center">No Accounts Found</td>
                            </tr>';
                        }
                    }
                    else{
                        $loop = 1;
                        $query = mysqli_query($con, "SELECT * FROM user_details,roles,admin_privileges WHERE admin_privileges.adminNic = user_details.nic AND roles.id = user_details.roleId AND roles.name = 'admin' AND nic <> '$userNic'"); //
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_assoc($query)){
                                echo '
                                    <tr>
                                        <th scope="row">'.$loop.'</th>
                                        <td>'.$row['firstName'].'  '.$row['lastName'].'</td>
                                        <td>'.$row['gmail'].'</td>
                                        <td>'.$row['nic'].'</td>
                                        <td>'.date("Y-m-d",strtotime($row['registerd'])).'</td>
                                        <td class="text-center">'.($row['status'] == 0 ? "<p style='background: #f00; color: #fff; border-radius:5px;'>Inactive</p>": "<p style=' background: #0f0;color: #fff; border-radius: 5px'>Active</p>").'</td>
                                        <td class="text-center"><button class="btn btn-sm btn-primary" value="'.$row['nic'].'" onClick="editAdmin(this.value)">Edit</button> <button class="btn btn-sm btn-danger" value="'.$row['nic'].'" onClick="deleteAdmin(this.value)">Remove</button></td>
                                    </tr>';

                                    ++$loop;
                            }
                        }
                        else{
                            echo '<tr>
                                <td colspan="7" class="text-center">No Accounts Found</td>
                            </tr>';
                        }
                    }  

                ?>
            </tbody>
        </table>
    </main>

    <main class="main add-admin d-none" id="main">
        <div class="pagetitle">
            <h1>Add New Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="adminDetails.php">Admin Accounts Control</a></li>
                    <li class="breadcrumb-item active">Add New Admin</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add New Admin</h5>

                        <form class="row g-3 mt-5" id="addForm">
                            <div class="col-md-12 text-center admnaddAlert d-none">
                                <div class="alert alert-danger addAlert"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name" name="addfirstName" >
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="User Name" name="nic">
                            </div>

                            <?php
                                if($row2['previlage'] == "simple"){
                                    echo '
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Address" name="address">
                                    </div>
                                    ';
                                }
                                else{
                                    echo '
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Address" name="address">
                                    </div>
                                    <div class="col-md-6">
                                        <select id="inputState" class="form-select" name="previlege">
                                            <option selected>Choose Previlege</option>
                                            <option value="super">Super Admin</option>
                                            <option value="simple">Standard Admin</option>
                                        </select>
                                    </div>';
                                }

                            ?>
                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="Password" name="password" id="adadPW">
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control" placeholder="Re-Enter Password" name="repassword" id="adReadPW">
                            </div>
                            <div class="col-10" style="margin-left: 10%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" onclick="showAdPw()">
                                    <label class="form-check-label" for="gridCheck">
                                    Show Passwords
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="addAdmin" class="btn btn-primary">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="main edit-admin d-none" id="main">
        <div class="pagetitle">
            <h1>Edit Admin Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="adminDetails.php">Admin Accounts Control</a></li>
                    <li class="breadcrumb-item active">Edit Admin Details</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Admin Details</h5>
                        <div class="editdata mt-5">

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
