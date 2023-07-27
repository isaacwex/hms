<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <title>Leave Approval - <?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$leaveid=$_GET['
	'];
		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_id='$leaveid'");
		$gcn = mysqli_fetch_array($getcountyname);
			$leavetrans_id = $gcn['leavetrans_id'];
			$leavetrans_applicationdate = $gcn['leavetrans_applicationdate'];
			$leavetrans_leavecode = $gcn['leavetrans_leavecode'];
			$leavetrans_startdate = $gcn['leavetrans_startdate'];
			$leavetrans_enddate = $gcn['leavetrans_enddate'];
			$leavetrans_noofdays = $gcn['leavetrans_noofdays'];
			$leavetrans_approver = $gcn['leavetrans_approver'];
			$leavetrans_status = $gcn['leavetrans_status'];
			$leaveemp = $gcn['leavetrans_empcode'];
			$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
			$leavetrans_leaveexplanation = $gcn['leavetrans_leaveexplanation'];
			$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
			//employees, leave_types
			$applicantid = $sidno;			
			
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
			
			$find_leavetype = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes WHERE leavetype_code='$leavetrans_leavecode'");
			$fliv = mysqli_fetch_array($find_leavetype);
			$liv_name = $fliv['leavetype_name'];

			$get_empnames = mysqli_query($dbconnect, "SELECT * FROM tbl_employees WHERE emp_idno='$leaveemp'");
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
			
			
			$app_names = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$leavetrans_approver'"));
			$app_fname = $app_names['emp_fname'];
			$app_lname = $app_names['emp_onames'];
			
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
						<a href="receipter.php">Leave Details</a>
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
													<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Amount required.
												</div>";
										}
										else {	
												$leavetrans_status = $_POST['action'];
												$leavetrans_approvercomments = $_POST['comment'];
												$daysapplied = $_POST['daysapplied'];
												$currentbaldays = $_POST['currentbaldays'];
												$leavetrans_approveddate =  date('Y-m-d');
												
												//getting balance days
											
												if($leavetrans_status=='APPROVED'){	
													$newbookbalance = $currentbaldays-$daysapplied;
												}
												else{
													$newbookbalance =$currentbaldays;
												}
																									
												$settings_action = "UPDATE tbl_leavetransactions SET leavetrans_approver=?, leavetrans_status=?,leavetrans_approvercomments=?, leavetrans_approveddate=?, leavetrans_balancedays=? WHERE leavetrans_id='$leaveid'";
												if($stmt = $dbconnect->prepare($settings_action)){
													$stmt->bind_param('sssss',$applicantid,$leavetrans_status,$leavetrans_approvercomments,$leavetrans_approveddate,$newbookbalance);
													$stmt->execute();
													echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Success </div>";
													echo "<meta http-equiv='refresh' content='0;url=leaveapplicationsrecent.php'>";
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
													<label>Employee Name </label>
													<input type="text" class="form-control" disabled value="<?php echo "$leaveemp - $emp_fname $emp_lname"; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Leave Applied </label>
													<input type="text" class="form-control" disabled value="<?php echo "$liv_name ($leavetrans_leavecode)"; ?>" />
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label>Date Applied </label>
													<input type="text" class="form-control" disabled value="<?php echo $leavetrans_applicationdate; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Start Date </label>
													<input type="text" class="form-control" disabled value="<?php echo $leavetrans_startdate; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>End Date </label>
													<input type="text" class="form-control" disabled value="<?php echo $leavetrans_enddate; ?>" />
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Days Applied </label>
													<input type="text" name="daysapplied" class="form-control" readonly value="<?php echo "$leavetrans_noofdays days"; ?>" />
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label>Reason for Application </label>
													<textarea class="form-control" disabled><?php echo $leavetrans_leaveexplanation; ?></textarea>
												</div>
											</div>
											
											<div class="col-sm-6">
												<div class="form-group">
													<label>Approver </label>
													<input type="text" class="form-control" disabled value="<?php echo "$app_fname $app_lname ($leavetrans_approver)"; ?>" />
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Leave Balance (Days) </label>
													<input type="text" class="form-control" name="currentbaldays" readonly value="<?php echo $leavetrans_balancedays; ?>" />
												</div>
											</div>
											<hr />
											<div class="col-sm-4">
												<div class="form-group">
													<label>Current Leave Status </label>
													<button class="btn btn-md <?php echo $dclass;?>" disabled ><?php echo $leavetrans_status; ?></button>
												</div>
											</div>
											
											
											<div class="col-sm-8">
												<div class="form-group">
													<label>Choose Action </label>
													<select name="action" class="form-control" required>
														<option selected value="">APPLIED</option>
														<option value="APPROVED">APPROVE</option>
														<option value="REJECTED">REJECT</option>
													</select>
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<label>Comment/Reason </label>
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