<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Discharge<?php echo "$smart_name"; ?></title>
	
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
	
	
	$getConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_inpatient WHERE inpatient_visitno='$visitno' AND inpatient_opno='$opno'");
			$gc = mysqli_fetch_assoc($getConsultations);
			$inpatient_opno = $gc['inpatient_opno'];
			$inpatient_visitno = $gc['inpatient_visitno'];
			$inpatient_nursingnotes = $gc['inpatient_nursingnotes'];
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
														if(empty($_POST['dischargestate'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> dischargestate  required.
																</div>";
														}
														else {		
															$opno;
															$visitno;
															
															$dischargestate = $_POST['dischargestate'];
															$dischargedoctor = $_POST['dischargedoctor'];
															$dischargedate = $_POST['dischargedate'];
															$dischargeadditionalnotes = $_POST['dischargeadditionalnotes'];
															$inpatient_status = 'DISCHARGED';
															
																$settings_action = "UPDATE tbl_inpatient SET inpatient_patientstatus=?, inpatient_dischargingdoctor=?, inpatient_dischargedate=?, inpatient_dischargeaddnotes=?, inpatient_status=? WHERE inpatient_opno='$opno' AND inpatient_visitno='$visitno'";
																
																if($stmt = $dbconnect->prepare($settings_action)){
																	$stmt->bind_param('sssss',$dischargestate,$dischargedoctor,$dischargedate,$dischargeadditionalnotes,$inpatient_status);
																	$stmt->execute();
																		echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Changes Saved </div>";
																}
																else {
																	echo "<div class=\"alert alert-danger alert-dismissable\">
																			<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred while updating details</div>";
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
														
														<div class="col-sm-4"> 
															<div class="form-group">
															<label>Status</label>
															<select name="dischargestate" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<option value="ALIVE" >ALIVE </option>
																	<option value="ABSONDED" >ABSONDED </option>
																	<option value="DEAD" >DEAD </option>
															</select>
														</div>	
														</div>
														<div class="col-sm-4"> 
															<div class="form-group">
																<label>Discharging Doctor</label>
																<input type="text" name="dischargedoctor" required placeholder="Discharging Doctor" class="form-control">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label>Discharge Date</label>
																<input type="date" name="dischargedate" placeholder="Discharge Date" class="form-control">
															</div>
														</div>
														<div class="col-sm-4"> 
															<div class="form-group">
																	<label>Discharge Additional notes (optional)</label>
																	<input type="text" name="dischargeadditionalnotes" required placeholder="Additional Notes" class="form-control">
																</div>
														</div>
													</div>														
														
														<div class="col-lg-4">
															<div class="form-group">
																<button name="add-consultations" class="btn btn-md btn-primary" type="submit">Save Discharge Details</button>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<p class="pull-right">
																	<span><a href="inpatient.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Patients</span></button></a></span>
																	

																</p>
															</div>
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