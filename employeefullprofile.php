<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT MAX(pd_id) as latestid FROM tbl_payroll_allow_ded_settings");
	$asreg = mysqli_fetch_assoc($getmaxreg);
	$currentid = $asreg['latestid'];
	$nextidtouse = $currentid+1;
	$postnextcode = str_pad($nextidtouse,4,"0",STR_PAD_LEFT);
	
	$employee_id=$_GET['empid'];
	$nonadmin='readonly';
	
	$leo_date = date('Y-m-d');
	
	
	$getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$employee_id'");
								$ge = mysqli_fetch_assoc($getEmployees);
									$firstname =$ge['emp_fname'];
									$onames =$ge['emp_onames'];
									$idno =$ge['emp_idno'];
									$designation =$ge['emp_designation'];
									$egender=$ge['emp_gender'];
									$ephone=$ge['emp_phone'];
									$emp_dob=$ge['emp_dob'];
									$active=$ge['active'];
									$emp_email=$ge['emp_email'];
									$eaddress = $ge['emp_address'];
									$basicsalary = $ge['emp_basicsalary'];
									$ebank = $ge['emp_bank'];
									$emp_marital_status = $ge['emp_marital_status'];
									$bankbranch = $ge['emp_bank_branch'];
									$bankaccount = $ge['emp_accountno'];
									$emp_doe = $ge['emp_doe'];
									$emp_nationality = $ge['emp_nationality'];
									$emp_nssfno = $ge['emp_nssfno'];
									$emp_nhifno = $ge['emp_nhifno'];
									$empkra = $ge['emp_kra'];
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title> Employees Cash - <?php echo "$smart_name"; ?></title>
	
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
				<h2>HR and Payroll</h2>
				<ol class="breadcrumb">
					<li>
						<a href="employees.php"> Employee Profile</a>
					</li>                        
					<li class="active">
						<strong><?php echo $firstname.' '.$onames; ?></strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="employees.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></p>
				</div>
		</div>

       <!-- <div class="wrapper wrapper-content"> -->
                <div class="wrapper wrapper-contentr">
          
		<div class="row">
              <div class="media-list bg-white rounded shadow-base">
               <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">PERSONAL DETAILS</h3>
				<form method="post">
          <div class="row">
		  <div class="col-lg-12">
		<div class="col-lg-8">
			<div class="row ibox-content ibox-heading">
				<div class="col-lg-12">
					<?php 
						if(isset($_POST['addEmployee'])){
															$emp_fname = stripslashes(trim($dbconnect->real_escape_string($_POST['fname'])));
															$emp_onames = stripslashes(trim($dbconnect->real_escape_string($_POST['onames'])));
															$emp_fname = stripslashes(trim($dbconnect->real_escape_string(ucwords(strtolower($emp_fname )))));
															$emp_onames = stripslashes(trim($dbconnect->real_escape_string(ucwords(strtolower($emp_onames)))));
															$emp_des = stripslashes(trim($dbconnect->real_escape_string($_POST['designation'])));
															$emp_idno = stripslashes(trim($dbconnect->real_escape_string($_POST['idno'])));
															$emp_phone = stripslashes(trim($dbconnect->real_escape_string($_POST['phone'])));
															$emp_email = stripslashes(trim($dbconnect->real_escape_string($_POST['email'])));
															$emp_address = stripslashes(trim($dbconnect->real_escape_string($_POST['physicaladdress'])));
															$emp_gender = stripslashes(trim($dbconnect->real_escape_string($_POST['gender'])));
															$emp_marital_status = stripslashes(trim($dbconnect->real_escape_string($_POST['maritalstatus'])));
															$emp_dob = stripslashes(trim($dbconnect->real_escape_string($_POST['dob'])));
															$emp_nationality = stripslashes(trim($dbconnect->real_escape_string($_POST['nationality'])));
															$emp_doe = stripslashes(trim($dbconnect->real_escape_string($_POST['employmentdate'])));
															$emp_bank = stripslashes(trim($dbconnect->real_escape_string($_POST['bank'])));
															$emp_branch = stripslashes(trim($dbconnect->real_escape_string($_POST['acbranch'])));
															$emp_accno = stripslashes(trim($dbconnect->real_escape_string($_POST['accno'])));
															$emp_nssf = stripslashes(trim($dbconnect->real_escape_string($_POST['nssfno'])));
															$emp_nhif = stripslashes(trim($dbconnect->real_escape_string($_POST['nhifno'])));
															$emp_kra = stripslashes(trim($dbconnect->real_escape_string($_POST['kra'])));
															$basicsalary = stripslashes(trim($dbconnect->real_escape_string($_POST['basicsalary'])));	
																
															$addEmp = "UPDATE tbl_employees SET emp_fname=?, emp_onames=?, emp_designation=?, emp_idno=?, emp_phone=?, emp_email=?, emp_address=?, emp_gender=?, emp_marital_status=?, emp_dob=?, emp_nationality=?, emp_doe=?, emp_bank=?, emp_bank_branch=?, emp_accountno=?, emp_nssfno=?, emp_nhifno=?, emp_kra=?, emp_basicsalary=? WHERE emp_idno='$employee_id'";						
																if($stmt = $dbconnect->prepare($addEmp)){
																	$stmt->bind_param('sssssssssssssssssss', $emp_fname, $emp_onames, $emp_des, $emp_idno, $emp_phone, $emp_email,$emp_address, $emp_gender, $emp_marital_status, $emp_dob, $emp_nationality, $emp_doe, $emp_bank, $emp_branch, $emp_accno, $emp_nssf, $emp_nhif, $emp_kra, $basicsalary);
																	$stmt->execute();
																		$res= "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><sup>x</sup></button><i class=\"fa fa-exclamation-triangle\"></i> Update successful...</div>";
																		echo $res;
																	}
																	else {
																		echo mysqli_error($dbconnect);
																}
														}		
					?>
				</div>
				 <div class="col-lg-3">
				 <label class="form-control-label">First Name</label>
					<div class="form-group">
					  <input class="form-control" type="text" name="fname" value="<?php echo $firstname; ?>"  required>
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-3">
				  <label class="form-control-label">Other Names</label>
					<div class="form-group">
					  <input class="form-control" type="text" name="onames"  value="<?php echo $onames; ?>" required>
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-2">
				  <label class="form-control-label">Designation</label>
					<div class="form-group">
					  <input class="form-control" type="text" name="designation"  value="<?php echo $designation; ?>">
					</div>
				  </div><!-- col-4 -->
				   <div class="col-lg-2">
				   <label class="form-control-label">ID No.</label>
					<div class="form-group">
					  <input class="form-control" readonly type="text" name="idno"  value="<?php echo $idno; ?>" required>
					</div>
				  </div><!-- col-4 -->
				   <div class="col-lg-2">
					<label class="form-control-label">Phone</label>
					<div class="form-group">
					  <input class="form-control" type="text" name="phone"  value="<?php echo $ephone; ?>" required>
					</div>
				  </div><!-- col-4 -->
				   <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Email</label>
					  <input class="form-control" type="text" name="email"  value="<?php echo $emp_email; ?>">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Physical Address</label>
					  <input class="form-control" type="text" name="physicaladdress" value="<?php echo $eaddress; ?>">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-2">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Gender</label>
					  <select class="form-control select2" name="gender" required>
						<option selected value="<?php echo $egender; ?>"><?php echo $egender; ?></option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					  </select>
					</div>
				  </div><!-- col-4 --> 
				  <div class="col-lg-3">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Marital Status</label>
					  <select class="form-control select2" name="maritalstatus"required>
						<option selected value="<?php echo $emp_marital_status; ?>"><?php echo $emp_marital_status; ?></option>
						<option value="married">Married</option>
						<option value="single">Single</option>
						
					  </select>
					</div>
				  </div><!-- col-4 -->
				  
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Date of Birth</label>
					  <input class="form-control fc-datepicker" type="date" name="dob"  value="<?php echo $emp_dob; ?>">
					</div>
				  </div><!-- col-4 --> 
				   <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Nationality</label>
					  <input class="form-control" type="text" name="nationality"  value="<?php echo $emp_nationality; ?>">
					</div>
				  </div><!-- col-4 --> 
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Employment Date</label>
					  <input class="form-control fc-datepicker" type="date" name="employmentdate" value="<?php echo $emp_doe; ?>">
					</div>
				  </div><!-- col-4 -->
				  				  
				
				<div class="col-lg-12">
					<div class="form-group">
					  <h4 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">OTHER DETAILS</h4>
					</div>
				  </div><!-- col-4 -->			
				  <div class="col-lg-3">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Basic Salary</label>
					  <input class="form-control" type="number" <?php if($user_l!='ADMINISTRATOR'){ echo $nonadmin; }?> name="basicsalary"  value="<?php echo $basicsalary; ?>" required>
					</div>
				  </div><!-- col-4 --> 			
				  <div class="col-lg-3">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Bank Name</label>
					
					   <select name="bank" required class="form-control">
						
						<option selected value="<?php echo $ebank; ?>"><?php echo $ebank; ?></option>
								<?php 
								$pataA = mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_banks");
								while ($docA=mysqli_fetch_array($pataA)){
									$bank_code = $docA['bank_code'];
									$bank_name = $docA['bank_name'];
									echo "<option value='$bank_code'>$bank_name</option>";
								}
								?>
					</select>
					</div>
				  </div><!-- col-4 --> 
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Account Branch</label>
					  <input class="form-control" type="text" name="acbranch"  value="<?php echo $bankbranch; ?>">
					</div>
				  </div><!-- col-4 -->
				   <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">Account No</label>
					  <input class="form-control" type="text" name="accno"  value="<?php echo $bankaccount; ?>">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">NSSF No</label>
					  <input class="form-control" type="text" name="nssfno" value="<?php echo $emp_nssfno; ?>">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">NHIF No</label>
					  <input class="form-control" type="text" name="nhifno" value="<?php echo $emp_nhifno; ?>">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-3">
					<div class="form-group">
					  <label class="form-control-label">KRA No.</label>
					  <input class="form-control" type="text" name="kra" value="<?php echo $empkra; ?>">
					</div>
				  </div><!-- col-4 -->
				
				  <div class="col-lg-12">
					<div class="form-group">
					  <div class="col-lg-6 pull-right">						
						<button class="btn btn-primary" name="addEmployee"><i class="fa fa-save"></i> Update Details</button>
					  </div>
					</div>
				  </div><!-- col-4 -->
			</div><!-- form-layout-footer -->
		</div>
		</form>
		
		<form action="" method="post" enctype="multipart/form-data">
			<div class="col-lg-4">
			<div class="row">
				<div class="col-lg-12">
				<?php
				if (isset($_POST['uploadBtn'])) { // if save button on the form is clicked
					
					
					$description = stripslashes(trim($dbconnect->real_escape_string($_POST['description'])));
					$documentcode = stripslashes(trim($dbconnect->real_escape_string($_POST['documentcode'])));
					$fileforempcode=$employee_id;
					
					// name of the uploaded file
					$filename = $_FILES['myfile']['name'];
					// destination of the file on the server
					$destination = 'uploads/' . $filename;
					// get the file extension
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
					// the physical file on a temporary uploads directory on the server
					$file = $_FILES['myfile']['tmp_name'];
					$size = $_FILES['myfile']['size'];
				
								$getcountynamecount =mysqli_query($dbconnect,"SELECT * FROM tbl_employeeuploads WHERE upload_documentcode='$documentcode' AND upload_empidno='$employee_id'");
								$countentries = mysqli_num_rows($getcountynamecount);
				if($countentries>0){
					echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>seems $documentcode was aready uploaded. Delete the current file and upload again to replace</div>";
				}
				else{
					if (!in_array($extension, ['pdf'])) {
						echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>File must be in pdf format!</div>";
					} elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
						echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>File too large!</div>";
						
					} else {
						// move the uploaded (temporary) file to the specified destination
						if (move_uploaded_file($file, $destination)) {
							//echo "nko ndaaaaaani $filename $size!";
							$sql = "INSERT INTO tbl_employeeuploads (upload_filename, upload_size, upload_downloads,upload_documentcode,upload_docdescription,upload_empidno) VALUES ('$filename', $size, 0,'$documentcode','$description','$fileforempcode')";
							if (mysqli_query($dbconnect, $sql)) {
								echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>File uploaded successfully</div>";
							}
						} else {
							echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Failed to upload file</div>";
						}
					}
					
				}
				}
				?>
				</div>
			</div>
			<h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">DOCUMENT UPLOADS</h3>
						<div class="row ibox-content">
						<div class="col-lg-12">
						
						</div>
						<div class="col-lg-12">
                        <div class="form-group">
						  <span class="file-name">Select Item to Upload</span>
									<select name="documentcode" class="form-control" >
										<option value="">Select Document</option>
										<option value="LICENCE">PRACTICE LICENCE</option>
										<option value="DEGREE">DEGREE CERTIFICATE</option>
										<option value="DIPLOMA">DIPLOMA CERTIFICATE</option>
										<option value="CERTIFICATE">COLLEGE CERTIFICATE</option>
										<option value="KCSE">KCSE CERTIFICATE</option>
										<option value="KCPE">KCPE CERTIFICATE</option>
										<option value="CERTIFICATION1">OTHER CERTIFICATION 1</option>
										<option value="CERTIFICATION2">OTHER CERTIFICATION 2</option>
										<option value="CERTIFICATION3">OTHER CERTIFICATION 3</option>
										<option value="MARRIAGE">MARRIAGE CERTIFICATE</option>
									</select>
                        </div>
                      </div>
						<div class="col-lg-12">
								<div class="form-group">
								  <label class="form-control-label">Details (Optional)</label>
								  <input class="form-control" type="text" name="description" placeholder="Description">
								</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								  <label for="file-upload">Browse...<input type="file" id="file-upload" name="myfile"></label>
								<button class="btn btn-primary" type="submit" name="uploadBtn"><i class="fa fa-upload"></i> Upload</button>
							</div>
						</div>
						<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Documents</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr style="background-color:black;color:white;">
									<th>Name</th>
									<th>Description</th>
									<th>Item</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$No=0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_employeeuploads WHERE upload_empidno='$employee_id'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$upload_id = $gcn['upload_id'];
									$upload_documentcode = $gcn['upload_documentcode'];
									$upload_docdescription = $gcn['upload_docdescription'];
									$upload_size = $gcn['upload_size'];
									$upload_filename = $gcn['upload_filename'];
								?>
								<tr>
									<td><?php echo $upload_documentcode; ?></td>
									<td><?php echo $upload_docdescription; ?></td>
									<td><?php echo $upload_size; ?></td>
									<td>
									
									<?php
															if(isset($_GET['upload_idnow'])){
																$deleted = $_GET['upload_idnow'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_employeeuploads WHERE upload_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='employeefullprofile.php?empid=<?php echo $employee_id;?>';
																	</script>	
																	<?php
																}
																else {
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='employeefullprofile.php?empid=<?php echo $employee_id;?>';
																	</script>	
																	<?php
																}
															}
															
															?>
														<a href="employeefullprofile.php?empid=<?php echo $employee_id;?>&upload_idnow=<?php echo $upload_id; ?>"><button class="btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')"> <i class="fa fa-trash"></i></button></a>|<a href="uploads/<?php echo $upload_filename; ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
									</td>
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
		</div>
	</div>
				
				
				
				
				
				
				
				
			</form>
			<form method="post">
				<div class="col-lg-12">
					<div class="form-group">
					<br>
					  <h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">EARNINGS AND DEDUCTIONS FOR <?php echo $firstname; ?> <?php echo $onames; ?></h3>
					</div>
				</div><!-- col-4 -->
			<div class="row">
			<?php if($user_l=='ADMINISTRATOR'){ ?>	
			<div class="col-lg-2">
				<div class="ibox-content">
						 <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['monthly'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Monthly amount is required</div>";
														}
												else {
													
												$pd_activeupto = $dbconnect->real_escape_string($_POST['activeupto']);
												$pd_monthlyremittance = $dbconnect->real_escape_string($_POST['monthly']);
												$pd_noofmonths = $dbconnect->real_escape_string($_POST['noofmonths']);
												$transcode = $dbconnect->real_escape_string($_POST['transcode']);
													$pd_total='0';
													$pd_status='ACTIVE';
													$pd_employeeid=$idno;
													$pd_createdbyid=$sidno;

												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings WHERE `pd_transcategorycode`='$transcode' AND pd_employeeid='$pd_employeeid'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Transaction already exists</div>";
														}
												else {
													$codeportionallowance = 'ALL';
													$codeportiondeduction = 'DED';
													$string = $transcode;
													if(strpos($transcode, $codeportionallowance) !== false){
															$code='ALS';
															$pd_type='ALLOWANCE';
															$pd_debitcredit='CREDIT';
														}
													if(strpos($transcode, $codeportiondeduction) !== false){
															$code='DES';
															$pd_type='DEDUCTION';
															$pd_debitcredit='DEBIT';
														}
													$pd_settingscode= $code.$postnextcode;
																										
													$sql5 ="INSERT INTO `tbl_payroll_allow_ded_settings`(`pd_type`, `pd_settingscode`, `pd_transcategorycode`, `pd_total`, `pd_monthlyremittance`, `pd_noofmonths`, `pd_status`, `pd_activeupto`, `pd_debitcredit`, `pd_employeeid`, `pd_dateofcreation`, `pd_createdbyid`) VALUES ('$pd_type','$pd_settingscode','$transcode','$pd_total','$pd_monthlyremittance','$pd_noofmonths','$pd_status','$pd_activeupto','$pd_debitcredit','$pd_employeeid','$leo_date','$pd_createdbyid')";
													
													
													
													//$sql5 = "INSERT INTO `tbl_services`(`ss_code`, `ss_category`, `ss_subcategory`, `ss_name`) VALUES ('$cod', '$category', '','$name')";
													$result5 = $dbconnect->query($sql5);	
													echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successfully posted</div>";
															}
														}
													}
												?>
											</div>
									 		
										<div class="col-sm-12">
                                                
                                            
											<div class="form-group">
													<label>Category</label>
													<select name="transcode" required class="form-control" >
														<option  value="">Select Type</option>
														<?php 
														$pataHosi = mysqli_query($dbconnect,"SELECT * FROM tbl_payroll_allow_ded_categories WHERE pdc_code LIKE 'AL%'");
														while ($doc=mysqli_fetch_array($pataHosi)){
															$pdc_code = $doc['pdc_code'];
															$pdc_name = $doc['pdc_name'];
															echo "<option value='$pdc_code'>$pdc_name</option>";
														}
														?>
													</select>
											</div>
                                           <div class="form-group">
                                                <label for="monthly">Monthly Amount</label>
                                                <input type="number" class="form-control" id="brand-name"  name="monthly" required>
                                            </div>
											<div class="form-group">
                                                <label for="noofmonths">No. of Repayment Months (Optional - Only for deductions)</label>
                                                <input type="number" class="form-control" id="brand-name" name="noofmonths">
                                            </div>
											<div class="form-group">
                                                <label for="activeupto">Active Upto</label>
                                                <input type="date" class="form-control" id="brand-name" min="<?php echo $leo_date; ?>" name="activeupto">
                                            </div>
											<div class="form-group">
												<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Post </button>
											</div>										
										</div>	
										
										
								</form>
							</div>
				</div><!-- col-4 -->
			</div><!-- col-4 -->
			<?php } ?>
			<div class="col-lg-5">
				<div class="ibox-content">
							<h3>Earnings </h3>
						<div class="table-wrapper">
							<table class="table dataTables-example table-bordered table-colored table-dark responsive wrap">
							  <thead>
								<tr>
								  <th>Code</th>
								  <th>Name</th>
								  <th>Amount</th>
								  <th>ActiveUpto</th>
								</tr>
							  </thead>
							  <tbody>
								  <?php
										$sqlall = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_type='ALLOWANCE' AND pd_employeeid='$employee_id' AND pd_activeupto>='$leo_date'");
										while($row4sql = mysqli_fetch_array($sqlall)){
											$pd_settingscode= $row4sql["pd_settingscode"];
											$allowancename= $row4sql["pdc_name"];
											$monthlyamount= $row4sql["pd_monthlyremittance"];
											$pd_activeupto= $row4sql["pd_activeupto"];
											$pd_transcategorycode= $row4sql["pd_transcategorycode"];
													echo "
														<tr>
														  <td>$pd_settingscode</td>
														  <td>$allowancename</td>
														  <td>$monthlyamount</td>
														  <td>$pd_activeupto</td>
														</tr>
													";
												}
											  ?>
								</tbody>
							</table>
					</div>  
				</div><!-- col-4 -->
				</div><!-- col-4 -->
				
				
			<div class="col-lg-5">
				<div class="ibox-content">
						<h3>Deductions </h3>
					<div class="table-wrapper">
				<table class="table dataTables-example table-bordered table-colored table-dark responsive wrap">
				  <thead>
					<tr>
					  <th>Code</th>
					  <th>Name</th>
					  <th>Total Applied</th>
					  <th>Monthly Remittance</th>
					  <th>ActiveUpto</th>
					  
					</tr>
				  </thead>
				  <tbody>
					  <?php
							$sqlall = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_type='DEDUCTION' AND pd_employeeid='$employee_id'");
					while($row4sql = mysqli_fetch_array($sqlall)){
								$pd_settingscode= $row4sql["pd_settingscode"];
								$allowancename= $row4sql["pdc_name"];
								$pdc_total= $row4sql["pd_total"];
								$monthlyamount= $row4sql["pd_monthlyremittance"];
								$pd_activeupto= $row4sql["pd_activeupto"];
								$pd_transcategorycode= $row4sql["pd_transcategorycode"];
										echo "
											<tr>
											  <td>$pd_settingscode</td>
											  <td>$allowancename</td>
											  <td>$pdc_total</td>
											  <td>$monthlyamount</td>
											  <td>$pd_activeupto</td>
											</tr>
										";
									}
								  ?>
					</tbody>
				</table>
				</div>  
				</div><!-- col-4 -->
			</div><!-- col-4 -->
			
			
			
			
			
			
			
			
			</div>
				</form>
            
				</div>
			</div><!-- row -->
			
		  </div> 
			
		  
        </div><!-- br-section-wrapper --> 
			   
			   
			   
       <!-- </div> End of original wrapper--->

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
