<div class="modal inmodal" id="register" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">New Employee </h4>
                                            <small class="font-bold">Account will be created with a default password of @password123 </small>
                                        </div>
                                        <div class="modal-body">
											<form method="post" action='newemployeeprocessor.php'>
												  <div class="row mg-b-25 ibox-content">
												<div class="col-lg-12">
												 <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">First Name</label>
													  <input class="form-control" type="text" name="fname"  placeholder="First Name" required>
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Other Names</label>
													  <input class="form-control" type="text" name="onames"  placeholder="Other Names" required>
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Designation</label>
													  <input class="form-control" type="text" name="designation"  placeholder="Designation">
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">ID No</label>
													  <input class="form-control" type="text" name="idno"  placeholder="ID No" required>
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Phone</label>
													  <input class="form-control" type="text" name="phone"  placeholder="Phone" required>
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Email</label>
													  <input class="form-control" type="email" name="email"  placeholder="Email">
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Physical Address</label>
													  <input class="form-control" type="text" name="physicaladdress"  placeholder="Physical Address">
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  <label class="form-control-label">Gender</label>
													  <select class="form-control select2" name="gender" data-placeholder="Choose Gender" required>
														<option value="">Choose Gender</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
													  </select>
													</div>
												  </div><!-- col-4 --> 
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  <label class="form-control-label">Marital Status</label>
													  <select class="form-control select2" name="maritalstatus" data-placeholder="Choose Marital Status" required>
														<option value="">Choose Marital Status</option>
														<option value="married">Married</option>
														<option value="single">Single</option>
														
													  </select>
													</div>
												  </div><!-- col-4 -->
												  
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Date of Birth</label>
													  <input class="form-control fc-datepicker" type="date" name="dob"  placeholder="Date of Birth">
													</div>
												  </div><!-- col-4 --> 
												   <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Nationality</label>
													  <input class="form-control" type="text" name="nationality"  placeholder="Nationality">
													</div>
												  </div><!-- col-4 --> 
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Employment Date</label>
													  <input class="form-control fc-datepicker" type="date" name="employmentdate"  placeholder="Employment Date">
													</div>
												  </div><!-- col-4 -->
																  
												
												<div class="col-lg-12">
													<div class="form-group">
													  <h4 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">OTHER DETAILS</h4>
													</div>
												  </div><!-- col-4 -->			
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  <label class="form-control-label">Basic Salary</label>
													  <input class="form-control" type="number" name="basicsalary"  placeholder="Employee Basic Salary.." required>
													</div>
												  </div><!-- col-4 --> 			
												  <div class="col-lg-6">
													<div class="form-group mg-b-10-force">
													  <label class="form-control-label">Bank Name</label>
													
													  <select name="bank" required class="form-control" >
																<option value="">Select bank</option>
																<?php 
																$pataA = mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_banks");
																while ($docA=mysqli_fetch_array($pataA)){
																	$bank_code = $docA['bank_code'];
																	$bank_name = $docA['bank_name'];
																
																	echo "<option value='$bank_code'>$bank_name</option>";
																}
																?>
													</select>
													</div>
												  </div><!-- col-4 --> 
												  
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Account Branch</label>
													  <input class="form-control" type="text" name="acbranch"  placeholder="Bank Branch">
													</div>
												  </div><!-- col-4 -->
												   <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">Account No</label>
													  <input class="form-control" type="text" name="accno"  placeholder="Enter Bank Account No ....">
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">NSSF No</label>
													  <input class="form-control" type="text" name="nssfno"  placeholder="NSSF NO.">
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">NHIF No</label>
													  <input class="form-control" type="text" name="nhifno"  placeholder="NHIF NO.">
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													  <label class="form-control-label">KRA No.</label>
													  <input class="form-control" type="text" name="kra"  placeholder="KRA No">
													</div>
												  </div><!-- col-4 -->
												
													<div class="col-lg-12">
													
												  </div><!-- col-4 -->	
												
													<div class="col-lg-6">
													<div class="form-group">
													  <button type="reset" class="btn btn-danger">Cancel</button>
													</div>
												  </div><!-- col-4 -->
												  <div class="col-lg-6">
													<div class="form-group">
													 <button class="btn btn-primary" name="addEmployee"><i class="fa fa-plus"></i> Add Employee</button>
													 
													</div>
												  </div><!-- col-4 -->												  
												
												</div>
												</form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>