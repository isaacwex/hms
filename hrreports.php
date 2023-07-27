<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_pettycash");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Reports - <?php echo "$smart_name"; ?></title>
	
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
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Reports</h2>
				<ol class="breadcrumb">
					<li>
						<a href="reports.php">Reports </a>
					</li>                        
					<li class="active">
						<strong>All Reports</strong>
					</li>
				</ol>
			</div>
				
		</div>

        <div class="wrapper wrapper-content">
               
			  <div class="row">					
								
					
					<div class="col-lg-3">
					</div>					
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>HR and Payroll Reports </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="hrsalarysummaries.php"> Salary Summaries </a></li>  
								<li><a href="ibanksheet.php"> i-Bank Sheet </a></li>   	
								  
							</ul>	
							</div>
						</div>
					 </div>
					</div>
					<div class="col-lg-3">
					</div>	
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
