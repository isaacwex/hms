<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Nursing Station Services - <?php echo "$smart_name"; ?></title>
	
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
		<?php
			$ps_code=$_GET['c'];
			$ps_name=$_GET['n'];
		?>
        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Nursing Station Service</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Nursing Station Service</h5>
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
												
												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_nursingstationservices WHERE nursingstation_code='$lscode'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Already exists</div>";
														}
												else {
													
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_nursingstationservices (nursingstation_code, nursingstation_name, nursingstation_cost,nursingstation_pscheme) VALUES (?,?,?,?)")){
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
													<label>Sevice Code</label>
													<input type="text" name="lscode" placeholder="Service Code" class="form-control">
												</div>
												<div class="form-group">
													<label>Sevice Name</label>
													<input type="text" name="lsname" placeholder="Service Name" class="form-control">
												</div>
												<div class="form-group">
													<label>Sevice Cost</label>
													<input type="text" name="lscost" placeholder="Service Name" class="form-control">
												</div>
												<div class="form-group">
													<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Lab Service</button>
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
                            <h5>Nursing Station Services</h5>
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
									<th>Service Cost</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_nursingstationservices WHERE nursingstation_pscheme='$ps_code'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$nursingstation_code = $gcn['nursingstation_code'];
									$nursingstation_name = $gcn['nursingstation_name'];
									$nursingstation_cost = $gcn['nursingstation_cost'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $nursingstation_code; ?></td>
									<td><?php echo $nursingstation_name; ?></td>
									<td><?php echo $nursingstation_cost; ?>/=</td>
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
