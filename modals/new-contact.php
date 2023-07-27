<div class="modal inmodal" id="newcontact" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Contact to <?php echo $smart_name; ?></h4>
                                            <small class="font-bold">To campaign better and efficient, please enter your contacts one by one and save.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['new-contact'])){
														if(empty($_POST['fullNames'])){
															echo "We need full names";
														}
														elseif(empty($_POST['IDNo'])){
															echo "We need an IDNo.";
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
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_contacts (id_no, names, phone_no, village, sublocation, location, ward, subcounty, county, gender, address) VALUES (?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('sssssssssss',$cidno, $cfullnames, $cphone, $cvillage, $csublocation, $clocation, $cward, $scsubcounty, $ccounty, $cgender, $caddress);
																	$stmt->execute();
																	
																	?>
																		<script>
																			alert('Submitted targets successfully updatedb<?php echo "$dbconnect->error()";?>');
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
														
													}
												?>
												<br />
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
															<label>Ward</label>
															<input type="text" name="ward" placeholder="Ward" class="form-control">
														</div>									
														<div class="form-group">
															<label>Sub County</label>
															<select name="subcounty" required class="form-control" required>
																<option selected="selected">Choose Sub County</option>
																<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='2'");
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
															<label>County</label>
															<select name="county" required class="form-control" required>
																<option selected="selected">Choose County</option>
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
										<div class="modal-footer">
										</div>
                                    </div>
                                </div>
                            </div>