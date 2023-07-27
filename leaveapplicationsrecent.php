<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
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
						<strong> Applications</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="leaveentitlements.php"><button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="bold"> Open Leave Register</span></button></a></span></p>
				</div>
		</div>

        <div class="wrapper wrapper-content">

		<?php
		if($leavestoapprove>=1){
			?>
		<div class="row">
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2>Awaiting Approval (<?php echo $leavestoapprove ?>)</h2>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr style="background-color:black;color:white;">
									<th>No</th>
									<th>Date</th>
									<th>Applicant Names</th>
									<th>Type</th>
									<th>Start</th>
									<th>End</th>
									<th>Days Applied</th>
									<th>Current Days Balance</th>
									<th>Acting</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_approver='$applicantid' AND leavetrans_status='APPLIED'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No = $No+1;
									$leavetrans_id = $gcn['leavetrans_id'];
									$leavetrans_applicationdate = $gcn['leavetrans_applicationdate'];
									$leavetrans_leavecode = $gcn['leavetrans_leavecode'];
									$leavetrans_empcode = $gcn['leavetrans_empcode'];
									$leavetrans_startdate = $gcn['leavetrans_startdate'];
									$leavetrans_enddate = $gcn['leavetrans_enddate'];
									$leavetrans_noofdays = $gcn['leavetrans_noofdays'];
									$leavetrans_approver = $gcn['leavetrans_approver'];
									$leavetrans_status = $gcn['leavetrans_status'];
									$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
									$leavetrans_leaveexplanation = $gcn['leavetrans_leaveexplanation'];
									$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
									
									$get_leavename = mysqli_query($dbconnect, "SELECT * FROM tbl_leavetypes WHERE leavetype_code='$leavetrans_leavecode'");
									$ln = mysqli_fetch_array($get_leavename);
									$leaves_name = $ln['leavetype_name'];
									
									//applicant names
									$appl_names = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$leavetrans_actingposition'"));
									$appl_fname = $appl_names['emp_fname'];
									$appl_lname = $appl_names['emp_onames'];
									$applicant_names=$appl_fname.' '.$appl_lname;
									
									//approver names
									$app_names = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$leavetrans_actingposition'"));
									$app_fname = $app_names['emp_fname'];
									$app_lname = $app_names['emp_onames'];
									$app_fullnames=$app_fname.' '.$app_lname;
									
									
																	
								?>
									<td><?php echo $No; ?></td>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $applicant_names; ?></td>
									<td><?php echo $leaves_name; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $leavetrans_balancedays; ?></td>
									<td><?php echo $app_fullnames; ?></td>
									<td><a href="leavedetails.php?leaveid=<?php echo $leavetrans_id; ?>"><button class="btn-xs btn-primary"><i class="fa fa-edit"></i> Manage</button></a></td>
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
                            <h5>My Recent Leave Transactions</h5>
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
									<th>Balance</th>
									<th>Status</th>
									<th>Approver</th>
									<th>Approver Comments</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_empcode='$applicantid' ORDER BY leavetrans_id DESC LIMIT 3 ");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$leavetrans_applicationdate = $gcn['leavetrans_applicationdate'];
									$leavetrans_leavecode = $gcn['leavetrans_leavecode'];
									$leavetrans_startdate = $gcn['leavetrans_startdate'];
									$leavetrans_enddate = $gcn['leavetrans_enddate'];
									$leavetrans_noofdays = $gcn['leavetrans_noofdays'];
									$leavetrans_approver = $gcn['leavetrans_approver'];
									$leavetrans_status = $gcn['leavetrans_status'];
									$leavetrans_actingposition = $gcn['leavetrans_actingposition'];
									$leavetrans_leaveexplanation = nl2br($gcn['leavetrans_leaveexplanation']);
									$leavetrans_balancedays = $gcn['leavetrans_balancedays'];
									$leavetrans_approvercomments = $gcn['leavetrans_approvercomments'];
									
									$find_leavetype = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes WHERE leavetype_code='$leavetrans_leavecode'");
									$fliv = mysqli_fetch_array($find_leavetype);
									$liv_name = $fliv['leavetype_name'];
									
									$app_names = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$leavetrans_approver'"));
									$app_fname = $app_names['emp_fname'];
									$app_lname = $app_names['emp_onames'];
									$app_fullnames=$app_fname.' '.$app_lname;
									
									if($leavetrans_status == "APPLIED"){
										$aclass = "badge-primary";
									}
									elseif($leavetrans_status == "REJECTED"){
										$aclass = "badge-danger";
									}
									elseif($leavetrans_status == "APPROVED"){
										$aclass = "badge-success";
									}
									else{
										$aclass = "badge-info";
									}
																	
								?>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $liv_name; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $leavetrans_balancedays; ?></td>
									<td><span class="badge <?php echo $aclass; ?>"><?php echo $leavetrans_status; ?></span></td>
									<td><?php echo $app_fullnames; ?></td>
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
   <script>
	//get the leave days
	  function getDays(){
	 
		var start_date = new Date(document.getElementById('start_date').value);
		var end_date = new Date(document.getElementById('end_date').value);
		//Here we will use getTime() function to get the time difference
		var time_difference = end_date.getTime() - start_date.getTime();
		//Here we will divide the above time difference by the no of miliseconds in a day
		var days_difference = time_difference / (1000*3600*24)+1;
		//alert(days);
		document.getElementById('numberofdays').value = days_difference;
	  }
	</script>
</body>
</html>
