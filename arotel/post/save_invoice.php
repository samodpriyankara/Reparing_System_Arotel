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
        $labour_total = htmlspecialchars($_POST['labour_total']);
        $item_total = htmlspecialchars($_POST['item_total']);
        $sub_total = htmlspecialchars($_POST['sub_total']);
        $vat = htmlspecialchars($_POST['vat']);
        $grand_total = htmlspecialchars($_POST['grand_total']);

        $stat = 0;
        $pay = 0;

        $sql = "INSERT INTO `tbl_invoice_save`(`job_id`, `labour_total`, `item_total`, `sub_total`, `vat`, `grand_total`, `pay`, `stat`, `invoice_save_datetime`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $job_id, $labour_total, $item_total, $sub_total, $vat, $grand_total, $pay, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            
            $UpdateJobStatSql = "UPDATE tbl_job_details SET stat='1' WHERE job_id='$job_id'";
            if($conn->query($UpdateJobStatSql) === TRUE){

                $UpdateInvoiceDateTimeSql = "UPDATE tbl_tax tbt SET tbt.datetime='$currentDate' WHERE tbt.job_id='$job_id'";
                if($conn->query($UpdateInvoiceDateTimeSql) === TRUE){
                              
                    $output['result']=true;
                    $output['msg']="Invoice save successfully";

                }else{   
                    $output['result']=false;
                    $output['msg']="Error Invoice saveing. 999.";
                }


            }else{   
                $output['result']=false;
                $output['msg']="Error Invoice saveing. 888.";
            }

        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Invoice saveing. 777.";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>