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
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pharmacy</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li> <a href="servedpatients.php"><i class="fa fa-graph"></i>Served Patients</a></li>
								<li><a href="#">Pharmacy Services</a></li>  
								<li><a href="#"> Summary OTC </a></li> 
								<li><a href="adminsales.php"> Summary for Purchases </a></li> 
								<li><a href="#"> Purchase Report/Inventory Plus pricing </a></li>   
								<li><a href="drugscurrentstock.php"> Medicine Qty and Price List </a></li>   
								<li><a href="#"> Expiry Medicine Report </a></li>   
							</ul>	
							</div>
						</div>
					 </div>
					</div>
					<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Billing and Finance</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="#">Sales report per department </a></li> 
								<li><a href="#"> Daily Sales Report IP </a></li> 
								<li><a href="#">Daily Sales </a></li> 
								<li><a href="#">Summary for Purchases </a></li> 
								<li><a href="#">Petty Cash</a></li>
								<li><a href="#"> Profit Loss </a></li>     
								<li><a href="#"> Debtors </a></li>   
								<li><a href="#"> Employee Advance </a></li>
							</ul>	
							</div>
						</div>
					 </div>
					</div>
					<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Laboratory </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								
								<li><a href="#">Lab Services</a></li>
								<li><a href="#"> Direct Lab Reports </a></li>   
								<li><a href="#"> Lab Price List </a></li>   
								<li><a href="#"> Lab Master </a></li>   
								<li><a href="#"> Daily Lab Requests </a></li>    
							</ul>	
							</div>
						</div>
					 </div>
					</div>
						<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Registry, Triage and Consultation</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="#">Registry Summaries</a></li>
								<li><a href="#">Tiage Summaries</a></li>
								<li><a href="#">Consultation Summaries</a></li>
							</ul>	
							</div>
						</div>
					 </div>
					</div>
			</div>
			  <div class="row">					
								
					<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Treatment Room and ANC</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								
								<li><a href="#">Treatment Room Services</a></li>
								<li><a href="#"> Direct Treatment Requests </a></li>   
								<li><a href="#"> Treatment Requests Price List </a></li>   
								<li><a href="#"> Lab Master </a></li>      
								<li><a href="#"> ANC Summaries </a></li>      
							</ul>	
							</div>
						</div>
					 </div>
					</div>
					<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Dental</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="#">Dental Service Pricing</a></li> 
								<li><a href="#">Dental Service Summaries </a></li> 
							</ul>	
							</div>
						</div>
					 </div>
					</div>
					<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Human Resource </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="#">All Employees</a></li>
								<li><a href="#"> Salaries </a></li>   
								<li><a href="#"> Deductions </a></li>     
								<li><a href="#"> Leave Register </a></li>   	
								  
							</ul>	
							</div>
						</div>
					 </div>
					</div>
						<div class="col-lg-3">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Inpatient</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
							<ul class="">
								<li><a href="#">Served Patients</a></li>
								<li><a href="#">Inpatient Summaries</a></li>
							</ul>	
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
