<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_pettycash");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Petty Cash - <?php echo "$smart_name"; ?></title>
	
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
				<h2>Financial</h2>
				<ol class="breadcrumb">
					<li>
						<a href="petty.php"> Petty Cash</a>
					</li>                        
					<li class="active">
						<strong>New Transaction</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Category</span></button></a></span></p>
				</div>
		</div>

        <div class="wrapper wrapper-content">
                <div class="row">					
								
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Post Transaction</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['petty_name'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
												
													
													
												//$todaydate = date('Y-m-d');
												$petty_transcode = $postnextcode;
												//$petty_code = $dbconnect->real_escape_string($_POST['petty_code']);
												$todaydate = $dbconnect->real_escape_string($_POST['todaydate']);
												$petty_name = $dbconnect->real_escape_string($_POST['petty_name']);
												$petty_creditdebit = $dbconnect->real_escape_string($_POST['petty_creditdebit']);
												$petty_category = $dbconnect->real_escape_string($_POST['petty_category']);
												$payment_method = $dbconnect->real_escape_string($_POST['payment_method']);
												$petty_channeldetails = $dbconnect->real_escape_string($_POST['petty_channeldetails']);
												$petty_amount = $dbconnect->real_escape_string($_POST['petty_amount']);
												$petty_poster = "$sfname $ssname";
															
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_pettycash WHERE petty_transcode='$petty_transcode'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Code or name already exists.</div>";
														
														}
												else {
													$checklasttrans = mysqli_query($dbconnect, "SELECT * FROM tbl_pettycash WHERE petty_transcode='$opnos'");
													
													$gcn1 = mysqli_fetch_array($checklasttrans);
													$bookbalance = $gcn1['petty_bookbalance'];
													
														if($petty_creditdebit=='DEBIT'){
															$newbookbalance=$bookbalance-$petty_amount;
														}
														elseif($petty_creditdebit=='CREDIT'){
															$newbookbalance=$bookbalance-$petty_amount;
														}
														else{
															echo "error occurred generating book balance";
														}
														
													
													
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_pettycash (petty_transcode, petty_name, petty_creditdebit,petty_category,petty_channelmode,petty_channeldetails,petty_postdate,petty_amount,petty_postedby,petty_bookbalance) VALUES (?,?,?,?,?,?,?,?,?,?)")){
													$stmt->bind_param('ssssssssss',$petty_transcode,$petty_name,$petty_creditdebit,$petty_category,$payment_method,$petty_channeldetails,$todaydate,$petty_amount,$petty_poster,$newbookbalance);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successful</div>";
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured </div>";	
																}
															}
														}
													}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>Code</label>
													<input type="text" name="petty_code" disabled value="<?php echo $postnextcode; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label> Name</label>
													<input type="text" name="petty_name" placeholder="Name" class="form-control">
												</div>
												<div class="form-group">
													<label> Amount</label>
													<input type="number" name="petty_amount" placeholder="Amount" class="form-control">
												</div>
												<div class="form-group">
													<label>Debit/Credit</label>
													<select data-placeholder="Choose Debit/Credit" name="petty_creditdebit" class="form-control">
												
														<option selected value="">Choose from List </option>
														<option value="DEBIT">DEBIT </option>
														<option value="CREDIT">CREDIT </option>
													</select>
												</div>
												<div class="form-group">
												<label>Category</label>
												<select data-placeholder="Choose mode" name="petty_category" class="form-control chosen-select">
												
														<option selected value="">Select from List </option>
														<?php
													$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_pettycash_categories");
													while($ga = mysqli_fetch_array($getalllocationss)){
														$pcc_code = $ga['pcc_code'];
														$pcc_name = $ga['pcc_name'];
														?>
														<option value="<?php echo $pcc_code; ?>" ><?php echo $pcc_name; ?></option>
														<?php
													}
													?>
												</select>
																								
											</div>
											<div class="form-group">
												<label>Payment Mode</label>
												<select data-placeholder="Choose mode" name="payment_method" class="form-control">
												
														<option selected value="">Select from List </option>
														<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentmethods");
													while($gal = mysqli_fetch_array($getalllocations)){
														$pm_code = $gal['pm_code'];
														$pm_name = $gal['pm_name'];
														?>
														<option value="<?php echo $pm_code; ?>" ><?php echo $pm_code; ?></option>
														<?php
													}
													?>
												</select>
																								
											</div>
												<div class="form-group">
													<label>Channel Details</label>
													<input type="text" name="petty_channeldetails" placeholder="Details" class="form-control">
												</div>
												<div class="form-group">
													<label>Post Date</label>
													<input type="date" name="todaydate" value="<?php echo $todaydate;?>" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Post Transaction</button>
												</div>	
											</div>																							
								</form>
							</div>
						</div>
					 </div>
					</div>
					
					
					<div class="col-lg-8">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Transactions</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table dataTables-example" >
								<thead>
								<tr>
									<th>Date</th>
									<th>Trans Code</th>
									<th>Name</th>
									<th>Mode</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_pettycash LIMIT 50");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$petty_postdate = $gcn['petty_postdate'];
									$petty_transcode = $gcn['petty_transcode'];
									$petty_name = $gcn['petty_name'];
									$petty_channelmode = $gcn['petty_channelmode'];
									$petty_amount = $gcn['petty_amount'];
									$petty_creditdebit = $gcn['petty_creditdebit'];
									$petty_bookbalance = $gcn['petty_bookbalance'];
								
								?>
									<td><?php echo $petty_postdate; ?></td>
									<td><?php echo $petty_transcode; ?></td>
									<td><?php echo $petty_name; ?></td>
									<td><?php echo $petty_channelmode; ?></td>
									<td>
									<?php if($petty_creditdebit=='DEBIT'){
									echo $petty_amount;} ?>
									</td>
									<td>
									<?php if($petty_creditdebit=='CREDIT'){
									echo $petty_amount; } ?>
									</td>
									<td><?php echo $petty_bookbalance; ?></td>
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
