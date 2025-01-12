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
        $job_type = htmlspecialchars($_POST['job_type']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $stat = 0;

        $sql = "INSERT INTO `tbl_job`(`job_type`, `user_id`, `stat`, `job_datetime`) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $job_type, $user_id, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
        
            $getLast=$conn->query("SELECT job_id FROM tbl_job ORDER BY job_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){

                $lastId=$lRs[0];
                $encodelastId=base64_encode($lastId);

                $output['result']=true;
                $output['lastId']=$encodelastId;
                $output['msg']="Job created successfully";


              }else{

                $output['result']=false;
                $output['msg']="Error Created Job. 888.";

            }

              

        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Created Job. 777.";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>