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
        $user_id = htmlspecialchars($_POST['user_id']);
        $note = htmlspecialchars($_POST['note']);

        $sql = "UPDATE tbl_tax SET note='$note' WHERE job_id='$job_id'";

        if($conn->query($sql) === TRUE){

            $output['result']=true;
            $output['msg']="VAT added successfully";

        }else{

            $output['result']=false;
            $output['msg']="Error adding VAT";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>