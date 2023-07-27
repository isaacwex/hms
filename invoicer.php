<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Invoicing Patients<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
<?php

$current_processstage='INVOICING';


	

//get ipno	
	$opno=$_GET['opip'];
	$visitno=$_GET['vis'];
	$thicat=$_GET['pcategory'];
	$patientcategory=$thicat;
	
	$invoicecategory=$patientcategory;
	

//get ipno					
	$getipp = mysqli_query($dbconnect, "SELECT * FROM tbl_inpatient WHERE inpatient_visitno='$visitno' AND inpatient_opno='$opno' AND inpatient_status='ADMITTED' LIMIT 1");
	$gip = mysqli_fetch_assoc($getipp);
	$invoice_ipno = $gip['inpatient_ipno'];


	/*
	$getConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_inpatient WHERE inpatient_visitno='$visitno' AND inpatient_opno='$opno'");
			$gc = mysqli_fetch_assoc($getConsultations);
			$inpatient_opno = $gc['inpatient_opno'];
			$inpatient_visitno = $gc['inpatient_visitno'];
			$inpatient_nursingnotes = $gc['inpatient_nursingnotes'];
			$countexistingip =mysqli_num_rows($getConsultations);
			if($countexistingip>0){
				$invoicecategory='INPATIENT';
			}
			else{
				$invoicecategory='OUTPATIENT';
			}
			*/
	
	//Getting the current invoice number to user
	if($invoicecategory=='INPATIENT'){
		$getmaxreg = mysqli_query($dbconnect,"SELECT Max(invoice_ipcounterno) as ipcounter FROM tbl_patientinvoices");
		$asreg = mysqli_fetch_array($getmaxreg);
		$ipcounter = $asreg['ipcounter'];
		$ipcounterfornow = $ipcounter+1;
		$slang='IP';
		$opnewupdate='0';
		$ipnewupdate=$ipcounterfornow;
	}
	elseif($invoicecategory=='OUTPATIENT'){
		$getmaxreg = mysqli_query($dbconnect,"SELECT Max(invoice_opcounterno) as opcounter FROM tbl_patientinvoices");
		$asreg = mysqli_fetch_array($getmaxreg);
		$opcounter = $asreg['opcounter'];
		$opcounterfornow = $opcounter+1;
		$slang='OP';
		$ipcounterfornow=$opcounterfornow;
		$opnewupdate=$opcounterfornow;
		$ipnewupdate='0';
	}
	else{
		echo "Ooops! An error occurred! ";
		
	}
	
	//Get invoice number incase it exists
					
	$getinvo = mysqli_query($dbconnect, "SELECT invoice_no FROM tbl_patientinvoices WHERE invoice_visitno='$visitno' AND invoice_opno='$opno' AND invoice_category='$patientcategory' LIMIT 1");
	$giv = mysqli_fetch_assoc($getinvo);
	$invoice_no = $giv['invoice_no'];
	if($invoice_no!=null){
		$ipcounterfornow=$invoice_no;
	}
	
	//$opNumber = str_pad($opno,4,"0",STR_PAD_LEFT);	
	
//getting patoent details
	$No = 0;
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes s ON r.scheme_code=s.pscheme_code INNER JOIN tbl_paymentschemes ps ON ps.pscheme_code=r.scheme_code WHERE r.visit_no='$visitno' AND r.opno='$opno'");	
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
			$scheme_code = $gac['scheme_code'];
			$pscheme_name = $gac['pscheme_name'];
			$memberno = $gac['memberno'];
		}									
	$date1 = $dob;
	$date2 = $todaydate;
	
	$diff = date_diff(date_create($dob), date_create($todaydate));
	$agess = $diff->format('%y');
		
		$opip=$opno;
		$pcategory=$patientcategory;
		$vis=$visitno;
	
	//Rebate and copay			
			$billTotalRebate = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$invoicecategory' AND bill_servicecode='NHIFREBATE'");
			$pataTotalRebate = mysqli_fetch_array($billTotalRebate);
			$nhifrebate = $pataTotalRebate['bill_amount'];
			
			$billTotalCopay = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$invoicecategory' AND bill_servicecode='COPAY'");
			$pataTotalCopay = mysqli_fetch_array($billTotalCopay);
			$copay = $pataTotalCopay['bill_amount'];
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
				<h2>Billing</h2>
				<ol class="breadcrumb">
					<li>
						<a href="invoicer.php">Invoice</a>
					</li>                        
					<li class="active">
						<strong>Complete Transaction</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				</div>
		</div>
		<div class="row wrapper border-bottom white-bg page-heading">
            </div>
			<div class="wrapper wrapper-content">
						<div class="row">
								<form role="form" method="post">
								
								<div class="col-lg-3">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Patient Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row well well-sm">
											<div class="col-sm-12">
											<b>Name:</b> <i><?php echo $fnames; ?> <?php echo $lnames; ?></i></br>
											<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
											</div>
											<div class="col-sm-12">
												<b>Opno:</b> <i><?php echo $opno; ?></i></br>
												<b>Visit No:</b> <i><?php echo $visitno; ?></i></br>
											</div>
											<div class="col-sm-12">
												<b>Gender:</b> <i><?php echo $gender; ?></i></br>
												<b>Residence:</b> <i><?php echo $residence; ?></i></br>
											</div>
											
										</div>
									</div>
								 </div>
								</div>
								
								
						<div class="col-lg-9">
							<div class="col-sm-12">													
								<?php
									if(isset($_POST['ipbasicservices'])){
											if($invoicecategory=='INPATIENT'){
	//check admision charges, if not there insert
		$codetocheck='INP001';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
		$codetocheck='INP002';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
			$codetocheck='INP003';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
			$codetocheck='INP004';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
			$codetocheck=='INP005';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
		$codetocheck=='NHIFREBATE';
		$getAIP = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' AND bill_servicecode='$codetocheck'");
		$CheckerIP = mysqli_num_rows($getAIP);
		if($CheckerIP<1){
			//Get price
			//insert bill_amount
			$getAA = mysqli_query($dbconnect, "SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_code='$codetocheck' AND p.sp_schemecode='$scheme_code'");
			$CheckerA = mysqli_fetch_assoc($getAA);
			
			$service_code=$CheckerA['ss_code'];
			$service_price=$CheckerA['sp_price'];
			$service_name=$CheckerA['ss_name'];
			
			$status = 'INITIATED';
			$sq_servicecategory = 'INPATIENT';
			$patientcategory = 'INPATIENT';
			$bill_qty = '1';
			if($CheckerA!=null){
			$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory,bill_qty)
			VALUES ('$service_name', '$service_price','$opno', '$visitno','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory','$bill_qty')";
			$result = $dbconnect->query($sqlbill);
			}
		}
	}	
									}
							?>
							</div>
							<div class="col-sm-12">													
								<?php
									if(isset($_POST['completepay'])){
										if(!empty($_POST['invoiceno'])){		
												$opno;
												$visitno;
												$invoice_no=$_POST['invoiceno'];
												//$tenderedamt=$_POST['sumofinvoice'];
												$tenderedamt='';
												$invoice_servedby = $sidno;
												$status='INVOICED';
												$invoice_paymentmode='CREDIT';
												$todaydate = date('Y-m-d');
												$payername=$fnames.' '.$lnames;
												$invoice_ipcounterno=$ipcounterfornow;
												
												$balanceamt = '0';
											
												$settings_action = "UPDATE tbl_billing SET bill_status=?, bill_invoiceno=? WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_status='INITIATED' and bill_patientcategory='$patientcategory'";
												if($stmt = $dbconnect->prepare($settings_action)){
													$stmt->bind_param('ss',$status,$invoice_no);
													$stmt->execute();
													$sqlbill = "INSERT INTO tbl_patientinvoices(invoice_opcounterno,invoice_ipcounterno,invoice_no,invoice_datetime,invoice_servedby, invoice_paymentmode,invoice_tenderedamt,invoice_balance,invoice_payername,invoice_visitno,invoice_opno,invoice_pschemecode,invoice_pschemename,invoice_memberno,invoice_category,invoice_ipno)
																		VALUES ('$opnewupdate','$ipnewupdate','$invoice_no','$todaydate','$invoice_servedby','$invoice_paymentmode','$tenderedamt','$balanceamt','$payername','$visitno','$opno','$scheme_code','$pscheme_name','$memberno','$invoicecategory','$invoice_ipno')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Success </div>";
																				?>
																	<script>
																		alert('Invoice Generated Successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='invoicer.php?current_processstage=<?php echo $current_processstage;?>&opip=<?php echo $opno;?>&vis=<?php echo $visitno;?>&pcategory=<?php echo $patientcategory;?>';
																	</script>	
																	<?php
																			}
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
											<div class="col-lg-3">
												<div class="input-group-btn">
													<button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">Reports <span class="caret"></span></button>
													<ul class="dropdown-menu">
															
															<li>
															<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=<?php echo $patientcategory;?>">View Lab Report</a>
															</li>
															<li>
															<a target="_blank" href="viewprescriptionreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=<?php echo $invoicecategory;?>">Prescription Report</a>
															</li>
													</ul>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<p class="">
														<?php if($invoice_no!=null){ ?>
														
														<button name="ipbasicservices" class="btn btn-md btn-info"> Generate IP Basic Services </button>
																
															<?php }else{ ?>
																												
														<?php } ?>
													</p>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<p class="">
														<?php if($invoice_no!=null){ ?>
														
														<button name="invoiceopne" class="btn btn-md btn-info"><a target="_blank" href="printbill.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&invoiceno=<?php echo $invoice_no;?>"> Open Invoice  </a></button>
																
															<?php }else{ ?>
														<button name="completepay" class="btn btn-md btn-warning" type="submit">Generate Invoice</button>
														
														
														<?php } ?>
													</p>
												</div>
											</div>
											<div class="col-lg-3">
											<div class="input-group-btn">
												<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">Action <span class="caret"></span></button>
												<ul class="dropdown-menu">
												
														<li>
														<a href="prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&opip=<?php echo $opip;?>&pcategory=<?php echo $pcategory;?>&vis=<?php echo $vis;?>&vis=<?php echo $vis;?>&pprevious=<?php echo $current_processstage;?>" data-toggle="modal" title="Edit Contact">Prescribe </a>			
														</li>
														<li>
														<a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&opip=<?php echo $opip;?>&pcategory=<?php echo $pcategory;?>&vis=<?php echo $vis;?>&vis=<?php echo $vis;?>&pprevious=<?php echo $current_processstage;?>" data-toggle="modal" title="Edit Contact">Clinic Request </a>			
														</li>
														<li>
														<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&opip=<?php echo $opip;?>&pcategory=<?php echo $pcategory;?>&vis=<?php echo $vis;?>&vis=<?php echo $vis;?>&pprevious=<?php echo $current_processstage;?>" data-toggle="modal" title="Edit Contact">Lab Request </a>			
														</li>
														<li>
														<a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&opip=<?php echo $opip;?>&pcategory=<?php echo $pcategory;?>&vis=<?php echo $vis;?>&vis=<?php echo $vis;?>&pprevious=<?php echo $current_processstage;?>" data-toggle="modal" title="Treatment Requests">Treatment Request</a>			
														</li>
														
												</ul>
											</div>
											</div>
											
											</div>
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Invoice Details
							<input type="text" name="invoiceno" readonly required value="<?php echo "CHMC-INV-$slang-$ipcounterfornow-23"; ?>" />
							</h5>
							
							<br>
							<br>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>Category</th>
									<th>Name</th>
									<th>Qty</th>
									<th>Unit Cost</th>
									<th>Subtotal</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$getsum = mysqli_query($dbconnect, "SELECT SUM(bill_amount) as c FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory'");
										$lrarraysum = mysqli_fetch_assoc($getsum);
											$sumofinvoice=$lrarraysum['c'];
										
										$getl = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_patientcategory='$patientcategory' ORDER BY CASE WHEN bill_category='INPATIENT' THEN 1
								WHEN bill_category='CONSULTATION' THEN 2
								WHEN bill_category='LABORATORY' THEN 3
								WHEN bill_category!='INPATIENT' OR bill_category!='CONSULTATION' OR bill_patientcategory!='LABORATORY' THEN 4
								WHEN bill_category='PHARMACY' THEN 5
								ELSE 6 END");
										$sumofinvoice=0;
										while($lrarrayy = mysqli_fetch_array($getl)){
											$bill_amount=$lrarrayy['bill_amount'];
											$bill_id=$lrarrayy['bill_id'];
											$opno=$lrarrayy['bill_opno'];
											$visitno=$lrarrayy['bill_visitno'];
											$bill_category=$lrarrayy['bill_category'];
											$billservicename=$lrarrayy['bill_servicename'];
											$bill_qty=$lrarrayy['bill_qty'];
												if(empty($bill_qty)){
												$bill_qty='1';;
												}
											$subtotal=($bill_amount*$bill_qty);
										//echo "$bill_qty $billservicename @ $billservicename - $subtotal/="; 
								
								?>
								 
									<td><?php echo $bill_category; ?></td>
									<td><?php echo $billservicename; ?></td>
									<td><b><?php echo $bill_qty; ?><b></td>
									<td><?php echo $bill_amount; ?></td>
									<td><b><?php echo $subtotal; ?></b></td>
									<td><a href="invoiceedit.php?opno=<?php echo $opno;?>&visitno=<?php echo $visitno;?>&bill_id=<?php echo $bill_id;?>&opip=<?php echo $opip;?>&pcategory=<?php echo $pcategory;?>&vis=<?php echo $vis;?>&vis=<?php echo $vis;?>&pprevious=<?php echo $current_processstage;?>"><button type="button" class="btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a> | 
									
									<?php
															if(isset($_GET['deletebillid'])){
																$deleted = $_GET['deletebillid'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_billing WHERE bill_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='invoicer.php?current_processstage=<?php echo $current_processstage;?>&opip=<?php echo $opno;?>&vis=<?php echo $visitno;?>&pcategory=<?php echo $patientcategory;?>';
																	</script>	
																	<?php
																}
																else {
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='invoicer.php?current_processstage=<?php echo $current_processstage;?>&opip=<?php echo $opno;?>&vis=<?php echo $visitno;?>&pcategory=<?php echo $patientcategory;?>';
																	</script>	
																	<?php
																}
															}
															?>
														<a href="invoicer.php?current_processstage=<?php echo $current_processstage;?>&opip=<?php echo $opno;?>&vis=<?php echo $visitno;?>&pcategory=<?php echo $patientcategory;?>&deletebillid=<?php echo $bill_id;?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
									
									</td>
								</tr>
								<?php
								$sumofinvoice=$sumofinvoice+($bill_amount*$bill_qty);
								$sumtopay =$sumofinvoice-$nhifrebate-$copay;
								}
								?>
								<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><h2><b>Total Bill </b>- </h2></td>
								<td><h2><b><?php echo "$sumofinvoice"; ?>/=</b></h2></td>
								</tr>
								<?php
							if($nhifrebate!=null){
								?>
								<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><h2><b>NHIF REBATE </b>- </h2></td>
								<td><h2><b><?php echo "$nhifrebate"; ?>/=</b></h2></td>
								</tr>
							<?php } ?>
							<?php
							if($copay!=null){
								?>
								<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><h2><b>Copay </b>- </h2></td>
								<td><h2><b><?php echo "$copay"; ?>/=</b></h2></td>
								</tr>
							<?php } ?>
								<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><h2><b>Total to pay </b>- </h2></td>
								<td><h2><b><?php echo "$sumofinvoice"; ?>/=</b></h2></td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					 </div>
					 	
					</div>	
								
							
							
						</form>
        </div>
		<?php include 'includes/footer.php'?>
        </div>
    </div>
   <?php include 'includes/footer-scripts.php';?>
</body>
</html>