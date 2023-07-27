<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(supplier_code) as OPNO FROM tbl_suppliers");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,3,"0",STR_PAD_LEFT);
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Suppliers - <?php echo "$smart_name"; ?></title>
	
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

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Supplier</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Supplier</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['suppliername'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
												$suppliercode = $postnextcode;
												$Suppliername = $dbconnect->real_escape_string($_POST['suppliername']);
												$supplierphone = $dbconnect->real_escape_string($_POST['supplierphone']);
												$supplieremail = $dbconnect->real_escape_string($_POST['supplieremail']);
												$supplieraddress = $dbconnect->real_escape_string($_POST['supplieraddress']);
															
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_suppliers WHERE supplier_code='$suppliercode'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Code or name already exists.</div>";
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_suppliers (supplier_code, supplier_name, supplier_phone,supplier_address,supplier_email) VALUES (?,?,?,?,?)")){
													$stmt->bind_param('sssss',$suppliercode,$Suppliername,$supplierphone,$supplieremail,$supplieraddress);
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
													<label>Supplier Code</label>
													<input type="text" name="suppliercode"disabled value="<?php echo $postnextcode; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Supplier Name</label>
													<input type="text" name="suppliername" placeholder="Name" class="form-control">
												</div>
												<div class="form-group">
													<label>Supplier Phone</label>
													<input type="text" name="supplierphone" placeholder="Phone" class="form-control">
												</div>
												<div class="form-group">
													<label>Supplier Email</label>
													<input type="text" name="supplieremail" placeholder="Email" class="form-control">
												</div>
												<div class="form-group">
													<label>Supplier Address</label>
													<input type="text" name="supplieraddress" placeholder="Address" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Supplier</button>
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
                            <h5>Suppliers</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>Supplier Code</th>
									<th>Supplier Name</th>
									<th>Supplier Phone</th>
									<th>Supplier Email</th>
									<th>Supplier Address</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_suppliers");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$supplier_code = $gcn['supplier_code'];
									$supplier_name = $gcn['supplier_name'];
									$supplier_phone = $gcn['supplier_phone'];
									$supplier_email = $gcn['supplier_email'];
									$supplier_address = $gcn['supplier_address'];
								
								?>
									<td><?php echo $supplier_code; ?></td>
									<td><?php echo $supplier_name; ?></td>
									<td><?php echo $supplier_phone; ?></td>
									<td><?php echo $supplier_email; ?></td>
									<td><?php echo $supplier_address; ?></td>
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
