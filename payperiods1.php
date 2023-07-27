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

       <!-- <div class="wrapper wrapper-content"> -->
           <div class="wrapper wrapper-content">
          
    <div class="row">
		<div class="col-lg-5 ibox-content">
           <div class="form-layout form-layout-1">
                
            <form method="post" action="">
            <div class="row mg-b-5">
            <div class="col-lg-12">
                  <?php 
		
    			if(isset($_POST['ptrans'])){
    				if($_POST['pyear']==""||$_POST['pmonth']==""){
    					echo "<div class='alert alert-danger' role='alert'>Fill all fields</div>";
    				}
				else{
						$pyear = $dbconnect->real_escape_string($_POST['pyear']);
					$pmonth = $dbconnect->real_escape_string($_POST['pmonth']);
					$pstartdate = $dbconnect->real_escape_string($_POST['pstartdate']);
					$penddate = $dbconnect->real_escape_string($_POST['penddate']);
					
					
					$pyear = strtoupper(stripslashes(trim($pyear)));
					$pmonth = strtoupper(stripslashes(trim($pmonth)));
					$pstartdate = strtoupper(stripslashes(trim($pstartdate)));
					$penddate = strtoupper(stripslashes(trim($penddate)));
					$piscurrent = 'NO';
					$processedstate = 'NO';
					
					$cvoter = "SELECT * FROM tbl_payperiods WHERE pyear='$pyear' AND pmonth='$pmonth'";
								$c4v = mysqli_query($dbconnect, $cvoter);								
								$crec = mysqli_num_rows($c4v);
					if($crec >= 1){
									echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the period has already been created </div>";
								}
								else {					
					$transPost = "INSERT INTO tbl_payperiods (pyear, pmonth, pstartdate, penddate,piscurrent,processed) VALUES (?,?,?,?,?,?)";						
						if($stmt = $dbconnect->prepare($transPost)){
							$stmt->bind_param('ssssss',$pyear,$pmonth,$pstartdate,$penddate,$piscurren,$processedstate);
							$stmt->execute();
								echo "<div class='alert alert-success' role='alert'>
									<p>Successful post</p></div>";
							}
							else {
								echo mysqli_error($dbconnect);
						}
					}
				}
			}?>
                </div>
          
              <div class="col-lg-10">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Year</label>
                  <select class="form-control select2" name="pyear" data-placeholder="Choose year" required>
                    <option value="">Choose Year</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    
                  </select>
                </div>
              </div><!-- col-4 --> 
			  <div class="col-lg-10">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Month</label>
                  <select class="form-control select2" name="pmonth" data-placeholder="Choose year" required>
                    <option value="">Choose Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    
                  </select>
                </div>
              </div><!-- col-4 -->
			  
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">Start Date</label>
                  <input class="form-control fc-datepicker" type="date" name="pstartdate"  placeholder="Start Date">
                </div>
              </div><!-- col-4 --> 
			  <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">End Date</label>
                  <input class="form-control fc-datepicker" type="date" name="penddate"  placeholder="End Date">
                </div>
              </div><!-- col-4 -->
               
            </div><!-- row -->

            <div class="form-layout-footer">
              <button class="btn btn-primary" name="ptrans">Create Period</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div><!-- form-layout-footer -->
            
            </form>
            
          </div><!-- form-layout -->
          </div>
		  
		    <div class="col-lg-6">
					<div class="table-wrapper ibox-content">
				<table class="table dataTables-example table-bordered table-colored table-dark responsive wrap">
              <thead>
                <tr>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Is Current</th>
				  
                </tr>
              </thead>
              <tbody>
                  <?php
						$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_payperiods");
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
									//$No = $No+1;
								$pyear=$gdoc['pyear'];
								$pmonth=$gdoc['pmonth'];
								$pstartdate=$gdoc['pstartdate'];
								$penddate=$gdoc['penddate'];
								$piscurrent=$gdoc['piscurrent'];
									echo "
										<tr>
										  <td>$pyear</td>
										  <td>$pmonth</td>
										  <td>$pstartdate</td>
										  <td>$penddate</td>
										  <td>$piscurrent</td>
										</tr>
									";
								}
							  ?>
                </tbody>
            </table>
                </div>
            </div>  
            </div>  
		  
        </div><!-- br-section-wrapper -->
				<!-- br-section-wrapper --> 
	

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
