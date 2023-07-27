<?php include('includes/authenticate.php'); ?>
<?php

	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title> Employees Cash - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link rel="stylesheet" href="assets/css/datatables.min.css">
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
		<div class="col-lg-4 ibox-content">
           <div class="form-layout form-layout-1">
                
            <form method="POST" action="payperiods.php">
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
					$datee= $pyear."-".$pmonth."-03";
					$pstartdate = $datee;
					$penddate = date('Y-m-d',strtotime($datee.'+30 days'));		
					$pyear = strtoupper(stripslashes(trim($pyear)));
					$pmonth = strtoupper(stripslashes(trim($pmonth)));
					$pstartdate = strtoupper(stripslashes(trim($pstartdate)));
					$penddate = strtoupper(stripslashes(trim($penddate)));
					$piscurrent = 'NO';
					$processedstate = 'NO';
					$processedcode = $pyear.$pmonth;
					
					$cvoter = "SELECT * FROM tbl_payperiods WHERE pyear='$pyear' AND pmonth='$pmonth'";
								$c4v = mysqli_query($dbconnect, $cvoter);								
								$crec = mysqli_num_rows($c4v);
					if($crec >= 1){
									echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the period has already been created </div>";
								}
								else {					
					$transPost = "INSERT INTO tbl_payperiods (pperiodcode, pyear, pmonth, pstartdate, penddate,piscurrent,processed) VALUES (?,?,?,?,?,?,?)";						
						if($stmt = $dbconnect->prepare($transPost)){
							$stmt->bind_param('sssssss',$processedcode,$pyear,$pmonth,$pstartdate,$penddate,$piscurrent,$processedstate);
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
                  <select class="form-control select2" name="pyear" data-placeholder="Choose year" value="<?php echo date('Y'); ?>" required>
                    <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                    
                  </select>
                </div>
              </div><!-- col-4 --> 
			  <div class="col-lg-10">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Month</label>
                  <select class="form-control select2" name="pmonth" value="<?php echo date('m'); ?>" data-placeholder="Choose year" required>
                   <!-- <option value="<?php //echo date('m'); ?>"><?php //echo date('m'); ?></option>-->
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
              </div><!-- col-4 -->
		
            </div><!-- row -->

            <div class="form-layout-footer">
				<!--<a  href='paysliplist.php' class="btn btn-primary">Compute Allowances</a>--->
              <button class="btn btn-primary" name="ptrans">Create Period</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>

            </div><!-- form-layout-footer -->
            
            </form>
            
          </div><!-- form-layout -->
          </div>
		  
		    <div class="col-lg-8">
					<div class="table-wrapper ibox-content">
			<table id="example" class="table table-striped table-bordered table-colored table-dark responsive wrap">
              <thead>
                <tr>
                  <th>S/NO</th>
                  <th>Paypoint Code</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Is Current</th>
				  <th>Process Status</th>
				  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                  <?php
						$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM `tbl_payperiods` ORDER BY `pid` DESC");
							$No=0;
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
								$No = $No+1;
								$pyear=$gdoc['pyear'];
								$pcode=$gdoc['pperiodcode'];
								$pstartdate=$gdoc['pstartdate'];
								$penddate=$gdoc['penddate'];
								$piscurrent=$gdoc['piscurrent'];
								$processed=$gdoc['processed'];
									echo "<tr>
										  <td>$No</td>
										  <td>$pcode</td>
										  <td>$pstartdate</td>
										  <td>$penddate</td>
										  <td>$piscurrent</td>
										  <td>$processed</td>
										  <td> <a href='paysliplist.php'>View payslips</a></td>
										</tr>";
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
   
   
   <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>