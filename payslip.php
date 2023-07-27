<?php include('includes/authenticate.php'); ?>
<?php
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	<?php
	$employeeid = $_GET['id'];
	$year = $_GET['y'];
	$month = $_GET['m'];
	
	$getnam = mysqli_query($dbconnect,"SELECT * FROM `tbl_employees` WHERE `emp_idno`='$employeeid'");
	$namearray = mysqli_fetch_array($getnam);
	$emp_names = $namearray['emp_fname']." ".$namearray['emp_onames'];

	//$emp_bank = $namearray['emp_bank'];
	//$emp_bank_branch = $namearray['emp_bank_branch'];
	//$emp_accountno = $namearray['emp_accountno'];
	$emp_designation = $namearray['emp_designation'];
	$emp_dob = $namearray['emp_dob'];
	$emp_nssfno = $namearray['emp_nssfno'];
	$emp_nhifno = $namearray['emp_nhifno'];
	$emp_kra = $namearray['emp_kra'];
	
	?>
	
	
    <title> Payslip - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
<?php
	
	
	
	

// Basic Details
	$getsalo = mysqli_query($dbconnect,"SELECT * FROM `tbl_payrollprocessed` WHERE `pay_idno`='$employeeid' AND `pay_month`='$month' AND `pay_year`='$year'");
	$gdoc = mysqli_fetch_array($getsalo);
	
								$emp_id=$gdoc['pay_idno'];
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
								
								$emp_accountno=$gdoc['pay_accno'];
								$emp_bank=$gdoc['pay_bank'];
								$emp_bank_branch=$gdoc['pay_branch'];
								
								
								
														
								$sdate= $pay_month;
								$sday= $pay_month;
								$pay_yeardisplay= $pay_year;
								$mon= $month;
								
							$pcode=$sdate.$sday;
	
//Deductions
	
	
	
	
	?>
	<script type="text/javascript">
<!--
function printContent(id){
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=1000,height=500')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE></TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
//-->
</script>
<script type="text/javascript">
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			window.location.replace("paysliplist.php");
		}
</script>
	<style>
	
	.payslip {
		font-family: "Times New Roman";
		text-color: black;
	}
	
	.txt {
		color: red;
		font-style:italic;
		font-style: bold;
		font-size:15px;
	}
	.txtb {
		font-family:arial;
		font-style: bold;
		color: #0000ff;
		font-style:italic;
		
	}
	.txtbold {
		font-family:"Times New Roman";
		font-style: bolder;
		color: black;
	}
	.foota {
		text-align:center;
		color:red;
		font-style:italic;
		font-size:10px;
	}
	
	</style>
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
						<a href="paysliplist.php"> Payroll</a>
					</li>                        
					<li class="active">
						<strong>Payslip</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<span><a href="paysliplist.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></p>
				</div>
		</div>

       <!-- <div class="wrapper wrapper-content"> -->
             <div class="br-section-wrapper">     
			 <!-- <h6 class="br-section-label">Admit Student</h6>-->
		
          <!--<p>Admit students below.</p>-->
		<div class="row mg-b-25">
						 
          <div class="row">
            <div class="col-lg-4">
             
            </div><!-- col-lg-8 -->
            <div class="col-lg-8 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Payslip for the month of <?php if($sday=='01'){$mon='January';}if($sday=='02'){$mon='February';}if($sday=='03'){$mon='March';}if($sday=='04'){$mon='April';}if($sday=='05'){$mon='May';}if($sday=='06'){$mon='June';}if($sday=='07'){$mon='July';}if($sday=='08'){$mon='August';}if($sday=='09'){$mon='September';}if($sday=='10'){$mon='October';}if($sday=='11'){$mon='November';}if($sday=='12'){$mon='December';} echo $mon.", ".$pay_yeardisplay; ?> </h6>
                  <div class="row mg-b-25">					  
					  <div class="col-lg-12">
						<div id="printPay" >
						<table class="payslip" width="365" style="border:1px dashed; border-bottom:1px;">
							<tr style="text-align:center">
							<td colspan="3"><img src="img/profile_small.jpg" alt="w" width="47" height="50" style="width: 48px; height: 48px;"><br/><?php echo $smart_name; ?><br /><span style="font-weight:bold; font-size:14px; color:blue;">Longman House T - Junction next to Friends Church</span><br />
<span align="right" font-weight:bold; line-height:0.5; style="font-size:14px">Webuye - Kitale Highway <br />P.O Box 1646 - 50205, Webuye <br /> Tel: +254 705 644 282/ +254 780 005 200 <br /> <span style="font-size:11px;"> info@calvaryhopemedical.or.ke/calvaryhopmed.centre@gmail.com</span></span></td>
							</tr>	<br />
							<tr style="text-align:center">
								<td colspan="3"><span class="txt"> <br/>
								Payslip for the month of <?php if($sday=='01'){$mon='January';}if($sday=='02'){$mon='February';}if($sday=='03'){$mon='March';}if($sday=='04'){$mon='April';}if($sday=='05'){$mon='May';}if($sday=='06'){$mon='June';}if($sday=='07'){$mon='July';}if($sday=='08'){$mon='August';}if($sday=='09'){$mon='September';}if($sday=='10'){$mon='October';}if($sday=='11'){$mon='November';}if($sday=='12'){$mon='December';} echo $mon.", ".$pay_yeardisplay; ?>
							</span></td>
							</tr>
							<br />
							<br />
							<tr>
								<td>Name:</td>
								<td><?php echo $emp_names; ?></td>
							</tr>
							<tr>
								<td>ID No</td>
								<td><?php echo $emp_id; ?></td>
							</tr>
							<tr>
								<td>Designation:</td>
								<td><?php echo $emp_designation; ?></td>
							</tr>
							<tr>
								<td>Bank:</td>
								<td><?php echo $emp_bank; ?></td>
							</tr>
							<tr>
								<td>Bank Branch: </td>
								<td><?php echo $emp_bank_branch; ?></td>
							</tr>
							<tr>
								<td>Bank Acc No: </td>
								<td><?php echo $emp_accountno; ?></td>
							</tr>
							<tr>
								<td>Nssf No: </td>
								<td><?php echo $emp_nssfno; ?></td>
							</tr>
							<tr>
								<td>Nhif No: </td>
								<td><?php echo $emp_nhifno; ?></td>
							</tr>
							<tr>
								<td>KRA Pin: </td>
								<td><?php echo $emp_kra; ?></td>
							</tr>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr>							
								<td colspan="4"><b>Earnings</b></td>
							</tr>
							</table>
							<table width="365" class="noborders" style="border-left:1px dashed ; border-right: 1px dashed ">
							<tr>
								<td colspan="3">Basic Salary</td>
								<td align="right"><span  style="text-align:right"><?php echo number_format($pay_basic); ?></span></td>
							</tr>
							<?php 
							$getallowance = mysqli_query($dbconnect,"SELECT * FROM `tbl_payroll_allow_ded_contributions` WHERE `pdt_employeeid`='$emp_id' and `pdt_year`='$year' AND `pdt_month`='$month' AND pdt_payrollitemcategory='ALLOWANCE'");
							$all=0;
							while($ga = mysqli_fetch_array($getallowance)){ 
								$pdt_payrollitemcode =$ga['pdt_payrollitemcode'];
								$pdt_amount =$ga['pdt_amount'];
								$allowancenamecode =$ga['pdt_payrollitemcode'];
								
							$getallowancename = mysqli_query($dbconnect,"SELECT * FROM `tbl_payroll_allow_ded_categories` WHERE `pdc_code`='$allowancenamecode'");
							$ganame = mysqli_fetch_array($getallowancename);
								$pdt_payrollitemname =$ganame['pdc_name'];	
								
								
								?>
							<tr>
								<td colspan="3"><?php echo $pdt_payrollitemname; ?></td>
								<td align="right"><span  style="text-align:right"><?php echo number_format($pdt_amount); ?></span></td>
							</tr>
							<?php } ?>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr class="txtbold">
								<td colspan="3">Gross Pay</td>
								<td style="text-align:right"><span  style="text-align:right"><strong><?php  echo number_format($pay_gross); ?></strong></span></td>
							</tr>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr>							
								<td colspan="4"><b>Deductions</b></td>
							</tr>
							</table>
							<table width="365" style="border-left:1px dashed ; border-right: 1px dashed">
							<tr>
								<td colspan="3">PAYE</td>
								<td style="text-align:right"><span  style="text-align:right"><?php echo number_format($pay_paye); ?></span></td>
							</tr>
							<tr>
								<td colspan="3">NHIF</td>
								<td style="text-align:right"><span  style="text-align:right"><?php echo number_format($pay_nhif); ?></span></td>
							</tr>
							<tr>
								<td colspan="3">NSSF</td>
								<td style="text-align:right"><span  style="text-align:right"><?php echo number_format($pay_nssf); ?></span></td>
							</tr>
							<?php 
							$getallowance = mysqli_query($dbconnect,"SELECT * FROM `tbl_payroll_allow_ded_contributions` WHERE `pdt_employeeid`='$emp_id' and `pdt_year`='$year' AND `pdt_month`='$month' AND pdt_payrollitemcategory='DEDUCTION'");
							$all=0;
							while($ga = mysqli_fetch_array($getallowance)){ 
								$pdt_payrollitemcode =$ga['pdt_payrollitemcode'];
								$pdt_amount =$ga['pdt_amount'];
								$allowancenamecode =$ga['pdt_payrollitemcode'];
								
							$getallowancename = mysqli_query($dbconnect,"SELECT * FROM `tbl_payroll_allow_ded_categories` WHERE `pdc_code`='$allowancenamecode'");
							$ganame = mysqli_fetch_array($getallowancename);
								$pdt_payrollitemname =$ganame['pdc_name'];	
								
								
								?>
							<tr>
								<td colspan="3"><?php echo $pdt_payrollitemname; ?></td>
								<td align="right"><span  style="text-align:right"><?php echo number_format($pdt_amount); ?></span></td>
							</tr>
							<?php } ?>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr>
								<td colspan="3"></td>
								<td style="text-align:right"></td>
							</tr>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr class="txtbold">
								<td colspan="3"><b>Net Pay </b></td>
								<td style="text-align:right"><b><span  style="text-align:right"><?php echo number_format($pay_net); ?></span></b></td>
							</tr>
							
								<table width="365" style="border:1px solid black">
									<tr class="foota">
										<td><span>Printed on <?php echo date("Y-m-d h:i:sa"); ?></span></td>
									</tr>
								</table>
							</table>
					            
                        </table>
                        </table>
					  </div><!-- col-4 -->
					  <button class="btn btn-primary" onClick="printDiv('printPay')">Print</button>
					  </div><!-- col-4 -->
					</div><!-- row -->	
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
		
		</div><!-- row -->
        </div><!-- br-section-wrapper -->
				<!-- br-section-wrapper --> 
		<?php include 'includes/footer.php'?>
        </div>
    </div>
   <?php include 'includes/footer-scripts.php';?>
</body>
</html>