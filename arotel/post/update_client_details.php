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
        $client_id = htmlspecialchars($_POST['client_id']);
        $customer_name = htmlspecialchars($_POST['customer_name']);
        $customer_tel = htmlspecialchars($_POST['customer_tel']);
        $customer_email = htmlspecialchars($_POST['customer_email']);
        $customer_address = htmlspecialchars($_POST['customer_address']);

        $sql = "UPDATE tbl_client SET customer_name='$customer_name', customer_tel='$customer_tel', customer_email='$customer_email', customer_address='$customer_address' WHERE client_id='$client_id'";

        if($conn->query($sql) === TRUE){

            $output['result']=true;
            $output['msg']="Client details updated";

        }else{

            $output['result']=false;
            $output['msg']="Error update Client details";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>