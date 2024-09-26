<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $JobId = base64_decode($_GET['i']);

    $total_job_fru_paybel=0;
    $total_part_price=0;
    $GrandTotal=0;
    $LabourCount=0;

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
    $sql = "SELECT * FROM tbl_job_details WHERE job_id= '$JobId' ";
    $rs=$conn->query($sql);
    if($row =$rs->fetch_array())
    {
        $JobDetailId=$row[0];
        // $JobId=$row[1];
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
    }
?>
<?php 
    $TaxSql = "SELECT * FROM tbl_tax WHERE job_id= '$JobId' ";
    $Trs=$conn->query($TaxSql);
    if($Trow =$Trs->fetch_array())
    {
        $TaxId=$Trow[0];
        $UserId=$Trow[2];
        $VAT=$Trow[3];
        $Discount=$Trow[4];
        $InvoiceNote=$Trow[5];
        $AdditionalPrice=$Trow[6];
        $OutDateTime=$Trow[7];
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
                                <button class="btn btn-info px-4 align-self-center report-btn">Create Report</button>
                            </div>
                            <h4 class="page-title mb-2"><i class="mdi mdi-receipt mr-2"></i>Invoice</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="old_invoice">Invoices</a></li>
                                    <li class="breadcrumb-item active">Invoice</li>
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
                                    <div class="card-body invoice-head"> 
                                        <div class="row">
                                            <div class="col-md-4 align-self-center">                                                
                                                <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm mr-2" height="38">                                            
                                                <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg" height="18">                                               
                                            </div>
                                            <div class="col-md-8">
                                                   
                                                <ul class="list-inline mb-0 contact-detail float-right">                                                   
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-web"></i>
                                                            <p class="text-muted mb-0">www.amazoft.com</p><br>
                                                            <!-- <p class="text-muted mb-0">www.qrstuvwxyz.com</p> -->
                                                        </div>                                                
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-phone"></i>
                                                            <p class="text-muted mb-0">+94 123456789</p>
                                                            <p class="text-muted mb-0">+94 123456789</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-map-marker"></i>
                                                            <p class="text-muted mb-0">No 103,</p>
                                                            <p class="text-muted mb-0">St Anthonys Mw, Colombo 0003 SL.</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> 
                                    </div><!--end card-body-->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="">
                                                    <h6 class="mb-0"><b>Invoice Date :</b> <?php echo $OutDateTime; ?></h6>
                                                    <h6><b>Invoice No :</b> AMAZOFT/INVOICE/<?php echo $JobYear; ?>/<?php echo $JobId+10000; ?></h6>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-3">                                            
                                                <div class="float-left">
                                                    <address class="font-13">
                                                        <strong class="font-14">Billed To :</strong><br>
                                                        Joe Smith<br>
                                                        795 Folsom Ave<br>
                                                        San Francisco, CA 94107<br>
                                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                                    </address>
                                                </div>
                                            </div> -->
                                            <div class="col-md-3">
                                                <div class="">
                                                    <address class="font-13">
                                                        <strong class="font-14">Billed To:</strong><br>
                                                        <?php echo $CustomerName; ?><br>
                                                        <?php echo nl2br($CustomerAddress); ?><br>
                                                        <abbr title="Phone">P:</abbr> <?php echo $CustomerTel; ?>
                                                    </address>
                                                </div>
                                            </div>                                           
                                            
                                            <!-- <div class="col-md-3">
                                                <div class="text-center bg-light p-3 mb-3">
                                                    <h5 class="bg-primary mt-0 p-2 text-white d-sm-inline-block">Payment Methods</h5>
                                                    <h6 class="font-13">Paypal & Cards Payments :</h6>
                                                    <p class="mb-0 text-muted">Companyaccountpaypal@gmai.com</p>
                                                    <p class="mb-0 text-muted">Visa, Master Card, Chaque</p>
                                                </div>                                              
                                            </div>  -->                                           
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">#</th>
                                                                <th style="text-align: center;">Type</th>
                                                                <th style="text-align: center;">Description</th>                                                    
                                                                <th style="text-align: center;">Unit Cost</th>
                                                                <th style="text-align: center;">Discount</th>
                                                                <th style="text-align: center;">Quantity</th>
                                                                <th style="text-align: center;">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $LabourSql = "SELECT * FROM tbl_job_labour WHERE job_id= '$JobId' ORDER BY job_labour_id ASC";
                                                                $Lrs=$conn->query($LabourSql);
                                                                
                                                                    while($Lrow =$Lrs->fetch_array())
                                                                    {
                                                                        $job_labour_id = $Lrow[0];
                                                                        $job_fru=$Lrow[2];
                                                                        $labour_discount=$Lrow[3];
                                                                        $labour_name=$Lrow[4];
                                                                        $fru_pay=$Lrow[5];
                                                                        $labour_datetime=$Lrow[6];

                                                                        //////////////////////////////////////
                                                                        $job_fru_paybel = $job_fru * $fru_pay;

                                                                        $discountLabourAmount = ((double)$job_fru_paybel * (double)$labour_discount) / 100;
                                                                        $totalLabourPriceWithDisc = (double)$job_fru_paybel - (double)$discountLabourAmount;

                                                                        $total_job_fru_paybel += $totalLabourPriceWithDisc;

                                                                        //////////////////////////////////////
                                                                                    
                                                            ?>
                                                            <tr>
                                                                <th style="text-align: center;"><?php echo $LabourCount+=1; ?></th>
                                                                <th style="text-align: center;">LABOUR</th>
                                                                <td><?php echo $labour_name; ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($fru_pay,2); ?></td>
                                                                <td style="text-align: center;"><?php echo $labour_discount.'%'; ?></td>
                                                                <td style="text-align: center;"><?php echo $job_fru; ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($totalLabourPriceWithDisc,2); ?></td>
                                                            </tr>

                                                                <?php 
                                                                    $JobPartssql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                    $rsitem=$conn->query($JobPartssql);
                                                                    while($rowitem =$rsitem->fetch_array())
                                                                    {

                                                                        $rowIndex = $rowitem[0];
                                                                        $itemuserId = $rowitem[2];
                                                                        $labourId = $rowitem[3];
                                                                        $itemId = $rowitem[4];
                                                                        $qty = $rowitem[5];
                                                                        $Part_discount = $rowitem[7];
                                                                        $ItemStat = $rowitem[8];
                                                                        $Item_price = (double)$rowitem[9];

                                                                        $part_name=$rowitem[12];

                                                                        /////////////Item Count/////////////////
                                                                        $Item_price_with_qty = $Item_price * $qty;
                                                                        $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                        $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                        $total_part_price += $totalPriceWithDisc;
                                                                        //////////////////////////////
                                                                                
                                                                                
                                                                ?>
                                                                <tr>
                                                                    <th style="text-align: center;"><?php echo $LabourCount+=1; ?></th>
                                                                    <th style="text-align: center;">PART</th>
                                                                    <td style="text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($Item_price,2); ?></td>
                                                                    <td style="text-align: center;"><?php echo $Part_discount.'%'; ?></td>
                                                                    <td style="text-align: center;"><?php echo $qty; ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($totalPriceWithDisc,2); ?></td>
                                                                </tr>

                                                                <?php } ?>

                                                            <?php } ?>

                                                            <?php
                                                                ///////Calculation//////////
                                                                $LabourTotal=$total_job_fru_paybel;
                                                                $ItemTotal=$total_part_price;

                                                                $SubTotal=$LabourTotal+$ItemTotal;

                                                                //Vat
                                                                $VatTotal=($SubTotal*$VAT)/100;
                                                                //Grand Total
                                                                $GrandTotal=$SubTotal-$VatTotal;
                                                                ////////////////////////////
                                                            ?>

                                                            <tr>                                                        
                                                                <td colspan="5" class="border-0"></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b>Labour Total</b></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b><?php echo number_format($LabourTotal,2); ?></b></td>
                                                            </tr>
                                                            <tr>                                                        
                                                                <td colspan="5" class="border-0"></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b>Item Total</b></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b><?php echo number_format($ItemTotal,2); ?></b></td>
                                                            </tr>
                                                            <tr>                                                        
                                                                <td colspan="5" class="border-0"></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b>Sub Total</b></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b><?php echo number_format($SubTotal,2); ?></b></td>
                                                            </tr>
                                                            <?php if($VAT=='0'){ }else{ ?>
                                                            <tr>
                                                                <th colspan="5" class="border-0"></th>                                                        
                                                                <td class="border-0 font-14" style="text-align: right;"><b>Tax Rate (<?php echo $VAT.'%'; ?>)</b></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b><?php echo number_format($VatTotal,2) ?></b></td>
                                                            </tr>
                                                            <?php } ?>
                                                            <tr class="bg-dark text-white">
                                                                <th colspan="5" class="border-0"></th>                                                        
                                                                <td class="border-0 font-14" style="text-align: right;"><b>Grand Total</b></td>
                                                                <td class="border-0 font-14" style="text-align: right;"><b><?php echo number_format($GrandTotal,2); ?></b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>                                            
                                            </div>                                        
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <h5 class="mt-4">Terms And Condition :</h5>
                                                <ul class="pl-3">
                                                    <li><small>All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                                    <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                                    <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>                                            
                                                </ul>
                                            </div>                                        
                                            <div class="col-lg-6 align-self-end">
                                                <div class="w-25 float-right">
                                                    <small>Account Manager</small>
                                                    <img src="assets/images/signature.png" alt="" class="" height="48">
                                                    <p class="border-top">Signature</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                                <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                                            </div>
                                            <div class="col-lg-12 col-xl-4">
                                                <div class="float-right d-print-none">
                                                    <form id="Save-Invoice">
                                                        
                                                        <?php if ($Stat=='1'){?>
                                                            <a href="javascript:window.print()" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
                                                        <?php }else{ ?>
                                                        <input type="hidden" name="job_id" value="<?php echo $JobId; ?>" readonly required>
                                                        <input type="hidden" name="labour_total" value="<?php echo $LabourTotal; ?>" readonly required>
                                                        <input type="hidden" name="item_total" value="<?php echo $ItemTotal; ?>" readonly required>
                                                        <input type="hidden" name="sub_total" value="<?php echo $SubTotal; ?>" readonly required>
                                                        <input type="hidden" name="vat" value="<?php echo $VatTotal; ?>" readonly required>
                                                        <input type="hidden" name="grand_total" value="<?php echo $GrandTotal; ?>" readonly required>
                                                        
                                                            <button type="submit" class="btn btn-primary text-light" id="btn-save-invoice"><i class="fa fa-save"></i> Save Invoice</button>
                                                        <?php } ?>
                                                        <!-- <a href="#" class="btn btn-danger text-light">Cancel</a> -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        
            $(document).on('submit', '#Save-Invoice', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-save-invoice").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"post/save_invoice.php",
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
                           // var id = json.lastId;
                           // alert (id);
                           // window.location.href = "job_form?p="+id;
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-save-invoice").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>


    </body>
</html>