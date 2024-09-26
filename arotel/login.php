<?php
  require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    
    if(isset($_COOKIE['zxadfggh']) && isset($_COOKIE['jyuongga'])){

        $_SESSION['Logged'] = true;
        $_SESSION['email'] = $_COOKIE['zxadfggh'];
        $_SESSION['password'] = base64_decode($_COOKIE['jyuongga']);
                    
    ?>
                    
    <script>
        location.href = 'index';
    </script>
                    
<?php } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('controls/meta.php'); ?>
    </head>

    <body class="account-body">

        <style>
            .accountbg {
                background: url(assets/images/login-image.jpg);
            }
        </style>

        <!-- Log In page -->
        <div class="row vh-100">
            <div class="col-lg-3  pr-0">
                <div class="card mb-0 shadow-none">
                    <div class="card-body">
                        
                        <div class="px-3">
                            <div class="media">
                                <a href="index" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="55" alt="logo" class="my-3"></a>
                                <div class="media-body ml-3 align-self-center">                                                                                                                       
                                    <h4 class="mt-0 mb-1">Login on Frogetor</h4>
                                    <p class="text-muted mb-0">Sign in to continue to Frogetor.</p>
                                </div>
                            </div>                            
                            
                            <form class="form-horizontal my-4" id="login-form" method="POST">
    
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter username">
                                    </div>                                    
                                </div>
    
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-key font-16"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="XXXXXXXX" name="password" id="password">
                                    </div>                                
                                </div>
    
                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                            <label class="custom-control-label" for="remember">Remember my preference</label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6 text-right">
                                        <a href="pages-recoverpw-2.html" class="text-muted font-13"><i class="mdi mdi-lock"></i> Forgot your password?</a>                                    
                                    </div> -->
                                </div>
    
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" name="btn_lg" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                </div>                            
                            </form>
                        </div>

                        <!-- <div class="account-social text-center">
                            <h6 class="my-4">Or Login With</h6>
                            <ul class="list-inline mb-4">
                                <li class="list-inline-item">
                                    <a href="" class="">
                                        <i class="fab fa-facebook-f facebook"></i>
                                    </a>                                    
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="">
                                        <i class="fab fa-twitter twitter"></i>
                                    </a>                                    
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="">
                                        <i class="fab fa-google google"></i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div> -->

                        <!-- <div class="m-3 text-center bg-light p-3 text-primary">
                            <h5 class="">Don't have an account ? </h5>
                            <p class="font-13">Join <span>Frogetor</span> Now</p>
                            <a href="#" class="btn btn-primary btn-round waves-effect waves-light">Free Resister</a>                
                        </div> --> 

                    </div>
                </div>
            </div>
            <div class="col-lg-9 p-0 d-flex justify-content-center">
                <div class="accountbg d-flex align-items-center"> 
                    <div class="account-title text-white text-center">
                        <img src="assets/images/logo-sm.png" alt="" class="thumb-sm">
                        <h4 class="mt-3">Welcome To Frogetor</h4>
                        <div class="border w-25 mx-auto border-primary"></div>
                        <h1 class="">Let's Get Started</h1>
                        <!-- <p class="font-14 mt-3">Don't have an account ? <a href="" class="text-primary">Sign up</a></p> -->
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- End Log In page -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
          $(document).on('submit', '#login-form', function(e){
                e.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url:'controls/login.php',
                    type:'POST',
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                                        
                        var json=JSON.parse(data);
                        if(json.result){
                            location.href="index";
                        }else{
                            Swal.fire({
                                text:json.msg,
                                icon:'error',
                                title:'Warning !'
                            });
                        }
                                        
                                        
                    },
                    error:function(err,xhr,data){
                            alert("err "+data);
                    }



                });


            });
            
        </script>

    </body>
</html>