<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title><?php echo "$fullnames - $smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Profile Settings</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="" name="settings" class="form-horizontal">
								<div class="form-group">
								<?php
								if(isset($_POST['save'])){
									
									if($_POST['sc_fname']==""){
										echo "We need a system name";
									}
									elseif(!$_POST['sc_tel']){
										echo "Oooooops ";
									}
									else {
										
										$sc_fname = $dbconnect->real_escape_string($_POST['sc_fname']);
										$sc_lname = $dbconnect->real_escape_string($_POST['sc_lname']);
										$sc_email = $dbconnect->real_escape_string($_POST['sc_email']);
										$sc_tel = $dbconnect->real_escape_string($_POST['sc_tel']);
										$sc_idno = $dbconnect->real_escape_string($_POST['sc_idno']);
									
										$settings_action = "UPDATE users SET f_name=?, s_name=?, email=?, phone=? WHERE id_no='$sc_idno'";
										
										if($stmt = $dbconnect->prepare($settings_action)){
											$stmt->bind_param('ssss',$sc_fname, $sc_lname, $sc_email, $sc_tel);
											$stmt->execute();
												echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>Hey, $sc_fname, your settings were successfully updated</div>";
										}
										else {
											echo "<div class=\"alert alert-danger alert-dismissable\">
													<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred while updating details</div>";
										}
									
									}
								}
								
								?>
								</div>
								<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label">First Name:</label>
										<div class="col-sm-9"><input type="text" name="sc_fname" value="<?php echo $sfname; ?>" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Last Name: </label>
										<div class="col-sm-9"><input type="text" name="sc_lname" value="<?php echo $ssname; ?>" placeholder="Main System Email Address" class="form-control" name="password"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email Address</label>
										<div class="col-sm-9"><input name="sc_email" type="email" value="<?php echo $semail; ?>" placeholder="placeholder" class="form-control"></div>
									</div>
								</div>
								<div class="col-sm-6">									
									<div class="form-group">
										<label class="col-sm-3 control-label">Phone Number</label>
										<div class="col-sm-9"><input name="sc_tel" type="text" value="<?php echo $sphone; ?>" placeholder="e.g 12345678" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">ID No</label>
										<div class="col-sm-9"><input name="sc_idno" readonly type="text" value="<?php echo $sidno; ?>" class="form-control"></div>
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<!-- <button class="btn btn-white btn-lg" name="cancel" type="submit">CANCEL</button> -->
												<input class="btn btn-primary btn-block" name="sae" type="submit" value="UPDATE PROFILE">
											</div>
										</div>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
				
                 </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                    <h5>Change Password Below <small></small></h5>
                    </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-lg-8">
									<form name="changepass" action="" method="post" class="form-horizontal">	
										<div class="form-group">
											<label class="col-sm-3 control-label" for="oldpass"></label>
											<div class="col-sm-9">
											<?php
											$res='';
											if(isset($_GET['activated'])){
												$res= "<div class=\"alert alert-danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
															You must change the password first.
														</div>";
											}
											if(isset($_POST['changePass'])){
											if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['newpassc'])){
													$res= "<div class=\"alert alert-danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
															Oops! These fields are required.
														</div>";
												}
												else{
													$oldpass = $_POST['oldpass'];
													$newpass = $_POST['newpass'];
													$newpassc = $_POST['newpassc'];
												function validatePassword($newpass) {
												  // Password length must be at least 8 characters
												  if (strlen($newpass) < 6) {
													return false;
												  }

												// Password must contain at least one uppercase letter
												  

												  // Password must contain at least one number
												  if (!preg_match('/[0-9]/', $newpass)) {
													return false;
												  }
												  // Password must not contain any special characters
												  if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpass)) {
													return false;
												  }

												 /*  Password must contain at least one lowercase letter
												  if (!preg_match('/[a-z]/', $newpass)) {
													return false;
												  }

												 if (!preg_match('/[A-Z]/', $newpass)) {
													return false;
												  }

												  */

												  // If all checks pass, password is valid
												  return true;
												}	
											if (validatePassword($newpass)) {		
													$theoldpass = hash('sha256', $oldpass);
													$thenewpass = hash('sha256', $newpass);
													$getoldpass = mysqli_query($dbconnect, "SELECT password FROM tbl_users WHERE id_no='$sidno'");
													$gpass = mysqli_fetch_array($getoldpass);
													$oldpassc =$gpass['password'];
													
													if($theoldpass != $oldpassc){
														$res= "<div class=\"alert alert-danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
															Old password does not match.
														</div>";
													}
													else{
														if($newpass != $newpassc){
															$res= "<div class=\"alert alert-f=danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
															Your new passwords don't match. Check and confirm it.
														</div>";
														}
														else {
															if($stmt = $dbconnect->prepare("UPDATE tbl_users SET password=? WHERE id_no='$sidno'")){
																$stmt->bind_param('s',$thenewpass);
																$stmt->execute();
																$res= "<div class=\"alert alert-success alert-dismissable\">
																		<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>Password changed successfully.
																	</div>";
																
																
															}
															else {
																$res= "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An error occurred while changing password.
																</div>";
															}
														}
													}
												
												}else{
												$res= "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>password does not meet the system password policy.
																</div>";
											}
												
											}
											}echo $res;
											
											?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="oldpass">Old Password:</label>
											<div class="col-sm-9">
												<input type="password" name="oldpass" class="form-control" />
												<span><i>Enter your old password to confirm it is you</i></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="oldpass">New Password:</label>
											<div class="col-sm-9">
												<input type="password" name="newpass" class="form-control" />
												<span><i>Enter your password atleast six (6) characters</i></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="oldpass">Confirm Password:</label>
											<div class="col-sm-9">
												<input type="password" name="newpassc" class="form-control" />
												<span><i>Re-enter your password for confirmation purposes</i></span>
											</div>
										</div>
										<div class="form-group">
											<div class="hr-line-dashed"></div>
											<label for="submit" class="col-sm-3"></label>
											<div class="col-sm-9">
												<button type="submit" name="changePass" title="Change Password" class="btn btn-block btn-primary"><i class="fa fa-lock"></i> CHANGE PASSWORD</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-lg-4">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <i class="fa fa-warning"></i> Password policy
                                        </div>
                                        <div class="panel-body">
                                            <p>
											<ul>
												<li>Your old password is needed for confirmation</li>
												<li>Your password must be atleast six (6) characters a combination of alphanumeric characters</li>
												<li>Make sure you confirm your new password</li>
												<li>Your Password must contain at least one lowercase letter</li>
												<li>Your Password must contain at least one uppercase letter</li>
												<li>Your Password must not contain any special characters</li>
											</ul>
											</p>
                                        </div>
                                    </div>
								</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
