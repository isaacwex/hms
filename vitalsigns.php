<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Vital Services - <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Vital Sign</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Vital Sign</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['vitalcode'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
												$vitalcode = $dbconnect->real_escape_string($_POST['vitalcode']);
												$vitalname = $dbconnect->real_escape_string($_POST['vitalname']);
												$vitalunit = $dbconnect->real_escape_string($_POST['vitalunit']);
												$loc_type = "1";
												$loc_parent = "0";
															
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_vitals WHERE vital_code='$vitalcode'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! a similar code already exists</div>";
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_vitals (vital_code, vital_name, vital_unit) VALUES (?,?,?)")){
													$stmt->bind_param('sss',$vitalcode, $vitalname, $vitalunit);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Successful</div>";
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while creating</div>";	
																}
															}
														}
													}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>Vital Sign Code</label>
													<input type="text" name="vitalcode" placeholder="Vital Sign Code" class="form-control">
												</div>
												<div class="form-group">
													<label>Vital Sign Name</label>
													<input type="text" name="vitalname" placeholder="Vital Sign Name" class="form-control">
												</div>
												<div class="form-group">
													<label>Vital Sign Unit of Measure</label>
													<input type="text" name="vitalunit" placeholder="Vital Sign Units" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Vital Sign</button>
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
                            <h5>Vital Signs</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Vital Sign Code</th>
									<th>Vital Sign Name</th>
									<th>Vital Sign Unit of Measure</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_vitals");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$vitalid = $gcn['vital_id'];
									$vital_code = $gcn['vital_code'];
									$vital_name = $gcn['vital_name'];
									$vital_unit = $gcn['vital_unit'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $vital_code; ?></td>
									<td><?php echo $vital_name; ?></td>
									<td><?php echo $vital_unit; ?></td>
									<td><a href="edit-vitalsigns.php?vital_id=<?php echo $vitalid; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> </button></td>
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
