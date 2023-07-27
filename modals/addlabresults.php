<div class="modal inmodal" id="Addthelabresults<?php echo $labrequest_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><?php echo $labservice_name; ?> </h4>
                                            <small class="font-bold">Enter lab results</small>
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
													
													if(isset($_POST['btn_labresults'])){
														if(empty($_POST['componenttested'])){
															echo "Enter values";
														}
														elseif(empty($_POST['testresults'])){
															echo "Enter values";
														}
														else{
														
														$componenttested = $dbconnect->real_escape_string($_POST['componenttested']);
														$testresults = $dbconnect->real_escape_string($_POST['testresults']);
														$testconclusion = $dbconnect->real_escape_string($_POST['testconclusion']);
														
														
															$updateStatus = "UPDATE tbl_labrequests SET labrequest_componentsample=? AND labrequest_results=? AND labrequest_conclusion=? WHERE labrequest_opno='OP00002' AND labrequest_visitno='1' AND labrequest_labservicecode='001'";
																if($stmtp = $dbconnect->prepare($updateStatus)){
																$stmtp->bind_param('sss',$componenttested,$testresults,$testconclusion);
																$stmtp->execute();
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'laboratory.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'laboratory.php';
																			</script>	
																	<?php
																	
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
														
													</div>
													<div class="row">
														<div class="col-sm-12">
															<div class="col-sm-10"></br></br>Test: Results for <strong><i><?php echo $labservice_name; ?> - <?php echo $labservice_note; ?></i></strong>
															</div>	
														</div>	
													</div>
													</br>
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group">
																<label>Component Tested</label>
																<input type="text" name="componenttested" required value="" placeholder="Enter the tested component eg Blood" class="form-control">
															</div>
															<div class="col-sm-6">
																<label>Test Results</label>
																<div class="form-group">
																	<textarea name="testresults" class="form-control" placeholder="Enter the test results" rows="5"></textarea>
																</div>
															</div>
															<div class="col-sm-6">
																<label>Test Conclusion</label>
																<div class="form-group">
																	<textarea name="testconclusion" class="form-control" placeholder="Enter the test conclusion" rows="5"></textarea>
																</div>
															</div>
														</div>	
													</div>												
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_labresults" class="btn btn-md btn-success" type="submit" value="Save"/>
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