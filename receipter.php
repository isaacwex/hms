<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Receipter <?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$bill_idd=$_GET['bill_id'];
	$getl = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_id='$bill_idd'");
	$lrarrayy = mysqli_fetch_array($getl);
	
	
	$bill_amount=$lrarrayy['bill_amount'];
	$opno=$lrarrayy['bill_opno'];
	$visitno=$lrarrayy['bill_visitno'];
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
	
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(receipt_rcptcounter) as rcptcounter FROM tbl_receipts");
	$asreg = mysqli_fetch_array($getmaxreg);
	$oldrcptcounter = $asreg['rcptcounter'];
	$currentrcpttcounter = $oldrcptcounter+1;
	//$opNumber = str_pad($opno,4,"0",STR_PAD_LEFT);	
	
	
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
			<div class="col-lg-7">
				<h2>Billing</h2>
				<ol class="breadcrumb">
					<li>
						<a href="receipter.php">Receipt</a>
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
							<span></span>
								<form role="form" method="post">
								<div class="col-sm-12">													
								<?php
									if(isset($_POST['completepay'])){
										if(empty($_POST['tenderedamt'])){
											echo "<div class=\"alert alert-danger alert-dismissable\">
													<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Amount required.
												</div>";
										}
										else {		
												$opno;
												$visitno;
												$bill_id='$bill_idd';
											
												$paymode = $_POST['paymode'];
												//$amountpay = $_POST['amountpay'];
												$amountpay = $bill_amount;
												$tenderedamt = $_POST['tenderedamt'];
												$receptno = $_POST['receptno'];
												//$balanceamt = $_POST['balanceamt'];
												$balanceamt = '0';
												$payername = $_POST['payername'];
												$paymentdate = $_POST['paymentdate'];
												$status='RECEIPTED';
												$servedby=$sidno;
											
												$settings_action = "UPDATE tbl_billing SET bill_status=?, bill_receiptno=? WHERE bill_id='120'";
												if($stmt = $dbconnect->prepare($settings_action)){
													$stmt->bind_param('ss',$status,$receptno);
													$stmt->execute();
													
													$sqlbill = "INSERT INTO tbl_receipts(receipt_no,receipt_datetime,receipt_servedby, receipt_paymentmode,receipt_tenderedamt,receipt_balance,receipt_payername,receipt_rcptcounter)
																		VALUES ('$receptno','$paymentdate','$servedby','$paymode','$tenderedamt','$balanceamt','$payername','$currentrcpttcounter')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Success </div>";
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
								<div class="col-lg-4">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Patient Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row">
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
											<div class="col-sm-12">
												<b><b>Service:</b> <span class="badge badge-success">COPAY</span></br>
												
											</div>
										</div>
									</div>
								 </div>
								</div>
								
								<div class="col-lg-8">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row">
										<div class="col-sm-4"> 
											<div class="form-group">
											<label>Payment Mode</label>
											<select name="paymode" required class="form-control" >
													<option value="CASH" >CASH </option>
													<option value="MPESA" >MPESA </option>
													<option value="VISA" >VISA </option>
													<option value="PAYPAL" >PAYPAL </option>
											</select>
										</div>	
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Payment Date</label>
												<input type="date" name="paymentdate" placeholder="Payment Date" class="form-control">
											</div>
										</div>
										<div class="col-sm-4"> 
											<div class="form-group">
												<label>Payer Name</label>
												<input type="text" name="payername" required value="<?php echo $fnames; ?> <?php echo $lnames; ?>" class="form-control">
											</div>
										</div>
										
										<div class="col-sm-4"> 
											<div class="form-group">
													<label>Amount to Pay</label>
													<input type="text" name="amountpay" required disabled value="<?php echo $bill_amount; ?>" class="form-control">
												</div>
										</div>
										<div class="col-sm-4"> 
											<div class="form-group">
													<label>Tendered Amount</label>
													<input type="text" name="tenderedamt" required placeholder="Amount Tendered" class="form-control">
												</div>
										</div>
										<div class="col-sm-4"> 
											<div class="form-group">
													<label>Balance</label>
													<input type="text" name="balanceamt" disabled required value="0" class="form-control">
												</div>
										</div>
										<input type="text" name="receptno" readonly required value="<?php echo "CHMC-RCPT-$currentrcpttcounter-23"; ?>" />
										<div class="col-lg-4">
											<div class="form-group">
												<p class="pull-left">
													<button name="completepayandreceipt" class="btn btn-md btn-primary" type="submit">Complete Payment and Receipt</button>
												</p>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<p class="pull-right">
													<button name="completepay" class="btn btn-md btn-warning" type="submit">Complete Payment</button>
												</p>
											</div>
										</div>
										
										</div>
									</div>
								 </div>
								</div>
										
								</form>
						</div>
        </div>
		<?php include 'includes/footer.php'?>
        </div>
    </div>
   <?php include 'includes/footer-scripts.php';?>
</body>
</html>