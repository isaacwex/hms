<div class="modal inmodal" id="edit<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Queue Patient</h4>
                                            <small class="font-bold">Send the patient to the next process level</small>
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
													
													$buttonnaname="btn_queue";
													$buttonnaname .= "$c_id";
													if(isset($_POST['$btnn'])){
														?>
																		<script>
																			alert('button clicked. <?php echo "$dbconnect->error()";?>');
																			window.location = 'registry.php';
																		</script>	
																	<?php
														if(empty($_POST['queueto'])){
															echo "Select place to";
														}
														elseif(empty($_POST['queuefrom'])){
															echo "Select from";
														}
														else{
															$queue1_opno = $dbconnect->real_escape_string($_POST['queue1_opno']);
															$queue1_visitno = $dbconnect->real_escape_string($_POST['queue1_visitno']);
															
															$queuefrom = $dbconnect->real_escape_string($_POST['queuefrom']);
															$queueto = $dbconnect->real_escape_string($_POST['queueto']);
															$queue_note = $dbconnect->real_escape_string($_POST['queue_note']);
															
															/*
															$opno1=$opno;
															$visitno1=$visitno;
															$id_number1=$id_number;
															*/
															$queuestatus='1';
															$queuestatusclose='0';
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_queue WHERE queueto='$queueto' AND queue_opno='$opno' AND queue_visitno='$visitno'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('That record already exists. <?php echo "$dbconnect->error()";?>');
																			window.location = 'registry.php';
																		</script>	
																	<?php
															}
														else {
																	
															$sql = "INSERT INTO tbl_queue (queue_from, queue_to,queue_opno,queue_visitno,queue_note,queue_idno,queue_status)
																	VALUES ('$queuefrom', '$queueto','$queue1_opno', '$queue1_visitno','$queue_note','$id_number','$queuestatus')";
															
															
															
															//$sql = "UPDATE tbl_queue SET queue_status='1',queue_to='NIACHAA',queue_from='NIOKAMA' WHERE queue_opno='$queue1_opno' //AND queue_visitno='$queue1_visitno' AND queue_to='$current_processstage'";	

																	if ($dbconnect->query($sql) === TRUE) {
																	  echo "New record created successfully";
																	} else {
																	  echo "Error: " . $sql . "<br>" . $conn->error;
																	}

																	//$conn->close();		
															
															
															/*if(($current_processstage)!='REGISTRY'){	
															$updateStatus = "UPDATE tbl_queue SET queue_status=? WHERE queue_opno='$queue1_opno' AND queue_visitno='$queue1_visitno' AND queue_to='$current_processstage'";
																$stmtp = $dbconnect->prepare($updateStatus);
																$stmtp->bind_param('s',$queuestatusclose);
																$stmtp->execute();
															}*/
																
															
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
														<div class="col-sm-3"><strong>
														<input type="text" name="queue1_opno" value="<?php echo $opno ?>" class="form-control">
														<input type="text" name="queue1_visitno" value="<?php echo $visitno ?>" class="form-control">
														</strong>
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
															<label>FROM</label>
															<select required name="queuefrom" class="form-control" >
																	<option selected value="<?php echo $current_processstage;?>"><?php echo $current_processstage;?></option>
																	<?php
																/*$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$process_code = $gal['process_code'];
																	$process_name = $gal['process_name'];
																	?>
																	<option value="<?php echo $process_code; ?>" ><?php echo $process_name; ?></option>
																	<?php
																}*/
																?>
															</select>
														</div>	
														</div>												
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>TO</label>
															<select required name="queueto" class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$process_code = $gal['process_code'];
																	$process_name = $gal['process_name'];
																	?>
																	<option value="<?php echo $process_code; ?>" ><?php echo $process_name; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>	
													</div>
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group">
																<label>Queue Note</label>
																<input type="text" name="queue_note" value="" placeholder="Enter note (Optional)" class="form-control">
															</div>
														</div>												
														<div class="col-sm-6">
															<div class="form-group">
																<input name="<?php $btnn=$buttonnaname; echo $btnn;?>" class="btn btn-md btn-success" type="submit" value="<?php echo $buttonnaname;?>"/>
															</div>
														</div>
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