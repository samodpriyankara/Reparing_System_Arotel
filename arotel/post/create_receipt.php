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
        $invoice_save_id = htmlspecialchars($_POST['invoice_save_id']);
        $job_id = htmlspecialchars($_POST['job_id']);
        $price = htmlspecialchars($_POST['price']);
        $pay_type = htmlspecialchars($_POST['pay_type']);
        $note = htmlspecialchars($_POST['note']);

        $stat = 1;

        $sql = "INSERT INTO `tbl_receipt`(`invoice_save_id`, `job_id`, `price`, `payment_method`, `note`, `datetime`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $invoice_save_id, $job_id, $price, $pay_type, $note, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {

            if ($pay_type=='Credit') {

                $sql = "UPDATE tbl_invoice_save SET `stat`='$stat', `pay`='2' WHERE invoice_save_id= '$invoice_save_id' ";

                    if ($conn->query($sql) === TRUE) {

                        $output['result'] = true;
                        $output['msg'] = 'credit';
                        // $output['invoice'] = base64_encode($invoice_id);

 
                    } else {
                        $output['result'] = false;
                        $output['msg'] = 'credit failed';
                        
                    }


            }else{

                $sql = "UPDATE tbl_invoice_save SET `stat`='$stat', `pay`='1' WHERE invoice_save_id= '$invoice_save_id' ";

                    if ($conn->query($sql) === TRUE) {

                        $output['result'] = true;
                        $output['msg'] = 'cash';
                        // $output['invoice'] = base64_encode($invoice_id);

                    } else {
                        $output['result'] = false;
                        $output['msg'] = 'cash failed';
                    }


            }



        }else{  
            $output['result'] = false;
            $output['msg'] = 'Something went wrong';   
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>