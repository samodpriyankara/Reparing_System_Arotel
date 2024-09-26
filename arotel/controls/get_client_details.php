<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');
    
    
    if(isset($_POST['client_id'])){
        
        $client_id=htmlspecialchars($_POST['client_id']);
        
            $customer_name="";
            $customer_tel="";
            $customer_email="";
            $customer_address="";
        $getData=$conn->query("SELECT * FROM tbl_client WHERE client_id='$client_id'");
        if($data=$getData->fetch_array()){
            
            $customer_name=$data[1];
            $customer_tel=$data[2];
            $customer_email=$data[3];
            $customer_address=$data[5];
            
        }
        
        
        $output['result']=true;
        $output['customer_name']=$customer_name;
        $output['customer_tel']=$customer_tel;
        $output['customer_email']=$customer_email;
        $output['customer_address']=$customer_address;
        
        
        
    }else{
        $output['result']=false;
        $output['msg']="Invalid request, Please try again.";
    }
    
    echo json_encode($output);
    
    
    