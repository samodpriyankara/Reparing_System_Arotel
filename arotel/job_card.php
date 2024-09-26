<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $JobId = base64_decode($_GET['p']);

    $user_id='';
    $user_name='';
    $user_email='';
    $user_role='';

    if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true) 
    {

      $user_email = $_SESSION["email"];

      $getEmpQuery=$conn->query("SELECT user_id,name,email,role FROM users_login WHERE email='$user_email' ");
      while ($emp=$getEmpQuery->fetch_array()) {

        $user_id = $emp['0']; 
        $user_name = $emp['1']; 
        $user_email = $emp['2']; 
        $user_role = $emp['3']; 

      }
      
    }

    else
    {
        ?>

            <script type="text/javascript">
                window.location.href="login";
            </script>

        <?php
    }
?>
<?php 

    $sql = "SELECT * FROM tbl_job_details WHERE job_id= '$JobId' ";
    $rs=$conn->query($sql);
    if($row =$rs->fetch_array())
    {
        $JobDetailId=$row[0];
        $JobId=$row[1];
        $ClientId=$row[2];
        $CustomerName=$row[3];
        $CustomerTel=$row[4];
        $CustomerEmail=$row[5];
        $CustomerAddress=$row[6];

        $MIMEI=$row[7];
        $SIMEI=$row[8];
        $Make=$row[9];
        $Model=$row[10];
        $FaultNote=$row[11];
        $Note=$row[12];
        $Stat=$row[13];
        $Pattern=$row[14];
        $PinCode=$row[15];
        $JobDateTime=$row[16];

        $JobYear = date('Y', strtotime($JobDateTime));
    }
?>
<?php 

    $sql = "SELECT * FROM tbl_job_accessory_fault WHERE job_id='$JobId' ";
    $rs=$conn->query($sql);
    if($row =$rs->fetch_array())
    {
        $Phone=$row[3];
        $Battry=$row[4];
        $Charger=$row[5];
        $HFree=$row[6];
        $BCover=$row[7];
        $Sim=$row[8];
        $MSD=$row[9];
        $BHF=$row[10];
        $WarrentyCard=$row[11];
        $Box=$row[12];
        $PowerFault=$row[13];
        $DisplayFault=$row[14];
        $KeypadFault=$row[15];
        $AudioFault=$row[16];
        $SignalFault=$row[17];
        $ChargingFault=$row[18];
        $FunctionalityFault=$row[19];
        $SoftwareFault=$row[20];
        $AccessoryFault=$row[21];
        $OtherFault=$row[22];

        
    }
?>

<?php 

    // $sql = "SELECT * FROM tbl_labour_paying ORDER BY labour_paying_id DESC LIMIT 1";
    // $fruAmount=$conn->query($sql);
    //     while($Fru =$fruAmount->fetch_array())
    //     {
            
    //         $fru_points=$Fru[1];
    //         $fru_pay=$Fru[2];
            
    //     }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('controls/meta.php'); ?>
    </head>

    <body>

        <!-- Top Bar Start -->
        <?php include_once('controls/top_nav.php'); ?>
        <!-- Top Bar End -->

        <div class="page-wrapper-img">
            <div class="page-wrapper-img-inner">
                <?php include_once('controls/top_nav_user_details.php'); ?>
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right align-item-center mt-2">
                                <button onclick="location.href='new_job'" class="btn btn-info px-4 align-self-center report-btn">Create New Job</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>Job Card</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Jobs</a></li>
                                    <li class="breadcrumb-item active">Job Card</li>
                                </ol>
                            </div>                                      
                        </div><!--end page title box-->
                    </div><!--end col-->
                </div><!--end row-->
                <!-- end page title end breadcrumb -->
            </div><!--end page-wrapper-img-inner-->
        </div><!--end page-wrapper-img-->
        
        <div class="page-wrapper">
            <div class="page-wrapper-inner">

                <!-- Left Sidenav -->
                <?php include_once('controls/side_nav.php'); ?>
                <!-- end left-sidenav-->

                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid"> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="mt-0 header-title">Job Card</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4" style="padding-left:0;">
                                                    <h3 class="m-b-md m-t-xxs"><b><?php echo $CustomerName; ?></b></h3>
                                                    <address>
                                                        E: <?php echo $CustomerEmail; ?><br>
                                                        P: <?php echo $CustomerTel; ?>
                                                    </address>
                                                </div>
                                                <div class="col-md-8 text-right" id="com-details" style="padding-right:0;">
                                                    <img src="assets/logo-black.png" id="logo-img" style="width: 20%;"><br>
                                                    <address>
                                                        <h3>AMAZOFT (Pvt) Ltd</h3><br>
                                                        <b>
                                                            Job No : AMAZOFT/JOB/<?php echo $JobYear; ?>/<?php echo (10000+$JobId); ?>
                                                        </b><br>
                                                        No 103, St anthonys mw, Colombo 03<br>
                                                        info@amazoft.com<br>
                                                        www.amazoft.com
                                                    </address>
                                                    <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-outline-info waves-effect waves-light"><i class="fa fa-print"></i> Print</button>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <style>
                                            .colorchange{
                                                color: #000 !important;
                                            }
                                            .result{
                                                color: #FF0000 !important;
                                            }
                                            .table-bordered {
                                                border: 1px solid #000 !important;
                                            }
                                        </style>

                                        <div class="col-md-12" id="vehicle-details">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="colorchange" style="font-weight: 600;">M_IMEI Number</th>
                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $MIMEI; ?></th>
                                                            <th class="colorchange" style="font-weight: 600;">S_IMEI Number</th>
                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $SIMEI; ?></th>
                                                            <th class="colorchange" style="font-weight: 600;">In Date Time</th>
                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $JobDateTime; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="colorchange" style="font-weight: 600;">Make & Model</th>
                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $Make.' - '.$Model; ?></th>
                                                            <th class="colorchange" style="font-weight: 600;">Model</th>
                                                            <th class="colorchange result" style="font-weight: 600;"></th>
                                                            <th class="colorchange" style="font-weight: 600;">Out Date Time</th>
                                                            <th class="colorchange result" style="font-weight: 600;"></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 table-responsive">
                                            <label>Accessory Received</label>
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <th>Battry</th>
                                                        <th>Charger</th>
                                                        <th>H-Free</th>
                                                        <th>B.Cover</th>
                                                        <th>Sim</th>
                                                        <th>M-SD</th>
                                                        <th>Blue Tooth H/F</th>
                                                        <th>Warrenty Card</th>
                                                        <th>Box</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $Phone; ?></td>
                                                        <td><?php echo $Battry; ?></td>
                                                        <td><?php echo $Charger; ?></td>
                                                        <td><?php echo $HFree; ?></td>
                                                        <td><?php echo $BCover; ?></td>
                                                        <td><?php echo $Sim; ?></td>
                                                        <td><?php echo $MSD; ?></td>
                                                        <td><?php echo $BHF; ?></td>
                                                        <td><?php echo $WarrentyCard; ?></td>
                                                        <td><?php echo $Box; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12 table-responsive"><br>
                                            <label>Fault Category</label>
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Power Fault</th>
                                                        <th>Display Fault</th>
                                                        <th>Keypad Fault</th>
                                                        <th>Audio Fault</th>
                                                        <th>Signal Fault</th>
                                                        <th>Charging Fault</th>
                                                        <th>Functionality Fault</th>
                                                        <th>Software Fault</th>
                                                        <th>Accessory Fault</th>
                                                        <th>Other Fault</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $PowerFault; ?></td>
                                                        <td><?php echo $DisplayFault; ?></td>
                                                        <td><?php echo $KeypadFault; ?></td>
                                                        <td><?php echo $AudioFault; ?></td>
                                                        <td><?php echo $SignalFault; ?></td>
                                                        <td><?php echo $ChargingFault; ?></td>
                                                        <td><?php echo $FunctionalityFault; ?></td>
                                                        <td><?php echo $SoftwareFault; ?></td>
                                                        <td><?php echo $AccessoryFault; ?></td>
                                                        <td><?php echo $OtherFault; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><br>
                                            <label>Description of Fault</label>
                                            <p><?php echo $FaultNote; ?></p>
                                        </div>


                                        <div class="col-md-12">
                                            <hr>         
                                            <button type="button" id="add-labour-button" class="btn btn-primary btn-round waves-effect waves-light" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>
                                            <br><br>
                                        </div>



                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" style="text-align: center;">Labour</th>
                                                            <th colspan="1" style="text-align: center;">Qty</th>
                                                            <th colspan="1" style="text-align: center;">FRU</th>
                                                            <th colspan="1" style="text-align: center;">Discount</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                                
                                                    <tbody>

                                                        <?php 
                                                            $LabourSql = "SELECT * FROM tbl_job_labour WHERE job_id= '$JobId' ORDER BY job_labour_id ASC";
                                                            $total_job_fru_paybel=0;
                                                            $Lrs=$conn->query($LabourSql);
                                                            
                                                                while($Lrow =$Lrs->fetch_array())
                                                                {
                                                                    $job_labour_id = $Lrow[0];
                                                                    $job_fru=$Lrow[2];
                                                                    $labour_discount=$Lrow[3];
                                                                    $labour_name=$Lrow[4];
                                                                    $fru_pay=$Lrow[5];
                                                                    $labour_datetime=$Lrow[6];

                                                                    //////////////////////////////////////
                                                                    $job_fru_paybel = $job_fru * $fru_pay;

                                                                    $discountLabourAmount = ((double)$job_fru_paybel * (double)$labour_discount) / 100;
                                                                    $totalLabourPriceWithDisc = (double)$job_fru_paybel - (double)$discountLabourAmount;

                                                                    // $job_fru_disocunt_paybel = (double)$job_fru_paybel - (double)$totalLabourPriceWithDisc;

                                                                                    
                                                                    $total_job_fru_paybel += $totalLabourPriceWithDisc;

                                                                    //////////////////////////////////////
                                                                                
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">
                                                                <b><?php echo $labour_name; ?></b>
                                                                <?php 
                                                                    $cRs = $conn->query("SELECT count(*) FROM `tbl_job_item` WHERE `labour_id` ='$job_labour_id'");
                                                                    if($r = $cRs->fetch_array()){
                                                                        $count = $r[0];
                                                                    }
                                                                ?>
                                                                <?php if($count > 0){ }else{ ?>
                                                                    <form id="Delete-Labour" method="POST">
                                                                        <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                        <button type="submit" class="btn btn-danger waves-effect waves-light" id="btn-delete" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                    </form>
                                                                <?php } ?>
                                                                    <button type="submit" class="btn btn-info waves-effect waves-light partlistbtn" onclick="showModal('<?php echo $job_labour_id;?>')" style="margin-right: 5px; float: right;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Parts</button>
                                                            </td>
                                                            <td colspan="1"></td>
                                                            <td colspan="1"><b><?php echo $job_fru; ?></b></td>
                                                            <td colspan="1" style="width: 150px;">
                                                                <b><?php echo $labour_discount; ?>%</b>
                                                                <button class="btn btn-secondary waves-effect waves-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_labour_discount_<?php echo $job_labour_id; ?>"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </button>
                                                            </td>
                                                        </tr>

                                                            <!-- Add Labour Discount -->
                                                            <div class="modal fade" id="genarate_labour_discount_<?php echo $job_labour_id; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo $labour_name; ?> Discount</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                                
                                                                    <form id="Add-Labour-Discount" method="POST">
                                                                        <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                        <div class="panel-body">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="3">Discount % <font style="color: #FF0000;">*</font></label>
                                                                                    <input type="number" class="form-control" name="labour_discount" min="0" max="100" id="labour_discount" value="<?php echo $labour_discount; ?>" placeholder="Discount %" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <center>
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-labour-discount">Add Discount</button>
                                                                        </center>
                                                                                            
                                                                                        
                                                                    </form>

                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>

                                                                        <?php 
                                                                            $JobPartssql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($JobPartssql);
                                                                            $total_part_price=0;
                                                                            while($rowitem =$rsitem->fetch_array())
                                                                            {

                                                                                    $rowIndex = $rowitem[0];
                                                                                    $itemuserId = $rowitem[2];
                                                                                    $labourId = $rowitem[3];
                                                                                    $itemId = $rowitem[4];
                                                                                    $qty = $rowitem[5];
                                                                                    $Part_discount = $rowitem[7];
                                                                                    $ItemStat = $rowitem[8];
                                                                                    $Item_price = (double)$rowitem[9];

                                                                                    $part_name=$rowitem[12];

                                                                                    /////////////Item Count/////////////////
                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;
                                                                                    //////////////////////////////
                                                                                
                                                                                
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="2" style="text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                             
                                                                                <td colspan="1" style="width: 200px;">
                                                                                    <button class="btn btn-danger waves-effect waves-light plusminus" onclick="minusOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                                                    <span id="qty-label-<?php echo $rowIndex;?>" style="font-size: 20px; padding-left: 15px; padding-right: 15px; ">
                                                                                        <?php echo $qty; ?>
                                                                                    </span>
                                                                                    <button class="btn btn-success waves-effect waves-light plusminus" onclick="addOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-plus" aria-hidden="true"></i> </button>

                                                                                    <br><a style="font-size: 10px; cursor: pointer;" id="part-qty-change-click" data-toggle="modal" data-target="#change_qty<?php echo $rowIndex; ?>">
                                                                                            Click here to type quantity
                                                                                    </a>
                                                                                </td>
                                                                                
                                                                                <td colspan="1"></td>
                                                                                <td colspan="1" style="width: 150px;">
                                                                                    <b><?php echo $Part_discount; ?>%</b>
                                                                                    <button class="btn btn-secondary waves-effect waves-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_part_discount_<?php echo $rowIndex; ?>"> <i class="fa fa-pencil-alt" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Change Parts Qty by Clicking -->
                                                                            <div class="modal fade" data-backdrop='static' data-keyboard='false' id="change_qty<?php echo $rowIndex; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Change <?php echo $part_name; ?> Quantity</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    
                                                                                    <form id="Add-Part-Qty-By-Clicking" method="POST">
                                                                                            <input type="hidden" class="form-control" name="job_part_id" id="job_part_id" value="<?php echo $rowIndex; ?>" required>
                                                                                            <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $itemId; ?>" required>
                                                                                            <input type="hidden" class="form-control" name="now_item_qty" id="now_item_qty" value="<?php echo $qty; ?>" required>
                                                                                                <div class="panel-body">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="3">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                                            <input type="number" class="form-control" name="change_qty" min="1" id="change_qty" value="<?php echo $qty; ?>" step="any" placeholder="Quantity" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <center>
                                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Quantity</button>
                                                                                                </center>
                                                                                                
                                                                                            
                                                                                        </form>

                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>

                                                                            <!-- Add Part Discount -->
                                                                            <div class="modal fade" data-backdrop='static' data-keyboard='false' id="genarate_part_discount_<?php echo $rowIndex; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo $part_name; ?> Discount</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    
                                                                                    <form id="Add-Part-Discount" method="POST">
                                                                                            <input type="hidden" class="form-control" name="job_part_id" id="job_part_id" value="<?php echo $rowIndex; ?>" required>
                                                                                                <!-- <div class="panel-heading clearfix">
                                                                                                    <h4 class="panel-title">Register Client Details</h4>
                                                                                                </div> -->
                                                                                                <div class="panel-body">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="3">Discount % <font style="color: #FF0000;">*</font></label>
                                                                                                            <input type="number" class="form-control" name="part_discount" min="0" max="100" id="part_discount" value="<?php echo $Part_discount; ?>" placeholder="Discount %" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <center>
                                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-part-discount">Add Discount</button>
                                                                                                </center>
                                                                                                
                                                                                            
                                                                                        </form>

                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>


                                                                        <?php } ?>


                                                                    <?php } ?>



                                                                        

                                                                        

                                                    </tbody>

                                                </table>
                                            </div>

                                            <button id="invoice-button" class="btn btn-dark btn-round waves-effect waves-light" data-toggle="modal" data-target="#genarate_invoice"><i class="fa fa-plus-circle"></i> Add VAT</button>
                                            <button id="note-button" class="btn btn-purple btn-round waves-effect waves-light" data-toggle="modal" data-target="#write_note"><i class="fa fa-plus-circle"></i> Add Note</button>
                                            <!-- <button id="note-button" class="btn btn-pink btn-round waves-effect waves-light" data-toggle="modal" data-target="#advance_add"><i class="fa fa-plus-circle"></i> Add Advance</button> -->
                                            <a href="invoice?i=<?php echo base64_encode($JobId); ?>" id="preview-invoice-button" class="btn btn-success btn-round waves-effect waves-light" style="float: right;"><i class="fa fa-eye"></i> Preview Invoice</a>

        
                                       
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                
        

                    </div><!-- container -->


                    <!-- Add laber -->
                    <div class="modal fade" id="laber" role="dialog" data-backdrop='static' data-keyboard='false' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Labour</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                                                    
                            <form id="Add-Labour" method="POST">
                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required>
                                    <!-- <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Register Client Details</h4>
                                    </div> -->
                                    <div class="panel-body">

                                        <div class="col-md-12">
                                                                            
                                              <div class="form-group">
                                                <label for="1">Select Labour <font style="color: #FF0000;">*</font></label>
                                                <select style="width: 100% !important;" class="js-example-basic-single form-control" id="labour_name" name="labour_name" required>
                                                    <option selected disabled>Select Labour</option>
                                                    <?php

                                                        $clientNamesQuery=$conn->query("SELECT DISTINCT labour_id,labour_name,fru FROM tbl_labour");
                                                        while ($row=$clientNamesQuery->fetch_array()){

                                                    ?>
                                                        <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                              
                                                    <?php } ?>
                                                </select>

                                              </div>
                                                                              
                                        </div>

                                        <div class="col-md-12">
                                                                           
                                              <div class="form-group">
                                                <label for="fru">FRU <font style="color: #FF0000;">*</font></label>
                                                <input type="number" class="form-control" name="fru" min="0" id="fru" placeholder="FRU" required>
                                              </div>                             
                                        </div>

                                        <input type="hidden" class="form-control" name="fru_price" value="250" required readonly>

                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-add-labout">Add Labour</button>                      
                            </form>

                          </div>
                          <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div> -->
                        </div>
                      </div>
                    </div>


                    <!-- Add part -->
                                                <div class="modal fade" id="add-part" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <!--<h5 class="modal-title" id="exampleModalLongTitle">Add Parts to <?php //echo $labour_name_1.' '.$labour_name_2; ?></h5>-->
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Parts to Labour</h5>
                                                                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                          
                                                                <input type="hidden"   id="job_id" value="<?php echo $job_id; ?>" required>
                                                                <input type="hidden"  id="user_id" value="<?php echo $user_id; ?>" required>
                                                                <input type="hidden" id="dynamic_labour_id"/>
                                                                    <div class="panel-body">
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">      
                                                                                <div class="row">

                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="2">Select Part <font style="color: #FF0000;">*</font></label>
                                                                                            <select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" required onchange="onPartChanged()">
                                                                                                <option value="" selected disabled>Select Part</option>
                                                                                                <?php
                                                                                                    $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                                                    while ($row=$itemsQuery->fetch_array()) {
                                                                                                ?>
                                                                                                    <option value="<?php echo $row[2];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <span style="font-size: 12px; color: #FF0000;">Available Stock : <label id="item_qty_available">0</label> in stock</span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12" style="visibility: hidden;">
                                                                                        <div class="form-group">
                                                                                            <label for="2">Select Price Batch <font style="color: #FF0000;">*</font></label>
                                                                                            <select style="width: 100% !important;" class="form-control" id="price_batch_id" name="price_batch_id" required>
                                                                                                <option value="" selected disabled>Select Price Batch</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12" style="margin-top: -80px;">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                            <input type="number" min="1" value="1" class="form-control" name="qty" id="part-qty" placeholder="Quantity" required>
                                                                                          </div>
                                                                                    </div>

                                                                                    <div class="col-md-11">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Remark</label>
                                                                                            <input type="text" class="form-control" name="remark" id="part-remark" placeholder="Remark">
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <div class="form-group">
                                                                                            <label for="4" style="color: #fff;">Add</label>
                                                                                            <button type="submit" id="btn-add-part-plus" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                
                                                                                                 
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="panel-body">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-bordered" id="myTable">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Part Name</th>
                                                                                                    <th>Quantity</th>
                                                                                                    <!-- <th>Batch</th> -->
                                                                                                    <th>Remark</th>
                                                                                                    <th></th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                        <tbody id="part-area">
                                                                    
                                                                                                            
                                                                                        </tbody>
                                                                    
                                                                                        </table>
                                                                                                          
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                            </div>
                                                                        
                                                                                        
                                                                        
                                                                        </div>
                                                                    </div>
                                                                             
                
                                                                </div>
                                                                    <div class="modal-footer">
                                                                        <button type="btn btn-success" onclick="submitPartsData()" class="btn btn-success">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                    <!-- Write Note to Invoice -->
                    <div class="modal fade" id="write_note" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLongTitle">Write Note</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="Add-Note" method="POST">
                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required>
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                   
                                <div class="panel-body">
                                                                        
                                    <?php 
                                        $InvoiceNotesql = "SELECT * FROM tbl_tax WHERE job_id= '$JobId' ";
                                        $InvoiceNoteQuery=$conn->query($InvoiceNotesql);
                                        if($inq =$InvoiceNoteQuery->fetch_array())
                                        {
                                            $invoice_note = $inq[5];
                                        }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="5" name="note" placeholder="Write Your Note..."><?php echo $invoice_note; ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-add-note">Add Note</button>
                                                                
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Add Genarate Invoice -->
                    <div class="modal fade" id="genarate_invoice" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLongTitle">VAT</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                                        
                            <form id="Add-Vat" method="POST">
                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required>
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                <!-- <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Register Client Details</h4>
                                </div> -->
                                <div class="panel-body">
                                                                        
                                    <?php 
                                        $Taxsql = "SELECT * FROM tbl_tax WHERE job_id= '$JobId' ";
                                        $TaxQuery=$conn->query($Taxsql);
                                        if($tq =$TaxQuery->fetch_array())
                                        {
                                            $tax_id = $tq[0];
                                            $tax_vat=$tq[3];
                                            $tax_additional_price = $tq[6];
                                        }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>VAT %</label>
                                            <input type="number" class="form-control" value="<?php echo $tax_vat; ?>" name="vat" min="0" placeholder="VAT" required>
                                        </div>                                 
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-add-vat">Add VAT</button>
                                                                
                            </form>

                            </div>
                                                      
                          </div>
                        </div>
                    </div>



                    <?php include_once('controls/footer.php'); ?>
                </div>
                <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->
        </div>
        <!-- end page-wrapper -->


        



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/pages/jquery.datatable.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
    
                $(document).ready(function(){
                    
                    $("#labour_name").change(function(){
                        
                        
                        
                        $.ajax({
                            url:'controls/get_fru_rate.php',
                            type:'POST',
                            data:{
                                labour_name:$("#labour_name").val()
                            },
                            success:function(data){
                                    
                                  var json = JSON.parse(data);
                                  if(json.result){
                                      $("#fru").val(json.data);
                                  }
                                    
                            },error:function(err){
                                console.log(err);
                            }
                            
                            
                        });
                        
                        
                    });
                    
                    
                });
                
        </script>



        <script>
                function onPartChanged(){
                    var val=$("#select-part").val();
                   

                    $.ajax({
                        url:'controls/get_price_batch.php',
                        type:'POST',
                        data:{
                            part_no:val
                        },
                        success:function(data){
                           
                            var json = JSON.parse(data);
                            if(json.result){

                                $("#price_batch_id").html(json.data);
                                $("#item_qty_available").html(json.FullQTYTotal);


                            }




                        },error:function(err){
                            console.log(err);
                        }



                    //
                });


                }
        </script>

        <script>
        
                var tempList = [];
                var index = 0;
                
                
                function showModal(labourId){
                    
                    $("#dynamic_labour_id").val(labourId);
                    $('#add-part').modal('show');
                }
                
                function closeModal(){
                    
                    tempList = [];
                    index = 0;
                    addRowsToTmpTable();
                    
                    
                    $('#add-part').modal('hide');
                }
                
                
                
                function submitPartsData(){
                    
                  
                    
                    $.ajax({
                        url:'post/add_parts_labour_jobcard.php',
                        type:'POST',
                        data:{
                            list:JSON.stringify(tempList),
                            job_id:$("#job_id").val(),
                            user_id:$("#user_id").val(),
                            labour_id:$("#dynamic_labour_id").val()
                            // price_batch_id: $("#price_batch_id").val()
                        },
                        success:function(data){
                            
                            var json = JSON.parse(data);
                            
                            if(json.result){

                                $("#success_msg").html(json.msg);
                                $("#success_alert").addClass('show'); 
                                   
                                setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                                location.reload();
                                
                                // Swal.fire({
                                //           title: 'Success',
                                //           text: json.msg,
                                //           icon: 'success',
                                //           showCancelButton: false,
                                //           confirmButtonColor: '#3085d6',
                                //           cancelButtonColor: '#d33',
                                //           confirmButtonText: 'OK',
                                //           allowOutsideClick: false,
                                //             allowEscapeKey: false
                                //         }).then((result) => {
                                //           location.reload();
                                //         });
                                
                            }else{
                                $("#error_msg").html(json.msg);
                                $("#danger_alert_msg").addClass('show');
                                setTimeout(function(){ $("#danger_alert_msg").removeClass('show'); }, 1000);
                                $("#btn-update-item").attr("disabled",false);
                                // Swal.fire({
                                //           title: 'Warning',
                                //           text: json.msg,
                                //           icon: 'warning',
                                //           showCancelButton: false,
                                //           confirmButtonColor: '#3085d6',
                                //           cancelButtonColor: '#d33',
                                //           confirmButtonText: 'OK',
                                //           allowOutsideClick: false,
                                //             allowEscapeKey: false
                                //         }).then((result) => {
                                //           location.reload();
                                //         });
                            }
                            
                            
                            
                        },
                        error:function(e){
                            alert("err "+e);
                        }
                        
                        
                        
                    });
                    
                }
        
        
        function addRowsToTmpTable(){
            
            $('#part-area').empty();
            
                    var markup = "";
                       for(var i = 0;i<tempList.length;i++){
                           var ov = tempList[i];
                            markup += "<tr><td>"+ov.id+"</td><td>"+ov.part+"</td><td>"+ov.qty+"</td><td>"+ov.remark+"</td><td><button class='btn btn-danger' onclick=removeTmpItem("+ov.id+")>X</button></td></tr>"
                       }
                       
                       $("#part-area").append(markup);
            
            
        }
        
        
        function removeTmpItem(value){
            
           var index = tempList.findIndex(function(o){
                 return o.id === value;
            })
            if (index !== -1) tempList.splice(index, 1);
            
                  addRowsToTmpTable();
            
      
            
        }
            
            $(document).ready(function(){
                
                
                
                    $("#btn-add-part-plus").click(function(){
                         
                         index+=1;
                        
                       
                       var selectedPart = $("#select-part").val();
                       var qty = $("#part-qty").val();
                       var batch = $("#price_batch_id").val();
                       var remark = $("#part-remark").val();
                       
                       if(selectedPart =="" || qty ==""){
                           
                           
                       }else{
                           
                            var dp = {id:index,part:selectedPart,qty:qty,batch:batch,remark:remark};
                       tempList.push(dp);
                       
                       addRowsToTmpTable();
                       
                       
                       
                        $("#select-part").val("");
                        $("#part-qty").val("");
                        $("#price_batch_id").val("");
                        $("#part-remark").val("");
                       }
                     
                        
                    });
                
         
                
            });
            
            
        </script>

        <script type="text/javascript">
       

            function addOnClick(row,row_index,item_id,labour_id,pb){
               
                var newQty = parseInt($("#"+row).html())+1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'post/add_qty_job_plus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
                        price_batch:pb,
                        operator:'+'
                      },

                      success:function(data){

                       var json = JSON.parse(data);
                       if(json.result){
                           
                       }else{
                           
                             var newQty = parseInt($("#"+row).html())-1;
                                $("#"+row).html(newQty);
                           
                           
                            Swal.fire({
                                icon:'warning',
                                text:json.msg,
                                title:'Warning !'
                            });
                       }
                       

                      },error:function(err){
                        console.log(err);
                      }



                });



            }


            function minusOnClick(row,row_index,item_id,labour_id,pb){

                if(parseInt($("#"+row).html()) > 0 ){

                    var newQty = parseInt($("#"+row).html())-1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'post/add_qty_job_minus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
                        price_batch:pb,
                        operator:'-'
                      },

                      success:function(data){


                        var json = JSON.parse(data);
                        if(json.result){
                            var restart_flag  = json.restart_flag;

                            if(restart_flag === 'ON'){

                                            Swal.fire({
                                          title: 'Success',
                                          text: "Record will be deleted",
                                          icon: 'success',
                                          showCancelButton: false,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'OK'
                                        }).then((result) => {
                                          location.reload();
                                        });
                                       
                                   }


                        }else{
                            Swal.fire({
                                icon:'warning',
                                text:json.msg,
                                title:'Warning !'
                            });
                        }



                      },error:function(err){
                        console.log(err);
                      }



                });


                }else{
                    alert('qty is 0');
                }
               
                


            }



            $(document).ready(function() {
                $('.js-example-basic-single').select2();
                $('.js-example-basic-single-labour').select2();
                $('.js-example-basic-single-part').select2();
            });
        </script>

        
        <script>
        
            $(document).on('submit', '#Add-Labour', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-add-labout").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"job_card_post/add_labour_jobcard.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           // var id = json.lastId;
                           // alert (id);
                           // window.location.href = "job_form?p="+id;
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-add-labout").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        <script>
        
            $(document).on('submit', '#Add-Labour-Discount', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-labour-discount").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"job_card_post/update_labour_discount.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-labour-discount").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        
        <script>
        
            $(document).on('submit', '#Delete-Labour', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-delete").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"job_card_post/delete_labour.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-delete").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        <script>
        
            $(document).on('submit', '#Add-Part-Discount', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-part-discount").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"job_card_post/update_part_discount.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-part-discount").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        <script>
        
            $(document).on('submit', '#Add-Vat', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-add-vat").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"job_card_post/update_vat.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-add-vat").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        
        <script>
        
            $(document).on('submit', '#Add-Note', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-add-note").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 
                    },

                    url:"job_card_post/update_note.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (data) {
                        
                        $("#progress_alert").removeClass('show');
                        
                        var json=JSON.parse(data);
                        
                        if(json.result){
                            
                           $("#success_msg").html(json.msg);
                           $("#success_alert").addClass('show'); 
                           
                           setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-add-note").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>