<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataList = array();

if(isset($_POST['part_no'])){

    $part_no = htmlspecialchars($_POST['part_no']);

    $FullQTYTotal="";

    $getItemId=$conn->query("SELECT item_id FROM tbl_item WHERE part_number='$part_no'");
    if($giiRs=$getItemId->fetch_array()){

        $ItemId=$giiRs[0];
    
        $checkPbatch = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$ItemId'");

        while($cpRs = $checkPbatch->fetch_array()){
            $id = $cpRs[0];
            $PriceBatchQTY = $cpRs[5];
            $label = $cpRs[6];


            if($PriceBatchQTY > 0){
                $rowData = "<option value=".$id.">".$label."</option>";
                array_push($dataList, $rowData);
            }


        }
        
        
        //////////////Available QTY////////////////////
                
            $PriceBatchQtyTotal=0;
            $getPriceBatchData=$conn->query("SELECT qty FROM tbl_item_price_batch WHERE item_id='$ItemId' ");
            while($dataPriceBatch=$getPriceBatchData->fetch_array()){
                            
                /////////////////////////////////
                $PriceBatchQty=$dataPriceBatch[0];
                $PriceBatchQtyTotal += $PriceBatchQty;
                /////////////////////////////////
            }
                        
            $FullQTYTotal = $PriceBatchQtyTotal;
        ///////////////////////////////////
        
   


        $output['result'] = true;
        $output['data'] = $dataList;
        $output['FullQTYTotal']=$FullQTYTotal;


    }else{
        $output['result'] = false;
        $output['msg'] = "part verification failed.";
    }











     

}else{
    $output['result'] = false;
    $output['msg'] = "Required fields are not provided.";
}
    
mysqli_close($conn);
echo json_encode($output);


?>