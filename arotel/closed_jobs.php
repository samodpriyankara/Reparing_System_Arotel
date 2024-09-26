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
                                <button onclick="location.href='new_job'" class="btn btn-info px-4 align-self-center report-btn">Create New Job</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>Closed Jobs</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li> -->
                                    <li class="breadcrumb-item active">Closed Jobs</li>
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
        
                                        <h4 class="mt-0 header-title">Closed Jobs</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
        
                                        <table id="Closed-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Job Number</th>
                                                <th>Company Or Customer Name</th>
                                                <th>IMEI Number</th>
                                                <th>Contact Number</th>
                                                <th>Phone Model</th>
                                                <th>Job Date</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php

                                                $sql = "SELECT * FROM `tbl_job_details` WHERE stat='1'";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
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
                                            
                                            ?>
                                            <tr onclick="location.href='job_card?p=<?php echo base64_encode($JobId);?>'" style="cursor: pointer;">
                                                <td>AMAZOFT/JOB/<?php echo $JobYear; ?>/<?php echo $JobId+1000; ?></td>
                                                <td><?php echo $CustomerName; ?></td>
                                                <td><?php echo $MIMEI; ?></td>
                                                <td><?php echo $CustomerTel; ?></td>
                                                <td><?php echo $Make.' - '.$Model; ?></td>
                                                <td><?php echo $JobDateTime; ?></td>
                                            </tr>
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
                $('#Closed-table').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'Bfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                        'print', 'excel', 'pdf'
                    ]
                });
            } );
        </script>

    </body>
</html>