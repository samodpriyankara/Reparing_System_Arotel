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
                                <button onclick="location.href='reg_client'" class="btn btn-info px-4 align-self-center report-btn">Register Client</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>Clients</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li> -->
                                    <li class="breadcrumb-item active">Clients</li>
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
        
                                        <h4 class="mt-0 header-title">Client List</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
        
                                        <table id="Client-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Or Customer Name</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Registration Date</th>
                                                <th></th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php

                                                $sql = "SELECT * FROM `tbl_client`";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $ClientId=$row[0];
                                                    $ClientName=$row[1];
                                                    $ClientTel=$row[2];
                                                    $ClientEmail=$row[3];
                                                    $ClientHowToKnow=$row[4];
                                                    $ClientAddress=$row[5];
                                                    $ClientStat=$row[6];
                                                    $ClientDateTime=$row[7];
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $ClientId; ?></td>
                                                <td><?php echo $ClientName; ?></td>
                                                <td><?php echo $ClientEmail; ?></td>
                                                <td><?php echo $ClientTel; ?></td>
                                                <td><?php echo $ClientDateTime; ?></td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#clientModalCenter<?php echo $ClientId; ?>"><i class="dripicons-document-edit" style="color: #000;"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="clientModalCenter<?php echo $ClientId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?php echo $ClientName; ?> Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form id="Update-Client" method="POST">
                                                      <div class="modal-body"> 
                                                        <input type="hidden" class="form-control" value="<?php echo $ClientId; ?>" name="client_id" placeholder="Facebook Or John Doe" required readonly>
                                                            <div class="col-md-12 form-group">
                                                                <label>Customer Or Company Name <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" class="form-control" value="<?php echo $ClientName; ?>" name="customer_name" placeholder="Facebook Or John Doe" required>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label>Customer Contact Number <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" class="form-control" value="<?php echo $ClientTel; ?>" name="customer_tel" placeholder="07X XXXXXXX" required>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label>Customer Email <font style="color: #FF0000;">*</font></label>
                                                                <input type="email" class="form-control" value="<?php echo $ClientEmail; ?>" name="customer_email" placeholder="johndoe@mail.com" required>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label>Customer Address <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" class="form-control" value="<?php echo $ClientAddress; ?>" name="customer_address" placeholder="No:1 Colombo 0003" required>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" id="btn-save-client">Save changes</button>
                                                      </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>


                                            <?php } ?>
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                
        

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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            $(document).ready( function () {
                $('#Client-table').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'Bfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                        'print', 'excel', 'pdf'
                    ]
                });
            } );
        </script>

        <script>
        
            $(document).on('submit', '#Update-Client', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-save-client").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"post/update_client_details.php",
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
                            $("#btn-save-client").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>