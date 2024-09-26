<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

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
    
    function rand_code($len)
    {
     $min_lenght= 0;
     $max_lenght = 100;
     // $bigL = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     //$smallL = "abcdefghijklmnopqrstuvwxyz";
     $number = "0123456789";
     // $bigB = str_shuffle($bigL);
     //$smallS = str_shuffle($smallL);
     $numberS = str_shuffle($number);
     // $subA = substr($bigB,0,5);
     // $subB = substr($bigB,6,5);
     // $subC = substr($bigB,10,5);
     // $subD = substr($smallS,0,5);
     // $subE = substr($smallS,6,5);
     // $subF = substr($smallS,10,5);
     $subG = substr($numberS,0,5);
     $subH = substr($numberS,6,5);
     $subI = substr($numberS,10,5);
     $RandCode1 = str_shuffle($subH.$subI.$subG);
     // $RandCode1 = str_shuffle($subA.$subH.$subC.$subI.$subB.$subG);
     $RandCode2 = str_shuffle($RandCode1);
     $RandCode = $RandCode1.$RandCode2;
     if ($len>$min_lenght && $len<$max_lenght)
     {
     $CodeEX = substr($RandCode,0,$len);
     }
     else
     {
     $CodeEX = $RandCode;
     }
     return $CodeEX;
    }
    
?>

<?php
    $getGRNDetailsQuery=$conn->query("SELECT COUNT(*) FROM tbl_grn_details WHERE stat='0' ORDER BY grn_detail_id DESC LIMIT 1");
    if ($GgrnQ=$getGRNDetailsQuery->fetch_array()) {
        $GRNOngoingCount=$GgrnQ[0];
    }
?>
<?php if($GRNOngoingCount=='0'){ ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('controls/meta.php'); ?>
    </head>

        <style>
            .select2-container .select2-selection--single {
                height: 39px !important;
                border-color: #E8E9E9 !important; 
                font-size: 14px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 39px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 35px !important;
            }
        </style>

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
                            <h4 class="page-title mb-2"><i class="mdi mdi-format-list-bulleted mr-2"></i>Create GRN</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="new_job">Create Job</a></li> -->
                                    <li class="breadcrumb-item active">Create GRN</li>
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
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">GRN Form</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        <form id="Create-GRN-Details" method="POST">
                                            <input type="hidden" class="form-control" name="user_name" value="<?php echo $user_name; ?>" readonly>
                                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" readonly>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Supplier Name <font style="color: #FF0000;">*</font></label>
                                                    <select class="js-example-basic-single form-control" name="supplier_id" required>
                                                        <option value="" selected disabled>Select Supplier Name</option>
                                                        <?php

                                                            $getDataForDate=$conn->query("SELECT * FROM tbl_supplier");
                                                            while ($row=$getDataForDate->fetch_array()) {
                                                        ?>
                                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                                        <?php } ?>
                                                    </select>     
                                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Invoice Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="invoice_number" placeholder="ABC/2022/10052" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Auto Genarate Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" value="<?php echo rand_code(6); ?>" name="grn_number" placeholder="Auto Genarate Number" required readonly>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Goods Received Date <font style="color: #FF0000;">*</font></label>
                                                    <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" name="goods_received_date" placeholder="Goods Received Date" required>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Note</label>
                                                    <textarea class="form-control" name="note" rows="5" placeholder="Write about GRN..."></textarea>
                                                </div>
                                            </div>  


                                            <button type="submit" class="btn btn-primary" id="btn-submit-job">Create GRN</button>
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

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script type="text/javascript">
       
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>

        <script>
        
            $(document).on('submit', '#Create-GRN-Details', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-submit-job").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"grn_post/submit_grn_details.php",
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
                           window.location.href = "grn_invoice?g="+id;
                            
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

<?php }else{ ?>

<?php
    $getGRNDetailsOngoingIdQuery=$conn->query("SELECT grn_detail_id FROM tbl_grn_details WHERE stat='0' ORDER BY grn_detail_id DESC LIMIT 1");
    if ($GgrnDOrs=$getGRNDetailsOngoingIdQuery->fetch_array()) {
        $GRNDetailId=$GgrnDOrs[0];
    }
?>
    <script>
        window.location.href = "grn_invoice?g=<?php echo(base64_encode($GRNDetailId)) ?>";
    </script>

<?php }?>