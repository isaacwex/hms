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
	
    <title> Employees Cash - <?php echo "$smart_name"; ?></title>
	
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
				<h2>Leave</h2>
				<ol class="breadcrumb">
					<li>
						<a href="leaveapplication.php"> Leave</a>
					</li>                        
					<li class="active">
						<strong>All Employees</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Bank</span></button></a></span></p>
				</div>
		</div>

       <!-- <div class="wrapper wrapper-content"> -->
                <div class="wrapper wrapper-contentr">
          
		<div class="row">
              <div class="media-list bg-white rounded shadow-base">
               <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">PERSONAL DETAILS</h3>
				<form method="post">
            
				
				<div class="col-lg-12">
					<div class="form-group">
					  <h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">LIST OF EMPLOYEES</h3>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-12 ibox-content">
					<div class="table-wrapper">
				<table class="table dataTables-example table-bordered table-colored table-dark responsive wrap">
				  <thead>
					<tr>
					  <th>Employee</th>
					  <th>ID No.</th>
					  <th>DESG.</th>
					  <th>Days Consumed</th>
					  <th>Days Balance</th>
					  <th>Action</th>
					  
					  
					</tr>
				  </thead>
				  <tbody>
					  <?php
							$getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees");
							
								while($ge = mysqli_fetch_array($getEmployees)){
									//	$dhosiname = strtoupper($ge['hospitalName']);
										//$No = $No+1;
									$firstname =$ge['emp_fname'];
									$onames =$ge['emp_onames'];
									$idno =$ge['emp_idno'];
									$designation =$ge['emp_designation'];
										echo "
											<tr>
											  <td>$firstname $onames</td>
											  <td>$idno</td>
											  <td>$designation</td>
											  <td>5</td>
											  <td>25</td>";
											  ?>
											  <td><button class="btn-xs btn-primary"><a href="leavedetailsadmin.php?empid=<?php echo $idno; ?>"><i class="fa fa-arrow-right"></i> Open Details </button></a></td>
											</tr>
										<?php
									}
								  ?>
					</tbody>
				</table>
				</div>  
				</div><!-- col-4 -->
				</form>
            
				</div>
			</div><!-- row -->
			
		  </div> 
			
		  
        </div><!-- br-section-wrapper --> 
			   
			   
			   
       <!-- </div> End of original wrapper--->

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
