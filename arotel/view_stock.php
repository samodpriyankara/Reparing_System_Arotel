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
                                <button onclick="location.href='add_item'" class="btn btn-info px-4 align-self-center report-btn">Add New Item</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>Stock</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li> -->
                                    <li class="breadcrumb-item active">Stock</li>
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
        
                                        <h4 class="mt-0 header-title">Stock</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
        
                                        <table id="Client-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Part Location</th>
                                                <th>Price Batch</th>
                                                <th>Part Quantity</th>
                                                <th>Remark</th>
                                                <th>Part Cost (.Rs)</th>
                                                <th>Part Selling Price (.Rs)</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php
                                                $total_cost_batch = 0;
                                                $total_selling_batch = 0;
                                                $Batchsql = "SELECT * FROM tbl_item ti INNER JOIN tbl_item_price_batch tipb ON ti.item_id=tipb.item_id WHERE tipb.qty>0 ORDER BY ti.item_id DESC ";
                                                $Irs=$conn->query($Batchsql);
                                                while($Irow =$Irs->fetch_array())
                                                {
                                                    $item_id = $Irow[0];
                                                    $part_name = $Irow[1];
                                                    $part_location = $Irow[2];
                                                    $part_number = $Irow[3];
                                                    $part_remark = $Irow[4];
                                                    
                                                    ///////////////////////////////////////
                                                    $CostBatchPrice = (double)$Irow[10];
                                                    $SellingBatchPrice = (double)$Irow[11];
                                                    $BatchQty = $Irow[12];
                                                    $BatchLabel = $Irow[13];

                                                    $total_cost_batch += $CostBatchPrice * $BatchQty;
                                                    $total_selling_batch += $SellingBatchPrice * $BatchQty;
                                            
                                            ?>
                                            <?php if($BatchQty<=10){ ?>
                                            <tr style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $item_id; ?></td> 
                                                <td><?php echo $part_name; ?></td>
                                                <td><?php echo $part_number; ?></td>
                                                <td><?php echo $part_location; ?></td>
                                                <td><b><?php echo $BatchLabel; ?></b></td>
                                                <td><?php echo $BatchQty; ?></td>
                                                <td><?php echo $part_remark; ?></td>
                                                <td style="color: #000;"><b style="float: right;"><?php echo number_format($CostBatchPrice,2); ?></b></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($SellingBatchPrice,2); ?></b></td>
                                            </tr>
                                            
                                            <?php } ?>
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>


                                                    <th style="color: #FF0000;">
                                                        <b style="float: right; font-size: 25px;"><?php echo number_format($total_cost_batch,2); ?></b><br><br>
                                                        <p style="float: right;">Total Cost</p>
                                                    </th>
                                                    <th style="color: #008000;">
                                                        <b style="float: right; font-size: 25px;"><?php echo number_format($total_selling_batch,2); ?></b><br><br>
                                                        <p style="float: right;">Total Selling</p>
                                                    </th>
                                                </tr>
                                            </tfoot>

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

    </body>
</html>