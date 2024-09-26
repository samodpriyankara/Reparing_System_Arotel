<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $JobId= base64_decode($_GET['p']);

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
    $getDataJobQuery=$conn->query("SELECT * FROM tbl_job WHERE job_id = '$JobId' ");
    if($rs=$getDataJobQuery->fetch_array()) {

        $JobType=$rs[1];
        $JobUserId=$rs[2];
        $JobStat=$rs[3];
        $JobDateTime=$rs[4];
    }
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
                                <!-- <button class="btn btn-info px-4 align-self-center report-btn">Create Report</button> -->
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-format-list-bulleted mr-2"></i>Job Form (<?php if ($JobType=='1') { echo 'Cooperative'; }else{ echo 'Guest'; } ?>)
                            </h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="new_job">Create Job</a></li>
                                    <li class="breadcrumb-item active">Job Form (<?php if ($JobType=='1') { echo 'Cooperative'; }else{ echo 'Guest'; } ?>)</li>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">Job Form (<?php if ($JobType=='1') { echo 'Cooperative'; }else{ echo 'Guest'; } ?>)</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        <form id="Add-Job-Details" method="POST">
                                            <input type="hidden" class="form-control" name="job_id" value="<?php echo $JobId; ?>" required readonly>
                                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required readonly>

                                            <div class="row">
                                                <!-------------------Client Details--------------------------------------------->
                                                <?php if ($JobType=='1') { ?>
                                                    <div class="col-md-6 form-group">
                                                        <label>Customer Name <font style="color: #FF0000;">*</font></label>
                                                        <!-- <input type="text" class="form-control" name="customer_name" placeholder="John Doe" required> -->
                                                        <select name="client_id" id="client_id" class="form-control" onchange = "clientChanged(this.value)">
                                                            <option value="" disabled selected>Select Client</option>
                                                            <?php
                                                                $getDataForDate=$conn->query("SELECT * FROM tbl_client");
                                                                while ($row=$getDataForDate->fetch_array()) {
                                                            ?>
                                                                <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <input type="hidden" class="form-control" id="customer_name" name="customer_name" placeholder="John Doe" required readonly>
                                                    <div class="col-md-6 form-group">
                                                        <label>Customer Contact Number <font style="color: #FF0000;">*</font></label>
                                                        <input type="text" class="form-control" id="customer_tel" name="customer_tel" placeholder="07X XXXXXXX" required readonly>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Customer Email</label>
                                                        <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="johndoe@mail.com" readonly>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Customer Address</label>
                                                        <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="No:1 Colombo 0003" readonly>
                                                    </div>
                                                <!------------Guest Customer Details----------------------------------->
                                                <?php }else{ ?>
                                                    <input type="hidden" class="form-control" name="client_id" value="0" required readonly>
                                                    <div class="col-md-6 form-group">
                                                        <label>Customer Name <font style="color: #FF0000;">*</font></label>
                                                        <input type="text" class="form-control" name="customer_name" placeholder="John Doe" required>
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Customer Contact Number <font style="color: #FF0000;">*</font></label>
                                                        <input type="text" class="form-control" name="customer_tel" placeholder="07X XXXXXXX" required>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Customer Email</label>
                                                        <input type="email" class="form-control" name="customer_email" placeholder="johndoe@mail.com">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Customer Address</label>
                                                        <input type="text" class="form-control" name="customer_address" placeholder="No:1 Colombo 0003">
                                                    </div>
                                                <?php } ?>
                                                <div class="col-md-6 form-group">
                                                    <label>M_IMEI Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="m_imei" placeholder="021XXXXXXXXXXXXXXXXXX" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>S_IMEI Number</label>
                                                    <input type="text" class="form-control" name="s_imei" placeholder="034XXXXXXXXXXXXXXXXXX">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Make <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="make" placeholder="Samsung" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Model <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="model" placeholder="A70" required>
                                                </div>

                                                

                                                <!--------------------------------------------------->

                                                <div class="col-md-12 table-responsive">
                                                    <label>Accessory Received <font style="color: #FF0000;">*</font></label>
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
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="100" name="phone" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="100">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="101" name="phone" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="101">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="102" name="phone" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="102">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="103" name="battry" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="103">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="104" name="battry" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="104">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="105" name="battry" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="105">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="106" name="charger" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="106">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="107" name="charger" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="107">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="108" name="charger" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="108">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="109" name="hfree" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="109">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="110" name="hfree" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="110">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="111" name="hfree" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="111">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="112" name="bcover" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="112">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="113" name="bcover" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="113">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="114" name="bcover" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="114">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="115" name="sim" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="115">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="116" name="sim" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="116">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="117" name="sim" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="117">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="118" name="msd" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="118">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="119" name="msd" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="119">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="120" name="msd" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="120">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="121" name="bhf" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="121">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="122" name="bhf" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="122">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="123" name="bhf" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="123">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="124" name="warrenty_card" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="124">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="125" name="warrenty_card" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="125">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="126" name="warrenty_card" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="126">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="127" name="box" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="127">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="128" name="box" value="No" class="custom-control-input">
                                                                        <label class="custom-control-label" for="128">No</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="129" name="box" value="N/A" class="custom-control-input">
                                                                        <label class="custom-control-label" for="129">N/A</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <!------------------------------------------------->
                                                <div class="col-md-12 table-responsive"><br>
                                                    <label>Fault Category <font style="color: #FF0000;">*</font></label>
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
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="130" name="power_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="130">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="131" name="display_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="131">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="132" name="keypad_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="132">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="133" name="audio_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="133">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="134" name="signal_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="134">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="135" name="charging_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="135">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="136" name="functionality_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="136">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="137" name="software_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="137">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="138" name="accessory_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="138">Yes</label>
                                                                    </div>
                                                                </div>
                                                                
                                                            </td>

                                                            <td>
                                                                <div class="form-check-inline my-1">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="139" name="other_fault" value="Yes" class="custom-control-input">
                                                                        <label class="custom-control-label" for="139">Yes</label>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-12 form-group"><br>
                                                    <label>Description of fault <font style="color: #FF0000;">*</font></label>
                                                    <textarea class="form-control" value="" name="fault_note" rows="5" placeholder="Write fault here...."></textarea>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label>Note</label>
                                                    <textarea class="form-control" value="" name="note" rows="5" placeholder="Write anything about this job...."></textarea>
                                                </div>


                                            </div>
                                            

                                            <button type="submit" class="btn btn-primary" id="btn-submit-job">Submit Job Details</button>
                                        </form>                                           
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div><!--end col-->
                            
                        </div><!--end row-->

                       
                         

                        

                        
                        

                        
                    </div><!-- container -->

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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            function clientChanged(client_id){
               
              $.ajax({
                  url:'controls/get_client_details.php',
                  type:'POST',
                  data:{
                      client_id:client_id
                  },
                  success:function(data){
                     
                     var json=JSON.parse(data);
            if(json.result){
                
                $("#customer_name").val(json.customer_name);
                $("#customer_tel").val(json.customer_tel);
                $("#customer_email").val(json.customer_email);
                $("#customer_address").val(json.customer_address);
                
                
            }
                     
                  },
                  error:function(data,err,xhr){
                      console.log(data+" "+err)
                  }
                  
              });
               
               
               
               
               
            }
        </script>

        <script>
        
            $(document).on('submit', '#Add-Job-Details', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-submit-job").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"post/add_job_card.php",
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
                           var id = json.lastId;
                           // alert (id);
                           window.location.href = "job_card?p="+id;
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-submit-job").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>