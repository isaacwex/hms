<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <title>Leave Approval - <?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$advanceid=$_GET['advanceid'];
		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE s.pd_id='$advanceid'");
		$gcn = mysqli_fetch_array($getcountyname);
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
									$pd_dateofcreation = $gcn['pd_dateofcreation'];
									$balance = '';
									$pd_explanation = $gcn['pd_explanation'];
			
			
			$leavetrans_status=$pd_status;
			if($leavetrans_status == "REJECTED"){
				$dclass = "btn-danger";
			}
			elseif($leavetrans_status == "APPROVED"){
				$dclass = "btn-success";
			}
			elseif($leavetrans_status == "APPLIED"){
				$dclass = "btn-primary";
			}
			else{
				$dclass = "btn-info";
			}
			

			$get_empnames = mysqli_query($dbconnect, "SELECT * FROM tbl_employees WHERE emp_idno='$pd_employeeid'");
			$gfc = mysqli_fetch_array($get_empnames);
			$gdc = mysqli_num_rows($get_empnames);
			if ($gdc >= 1){
				$emp_fname = $gfc['emp_fname'];
				$emp_lname = $gfc['emp_onames'];
			}
			else {
				$emp_fname = "";
				$emp_lname = "";
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
				<h2>Leave</h2>
				<ol class="breadcrumb">
					<li>
						<a href="receipter.php">Advance Details</a>
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
									if(isset($_POST['completeleave'])){
										if(empty($_POST['action'])){
											echo "<div class=\"alert alert-danger alert-dismissable\">
													<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Action required.
												</div>";
										}
										else {	
												$pd_status = $_POST['action'];
												$pd_approvercomments = $_POST['comment'];
												$pd_approveddate =  date('Y-m-d');
												$pd_approver=$sidno;
																									
												$settings_action = "UPDATE tbl_payroll_allow_ded_settings SET pd_approver=?, pd_status=?,pd_approvercomments=?, pd_approveddate=? WHERE pd_id='$pd_id'";
												if($stmt = $dbconnect->prepare($settings_action)){
													$stmt->bind_param('ssss',$pd_approver,$pd_status,$pd_approvercomments,$pd_approveddate);
													$stmt->execute();
													echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Success </div>";
													echo "<meta http-equiv='refresh' content='0;url=transactionentry.php'>";
												}
												else {
													echo "<div class=\"alert alert-danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred </div>";
												}
										}
									}
								?>
								</div>
								<div class="col-lg-9">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Leave Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row">
											<div class="col-sm-5">
												<div class="form-group">
													<label>Transaction Name </label>
													<input type="text" class="form-control" disabled value="<?php echo "$pdc_name"; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Amount Applied </label>
													<input type="text" class="form-control" disabled value="<?php echo "$pd_total"; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Monthly Remittance </label>
													<input type="text" class="form-control" disabled value="<?php echo "$pd_monthlyremittance"; ?>" />
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label>Date Applied </label>
													<input type="date" class="form-control" disabled value="<?php echo $pd_dateofcreation; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Approximate No of repayment Months </label>
													<input type="text" class="form-control" disabled value="<?php echo $pd_noofmonths; ?>" />
												</div>
											</div>
										
											<div class="col-sm-12">
												<div class="form-group">
													<label>Reason for Application </label>
													<textarea class="form-control" disabled><?php echo $pd_explanation; ?></textarea>
												</div>
											</div>
											<hr />
											<div class="col-sm-4">
												<div class="form-group">
													<label>Current Status </label>
													<button class="btn btn-md <?php echo $dclass;?>" disabled ><?php echo $pd_status; ?></button>
												</div>
											</div>
											
											
											<div class="col-sm-8">
												<div class="form-group">
													<label>Choose Action </label>
													<select name="action" class="form-control" required>
														<option selected value="">APPLIED</option>
														<option value="ACTIVE">APPROVE</option>
														<option value="REJECTED">REJECT</option>
													</select>
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<label>Feedback/Comment </label>
													<textarea class="form-control" name="comment" placeholder="Comment/Reason"></textarea>
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<label> </label>
													<button name="completeleave" class="btn btn-md btn-primary" type="submit"><i class="fa fa-hand-o-right"></i> FINISH PROCESS</button>
												</div>
											</div>
											
											
										</div>
									</div>
								 </div>
								</form>
								</div>
								
								<div class="col-lg-3">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>My Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row">
											<div class="col-sm-12"> 
													<span><strong>Full Names:</strong> <?php echo "$sfname $ssname";?></span><br />
													<span><strong>ID No:</strong> <?php echo "124411";?></span><br />
													<span><strong>E-mail:</strong> <?php echo "email@me.com";?></span>
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