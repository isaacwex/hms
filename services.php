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
		<?php
			$catcode=$_GET['catcode'];
			$schemecode=$_GET['schemecode'];
			$sname=$_GET['n'];
		?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Services</h2>
				<ol class="breadcrumb">
					<li>
						<a href="all-services.php">All</a>
					</li>                        
					<li class="active">
						<strong><?php echo $catcode; ?> SERVICE LIST FOR <?php echo $sname; ?></strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
						   <span><a href="first_services.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span>
				</p>
				</div>
		</div>
		
        <div class="wrapper wrapper-content">
                <div class="row">					
								
					<div class="col-lg-2">					
						
					</div>
					
					
					<div class="col-lg-8">		
					<h2>SERVICES FOR <?php echo $catcode; ?> (<?php echo $sname; ?>)</h2>				
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>SERVICES FOR <?php echo $catcode; ?></h5>
						</div>
                        <div class="ibox-content">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Service Code</th>
									<th>Service Name</th>
									<th>Service Cost</th>
									<th> Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_service_prices sp INNER JOIN tbl_services ss ON sp.sp_code=ss.ss_code WHERE sp.sp_schemecode='$schemecode' AND ss.ss_category='$catcode'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$sp_id = $gcn['sp_id'];
									$ss_code = $gcn['ss_code'];
									$ss_name = $gcn['ss_name'];
									$sp_price = $gcn['sp_price'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $ss_code; ?></td>
									<td><?php echo $ss_name; ?></td>
									<td><?php echo $sp_price; ?>/=</td>
									<td><a href="#?county_id=<?php echo $sp_id; ?>"><button type="button" class="btn-xs btn-primary" ><i class="fa fa-pencil"></i> Edit </button></a></td>
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

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
