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
                            <h4 class="page-title mb-2"><i class="mdi mdi-format-list-bulleted mr-2"></i>Items</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="new_job">Create Job</a></li> -->
                                    <li class="breadcrumb-item active">Items</li>
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
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">Item Form</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        <form id="Add-Item" method="POST">
                                            <div class="row">
                                                
                                                <div class="col-md-6 form-group">
                                                    <label>Part Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="part_number" placeholder="ABC85954SE" required>
                                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Part Name <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="part_name" placeholder="Battry" required>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Part Location</label>
                                                    <input type="text" class="form-control" name="part_location" placeholder="Top of locker">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Remark</label>
                                                    <input type="text" class="form-control" name="part_remark" placeholder="Write about this item.....">
                                                </div>

                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary" id="btn-add-item">Add Item</button>
                                        </form>                                           
                                    </div><!--end card-body-->
                                </div><!--end card-->


                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title" style="font-size: 20px;">Items</h4>
                                        <!-- <p class="text-muted mb-4">Basic example to demonstrate Bootstrap’s form styles.</p>  -->
                                        <hr>
                                        
                                        <table id="Item-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Part Name</th>
                                                <th>Part Location</th>
                                                <th>Part Number</th>
                                                <th>Remark</th>
                                                <th>Registration Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php

                                                $sql = "SELECT * FROM `tbl_item`";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $ItemId=$row[0];
                                                    $PartName=$row[1];
                                                    $PartLocation=$row[2];
                                                    $PartNumber=$row[3];
                                                    $PartRemark=$row[4];
                                                    $PartStat=$row[5];
                                                    $PartDateTime=$row[6];
                                            ?>
                                            <tr>
                                                <td><?php echo $ItemId; ?></td>
                                                <td><?php echo $PartName; ?></td>
                                                <td><?php echo $PartLocation; ?></td>
                                                <td><?php echo $PartNumber; ?></td>
                                                <td><?php echo $PartRemark; ?></td>
                                                <td><?php echo $PartDateTime; ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="" data-toggle="modal" data-target="#exampleModalCenter<?php echo $ItemId; ?>"><i class="fa fa-pen-square fa-2x" style="color: #000;"></i></a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="" data-toggle="modal" data-target="#exampleModalCenterPriceBadgeView<?php echo $ItemId; ?>"><i class="icon-control-play" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="View Price Batches"><i class="fa fa-play fa-2x" style="color: #000;"></i></a>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $ItemId; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $PartName; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form id="Update-Item" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $ItemId; ?>" required>
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="part_name">Part Name <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="part_name" id="part_name_update_<?php echo $ItemId; ?>" placeholder="Part Name" value="<?php echo $PartName; ?>" onPaste="textPaste('part_name_update_<?php echo $ItemId; ?>')" onkeypress="return blockSpecialChar(event)" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                              <div class="form-group">
                                                                                <label for="part_number">Part Number <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="part_number" id="part_number_update_<?php echo $ItemId; ?>" onPaste="textPaste('part_number_update_<?php echo $ItemId; ?>')" placeholder="Part Number" value="<?php echo $PartNumber; ?>" onkeypress="return blockSpecialChar(event)" required>
                                                                              </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                              <div class="form-group">
                                                                                <label for="part_location">Part Location </label>
                                                                                <input type="text" class="form-control" name="part_location" id="part_location" placeholder="Part Location" value="<?php echo $PartLocation; ?>">
                                                                              </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12">
                                                                              <div class="form-group">
                                                                                <label for="part_remark">Remark </label>
                                                                                <input type="text" class="form-control" name="part_remark" id="part_remark" placeholder="Remark" value="<?php echo $PartRemark; ?>">
                                                                              </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button> -->
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" id="btn-update-item">Save changes</button>
                                                              </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>



                                            <?php } ?>
                                            </tbody>
                                        </table>

                                    </div><!--end card-body-->
                                </div><!--end card-->


                                <?php

                                    $Batchsql = "SELECT * FROM tbl_item ORDER BY item_id DESC";
                                    $Brs=$conn->query($Batchsql);
                                    while($Brow =$Brs->fetch_array())
                                    {
                                        $Batchpart_id = $Brow[0];
                                        $Batchpart_name = $Brow[1];
                                                            
                                ?>

                                <!--Price batch View Modal -->
                                <div class="modal fade" id="exampleModalCenterPriceBadgeView<?php echo $Batchpart_id; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">View Price Batchs For <?php echo $Batchpart_name; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="card-status bg-blue"></div>
                                                <table class="table table-hover table-vcenter table-striped" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>GRN</th>
                                                            <th>Price Batch Label</th>
                                                            <th><font style="float: right;">Part Cost (.Rs)</font></th>
                                                            <th><font style="float: right;">Part Selling Price (.Rs)</font></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $PriceBatchCount=1;
                                                        $PriceBatchsql = "SELECT * FROM tbl_item_price_batch WHERE item_id='$Batchpart_id' ";
                                                        $PBrs=$conn->query($PriceBatchsql);
                                                        while($PBrow =$PBrs->fetch_array())
                                                        {
                                                            $PriceBatchGRN = $PBrow[2];
                                                            $PriceBatchLabel = $PBrow[6];
                                                            $PriceBatchCost = (double)$PBrow[3];
                                                            $PriceBatchSelling = (double)$PBrow[4];                
                                                    ?>

                                                        <tr>
                                                            <td><?php echo $PriceBatchCount+=1; ?></td>
                                                            <td><?php echo $PriceBatchGRN; ?></td>
                                                            <td><?php echo $PriceBatchLabel; ?></td>
                                                            <td><font style="float: right;"><?php echo number_format($PriceBatchCost,2); ?></font></td>
                                                            <td><font style="float: right;"><?php echo number_format($PriceBatchSelling,2); ?></font></td>
                                                        </tr>

                                                    <?php } ?>

                                                    </tbody>
                                                </table>


                                                </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            $(document).ready( function () {
                $('#Item-table').DataTable({
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
        
            $(document).on('submit', '#Add-Item', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-add-item").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"post/add_item.php",
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
                           // window.location.href = "job_card?p="+id;
                           location.reload();
                            
                        }else{
                            $("#danger_alert").addClass('show');
                            setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                            $("#btn-add-item").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

        <script>
        
            $(document).on('submit', '#Update-Item', function(e){
            e.preventDefault(); //stop default form submission

            $("#btn-update-item").attr("disabled",true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                
                    beforeSend : function() {
                        $("#progress_alert").addClass('show'); 

                    },

                    url:"post/update_item.php",
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
                            $("#btn-update-item").attr("disabled",false);
                        }
                        
                    }

                });

            return false;
            });
        </script>

    </body>
</html>