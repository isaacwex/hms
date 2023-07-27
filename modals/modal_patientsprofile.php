<div class="modal inmodal" id="profile<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">


                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><strong><?php echo "$fnames $lnames"; ?></strong></h4>
                                            <small class="font-bold">Details held at <?php echo $smart_name; ?>.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
											<span></span>
												<div class="col-sm-12">													
												<?php
													
												?>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<b>Opno:</b> <i><?php echo $opno; ?></i></br>
														<b>Visit No:</b> <i><?php echo $visitno; ?></i></br>
														
													</div>
													<div class="col-sm-6">
														<b>Gender:</b> <i><?php echo $gender; ?></i></br>
														<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
													</div>
												</div>
													</br>
													</br>
													</br>
													
													
													<div class="col-sm-12">
														<div class="col-lg-12">
														<label>Request</label>
															<div class="form-group">
															<?php
							//General Services
								$getseevic = mysqli_query($dbconnect,"SELECT DISTINCT sq_servicecategory FROM tbl_servicerequests WHERE sq_opno='$opno' AND sq_visitno='$visitno' AND sq_status='OPEN'");
								while($gccc = mysqli_fetch_array($getseevic)){
								$sq_servicecategory = $gccc['sq_servicecategory'];
								
								
								$getcontactss = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_servicerequests WHERE sq_opno='$opno' AND sq_visitno='$visitno' AND sq_status='OPEN' AND sq_servicecategory='$sq_servicecategory'");
								$gccc = mysqli_fetch_array($getcontactss);
								$g_alllabcountt = $gccc['c'];
								
								if($g_alllabcountt>=1){
								?>
								<b><small><a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Open"><?php echo $sq_servicecategory; ?><span class="badge badge-primary"><?php echo $g_alllabcountt; ?></span></a></small></b> </br>
								<?php
								}
							}								
							//Lab
								$getcontacts = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_labrequests WHERE labrequest_opno='$opno' AND labrequest_visitno='$visitno' AND labrequest_status='OPEN'");
								$gc = mysqli_fetch_array($getcontacts);
								$g_alllabcount = $gc['c'];
								if($g_alllabcount>=1){
								?>
								<b><small><a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Open">LAB<span class="badge badge-primary"><?php echo $g_alllabcount; ?></span></a></small></b> </br>
								<?php
								}								
							//treatment requests
								$checkL = mysqli_query($dbconnect, "SELECT count(*) as d FROM tbl_nursingstationrequests WHERE nursingstationrequest_opno='$opno' AND nursingstationrequest_visitno='$visitno' AND nursingstationrequest_status='OPEN'");
									$gcc = mysqli_fetch_array($checkL);
								$treatmentcount = $gcc['d'];
									if($treatmentcount>=1){
										?>
									<b><small><a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Treatment Requests">TREATMENT<span class="badge badge-primary"><?php echo $treatmentcount; ?></span></a></small></b>
									<?php
									}
			
							//ANC							
							?>
															
															
															
															
															</div>
														</div>
														
														
														<?php if($consultation_complaints!=""){?>
														<div class="col-lg-6">
														<label>Complaints </label>
															<div class="form-group">
															<p>	<?php echo $consultation_complaints; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_presenthistory!=""){?>
														<div class="col-lg-6">
														<label>History of Present History</label>
															<div class="form-group">
																<p>	<?php echo $consultation_presenthistory; ?></p>
															</div>
														</div><?php }else{}?>
														
														<?php if($consultation_allergies!=""){?>
														<div class="col-lg-6">
														<label>Allergies</label>
															<div class="form-group">
																<p><?php echo $consultation_allergies; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_allergies!=""){?>
														<div class="col-lg-6">
														<label>Medical History</label>
															<div class="form-group">
																<p><?php echo $consultation_allergies; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_surgicalhistory!=""){?>
														<div class="col-lg-6">
														<label>Surgical History</label>
															<div class="form-group">
																<p><?php echo $consultation_surgicalhistory; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_familyhistory!=""){?>
														<div class="col-lg-6">
														<label>Family History</label>
															<div class="form-group">
																<p><?php echo $consultation_familyhistory; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_economichistory!=""){?>
														<div class="col-lg-6">
														<label>Economic History</label>
															<div class="form-group">
																<p><?php echo $consultation_economichistory; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_socialhistory!=""){?>
														<div class="col-lg-6">
														<label>Social History</label>
															<div class="form-group">
																<p><?php echo $consultation_socialhistory; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_impressions!=""){?>
														<div class="col-lg-6">
														<label>Impressions</label>
															<div class="form-group">
																<p><?php echo $consultation_impressions; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_diagnosis!=""){?>
														<div class="col-lg-6">
														<label>Diagnosis</label>
															<div class="form-group">
																<p><?php echo $consultation_diagnosis; ?></p>
															</div>
														</div><?php }else{}?>
														<?php if($consultation_summary!=""){?>
														<div class="col-lg-6">
														<label>Summary</label>
															<div class="form-group">
																<p><?php echo $consultation_summary; ?></p>
															</div>
														</div>
														<?php }else{}?>
											
											</div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
								</div>						