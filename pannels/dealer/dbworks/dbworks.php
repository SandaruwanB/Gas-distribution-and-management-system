<?php
    include_once "connection.php";
    session_start();
    $userNic = $_SESSION['user_id'];
    $today = date("Y-m-d");
    $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic='$userNic'");
    $row = mysqli_fetch_assoc($query);
    $userName = $row['firstName'];


    if(isset($_POST['nic'])){
        $nic = $_POST['nic'];

        $query = mysqli_query($con, "SELECT * FROM user_details WHERE nic = '$nic'");
        if(mysqli_num_rows($query) > 0){
            $query = mysqli_query($con,"SELECT * FROM user_details,customer_gas_details WHERE customer_gas_details.userNic = user_details.nic AND user_details.nic = '$nic'");
            $row = mysqli_fetch_assoc($query);
            $lastDate = $row['boughtDate'];
            $dateDiff = dateDiff($today,$lastDate);

            if($dateDiff >= 14 || $row['boughtDate'] == null && $row['size'] < 3){
                echo ' 
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">NIC Number &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$nic.'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Name &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['firstName'].'&nbsp;'.$row['lastName'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Tank Size &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Location &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['address'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Brand &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['brand'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Last Issued Date &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.($row['boughtDate'] == null ? "Not yet Bought " : $row['boughtDate']).'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Quota &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: green;">One Tank '.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="text-align: center;"><button class="btn btn-primary" onclick="issueGas('.$nic.')">Issue Tank</button></li>
                    ';
            }
            else if($dateDiff >= 21 || $row['boughtDate'] == null && $row['size'] < 6){
                echo ' 
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">NIC Number &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$nic.'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Name &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['firstName'].'&nbsp;'.$row['lastName'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Tank Size &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Location &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['address'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Brand &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['brand'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Last Issued Date &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.($row['boughtDate'] == null ? "Not yet Bought " : $row['boughtDate']).'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Quota &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: green;">One Tank '.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="text-align: center;"><button class="btn btn-primary" onclick="issueGas('.$nic.',)">Issue Tank</button></li>
                    ';
            }
            else if($dateDiff >= 28 || $row['boughtDate'] == null && $row['size'] < 15){
                    echo ' 
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">NIC Number &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$nic.'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Name &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['firstName'].'&nbsp;'.$row['lastName'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Tank Size &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Location &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['address'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Brand &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['brand'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Last Issued Date &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.($row['boughtDate'] == null ? "Not yet Bought " : $row['boughtDate']).'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Quota &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: green;">One Tank '.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="text-align: center;"><button class="btn btn-primary" onclick="issueGas('.$nic.')">Issue Tank</button></li>
                    ';
            }     
            else{
                $avDates;
                if($row['size'] < 3){
                    $avDates = 14 - $dateDiff;
                }
                else if($row['size'] < 6){
                    $avDates = 21 - $dateDiff;
                }
                else{
                    $avDates = 28 - $dateDiff;
                }
                $inMinutes = strtotime($today.'+ '.$avDates.' days');
                $nextDate = date("Y-m-d",$inMinutes);
                echo ' 
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">NIC Number &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$nic.'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Name &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['firstName'].'&nbsp;'.$row['lastName'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Tank Size &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['size'].'kg</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Brand &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['brand'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Issued Date &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: darkblue;">'.$row['boughtDate'].'</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Quota &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: red;">No Quota Available</h6></div></li>
                    <li class="list-group-item" style="font-size: 11px; padding-left: 5%;"><div style="width: 20px; position: relative;"><i class="fa fa-hand-o-right" aria-hidden="true" style="position: absolute; top: 70%; font-size: 2rem; color: green;"></i></div><div style="margin-left: 18%;">Quota Expires on &nbsp;<h6 style="display: block; font-weight: 600; margin-left: 5%; color: red;">'.$nextDate.'</h6></div></li>
                    <li class="list-group-item" style="text-align: center;"><button class="btn btn-danger">Cannot Issue Tank</button></li>
                    ';
            }       
        }
        else{
            echo "invalid";
        }   
    }
    

    else if(isset($_POST['usernic'])){

        $user = $_POST['usernic'];
        $query = mysqli_query($con, "SELECT * FROM customer_gas_details WHERE userNic = '$user'");
        $row = mysqli_fetch_assoc($query);
        $size = $row['size'];
        $brand = $row['brand'];

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$userNic'");
        $row = mysqli_fetch_assoc($query);
        $dbrand = $row['brand'];

        if($brand == $dbrand || $dbrand == "all"){
            if($brand == "laughfs"){
                $query = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$userNic'");
                $row = mysqli_fetch_assoc($query);

                if($size < 3){
                    if($row['twoTanks'] != 0){
                        $newSize = $row['twoTanks'] - 1;
                        $query = "UPDATE laughfs_dealer_stock SET twoTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
                else if($size < 6){
                    if($row['fiveTanks'] != 0){
                        $newSize = $row['fiveTanks'] - 1;
                        $query = "UPDATE laughfs_dealer_stock SET fiveTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
                else{
                    if($row['twelveTanks'] != 0){
                        $newSize = $row['twelveTanks'] - 1;
                        $query = "UPDATE laughfs_dealer_stock SET twelveTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
            }
            else{
                $query = mysqli_query($con, "SELECT * FROM litro_dealer_stock WHERE dealernic = '$userNic'");
                $row = mysqli_fetch_assoc($query);
                if($size < 3){
                    if($row['twoTanks'] != 0){
                        $newSize = $row['twoTanks'] - 1;
                        $query = "UPDATE litro_dealer_stock SET twoTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
                else if($size < 6){
                    if($row['fiveTanks'] != 0){
                        $newSize = $row['fiveTanks'] - 1;
                        $query = "UPDATE litro_dealer_stock SET fiveTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
                else{
                    if($row['twelveTanks'] != 0){
                        $newSize = $row['twelveTanks'] - 1;
                        $query = "UPDATE litro_dealer_stock SET twelveTanks = $newSize WHERE dealernic = '$userNic';";
                        $query .= "UPDATE customer_gas_details SET boughtDate = '$today' WHERE userNic = '$user';";
                        $query .= "INSERT INTO gas_issue_history(type,size,toWhom,byWhom,date) VALUES('$brand',$size,'$user','$userNic','$today');";
                        $query .= "INSERT INTO issue_history(userNic,dealerNic,date) VALUES('$user','$userNic','$today')";
                        $success = mysqli_multi_query($con, $query);
                        if($success){
                            echo "success";
                        }
                    }
                    else{
                        echo "sizeAlloc";
                    }
                }
            }
        }
        else{
            echo $brand;
        }

    }

    else if(isset($_POST['meth'])){
        $usernic = $_POST['id'];
        $nic = trim($usernic);

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$nic'");
        $row = mysqli_fetch_assoc($query);
        $brand = $row['brand'];

        if($brand == "litro"){
            $query = mysqli_query($con, "SELECT * FROM litro_dealer_stock WHERE dealernic = '$nic'");
            if(mysqli_num_rows($query) > 0 ){
                echo "available";
            }
            else{
                echo "not";
            }
        }
        else if($brand == "laughfs"){
            $query = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$nic'");
            if(mysqli_num_rows($query) > 0 ){
                echo "available";
            }
            else{
                echo "not";
            }
        }
        else{
            $query = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock,litro_dealer_stock WHERE litro_dealer_stock.dealernic = '$nic' AND laughfs_dealer_stock.dealernic = '$nic'");
            if(mysqli_num_rows($query) > 0 ){
                echo "available";
            }
            else{
                echo "all";
            }
        }
    }

    else if(isset($_POST['gTwo'])){
        $two = $_POST['gTwo'];
        $five = $_POST['gFive'];
        $twelve = $_POST['gtwelve'];
        $nic = $_POST['userNic'];

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$nic'");
        $row = mysqli_fetch_assoc($query);
        $brand = $row['brand'];

        if($brand == "litro"){
            $query = mysqli_query($con, "INSERT INTO litro_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks) VALUES('$nic','$two','$five','$twelve')");
            if($query){
                echo "success";
            }
        }
        else{
            $query = mysqli_query($con, "INSERT INTO laughfs_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks) VALUES('$nic','$two','$five','$twelve')");
            if($query){
                echo "success";
            }
        }
    }

    else if(isset($_POST['ltwo'])){
        $ltwo = $_POST['ltwo'];
        $lfive = $_POST['lfive'];
        $ltwelve = $_POST['ltwelve'];
        $ftwo = $_POST['ftwo'];
        $ffive = $_POST['ffive'];
        $ftwelve = $_POST['ftwelve'];
        $nic = $_POST['dnic'];

        $query = "INSERT INTO laughfs_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks) VALUES('$nic',$ftwelve,$ffive,$ftwelve);";
        $query .= "INSERT INTO litro_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks) VALUES('$nic',$ltwelve,$lfive,$ltwelve)";
        $result = mysqli_multi_query($con,$query);
        if($result){
            echo "success";
        }
    }

    else if(isset($_POST['msg'])){
        session_start();
        $nic = $_SESSION['user_id'];
        $query = mysqli_query($con,"UPDATE user_details SET status = 0 WHERE nic = '$nic'");
        if($query){
            $value = session_destroy();
            if($value){
                echo "ok";
            }
        }
    }


    /*else if(isset($_POST['getmsgs'])){
        $count = 0;

        $query = mysqli_query($con,"SELECT * FROM dealer_gas_details WHERE 	dealerNic = '$userNic'");
        $row = mysqli_fetch_assoc($query);
        if ($row['brand'] == "all"){
            $query2 = mysqli_query($con,"SELECT * FROM notifications WHERE toNic = '$userNic' AND notType = 1 AND gtype = 'laughfs'");
            if(mysqli_num_rows($query2)){
                echo "ggg";
            }
            else{
                $query3 = mysqli_query($con, "SELECT * FROM laughfs_dealer_stock WHERE dealernic = '$userNic'");
                $row = mysqli_fetch_assoc($query3);
                if($row['twoTanks'] <= 3){
                    //$queryin = mysqli_query($con, "INSERT INTO notifications() VALUES()")
                    ++$count;
                }
            }
        }  
    }*/

    else if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
        $reason = $_POST['reason'];
        $message = $_POST['message'];

        if($subject == "" || $reason == "" || $message == ""){
            echo "val";
        }
        else{
            $query = mysqli_query($con, "INSERT INTO complains(comid,subject,reason,message,date) VALUES('$userNic','$subject','$reason','$message','$today')");
            if($query){
                echo "success";
            }
        }
    }

    else if(isset($_POST['changePw'])){
        $old = $_POST['oldpw'];
        $new = $_POST['newpw'];
        $rnew = $_POST['rnewpw'];
        $hashPw = password_hash($new, PASSWORD_DEFAULT);
        $verify;

        $query = mysqli_query($con,"SELECT * FROM user_details WHERE nic = '$userNic'");
        $row = mysqli_fetch_assoc($query);

        if(password_verify($old,$row['password'])){
            $verify = "ok";
        }
        else{
            $verify = "no";
        }

        if($old == "" || $new == "" || $rnew == ""){
            echo "nodata";
        }
        else if($new != $rnew){
            echo "notmatch";
        }
        else if($verify == "no"){
            echo "verifyFail";
        }
        else{
            $query = mysqli_query($con, "UPDATE user_details SET password = '$hashPw' WHERE nic = '$userNic'");
            echo "success";
        }
        
    }

    else if(isset($_POST['changeName'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        if($fname == "" || $lname == ""){
            echo "no";
        }
        else{
            $query = mysqli_query($con , "UPDATE user_details SET firstName = '$fname', lastName = '$lname' WHERE nic = '$userNic'");
            if($query){
                echo "success";
            }
        }
    }

    else if(isset($_POST['changeType'])){
        $type = $_POST['type'];
        $dId = $_POST['comid'];
        $twot = $_POST['twokg'];
        $fivet = $_POST['fivekg'];
        $twelvet = $_POST['twelve'];

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$userNic'");
        $row = mysqli_fetch_assoc($query);

        if($type == $row['brand'] || $dId == ""){
            echo "no";
        }
        else if($type != $row['brand']){
            if($row['brand'] == "all" && $dId != "" && $twot == "" && $fivet == "" && $twelvet == ""){
                if($type == "litro"){
                    $query2 = mysqli_query($con,"DELETE FROM laughfs_dealer_stock WHERE dealernic = '$userNic'");
                    $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                    echo "success";
                }
                else if($type == "laughfs"){
                    $query2 = mysqli_query($con,"DELETE FROM litro_dealer_stock WHERE dealernic = '$userNic'");
                    $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                    echo "success";
                }
            }
            else if($row['brand'] == "laughfs" && $type == "litro" && $dId != "" && $twot != "" && $fivet != "" && $twelvet != ""){
                $query2 = mysqli_query($con,"DELETE FROM laughfs_dealer_stock WHERE dealernic = '$userNic'");
                $query2 = mysqli_query($con,"INSERT INTO litro_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks)  VALUES('$userNic',$twot,$fivet,$twelvet)");
                $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                echo "success";
            }
            else if($row['brand'] == "litro" && $type == "laughfs" && $dId != "" && $twot != "" && $fivet != "" && $twelvet != ""){
                $query2 = mysqli_query($con,"DELETE FROM litro_dealer_stock WHERE dealernic = '$userNic'");
                $query2 = mysqli_query($con,"INSERT INTO laughfs_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks)  VALUES('$userNic',$twot,$fivet,$twelvet)");
                $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                echo "success";
            }
            else if($row['brand'] != "all" && $type == "all" && $dId != "" && $twot != "" && $fivet != "" && $twelvet != ""){
                if($row['brand'] == "laughfs"){
                    $query2 = mysqli_query($con,"INSERT INTO litro_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks)  VALUES('$userNic',$twot,$fivet,$twelvet)");
                    $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                    echo "success";
                }
                else{
                    $query2 = mysqli_query($con,"INSERT INTO laughfs_dealer_stock(dealernic,twoTanks,fiveTanks,twelveTanks)  VALUES('$userNic',$twot,$fivet,$twelvet)");
                    $query2 = mysqli_query($con,"UPDATE dealer_gas_details SET brand = '$type', code = '$dId' WHERE dealerNic = '$userNic'");
                    echo "success"; 
                }
            }
            else{
                echo "no";
            }
        }
    }    
    

    else if(isset($_POST['deleteAcc'])){
        $query = mysqli_query($con, "DELETE FROM user_details WHERE nic = '$userNic'");
        if($query){
            echo "success";
        }
    }

    else if(isset($_POST['dead'])){
        $value = session_destroy();
        if($value){
            echo "ok";
        }
    }

    else if(isset($_POST['changedVal'])){
        $value = $_POST['changedVal'];

        $query = mysqli_query($con, "SELECT * FROM dealer_gas_details WHERE dealerNic = '$userNic'");
        $row = mysqli_fetch_assoc($query);

        if($row['brand'] == "all" || $value == $row['brand']){
            echo "equal";
        }
        else if($value == "all" && $row['brand'] != $value){
            echo "litro";
        }
        else if($value == "litro"){
            echo "litro";
        }
        else if($value == "laughfs"){
            echo "laughfs";
        }
    }

    else if(isset($_POST['searchText'])){
        $text = $_POST['searchText'];
        $text .= "%";
        $loop = 1;
        $returnText = "";

        $query = mysqli_query($con, "SELECT * FROM user_details,issue_history,customer_gas_details WHERE customer_gas_details.userNic = issue_history.userNic AND issue_history.userNic = user_details.nic AND issue_history.dealerNic = '$userNic' AND issue_history.userNic LIKE '$text'");
        if(mysqli_num_rows($query) > 0){

            $returnText .= '<table class="table container" id="data-table2"><tbody><thead class="thead-light">
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer NIC</th>
            <th scope="col">Customer Mail</th>
            <th scope="col">Gas Tank Type</th>
            <th scope="col">Gas Tank Size</th>
            <th scope="col">Issued Date</th>';

            while($row = mysqli_fetch_assoc($query)){
                $returnText .= '<tr>
                    <td scope="row">'.$loop.'</td>
                    <td>'.$row['firstName'].' '.$row['lastName'].'</td>
                    <td>'.$row['gmail'].'</td>
                    <td>'.$row['nic'].'</td>
                    <td>'.$row['brand'].' Gas</td>
                    <td class="text-center">'.$row['size'].'Kg</td>
                    <td>'.$row['date'].'</td>
                </tr>';
            }
            $returnText .= "</tbody></table>";
            echo $returnText;
        }
        else{
            $returnText .= '<table class="table container" id="data-table2" style="margin-bottom: 20vh;"><tbody><thead class="thead-light">
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer NIC</th>
                <th scope="col">Customer Mail</th>
                <th scope="col">Gas Tank Type</th>
                <th scope="col">Gas Tank Size</th>
                <th scope="col">Issued Date</th>
            <tbody>
                <td colspan="6" class="text-center">No Records Found</td>
            </tbody>
            </table>';
            echo $returnText;
        }
    }

    else if(isset($_POST['tankCount'])){
        $tanks = $_POST['tankCount'];
        $type = $_POST['tankType'];
        $size = $_POST['tankSize'];


        $query = mysqli_query($con,"SELECT * FROM gas_requests WHERE tankType = '$type' AND tankSize = '$size' AND date = '$today' AND userNic = '$userNic'");
        if(mysqli_num_rows($query) > 0){
            echo "booked";
        }
        else{
            $query = mysqli_query($con, "INSERT INTO gas_requests(userNic,tankType,tankSize,date,lotSize) VALUES('$userNic','$type','$size','$today','$tanks')");
            echo "success";
        }
    }

    else if(isset($_POST['getNotifications'])){
        $query = mysqli_query($con, "SELECT * FROM notifications WHERE toNic = '$userNic' AND readFlag = 0");
        $count = mysqli_num_rows($query);

        echo $count;
    }

    else if(isset($_POST['markAsReadId'])){
        $notificId = $_POST['markAsReadId'];

        $query = mysqli_query($con, "UPDATE notifications SET readFlag = 1 WHERE id = $notificId");
        echo "success";
    }

    else if(isset($_POST['deleteNotificId'])){
        $notificId = $_POST['deleteNotificId'];

        $query = mysqli_query($con, "DELETE FROM notifications WHERE id = $notificId");
        echo "success";
    }

    else if(isset($_POST['notificOpenId'])){
        $notificId = $_POST['notificOpenId'];

        $query = mysqli_query($con, "UPDATE notifications SET readFlag = 1 WHERE id = $notificId");
        $query = mysqli_query($con, "SELECT * FROM notifications WHERE id = $notificId");
        $row = mysqli_fetch_assoc($query);


        echo '
            <div class="card" style="margin-bottom: 30vh;">
                <div class="card-body">
                    <h5 class="card-title">'.$row['subject'].'</h5>
                    <h6 class="card-subtitle mb-2 text-muted">'.$row['date'].'</h6>
                    <p class="card-text">'.$row['message'].'</p>
                </div>
            </div>';
    }








    function dateDiff($d1,$d2){
        $diff = strtotime($d1) - strtotime($d2);
        return abs(round($diff / 86400));
    }

