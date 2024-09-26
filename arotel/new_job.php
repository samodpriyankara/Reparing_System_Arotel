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
    //stat =0 is still open 
    $getJobOngoingQuery=$conn->query("SELECT COUNT(*) FROM tbl_job WHERE user_id='$user_id' AND stat='0' ORDER BY job_id DESC LIMIT 1");
    if ($GWOrs=$getJobOngoingQuery->fetch_array()) {
        $JobOngoingCount=$GWOrs[0];
    }
?>
<?php if($JobOngoingCount=='0'){ ?>
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
                                <!-- <button class="btn btn-info px-4 align-self-center report-btn">Creat Report</button> -->
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-card-outline mr-2"></i>Create Job</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li> -->
                                    <li class="breadcrumb-item active">Create Job</li>
                                </ol>
                            </div>                                      
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
            </div>
        </div>
        
        <div class="page-wrapper">
            <div class="page-wrapper-inner">

                <!-- Left Sidenav -->
                <?php include_once('controls/side_nav.php'); ?>
                <!-- end left-sidenav-->

                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid"> 
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">            
                                        <h4 class="mt-0 header-title" style="font-size: 25px; text-align: center; color: #000;">Cooperative Customer</h4><br>
                                        <center><img src="assets/icons/buildings.png" style="width: 30%;"></center><br>
                                        <!---------------Value 1 is Cooperative--------------------------->
                                        <form id="Create-Job">
                                            <input type="hidden" name="job_type" value="1" readonly required>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" readonly required>
                                            <center><button type="submit" class="btn btn-primary" id="btn-next">NEXT</button></center>
                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">            
                                        <h4 class="mt-0 header-title" style="font-size: 25px; text-align: center; color: #000;">Guest</h4><br>
                                        <center><img src="assets/icons/man.png" style="width: 30%;"></center><br>
                                        <form id="Create-Job">
                                            <!---------------Value 2 is Guest--------------------------->
                                            <input type="hidden" name="job_type" value="2" readonly required>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" readonly required>
                                            <center><button type="submit" class="btn btn-primary" id="btn-next">NEXT</button></center>
                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div><!--end col-->
                        </div><!--end row-->

                    </div><!-- container -->

                    <?php include_once('controls/footer.php'); ?>
                </div>
                <!-- end page content -->
            </div><!--end page-wrapper-inner-->
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
        
        $(document).on('submit', '#Create-Job', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-next").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"post/genarate_job.php",
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
                       window.location.href = "job_form?p="+id;
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-next").attr("disabled",false);
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
    $getJobOngoingIdQuery=$conn->query("SELECT job_id FROM tbl_job WHERE user_id='$user_id' AND stat='0' ORDER BY job_id DESC LIMIT 1");
    if ($GWOIrs=$getJobOngoingIdQuery->fetch_array()) {
        $JobId=$GWOIrs[0];
    }
?>
    <script>
        window.location.href = "job_form?p=<?php echo(base64_encode($JobId)) ?>";
    </script>

<?php }?>