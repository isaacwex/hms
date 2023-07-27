<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
	$receivedidno = $_GET['empid'];
	$receivedleavecode = $_GET['leavecode'];
	$leavecode = $receivedleavecode;
	$leavetype = $receivedleavecode;
	
	$getleavename = mysqli_query($dbconnect,"SELECT leavetype_name FROM tbl_leavetypes WHERE leavetype_code='$leavecode'");
	$leavenamearray = mysqli_fetch_assoc($getleavename);
	$leavename =$leavenamearray['leavetype_name'];
	
		$getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$receivedidno'");
		$ge = mysqli_fetch_array($getEmployees);
		$firstname =$ge['emp_fname'];
		$onames =$ge['emp_onames'];
		$empfullnames=$firstname.' '.$onames;
	
	$leo_date = date('Y-m-d');
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Leave Applications - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

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
				<h2>Leave</h2>
				<ol class="breadcrumb">
					<li>
						<a href="leaveapplications.php"> Applications</a>
					</li>                        
					<li class="active">
						<strong> leave Transactions (<?php echo $empfullnames; ?> - <?php echo "$leavename"; ?>)</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="leaveentitlementlist.php?leavecode=<?php echo $receivedleavecode;?>"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></p>
				</div>
		</div>

        <div class="wrapper wrapper-content">

		<?php
		if($leavestoapprove>=1){
			?>
		<div class="row">
					<div class="col-lg-8">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2>Awaiting Approval (<?php echo $leavestoapprove ?>)</h2>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Start</th>
									<th>End</th>
									<th>Days</th>
									<th>Acting</th>
									<th>Balance</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_approver='$applicantid' AND leavetrans_status='APPLIED' AND leavetrans_leavecode='$receivedleavecode'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$leavetrans_id = $gcn['leavetrans_id'];
									$leavetrans_applicationdate = $gcn['leavetrans_applicationdate'];
									$leavetrans_leavecode = $gcn['leavetrans_leavecode'];
									$leavetrans_startdate = $gcn['leavetrans_startdate'];
									$leavetrans_enddate = $gcn['leavetrans_enddate'];
									$leavetrans_noofdays = $gcn['leavetrans_noofdays'];
									$leavetrans_approver = $gcn['leavetrans_approver'];
									$leavetrans_status = $gcn['leavetrans_status'];
									$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
									$leavetrans_leaveexplanation = $gcn['leavetrans_leaveexplanation'];
									$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
																	
								?>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $leavetrans_leavecode; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $leavetrans_actingposition; ?></td>
									<td><?php echo $leavetrans_balancedays; ?></td>
									<td><button class="btn-xs btn-primary"><a href="leavedetails.php?leaveid=<?php echo $leavetrans_id; ?>"><i class="fa fa-arrow-right"></i> Open </button></a></td>
								</tr>
								<?php
								}
								?>
								</tbody>
								</table>
							</div>
						</div>
					 </div>
					</div>
				</div>
			<?php }	?>
		
		
		<?php
		if($user_l=='ADMINISTRATOR'){
			?>
	 <div class="row">					
								
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Post Leave Transaction (<?php echo $empfullnames; ?> - <?php echo "$leavename"; ?>)</h5>
							
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newleave'])){
											if(empty($_POST['transtype'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Transaction type is required</div>";
														}
												else {
													$transtype = $dbconnect->real_escape_string($_POST['transtype']);
													$noofdays = $dbconnect->real_escape_string($_POST['noofdays']);
													$appplicationdate = $dbconnect->real_escape_string($_POST['appplicationdate']);
													$leaveexplanation = $_POST['explanation'];
													
													$applicantidd=$receivedidno;
													
													$getEmployeesBal = mysqli_query($dbconnect,"SELECT * FROM  tbl_leavetransactions WHERE leavetrans_leavecode='$receivedleavecode' AND leavetrans_empcode='$applicantidd' AND leavetrans_status='APPROVED' AND leavetrans_id=(SELECT Max(leavetrans_id) FROM tbl_leavetransactions WHERE leavetrans_leavecode='$receivedleavecode' AND leavetrans_empcode='$applicantidd' AND leavetrans_status='APPROVED')");
													$geEntBal = mysqli_fetch_assoc($getEmployeesBal);
													$TotalEntitlementBal =$geEntBal['leavetrans_balancedays'];
													
													$newbookbalanceraw = $TotalEntitlementBal;
													if($transtype=='NEGATIVECORRECTION'){
													$newbookbalance = $newbookbalanceraw-$noofdays;
													}
													else{
														$newbookbalance = $newbookbalanceraw+$noofdays;
													}
													$applicannames = "$sfname $ssname";
													
													$leavetrans_status='APPROVED';
													$leavetrans_transgen='SYSTEM';
													$leavetrans_autocomments=$transtype;
													$leavetrans_approvercomments=$leavetrans_autocomments;
													$leavetrans_leavecode=$receivedleavecode;
													//$leavetrans_approver='28383838';
												
													$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavetype' AND leavetrans_empcode='$applicantid' AND leavetrans_status='APPLIED'");
													$countNo = mysqli_num_rows($checkcounty);
													if($countNo >= 1){
																echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> There is a similar leave request waiting approval</div>";
															}
													else {
														if($stmt = $dbconnect->prepare("INSERT INTO tbl_leavetransactions( leavetrans_noofdays, leavetrans_empcode, leavetrans_leavecode, leavetrans_status, leavetrans_applicationdate, leavetrans_leaveexplanation, leavetrans_balancedays,leavetrans_transgen,leavetrans_autocomments,leavetrans_approvercomments) VALUES (?,?,?,?,?,?,?,?,?,?)")){
														$stmt->bind_param('ssssssssss',$noofdays,$applicantidd,$leavetrans_leavecode,$leavetrans_status,$appplicationdate,$leaveexplanation,$newbookbalance,$leavetrans_transgen,$leavetrans_autocomments,$leavetrans_approvercomments);
														$stmt->execute();
															
															echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successful</div>";
														}
														else {
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured </div>";	
																	}
																}
															}
													}
												?>
											</div>
												
												<div class="col-sm-4">
													<div class="form-group">
														<label>Transaction Type</label>
														<select data-placeholder="Choose Transactiontype Type" name="transtype" class="form-control chosen-select">
																<option selected value="">Select Trasaction Type </option>
																<option value="ENTITLEMENT">Annual Entitlement </option>
																<option value="POSITIVECORRECTION">Positive Correction </option>
																<option value="NEGATIVECORRECTION">Negative Correction </option>
														</select>									
													</div>
												</div>
												
												<div class="col-sm-4">
													<div class="form-group">
														<label> Number of Days</label>
														<input type="number" name="noofdays" placeholder="Days" required class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>Transaction Date</label>
														<input type="date" name="appplicationdate"  value="<?php echo $leo_date; ?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-12">
													<div class="form-group">
														<label> Leave Explanation/Reason</label>
														<textarea name="explanation" rows="3" class="form-control" placeholder="Explanation"></textarea>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<button name="newleave" class="btn btn-md btn-block btn-success" type="submit"><i class="fa fa-save"></i> Post Leave Transaction</button>
													</div>																							
												</div>																							
								</form>
							</div>
						</div>
					 </div>
					</div>
				</div>
			<?php }	?>
		
		
		
					
				<div class="row">
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Leave Transactions History (<?php echo $empfullnames; ?> - <?php echo "$leavename"; ?>)</h5>
							
						<h3 class="pull-right"><a href="leaveapplications.php?leavecode=<?php echo $receivedleavecode;?>&empid=<?php echo $receivedidno;?>"><button class="btn btn-warning" type="button"><i class="fa fa-pen"></i>&nbsp;&nbsp;<span class="bold"> APPLY FOR <?php echo "$leavename"; ?> </span></button></a></h3>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr>
									<th>Transaction Date</th>
									<th>Start</th>
									<th>End</th>
									<th>Trans Days</th>
									<th>Balance Days</th>
									<th>Approver</th>
									<th>Status</th>
									<th>Acting</th>
									<th>Explanation</th>
									<th>Approver Comment</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_empcode='$receivedidno' AND leavetrans_leavecode='$receivedleavecode' ORDER BY leavetrans_id ASC");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$leavetrans_applicationdate = $gcn['leavetrans_applicationdate'];
									$leavetrans_leavecode = $gcn['leavetrans_leavecode'];
									$leavetrans_startdate = $gcn['leavetrans_startdate'];
									$leavetrans_enddate = $gcn['leavetrans_enddate'];
									$leavetrans_noofdays = $gcn['leavetrans_noofdays'];
									$leavetrans_approver = $gcn['leavetrans_approver'];
									$leavetrans_status = $gcn['leavetrans_status'];
									$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
									$leavetrans_leaveexplanation = $gcn['leavetrans_leaveexplanation'];
									$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
									$leavetrans_approvercomments = $gcn['leavetrans_approvercomments'];
																	
								?>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><span class="badge badge-info"><?php echo $leavetrans_balancedays; ?></span></td>
									<td><?php echo $leavetrans_approver; ?></td>
									<td><span class="badge badge-primary"><?php echo $leavetrans_status; ?></span></td>
									<td><?php echo $leavetrans_actingposition; ?></td>
									<td><?php echo $leavetrans_leaveexplanation; ?></td>
									<td><?php echo $leavetrans_approvercomments; ?></td>
									<!--<td><button class="btn-xs btn-primary"><a href="edit-county.php?county_id=<?php //echo $county_code; ?>"><i class="fa fa-pencil"></i> Edit </a></button> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>-->
								</tr>
								<?php
								}
								?>
								</tbody>
								</table>
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
