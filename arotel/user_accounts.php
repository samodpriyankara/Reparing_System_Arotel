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
                            <h4 class="page-title mb-2"><i class="mdi mdi-format-list-bulleted mr-2"></i>Users</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="new_job">Create Job</a></li> -->
                                    <li class="breadcrumb-item active">Users</li>
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
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">Create User</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        <form id="Branch-Registartion" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Type Name <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" placeholder="John Doe" name="name" id="name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email <font style="color: #FF0000;">*</font></label>
                                                <input type="email" class="form-control" placeholder="xxxxx@gmail.com" name="email" id="email" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Contact Number <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" placeholder="07XX XXX XXX" name="tel" id="tel" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>User Role <font style="color: #FF0000;">*</font></label>
                                                <select class="form-control default-select" id="role" name="role">
                                                    <option disabled>Select User Role</option>
                                                    <option value="2" selected>Normal Account</option>
                                                    <option value="1">Super Admin</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Password <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" placeholder="XXXXXXXXXXXXX" name="password" id="password" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Confirm Password <font style="color: #FF0000;">*</font></label>
                                                <input type="password" class="form-control" placeholder="XXXXXXXXXXXXX" name="cpassword" id="confirm_password" required>
                                            </div>
                                        </div>
                                        <button type="submit" id="register" name="register" class="btn btn-primary log">Create Account</button>
                                    </form>                                           
                                    </div><!--end card-body-->
                                </div><!--end card-->


                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">User Accounts</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        
                                        <table id="Account-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>TP Number</th>
                                                <th>Register Date</th>
                                                <th></th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php
                                                $sql = "SELECT * FROM `users_login` ORDER BY 'user_id' DESC ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $UserId = $row[0];
                                                    $UserName = $row[1];
                                                    $UserEmail = $row[2];
                                                    $UserRole = $row[4];
                                                    $userTelephone = $row[5];
                                                    $userRegDate = $row[6];
                                            ?>
                                            <tr>
                                                <td><?php echo $UserId; ?></td>
                                                <td><?php echo $UserName; ?></td>
                                                <td><?php echo $UserEmail; ?></td>
                                                <td>
                                                    <b><?php if($UserRole=='1'){ echo 'Super Admin'; }else{ echo 'Normal Account'; } ?></b>
                                                </td>
                                                <td><?php echo $userTelephone; ?></td>
                                                <td><?php echo $userRegDate; ?></td>
                                                <td>
                                                    <?php if ($UserEmail!=='admin@mail.com') { ?>
                                                    <form method="POST" action="controls/delete_user?login_id=<?php echo $UserId; ?>" >
                                                        <input type="hidden" name="login_id" id="login_id" value="<?php echo $UserId; ?>">
                                                        <button class="btn btn-danger">Remove</button>
                                                    </form>
                                                    <?php }else{}?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>

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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            $(document).ready( function () {
                $('#Account-table').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'Bfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                        'print', 'excel', 'pdf'
                    ]
                });
            } );
        </script>

        <script type="text/javascript">
            $(function() {
                $(".log").click(function() {
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var role = $("#role").val();
                    var tel = $("#tel").val();
                    var password = $("#password").val();
                    var confirm_password = $("#confirm_password").val();
                    //var dataString = 'name='+ name + 'email='+ email + '&confirm_password=' + confirm_password + 'role='+ role ;
                    var data = {
                      'name': name,
                      'role' : role, 
                      'tel' : tel,
                      'email' : email, 
                      'confirm_password' : confirm_password
                    }
                    
                    //debugger;
                    if(name=='' || email=='' || password=='' || confirm_password=='' || (password !=confirm_password) || role=='' || tel=='')
                    {
                        swal("Sorry !", "Couldn't create your account !", "error");
                    }
                    
                    else
                    {
                        $.ajax({
                            type: "POST",
                            url: "controls/join.php",
                            data: {
                            'name': name,
                            'role' : role, 
                            'tel' : tel,
                            'email' : email, 
                            'confirm_password' : confirm_password
                          },
                            success: function(data){
                                //debugger;

                                //$('.success').fadeIn(200).show();
                                //$('.error').fadeOut(200).hide();
                                swal("Thanks !","Your account is created !"+" "+"Redirecting you to login","success", {button:false});


                                setTimeout(function () {
                                    location.reload();
                                    //window.location.href = "index"; //will redirect to your blog page (an ex: blog.html)
                                }, 1000);
                            }
                        });
                    }
                    return false;
                });
            });
        </script> 

    </body>
</html>