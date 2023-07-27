<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Laboratory Services - <?php echo "$smart_name"; ?></title>
	
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
						<h2>ALL SERVICES </h2>
							<span><a href="#"></a></span></p>
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Service</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['lsname'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> County name is required</div>";
														}
												else {
												$lsname = $dbconnect->real_escape_string($_POST['lsname']);
												$loc_type = "1";
												$loc_parent = "0";
												//$labservice_pscheme = $dbconnect->real_escape_string($_POST['labservice_pscheme']);
												//$labservice_pscheme = $ps_code;
												$lscode = $dbconnect->real_escape_string($_POST['lscode']);
												$lsname = $dbconnect->real_escape_string($_POST['lsname']);
												$lscost = $dbconnect->real_escape_string($_POST['lscost']);
												
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_labservices WHERE labservice_code='$lscode' OR labservice_name='$lsname'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Already exists</div>";
														}
												else {
													
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_labservices (labservice_code, labservice_name, labservice_cost,labservice_pscheme) VALUES (?,?,?,?)")){
													$stmt->bind_param('ssss',$lscode, $lsname, $lscost, $ps_code);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Successful</div>";
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured</div>";	
																}
															}
														}
													}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
														<label><h4>Category</h4></label>
											
														<select data-placeholder="Choose category..." name="servicecategory" class="form-control chosen-select">
														
																<option selected value="">Select from List </option>
																<?php
															$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_servicecategories");
															while($gal = mysqli_fetch_array($getalllocations)){
																$sc_code = $gal['sc_code'];
																$sc_name = $gal['sc_name'];
																
																?>
																<option value="<?php echo $sc_code; ?>"><?php echo $sc_name; ?></option>
																<?php
															}
															?>
														</select>
												</div>	
												<div class="form-group">
													<label>Sevice Code</label>
													<input type="text" name="lscode" placeholder="Service Code" disabled class="form-control">
												</div>
												<div class="form-group">
													<label>Sevice Name</label>
													<input type="text" name="lsname" placeholder="Service Name" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Service</button>
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
                            <h5> ALL SERVICES</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Service Code</th>
									<th>Service Category</th>
									<th>Service Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_services");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$ss_code = $gcn['ss_code'];
									$ss_category = $gcn['ss_category'];
									$ss_subcategory = $gcn['ss_subcategory'];
									$ss_name = $gcn['ss_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $ss_code; ?></td>
									<td><?php echo $ss_category; ?> <?php echo $ss_subcategory; ?></td>
									<td><?php echo $ss_name; ?></td>
									<td><a href="#?county_id=<?php //echo $county_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a>
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
