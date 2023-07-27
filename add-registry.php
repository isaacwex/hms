<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(reg_no) as OPNO FROM tbl_registry");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$opno = $opnos+1;
	$opNumber = str_pad($opno,4,"0",STR_PAD_LEFT);
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_drug_categories");
	$result1 = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");*/
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Patient Registry <?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(opnocounter) as OPNOO FROM tbl_registry");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnoss = $asreg['OPNOO'];
	$opnoON = $opnoss+1;
	$opNumber = str_pad($opnoON,4,"0",STR_PAD_LEFT);
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
	$result1 = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
	
	?>

</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-7">
                    <h2>The Registry</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="registry.php">Registry</a>
                        </li>                        
                        <li class="active">
                            <strong>Add Registry</strong>
                        </li>
                    </ol>
                </div>
					<div class="col-lg-5">
						<p class="pull-right">
						</br>
							<span><a href="registry.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Patients</span></button></a></span>
						</p>
					</div>
            </div>
			<div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">	
						<div class="col-lg-7">
						</div>
										
					</div>				
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
						    <div class="modal-body">
											<div class="row">
											<span></span>
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['newpatient']) || isset($_POST['newpatient1'])){
														if(empty($_POST['firstname'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> First Name is required.
																</div>";
														}
														else {	
																														
															if(isset($_POST['newpatient'])){ 
																$agecat = 'CHILD';
																$opno = $dbconnect->real_escape_string($_POST['OPNO']);
																$cfname = $dbconnect->real_escape_string($_POST['firstname']);
																$clname = $dbconnect->real_escape_string($_POST['lastname']);
																$cfname = $dbconnect->real_escape_string(ucwords(strtolower($cfname)));
																$clname = $dbconnect->real_escape_string(ucwords(strtolower($clname)));
																$cphone = $dbconnect->real_escape_string($_POST['phonenumber']);
																$cidno = $dbconnect->real_escape_string($_POST['idnumber']);
																$cdob = $dbconnect->real_escape_string($_POST['dob']);
																$agee = $dbconnect->real_escape_string($_POST['agee']);
																$cgender = $dbconnect->real_escape_string($_POST['gender']);
																$creside = $dbconnect->real_escape_string($_POST['residence']);
																$cvisit = $dbconnect->real_escape_string($_POST['visitdate']);
																$scheme = $dbconnect->real_escape_string($_POST['scheme']);
																$cparentfname = $dbconnect->real_escape_string($_POST['parentfirstname']);
																$cparentlname = $dbconnect->real_escape_string($_POST['parentlastname']);
																$cparentfname = $dbconnect->real_escape_string(ucwords(strtolower($cparentfname)));
																$cparentlname = $dbconnect->real_escape_string(ucwords(strtolower($cparentlname)));
																$memberno = $dbconnect->real_escape_string($_POST['memberno']);
																$todaydate = date('Y-m-d');
																
																$newvisit ='1';
																$visit_status='OPEN';
																$checkpatient = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$opno'");
																$countNo = mysqli_num_rows($checkpatient);	

															}else{ 
																$agecat = 'ADULT';
																$opno = $dbconnect->real_escape_string($_POST['OPNO']);
																$cfname = $dbconnect->real_escape_string($_POST['firstname']);
																$clname = $dbconnect->real_escape_string($_POST['lastname']);
																$cphone = $dbconnect->real_escape_string($_POST['phonenumber1']);
																$cidno = $dbconnect->real_escape_string($_POST['idnumber1']);
																$cdob = $dbconnect->real_escape_string($_POST['dob']);
																$agee = $dbconnect->real_escape_string($_POST['agee']);
																$cgender = $dbconnect->real_escape_string($_POST['gender']);
																$creside = $dbconnect->real_escape_string($_POST['residence1']);
																$cvisit = $dbconnect->real_escape_string($_POST['visitdate1']);
																$scheme = $dbconnect->real_escape_string($_POST['scheme1']);
																$memberno = $dbconnect->real_escape_string($_POST['memberno1']);
																$todaydate = date('Y-m-d');
																
																$cparentfname = $dbconnect->real_escape_string('');
																$cparentlname = $dbconnect->real_escape_string("");
																$newvisit ='1';
																$visit_status='OPEN';
																$checkpatient = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$opno'");
																$countNo = mysqli_num_rows($checkpatient);

															}

															if($countNo >= 1){
																	?>
																		<script>
																			alert('That patient already exists! Go to the main list and create a new visit number. <?php echo "$dbconnect->error()";?>');
																			window.location = 'add-registry.php';
																		</script>	
																	<?php
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_registry (opnocounter,id_no, f_name, l_name, phone_no, gender, dob, residence, opno, visit_date,visit_no,scheme_code,visit_status,agecategory,age,parentFname,parentLame,memberno) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssssssssssss', $opNumber,$cidno, $cfname, $clname, $cphone, $cgender, $cdob, $creside, $opno, $cvisit,$newvisit,$scheme,$visit_status,$agecat,$agee,$cparentfname,$cparentlname,$memberno);
																	$stmt->execute();
																if($stmtv = $dbconnect->prepare("INSERT INTO tbl_visits (visit_opno, visit_no,visit_datetoday,visit_status,visit_schemecode,visit_schemememberno) VALUES (?,?,?,?,?,?)")){	
																	$stmtv->bind_param('ssssss', $opno, $newvisit, $todaydate,$visit_status,$scheme,$memberno);
																	$stmtv->execute();
																}
																else{}
																
																//copay check
																$schemedetails = mysqli_query($dbconnect, "SELECT * FROM  tbl_paymentschemes WHERE pscheme_code='$scheme'");
																$schemearray = mysqli_fetch_assoc($schemedetails);
																$copayamount = $schemearray['pscheme_copayments'];
																if($copayamount!=null){
																	//Insert into billing
																			$process_code = 'COPAY';
																			$process_servicename = 'COPAY';
																			$scheme_code = $scheme;
																			$process_servicecost = $copayamount;
																			$status = 'INITIATED';
																			
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																		VALUES ('$process_servicename', '$process_servicecost','$opno', '$newvisit','$scheme_code','$status','$process_code','$process_code')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				//echo "Processing...";
																				//$getcountyna =mysqli_query($dbconnect,"SELECT max(bill_id) FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$newvisit' AND bill_servicename='COPAY' AND bill_status='INITIATED' LIMIT 1");
																				
																				echo "Sucessful but has associated copay amount";
																				echo "<meta http-equiv='refresh' content='0;url=registry.php'>";
																				
																			}
																			else{
																				?>
																					<script>
																						alert(' Failed Terribly...');
																						window.location = 'registry.php';
																					</script>	
																				<?php
																			}
																	}
																	else{
																		echo "Sucessful but has associated copay amount";
																		echo "<meta http-equiv='refresh' content='0;url=registry.php'>";
																	}
																
																	?>
																		<!--<script>
																			alert('Successful...');
																			window.location = 'registry.php';
																		</script>	-->
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'add-registry.php';
																			</script>	
																	<?php
																}
															}
														}
													}
												?>
												</div>
												
													<div class="col-sm-6">
														<div class="form-group">
															<label>Outpatient Number</label>
															<input type="text" name="OPNO" value="<?php echo "CHMC-OP-$opNumber-23"; ?>" placeholder="to beautogenerated" readonly class="form-control">
														</div>
														<div class="form-group">
															<label>First Name</label>
															<input type="text" name="firstname" required placeholder="First Name" class="form-control">
															
														</div>
														<div class="form-group">
															<label>Last Name</label>
															<input type="text" name="lastname" required placeholder="Last Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<select name="gender" class="form-control">
																<option value="">Choose Gender</option>
																<option value="MALE">MALE</option>
																<option value="FEMALE">FEMALE</option>
															</select>
														</div>
														<div class="form-group">
															<label>Adult/Child</label>
															<select name="ageCategory" id="ageCategory" class="form-control">
																<option value="">Choose age Category</option>
																<option value="adult">Adult</option>
																<option value="child">Child</option>
																<option value="child">Special Need</option>
															</select>
														</div>

														<div class="form-group">
															<label>Date of Birth</label>
															<input type="date" id="dateOfBirth"  name="dob" placeholder="Date of Birth" class="form-control datepicker">
														</div>

														<div class="form-group">
															<label>Age</label>
															<input type="text" id="age" name="agee" placeholder="to be autogenerated" readonly class="form-control">
														</div>

														<script>
															const dateOfBirthInput = document.getElementById("dateOfBirth");
															const ageInput = document.getElementById("age");
															dateOfBirthInput.addEventListener("change", function() {
																const dateOfBirth = new Date(dateOfBirthInput.value);
																const age = calculateAge(dateOfBirth);
																ageInput.value = age;
															});
															function calculateAge(dateOfBirth) {
																const now = new Date();
																const diffInMs = now - dateOfBirth.getTime();
																const ageDate = new Date(diffInMs);
																const age = Math.abs(ageDate.getUTCFullYear() - 1970);
																return age;
															}
															</script>

													</div>
													<div class="col-sm-6" id="childForm" style="display:none;">
														<div class="form-group">
															<label>Parent/Guadian First Name</label>
															<input type="text" name="parentfirstname" required placeholder="First Name" class="form-control">
														</div>
														<div class="form-group">
															<label>Parent/Guadian Last Name</label>
															<input type="text" name="parentlastname" required placeholder="Last Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" min="10" Max="11" name="phonenumber" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No</label>
															<input type="text" name="idnumber" placeholder="Enter ID Number" class="form-control">
														</div>
														<div class="form-group">
															<label>Residence</label>
															<input type="text" name="residence" placeholder="Residence" class="form-control">
														</div>
														<div class="form-group">
															<label>Visit Date</label>
															<input type="date" name="visitdate" value="<?php echo date('Y-m-d'); ?>" class="form-control">
														</div>					
														<div class="form-group">
															<label>Scheme</label>
															<select name="scheme" class="form-control">
																<option value="">Choose Scheme</option>
															<?php	if ($result->num_rows > 0) {
																while($row = $result->fetch_assoc()) {
																	echo "<option value='" . $row["pscheme_code"] . "'>" . $row["pscheme_name"] . "</option>";
																}
															} ?>

															</select>
														</div>
														<div class="form-group">
															<label>Member Number (for insurance)</label>
															<input type="text" name="memberno" placeholder="Enter Member No" class="form-control">
															
														</div>
														<div class="form-group">
															<button name="newpatient" class="btn btn-md btn-primary" type="submit">Add Patient</button>
														</div>													
													</div>	
													<div class="col-sm-6" id="adultForm" style="display:block;">
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" min="10" Max="11" name="phonenumber1" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No</label>
															<input type="text" name="idnumber1" placeholder="Enter ID Number" class="form-control">
														</div>
														<div class="form-group">
															<label>Residence</label>
															<input type="text" name="residence1" placeholder="Residence" class="form-control">
														</div>
														<div class="form-group">
															<label>Visit Date</label>
															<input type="date" name="visitdate1" value="<?php echo date('Y-m-d'); ?>" class="form-control">
														</div>					
														<div class="form-group">
															<label>Scheme</label>
															<select name="scheme1" class="form-control">
															<option value="">Choose Scheme</option>
															<?php	if ($result1->num_rows > 0) {
																while($row = $result1->fetch_assoc()) {
																	echo "<option value='" . $row["pscheme_code"] . "'>" . $row["pscheme_name"] . "</option>";
																}
															} ?>
															</select>
														</div>
														<div class="form-group">
															<label>Member Number (for insurance)</label>
															<input type="text" name="memberno1" placeholder="Enter Member No" class="form-control">
															
														</div>
														<div class="form-group">
															<button name="newpatient1" class="btn btn-md btn-primary" type="submit">Add Patient</button>
														</div>													
													</div>															
													<script>
														const ageCategoryInput = document.getElementById("ageCategory");
														const adultForm = document.getElementById("adultForm");
														const childForm = document.getElementById("childForm");
														ageCategoryInput.addEventListener("change", function() {
															if (ageCategoryInput.value === "adult") {
															const inputDiv = document.querySelector('#childForm');
															const inputs = inputDiv.querySelectorAll('input');
															inputs.forEach(input => {
															input.value = "a";
															});
															adultForm.style.display = "block";
															childForm.style.display = "none";
															} else if (ageCategoryInput.value === "child") {
															adultForm.style.display = "none";
															childForm.style.display = "block";
															const inputDiv = document.querySelector('#childForm');
															const inputs = inputDiv.querySelectorAll('input');
															inputs.forEach(input => {
															input.value = "";
															});
															} else {
															adultForm.style.display = "none";
															childForm.style.display = "none";
															}
														});
														</script>
												</form>
												
											</div>
                                        </div>
						</div>
					 </div>
                </div>
				</div>
        </div>
		<?php include 'includes/footer.php'?>
        </div>
    </div>
   <?php include 'includes/footer-scripts.php';?>
</body>
</html>