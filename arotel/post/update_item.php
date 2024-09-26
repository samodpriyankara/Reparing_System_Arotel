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
        $item_id = htmlspecialchars($_POST['item_id']);
        $part_name = htmlspecialchars($_POST['part_name']);
        $part_number = htmlspecialchars($_POST['part_number']);
        $part_location = htmlspecialchars($_POST['part_location']);
        $part_remark = htmlspecialchars($_POST['part_remark']);

        $sql = "UPDATE tbl_item SET part_name='$part_name', part_number='$part_number', part_location='$part_location', remark='$part_remark' WHERE item_id='$item_id'";

        if($conn->query($sql) === TRUE){

            $output['result']=true;
            $output['msg']="Item details updated";

        }else{

            $output['result']=false;
            $output['msg']="Error update Item details";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>