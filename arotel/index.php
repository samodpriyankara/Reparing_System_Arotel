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
     
    $hour = date ("G");
    $minute = date ("i");
    $second = date ("s");
    //$msg = " Today is " . date ("l, M. d, Y.") . " And the time is " . date ("g:i a");

    if ($hour <= 9 && $minute <= 59 && $second <= 59){
        $greet = "Morning";
        $greetImg ="images/greet/003.png";
        $msg ="Every new day is a chance to change your life.";
        $dayColor ="3px solid rgb(127, 197, 131) ";
        }else if ($hour >= 10 && $hour <= 11 && $minute <= 59 && $second <= 59){
            $greet = "day";
            $greetImg ="images/greet/003.png";
            $msg ="Every new day is a chance to change your life.";
            $dayColor ="3px solid rgb(127, 197, 131) ";
            }else if ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59){
                $greet = "Afternoon";
                $greetImg ="images/greet/002.png";
                $msg ="May this $greet be light, blessed, enlightened, productive and happy.";
                $dayColor ="3px solid rgb(255, 193, 7) ";
            }else if ($hour >= 16 && $hour <= 23 && $minute <= 59 && $second <= 59){
                $greet = "Evening";
                $greetImg ="images/greet/001.png";
                $msg ="Evenings are life’s way of saying that you are closer to your dreams.";
                $dayColor ="3px solid rgb(0, 0, 0) ";
            }else {
                $greet = "welcome";
            }

        

    // echo $greet.$msg;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('controls/meta.php'); ?>
    </head>

    <body onload="startTime()">

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
                            <h4 class="page-title mb-2"><i class="mdi mdi-view-dashboard-outline mr-2"></i>Dashboard</h4>  
                            <div class="">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Welcome to Mobile Device Management</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li> -->
                                    <!-- <li class="breadcrumb-item active">Dashboard-2</li> -->
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
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4 class="mt-0">Hello ! <?php echo $user_name; ?></h4>  
                                                <p class="text-muted">Good <?php echo $greet; ?> !</p>
                                                <p class="text-muted" style="margin-top: -15px;"><?php echo $msg; ?>.</p>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <div class="card mb-0">
                                                            <div class="card-body">
                                                                <div class="float-right">
                                                                    <i class="dripicons-briefcase font-24 text-secondary"></i>
                                                                </div> 
                                                                <span class="badge badge-danger">Opened Jobs</span>
                                                                <h3 class="font-weight-bold">
                                                                    <?php
                                                                        $PendingJobCount=0;
                                                                        $PendingJobCountsql = "SELECT COUNT(*) FROM tbl_job_details WHERE stat='0'";
                                                                        $PendingJobCountresult = mysqli_query($conn, $PendingJobCountsql);
                                                                        $PendingJobCount = mysqli_fetch_assoc($PendingJobCountresult)['COUNT(*)'];
                                                                        echo $PendingJobCount;
                                                                    ?>
                                                                </h3>
                                                                <!-- <p class="mb-0 text-muted text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span>New Sessions Today</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card mb-0">
                                                            <div class="card-body">
                                                                <div class="float-right">
                                                                    <i class="dripicons-user-group  font-24 text-secondary"></i>
                                                                </div> 
                                                                <span class="badge badge-info">Clients</span>
                                                                <h3 class="font-weight-bold">
                                                                    <?php
                                                                        $ClientCount=0;
                                                                        $ClientCountsql = "SELECT COUNT(*) FROM tbl_client";
                                                                        $ClientCountresult = mysqli_query($conn, $ClientCountsql);
                                                                        $ClientCount = mysqli_fetch_assoc($ClientCountresult)['COUNT(*)'];
                                                                        echo $ClientCount;
                                                                    ?>
                                                                </h3>
                                                                <!-- <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i class="mdi mdi-trending-down"></i>1.5%</span> Weekly Avg.Sessions</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card mb-0">
                                                            <div class="card-body">
                                                                <div class="float-right">
                                                                    <i class="dripicons-wallet font-20 text-secondary"></i>
                                                                </div> 
                                                                <span class="badge badge-warning">Invoice</span>
                                                                <h3 class="font-weight-bold">
                                                                    <?php
                                                                        $InvoiceCount=0;
                                                                        $InvoiceCountsql = "SELECT COUNT(*) FROM tbl_invoice_save";
                                                                        $InvoiceCountresult = mysqli_query($conn, $InvoiceCountsql);
                                                                        $InvoiceCount = mysqli_fetch_assoc($InvoiceCountresult)['COUNT(*)'];
                                                                        echo $InvoiceCount;
                                                                    ?>
                                                                </h3>
                                                                <!-- <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card mb-0">
                                                            <div class="card-body">
                                                                <div class="float-right">
                                                                    <i class="dripicons-clock font-20 text-secondary"></i>
                                                                </div> 
                                                                <span class="badge badge-success"><?php echo date('Y-m-d') ?></span>
                                                                <h3 class="font-weight-bold">
                                                                    <span id="txt">00:00:00</span>
                                                                </h3>
                                                                <!-- <p class="mb-0 text-muted text-truncate"><span class="text-success"><i class="mdi mdi-trending-up"></i>10.5%</span> Completions Weekly</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 align-self-center">
                                                <img src="assets/images/dash.svg" alt="" class="img-fluid">
                                            </div>
                                        </div>                                                                              
                                    </div><!--end card-body--> 
                                    <div class="card-body bg-light" style="display: none;">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="media">
                                                    <img src="assets/images/logo-sm.png" height="40" class="mr-4" alt="...">
                                                    <div class="media-body align-self-center">                                                                                                                       
                                                        <p class="mb-0 text-muted">There are many variations of passages 
                                                            of Lorem Ipsum available, but the majority 
                                                            have suffered alteration in some form, by injected
                                                                humour, or randomised words.
                                                        </p>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="col-4 align-self-center text-center">
                                                <button class="btn btn-sm btn-warning">Download Report</button>
                                            </div>
                                        </div>
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div> <!--end col-->                               
                        </div><!--end row-->  
                        <div class="row" style="display: none;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Overview</h4>                                         
                                        <div class="chart-demo dash-apex-chart">
                                            <div id="d2_overview" class="apex-charts"></div>
                                        </div>                                      
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div> <!--end col-->                               
                        </div><!--end row--> 

                        <div class="row" style="display: none;">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Performance Report</h4>
                                        <div class="chart-demo dash-apex-chart">
                                            <div id="d2_performance" class="apex-charts"></div>
                                        </div>
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div> <!--end col--> 
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Users by (Only USA)</h4>
                                        <div id="user_usa" class="dashboard-map"></div>
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div>  <!--end col--> 
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Visits of Males & Females</h4>
                                        <div class="xender-visits mt-4">
                                            <div class="row">                                                
                                                <div class="col-sm-3">
                                                    <i class="fas fa-male"></i> 
                                                </div>
                                                <div class="col-sm-6">                                                    
                                                    <h3 class="font-weight-bold">1254</h3>
                                                    <p class="mb-0 text-muted">Visitors on Site now</p>
                                                </div>
                                                <div class="col-sm-3">                                                    
                                                    <i class="fas fa-female female"></i>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="">
                                            <div id="d2_visitors" class="apex-charts"></div>
                                        </div> 
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-4">
                                                    <h4 class="">5203</h4>
                                                    <p class="mb-0 text-muted font-13 text-truncate">Today's Visits</p>
                                                </div>
                                                <div class="col-4">
                                                    <h4 class="">55203</h4>
                                                    <p class="mb-0 text-muted font-13 text-truncate">Last Week Visits</p>
                                                </div>
                                                <div class="col-4">
                                                    <h4 class="">98020</h4>
                                                    <p class="mb-0 text-muted font-13 text-truncate">Last Month Visits</p>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div>  <!--end col-->     
                        </div><!--end row-->
                        
                        <div class="row" style="display: none;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0">Social Report</h4> 
                                        <div class="table-responsive dash-social">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Network</th>
                                                    <th>Sessions</th>
                                                    <th>Con.Rate</th>                                                    
                                                    <th>Avg.Time</th>
                                                    <th>Bounce Rate</th>
                                                    <th>%Change</th>
                                                </tr><!--end tr-->
                                                </thead>
            
                                                <tbody>
                                                <tr>
                                                    <td><i class="mdi mdi-google text-danger mr-1 font-18"></i>Google</td>
                                                    <td>4541</td>
                                                    <td>3.2%</td>
                                                    <td>3:20</td>
                                                    <td>57.8%</td>
                                                    <td>17.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-yahoo text-info mr-1 font-18"></i>Yahoo</td>
                                                    <td>1522</td>
                                                    <td>4.2%</td>
                                                    <td>4:20</td>
                                                    <td>62.8%</td>
                                                    <td>-12.8% <i class="mdi mdi-arrow-down-drop-circle-outline text-danger ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-web text-info mr-1 font-18"></i>UC Browser</td>
                                                    <td>1292</td>
                                                    <td>3.2%</td>
                                                    <td>5:20</td>
                                                    <td>33.8%</td>
                                                    <td>17.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-facebook text-primary mr-1 font-18"></i>Facebook</td>
                                                    <td>2241</td>
                                                    <td>4.9%</td>
                                                    <td>2:20</td>
                                                    <td>48.8%</td>
                                                    <td>17.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-twitter text-primary mr-1 font-18"></i>Twitter</td>
                                                    <td>6806</td>
                                                    <td>3.2%</td>
                                                    <td>3:20</td>
                                                    <td>57.8%</td>
                                                    <td>-11.8% <i class="mdi mdi-arrow-down-drop-circle-outline text-danger ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-linkedin text-info mr-1 font-18"></i>LinkedIn</td>
                                                    <td>4541</td>
                                                    <td>3.2%</td>
                                                    <td>3:20</td>
                                                    <td>52.8%</td>
                                                    <td>17.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-pinterest text-pink mr-1 font-18"></i>Pinterest</td>
                                                    <td>3542</td>
                                                    <td>8.2%</td>
                                                    <td>6:20</td>
                                                    <td>61.8%</td>
                                                    <td>23.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-google-plus text-danger mr-1 font-18"></i>Google+</td>
                                                    <td>1124</td>
                                                    <td>9.2%</td>
                                                    <td>4:10</td>
                                                    <td>20.8%</td>
                                                    <td>-9.8% <i class="mdi mdi-arrow-down-drop-circle-outline text-danger ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-instagram text-success mr-1 font-18"></i>Instagram</td>
                                                    <td>3521</td>
                                                    <td>1.2%</td>
                                                    <td>6:45</td>
                                                    <td>66.2%</td>
                                                    <td>34.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-whatsapp text-success mr-1 font-18"></i>WhatsApp</td>
                                                    <td>96547</td>
                                                    <td>9.2%</td>
                                                    <td>1:20</td>
                                                    <td>57.8%</td>
                                                    <td>48.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                <tr>
                                                    <td><i class="mdi mdi-google-play text-warning mr-1 font-18"></i>Other</td>
                                                    <td>3214</td>
                                                    <td>6.2%</td>
                                                    <td>4:40</td>
                                                    <td>36.8%</td>
                                                    <td>11.8% <i class="mdi mdi-arrow-up-drop-circle-outline text-success ml-1"></i></td>
                                                </tr><!--end tr-->
                                                                                                
                                                </tbody>
                                            </table>                    
                                        </div>                                         
                                    </div><!--end card-body--> 
                                </div><!--end card--> 
                            </div> <!--end col-->                               
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

        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
        <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
        <script src="https://apexcharts.com/samples/assets/series1000.js"></script>
        <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

        <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <script src="assets/pages/jquery.dashboard-2.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById('txt').innerHTML =
              h + ":" + m + ":" + s;
              var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
            }
        </script>

    </body>
</html>