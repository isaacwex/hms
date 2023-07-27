<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Add Consultations<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$opno=$_GET['opno'];
	$visitno=$_GET['visitno'];
	$No = 0;
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE visit_no='$visitno' AND opno='$opno'");
		
		while($gac = mysqli_fetch_array($getPatients)){
			$No=$No+1;
			$c_id = $gac['reg_no'];
			$fnames = $gac['f_name'];
			$lnames = $gac['l_name'];
			$id_number = $gac['id_no'];
			$phonenumber = $gac['phone_no'];
			$gender = $gac['gender'];
			$dob = $gac['dob'];
			$opno = $gac['opno'];
			$visitno = $gac['visit_no'];
			$residence = $gac['residence'];
			$visit_date = $gac['visit_date'];
			$todaydate = date('Y-m-d');
		}									
	
	$date1 = $dob;
	$date2 = $todaydate;
	
	$diff = date_diff(date_create($dob), date_create($todaydate));
	$agess = $diff->format('%y');
	
	
	$getConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_consultations WHERE consultation_visitno='$visitno' AND consultation_opno='$opno'");
			$gc = mysqli_fetch_assoc($getConsultations);
			$consultation_opno = $gc['consultation_opno'];
			$consultation_visitno = $gc['consultation_visitno'];
			$consultation_complaints = $gc['consultation_complaints'];
			$consultation_presenthistory = $gc['consultation_presenthistory'];
			$consultation_allergies = $gc['consultation_allergies'];
			$consultation_medicalhistory = $gc['consultation_medicalhistory'];
			$consultation_surgicalhistory = $gc['consultation_surgicalhistory'];
			$consultation_familyhistory = $gc['consultation_familyhistory'];
			$consultation_economichistory = $gc['consultation_economichistory'];
			$consultation_socialhistory = $gc['consultation_socialhistory'];
			$consultation_impressions = $gc['consultation_impressions'];
			$consultation_diagnosis = $gc['consultation_diagnosis'];
			$consultation_summary = $gc['consultation_summary'];
	
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
				<h2>Consultations</h2>
				<ol class="breadcrumb">
					<li>
						<a href="consultations.php"> Add Consultations</a>
					</li>                        
					<li class="active">
						<strong>New <?php echo $fnames; ?></strong>
					</li>
				</ol>
			</div>
            <p class="pull-right"><br>
				<span><a href="consultations.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Patients</span></button></a></span>
				</p>
				
		</div>
		<div class="row wrapper border-bottom white-bg page-heading">
            </div>
			<div class="wrapper wrapper-content">
                <div class="row">					
								
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
						    <div class="modal-body">
											<div class="row">
											<span></span>
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['add-consultations'])){
														if(empty($_POST['consultation_complaints'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> consultation_complaints  required.
																</div>";
														}
														else {		
															$opno;
															$visitno;
															
															$consultation_complaints = $_POST['consultation_complaints'];
															$consultation_presenthistory = $_POST['consultation_presenthistory'];
															$consultation_allergies = $_POST['consultation_allergies'];
															$consultation_medicalhistory = $_POST['consultation_medicalhistory'];
															$consultation_surgicalhistory = $_POST['consultation_surgicalhistory'];
															$consultation_familyhistory = $_POST['consultation_familyhistory'];
															$consultation_economichistory = $_POST['consultation_economichistory'];
															$consultation_socialhistory = $_POST['consultation_socialhistory'];
															$consultation_impressions = $_POST['consultation_impressions'];
															$consultation_diagnosis = $_POST['consultation_diagnosis'];
															$consultation_summary = $_POST['consultation_summary'];
														
															$checkpatient = mysqli_query($dbconnect, "SELECT * FROM tbl_consultations WHERE consultation_opno='$opno' AND consultation_visitno='$visitno'");
															$countNo = mysqli_num_rows($checkpatient);
															if($countNo >= 1){
																//Run Update queerry here if it already exists
									
																$settings_action = "UPDATE tbl_consultations SET consultation_complaints=?, consultation_presenthistory=?, consultation_allergies=?, consultation_medicalhistory=?, consultation_surgicalhistory=?, consultation_familyhistory=?, consultation_economichistory=?,consultation_socialhistory=?,consultation_impressions=?,consultation_diagnosis=?,consultation_summary=? WHERE consultation_opno='$opno' AND consultation_visitno='$visitno'";
																
																if($stmt = $dbconnect->prepare($settings_action)){
																	$stmt->bind_param('sssssssssss',$consultation_complaints, $consultation_presenthistory, $consultation_allergies, $consultation_medicalhistory, $consultation_surgicalhistory, $consultation_familyhistory, $consultation_economichistory,$consultation_socialhistory,$consultation_impressions,$consultation_diagnosis,$consultation_summary);
																	$stmt->execute();
																		echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Changes Saved </div>";
																}
																else {
																	echo "<div class=\"alert alert-danger alert-dismissable\">
																			<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred while updating details</div>";
																}
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_consultations (consultation_opno, consultation_visitno, consultation_complaints, consultation_presenthistory, consultation_allergies, consultation_medicalhistory, consultation_surgicalhistory, consultation_familyhistory, consultation_economichistory,consultation_socialhistory,consultation_impressions,consultation_diagnosis,consultation_summary) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('sssssssssssss', $opno, $visitno, $consultation_complaints, $consultation_presenthistory, $consultation_allergies, $consultation_medicalhistory, $consultation_surgicalhistory, $consultation_familyhistory, $consultation_economichistory,$consultation_socialhistory,$consultation_impressions,$consultation_diagnosis,$consultation_summary);
																	$stmt->execute();
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Saved  </div>";
																}
																else {
																		echo "<div class=\"alert alert-danger alert-dismissable\">
																			<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred posting details</div>";
																}
															}
														}
													}
												?>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-4">
														<b>Name:</b> <i><?php echo $fnames; ?> <?php echo $lnames; ?></i></br>
														<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
													</div>
													<div class="col-sm-4">
														<b>Opno:</b> <i><?php echo $opno; ?></i></br>
														<b>Visit No:</b> <i><?php echo $visitno; ?></i></br>
													</div>
													<div class="col-sm-4">
														<b>Gender:</b> <i><?php echo $gender; ?></i></br>
														<b>Residence:</b> <i><?php echo $residence; ?></i></br>
													</div>
												</div>
													</br>
													</br>
													</br>
													<div class="col-sm-12">
														
														<div class="col-lg-4">
														<label>Complaints </label>
															<div class="form-group">
																<textarea name="consultation_complaints" class="form-control" placeholder="Enter the complaints" rows="2"><?php echo $consultation_complaints; ?></textarea>
															</div>
														</div>
														
														<div class="col-lg-4">
														<label>History of Present History</label>
															<div class="form-group">
																<textarea name="consultation_presenthistory" class="form-control" placeholder="Enter the history of the current illness" rows="2"><?php echo $consultation_presenthistory; ?></textarea>
															</div>
														</div>
														
														
														<div class="col-lg-4">
														<label>Allergies</label>
															<div class="form-group">
																<textarea name="consultation_allergies" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_allergies; ?></textarea></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Medical History</label>
															<div class="form-group">
																<textarea name="consultation_medicalhistory" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_allergies; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Surgical History</label>
															<div class="form-group">
																<textarea name="consultation_surgicalhistory" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_surgicalhistory; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Family History</label>
															<div class="form-group">
																<textarea name="consultation_familyhistory" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_familyhistory; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Economic History</label>
															<div class="form-group">
																<textarea name="consultation_economichistory" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_economichistory; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Social History</label>
															<div class="form-group">
																<textarea name="consultation_socialhistory" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_socialhistory; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Impressions</label>
															<div class="form-group">
																<textarea name="consultation_impressions" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_impressions; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Diagnosis</label>
															<div class="form-group">
																<textarea name="consultation_diagnosis" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_diagnosis; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
														<label>Summary</label>
															<div class="form-group">
																<textarea name="consultation_summary" class="form-control" placeholder="Enter the value" rows="2"><?php echo $consultation_summary; ?></textarea>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<button name="add-consultations" class="btn btn-md btn-primary" type="submit">Save</button>
															</div>
														</div>
														<div class="col-lg-4">
															
														</div>
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