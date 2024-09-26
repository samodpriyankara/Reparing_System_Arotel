<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $supplier_id = htmlspecialchars($_POST['supplier_id']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $invoice_number = htmlspecialchars($_POST['invoice_number']);
        $grn_number = htmlspecialchars($_POST['grn_number']);
        $goods_received_date = htmlspecialchars($_POST['goods_received_date']);
        $note = htmlspecialchars($_POST['note']);

        $stat = 0;

        $sql = "INSERT INTO `tbl_grn_details`(`supplier_id`, `user_name`, `user_id`, `invoice_number`, `grn_number`, `goods_received_date`, `note`, `stat`, `grn_datetime`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $supplier_id, $user_name, $user_id, $invoice_number, $grn_number, $goods_received_date, $note, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
            $getLast=$conn->query("SELECT grn_detail_id FROM tbl_grn_details ORDER BY grn_detail_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){
              $lastId=$lRs[0];
              
              $sendId=base64_encode($lastId);
            }

                $output['result']="ok_";
                $output['msg']='Successfully created GRN.';
                $output['lastId']=$sendId;       

        }else{
            // echo 'Error';   

            $output['result']=false;
            $output['msg']='Something went wrong (error code Register)';
        }


    }

    mysqli_close($conn);

    echo json_encode($output);

    ?>