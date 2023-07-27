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
				<h2>HR and Payroll</h2>
				<ol class="breadcrumb">
					<li>
						<a href="employees.php"> Payroll</a>
					</li>                        
					<li class="active">
						<strong>New Pay Periods</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> New Employees</span></button></a></span></p>
				</div>
		</div>

       <div class="br-section-wrapper">
          
    <div class="row">
		<div class="col-lg-6">
		<H2>PAYE Bands</H2>
           <div class="form-layout form-layout-1">
                <div class="table-wrapper ibox-content">
            <table class="table display responsive wrap">
              <thead>
                <tr>
                  <th>Lower Limit</th>
                  <th>Upper Limit</th>
                  <th>Rate</th>
                </tr>
              </thead>
              <tbody>
                  <?php
						$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_paye");
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
									//$No = $No+1;
								$paye_lowerlimit=$gdoc['paye_lowerlimit'];
								$paye_upperlimit=$gdoc['paye_upperlimit'];
								$paye_rate=$gdoc['paye_rate'];
									echo "
										<tr>
										<td>$paye_lowerlimit</td>
										  <td>$paye_upperlimit</td>
										  <td>$paye_rate%</td>
										</tr>
									";
								}
							  ?>
                </tbody>
            </table>
                </div>        
            
          </div><!-- form-layout -->
          </div>
		<div class="col-lg-6">
		<H2>NSSF Bands</H2>
           <div class="form-layout form-layout-1">
                <div class="table-wrapper ibox-content">
            <table class="table display responsive wrap">
              <thead>
                <tr>
                  <th>Lower Limit</th>
                  <th>Upper Limit</th>
                  <th>Rate</th>
                </tr>
              </thead>
              <tbody>
                  <?php
						$getExpendituresn = mysqli_query($dbconnect,"SELECT * FROM tbl_nssf");
							while($gdocn = mysqli_fetch_array($getExpendituresn)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
									//$No = $No+1;
								$nssf_lowerlimit=$gdocn['nssf_lowerlimit'];
								$nssf_upperlimit=$gdocn['nssf_upperlimit'];
								$nssf_amount=$gdocn['nssf_amount'];
									echo "
										<tr>
										<td>$nssf_lowerlimit</td>
										  <td>$nssf_upperlimit</td>
										  <td>$nssf_amount</td>
										</tr>
									";
								}
							  ?>
                </tbody>
            </table>
                </div>        
            
          </div><!-- form-layout -->
          </div>
		  
		    <div class="col-lg-6">
			<H2>NHIF Bands</H2>
			<div class="form-layout form-layout-1">
                         <div class="table-wrapper ibox-content">
            <table class="table display responsive wrap">
              <thead>
                <tr>
                  <th>Lower Limit</th>
                  <th>Upper Limit</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                  <?php
						$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_nhifbands");
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
									//$No = $No+1;
								$nhif_lowerlimit=$gdoc['nhif_lowerlimit'];
								$nhif_upperlimit=$gdoc['nhif_upperlimit'];
								$nhif_amount=$gdoc['nhif_amount'];
									echo "
										<tr>
										<td>$nhif_lowerlimit</td>
										  <td>$nhif_upperlimit</td>
										  <td>$nhif_amount/=</td>
										</tr>
									";
								}
							  ?>
                </tbody>
            </table>
                </div>
                </div>
            </div>  
            </div>  
			
		  
        </div>
			   
			   
			   
       <!-- </div> End of original wrapper--->

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
