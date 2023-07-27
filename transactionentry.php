<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_Payrolltransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
	$leo_date = date('Y-m-d');
	
	$getmaxreg = mysqli_query($dbconnect,"SELECT MAX(pd_id) as latestid FROM tbl_payroll_allow_ded_settings");
	$asreg = mysqli_fetch_assoc($getmaxreg);
	$currentid = $asreg['latestid'];
	$nextidtouse = $currentid+1;
	$postnextcode = str_pad($nextidtouse,4,"0",STR_PAD_LEFT);
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title> Applications - <?php echo "$smart_name"; ?></title>
	
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
				<h2>Salary</h2>
				<ol class="breadcrumb">
					<li>
						<a href="Payrollapplications.php"> Applications</a>
					</li>                        
					<li class="active">
						<strong> Applications</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Transactions</span></button></a></span></p>
				</div>
		</div>

        <div class="wrapper wrapper-content">

			<?php if($user_l=='ADMINISTRATOR'){ ?>
				
			<div class="row">
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Salary Transactions Pending Approval</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr style="background-color:black;color:white;">
									<th>Trans Code</th>
									<th>Applicant Name</th>
									<th>Product Name</th>
									<th>Total Applied</th>
									<th>Monthly Remittence</th>
									<th>No of Months</th>
									<th>Status</th>
									<th>Explanation</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$No=0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE c.pdc_name LIKE '%ADVANCE%' AND s.pd_status='APPLIED'");
								
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1; 
									$pdc_code = $gcn['pdc_code'];
									$pd_id = $gcn['pd_id'];
									$pdc_name = $gcn['pdc_name'];
									$pd_settingscode = $gcn['pd_settingscode'];
									$pd_transcategorycode = $gcn['pd_transcategorycode'];
									$pd_total = $gcn['pd_total'];
									$pd_monthlyremittance = $gcn['pd_monthlyremittance'];
									$pd_noofmonths = $gcn['pd_noofmonths'];
									$pd_status = $gcn['pd_status'];
									$pd_debitcredit = $gcn['pd_debitcredit'];
									$pd_employeeid = $gcn['pd_employeeid'];
									$balance = '';
									$pd_explanation = $gcn['pd_explanation'];
									
									
									$get_empnames = mysqli_query($dbconnect, "SELECT * FROM tbl_employees WHERE emp_idno='$pd_employeeid'");
									$gfc = mysqli_fetch_array($get_empnames);
										$emp_fname = $gfc['emp_fname'];
										$emp_lname = $gfc['emp_onames'];
									
									
									$leavetrans_status=$pd_status;
									if($leavetrans_status == "APPLIED"){
										$aclass = "badge-primary";
									}
									elseif($leavetrans_status == "REJECTED"){
										$aclass = "badge-danger";
									}
									elseif($leavetrans_status == "ACTIVE"){
										$aclass = "badge-info";
									}
									elseif($leavetrans_status == "INACTIVE"){
										$aclass = "badge-success";
									}
									else{
										$aclass = "badge-success";
									}	
								
								?>
								<tr>
									<td><?php echo $pd_settingscode; ?></td>
									<td><?php echo $emp_fname.' '.$emp_lname; ?></td>
									<td><?php echo $pdc_name; ?></td>
									<td><?php echo $pd_total; ?></td>
									<td><?php echo $pd_monthlyremittance; ?></td>
									<td><?php echo $pd_noofmonths; ?></td>
									<td><span class="badge <?php echo $aclass; ?>"><?php echo $pd_status; ?></span></td>
									<td><?php echo $pd_explanation; ?></td>
									<td><a href="advancedetails.php?advanceid=<?php echo $pd_id; ?>"><button class="btn-xs btn-warning"><i class="fa fa-edit"></i> Manage</button></a></td>
									
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
			
			
			
			<?php } ?>
			
			
			
                <div class="row">					
								
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Apply for Salary Advance</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newPayroll'])){
											if(empty($_POST['category'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Loan type is required</div>";
														}
												else {
												
												//$todaydate = date('Y-m-d');
												//$petty_transcode = $postnextcode;
												//$petty_code = $dbconnect->real_escape_string($_POST['petty_code']);
													$pd_dedcode = $dbconnect->real_escape_string($_POST['category']);
													$pd_dedcategorycode = $dbconnect->real_escape_string('debit');
													$pd_total = $dbconnect->real_escape_string($_POST['amount']);
													$pd_monthlyremittance = $dbconnect->real_escape_string($_POST['monthly']);
													$pd_explanation  = $dbconnect->real_escape_string($_POST['pd_explanation']);
													$pd_debitcredit = 'DEBIT';
													$pd_activeupto = $dbconnect->real_escape_string($_POST['pd_activeupto']);
													$pd_noofmonths=$pd_total/$pd_monthlyremittance;
													$today=$leo_date;
													$pd_dedcoded=$pd_dedcode;
													$pd_status='APPLIED';
													$sidno;
													
													$code='DES';
													$pd_settingscode= $code.$postnextcode;
													
													$checkcounty = mysqli_query($dbconnect, "SELECT * FROM `tbl_payroll_allow_ded_settings` WHERE `pd_transcategorycode`='$pd_dedcode' AND `pd_employeeid`='$sidno' AND pd_status='APPLIED'");
													$countNo = mysqli_num_rows($checkcounty);
													$ga1 = mysqli_fetch_array($checkcounty);
													$pd_type='DEDUCTION';
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> There is a similar transaction still ongoing </div>";
														}
												else {
													 
													$sql5 ="INSERT INTO `tbl_payroll_allow_ded_settings`(`pd_type`, `pd_settingscode`, `pd_transcategorycode`, `pd_total`, `pd_monthlyremittance`, `pd_noofmonths`, `pd_status`, `pd_activeupto`, `pd_debitcredit`, `pd_employeeid`, `pd_dateofcreation`, `pd_createdbyid`,pd_explanation) VALUES ('$pd_type','$pd_settingscode','$pd_dedcoded','$pd_total','$pd_monthlyremittance','$pd_noofmonths','$pd_status','$pd_activeupto','$pd_debitcredit','$sidno','$leo_date','$sidno','$pd_explanation')";
													
													
													// $sql5 = "INSERT INTO tbl_payroll_allow_ded_settings (pd_type,`pd_dedcode`, `pd_dedcategorycode`, `pd_total`, `pd_monthlyremittance`, `pd_noofmonths`, `pd_status`, `pd_debitcredit`, `pd_employeeid`, `pd_dateofcreation`, `pd_createdbyid`, `balance`) VALUES('$pd_type','$pd_dedcode','$pd_dedcoded','$pd_total','$pd_monthlyremittance','$pd_noofmonths','$pd_status','$pd_debitcredit','$sidno','$today','$pd_createdbyid','$balance')";
														$result5 = $dbconnect->query($sql5);
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successful!! wait for approval</div>";
													}
													
															}
														}
													
												?>
											</div>
												
												<div class="col-sm-3">
													<div class="form-group">
														<label>Trans Category</label>
														<select data-placeholder="Choose Payroll typer" name="category" class="form-control chosen-select">
														
																<?php
															$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_allow_ded_categories WHERE pdc_name LIKE '%ADVANCE%'");
															while($ga = mysqli_fetch_array($getalllocationss)){
																$pdc_code = $ga['pdc_code'];
																$pdc_name = $ga['pdc_name'];
																?>
																<option value="<?php echo $pdc_code; ?>" ><?php echo $pdc_name; ?></option>
																<?php
															}
															?>
														</select>									
													</div>
												</div>
												
												<div class="col-sm-3">
													<div class="form-group">
														<label> Total Amount</label>
														<input type="number" required name="amount" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Monthly Repayment Amount</label>
														<input type="number" required name="monthly" value="" class="form-control">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label> Repayment Upto</label>
														<input type="date" required name="pd_activeupto" min="<?php echo $leo_date; ?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-12">
													<div class="form-group">
														<label> Explanation/Reason</label>
														<textarea name="pd_explanation" required rows="3" class="form-control" placeholder="Explanation"></textarea>
													</div>
												</div>
											
												<div class="col-sm-3">
													<div class="form-group">
													<label style='color:white'>.</label>
														<button name="newPayroll" class="btn btn-md btn-primary" type="submit"> Apply </button>
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
                            <h5>Advance Transactions</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr>
									<th>Trans Code</th>
									<th>Item Code</th>
									<th>Product Name</th>
									<th>Total Applied</th>
									<th>Monthly Remittence</th>
									<th>No of Months</th>
									<th>Status</th>
									<th>Explanation</th>
									<th>Approver Comments</th>
									<th>Current Balance</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$No=0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE c.pdc_name LIKE '%ADVANCE%' AND s.pd_employeeid='$applicantid'");
								
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1; 
									$pdc_code = $gcn['pdc_code'];
									$pdc_name = $gcn['pdc_name'];
									$pd_settingscode = $gcn['pd_settingscode'];
									$pd_transcategorycode = $gcn['pd_transcategorycode'];
									$pd_total = $gcn['pd_total'];
									$pd_monthlyremittance = $gcn['pd_monthlyremittance'];
									$pd_noofmonths = $gcn['pd_noofmonths'];
									$pd_status = $gcn['pd_status'];
									$pd_debitcredit = $gcn['pd_debitcredit'];
									$pd_employeeid = $gcn['pd_employeeid'];
									$balance = '';
									$pd_explanation = $gcn['pd_explanation'];
									$pd_approvercomments = $gcn['pd_approvercomments'];
									
									$leavetrans_status=$pd_status;
									if($leavetrans_status == "APPLIED"){
										$aclass = "badge-primary";
									}
									elseif($leavetrans_status == "REJECTED"){
										$aclass = "badge-danger";
									}
									elseif($leavetrans_status == "ACTIVE"){
										$aclass = "badge-warning";
									}
									elseif($leavetrans_status == "INACTIVE"){
										$aclass = "badge-success";
									}
									else{
										$aclass = "badge-info";
									}	
								
								?>
								<tr>
									<td><?php echo $pd_settingscode; ?></td>
									<td><?php echo $pdc_code; ?></td>
									<td><?php echo $pdc_name; ?></td>
									<td><?php echo $pd_total; ?></td>
									<td><?php echo $pd_monthlyremittance; ?></td>
									<td><?php echo $pd_noofmonths; ?></td>
									<td><span class="badge <?php echo $aclass; ?>"><?php echo $pd_status; ?></span></td>
									<td><?php echo $pd_explanation; ?></td>
									<td><?php echo $pd_approvercomments; ?></td>
									<td><?php echo $balance; ?></td>
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
