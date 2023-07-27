<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Leave Approval<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$leaveid=$_GET['leaveid'];
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
			$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
			$leavetrans_leaveexplanation = $gcn['leavetrans_leaveexplanation'];
			$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
			//employees, leave_types
	$applicantid = $sidno;								
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
												$leavetrans_approveddate =  date('Y-m-d');
												$settings_action = "UPDATE tbl_leavetransactions SET leavetrans_approver=?, leavetrans_status=?,leavetrans_approvercomments=?, leavetrans_approveddate=? WHERE leavetrans_id='$leaveid'";
												if($stmt = $dbconnect->prepare($settings_action)){
													$stmt->bind_param('ssss',$applicantid,$leavetrans_status,$leavetrans_approvercomments,$leavetrans_approveddate);
													$stmt->execute();
													echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Success </div>";
													echo "<meta http-equiv='refresh' content='0;url=leaveapplications.php'>";
												}
												else {
													echo "<div class=\"alert alert-danger alert-dismissable\">
															<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred </div>";
												}
										}
									}
								?>
								</div>
								<div class="col-lg-4">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Leave Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row">
											<div class="col-sm-12">
												<b>Name:</b> <i><?php echo $leavetrans_actingposition; ?> </i></br>
												<b>Application Date:</b> <i><?php echo $leavetrans_applicationdate; ?> </i></br>
												<b>Leave Type:</b> <i><?php echo $leavetrans_leavecode; ?> </i></br>
												<b>Start Date:</b> <i><?php echo $leavetrans_startdate; ?> </i></br>
												<b>End Date:</b> <i><?php echo $leavetrans_enddate; ?> </i></br>
												<b>No of Days Applied:</b> <span class="badge badge-success"><i><?php echo $leavetrans_noofdays; ?> </i></span></br>
												<b>Balance:</b> <i><?php echo $leavetrans_balancedays; ?> </i></br>
												<b>Acting Position:</b> <i><?php echo $leavetrans_actingposition; ?> </i></br>
												<b>Leave Explanation:</b> <i><?php echo $leavetrans_leaveexplanation; ?> </i></br>
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
										<div class="col-sm-12"> 
											<div class="form-group">
											<label>Choose Action</label>
											<select name="action" required class="form-control" >
													<option value="APPROVED" >ACCEPT </option>
													<option value="REJECTED" >REJECT </option>
											</select>
										</div>	
										</div>
										<div class="col-sm-12"> 
											<div class="form-group">
												<label>Comment</label>
												<input type="text" name="comment" required placeholder="Enter Comments" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<p class="pull-right">
													<button name="completeleave" class="btn btn-md btn-primary" type="submit">Finish</button>
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