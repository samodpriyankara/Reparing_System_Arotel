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
        $job_labour_id = htmlspecialchars($_POST['job_labour_id']);

        $sql = "DELETE FROM tbl_job_labour WHERE job_labour_id='$job_labour_id'";
        if($conn->query($sql) === TRUE){

            $output['result']=true;
            $output['msg']="Labour deleted successfully";

        }else{

            $output['result']=false;
            $output['msg']="Error deleted labour";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>