<div class="modal inmodal" id="request<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Treatment Requests</h4>
                                            <small class="font-bold">Make a request to the treatment room</small>
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
													
													if(isset($_POST['btn_treatmentrequest'])){
														
														$treatmentservicecode = $dbconnect->real_escape_string($_POST['treatmentservicecode']);
														$requestnote = $dbconnect->real_escape_string($_POST['requestnote']);
														
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_nursingstationrequests (nursingstationrequest_opno, nursingstationrequest_visitno,nursingstationrequest_servicecode,nursingstationrequest_note) VALUES (?,?,?,?)")){
																	$stmt->bind_param('ssss',$opno, $visitno,$treatmentservicecode,$requestnote);
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
															<label>Treatment Service</label>
															<select required name="treatmentservicecode" class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_nursingstationservices");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$nursingstation_code = $gal['nursingstation_code'];
																	$nursingstation_name = $gal['nursingstation_name'];
																	$nursingstation_cost = $gal['nursingstation_cost'];
																	?>
																	<option value="<?php echo $nursingstation_code; ?>" ><?php echo $nursingstation_name; ?> | KES. <?php echo $nursingstation_cost; ?> </option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>									
														<div class="col-sm-6">
															<div class="form-group">
																<label>Request Note</label>
																<textarea name="requestnote" class="form-control" placeholder="Enter treatment request note" rows="1"></textarea>
															</div>
														</div>
													</div>
													<div class="row">									
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_treatmentrequest" class="btn btn-md btn-success" type="submit" value="Make Treatment Request"/>
															</div>
														</div>
													</div>
													</br>
													<div class="row">
												<h3><b>Treatments pending Requests</b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests q INNER JOIN tbl_labservices v ON q.labrequest_labservicecode=v.labservice_code WHERE q.labrequest_opno='$opno' AND q.labrequest_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$labrequest_id = $vitalarray['labrequest_id'];
															$labservice_signcode = $vitalarray['labrequest_labservicecode'];
															$labservice_name = $vitalarray['labservice_name'];
															$labservice_cost = $vitalarray['labservice_cost'];
															$labservice_note = $vitalarray['labservice_note'];
														?>
														<?php echo $No; ?>.
														<?php echo $labservice_name; ?> (<?php echo $labservice_note; ?>) - <?php echo $labservice_cost; ?>/=
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_labrequests WHERE labrequest_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
																else {
																
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
															}
															
															?>
														<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $labrequest_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
														
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