                
                <div class="sidebar-user media">

                    <?php
                        $checkProfilePicCount = $conn->query("SELECT count(*) FROM users_profile_pic WHERE user_id='$user_id'");
                        if($cppcRS = $checkProfilePicCount->fetch_array()){
                        $ProfilePicCount = (int)$cppcRS[0];
                        }
                            if($ProfilePicCount == 0){
                    ?>
                            <img alt="image" src="assets/images/profile.jpg" style="width: 128px; height: 128px; object-fit: cover;" class="rounded-circle img-thumbnail mb-1">
                    <?php }else{ ?>
                    <?php
                        $getUserProPic=$conn->query("SELECT profile_image FROM users_profile_pic WHERE user_id='$user_id' ");
                        if($gunRs = $getUserProPic->fetch_array()){
                                                                            
                            $ProPic = $gunRs[0];
                    ?>
                            <img alt="image" src="user_profile_pic/<?php echo $ProPic; ?>" style="width: 54px; height: 54px; object-fit: cover;" class="rounded-circle img-thumbnail mb-1">
                        <?php } ?>
                    <?php } ?>

                    <!-- <img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle img-thumbnail mb-1"> -->


                    <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
                    <div class="media-body">
                        <h5 class="text-light"><?php echo $user_name; ?></h5>
                        <ul class="list-unstyled list-inline mb-0 mt-2">
                            <li class="list-inline-item">
                                <a href="index" class=""><i class="mdi mdi-account text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="settings" class=""><i class="mdi mdi-settings text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="signout" class=""><i class="mdi mdi-power text-danger"></i></a>
                            </li>
                        </ul>
                    </div>                    
                </div>