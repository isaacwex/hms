<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Inpatient Request<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$opno=$_GET['opno'];
	$visitno=$_GET['visitno'];
	$No = 0;
	$inpatient_admittingdoctor = $sidno;
	
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(inpatient_ipnocounter) as ipno FROM tbl_inpatient");
	$asreg = mysqli_fetch_array($getmaxreg);
	$ipnos = $asreg['ipno'];
	$ipno = $ipnos+1;
	$ipNumber = str_pad($ipno,4,"0",STR_PAD_LEFT);
	
	$inpatientnewno=$ipNumber;
	$inpatient_date = date('Y-m-d');
	
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
														if(empty($_POST['inpatient_nursingnotes'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> inpatient_nursingnotes  required.
																</div>";
														}
														else {		
															$opno;
															$visitno;
															
															$inpatient_nursingnotes = $_POST['inpatient_nursingnotes'];
															$wardcode = $_POST['wardcode'];
															$bedno = $_POST['bedno'];
															$inpatient_ipno = $_POST['inpatientno'];
															$inpatient_status = 'ADMITTED';
															
														
															$checkpatient = mysqli_query($dbconnect, "SELECT * FROM tbl_inpatient WHERE inpatient_opno='$opno' AND inpatient_visitno='$visitno' AND inpatient_status='$inpatient_status'");
															$countNo = mysqli_num_rows($checkpatient);
															if($countNo >= 1){
																$settings_action = "UPDATE tbl_inpatient SET inpatient_nursingnotes=?, inpatient_wardname=?, inpatient_bedno=? WHERE inpatient_opno='$opno' AND inpatient_visitno='$visitno' AND inpatient_status='$inpatient_status'";
																
																if($stmt = $dbconnect->prepare($settings_action)){
																	$stmt->bind_param('sss',$inpatient_nursingnotes,$wardcode, $bedno);
																	$stmt->execute();
																		echo "<div class=\"alert alert-info alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Patient is already admitted! Changes were Saved </div>";
																}
																else {
																	echo "<div class=\"alert alert-danger alert-dismissable\">
																			<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred while updating details</div>";
																}
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_inpatient (inpatient_opno, inpatient_visitno, inpatient_nursingnotes, inpatient_wardcode,inpatient_bedno,inpatient_status,inpatient_ipno,inpatient_ipnocounter,inpatient_date,inpatient_admittingdoctor) VALUES (?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssss', $opno, $visitno, $inpatient_nursingnotes, $wardcode, $bedno, $inpatient_status, $inpatient_ipno, $inpatientnewno, $inpatient_date,$inpatient_admittingdoctor);
																	$stmt->execute();
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Successful  </div>";
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
														<div class="col-sm-5"> 
															<div class="form-group">
															<label>Select Ward</label>
															<select name="wardcode" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_wards");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$ward_code = $gal['ward_code'];
																	$ward_name = $gal['ward_name'];
																	?>
																	<option value="<?php echo $ward_code; ?>" ><?php echo $ward_name; ?> </option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>	
														<div class="col-sm-5"> 
															<div class="form-group">
															<label>Bed Number</label>
															<select name="bedno" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<option value="1" >1 </option>
																	<option value="2" >2 </option>
																	<option value="3" >3 </option>
																	<option value="4" >4 </option>
																	<option value="5" >5 </option>
																	<option value="6" >6 </option>
																	<option value="7" >7 </option>
																	<option value="8" >8 </option>
																	<option value="9" >9 </option>
																	<option value="10" >10 </option>
																	<option value="11" >11</option>
																	<option value="12" >12 </option>
																	<option value="13" >13 </option>
																	<option value="14" >14 </option>
																	<option value="15" >15 </option>
																	<option value="16" >16 </option>
																	<option value="17" >17 </option>
																	
															</select>
														</div>	
														</div>
														
														<div class="col-lg-5">
														<label>Nursing Notes </label>
															<div class="form-group">
																<textarea name="inpatient_nursingnotes" class="form-control" placeholder="Enter the complaints" rows="2"><?php echo $inpatient_nursingnotes; ?></textarea>
															</div>
														</div>
														<div class="col-lg-5">
														<label>Inpatient Number </label>
															<div class="form-group">
																<input type="text" name="inpatientno" required readonly value='<?php echo "CHMC-IP-$inpatientnewno-23"; ?>' class="form-control">
															</div>
														</div>
														<div class="col-sm-12">
															<div class="col-lg-6">
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<p class="pull-right">
																		<button name="add-consultations" class="btn btn-md btn-primary" type="submit">Save Admission Notes</button>

																	</p>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<p class="pull-right">
																		<span><a href="consultations.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Patients</span></button></a></span>
																	
																	</p>
																</div>
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