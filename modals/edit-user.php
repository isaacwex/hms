<div class="modal inmodal" id="edit<?php echo $u_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit <?php echo $allNames; ?></h4>
                                            <small class="font-bold">You can now edit user information on <?php echo $smart_name; ?>.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['update-user'])){
														if(empty($_POST['userid'])){
															echo "We need a user account";
														}
														elseif(empty($_POST['IDNo'])){
															echo "We need an IDNo.";
														}
														else {
															$user_id = $dbconnect->real_escape_string($_POST['u_id']);
															$firstNames = $dbconnect->real_escape_string($_POST['f_name']);
															$surname = $dbconnect->real_escape_string($_POST['s_name']);
															$cphone = $dbconnect->real_escape_string($_POST['phoneNumber']);
															$cidno = $dbconnect->real_escape_string($_POST['IDNo']);
															$cemaid = $dbconnect->real_escape_string($_POST['email']);
															$ccounty = $dbconnect->real_escape_string($_POST['county']);
																														
															$update_user = "UPDATE users SET f_name=?, s_name=?, phone=?, email=?, id_no=? WHERE id='$user_id'";
															if($stmt = $dbconnect->prepare($update_user)) {
																$stmt->bind_param('sssssssssss',$firstNames, $surname, $cphone, $cemaid, $cidno);
																$stmt->execute();
																
																?>
																	<script>
																		alert('User updated successfully<?php echo "$dbconnect->error()";?>');
																		window.location = 'users.php';
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
														<input type="hidden" name="userid" value="<?php echo $u_id; ?>" placeholder="Full Names" class="form-control">
														<div class="form-group">
															<label>First Name</label>
															<input type="text" name="firstName" value="<?php echo $f_name; ?>" placeholder="First Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Last Name</label>
															<input type="text" name="lastName" value="<?php echo $s_name; ?>" placeholder="Last  Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phoneNumber" required value="<?php echo $phoneNo; ?>" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No (National ID)</label>
															<input type="text" name="IDNo" value="<?php echo $idnum; ?>" placeholder="Enter ID Number" class="form-control">
														</div>
												</div>
												<div class="col-sm-6">
														<div class="form-group">
															<label>Email Address</label>
															<input type="text" class="form-control" name="emailaddress" placeholder="Enter Email Address" value="<?php echo $emailad;?>" />
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
															<input name="update-user" class="btn btn-md btn-success" type="submit" value="Update User">
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