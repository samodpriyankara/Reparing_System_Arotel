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
                            <h4 class="page-title mb-2"><i class="mdi mdi-format-list-bulleted mr-2"></i>Customer Registartion Form</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="new_job">Create Job</a></li> -->
                                    <li class="breadcrumb-item active">Customer Registartion Form</li>
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
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">Customer Registartion Form</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        <form id="Add-Client" method="POST">
                                            <div class="row">
                                                
                                                    
                                                <div class="col-md-6 form-group">
                                                    <label>Customer Or Company Name <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="customer_name" placeholder="Facebook Or John Doe" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Customer Contact Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="customer_tel" placeholder="07X XXXXXXX" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Customer Email <font style="color: #FF0000;">*</font></label>
                                                    <input type="email" class="form-control" name="customer_email" placeholder="johndoe@mail.com" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>How did they hear about us? <font style="color: #FF0000;">*</font></label>
                                                    <select name="how_to_know" class="form-control" required>
                                                        <option disabled="">Select How did they hear about us?</option>
                                                        <option value="Friend" selected="">Friend</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Instergram">Instergram</option>
                                                        <option value="News Paper">News Paper</option>
                                                        <option value="Other Website">Other Website</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Customer Address <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="customer_address" placeholder="No:1 Colombo 0003" required>
                                                </div>
                                                
                                            </div>

                                            <button type="submit" class="btn btn-primary" id="btn-register-client">Register Client</button>
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
        
            $(document).on('submit', '#Add-Client', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-register-client").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 
                    },

                    url:"post/add_client.php",
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
                           // location.reload();
                           location.href = "clients";
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-register-client").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>