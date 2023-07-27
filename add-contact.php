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
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							<span><a href="contacts.php"><button class="btn btn-primary" type="button"><i class="fa fa-eye"></i>&nbsp;&nbsp;<span class="bold"> View Contacts</span></button></a></span>
							<span><button class="btn btn-success " data-toggle="modal" data-target="#bulkcontact" type="button"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload ContactS</span></button></span>
							
							<!-- Well start --->
							<?php include 'modals/bulk-contact.php';?>
						</p>
							
						</div>				
					</div>				
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Contact</h5>
						</div>
                        <div class="ibox-content">
                           
						    <div class="modal-body">
											<div class="row">
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['new-contact'])){
														if(empty($_POST['fullNames'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Full names are required.
																</div>";
														}
														
														else {
															$cfullnames = $dbconnect->real_escape_string($_POST['fullNames']);
															$cphone = $dbconnect->real_escape_string($_POST['phoneNumber']);
															$cidno = $dbconnect->real_escape_string($_POST['IDNo']);
															$cgender = $dbconnect->real_escape_string($_POST['gender']);
															$caddress = $dbconnect->real_escape_string($_POST['address']);
															$cvillage = $dbconnect->real_escape_string($_POST['village']);
															$csublocation = $dbconnect->real_escape_string($_POST['sublocation']);
															$clocation = $dbconnect->real_escape_string($_POST['location']);
															$cward = $dbconnect->real_escape_string($_POST['ward']);
															$pstation = $dbconnect->real_escape_string($_POST['pstation']);
															$scsubcounty = $dbconnect->real_escape_string($_POST['subcounty']);
															$ccounty = $dbconnect->real_escape_string($_POST['county']);
															
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts WHERE phone_no='$cphone'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('That contact already exists. <?php echo "$dbconnect->error()";?>');
																			window.location = 'contacts.php';
																		</script>	
																	<?php
																
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_contacts (id_no, names, phone_no, village, sublocation, location, ward, pstation, subcounty, county, gender, address) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssssss',$cidno, $cfullnames, $cphone, $cvillage, $csublocation, $clocation, $cward,$pstation, $scsubcounty, $ccounty, $cgender, $caddress);
																	$stmt->execute();
																	
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'add-contact.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																	
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'contacts.php';
																			</script>	
																	<?php
																	
																}
															}
															
														}
														
													}
												?>
												</div>
												
													<div class="col-sm-6">
														<div class="form-group">
															<label>Full Names</label>
															<input type="text" name="fullNames" placeholder="Full Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phoneNumber" required placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No (National ID)</label>
															<input type="text" name="IDNo" placeholder="Enter ID Number" class="form-control">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<select name="gender" class="form-control">
																<option value="">Choose Gender</option>
																<option value="Female">Female</option>
																<option value="Male">Male</option>
															</select>
														</div>
														<div class="form-group">
															<label>Address</label>
															<textarea class="form-control" name="address" placeholder="Enter Postal Address"></textarea>
														</div>
														<div class="form-group">
															<label>Village</label>
															<input type="text" name="village" placeholder="Enter Village Name" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Sub Location</label>
															<input type="text" name="sublocation" placeholder="Sub Location" class="form-control">
														</div>
														<div class="form-group">
															<label>Location</label>
															<input type="text" name="location" placeholder="Location" class="form-control">
														</div>
														<div class="form-group">
															<label>Sub County</label>
															<select name="subcounty" required class="form-control" required>
																<option value="" selected="selected">Choose Sub County</option>
																<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='2'");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$loctype = $gal['location_id'];
																	$locname = $gal['location_name'];
																	
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
														<div class="form-group">
															<label>Ward</label>
															<select name="ward" class="form-control">
															<option value="" selected="selected">Choose Ward</option>
																<?php
																
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$loctype = $gal['location_id'];
																	$locname = $gal['location_name'];
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
														
															<div class="form-group">
															<label>Polling Station </label>
															<select name="ward" class="form-control">
															<option value="" name="pstation" selected="selected">Choose Polling Station</option>
																<?php
																
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='6'");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$loctype = $gal['location_id'];
																	$locname = $gal['location_name'];
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
																					
														<div class="form-group">
															<label>County</label>
															<select name="county" required class="form-control" required>
																
																<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='1'");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$loctype = $gal['location_type'];
																	$locname = $gal['location_name'];
																	
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<button name="new-contact" class="btn btn-lg btn-primary" type="submit">Add Contact</button>
														</div>														
													</div>													
												</form>
											</div>
                                        </div>
						</div>
					 </div>
                </div>
				</div>

            <div class="row">
               <div class="col-sm-3">
			   </div>
               <div class="col-sm-6">
					<a href="contacts.php"><button type="button" title="Contact List" class="btn btn-block btn-primary"><i class="fa fa-list"></i> VIEW ALL CONTACTS</button></a>
				</div>
				<div class="col-sm-3">
			   </div>
            </div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
