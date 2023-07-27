<div class="modal inmodal" id="update<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Patient <strong><?php echo "$fnames $lnames"; ?></strong></h4>
                                            <small class="font-bold">You can now edit patient details on <?php echo $smart_name; ?>.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['update-patient'])){
														if(empty($_POST['firstname'])){
															echo "We need first name names";
														}
														elseif(empty($_POST['IDNo'])){
															echo "We need an IDNo.";
														}
														else {
															$cwa_id = $dbconnect->real_escape_string($_POST['cwa_id']);
															$ufirstname = $dbconnect->real_escape_string($_POST['firstname']);
															$ulastname = $dbconnect->real_escape_string($_POST['lastname']);
															$uphone = $dbconnect->real_escape_string($_POST['phoneNumber']);
															$uidno = $dbconnect->real_escape_string($_POST['IDNo']);
															$ugender = $dbconnect->real_escape_string($_POST['gender']);
															$udob = $dbconnect->real_escape_string($_POST['dob']);
															$ureside = $dbconnect->real_escape_string($_POST['residence']);
																														
															$updatePatient = "UPDATE tbl_registry SET f_name=?, l_name=?, phone_no=?, gender=?,  dob=?, residence=? WHERE reg_no='$cwa_id'";
															if($stmt = $dbconnect->prepare($updatePatient)) {
																$stmt->bind_param('ssssss',$ufirstname, $ulastname, $uphone, $ugender, $udob, $ureside);
																$stmt->execute();
																
																?>
																	<script>
																		alert('Patient Record updated successfully<?php echo "$dbconnect->error()";?>');
																		window.location = 'registry.php';
																	</script>	
																<?php
															}
															else {
																?>
																
																	<script>
																	 alert('Ooops! <?php echo "$dbconnect->error()"; ?>');
																	window.location = 'registry.php';
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
															<label>First Name</label>
															<input type="text" name="firstname" value="<?php echo $fnames; ?>" placeholder="Full Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Last Name</label>
															<input type="text" name="lastname" value="<?php echo $lnames; ?>" placeholder="Sub Location" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phoneNumber" required value="<?php echo $phonenumber; ?>" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No (National ID)</label>
															<input type="text" name="IDNo" value="<?php echo $id_number; ?>" placeholder="Enter ID Number" class="form-control">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<select name="gender" class="form-control" required>
																<?php
																if(empty($gender)){	?>																
																	<option value="">Choose Gender</option>
																	<?php
																}
																else {
																	?>
																	<option selected value="<?php echo $gender;?>"><?php echo $gender;?></option>
																	<?php
																}
																if($gender == "Male"){
																	?>
																	<option value="Female">Female</option>
																	<?php
																}
																else { ?>
																	<option value="Male">Male</option>
																	<?php																
																}
																
																?>
																
															</select>
														</div>
														<div class="form-group">
															<label>New Visit Date</label>
															<input type="date" name="visitdate" placeholder="Visit date" value="<?php echo $visit_date; ?>" class="form-control">
														</div>
												</div>
												<div class="col-sm-6">
														<div class="form-group">
															<label>Outpatient Number</label>
															<input type="text" name="opno" readonly value="<?php echo $opno; ?>" placeholder="Sub Location" class="form-control">
														</div>
														<div class="form-group">
															<label>Date of Birth</label>
															<input type="date" name="dob" placeholder="Date of Birth" value="<?php echo $dob; ?>" class="form-control">
														</div>											
																						
														<div class="form-group">
															<label>Residence</label>
															<input type="text" name="residence" placeholder="Residence" value="<?php echo $reside; ?>" class="form-control">
														</div>		
														
														<div class="form-group">
															<label>Last Visit Date</label>
															<input type="date" name="visitdate" readonly placeholder="Visit date" value="<?php echo $visit_date; ?>" class="form-control">
														</div>
														
														<div class="form-group">
															<label>Scheme</label>
															<select name="scheme" class="form-control">
																<option value="">Choose Scheme</option>
															<?php	
															$result = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
															if ($result->num_rows > 0) {
																while($row = $result->fetch_assoc()) {
																	echo "<option value='" . $row["pscheme_code"] . "'>" . $row["pscheme_name"] . "</option>";
																}
															} ?>

															</select>
														</div>
														<div class="form-group">
															<input name="update-patient" class="btn btn-md btn-success" type="submit" value="Update Patient">
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