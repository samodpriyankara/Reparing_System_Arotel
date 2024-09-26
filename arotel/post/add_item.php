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
        $part_number = htmlspecialchars($_POST['part_number']);
        $part_name = htmlspecialchars($_POST['part_name']);
        $part_location = htmlspecialchars($_POST['part_location']);
        $part_remark = htmlspecialchars($_POST['part_remark']);
        $stat = 1;

        $sql = "INSERT INTO `tbl_item`(`part_name`, `part_location`, `part_number`, `remark`, `stat`, `item_date`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $part_name, $part_location, $part_number, $part_remark, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $output['result']=true;
            $output['msg']="Part added successfully";


        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Part adding";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>