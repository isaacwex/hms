<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Patient Registry <?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(reg_no) as OPNO FROM tbl_registry");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$opno = $opnos+1;
	
	$opNumber = str_pad($opno,5,"0",STR_PAD_LEFT);
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
                <div class="col-lg-10">
                    <h2>The Registry</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Registry</a>
                        </li>                        
                        <li class="active">
                            <strong>Add Registry</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
			<div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">	
						<div class="col-lg-7">
						</div>
						<div class="col-lg-5">
						<p class="pull-right">
							<span><a href="registry.php"><button class="btn btn-primary" type="button"><i class="fa fa-eye"></i>&nbsp;&nbsp;<span class="bold"> View List</span></button></a></span>
						</p>
						</div>				
					</div>				
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
						    <div class="modal-body">
											<div class="row">
											<span></span>
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['new-patient'])){
														if(empty($_POST['firstname'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> First Name is required.
																</div>";
														}
														else {																
																	
															$opno = $dbconnect->real_escape_string($_POST['OPNO']);
															$cfname = $dbconnect->real_escape_string($_POST['firstname']);
															$clname = $dbconnect->real_escape_string($_POST['lastname']);
															$cphone = $dbconnect->real_escape_string($_POST['phonenumber']);
															$cidno = $dbconnect->real_escape_string($_POST['idnumber']);
															$cdob = $dbconnect->real_escape_string($_POST['dob']);
															$cgender = $dbconnect->real_escape_string($_POST['gender']);
															$creside = $dbconnect->real_escape_string($_POST['residence']);
															$cvisit = $dbconnect->real_escape_string($_POST['visitdate']);
															$scheme = $dbconnect->real_escape_string($_POST['scheme']);
															$newvisit ='1';
															$visit_status='1';
															$checkpatient = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$opno'");
															$countNo = mysqli_num_rows($checkpatient);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('That patient already exists! Go to the main list and create a new visit number. <?php echo "$dbconnect->error()";?>');
																			window.location = 'add-registry.php';
																		</script>	
																	<?php
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_registry (id_no, f_name, l_name, phone_no, gender, dob, residence, opno, visit_date,visit_no,scheme_code,visit_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssssss', $cidno, $cfname, $clname, $cphone, $cgender, $cdob, $creside, $opno, $cvisit,$newvisit,$scheme,$visit_status);
																	$stmt->execute();
																	
																if($stmtv = $dbconnect->prepare("INSERT INTO tbl_visits (visit_opno, visit_no) VALUES (?,?)")){
																	$stmtv->bind_param('ss', $opno, $newvisit);
																	$stmtv->execute();
																}
																else{}
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'registry.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'add-registry.php';
																			</script>	
																	<?php
																}
															}
														}
													}
												?>
												</div>
												
													<div class="col-sm-6">
														<div class="form-group">
															<label>Outpatient Number</label>
															<input type="text" name="OPNO" value="<?php echo "OP$opNumber"; ?>" placeholder="to beautogenerated" readonly class="form-control">
														</div>
														<div class="form-group">
															<label>First Name</label>
															<input type="text" name="firstname" required placeholder="First Name" class="form-control">
														</div>
														<div class="form-group">
															<label>Last Name</label>
															<input type="text" name="lastname" required placeholder="Last Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" name="phonenumber" placeholder="You Phone Number" class="form-control">
														</div>
														<div class="form-group">
															<label>ID No/Millitary/ Student ID/Passport Number/NHIF Number</label>
															<input type="text" name="idnumber" placeholder="Enter ID Number" class="form-control">
														</div>
														
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Gender</label>
															<select name="gender" class="form-control">
																<option value="">Choose Gender</option>
																<option value="MALE">MALE</option>
																<option value="FEMALE">FEMALE</option>
															</select>
														</div>
														<div class="form-group">
															<label>Date of Birth</label>
															<input type="date" name="dob" placeholder="Date of Birth" class="form-control datepicker">
														</div>
														<div class="form-group">
															<label>Residence</label>
															<input type="text" name="residence" placeholder="Residence" class="form-control">
														</div>
														<div class="form-group">
															<label>Visit Date</label>
															<input type="date" name="visitdate" placeholder="Visit Date" class="form-control">
														</div>					
													<div class="form-group">
															<label>Scheme</label>
															<select name="scheme" class="form-control">
																<option value="">Choose Scheme</option>
																<option value="SELFPAY">SELFPAY</option>
																<option value="NHIF">NHIF</option>
															</select>
														</div>
														<div class="form-group">
															<button name="new-patient" class="btn btn-md btn-primary" type="submit">Add Patient</button>
														</div>														
													</div>													
												</form>
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