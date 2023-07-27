<div class="modal inmodal" id="employees<?php echo $idno;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><?php echo $firstname." ".$onames;?> </h4>
                                        </div>
                                        <div class="modal-body">
											
												  <div class="row mg-b-25 ibox-content">
												<div class="col-lg-12">
												
												  <div class="col-lg-6">
													<div class="form-group">
													  <h4>Designation</h4>
													  <p><?php echo $designation;?></p>
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													  <h4>ID No</h4>
													  <p><?php echo $idno;?></p>
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													   <h4>Phone</h4>
													  <p><?php echo $ephone;?></p>
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													   <h4>Email</h4>
													  <p><?php echo $eaddress;?></p>
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													 <h4>Physical Address</h4>
													  <p><?php echo $eaddress;?></p>
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  <h4>Gender</h4>
													  <p><?php echo $egender;?></p>
													</div>
												  </div><!-- col-4 --> 
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  
													  <h4>Marital Status</h4>
													  <p><?php echo $emp_marital_status;?></p>
													  
													</div>
												  </div><!-- col-4 -->
												  
												  <div class="col-lg-6">
													<div class="form-group">
													  <h4>Date of Birth</h4>
													  <p><?php echo $emp_dob;?></p>
													</div>
												  </div><!-- col-4 --> 
												   <div class="col-lg-6">
													<div class="form-group">
													    <h4>Nationality</h4>
													  <p><?php echo $emp_nationality;?></p>
													</div>
												  </div><!-- col-4 --> 
												  <div class="col-lg-6">
													<div class="form-group">
													  
													  <h4>Employment Date</h4>
													  <p><?php echo $emp_doe;?></p>
													  
													</div>
												  </div><!-- col-4 -->
																  
															
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													 
													  <h4>Basic Salary</h4>
													  <p><?php echo $basicsalary;?></p>
													  
													</div>
												  </div><!-- col-4 --> 			
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  
													  <h4>Bank Name</h4>
													  <p><?php echo $ebank;?></p>
													  
													</div>
												  </div><!-- col-4 --> 
												  
												  <div class="col-lg-6">
													<div class="form-group">
													  <h4>Account Branch</h4>
													  <p><?php echo $bankbranch;?></p>
													
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
														
														<h4>Account No</h4>
													  <p><?php echo $bankaccount;?></p>
													
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
														<h4>NSSF No</h4>
													  <p><?php echo $emp_nssfno;?></p>
													
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													
													<h4>NHIF No</h4>
													  <p><?php echo $emp_nhifno;?></p>
													
													  
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  
													<h4>KRA No.</h4>
													  <p><?php echo $empkra;?></p>
													
													</div>
												  </div><!-- col-4 -->
												  <!-- col-4 -->
												<?php if($active=='YES'){
					
														 ?>
													<div class="col-lg-6">
													<div class="form-group">
													<form action="activate.php" method="post">
														<input type="hidden" name="actor" value="<?php echo $idno; ?>" />
													  <button type="submit" name="deactiv" class="btn btn-danger">Deactivate</button>
													</form></div>
												  </div><!-- col-4 -->
												  
												<?php  }else{ ?>
												<form action="activate.php" method="post">
												<div class="col-lg-6">
													<div class="form-group">
															<label>Assigned Department</label>
															<select name="dept" required class="form-control">
																<option value="">Choose Department</option>
																<option value="CONSULTATION">CONSULTATION</option>
																<option value="REGISTRY">REGISTRY</option>
																<option value="TREATMENTROOM">TREATMENTROOM</option>
																<option value="PHARMACY">PHARMACY</option>
																<option value="TRIAGE">TRIAGE</option>
																<option value="LABORATORY">LABORATORY</option>
																<option value="ADMINISTRATOR">ADMINISTRATOR</option>
															</select>
												<input type="hidden" name="actor" value="<?php echo $idno; ?>" />
													</div>
												  </div>

												  <div class="col-lg-6">
													<div class="form-group" id='loading'>
													 <button type="submit" class="btn btn-primary" name="addEmployee"><i class="fa fa-plus"></i> Activate</button>
													 </form>
													</div>
												  </div><!-- col-4 -->	
													</form>
												<?php  }?>
												</div>
												
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>