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
													
													if(isset($_POST['btn_queue'])){
														if(empty($_POST['queueto'])){
															echo "Select place to";
														}
														elseif(empty($_POST['queuefrom'])){
															echo "Select from";
														}
														else{
														$queuefrom = $dbconnect->real_escape_string($_POST['queuefrom']);
														$queueto = $dbconnect->real_escape_string($_POST['queueto']);
														$queue_note = $dbconnect->real_escape_string($_POST['queue_note']);
														
														$opno1=$opno;
														$visitno1=$visitno;
														$id_number1=$id_number;
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_queue WHERE queueto='$queueto'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('That contact already exists. <?php echo "$dbconnect->error()";?>');
																			window.location = 'registry.php';
																		</script>	
																	<?php
															}
														else {
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_queue (queue_from, queue_to,queue_opno,queue_visitno,queue_note,queue_idno) VALUES (?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssss',$queuefrom, $queueto, $opno1, $visitno1,$queue_note,$id_number1);
																	$stmt->execute();
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'registry.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'registry.php';
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
															<label>FROM</label>
															<select name="queuefrom" class="form-control" >
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
															<select name="queueto" class="form-control" >
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
																<input name="btn_queue" class="btn btn-md btn-success" type="submit" value="Queue Patient"/>
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