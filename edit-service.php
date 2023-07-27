<?php include('includes/authenticate.php'); ?>
<?php
	$service_id = $_GET['service_id'];
	$get_service = mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints WHERE process_id='$service_id'");
	$gs = mysqli_fetch_array($get_service);
	$serve_id = $gs['process_id'];
	$service_code = $gs['process_code'];
	$service_name = $gs['process_name'];
	$service_unik = $gs['process_uniquecode'];
	$service_prname = $gs['process_servicename'];
	
	$servicenamelower = strtolower($service_name);


?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Edit <?php echo ucwords($servicenamelower); ?>- <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add clinic Service</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Clinic Service</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['editservice'])){
											if(empty($_POST['servicename'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> County name is required</div>";
														}
												else {
												$served_id = $dbconnect->real_escape_string($_POST['serviceid']);
												$serve_name = $dbconnect->real_escape_string($_POST['servicename']);
												$loc_type = "1";
												$loc_parent = "0";
															
												if($stmt = $dbconnect->prepare("UPDATE tbl_processpoints SET process_name=? WHERE process_id='$served_id'")){
													$stmt->bind_param('s',$serve_name);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-check-square-o\"></i> Clinic service <b>$serve_name</b> has been modified successfully. Redirecting in 2 seconds ...</div>";
														
														echo '<META HTTP-EQUIV="Refresh" content="2; ">';
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating $serve_name drug</div>";	
														}
													}
												}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<input type="hidden" name="serviceid" value="<?php echo $serve_id; ?>">
													<label>Sevice Code</label>
													<input type="text" name="servicecode" readonly placeholder="Service Name" value="<?php echo $service_code; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Sevice Name</label>
													<input type="text" name="servicename" placeholder="Service Name" class="form-control" value="<?php echo $service_name; ?>">
												</div>
												<div class="form-group">
													<button name="editservice" class="btn btn-md btn-info" type="submit"><i class="fa fa-edit"></i> Update Clinic Service</button>
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
                            <h5>Clinic Services</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Service Code</th>
									<th>Service Name</th>
									<th>Manage</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints WHERE process_status='1'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$process_id = $gcn['process_id'];
									$process_code = $gcn['process_code'];
									$process_name = $gcn['process_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $process_code; ?></td>
									<td><?php echo $process_name; ?></td>
									<td><a href="edit-service.php?service_id=<?php echo $process_id; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> </button></td>
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
