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
        $vat = htmlspecialchars($_POST['vat']);

        $sql = "UPDATE tbl_tax SET vat='$vat' WHERE job_id='$job_id'";

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