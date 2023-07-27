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
	$current_processstage=$_GET['current_processstage'];
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
		
		if($current_processstage=='REGISTRY'){
				$page='registry.php';
			}
			elseif($current_processstage=='TRIAGE'){
				$page='triage.php';
			}
			elseif($current_processstage=='CONSULTATION'){
				$page='consultations.php';
			}
			elseif($current_processstage=='LABORATORY'){
				$page='laboratory.php';
			}
			elseif($current_processstage=='PHARMACY'){
				$page='pharmacy.php';
			}
			elseif($current_processstage=='BILLING'){
				$page='billing.php';
			}
			elseif($current_processstage=='TREATMENTROOM'){
				$page='treatmentroom.php';
			}
			elseif($current_processstage=='INPATIENT'){
				$page='inpatient.php';
			}
			else{
				echo 'Error Occurrred';
			}
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
											<div class="row">
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
										</div>
								 </div>
													</br>
													</br>	
													<div class="row">
														<div class="col-sm-2">
														</div>
														<div class="col-sm-7">
															<table class="table table-striped table-bordered table-hover dataTables-example" >
																<thead>
																<tr>
																	<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
																	<th>#</th>
																	<th>Date of Visit</th>
																	<th>Op No</th>
																	<th>Visit No</th>
																	<th>Visit Status</th>
																	<th>History</th>
																</tr>
																</thead>
																<tbody>
																	
																	<?php 
																	$No = 0;
																	$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_visits WHERE visit_opno='$opno' ORDER BY visit_id DESC");
																	while($gcn = mysqli_fetch_array($getcountyname)){
																		$No=$No+1;
																		$visit_noo = $gcn['visit_no'];
																		$visit_datetoday = $gcn['visit_datetoday'];
																		$visit_status = $gcn['visit_status'];
																	
																	?>
																	 <td><?php echo $No; ?></td>
																		<td><?php echo $visit_datetoday; ?></td>
																		<td><?php echo $opno; ?></td>
																		<td><?php echo $visit_noo; ?></td>
																		<td><span class="badge badge-success"><?php echo $visit_status; ?></span></td>
																		<td>
																		<a target="_blank" href="consultationreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visit_noo; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Consultation Report</a></br>
																		<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visit_noo; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Lab Report</a></br>
																		<a target="_blank" href="prescriptionreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visit_noo; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Lab Report</a></br>
																		</td>
																	</tr>
																	<?php
																	}
																	?>
																</tbody>
															</table>
													</div>
													<div class="col-sm-3">
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