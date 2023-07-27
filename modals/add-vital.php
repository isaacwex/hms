<div class="modal inmodal" id="addvital<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
											<h1>Triage Results</h1>
                                            <small class="font-bold">Add Vital Signs to the Patient</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
											<form role="form" method="post">	
												<div class="col-sm-12">													
												<?php
													$date1 = $dob;
													$date2 = $todaydate;
													
													$diff = date_diff(date_create($dob), date_create($todaydate));
													$agess = $diff->format('%y');
													
													if(isset($_POST['btn_addsign'])){
														if(empty($_POST['vital_code'])){
															echo "Select vale";
														}
														elseif(empty($_POST['vitalvalue'])){
															echo "Enter value";
														}
														else{
														$vital_code = $dbconnect->real_escape_string($_POST['vital_code']);
														$vital_name = $dbconnect->real_escape_string($_POST['vital_name']);
														$vital_unit = $dbconnect->real_escape_string($_POST['vital_unit']);
														$vital_value = $dbconnect->real_escape_string($_POST['vitalvalue']);
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_vitalsigns WHERE vitalsign_opno='$opno' AND vitalsign_visitno='$visitno' AND vitalsign_signcode='$vital_code'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('That record already exists. <?php echo "$dbconnect->error()";?>');
																			window.location = 'triage.php';
																		</script>	
																	<?php
															}
														else {
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_vitalsigns (vitalsign_opno,vitalsign_visitno,vitalsign_signcode,vitalsign_value) VALUES (?,?,?,?)")){
																	$stmt->bind_param('ssss',$opno,$visitno,$vital_code,$vital_value);
																	$stmt->execute();
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'triage.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'triage.php';
																			</script>	
																	<?php
																	
																}
														}
													}
													}
												?>
												<br />
												</div>
												
												<!-- ididndini -->
												<div class="col-sm-12">													
													<div class="row">
														<div class="col-sm-3">Patient Names:
														</div>												
														<div class="col-sm-4"> <strong><?php echo "$fnames $lnames"; ?></strong>
														</div>												
														<div class="col-sm-2">OP No:
														</div>												
														<div class="col-sm-3"><strong><?php echo $opno ?></strong>
														</div>
													</div>												
													<div class="row">
														<div class="col-sm-3">Age:
														</div>												
														<div class="col-sm-4"> <strong><?php echo $agess ?> years</strong>
														</div>												
														<div class="col-sm-2">
														</div>												
														<div class="col-sm-3">
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>SELECT VITAL SIGN</label>
															<select name="vital_code" class="form-control" >
																	<option selected value="">Select from list</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_vitals");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$vital_code = $gal['vital_code'];
																	$vital_name = $gal['vital_name'];
																	$vital_unit = $gal['vital_unit'];
																	?>
																	<option value="<?php echo $vital_code; ?>" ><?php echo $vital_name;?> (<?php echo $vital_unit;?> )</option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>												
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>VALUE</label>
															<div class="form-group">
																<input type="text" name="vitalvalue" value="" placeholder="Enter value" class="form-control">
															</div>
														</div>	
														</div>	
													</div>
													
													<div class="row">
														<div class="col-sm-12">
															
														</div>												
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_addsign" class="btn btn-md btn-success" type="submit" value="Add Sign"/>
															</div>
														</div>
													</div>
												<div class="row">
												<h3><b>Current Vital Signs Recorded</b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_vitalsigns q INNER JOIN tbl_vitals v ON q.vitalsign_signcode=v.vital_code WHERE q.vitalsign_opno='$opno' AND q.vitalsign_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$vitalsign_signcode = $vitalarray['vitalsign_signcode'];
															$vitalsign_value = $vitalarray['vitalsign_value'];
															$vital_name = $vitalarray['vital_name'];
															$vital_unit = $vitalarray['vital_unit'];
														?>
														<?php echo $No; ?>.
														<?php echo $vital_name; ?>: <?php echo $vitalsign_value; ?><?php echo $vital_unit; ?>
														<a href="add-vital.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" >Delete</button></a>
														
														</br>
														<?php
														}
													?>
													
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