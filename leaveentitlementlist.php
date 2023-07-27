<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
	$leavecode=$_GET['leavecode'];
	
	$getleavename = mysqli_query($dbconnect,"SELECT leavetype_name FROM tbl_leavetypes WHERE leavetype_code='$leavecode'");
	$leavenamearray = mysqli_fetch_assoc($getleavename);
	$leavename =$leavenamearray['leavetype_name'];
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Leave Entitlements - <?php echo "$smart_name"; ?></title>
	
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
						<a href="leaveapplications.php"> Entitlements</a>
					</li>                        
					<li class="active">
						<strong> Entitlements and Balances for <?php echo $leavename; ?></strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="leaveentitlements.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></p>
				</div>
		</div>

        <div class="wrapper wrapper-content">

						
			<div class="row">
              <div class="media-list bg-white rounded shadow-base">
               <div class="card pd-20 pd-xs-30 shadow-base bd-0">
				<form method="post">
            
				<div class="col-lg-12 ibox-content">
					<div class="table-wrapper">
				<table class="table dataTables-example table-bordered table-colored table-dark responsive wrap ">
				  <thead>
					<tr>
					  <th>Employee</th>
					  <th>ID No.</th>
					  <th>DESG.</th>
					  <th>Days Entitled</th>
					  <th>Days Balance</th>
					  <th>Action</th>
					  
					  
					</tr>
				  </thead>
				  <tbody>
					  <?php
					  if($user_l=='ADMINISTRATOR'){
							$getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE active='YES'");
					  }
					  else{
						  $getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE emp_idno='$applicantid'");
					  }
								while($ge = mysqli_fetch_array($getEmployees)){
									//	$dhosiname = strtoupper($ge['hospitalName']);
										//$No = $No+1;
									$firstname =$ge['emp_fname'];
									$onames =$ge['emp_onames'];
									$idno =$ge['emp_idno'];
									$designation =$ge['emp_designation'];
								$getEmployeesEnt = mysqli_query($dbconnect,"SELECT * FROM  tbl_leavetransactions WHERE leavetrans_leavecode='$leavecode' AND leavetrans_empcode='$idno' AND leavetrans_status='APPROVED' AND leavetrans_transgen='SYSTEM' AND leavetrans_autocomments='ENTITLEMENT'");
								$geEnt = mysqli_fetch_assoc($getEmployeesEnt);
								$TotalEntitlement =$geEnt['leavetrans_noofdays'];

								$getEmployeesBal = mysqli_query($dbconnect,"SELECT * FROM  tbl_leavetransactions WHERE leavetrans_leavecode='$leavecode' AND leavetrans_empcode='$idno' AND leavetrans_status='APPROVED' AND leavetrans_id=(SELECT Max(leavetrans_id) FROM tbl_leavetransactions WHERE leavetrans_leavecode='$leavecode' AND leavetrans_empcode='$idno' AND leavetrans_status='APPROVED')");
								$geEntBal = mysqli_fetch_assoc($getEmployeesBal);
								$TotalEntitlementBal =$geEntBal['leavetrans_balancedays'];	
										echo "
											<tr>
											  <td>$firstname $onames</td>
											  <td>$idno</td>
											  <td>$designation</td>
											  <td>$TotalEntitlement</td>
											  <td>$TotalEntitlementBal</td>";
											  ?>
											  <td><button class="btn-xs btn-primary"><a href="leavedetailsadmin.php?leavecode=<?php echo$leavecode; ?>&empid=<?php echo $idno; ?>"><i class="fa fa-arrow-right"></i> Open Details </button></a></td>
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
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
       <!-- Page-Level Scripts -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
	
	
	
	
	<script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });         
        });
	 </script>
</body>
</html>
