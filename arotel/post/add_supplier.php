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
        $supplier_name = htmlspecialchars($_POST['supplier_name']);
        $supplier_company_name = htmlspecialchars($_POST['supplier_company_name']);
        $phone_no = htmlspecialchars($_POST['phone_no']);
        $email = htmlspecialchars($_POST['email']);
        $address = htmlspecialchars($_POST['address']);
        $stat = 0;

        $sql = "INSERT INTO `tbl_supplier`(`supplier_name`, `supplier_company_name`, `address`, `phone_no`, `email`, `stat`, `supplier_datetime`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $supplier_name, $supplier_company_name, $address, $phone_no, $email, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $output['result']=true;
            $output['msg']="Supplier registed successfully";


        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Supplier adding";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>