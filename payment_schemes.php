<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Payment Schemes - <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Payment Scheme</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Payment Scheme</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['schemecode'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
												$schemecode = $dbconnect->real_escape_string($_POST['schemecode']);
												$schemename = $dbconnect->real_escape_string($_POST['schemename']);
												$schemedetails = $dbconnect->real_escape_string($_POST['schemedetails']);
															
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_paymentschemes WHERE pscheme_code='$schemecode' OR pscheme_name='$schemename'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Code or name already exists.</div>";
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_paymentschemes (pscheme_code, pscheme_name, pscheme_details) VALUES (?,?,?)")){
													$stmt->bind_param('sss',$schemecode, $schemename, $schemedetails);
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
													<label>Scheme Code</label>
													<input type="text" name="schemecode" placeholder="Code" class="form-control">
												</div>
												<div class="form-group">
													<label>Scheme Name</label>
													<input type="text" name="schemename" placeholder="Name" class="form-control">
												</div>
												<div class="form-group">
													<label> Scheme Details</label>
													<input type="text" name="schemedetails" placeholder="Details" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Payment Scheme</button>
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
                            <h5>Payment Schemes</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Scheme Code</th>
									<th>Scheme Name</th>
									<th>Scheme Details</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$vital_code = $gcn['pscheme_code'];
									$vital_name = $gcn['pscheme_name'];
									$vital_unit = $gcn['pscheme_details'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $vital_code; ?></td>
									<td><?php echo $vital_name; ?></td>
									<td><?php echo $vital_unit; ?></td>
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
