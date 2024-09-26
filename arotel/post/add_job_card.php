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
        $user_id = htmlspecialchars($_POST['user_id']);
        $client_id = htmlspecialchars($_POST['client_id']);
        $customer_name = htmlspecialchars($_POST['customer_name']);
        $customer_tel = htmlspecialchars($_POST['customer_tel']);
        $customer_email = htmlspecialchars($_POST['customer_email']);
        $customer_address = htmlspecialchars($_POST['customer_address']);

        $m_imei = htmlspecialchars($_POST['m_imei']);
        $s_imei = htmlspecialchars($_POST['s_imei']);
        $make = htmlspecialchars($_POST['make']);
        $model = htmlspecialchars($_POST['model']);

        $fault_note = htmlspecialchars($_POST['fault_note']);
        $note = htmlspecialchars($_POST['note']);


          $phone="";
          if(isset($_POST['phone'])){
              $phone=htmlspecialchars($_POST['phone']);
          }
          
          $battry="";
          if(isset($_POST['battry'])){
              $battry=htmlspecialchars($_POST['battry']);
          }
          
          $charger="";
          if(isset($_POST['charger'])){
              $charger=htmlspecialchars($_POST['charger']);
          }
          
          $hfree="";
          if(isset($_POST['hfree'])){
              $hfree=htmlspecialchars($_POST['hfree']);
          }
          
          $bcover="";
          if(isset($_POST['bcover'])){
              $bcover=htmlspecialchars($_POST['bcover']);
          }
          
          $sim="";
          if(isset($_POST['sim'])){
              $sim=htmlspecialchars($_POST['sim']);
          }
          
          $msd="";
          if(isset($_POST['msd'])){
              $msd=htmlspecialchars($_POST['msd']);
          }
          
          $bhf="";
          if(isset($_POST['bhf'])){
              $bhf=htmlspecialchars($_POST['bhf']);
          }
          
          $warrenty_card="";
          if(isset($_POST['warrenty_card'])){
              $warrenty_card=htmlspecialchars($_POST['warrenty_card']);
          }
          
          $box="";
          if(isset($_POST['box'])){
              $box=htmlspecialchars($_POST['box']);
          }
          $user_name="";
          if(isset($_POST['user_name'])){
              $user_name=htmlspecialchars($_POST['user_name']);
          }

          ////////////////Fault///////////////////

          $power_fault="";
          if(isset($_POST['power_fault'])){
              $power_fault=htmlspecialchars($_POST['power_fault']);
          }

          $display_fault="";
          if(isset($_POST['display_fault'])){
              $display_fault=htmlspecialchars($_POST['display_fault']);
          }

          $keypad_fault="";
          if(isset($_POST['keypad_fault'])){
              $keypad_fault=htmlspecialchars($_POST['keypad_fault']);
          }

          $audio_fault="";
          if(isset($_POST['audio_fault'])){
              $audio_fault=htmlspecialchars($_POST['audio_fault']);
          }

          $signal_fault="";
          if(isset($_POST['signal_fault'])){
              $signal_fault=htmlspecialchars($_POST['signal_fault']);
          }

          $charging_fault="";
          if(isset($_POST['charging_fault'])){
              $charging_fault=htmlspecialchars($_POST['charging_fault']);
          }

          $functionality_fault="";
          if(isset($_POST['functionality_fault'])){
              $functionality_fault=htmlspecialchars($_POST['functionality_fault']);
          }

          $software_fault="";
          if(isset($_POST['software_fault'])){
              $software_fault=htmlspecialchars($_POST['software_fault']);
          }

          $accessory_fault="";
          if(isset($_POST['accessory_fault'])){
              $accessory_fault=htmlspecialchars($_POST['accessory_fault']);
          }

          $other_fault="";
          if(isset($_POST['other_fault'])){
              $other_fault=htmlspecialchars($_POST['other_fault']);
          }
          ///////////////End fault///////////////////

        $stat = 0;
        $pattern = '';
        $pin_code = '';

        $sql = "INSERT INTO `tbl_job_details`(`job_id`, `client_id`, `customer_name`, `customer_tel`, `customer_email`, `customer_address`, `m_imei`, `s_imei`, `make`, `model`, `fault_note`, `note`, `stat`, `pattern`, `pin_code`, `job_detail_date_time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $job_id, $client_id, $customer_name, $customer_tel, $customer_email, $customer_address, $m_imei, $s_imei, $make, $model, $fault_note, $note, $stat, $pattern, $pin_code, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
        
            $getLast=$conn->query("SELECT job_details_id FROM tbl_job_details ORDER BY job_details_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){

                $lastId=$lRs[0];
                $encodelastId=base64_encode($job_id);


                    $AddJobAccessoryFaltSql = "INSERT INTO `tbl_job_accessory_fault`(`accessory_fault_id`, `job_details_id`, `job_id`, `phone`, `battry`, `charger`, `hfree`, `bcover`, `sim`, `msd`, `bhf`, `warrenty_card`, `box`, `power_fault`, `display_fault`, `keypad_fault`, `audio_fault`, `signal_fault`, `charging_fault`, `functionality_fault`, `software_fault`, `accessory_fault`, `other_fault`)
                    VALUES (null, '$lastId', '$job_id', '$phone', '$battry', '$charger', '$hfree', '$bcover', '$sim', '$msd', '$bhf', '$warrenty_card', '$box', '$power_fault', '$display_fault', '$keypad_fault', '$audio_fault', '$signal_fault', '$charging_fault', '$functionality_fault', '$software_fault', '$accessory_fault', '$other_fault')";
                    if($conn->query($AddJobAccessoryFaltSql) === TRUE){


                      $AddTaxSql = "INSERT INTO `tbl_tax`(`tax_id`, `job_id`, `user_id`, `vat`, `discount`, `note`, `additional_price`, `datetime`, `client_id`) VALUES (null, '$job_id', '$user_id', '0', '0', null, null, '$currentDate', '$client_id')";;
                      if($conn->query($AddTaxSql) === TRUE){

                          
                            $UpdateJobStatSql = "UPDATE tbl_job SET stat='1' WHERE job_id='$job_id'";
                            if($conn->query($UpdateJobStatSql) === TRUE){
                              
                                $output['result']=true;
                                $output['lastId']=$encodelastId;
                                $output['msg']="Job created successfully";

                            }else{
                              
                                $output['result']=false;
                                $output['msg']="Error Created Job. 666.";

                            }

                        }else{
                          
                            $output['result']=false;
                            $output['msg']="Error Created Job. 777.";

                        }



                    }else{
                      
                        $output['result']=false;
                        $output['msg']="Error Created Job. 999.";

                    }



              }else{

                $output['result']=false;
                $output['msg']="Error Created Job. 888.";

            }

              

        }else{  
            // echo 'Error';   
            $output['result']=false;
            $output['msg']="Error Created Job. 000.";
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>