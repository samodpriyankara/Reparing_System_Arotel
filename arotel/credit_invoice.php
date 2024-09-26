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
                            <h4 class="page-title mb-2"><i class="mdi mdi-table-large mr-2"></i>Credit Invoice</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li> -->
                                    <li class="breadcrumb-item active">Credit Invoice</li>
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
        
                                        <h4 class="mt-0 header-title">Credit Invoice</h4>
                                        <!-- <p class="text-muted mb-4 font-13">DataTables has most features enabled by
                                            default, so all you need to do to use it with your own tables is to call
                                            the construction function: <code>$().DataTable();</code>.
                                        </p> -->
        
                                        <table id="credit-invoice-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Invoice Number</th>
                                                <th></th>
                                                <th>Customer Name</th>
                                                <th>Telephone Number</th>
                                                <th>Payment Status</th>
                                                <th>Invoice Price (Rs.)</th>
                                                <th>Invoice Date</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php

                                                $sql = "SELECT * FROM `tbl_invoice_save` tis INNER JOIN tbl_job_details tjd ON tis.job_id=tjd.job_id WHERE tis.pay='2' ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $InvoiceSaveId=$row[0];
                                                    $JobId=$row[1];
                                                    $LabourTotal=$row[2];
                                                    $ItemTotal=$row[3];
                                                    $SubTotal=$row[4];
                                                    $Vat=$row[5];
                                                    $GrandTotal=$row[6];

                                                    $Pay=$row[7];
                                                    $Stat=$row[8];
                                                    $InvoiceSaveDateTime=$row[9];

                                                    $JobYear = date('Y', strtotime($InvoiceSaveDateTime));

                                                    /////
                                                    $CustomerName=$row[13];
                                                    $CustomerTel=$row[14];
                                            ?>
                                            <tr>
                                                <td>AMAZOFT/INVOICE/<?php echo $JobYear; ?>/<?php echo $JobId+10000; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='old_invoice_final?i=<?php echo base64_encode($row[0]); ?>'" class="btn btn-success">Invoice</button>
                                                    <?php if ($Stat=='0') { ?>
                                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row[0]; ?>" class="btn btn-primary">Genarate Receipt</button>
                                                    <?php }else{ ?>
                                                    <!-- <button type="button" onclick="location.href='receipt?r=<?php //echo base64_encode($row[1]); ?>'" class="btn btn-primary">Receipt</button> -->
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $CustomerName; ?></td>
                                                <td><?php echo $CustomerTel; ?></td>
                                                <td>
                                                    <?php if ($Pay=='1') { ?>
                                                        <b style="color: #008000;">Paid</b>
                                                    <?php }elseif($Pay=='2'){ ?>
                                                        <b style="color: #FF0000;">Credit</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #000;">-</b>
                                                    <?php } ?>
                                                </td>
                                                <td style="font-weight: 600;"><font style="float: right;"><?php echo number_format($GrandTotal,2); ?></font></td>
                                                <td><?php echo $InvoiceSaveDateTime; ?></td>
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
                $('#credit-invoice-table').DataTable({
                    "order": [[ 0, "desc" ]],
                    // "scrollX": true,
                    dom: 'Bfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                        'print', 'excel', 'pdf'
                    ]
                });
            } );
        </script>

        <script>
        
            $(document).on('submit', '#Create-Receipt', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-create-recept").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 
                    },

                    url:"post/create_receipt.php",
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
                           // location.href = "clients";
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-create-recept").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>