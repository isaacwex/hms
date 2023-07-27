<?php include('includes/authenticate.php');
$sub_county_id = $_GET['subid'];

$getsubcountydetails = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$sub_county_id'");
$cdet = mysqli_fetch_array($getsubcountydetails);
$c_id = $cdet['location_parent_id'];
$sub_names = $cdet['location_name'];


$getcounty = mysqli_query($dbconnect,"SELECT location_name FROM tbl_locations WHERE location_id='$c_id'");
$c_n = mysqli_fetch_array($getcounty);
$county_name = $c_n['location_name'];
 ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Edit <?php echo ucwords(strtolower($sub_names)); ?> Sub County - <?php echo "$smart_name"; ?></title>
	
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
							<span><a href="master.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Update Sub County Details</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Update Sub County Details</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['updatesubcounty'])){
											if(empty($_POST['subcountyname'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> County name is required</div>";
														}
												else {
												$sub_county_name = $dbconnect->real_escape_string($_POST['subcountyname']);
															
													if($stmt = $dbconnect->prepare("UPDATE tbl_locations SET location_name=? WHERE location_id='$sub_county_id'")){
													$stmt->bind_param('s',$sub_county_name);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-check-square-o\"></i> $sub_county_name updated successfully</div>";
														
														//echo '<META HTTP-EQUIV="Refresh" content="2; ">';
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating sub county name</div>";	
														}
													}													
												}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>County Name</label>
													<input type="text" name="countyname" value="<?php echo $county_name; ?>" disabled class="form-control">
												</div>
												<div class="form-group">
													<label>Sub County Name</label>
													<input type="text" name="subcountyname" value="<?php echo $sub_names; ?>" class="form-control">
												</div>
												<div class="form-group">
													<button name="updatesubcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Update Sub County</button>
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
									<td><a href="edit-subcounty.php?subid=<?php echo $subcounty_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</button></a> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>
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
