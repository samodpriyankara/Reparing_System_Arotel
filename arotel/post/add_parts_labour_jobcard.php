<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    //$currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataArray = array();

    if($_POST)
    {
      
        
        $data = $_POST['list'];
        
        
        $job_id = $_POST['job_id'];
        $user_id = $_POST['user_id'];
        $labour_id = $_POST['labour_id'];
        // $price_batch_id = $_POST['price_batch_id'];
       
        
        
        
        $part_discount = 0;
        $stat = 0;
        // $qty = 1;
      
        $list = json_decode($data,false);

        foreach($list as $item) { 
            
            $partCode = $item->part;
            $partqty = $item->qty;
            $price_batch_id = $item->batch;
            $remark = $item->remark; 
            
      
            //////////////////////save data/////////
            
            $getItemId=$conn->query("SELECT item_id FROM tbl_item WHERE part_number='$partCode'");
            if($giiRs=$getItemId->fetch_array()){

              $ItemId=$giiRs[0];
              
              
                //////////////////////////

                    $check = $conn->query("SELECT * FROM tbl_job_item WHERE labour_id = '$labour_id' AND stat = '$price_batch_id'");
                    if($crs = $check->fetch_array()){
                        
                        $output['result'] = false;
                        $output['msg'] = 'Already exists.';
                
                    }else{
                    

                        //////////////////////
                        $checkQty = $conn->query("SELECT qty,selling_price FROM tbl_item_price_batch WHERE item_id = '$ItemId' AND price_batch_id = '$price_batch_id' ");
                        if($cqrs = $checkQty->fetch_array()){
                            $PartBatchQuantity=$cqrs[0];
                            $PartBatchSelling=$cqrs[1];
                            
                            if ($PartBatchQuantity>=$partqty) {


                                $sql = "INSERT INTO `tbl_job_item`(`job_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `part_discount`, `stat`, `price`) VALUES (?,?,?,?,?,?,?,?,?)";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, "sssssssss", $job_id, $user_id, $labour_id, $ItemId, $partqty, $remark, $part_discount, $price_batch_id, $PartBatchSelling);
                                $result = mysqli_stmt_execute($stmt);
                                if($result)
                                {
                        
                                    // echo 'Completed';
                        
                                         $sql = "UPDATE tbl_item_price_batch SET `qty`= qty - '$partqty' WHERE item_id= '$ItemId' AND price_batch_id = '$price_batch_id' ";
                                        if ($conn->query($sql) === TRUE) {
                                          // echo "Record updated successfully";
                        
                                          $output['result'] = true;
                                          $output['msg'] = 'Successfully added';
                        
                        
                                        }else {
                                          // echo "Error updating record: " . $conn->error;
                        
                                          $output['result'] = false;
                                          $output['msg'] = 'Error stock updated';
                        
                        
                                        }
                        
                        
                        
                                    }else{  
                        
                                        $output['result'] = false;
                                        $output['msg'] = 'Error';
                        
                                        // echo 'Error';   
                                    }
                               
                            }else{

                                $output['result'] = false;
                                $output['msg'] = 'Please add the item first.';

                            }



                    
                        }
                        //////////////////////////////////
                        
                    }
                        
                        


              
              
              ///////////////////////////////
              
            }else{
                $output['result'] = false;
                $output['msg'] = 'Error 911';
            }
            
            
  
            
            ///////////////////////////////////
  
           
        }
                

       

    }else{
        $output['result'] = false;
        $output['msg'] = "ERR";
    }

    mysqli_close($conn);

    echo json_encode($output);

?>