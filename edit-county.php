<?php include('includes/authenticate.php');
$county_id = $_GET['county_id'];

$getcountydetails = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$county_id'");
$cdet = mysqli_fetch_array($getcountydetails);
$c_names = $cdet['location_name'];

 ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Edit <?php echo ucwords(strtolower($c_names)); ?> County - <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="master.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Update County Details</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Update County Details</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['updatecounty'])){
											if(empty($_POST['countyname'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> County name is required</div>";
														}
												else {
												$county_name = $dbconnect->real_escape_string($_POST['countyname']);
															
												if($stmt = $dbconnect->prepare("UPDATE tbl_locations SET location_name=? WHERE location_id='$county_id'")){
													$stmt->bind_param('s',$county_name);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> $county_name name modified successfully</div>";
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating county name</div>";	
														}
													}													
												}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>County Name</label>
													<input type="text" name="countyname" value="<?php echo $c_names; ?>" class="form-control">
												</div>
												<div class="form-group">
													<button name="updatecounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Update County</button>
												</div>	
											</div>																							
								</form>
							</div>
						</div> 
					 </div>
					</div>
					
					
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Counties</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Code</th>
									<th>County Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='1'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$county_code = $gcn['location_id'];
									$county_name = $gcn['location_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $county_code; ?></td>
									<td><?php echo $county_name; ?></td>
									<td><a href="edit-county.php?county_id=<?php echo $county_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a> | <?php
											if(isset($_GET['delete'])){
												$deleted = $_GET['delete'];
												$action = mysqli_query($dbconnect,"DELETE FROM tbl_locations WHERE location_id='$deleted'");
												if($action){
													?>
													<script>
														alert('County successfully deleted');
															window.location = 'counties.php';
													</script>	
													<?php
												}
												else {
													?>
													<script>
														alert('Error deleting message <?php echo "$dbconnect->error()";?>');
															window.location = 'counties.php';
													</script>	
													<?php
												}
											}
											?>
									<a href="counties.php?delete=<?php echo $county_code;?>">
										<button onclick="return confirm('Are you sure you delete <?php echo $county_name; ?> county?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button>
									</a></td>
								</tr>
								<?php
								}
								?>
								
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>Code</th>
									<th>County Name</th>
									<th>Action</th>
								</tr>
								</tfoot>
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
