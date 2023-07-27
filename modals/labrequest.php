<div class="modal inmodal" id="labrequest<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Lab Requests</h4>
                                            <small class="font-bold">Make Lab Requests</small>
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
													
													if(isset($_POST['btn_labrequest'])){
														$labservicecode = $dbconnect->real_escape_string($_POST['labservicecode']);
														$requestnote = $dbconnect->real_escape_string($_POST['requestnote']);
														
														$opno1=$opno;
														$visitno1=$visitno;
														$id_number1=$id_number;
														
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_labrequests (labrequest_opno, labrequest_visitno,labrequest_labservicecode,	labservice_note) VALUES (?,?,?,?)")){
																	$stmt->bind_param('ssss',$opno1, $visitno1,$labservicecode,$requestnote);
																	$stmt->execute();
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'index.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		 window.location = 'index.php';
																			</script>	
																	<?php
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
															<label>Lab Service</label>
															<select name="labservicecode" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_labservices");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$labservice_code = $gal['labservice_code'];
																	$labservice_name = $gal['labservice_name'];
																	$labservice_cost = $gal['labservice_cost'];
																	?>
																	<option value="<?php echo $labservice_code; ?>" ><?php echo $labservice_name; ?> | KES. <?php echo $labservice_cost; ?> </option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>									
														<div class="col-sm-6">
															<div class="form-group">
																<label>Request Note</label>
																<textarea name="requestnote" required class="form-control" placeholder="Enter lab request note" rows="1"></textarea>
															</div>
														</div>
													</div>
													<div class="row">									
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_labrequest" class="btn btn-md btn-success" type="submit" value="Make Lab Request"/>
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