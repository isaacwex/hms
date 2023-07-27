<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Invoicing Patients<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
<?php
	$opno=$_GET['opno'];
	$visitno=$_GET['visitno'];
	$prescription_invid=$_GET['inventory_id'];
	$prescription_id=$_GET['prescription_id'];
	$current_processstage=$_GET['current_processstage'];
	$quantity=$_GET['qty'];
	$prescription_scheme=$_GET['schemep'];
	
			if($current_processstage=='PHARMACY'){
				$page='pharmacy.php';
			}
			
			elseif($current_processstage='PHARMACYIP'){
				$page='pharmacyip.php';
			}
			else{
				echo 'Error Occurrred';
			}


	
	
//getting patoent details
	$No = 0;
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes s ON r.scheme_code=s.pscheme_code INNER JOIN tbl_paymentschemes ps ON ps.pscheme_code=r.scheme_code WHERE r.visit_no='$visitno' AND r.opno='$opno'");	
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
			$scheme_code = $gac['scheme_code'];
			$pscheme_name = $gac['pscheme_name'];
			$memberno = $gac['memberno'];
		}									
	$date1 = $dob;
	$date2 = $todaydate;
	
	$diff = date_diff(date_create($dob), date_create($todaydate));
	$agess = $diff->format('%y');

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
				<h2>Pharmacy</h2>
				<ol class="breadcrumb">
					<li>
						<a href="invoicer.php">Despensing</a>
					</li>                        
					<li class="active">
						<strong>Dispensing Drugs</strong>
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
								<form role="form" method="post">
								
								<div class="col-lg-4">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Drug Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row well well-sm">
											<div class="col-sm-12">
											<b>Name:</b> <i><?php echo $fnames; ?> <?php echo $lnames; ?></i></br>
											<b>Age:</b> <i><?php echo $agess; ?> years</i></br>
											</div>
											<div class="col-sm-12">
												<b>Opno:</b> <i><?php echo $opno; ?></i></br>
												<b>Visit No:</b> <i><?php echo $visitno; ?></i></br>
											</div>
											<div class="col-sm-12">
												<b>Gender:</b> <i><?php echo $gender; ?></i></br>
												<b>Residence:</b> <i><?php echo $residence; ?></i></br>
											</div>
											
										</div>
									</div>
								 </div>
								</div>
								
								<div class="col-lg-8">					
									<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Drug Details </h5>
									</div>
									<div class="ibox-content">
									   <div class="row well well-sm">
								<div class="col-sm-12">													
								<?php
									if(isset($_POST['completepay'])){
										$prescription_status='CLOSED';
								
											// Get the Opno and the visito for the variable $c_id in table 'registry' 
											//update the product stock quantity in table 'inventory' with the values provided in 'tbl_prescriptions'
											//insert the transaction into the 'order'
											//insert list of prescribtions into the table 'order_items'
											
											
											$update_item = "UPDATE tbl_prescriptions SET prescription_status=? WHERE prescription_id='$prescription_id'";
													if($stmt = $dbconnect->prepare($update_item)) {
														$stmt->bind_param('s',$prescription_status);
														$stmt->execute();
														echo "updated now";
											$curentstock = mysqli_query($dbconnect, "SELECT * FROM `tbl_inventory` WHERE `inve_id`='$prescription_invid'");	
											$mystock = mysqli_fetch_array($curentstock);
											$inve_qty=$mystock['inve_qty'];
											$remstock=$inve_qty-$quantity;
											$inve_drugcode=$mystock['inve_drugcode'];
											$inve_drugname=$mystock['inve_drugname'];
											$inve_purchaseprice=$mystock['inve_purchaseprice'];
											$inve_batchno=$mystock['inve_batchno'];
											
											$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$inve_drugcode' AND `scheme`='$prescription_scheme'");$rrow = mysqli_fetch_array($price);
											$rrowprice = $rrow['price'];
											$inve_qty=$mystock['inve_qty'];
											$inv=$opno."/".$visitno;
											$datee=date('Y-m-d');
											$profit=$rrowprice-$inve_purchaseprice;
											
											
											$update_inve = "UPDATE `tbl_inventory` SET `inve_qty`=? WHERE `inve_id`='$prescription_invid'";
											if($stmt2 = $dbconnect->prepare($update_inve)) {
														$stmt2->bind_param('s',$remstock);
														$stmt2->execute();
											$sql5 = "INSERT INTO `tbl_prescriptionsales`(`sale_itemcode`,`sale_name`,`sale_amount`,`sale_receiptno`, `sale_soldby`, `sale_profit`, `sale_customertype`,`sale_schemecode`,`sale_modeofpayment`, `sale_discount`, `sale_taxpercentage`, `sale_taxamount`,`sale_status`,`batch`,`datee`,`sale_patientopno`,`sale_patientvisitno`) VALUES('$inve_drugcode','$inve_drugname','$rrowprice','$inv','$sidno','$profit','OUTPATIENT','$prescription_scheme','CREDIT','0','0','0','completed','$inve_batchno','$datee','$opno','$visitno')";
											if($result5 = $dbconnect->query($sql5)){
													echo "Dispensed Succesfully";
													//refresh page
													echo "<meta http-equiv='refresh' content='0;url=$page'>";
											  }
											}
										}
								}
								?>
								</div>	
										<div class="col-sm-12">
										<?php
										$curentstock = mysqli_query($dbconnect, "SELECT * FROM `tbl_inventory` WHERE `inve_id`='$prescription_invid'");	
											$mystock = mysqli_fetch_array($curentstock);
											$inve_qty=$mystock['inve_qty'];
											$inve_drugcode=$mystock['inve_drugcode'];
											$inve_drugname=$mystock['inve_drugname'];
											
											
										echo "$inve_drugcode - $inve_drugname | $quantity";
										echo "<br>";
										?>
										</div>
										<hr>
											<div class="col-lg-4">
												<div class="form-group">
													<p class="pull-right">
														<button name="completepay" class="btn btn-md btn-warning" type="submit">Dispense Now</button>
													</p>
												</div>
											</div>
											<div class="col-lg-4">
											</div>
											<div class="col-lg-4">
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