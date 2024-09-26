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
        $job_id = htmlspecialchars($_POST['job_id']);
        $labour_name = htmlspecialchars($_POST['labour_name']);
        $job_fru = htmlspecialchars($_POST['fru']);
        $fru_price = htmlspecialchars($_POST['fru_price']);
        $labour_discount = 0;

        $sql = "INSERT INTO `tbl_job_labour`(`job_id`, `job_fru`, `labour_discount`, `labour_name`, `fru_price`, `labour_datetime`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $job_id, $job_fru, $labour_discount, $labour_name, $fru_price, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {

            $output['result']=true;
            $output['msg']="Labour added successfully";

        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error adding labour";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>