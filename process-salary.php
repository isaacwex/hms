<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_pettycash");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	$leo_date = date('Y-m-d');
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
						<a href="#"> Salary</a>
					</li>                        
					<li class="active">
						<strong>Process Salary</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Pay Periods</span></button></a></span></p>
				</div>
		</div>

          
   <div class="wrapper wrapper-content">
            <?php
			$getnssf = mysqli_query($dbconnect,"SELECT par_default FROM tbl_payrollparameters WHERE par_name='NSSF'");
			$gnssf = mysqli_fetch_assoc($getnssf);
			$nssf_amount = $gnssf['par_default'];
			
			$getpaye = mysqli_query($dbconnect,"SELECT par_active FROM tbl_payrollparameters WHERE par_name='PAYE'");
			$gpaye = mysqli_fetch_assoc($getpaye);
			$paye_status = $gpaye['par_active'];
			
			$getExpenditures = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE active='YES' AND emp_basicsalary>0");
            ?>
        <form method="POST" action="">
            <?php
         
           	if(isset($_POST['searche'])){
    		
			$pyear = $dbconnect->real_escape_string($_POST['pyear']);
            $pmonth = $dbconnect->real_escape_string($_POST['pmonth']);
        
			$saloParameters = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE active='YES'");
			
					
					$cvoter = "SELECT processed FROM tbl_payperiods WHERE pyear='$pyear' AND pmonth='$pmonth'";
								$c4v = mysqli_query($dbconnect, $cvoter);	
								$gpo = mysqli_fetch_array($c4v);
								$processed = $gpo['processed'];
								
						if($processed=='YES'){
									echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the period has already been processed </div>";
								}
								else {
						//Getting the parameters for the pay period to be processed

		while($gdoc = mysqli_fetch_array($saloParameters)){
			
									$emp_idno=$gdoc['emp_idno'];
										$emp_fname=$gdoc['emp_fname'];
										$emp_onames=$gdoc['emp_onames'];
									$allnames=strtoupper($emp_fname.' '.$emp_onames);
										$emp_basicsalary=$gdoc['emp_basicsalary'];
									$pay_gross=$gdoc['emp_basicsalary'];
									
									
									$emp_accountno=$gdoc['emp_accountno'];
									$emp_bank=$gdoc['emp_bank'];
									$emp_bank_branch=$gdoc['emp_bank_branch'];
									
									$sqlsortcode = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_banks WHERE bank_code='$emp_bank'");
									$rowsortcode4 = mysqli_fetch_array($sqlsortcode);
									$bank_name= $rowsortcode4["bank_name"];
									$bank_bic_sortcode= $rowsortcode4["bank_bic_sortcode"];
									
						//https://www.kra.go.ke//individual/calculate-tax/calculating-tax/paye#paye
						//Sum of active Allowances and bonuses extra
						$sql4 = mysqli_query($dbconnect, "SELECT SUM(pd_monthlyremittance) as totalallowances FROM tbl_payroll_allow_ded_settings WHERE pd_status='ACTIVE' AND pd_type='ALLOWANCE' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
						$row4 = mysqli_fetch_array($sql4);
						$totalallowances= $row4["totalallowances"];
						$gross_salary=$emp_basicsalary+$totalallowances;
						$gross_salarythatcanbetaxed=$gross_salary-1080;
						
						//keeping the vairiable for insertion
						$pay_allowances=$totalallowances;
						
						$taxableincome=$gross_salarythatcanbetaxed;
					
						//NHIF
						$getnhif = mysqli_query($dbconnect,"SELECT nhif_amount FROM tbl_nhifbands WHERE nhif_lowerlimit<='$gross_salary' AND nhif_upperlimit>='$gross_salary'");
						$gp = mysqli_fetch_array($getnhif);
						$nhif_amount = $gp['nhif_amount'];
						
						// PAYE and NSSF
						$pay_contribution_benefit=1080;
						$taxableincometouse=$taxableincome-$pay_contribution_benefit;
						//24000 and less
						if($taxableincometouse<=24000){
							$paye_amount=0.0;
						}
						//32333 but more than 24000
						elseif(($taxableincometouse<=32333)&&($taxableincometouse>24000)){
							$payetier1=2400;
							
							$payetier2=(($taxableincometouse-24000)*0.25);
							$nhifrelief=($nhif_amount*0.15);
							$paye_amount=($payetier2)-$nhifrelief;
							if($paye_amount<0){$paye_amount=0;}
							$paye_amount=ceil($paye_amount);
						}
						//more than 32333 - 30185 -1546.25
						elseif($taxableincometouse>32333){
							$payetier1=2400;
							$payetier2=2083.25;
							$payetier3=(($taxableincometouse-32333)*0.3);
							//$nhifrelief=($nhif_amount*($currentmonth-1))*0.15;
							$nhifrelief=($nhif_amount)*0.15;
							$paye_amount=($payetier1+$payetier2+$payetier3)-2400-($nhifrelief);
							$paye_amount=ceil($paye_amount);
						}
						//not belonging anywhere
						else{
							echo "Error limit setting failed";
						}
								
									
						//NSSF
						/*$getnssf = mysqli_query($dbconnect,"SELECT nssf_amount FROM tbl_nssf WHERE nssf_lowerlimit<='$taxableincome' AND nssf_upperlimit>='$taxableincome'");
						$gpnssf = mysqli_fetch_array($getnssf);
									$nssf_amount = $gpnssf['nssf_amount'];
						*/
						
						if($taxableincome<=6000){
							//$tier1=360;
							$nssf_amount=0;
						}
						elseif(($taxableincome<=18000)&&($taxableincome>6000)){
							$tier1=360;
							$tier2=($taxableincome-6000)*0.06;
							$nssf_amount=$tier1+$tier2;
						}
						elseif($taxableincome>18000){
							$tier1=360;
							$tier2=720;
							$nssf_amount=$tier1+$tier2;
						}
						else{}
						
						
								
						
						
						
						
						//Other Deductions including advance and contributions if any
						$sql4d = mysqli_query($dbconnect, "SELECT SUM(pd_monthlyremittance) as totalded FROM tbl_payroll_allow_ded_settings WHERE pd_status='ACTIVE' AND pd_type='DEDUCTION' AND pd_employeeid='$emp_idno'");
						$row4d = mysqli_fetch_array($sql4d);
						$totalalded= $row4d["totalded"];
						
						//keeping teh varibale for insertatin
						$pay_deductions=$totalalded;
						//Getting summations
						$netsalo=($gross_salary)-($nhif_amount+$nssf_amount+$paye_amount)-$totalalded;	
						
						$sqlall = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_employeeid='$emp_idno'");
						while($row4sql = mysqli_fetch_array($sqlall)){
							$allowancename= $row4sql["pdc_name"];
							$monthlyamount= $row4sql["pd_monthlyremittance"];
							$pdt_settingscode= $row4sql["pd_settingscode"];
							$pdt_payrollproductcode= $row4sql["pd_transcategorycode"];
							$pd_type= $row4sql["pd_type"];
							 //echo "$allowancename - $monthlyamount<br>";		 
							 
													if($pd_type=='ALLOWANCE'){
													// insert allowances one by one
														$sqlbill_allowances = "INSERT INTO tbl_payroll_allow_ded_contributions(pdt_employeeid,pdt_payrollitemcode,pdt_year,pdt_amount,pdt_balance,pdt_month,pdt_settingscode,pdt_payperiodcode,pdt_payrollproductcode,pdt_payrollitemcategory)
																VALUES 
																('$emp_idno','$pdt_payrollproductcode','$pyear','$monthlyamount','','$pmonth','$pdt_settingscode','202304','$pdt_payrollproductcode','ALLOWANCE')";
																$dbconnect->query($sqlbill_allowances);	
													}
													else{			
													//insert deductions
													$sqlbill_allowancesded = "INSERT INTO tbl_payroll_allow_ded_contributions(pdt_employeeid,pdt_payrollitemcode,pdt_year,pdt_amount,pdt_balance,pdt_month,pdt_settingscode,pdt_payperiodcode,pdt_payrollproductcode,pdt_payrollitemcategory)
																VALUES 
																('$emp_idno','$pdt_payrollproductcode','$pyear','$monthlyamount','','$pmonth','$pdt_settingscode','202304','$pdt_payrollproductcode','DEDUCTION')";
																$dbconnect->query($sqlbill_allowancesded);	
													}								
									
						}
					$sqlalld = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_type='DEDUCTION' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
					while($row4sqld = mysqli_fetch_array($sqlalld)){
						$dedname= $row4sqld["pdc_name"];
						$dedamount= $row4sqld["pd_monthlyremittance"];
						// echo "$dedname - $dedamount<br>";
					}
							$pay_idno=$emp_idno;
							$pay_names=$allnames;
							$pay_basic=$emp_basicsalary;
							$pay_gross=$gross_salary;
							$pay_year=$pyear;
							$pay_month=$pmonth;
							$pay_processeddate=$leo_date;
							if($pay_allowances<1){
								$pay_allowances='0';
							}
							if($pay_deductions<1){
								$pay_deductions='0';
							}
						if(($emp_idno=='23319426')||($emp_idno=='23825217')){
							$pay_withholdingtax=$pay_gross*0.05;
							
							$pay_paye=0;
							$pay_nhif=0;
							$pay_nssf=0;
							$pay_taxrelief=0;
							//$pay_net=0;
							$pay_net=($gross_salary)-($gross_salary*0.05)-$totalalded;
							$pay_withholdingtax=0;
						}
						else{
							$pay_withholdingtax=0;
							$pay_paye=$paye_amount;
							$pay_nhif=$nhif_amount;
							$pay_nssf=$nssf_amount;
							$pay_taxrelief=2400;
							$pay_net=$netsalo;
						}
					//$pay_idno,$pay_names,$pay_basic,$pay_nhif,$pay_nssf,$pay_taxrelief,$pay_gross,$pay_net,$pay_year,$pay_month,$pay_allowances,$pay_deductions
					//pay_idno,pay_names,pay_basic,pay_nhif,pay_nssf,pay_taxrelief,pay_gross,pay_net,pay_year,pay_month,pay_allowances,pay_deductions
						/*$sqlbill = "INSERT INTO tbl_payrollprocessed(pay_idno,pay_names,pay_basic,pay_paye,pay_nhif,pay_nssf,pay_taxrelief,pay_gross,pay_net,pay_year,pay_month,pay_allowances,pay_deductions)
															VALUES ('pay_idno','pay_names','pay_basic','pay_paye','pay_nhif','pay_nssf','pay_taxrelief','pay_gross','pay_net',pay_year','pay_month','pay_allowances','pay_deductions')";
						$dbconnect->query($sqlbill);
						echo $sqlbill;
						
						*/
						// start of teh inserting process	
						/*$pay_idno ='1';
						$pay_names='Wekesa Wekds';
					$sqlbill = "INSERT INTO tbl_payrollprocessed(pay_idno,pay_names)VALUES ('$pay_idno','$pay_names')";
						$dbconnect->query($sqlbill);
						*/
					
						
					$transPost = "INSERT INTO tbl_payrollprocessed (pay_idno,pay_names,pay_basic,pay_paye,pay_nhif,pay_nssf,pay_taxrelief,pay_gross,pay_net,pay_year,pay_month,pay_allowances,pay_deductions,pay_processeddate,pay_accno,pay_bank,pay_branch,pay_bic_sortcode,pay_contribution_benefit,pay_withholdingtax) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";						
						if($stmt = $dbconnect->prepare($transPost)){
							$stmt->bind_param('ssssssssssssssssssss',$pay_idno,$pay_names,$pay_basic,$pay_paye,$pay_nhif,$pay_nssf,$pay_taxrelief,$pay_gross,$pay_net,$pay_year,$pay_month,$pay_allowances,$pay_deductions,$pay_processeddate,$emp_accountno,$bank_name,$emp_bank_branch,$bank_bic_sortcode,$pay_contribution_benefit,$pay_withholdingtax);
							$stmt->execute();
							echo "<div class='alert alert-success' role='alert'>
									<p>Payroll successfully processed for ($pay_idno,$pay_names,$pay_basic,$pay_nhif,$pay_nssf,$pay_taxrelief,$pay_gross,$pay_net,$pay_year,$pay_month,$pay_allowances,$pay_deductions,$pay_processeddate,$emp_accountno,$bank_name,$$emp_bank_branch,$bank_bic_sortcode)</p></div>";
					}
					
				//end...
			}
			//closing the specific pay periods
							$updateStudent = "UPDATE tbl_payperiods SET processed=? WHERE pyear='$pay_year' AND pmonth='$pay_month'";
								$uvalue='YES';
								if($stmt1 = $dbconnect->prepare($updateStudent)){
									$stmt1->bind_param('s',$uvalue);
									$stmt1->execute();							
									echo "<div class=\"alert alert-success\" role=\"alert\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
										<span aria-hidden=\"true\">&times;</span>
										</button>
										<div class=\"d-flex align-items-center justify-content-start\">
										<i class=\"icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0\"></i>
										<span><strong>Update successful</span>
										</div>
										</div>";
														
									//echo '<META HTTP-EQUIV="Refresh" Content="2;">';			
								}
								echo "<div class='alert alert-success' role='alert'>
									<p>Payroll successfully processed for the selected payperiods (active employees)</p></div>";
							}
				}
            ?>
            <div class="form-layout">
                <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <select name="pyear" required class="form-control" >
										<option  value="">Select Year</option>
										<?php 
										$pataHosi = mysqli_query($dbconnect,"SELECT DISTINCT pyear FROM tbl_payperiods WHERE processed!='YES'");
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
                          <select name="pmonth" required class="form-control" >
										<option value="">Select Month</option>
										<?php 
										$pataA = mysqli_query($dbconnect,"SELECT DISTINCT pmonth FROM tbl_payperiods WHERE processed!='YES' ORDER BY pmonth ASC");
										while ($docA=mysqli_fetch_array($pataA)){
											$pmonth = $docA['pmonth'];
											echo "<option value='$pmonth'>$pmonth</option>";
										}
										?>
									</select>
                        </div>
                      </div>
                       <div class="col-lg-3">
                            <div class="form-group">
                                <button class="btn btn-danger" name="searche">Process</button>
                            </div>
                        </div>                           
                </div>
            </div>  
            <div class="table-wrapper">
            <table id="datatable1" class="table display responsive wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Names</th>
                  <th>Basic Salary</th>
                  <th>Gross Salary</th>
                  <th>Allowances</th>
                  <th>NHIF</th>
                  <th>NSSF</th>
                  <th>PAYE</th>
                  <th>Other Deductions</th>
                  <th>Net</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php
							$No=0;
							while($gdoc = mysqli_fetch_array($getExpenditures)){
								//	$dhosiname = strtoupper($gdoc['hospitalName']);
								$No = $No+1;
								$emp_idno=$gdoc['emp_idno'];
								$emp_fname=strtoupper($gdoc['emp_fname']);
								$emp_onames=strtoupper($gdoc['emp_onames']);
								$emp_basicsalary=$gdoc['emp_basicsalary'];
								$pay_gross=$gdoc['emp_basicsalary'];
								$emp_designation=$gdoc['emp_designation'];
						
						//Sum of active Allowances and bonuses extra
						$sql4 = mysqli_query($dbconnect, "SELECT SUM(pd_monthlyremittance) as totalallowances FROM tbl_payroll_allow_ded_settings WHERE pd_status='ACTIVE' AND pd_type='ALLOWANCE' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
						$row4 = mysqli_fetch_array($sql4);
						$totalallowances= $row4["totalallowances"];
						
						
						
						//Getting Gross to use for deductions
						$gross_salary=$emp_basicsalary+$totalallowances;
						//$relief='1080';
						$taxableincome=$gross_salary;
						
						
						
						//NHIF
						$getnhif = mysqli_query($dbconnect,"SELECT nhif_amount FROM tbl_nhifbands WHERE nhif_lowerlimit<='$taxableincome' AND nhif_upperlimit>='$taxableincome'");
						$gp = mysqli_fetch_array($getnhif);
									$nhif_amount = $gp['nhif_amount'];
						
						//PAYE
						
						$pay_contribution_benefit=1080;
						$taxableincometouse=$taxableincome-$pay_contribution_benefit;
						//24000 and less
						if($taxableincometouse<=24000){
							$paye_amount=0.0;
						}
						//32333 but more than 24000
						elseif(($taxableincometouse<=32333)&&($taxableincometouse>24000)){
							$payetier1=2400;
							
							$payetier2=(($taxableincometouse-24000)*0.25);
							$nhifrelief=($nhif_amount*0.15);
							$paye_amount=($payetier2)-$nhifrelief;
							if($paye_amount<0){$paye_amount=0;}
							$paye_amount=ceil($paye_amount);
							
						}
						//more than 32333 - 30185 -1546.25
						elseif($taxableincometouse>32333){
							$payetier1=2400;
							$payetier2=2083.25;
							$payetier3=(($taxableincometouse-32333)*0.3);
							//$nhifrelief=($nhif_amount*($currentmonth-1))*0.15;
							$nhifrelief=($nhif_amount)*0.15;
							$paye_amount=($payetier1+$payetier2+$payetier3)-2400-($nhifrelief);
							$paye_amount=ceil($paye_amount);
						}
						//not belonging anywhere
						else{
							echo "Error limit setting failed";
						}
								
									
						//NSSF
						/*$getnssf = mysqli_query($dbconnect,"SELECT nssf_amount FROM tbl_nssf WHERE nssf_lowerlimit<='$taxableincome' AND nssf_upperlimit>='$taxableincome'");
						$gpnssf = mysqli_fetch_array($getnssf);
									$nssf_amount = $gpnssf['nssf_amount'];
						*/
						
						if($taxableincome<=6000){
							//$tier1=360;
							$nssf_amount=0;
						}
						elseif(($taxableincome<=18000)&&($taxableincome>6000)){
							$tier1=360;
							$tier2=($taxableincome-6000)*0.06;
							$nssf_amount=$tier1+$tier2;
						}
						elseif($taxableincome>18000){
							$tier1=360;
							$tier2=720;
							$nssf_amount=$tier1+$tier2;
						}
						else{}
						
						//Other Deductions including advance and contributions if any
						
						$sql4d = mysqli_query($dbconnect, "SELECT SUM(pd_monthlyremittance) as totalded FROM tbl_payroll_allow_ded_settings WHERE pd_status='ACTIVE' AND pd_type='DEDUCTION' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
						$row4d = mysqli_fetch_array($sql4d);
						$totalalded= $row4d["totalded"];
						
						//Getting summations 23825217
						
					if(($emp_idno=='23319426')||($emp_idno=='23825217')){	
						$nhif_amountdisplay=0;
						$nssf_amountdisplay=0;
						$paye_amountdisplay=0;
						
						$netsalo=($gross_salary)-($gross_salary*0.05)-$totalalded;	
					}
					else{	
						$nhif_amountdisplay=$nhif_amount;
						$nssf_amountdisplay=$nssf_amount;
						$paye_amountdisplay=$paye_amount;
						$netsalo=($gross_salary)-($nssf_amount+$nhif_amount+$paye_amount+$totalalded);	
					}

						
									echo "
										<tr>
										  <td>$No</td>
										  <td>$emp_fname $emp_onames</td>
										  <td>$emp_basicsalary</td>
										  <td>$gross_salary</td>
										  <td><h6>";
										 
					$sqlall = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_type='ALLOWANCE' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
					while($row4sql = mysqli_fetch_array($sqlall)){
						$allowancename= $row4sql["pdc_name"];
						$monthlyamount= $row4sql["pd_monthlyremittance"];
						 echo "$allowancename - $monthlyamount<br>";
					}
					if($totalallowances>0){
					echo "</h6><h5> <b>$totalallowances/=</b></h5>";
					}
										  echo "</td>
										  <td>$nhif_amountdisplay</td>
										  <td>$nssf_amountdisplay</td>
										  <td>$paye_amountdisplay</td>
										    <td><h6>";
					$sqlalld = mysqli_query($dbconnect, "SELECT * FROM tbl_payroll_allow_ded_settings s INNER JOIN tbl_payroll_allow_ded_categories c ON c.pdc_code=s.pd_transcategorycode WHERE pd_status='ACTIVE' AND pd_type='DEDUCTION' AND pd_employeeid='$emp_idno' AND pd_activeupto>='$leo_date'");
					while($row4sqld = mysqli_fetch_array($sqlalld)){
						$dedname= $row4sqld["pdc_name"];
						$dedamount= $row4sqld["pd_monthlyremittance"];
						 echo "$dedname - $dedamount<br>";
					}
					if($totalalded>0){
					echo "</h6><h5> <b>$totalalded/=</b></h5>";
					}
										  echo "</td>
										  <td>$netsalo</td>"; 
										  echo "<td><a href='employeefullprofile.php?empid=$emp_idno'>Open</a></td></tr>";
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
