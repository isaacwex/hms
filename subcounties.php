<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Sub Counties Management - <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="subcounties.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Sub-County</span></button></a></span></p>
							
						</div>				
					</div>
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Sub County</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newsubcounty'])){
												if(empty($_POST['subcounty'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Sub county name is required.</div>";
														}
														
												else {
												$sub_county = $dbconnect->real_escape_string($_POST['subcounty']);
												$loc_type = "2";
												$loc_parent_id = $dbconnect->real_escape_string($_POST['yes_county']);
															
												$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_locations WHERE location_name='$sub_county' AND location_type='$loc_type'");
												$countNo = mysqli_num_rows($checknumber);
												if($countNo >= 1){
														echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> The sub county $sub_county already exists.</div>";
																
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_locations (location_name, location_type, location_parent_id) VALUES (?,?,?)")){
													$stmt->bind_param('sss',$sub_county, $loc_type, $loc_parent_id);
													$stmt->execute();
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> The sub county $sub_county has been defined successfully.</div>";
													}
													else {
														
														echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error definining sub county</div>";
																	
																}
															}
															
														}
														
													}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>County</label>
													<select name="yes_county" class="form-control" required>
														<option value="" selected="selected">Choose County</option>
														<?php
														$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='1'");
														while($gal = mysqli_fetch_array($getalllocations)){
															$loctype = $gal['location_id'];
															$locname = $gal['location_name'];
																	
															?>
															<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
															<?php
															}
															?>
													</select>
												</div>
												<div class="form-group">
													<label>Sub County Name</label>
													<input type="text" name="subcounty" placeholder="Sub County" class="form-control">
												</div>
												<div class="form-group">
													<button name="newsubcounty" class="btn btn-md btn-primary" type="submit">Add Sub County</button>
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
                            <h5>Sub Counties</h5>
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
									<th>Sub County Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='2'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$subcounty_code = $gcn['location_id'];
									$sub_county_name = $gcn['location_name'];
									$county_code = $gcn['location_parent_id'];
									
									$getcountiesname = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$county_code'");
									$get_cname = mysqli_fetch_array($getcountiesname);
									$countyname = $get_cname['location_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $subcounty_code; ?></td>
									<td><?php echo $countyname; ?></td>
									<td><?php echo $sub_county_name; ?></td>
									<td><a href="edit-subcounty.php?subid=<?php echo $subcounty_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</button></a> | 
									<?php
											if(isset($_GET['delete'])){
												$deleted = $_GET['delete'];
												$action = mysqli_query($dbconnect,"DELETE FROM tbl_locations WHERE location_id='$deleted'");
												if($action){
													?>
													<script>
														alert('Sub county successfully deleted');
															window.location = 'subcounties.php';
													</script>	
													<?php
												}
												else {
													?>
													<script>
														alert('Error deleting message');
															window.location = 'subcounties.php';
													</script>	
													<?php
												}
											}
											?>
									<a href="subcounties.php?delete=<?php echo $subcounty_code;?>">
										<button onclick="return confirm('Are you sure you delete <?php echo $sub_county_name; ?> sub county?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button></a>
									</td>
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
									<th>Sub County Name</th>
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
