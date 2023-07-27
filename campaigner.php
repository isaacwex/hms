<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Campaigner Settings - <?php echo $smart_name; ?></title>
	
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
                            <h5>Edit  Settings <small>Wonderful</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="" name="settings" class="form-horizontal">
								<div class="form-group">
								<?php
								if(isset($_POST['save'])){
									
									if($_POST['smartName']==""){
										echo "We need a system name";
									}
									elseif(!$_POST['campaigner']){
										echo "Oops! We need a campaigner name ";
									}
									else {
										$license_status = "";
										$inst_date = date('d/m/Y');
										$smartName = $dbconnect->real_escape_string($_POST['smartName']);
										$smartSlogan = $dbconnect->real_escape_string($_POST['smartSlogan']);
										$campaigner = $dbconnect->real_escape_string($_POST['campaigner']);
										$ca_shortName = $dbconnect->real_escape_string($_POST['ca_shortName']);
										$camp_location = $dbconnect->real_escape_string($_POST['camp_location']);
										$seatName = $dbconnect->real_escape_string($_POST['seatName']);
										$c_reply = $dbconnect->real_escape_string($_POST['custom_reply']);
										//$licenseStatus = $dbconnect->real_escape_string($_POST['license_status']);
									
										$whatAction = mysqli_query($dbconnect,"SELECT * FROM tbl_settings");
										$cAction = mysqli_num_rows($whatAction);
										
										if($cAction >= 1){											
											$settings_action = "UPDATE tbl_settings SET system_name=?, slogan=?, campaigner_name=?, campaigner_short_name=?, campaign_location=?, seat=?, l_status=?, custom_reply_msg=? WHERE settings_id='1'";
										}
										else {
											$settings_action = "INSERT INTO tbl_settings (system_name,slogan,campaigner_name,campaigner_short_name,campaign_location,seat,l_status,inst_date,custom_reply_msg) VALUES (?,?,?,?,?,?,?,'$inst_date')";
										}
									
										if($stmt = $dbconnect->prepare($settings_action)){
											$stmt->bind_param('ssssssss',$smartName, $smartSlogan, $campaigner, $ca_shortName, $camp_location, $seatName, $license_status,$c_reply);
											$stmt->execute();
											
											echo "<div style=\"color:green\">Hey, $sfname, you successfully updated the settings for your system</div>";
										}
										else {
											echo "<div style=\"color:red\">Oops seems there is a very big problem. Anyway don't worry $dbconnect->error</div>";
										}
									
									}
								}
								
								?>
								</div>
								<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label">System Name:</label>
										<div class="col-sm-9"><input type="text" name="smartName" value="<?php echo $smart_name; ?>" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Slogan:</label>
										<div class="col-sm-9"><input type="text" name="smartSlogan" value="<?php echo $slogan; ?>" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"> Name: </label>
										<div class="col-sm-9"><input type="text" name="campaigner" value="<?php echo $campaigner_name; ?>" placeholder="Main System Email Address" class="form-control" name="password"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"> Short Name</label>
										<div class="col-sm-9"><input name="ca_shortName" type="text" value="<?php echo $camp_short_name; ?>" placeholder="placeholder" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Campaign Location</label>
										<div class="col-sm-9"><input name="camp_location" type="text" value="<?php echo $campaign_location; ?>" placeholder="e.g 40 - 00100" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Seat Name</label>
										<div class="col-sm-9"><input name="seatName" type="text" value="<?php echo $seat_name; ?>" placeholder="e.g 40 - 00100" class="form-control"></div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Why? </label>
										<div class="col-sm-9">
											<textarea name="sysmission" class="form-control" placeholder="What do you want to do for your people that has never been done"></textarea> <span class="help-block m-b-none"><i>This entails the your <b>MISSION</b>. Convince them.</i></span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label">Vision</label>
										<div class="col-sm-9">
											<textarea name="sysvision" class="form-control" placeholder="Where do you want to take us as our <?php echo $seat_name; ?>"></textarea> <span class="help-block m-b-none"><i>Do you have a <b>VISION</b>?Well, bring it on and work it out (must not exceed 300 characters)</i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Custom Reply Message</label>
										<div class="col-sm-9">
											<textarea name="custom_reply" class="form-control" placeholder="Type your Custom Reply Message <?php echo $seat_name; ?>"><?php echo "$custom_msg"; ?></textarea> <span class="help-block m-b-none"><i>Do you have a <b>VISION</b>?Well, bring it on and work it out (must not exceed 300 characters)</i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">License Status</label>
										<div class="col-sm-9"><input name="license_status" type="text" value="<?php echo $license; ?>" disabled placeholder="e.g 40 - 00100" class="form-control"></div>
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="hr-line-dashed"></div>
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-2">
												<!-- <button class="btn btn-white btn-lg" name="cancel" type="submit">CANCEL</button> -->
												<input class="btn btn-primary btn-lg" name="save" type="submit" value="SUBMIT CHANGES">
											</div>
										</div>
									</div>
								</div>
                            </form>
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
