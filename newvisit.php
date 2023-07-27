<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>New Visit No<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$opno=$_GET['opno'];
	$visitno=$_GET['visitno'];
	$visit_psnid=$_GET['c_id'];
	$current_visit_no = $visitno+1;
	
		//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE visit_no='$visitno' AND opno='$opno'");
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE r.visit_no='$visitno' AND r.opno='$opno'");
			$gac = mysqli_fetch_assoc($getPatients);
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
			$pscheme_name = $gac['pscheme_name'];
			$visit_date = $gac['visit_date'];
			$todaydate = date('Y-m-d');
									
		$date1 = $dob;
		$date2 = $todaydate;
		
		$diff = date_diff(date_create($dob), date_create($todaydate));
		$agess = $diff->format('%y');
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
                            <strong>New Visit Number Generation</strong>
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
												<form role="form" method="POST">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['genvisit'])){
														if(empty($_POST['schemecode'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Scheme Required...
																</div>";
														}
														else {		
															$opno;
															$visitno;
															$schemecode=$_POST['schemecode'];
															$membernumber=$_POST['membernumber'];
															$visitdate=$_POST['visitdate'];
															$visitstatus='OPEN';
																	$update_item = "UPDATE tbl_registry SET visit_no=?,visit_date=?, visit_status=?,scheme_code=?,memberno=? WHERE reg_no='$visit_psnid'";
																		if($stmt = $dbconnect->prepare($update_item)) {
																			$stmt->bind_param('sssss',$current_visit_no,$visitdate,$visitstatus,$schemecode,$membernumber);
																			$stmt->execute();
																			
																		if($stmtv = $dbconnect->prepare("INSERT INTO tbl_visits (visit_opno, visit_no,visit_datetoday,visit_status,visit_schemecode,visit_schemememberno) VALUES (?,?,?,?,?,?)")){
																					$stmtv->bind_param('ssssss', $opno, $current_visit_no, $visitdate,$visitstatus,$schemecode,$membernumber);
																					$stmtv->execute();
																	}
																else{}
															?>
																<script>
																	alert('Successfully<?php echo "$dbconnect->error()";?>');
																	window.location = 'registry.php';
																</script>	
															<?php
														}
														else {}
															/*
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
														*/
														}
													}
												?>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-4">
														<b>Name:</b> <i><?php echo $fnames; ?> <?php echo $lnames; ?></i></br>
														<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
														<b>Previous Scheme: <i><?php echo $pscheme_name; ?> </i></b>
													</div>
													<div class="col-sm-4">
														<b>Opno:</b> <i><?php echo $opno; ?></i></br>
														<b>Visit No:</b> <i><?php echo $visitno; ?></i>
													</div>
													<div class="col-sm-4">
														<b>Gender:</b> <i><?php echo $gender; ?></i></br>
														<b>Residence:</b> <i><?php echo $residence; ?></i>
													</div>
												</div>
													</br>
													</br>
													</br>
													</br>
													<div class="col-sm-12">
														
														<div class="col-sm-4"> 
															<div class="form-group">
															<label>Payment Scheme</label>
																<select name="schemecode" required class="form-control">
																<option value="" >Select from List </option>
																		<?php
																	$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
																	while($gal = mysqli_fetch_array($getalllocations)){
																		$pscheme_code = $gal['pscheme_code'];
																		$pscheme_name = $gal['pscheme_name'];
																		?>
																		<option value="<?php echo $pscheme_code; ?>" ><?php echo $pscheme_name; ?></option>
																		<?php
																	}
																	?>
																</select>
														</div>	
														</div>
														<div class="col-sm-4"> 
															<div class="form-group">
																<label>Member Number</label>
																<input type="text" name="membernumber" placeholder="Member Number" class="form-control">
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label>Visit Date</label>
																<input type="date" name="visitdate" required placeholder="Feedback Date" class="form-control">
															</div>
														</div>
													</div>														
														</br>
														<div class="col-lg-4">
														</div>
														<div class="col-lg-4">
															
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<p class="pull-right">
																<button name="genvisit" class="btn btn-md btn-warning" type="submit"><i class="fa fa-gears"></i>Generate New Visit Number</button>
																	
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