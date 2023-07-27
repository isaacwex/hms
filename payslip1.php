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
<?php
	$employeeid = $sidno;
	
	$getsalo = mysqli_query($dbconnect,"SELECT * FROM tbl_payrollprocessed tp INNER JOIN tbl_employees te ON tp.pay_idno=te.emp_idno WHERE pay_idno='$employeeid'");
	$temp = mysqli_fetch_array($getsalo);
	$emp_names = $temp['pay_names'];
	$emp_id = $temp['pay_idno'];
	$emp_basic = $temp['pay_basic'];
	$emp_paye = $temp['pay_paye'];
	$emp_nhif = $temp['pay_nhif'];
	$emp_nssf = $temp['pay_nssf'];
	$emp_year = $temp['pay_year'];
	$emp_bank = $temp['emp_bank'];
	$emp_bank_branch = $temp['emp_bank_branch'];
	
	$totalded = $emp_paye+$emp_nhif+$emp_nssf;
	
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
			window.location.replace("sess.php");
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
             <div class="br-section-wrapper">     
			 <!-- <h6 class="br-section-label">Admit Student</h6>-->
		  <?php
		  $getrecords = mysqli_query($dbconnect,"SELECT * FROM tbl_masterrecords WHERE m_id='1'");
		  $mr = mysqli_fetch_array($getrecords);
		  $currentterm = $mr['m_currentterm'];
		  $lastadmno = $mr['m_lastadmno'];
		  
		  $newadmno = $lastadmno+1;
		  
		  ?>
          <!--<p>Admit students below.</p>-->
		<div class="row mg-b-25">
						 
          <div class="row">
            <div class="col-lg-4">
              <div class="media-list bg-white rounded shadow-base">
               <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Select Period</h6>
				<form method="post">
                  <div class="row mg-b-25">
					  <div class="col-lg-12">
						<?php
						
						?>
					  </div><!-- col-4 -->
					  
					  <div class="col-lg-12">
						<div class="form-group">
						  <label class="form-control-label">Year<span class="tx-danger">*</span></label>
						  <select name="bookcat" class="form-control" required>
							<option value="">Select Year</option>
							<?php
							$getcats = mysqli_query($dbconnect,"SELECT * FROM tbl_book_categories");
							while($tb = mysqli_fetch_array($getcats)){
								$catid = $tb['cat_id'];
								$catname = $tb['cat_name'];
								
								echo "<option value='$catid'>$catname</option>";
							}
							
							?>
						  </select>
						</div>
					  </div><!-- col-4 -->
					  
					  <div class="col-lg-12">
						<div class="form-group">
						  <label class="form-control-label">Select Month<span class="tx-danger">*</span></label>
						  <select name="month" class="form-control">
							<option value="">Select Month</option>
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
					  
					  <div class="col-lg-8">
						<div class="form-group mg-b-10-force">
							<button type="submit" class="btn btn-info btn-block" name="addBook"><i class="fa fa-plus"></i> View Payslip</button>
						</div>
					  </div><!-- col-4 -->
					  
					  <div class="col-lg-4">
						<div class="form-group">
						  
						</div>
					  </div><!-- col-4 -->
					  
					  
					</div><!-- row -->	
				</form>
                </div><!-- media -->
              </div><!-- card -->

            </div><!-- col-lg-8 -->
            <div class="col-lg-8 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Payslip for the month of January 2020</h6>
                  <div class="row mg-b-25">					  
					  <div class="col-lg-12">
						<div id="printPay" >
						<table class="payslip" width="365" style="border:1px dashed; border-bottom:1px;">
							<tr style="text-align:center">
								<td colspan="4"><br /><img src="img/logo.png" alt="w" width="47" height="50" style="width: 48px; height: 48px;"><br /><?php echo $schoolName; ?><br /> P.O Box <?php echo "$schoolAddress $schoolCity"; ?> <br /> <span class="txt">Payslip for <?php echo date('F');?> - <?php echo date('Y')?> </span></td>
							</tr>
							<tr>
								<td>PF No</td>
								<td><?php echo $emp_id; ?></td>
								<td>Name: </td>
								<td><?php echo $emp_names; ?></td>
							</tr>
							<tr>
								<td colspan="2">Station: </td>
								<td colspan="2"><?php echo $schoolName; ?></td>
							</tr>
							<tr style="text-align:center">
								<td colspan="4"><span class="txtb"><strong><?php echo "$emp_bank - $emp_bank_branch"; ?></strong></span></td>
							</tr>
							<table width="365" class="noborders" style="border-left:1px dashed ; border-right: 1px dashed ">
							<tr>
								<td colspan="3">Basic Salary</td>
								<td align="right"><span  style="text-align:right"><?php echo number_format($emp_basic); ?></span></td>
							</tr>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr class="txtbold">
								<td colspan="3">Total Earnings</td>
								<td style="text-align:right"><span  style="text-align:right"><strong><?php echo number_format($emp_basic); ?></strong></span></td>
							</tr>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr>							
								<td colspan="4">Deductions</td>
							</tr>
							</table>
							<table width="365" style="border-left:1px dashed ; border-right: 1px dashed">
							<tr>
								<td colspan="3">PAYE</td>
								<td style="text-align:right"><span  style="text-align:right">-<?php echo number_format($emp_paye); ?></span></td>
							</tr>
							<tr>
								<td colspan="3">NHIF</td>
								<td style="text-align:right"><span  style="text-align:right">-<?php echo number_format($emp_nhif); ?></span></td>
							</tr>
							<tr>
								<td colspan="3">NSSF</td>
								<td style="text-align:right"><span  style="text-align:right">-<?php echo number_format($emp_nssf); ?></span></td>
							</tr>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr>
								<td colspan="3">Total Deductions</td>
								<td style="text-align:right"><span  style="text-align:right"><strong>-<?php echo number_format($emp_nssf+$emp_paye+$emp_nhif); ?></strong></span></td>
							</tr>
							</table>
							<table width="365" style="border-bottom:1px solid #000000;  border-left:1px dashed ; border-right: 1px dashed">
							<tr class="txtbold">
								<td colspan="3">Net Pay (<?php echo date('F');?>-<?php echo date('Y')?>)</td>
								<td style="text-align:right"><span  style="text-align:right"><?php echo number_format($emp_basic-$totalded); ?></span></td>
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
