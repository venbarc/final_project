

<!--================================ Start edit_profile.php ======================================== -->
        <!-- Edit Modal 1 button starts here  -->
        <div class="modal fade" id="edit_modal1" tabindex="-1" role="dialog" aria-labelledby="edit_modal1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="edit_modal1Label">Update Personal Information</h5>
                    </div>

                    <form method="post">
                        <div class="modal-body">
                            <div class="row" >
                                <div class="col-sm-6 edit_modal1" >
                                    <label class="form-label"><h6> First name</h6></label>
                                    <input type="text" class="form-control" value="<?php echo $fname ?>" name="fname" required> 
                                    <br>
                                </div>
                                <div class="col-sm-6 edit_modal1" >
                                    <label class="form-label"><h6>Last name</h6></label>
                                    <input type="text" class="form-control" value="<?php echo $lname ?>" name="lname" required> 
                                    <br>
                                </div>
                                <div class="col-sm-6 edit_modal1" >
                                    <label class="form-label"><h6>Contact <span style="font-weight:400; font-size:15px;">(Optional)</span></h6></label>
                                    <input type="text" class="form-control" name="contact" minlength="11" maxlength="11" value="<?php echo (isset($contact) && !empty($contact)) ? htmlspecialchars($contact) : ''; ?>" placeholder="Add Contact">
                                    <br>
                                </div>
                                <div class="col-sm-6 edit_modal1" >
                                    <label class="form-label"><h6>Specialization <span style="font-weight:400; font-size:15px;">(Optional)</span></h6></label>
                                    <input type="text" class="form-control" name="special" value="<?php echo (isset($special) && !empty($special)) ? htmlspecialchars($special) : ''; ?>" placeholder="Add Address">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Update Personal Information" name="submit1">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 1 button End here  -->

        <!-- Edit Modal 2 button starts here  -->
        <div class="modal fade" id="edit_modal2" tabindex="-1" role="dialog" aria-labelledby="edit_modal2Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="edit_modal2Label">Change Email</h5>
                    </div>

                    <form method="post">
                        <div class="modal-body">
                            <div class="row" >
                                <div class="col-sm-12 edit_modal2" >
                                    <label class="form-label"><h6> Email</h6></label>
                                    <input type="email" class="form-control" value="<?php echo $email ?>" name="new_email"  required> 
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Change Email" name="submit2">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 2 button End here  -->

        <!-- Edit Modal 3 button starts here  -->
        <div class="modal fade" id="edit_modal3" tabindex="-1" role="dialog" aria-labelledby="edit_modal3Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="edit_modal3Label">Change Password</h5>
                    </div>
                    
                    <form method="post">
                        <div class="modal-body">
                            <div class="row" >
                                <div class="col-sm-12 edit_modal3" >
                                    <label class="form-label"><h6> Current Password</h6></label>
                                    <input type="password" class="form-control text-danger" name="current_password" placeholder="Current password"  minlength="8" required> 
                                    <br>
                                </div>
                                <div class="col-sm-6 edit_modal3" >
                                    <label class="form-label"><h6> New Password</h6></label>
                                    <input type="password" class="form-control text-danger" name="new_pass" placeholder="New password" minlength="8" required> 
                                    <br>
                                </div>
                                <div class="col-sm-6 edit_modal3" >
                                    <label class="form-label"><h6> Confirm Password</h6></label>
                                    <input type="password" class="form-control text-danger" name="cnew_pass" placeholder="Confirm New password" minlength="8" required> 
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Change Password" name="submit3">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 3 button End here  -->
<!--================================ End edit_profile.php ======================================== -->



<!--================================ Start profile.php ======================================== -->
        <!-- Edit Modal 4 button starts here  -->
        <div class="modal fade" id="edit_modal4" tabindex="-1" role="dialog" aria-labelledby="edit_modal4Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="edit_modal4Label">Upload Image</h5>
                    </div>

                    <form method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div class="profile-img">
                                        <center>
                                            <?php
                                                if(empty($image_upload))
                                                {
                                                    ?>
                                                        <img src="assets/img/profile/default-profile.png">
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                        <img src="<?php echo $image_upload ?>">
                                                    <?php
                                                }
                                            ?>

                                            <br><br>
                                            <input type="file" value="Upload Photo" name="upload_file">

                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_img" class="btn btn-primary">Upload</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 4 button End here  -->
<!--================================ End profile.php ======================================== -->






<!--================================ Start section.php ======================================== -->
        <!-- Edit Modal 6 button starts here  -->
        <div class="modal fade" id="edit_modal6" tabindex="-1" role="dialog" aria-labelledby="edit_modal6Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="edit_modal6Label">Add Subject</h5>
                    </div>

                    <form method="post">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <label class="label-form pb-10" for="subject">Add Subject</label>
                                    <input class="form-control mb-20" type="text" name="add_subject" id="subject" placeholder="Subject here.." required>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_add_subject" class="btn btn-primary">Add</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 6 button End here  -->
<!--================================ End section.php ======================================== -->






<!--================================ Start view_add_quiz.php ======================================== -->
        <!-- Edit Modal 7 button starts here  -->
        <div class="modal fade" id="edit_modal7" tabindex="-1" role="dialog" aria-labelledby="edit_modal7Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="edit_modal7Label">Add Quiz</h5>
                    </div>

                    <form method="post">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Quiz Title -->
                                    <label class="label-form pb-10" for="quiz_title">Quiz Title</label>
                                    <input class="form-control mb-20" type="text" name="quiz_title" id="quiz_title" placeholder="Title here.." required>
                                    <!-- Quiz Description -->
                                    <label class="label-form pb-10" for="quiz_desc">Quiz Description</label>
                                    <input class="form-control mb-20" type="text" name="quiz_description" id="quiz_desc" placeholder="description here.." required>
                                    <!-- Quiz time in minutes  -->
                                    <label class="label-form pb-10" for="quiz_time">Quiz Time(In Minutes)</label>
                                    <input class="form-control mb-20" type="number" name="quiz_time" id="quiz_time" placeholder="Time in minutes here.." min="1" required>
                                    <!-- # of Question  -->
                                    <label class="label-form pb-10" for="num_ques"># of Questions</label>
                                    <input class="form-control mb-20" type="number" name="num_ques" id="num_ques" placeholder="# of questions here.." min="1" required>
                                    <!-- passing score  -->
                                    <label class="label-form pb-10" for="passing">Passing Score (1-100) %</label>
                                    <input class="form-control mb-20" type="number" name="passing" id="passing" placeholder="Passing Score %" min="1" max="100" required>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_add_quiz" class="btn btn-primary">Add</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Modal 7 button End here  -->
<!--================================ End view_add_quiz.php ======================================== -->









