<?php include('includes/authenticate.php'); ?>
<?php
	$vi_id = $_GET['vital_id'];
	
	$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_vitals WHERE vital_id = $vi_id");
	$gc = mysqli_fetch_array($getvitals);
	
	$v_id = $gc['vital_id'];
	$v_code = $gc['vital_code'];
	$v_name = $gc['vital_name'];
	$v_unit = $gc['vital_unit'];


?>


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
												$vitalid = $dbconnect->real_escape_string($_POST['vitalsignid']);
												//$vitalcode = $dbconnect->real_escape_string($_POST['vitalcode']);
												$vitalname = $dbconnect->real_escape_string($_POST['vitalname']);
												$vitalunit = $dbconnect->real_escape_string($_POST['vitalunit']);
												$loc_type = "1";
												$loc_parent = "0";
															
												if($stmt = $dbconnect->prepare("UPDATE tbl_vitals SET vital_name=?, vital_unit=? WHERE vital_id='$vitalid'")){
													$stmt->bind_param('ss',$vitalname,$vitalunit);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-check-square-o\"></i> The vital sign: <b>$vitalname</b> has been modified successfully. Redirecting in 2 seconds ...</div>";
														
														echo '<META HTTP-EQUIV="Refresh" content="2; ">';
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating $vitalname sign</div>";	
														}
													}
												
												
												}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<input type="hidden" name="vitalsignid" value="<?php echo $v_id; ?>" />
													<label>Vital Sign Code</label>
													<input type="text" name="vitalcode" readonly placeholder="Vital Sign Code" value="<?php echo $v_code; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Vital Sign Name</label>
													<input type="text" name="vitalname" placeholder="Vital Sign Name" value="<?php echo $v_name; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Vital Sign Unit of Measure</label>
													<input type="text" name="vitalunit" placeholder="Vital Sign Unit" value="<?php echo $v_unit; ?>" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-edit"></i> &nbps; Update Vital Sign</button>
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
