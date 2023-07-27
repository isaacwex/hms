<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Discharge<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$opno=$_GET['opno'];
	$visitno=$_GET['visitno'];
	$bill_id=$_GET['bill_id'];
	$No = 0;
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE visit_no='$visitno' AND opno='$opno'");
		
		while($gac = mysqli_fetch_array($getPatients)){
			$No=$No+1;
			$c_id = $gac['reg_no'];
			$fnames = $gac['f_name'];
			$lnames = $gac['l_name'];
			$id_number = $gac['id_no'];
			$phonenumber = $gac['phone_no'];
			$gender = $gac['gender'];
			$dob = $gac['dob'];
			$opno = $gac['opno'];
			$visitno = $gac['visit_no'];
			$residence = $gac['residence'];
			$visit_date = $gac['visit_date'];
			$todaydate = date('Y-m-d');
		}									
	
	$date1 = $dob;
	$date2 = $todaydate;
	
	$diff = date_diff(date_create($dob), date_create($todaydate));
	$agess = $diff->format('%y');
	
	
				$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_billing WHERE bill_id='$bill_id'");
				$lrarray = mysqli_fetch_array($getls);
					$billservicename = $lrarray['bill_servicename'];
					$bill_qty = $lrarray['bill_qty'];
					$billamount = $lrarray['bill_amount'];
					$bill_visitno = $lrarray['bill_visitno'];
					$bill_opno = $lrarray['bill_opno'];
					$bill_id = $lrarray['bill_id'];
					
	if(isset($_GET['opip'])){
				$opip=$_GET['opip'];
				$pcategory=$_GET['pcategory'];
				$vis=$_GET['vis'];
				$pprevious=$_GET['pprevious'];
				$page="invoicer.php?current_processstage=$pprevious&opip=$opip&vis=$vis&pcategory=$pcategory";
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
            </div>
			<div class="wrapper wrapper-content">
                <div class="row">					
								
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
						    <div class="modal-body">
											<div class="row">
											<span></span>
												<form role="form" method="post">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['add-consultations'])){
														if(empty($_POST['unitamt'])){
															echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> dischargestate  required.
																</div>";
														}
														else {		
															$opno;
															$visitno;
															
															$unitamt = $_POST['unitamt'];
															$qty = $_POST['qty'];
															$bill_id = $_POST['bill_id'];
															
																$settings_action = "UPDATE tbl_billing SET bill_qty=?, bill_amount=? WHERE bill_id='$bill_id'";
																
																if($stmt = $dbconnect->prepare($settings_action)){
																	$stmt->bind_param('ss',$qty,$unitamt);
																	$stmt->execute();
																		echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button> Changes Saved </div>";
																		
																		//header($page);
																}
																else {
																	echo "<div class=\"alert alert-danger alert-dismissable\">
																			<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>An Error occurred while updating details</div>";
																}
														
														}
													}
												?>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-4">
														<b>Name:</b> <i><?php echo $fnames; ?> <?php echo $lnames; ?></i></br>
														<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
													</div>
													<div class="col-sm-4">
														<b>Opno:</b> <i><?php echo $opno; ?></i></br>
														<b>Visit No:</b> <i><?php echo $visitno; ?></i></br>
													</div>
													<div class="col-sm-4">
														<b>Gender:</b> <i><?php echo $gender; ?></i></br>
														<b>Residence:</b> <i><?php echo $residence; ?></i></br>
													</div>
													<div class="col-sm-4">
														<input type="text" name="bill_id" readonly required value="<?php echo $bill_id; ?>" class="form-control">
													</div>
												</div>
													<br>
													<br>
													<br>
													<hr>
													<b>Item Name:</b> <i><?php echo $billservicename; ?></i></br></b>
													<hr>
													
													<div class="col-sm-12">
														<div class="col-sm-4"> 
															<div class="form-group">
																<label>Quantity</label>
																<input type="text" name="qty" required value="<?php echo $bill_qty; ?>" class="form-control">
															</div>
														</div>
														<div class="col-sm-4"> 
															<div class="form-group">
																<label>Unit Amount</label>
																<input type="text" name="unitamt" required value="<?php echo $billamount; ?>" class="form-control">
															</div>
														</div>
														
													</div>														
														
														<div class="col-lg-4">
															<div class="form-group">
																<button name="add-consultations" class="btn btn-md btn-primary" type="submit">Save Changes</button>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<p class="pull-right">
																	<span><a href='<?php echo $page; ?>'><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold">Go Back  </span></button></a></span>

																</p>
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