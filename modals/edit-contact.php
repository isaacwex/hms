<div class="modal inmodal" id="editmain<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit <?php echo $names; ?> Contact</h4>
                                            <small class="font-bold">You can now edit a personal contact on <?php echo $smart_name; ?>.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['update-contact'])){
														if(empty($_POST['fullNames'])){
															echo "We need full names";
														}
														elseif(empty($_POST['IDNo'])){
															echo "We need an IDNo.";
														}
														else {
															$cwa_id = $dbconnect->real_escape_string($_POST['cwa_id']);
															$cfullnames = $dbconnect->real_escape_string($_POST['fullNames']);
															$cphone = $dbconnect->real_escape_string($_POST['phoneNumber']);
															$cidno = $dbconnect->real_escape_string($_POST['IDNo']);
															$cgender = $dbconnect->real_escape_string($_POST['gender']);
															$caddress = $dbconnect->real_escape_string($_POST['address']);
															$cvillage = $dbconnect->real_escape_string($_POST['village']);
															$csublocation = $dbconnect->real_escape_string($_POST['sublocation']);
															$clocation = $dbconnect->real_escape_string($_POST['location']);
															$cward = $dbconnect->real_escape_string($_POST['ward']);
															$cpstation = $dbconnect->real_escape_string($_POST['pstation']);
															$scsubcounty = $dbconnect->real_escape_string($_POST['subcounty']);
															$ccounty = $dbconnect->real_escape_string($_POST['county']);
																														
															$update_person = "UPDATE tbl_contacts SET id_no=?, names=?, phone_no=?, village=?, sublocation=?, location=?, pstation=?, ward=?, subcounty=?, county=?, gender=?, address=? WHERE contact_id='$cwa_id'";
															if($stmt = $dbconnect->prepare($update_person)) {
																$stmt->bind_param('ssssssssssss',$cidno, $cfullnames, $cphone, $cvillage, $csublocation, $clocation,$cpstation, $cward, $scsubcounty, $ccounty, $cgender, $caddress);
																$stmt->execute();
																
																?>
																	<script>
																		alert('Contact updated successfully<?php echo "$dbconnect->error()";?>');
																		window.location = 'contacts.php';
																	</script>	
																<?php
															}
															else {
																?>
																
																	<script>
																	 alert('OOOOOPS <?php echo "$dbconnect->error()"; ?>');
																	window.location = 'contacts.php';
																		</script>	
																<?php
																
															}
															
														}
														
													}
												?>
												<br />
												</div>
												<div class="col-sm-6">
													<form role="form" method="post">														
														<input type="hidden" name="cwa_id" value="<?php echo $c_id; ?>" placeholder="Full Names" class="form-control">
														<div class="form-group">
															<label>Full Names <?php echo $c_id;?></label>
															<input type="text" name="fullNames" value="<?php echo $names; ?>" placeholder="Full Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phoneNumber" required value="<?php echo $phonenumber; ?>" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No (National ID)</label>
															<input type="text" name="IDNo" value="<?php echo $idnumber; ?>" placeholder="Enter ID Number" class="form-control">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<select name="gender" class="form-control" required>
																<?php
																if(empty($cgendered)){	?>																
																	<option value="">Choose Gender</option>
																	<?php
																}
																else {
																	?>
																	<option selected value="<?php echo $cgendered;?>"><?php echo $cgendered;?></option>
																	<?php
																}
																?>
																<option value="Female">Female</option>
																<option value="Male">Male</option>
															</select>
														</div>
														<div class="form-group">
															<label>Address</label>
															<textarea class="form-control" name="address" placeholder="Enter Postal Address"><?php echo $c_address;?></textarea>
														</div>
														<div class="form-group">
															<label>Village</label>
															<input type="text" name="village" placeholder="Enter Village Name" value="<?php echo $c_village;?>"  class="form-control">
														</div>
												</div>
												<div class="col-sm-6">
														<div class="form-group">
															<label>Sub Location</label>
															<input type="text" name="sublocation" value="<?php echo $slocation; ?>" placeholder="Sub Location" class="form-control">
														</div>
														<div class="form-group">
															<label>Location</label>
															<input type="text" name="location" placeholder="Location" value="<?php echo $sc_location; ?>" class="form-control">
														</div>											
														
														<div class="form-group">
															<label>Polling Station</label>
															<select name="pstation" class="form-control" >
																<?php
																if(empty($pstation)){	?>																
																	<option value="">Choose Polling Station</option>
																	<?php
																}
																else {
																	?>
																<option selected value="<?php echo $pstation;?>"><?php echo $pstation_name;?>(assigned)</option>
																	<?php
																}
																
																$getallps = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='6'");
																while($galps = mysqli_fetch_array($getallps)){
																	$loctype = $galps['location_id'];
																	$locname = $galps['location_name'];
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>		
														<div class="form-group">
														
															<div class="form-group">
															<label>Ward</label>
															<select name="ward" class="form-control" >
																<?php
																if(empty($ward)){	?>																
																	<option value="">Choose Ward</option>
																	<?php
																}
																else {
																	?>
																	<option selected value="<?php echo $ward;?>"><?php echo $ward_name;?>(assigned)</option>
																	<?php
																}
																
																$getallwards = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
																while($gal = mysqli_fetch_array($getallwards)){
																	$loctype = $gal['location_id'];
																	$locname = $gal['location_name'];
																	?>
																	<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
															
														</div>									
														<div class="form-group">
															<label>Sub County</label>
															<select name="subcounty" class="form-control" >
																<?php
																if(empty($sub_county)){	?>																
																	<option value="">Choose subcounty</option>
																	<?php
																}
																else {
																	?>
																	<option selected value="<?php echo $sub_county;?>"><?php echo $sub_county_name;?>(assigned)</option>
																	<?php
																}
																
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
															<label>County</label>
															<select name="county" class="form-control" required>
																<?php
																if(empty($county)){	?>																
																	<option value="">Choose County</option>
																	<?php
																}
																else {
																	?>
																	<option selected value="<?php echo $county;?>"><?php echo $county_name;?>(assigned)</option>
																	<?php
																}
																
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
														<!-- <div class="form-group">
															<label>Upload Picture:</label>
															<input type="file" class="form-control">
														</div> -->
														
														<div class="form-group">
															<input name="update-contact" class="btn btn-md btn-success" type="submit" value="Update Contact">
														</div>
														</form>
													</div>
											</div>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>