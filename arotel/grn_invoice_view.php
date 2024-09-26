<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $GRNDetailId= base64_decode($_GET['g']);
    $ItemCount=0;
    $GRNInvoiceCost=0;

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
    $getDataQuery=$conn->query("SELECT * FROM tbl_grn_details tgd INNER JOIN tbl_supplier tsu ON tgd.supplier_id=tsu.supplier_id WHERE tgd.grn_detail_id = '$GRNDetailId' ");
    if ($GRNrs=$getDataQuery->fetch_array()) {

        $SupplierId=$GRNrs[1];
        $CreateUserName=$GRNrs[2];
        $CreateUserId=$GRNrs[3];
        $InvoiceNumber=$GRNrs[4];
        $GRNNumber=$GRNrs[5];
        $GoodsReceivedDate=$GRNrs[6];
        $Note=$GRNrs[7];
        $Stat=$GRNrs[8];
        $GRNDateTime=$GRNrs[9];
        
        $GRNYear = date('Y', strtotime($GRNDateTime)) ;

        /////////////////////////////////

        $SupplierName=$GRNrs[11];
        $SupplierCompanyName=$GRNrs[12];
        $SupplierAddress=$GRNrs[13];
        $SupplierPhoneNumber=$GRNrs[14];
        $SupplierEmail=$GRNrs[15];
        $SupplierStat=$GRNrs[16];
        $SupplierDateTime=$GRNrs[17];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('controls/meta.php'); ?>
    </head>

                    <style>
                          @media print {
                            @page {
                              size: auto;   /* auto is the initial value */
                              size: A4 portrait;
                              margin: 0;  /* this affects the margin in the printer settings */
                              border: 1px solid red;  /* set a border for all printed pages */
                            }
                            body {
                                zoom: 80%;
                                /*transform: scale(.6);*/
                                /*margin-top: -320px;*/
                                width: 100%;
                                font-weight: 700;
                            }
                            #print-page{
                                margin-left: -320px;
                                margin-top: 40px;
                                background-color: #fff !important;
                            }
                            #supplier-details-print{
                                margin-top: -80px !important;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #logoimg_print{
                                width: 15% !important;
                            }
                            #topnav{
                                display: none;
                            }
                            #sidenav{
                                display: none;
                            }
                            #footer{
                                display: none;
                            }
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
                                <button onclick="location.href='create_grn'" class="btn btn-info px-4 align-self-center report-btn">Create GRN</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>GRN Invoice</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="view_grn_list">GRN List</a></li>
                                    <li class="breadcrumb-item active">GRN Invoice</li>
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
        
                                        <h4 class="mt-0 header-title">GRN</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
        
                                        <div class="example-container">
                                            <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-outline-info waves-effect waves-light"><i class="fa fa-print"></i> Print</button>
                                            <div class="example-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p style="text-align: left;">
                                                                    <b>GRN Number - AMAZOFT/GRN/<?php echo $GRNYear; ?>/<?php echo 1000+$GRNDetailId;?></b><br>
                                                                    <b>Invoice Number - <?php echo $InvoiceNumber; ?></b><br>
                                                                    <b>GR Date - <?php echo $GoodsReceivedDate; ?></b><br>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6" id="supplier-details-print">
                                                                <p style="text-align: right;">
                                                                    <b>Supplier Details</b><br>
                                                                    <?php echo $SupplierName; ?><br>
                                                                    <?php echo $SupplierCompanyName; ?><br>
                                                                    <?php echo $SupplierAddress; ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <?php      
                                                            $getGRNInvoiceCost = "SELECT * FROM tbl_grn_items WHERE grn_detail_id='$GRNDetailId'";
                                                            $gGRNiRs=$conn->query($getGRNInvoiceCost);
                                                            $ResultCount = 0;
                                                            while($gGRNirow =$gGRNiRs->fetch_array())
                                                            {
                                                                $ResultCount += 1;
                                                                //////
                                                                $GCostPrice=(double)$gGRNirow[4];
                                                                $GGRNQTY=(double)$gGRNirow[6];
                                                                $GGRNItemCost = $GCostPrice * $GGRNQTY;
                                                                //////
                                                                $GRNInvoiceCost+=$GGRNItemCost;
                                                            }
                                                        ?>
                                                        
                                                        <div class="row" style="display: none;">
                                                            <div class="col-md-6">
                                                                <div class="card widget widget-info-navigation" style="background-color: #e7ecf8;">
                                                                    <div class="card-body">
                                                                        <div class="widget-info-navigation-container">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="widget-info-navigation-content">
                                                                                        <span class="text-dark">Item Count</span><br>
                                                                                        <span class="text-danger fw-bolder fs-2" id="grn-item-count" style="color: #ff4857!important; font-size: 30px; font-weight: 700;"><?php echo $ResultCount; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="widget-info-navigation-action">
                                                                                        <a href="#!" class="btn btn-light btn-rounded" style="border-radius: 18px;"><i class="fe fe-arrow-down-circle"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card widget widget-info-navigation" style="background-color: #e7ecf8;">
                                                                    <div class="card-body">
                                                                        <div class="widget-info-navigation-container">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="widget-info-navigation-content">
                                                                                        <span class="text-dark">Total Cost</span><br>
                                                                                        <span class="text-danger fw-bolder fs-2" id="grn-total-cost" style="color: #ff4857!important; font-size: 30px; font-weight: 700;"><?php echo number_format($GRNInvoiceCost,2); ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="widget-info-navigation-action">
                                                                                        <a href="#!" class="btn btn-light btn-rounded" style="border-radius: 18px;"><i class="icon-wallet"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="example-content">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Item</th>
                                                                        <th scope="col"><font style="float: right;">Qty</font></th>
                                                                        <th scope="col"><font style="float: right;">Cost (Rs)</font></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="grn-item-area">
                                                                    <?php
                                                                        $getGRNItems = "SELECT * FROM tbl_grn_items tgi INNER JOIN tbl_item tit ON tgi.item_id=tit.item_id WHERE tgi.grn_detail_id='$GRNDetailId' ORDER BY tgi.grn_items_id ASC";
                                                                        $gGRNiRs=$conn->query($getGRNItems);
                                                                        while($gGRNiRsrow =$gGRNiRs->fetch_array())
                                                                        {
                                                                            $GRNItemItemId=$gGRNiRsrow[0];
                                                                            $ItemId=$gGRNiRsrow[2];
                                                                            $PriceBatchId=$gGRNiRsrow[3];
                                                                            $CostPrice=(double)$gGRNiRsrow[4];
                                                                            $SellingPrice=$gGRNiRsrow[5];
                                                                            $GRNQTY=(double)$gGRNiRsrow[6];
                                                                            $GRNItemStat=$gGRNiRsrow[7];
                                                                            ////////////////////////////
                                                                            $ItemName=$gGRNiRsrow[9];

                                                                            $GRNItemCost = $CostPrice * $GRNQTY;


                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $ItemCount+=1; ?></th>
                                                                        <td><?php echo $ItemName; ?></td>
                                                                        <td><b style="float: right;"><?php echo $GRNQTY; ?></b></td>
                                                                        <td><b style="float: right;"><?php echo number_format($GRNItemCost,2); ?></b></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th><b style="float: right; color: #000; font-size: 20px; font-weight: 700;"><?php echo number_format($GRNInvoiceCost,2); ?></b></th>
                                                                    </tr>
                                                                </tfoot>

                                                            </table>
                                                        </div>


                                                        

                                                    </div>

                                                </div>

                                            </div>
                                            

                                        </div>
        
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

        

    </body>
</html>