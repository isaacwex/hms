<?php include('includes/authenticate.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>

    <title>Salary Summaries - <?php echo "$smart_name"; ?></title>
	
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
				<h2>HR and Payroll Reports</h2>
				<ol class="breadcrumb">
					<li>
						<a href="hrreports.php"> Payroll Reports</a>
					</li>                        
					<li class="active">
						<strong>Salary Summaries</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="hrreports.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to HR Reports</span></button></a></span> 
						</p>
				</div>
		</div>

      <div class="br-section-wrapper">
            <?php
              $getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_payrollprocessed WHERE pay_year='2045'");
             
           	?>
        <form method="POST" action="">
            <?php
         
           	if(isset($_POST['searche'])){
			$pyear = $_POST['pyear'];
            $pmonth = $_POST['pmonth'];
			   if($user_l=='ADMINISTRATOR'){ 
				$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_payrollprocessed WHERE pay_year='$pyear' AND pay_month='$pmonth'");
			   }
			   else{
				 $getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_payrollprocessed WHERE pay_year='$pyear' AND pay_month='$pmonth' AND pay_idno='$loggedemp_idno'");  
			   }
            }
            ?>
            <div class="form-layout">
                <div class="row">
                       
                      <div class="col-lg-3">
                        <div class="form-group">
                          <select name="pyear" class="form-control" >
										<option value="*">Select Year</option>
										<?php 
										$pataHosi = mysqli_query($dbconnect,"SELECT DISTINCT pyear FROM tbl_payperiods");
										while ($doc=mysqli_fetch_array($pataHosi)){
											$pyear = $doc['pyear'];
											echo "<option value='$pyear'>$pyear</option>";
										}
										?>
									</select>
                        </div>
                      </div>
                        <div class="col-lg-3">
                        <div class="form-group">
                          <select name="pmonth" class="form-control" >
										<option value="*">Select Month</option>
										<?php 
										$pataA = mysqli_query($dbconnect,"SELECT DISTINCT pmonth FROM tbl_payperiods");
										while ($docA=mysqli_fetch_array($pataA)){
											$pmonth = $docA['pmonth'];
										
											echo "<option value='$pmonth'>$pmonth</option>";
										}
										?>
									</select>
                        </div>
                      </div>
                       <div class="col-lg-2">
                            <div class="form-group">
                                <button class="btn btn-warning small" name="searche">Filter</button>
                            </div>
                        </div>
                           
                </div>
            </div>  
            <div class="table-wrapper ibox-content">
            <table id="example" class="table display responsive wrap example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Names</th>
                  <th>Basic Salary</th>
                  <th>Commissions/Allowances</th>
                  <th>Gross salary</th>
                  <th>P.A.Y.E</th>
                  <th>N.S.S.F</th>
                  <th>N.H.I.F </th>
                  <th>Salary Advance/Surcharge</th>
                  <th>Net to bank </th>
                </tr>
              </thead>
              <tbody>
                  <?php
								$No=0;
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
								$No = $No+1;
								$pay_idno=$gdoc['pay_idno'];
								$pay_names=$gdoc['pay_names'];
								$pay_basic=$gdoc['pay_basic'];
								$pay_gross=$gdoc['pay_gross'];
								$pay_paye=$gdoc['pay_paye'];
								$pay_taxrelief=$gdoc['pay_taxrelief'];
								$pay_nhif=$gdoc['pay_nhif'];
								$pay_nssf=$gdoc['pay_nssf'];
								$pay_net=$gdoc['pay_net'];
								$pay_year=$gdoc['pay_year'];
								$pay_month=$gdoc['pay_month'];
								$pay_bank=$gdoc['pay_bank'];
								$pay_branch=$gdoc['pay_branch'];
								$pay_bic_sortcode=$gdoc['pay_bic_sortcode'];
								$pay_accno=$gdoc['pay_accno'];
								$pay_allowances=$gdoc['pay_allowances'];
								$pay_deductions=$gdoc['pay_deductions'];
									echo "
										<tr>
										  <td>$No</td>
										  <td>$pay_names</td>
										  <td>$pay_basic</td>
										  <td>$pay_allowances</td>
										  <td>$pay_gross</td>
										  <td>$pay_paye</td>
										  <td>$pay_nssf</td>
										  <td>$pay_nhif</td>
										  <td>$pay_deductions</td>
										  <td>$pay_net</td>";
										  ?>
										  </tr>
										  <?php
										
								}
							  ?>
                </tbody>
            </table>
          </div><!-- table-wrapper --> 
          </form>
        </div>
			   
			   
			   
       <!-- </div> End of original wrapper--->




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
