<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_pettycash");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	
	$loggedemp_idno=$sidno;
	
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
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

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
						<strong>Pay History</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
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
            <table id="datatable1" class="table display responsive wrap example">
              <thead>
                <tr>
                  <th>IDNo</th>
                  <th>Names</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Basic Salary</th>
                  <th>Gross</th>
                  <th>NHIF</th>
                  <th>NSSF</th>
                  <th>PAYE</th>
                  <th>Relief</th>
                  <th>Net</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
									//$No = $No+1;
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
									echo "
										<tr>
										  <td>$pay_idno</td>
										  <td>$pay_names</td>
										  <td>$pay_year</td>
										  <td>$pay_month</td>
										  <td>$pay_basic</td>
										  <td>$pay_gross</td>
										  <td>$pay_nhif</td>
										  <td>$pay_nssf</td>
										  <td>$pay_paye</td>
										  <td>$pay_taxrelief</td>
										  <td>$pay_net</td>";?>
										  <td><a href="payslip.php?id=<?php echo $pay_idno; ?>&y=<?php echo $pay_year; ?>&m=<?php echo $pay_month; ?>"><i class="fa fa-book"></i> Open Payslip</a></td></tr>
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
</body>
</html>
