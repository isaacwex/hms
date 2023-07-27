<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
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
						<strong> Applications</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Category</span></button></a></span></p>
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
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_approver='$applicantid' AND leavetrans_status='APPLIED'");
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
		
		
		
		
		
		
		
		
		
		
                <div class="row">					
								
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Apply for a leave</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newleave'])){
											if(empty($_POST['leavetype'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Leave type is required</div>";
														}
												else {
												
												//$todaydate = date('Y-m-d');
												//$petty_transcode = $postnextcode;
												//$petty_code = $dbconnect->real_escape_string($_POST['petty_code']);
												
													$leavetype = $dbconnect->real_escape_string($_POST['leavetype']);
													$availabledays = $dbconnect->real_escape_string($_POST['availabledays']);
													$startdate = $dbconnect->real_escape_string($_POST['startdate']);
													$enddate = $dbconnect->real_escape_string($_POST['enddate']);
													$noofdays = $dbconnect->real_escape_string($_POST['noofdays']);
													$actingposition = $dbconnect->real_escape_string($_POST['actingposition']);
													$explanation = $dbconnect->real_escape_string($_POST['explanation']);
													$approver = $dbconnect->real_escape_string($_POST['approver']);
													$mobileaway = $dbconnect->real_escape_string($_POST['mobileaway']);
													$emailaway = $dbconnect->real_escape_string($_POST['emailaway']);
													$appplicationdate = $dbconnect->real_escape_string($_POST['appplicationdate']);
													$leaveexplanation = $dbconnect->real_escape_string($_POST['explanation']);
												
												$applicannames = "$sfname $ssname";
												
												$leavetrans_status='APPLIED';
												$leavetrans_approver='28383838';
											
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavetype' AND leavetrans_empcode='$applicantid' AND leavetrans_status='APPLIED'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> There is a similar leave request waiting approval</div>";
														}
												else {
													/*
													$checklasttrans = mysqli_query($dbconnect, "SELECT * FROM tbl_leavetransactions WHERE petty_transcode='$opnos'");
													
													$gcn1 = mysqli_fetch_array($checklasttrans);
													$bookbalance = $gcn1['petty_bookbalance'];
													
														if($petty_creditdebit=='DEBIT'){
															$newbookbalance=$bookbalance-$petty_amount;
														}
														elseif($petty_creditdebit=='CREDIT'){
															$newbookbalance=$bookbalance-$petty_amount;
														}
														else{
															echo "error occurred generating book balance";
														}
														*/
															
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_leavetransactions (leavetrans_startdate,leavetrans_enddate,leavetrans_noofdays,leavetrans_empcode, leavetrans_actingposition,leavetrans_leavecode,leavetrans_status,leavetrans_applicationdate,leavetrans_approver, leavetrans_leaveexplanation,leavetrans_balancedays) VALUES (?,?,?,?,?,?,?,?,?,?,?)")){
													$stmt->bind_param('sssssssssss',$startdate,$enddate,$noofdays,$applicantid,$actingposition,$leavetype,$leavetrans_status,$appplicationdate,$leavetrans_approver,$leaveexplanation,$newbookbalance);
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
												
												<div class="col-sm-3">
													<div class="form-group">
														<label>Leave Type</label>
														<select data-placeholder="Choose leave typer" name="leavetype" class="form-control chosen-select">
														
																<option selected value="">Select from List </option>
																<?php
															$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes");
															while($ga = mysqli_fetch_array($getalllocationss)){
																$leavetype_code = $ga['leavetype_code'];
																$leavetype_name = $ga['leavetype_name'];
																?>
																<option value="<?php echo $leavetype_code; ?>" ><?php echo $leavetype_name; ?></option>
																<?php
															}
															?>
														</select>									
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Available Days</label>
														<input type="number" readonly name="availabledays" value="30" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>Start Date*</label>
														<input type="date" name="startdate" value="<?php echo $todaydate;?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>End Date</label>
														<input type="date" name="enddate" value="<?php echo $todaydate;?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Number of Days</label>
														<input type="number" name="noofdays" placeholder="Days" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
													<label>Acting Position</label>
													<select data-placeholder="Choose mode" name="actingposition" class="form-control chosen-select">
													
															<option selected value="">Select from List </option>
															<?php
														$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE active='YES'");
														while($ga = mysqli_fetch_array($getalllocationss)){
															$emp_idno = $ga['emp_idno'];
															$emp_fname = $ga['emp_fname'];
															$emp_onames = $ga['emp_onames'];
															?>
															<option value="<?php echo $emp_idno; ?>" ><?php echo $emp_fname; ?> <?php echo $emp_onames; ?></option>
															<?php
														}
														?>
													</select>									
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Leave Explanation</label>
														<input type="text" name="explanation" placeholder="Explanation" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
													<label>Acting Approver</label>
													<select data-placeholder="Choose Acting" name="approver" class="form-control chosen-select">
													
															<option selected value="">Select from List </option>
															<?php
														$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE active='YES'");
														while($ga = mysqli_fetch_array($getalllocationss)){
															$emp_idno = $ga['emp_idno'];
															$emp_fname = $ga['emp_fname'];
															$emp_onames = $ga['emp_onames'];
															?>
															<option value="<?php echo $emp_idno; ?>" ><?php echo $emp_fname; ?> <?php echo $emp_onames; ?></option>
															<?php
														}
														?>
													</select>									
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Mobile While Away</label>
														<input type="text" name="mobileaway" placeholder="Phone" class="form-control phone">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Email While Away</label>
														<input type="text" name="emailaway" placeholder="Email" class="form-control mobile">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>Application Date</label>
														<input type="date" name="appplicationdate"  value="" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
													<label>&nbsp;</label>
														<button name="newleave" class="btn btn-md btn-primary" type="submit"> Apply Leave</button>
													</div>																							
												</div>																							
								</form>
							</div>
						</div>
					 </div>
					</div>
				</div>
					
				<div class="row">
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Leave Transactions</h5>
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
									<th>Approver</th>
									<th>Status</th>
									<th>Acting</th>
									<th>Explanation</th>
									<th>Balance</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_empcode='$applicantid'");
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
																	
								?>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $leavetrans_leavecode; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $leavetrans_approver; ?></td>
									<td><span class="badge badge-primary"><?php echo $leavetrans_status; ?></span></td>
									<td><?php echo $leavetrans_actingposition; ?></td>
									<td><?php echo $leavetrans_leaveexplanation; ?></td>
									<td><?php echo $leavetrans_balancedays; ?></td>
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
