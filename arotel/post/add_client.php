<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d');
    $currentDate=date('Y-m-d H:i:s');

    $output=[];

    if($_POST)
    {
        $customer_name = htmlspecialchars($_POST['customer_name']);
        $customer_tel = htmlspecialchars($_POST['customer_tel']);
        $customer_email = htmlspecialchars($_POST['customer_email']);
        $how_to_know = htmlspecialchars($_POST['how_to_know']);
        $customer_address = htmlspecialchars($_POST['customer_address']);
        $stat = 0;

        $sql = "INSERT INTO `tbl_client`(`customer_name`, `customer_tel`, `customer_email`, `how_to_know`, `customer_address`, `stat`, `client_datetime`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $customer_name, $customer_tel, $customer_email, $how_to_know, $customer_address, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $output['result']=true;
            $output['msg']="Client register successfully";


        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Register Client.";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>