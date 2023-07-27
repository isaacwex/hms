<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	//$applicantid = $sidno;
	//$idno = $applicantid;
	$leavecode = $_GET['leavecode'];
	$leavetrans_leavecode = $leavecode;
	$applicantid = $_GET['empid'];
	$idno = $applicantid;
	
	$leo_date = date('Y-m-d');
	
	$startcdate= $leo_date;
	
		$find_leavetype = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes WHERE leavetype_code='$leavetrans_leavecode'");
		$fliv = mysqli_fetch_array($find_leavetype);
		$liv_name = $fliv['leavetype_name'];
		$leavetype_applicationtime = $fliv['leavetype_applicationtime'];
		$noofdays = $leavetype_applicationtime;
									
   // $numberofdays = 10;
    $numberofdays = $leavetype_applicationtime;
	$earliestpossible = date('Y-m-d', strtotime($leo_date . '+ '.$noofdays.' days'));
													
/*
    $d = new DateTime($startcdate);
    $t = $d->getTimestamp();

    // loop for X days
    for($i=0; $i<$numberofdays; $i++){
        // add 1 day to timestamp
        $addDay = 86400;
        // get what day it is next day
        $nextDay = date('w', ($t+$addDay));
        // if it's Saturday or Sunday get $i-1
        if($nextDay == 0 || $nextDay == 6) {
            $i--;
        }
        // modify timestamp, add 1 day
        $t = $t+$addDay;
    }

    $d->setTimestamp($t);
	$earliestpossible=$d->format('Y-m-d');
   // echo $d->format( 'Y-m-d' ). "\n";
*/
	
	
	$getEmployeesBal = mysqli_query($dbconnect,"SELECT * FROM  tbl_leavetransactions WHERE leavetrans_id=(SELECT Max(leavetrans_id) FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavecode' AND leavetrans_empcode='$idno' AND leavetrans_status='APPROVED')");
	$geEntBal = mysqli_fetch_assoc($getEmployeesBal);
	$TotalEntitlementBal =$geEntBal['leavetrans_balancedays'];
	
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
						<!-- <span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Category</span></button></a></span></p> -->
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
									<th>Type</th>
									<th>Start</th>
									<th>End</th>
									<th>Days</th>
									<th>Acting</th>
									<th>Balance</th>
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
									
									$app_names = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$leavetrans_actingposition'"));
									$app_fname = $app_names['emp_fname'];
									$app_lname = $app_names['emp_onames'];
									$app_fullnames=$app_fname.' '.$app_lname;
									
																	
								?>
									<td><?php echo $No; ?></td>
									<td><?php echo $leavetrans_applicationdate; ?></td>
									<td><?php echo $leaves_name; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $app_fullnames; ?></td>
									<td><?php echo $leavetrans_balancedays; ?></td>
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
                            <h5>Apply for a leave (<?php echo $earliestpossible; ?></h5>
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
												elseif(empty($_POST['availabledays'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> oops! Seems the Leave type applied does have the entitled days set properly</div>";
														}
												else {
													$leavetype = $dbconnect->real_escape_string($_POST['leavetype']);
													$availabledays = $dbconnect->real_escape_string($_POST['availabledays']);
													$startdate = $dbconnect->real_escape_string($_POST['startdate']);
													$enddate = $dbconnect->real_escape_string($_POST['enddate']);
													$noofdays = $dbconnect->real_escape_string($_POST['noofdays']);
													$actingposition = $dbconnect->real_escape_string($_POST['actingposition']);
													$approver = $dbconnect->real_escape_string($_POST['approver']);
													$mobileaway = $dbconnect->real_escape_string($_POST['mobileaway']);
													$emailaway = $dbconnect->real_escape_string($_POST['emailaway']);
													$appplicationdate = $dbconnect->real_escape_string($_POST['appplicationdate']);
													$leaveexplanation = $_POST['explanation'];
													
													
													//Getting the new end date
													
													$getEmployeesBal = mysqli_query($dbconnect,"SELECT * FROM  tbl_leavetransactions WHERE leavetrans_leavecode='$leavetype' AND leavetrans_empcode='$applicantid' AND leavetrans_status='APPROVED' AND leavetrans_id=(SELECT Max(leavetrans_id) FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavetype' AND leavetrans_empcode='$applicantid' AND leavetrans_status='APPROVED')");
													$geEntBal = mysqli_fetch_assoc($getEmployeesBal);
													$TotalEntitlementBal =$geEntBal['leavetrans_balancedays'];
													
													$newbookbalanceraw = $TotalEntitlementBal;
													$newbookbalance = $newbookbalanceraw;
												
													$applicannames = "$sfname $ssname";
													
													$leavetrans_status='APPLIED';
													//$leavetrans_approver='28383838';
												
													$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavetype' AND leavetrans_empcode='$applicantid' AND leavetrans_status='APPLIED'");
													$countNo = mysqli_num_rows($checkcounty);
													if($countNo >= 1){
																echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> There is a similar leave request waiting approval</div>";
															}
													else {
														if($stmt = $dbconnect->prepare("INSERT INTO tbl_leavetransactions (leavetrans_startdate, leavetrans_enddate, leavetrans_noofdays, leavetrans_empcode,  leavetrans_actingposition, leavetrans_leavecode, leavetrans_status, leavetrans_applicationdate, leavetrans_approver,  leavetrans_leaveexplanation, leavetrans_balancedays) VALUES (?,?,?,?,?,?,?,?,?,?,?)")){
														$stmt->bind_param('sssssssssss',$startdate,$enddate,$noofdays,$applicantid,$actingposition,$leavetype,$leavetrans_status,$appplicationdate,$approver,$leaveexplanation,$newbookbalance);
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
														<label>Leave Type</label>
														<select data-placeholder="Choose Leave Type" readonly name="leavetype" id="leavetype" class="form-control chosen-select">
														
																<?php
															$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes");
															while($ga = mysqli_fetch_array($getalllocationss)){
																$leavetype_code = $ga['leavetype_code'];
																$leavetype_days = $ga['leavetype_noofdays'];
																$leavetype_name = $ga['leavetype_name'];
																if($leavetype_code==$leavecode){
																?>
																
																<option selected value="<?php echo $leavetype_code; ?>" ><?php echo "$leavetype_name"; ?></option>
																<?php
																}
															}
															?>
														</select>									
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label> Available Days</label>
														<input required type="number" readonly name="availabledays" id="availabledays" value="<?php echo $TotalEntitlementBal; ?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
													<label>Acting Position</label>
													<select data-placeholder="Choose mode" required name="actingposition" class="form-control chosen-select">
													
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
												<div class="col-sm-4">
													<div class="form-group">
														<label>End Date</label>
														<input type="date" readonly name="enddate" value="<?php echo $todaydate;?>" id="end_date" onchange="getDays()" class="form-control">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label> Number of Days</label>
														<input required type="number" name="noofdays" placeholder="Days" required id="numberofdays" max="<?php echo $TotalEntitlementBal; ?>" class="form-control">
													</div>
												</div>
												
												<div class="col-sm-4">
													<div class="form-group">
														<label>Start Date*</label>
														<input type="date" name="startdate" value="<?php echo $earliestpossible; ?>" id="start_date" min="<?php echo $earliestpossible; ?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-12">
													<div class="form-group">
														<label> Leave Explanation/Reason</label>
														<textarea name="explanation" required rows="3" class="form-control" placeholder="Explanation"></textarea>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
													<label>Acting Approver</label>
													<select data-placeholder="Choose Acting" required name="approver" class="form-control chosen-select">
													
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
														<input type="email" name="emailaway" placeholder="Email" class="form-control mobile">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>Application Date</label>
														<input type="date" name="appplicationdate" required value="<?php echo $leo_date; ?>" class="form-control">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<button name="newleave" class="btn btn-md btn-block btn-success" type="submit"><i class="fa fa-save"></i> Submit Leave Application</button>
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
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_leavetransactions WHERE leavetrans_empcode='$applicantid' ORDER BY leavetrans_id DESC");
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
									<td><?php echo $leavetrans_leavecode; ?></td>
									<td><?php echo $leavetrans_startdate; ?></td>
									<td><?php echo $leavetrans_enddate; ?></td>
									<td><?php echo $leavetrans_noofdays; ?></td>
									<td><?php echo $app_fullnames; ?></td>
									<td><span class="badge <?php echo $aclass; ?>"><?php echo $leavetrans_status; ?></span></td>
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
