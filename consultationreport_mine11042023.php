<?php include('includes/authenticate.php'); 
date_default_timezone_set("Africa/Nairobi");
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>View Consultaion Report - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script type="text/javascript">

       function printDiv(divName) {
           var printContents = document.getElementById(divName).innerHTML;
           var originalContents = document.body.innerHTML;

           document.body.innerHTML = printContents;

           window.print();

           document.body.innerHTML = originalContents;
       }

</script>
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
			$billvisitno = $_GET['visitno'];
			$billopno = $_GET['opno'];
			$getbilling = mysqli_query($dbconnect, "SELECT * FROM tbl_billing lb INNER JOIN tbl_registry tl ON lb.bill_opno=tl.opno WHERE lb.bill_opno='$billopno'");
			$gbil = mysqli_fetch_array($getbilling);
			
			$bopno = $gbil['bill_opno'];
			$bvisitno = $gbil['bill_visitno'];
			$bfname = $gbil['f_name'];
			$blname = $gbil['l_name'];
			$bdob = $gbil['dob'];
			$bservicename = $gbil['bill_servicename'];
			$bamount = $gbil['bill_amount'];
			$bvisitdate = $gbil['visit_date'];
			$b_billdate = $gbil['bill_datetime'];
			
			$patient_names = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$bopno'");
			$pd = mysqli_fetch_array($patient_names);
			
			$pid_no = $pd['id_no'];
			$pfname = $pd['f_name'];
			$pdob = $pd['dob'];
			$plname = $pd['l_name'];
			$pgender = $pd['gender'];
			$preside = $pd['residence'];
			
			$todaydate = date('Y-m-d');
			
			$leodate = date('d-m-Y, h:i:sA');
			
			$date1 = $pdob;
			$date2 = $todaydate;
			
			$diff = date_diff(date_create($pdob), date_create($todaydate));
			$agess = $diff->format('%y');
			
			$current_processstage='BILLING';
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry r on r.opno=q.queue_opno WHERE q.queue_to='$current_processstage'");
			$title='Patients for Billing Services';

		?>	
			
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>View Bill Statament</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Dashboard</a>
                        </li>
                        <li>
                            Report
                        </li>
                        <li class="active">
                            <strong>Lab Report for <?php echo "$bfname $blname - Visit No. $bvisitno"; ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    
                </div>
        </div>
        <div class="row">
			<div class="col-lg-1">
			</div>
            <div class="col-lg-10">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div id="printableArea">
					<div class="ibox-content p-xl printed">
						<!-- Hospital Details -->
							
                     
							<div id="printableArea">
								
							<table bgcolor="White" style="border: 0px solid #000000"><tr>
								   <td valign="top" width="2480px" style="height: 456px;">
								
							<table width="100%" cellspacing="0" cellpadding="4">

							<tr style="border-bottom:1pt solid black; width:100%;" align="center" >
								<td colspan="4" align="center" style="border-bottom: 2px solid #000000; height: 23px; border-bottom-width: 1px;" valign="middle"><span style="font-family:Times New Roman;font-size:18pt;font-weight:bold;"><?php $institution_name = strtoupper($smart_name); echo $institution_name; ?></span><br > <p style="font-family:Times New Roman;font-size:12pt;font-weight:bold;"><?php echo $smart_address; ?> <br /> Mobile: <?php echo $smart_phone; ?> <br /> E-mail: <?php echo $smart_email; ?></p>
								</td>
								</hr>
							</tr>
							<tr>
								<br /><td colspan="4" align="center"><span style="font-family:Times New Roman;font-size:14pt;font-weight:bold;color:red;">PATIENT CONSULTATION REPORT </span><br />
								<hr>
								</td>
							</tr>
								<td style="width: 150px; height: 19px;"><span style="font-family:Times New Roman;font-size:12pt;">Patient Name:</span></td>
								 <td  style="height: 19px"><span style="font-family:Times New Roman;font-size:12pt;"><?php echo $pfname; echo ' '; echo $plname; ?> </span></td>
								<td style="width: 150px; height: 19px;"><span style="font-family:Times New Roman;font-size:12pt;">OP No:</span></td>
								 <td colspan="1" style="height: 19px"><span style="font-family:Times New Roman;font-size:12pt;"><?php echo $bopno; ?> </span><br /></td>
							</tr> 
							<tr>
								<td style="width: 150px; height: 19px;"><span style="font-family:Times New Roman;font-size:12pt;">Visit Date:</span></td>
								 <td  style="height: 19px"><span style="font-family:Times New Roman;font-size:12pt;"><?php  echo $bvisitdate; ?> </span></td>
								<td style="width: 150px; height: 19px;"><span style="font-family:Times New Roman;font-size:12pt;">Visit No:</span></td>
								 <td colspan="1" style="height: 19px"><span style="font-family:Times New Roman;font-size:12pt;"><?php echo $bvisitno; ?> </span><br /></td>
							</tr> 

							<tr>
								<td style="width: 70px; height: 17px;"><span style="font-family:Times New Roman;font-size:12pt;">Age:</span></td>
								<td colspan="1" style="height: 17px"><span style="font-family:Times New Roman;font-size:12pt;"><?php echo $agess; ?> years</span></td>
								<td style="width: 70px; height: 17px;"><span style="font-family:Times New Roman;font-size:12pt;">Gender:</span></td>
								<td colspan="1" style="height: 17px"><span style="font-family:Times New Roman;font-size:12pt;"><?php echo $pgender; ?> </span></td>
							</tr>  
							
							<tr>
							</br>
								<td colspan="4" align="center"><span id="ContentPlaceHolder1_lblBank" style="font-family:Times New Roman;font-size:12pt;font-weight:bold;">CONSULTATION SERVICE DETAILS</span><br /></td>
							</tr> 
							
							</table>
							
							<table width="100%" cellspacing="2">
								

								<table width="100%" cellpadding="5" border="1px" id="table" style="height: 97px; margin-left:2px">
									<tr id="ContentPlaceHolder1_lblBank"style="background-color:gray; border-top-width: 1pt; border-top-color: #000000;font-weight:bold">
										
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Item
										</td>
										<td align="right" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Notes 
										</td>
									</tr>
									<?php
									$No = 0;
									$get_billinfo = mysqli_query($dbconnect,"SELECT * FROM tbl_consultations WHERE consultation_opno='$billopno' AND consultation_visitno='$billvisitno'");
									while($bill = mysqli_fetch_array($get_billinfo)){
										$No = $No+1;
										$consultation_complaints = $bill['consultation_complaints'];
										$consultation_presenthistory = $bill['consultation_presenthistory'];
										$consultation_allergies = $bill['consultation_allergies'];
										$consultation_medicalhistory = $bill['consultation_medicalhistory'];
										$consultation_surgicalhistory = $bill['consultation_surgicalhistory'];
										$consultation_familyhistory = $bill['consultation_familyhistory'];
										$consultation_economichistory = $bill['consultation_economichistory'];
										$consultation_socialhistory = $bill['consultation_socialhistory'];
										$consultation_impressions = $bill['consultation_impressions'];
										$consultation_diagnosis = $bill['consultation_diagnosis'];
										$consultation_summary = $bill['consultation_summary'];
									?>
									
									<?php 
									if($consultation_complaints!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Complains</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_complaints; ?></td>
									</tr>
									<?php }?>
									
									<?php 
									if($consultation_presenthistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Present History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_presenthistory; ?></td>
									</tr>
									<?php }?>
									<!-- allergies-->
									<?php 
									if($consultation_allergies!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Allergies</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_allergies; ?></td>
									</tr>
									<?php }?>
									<!-- medical history-->
									<?php 
									if($consultation_medicalhistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Medical History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_medicalhistory; ?></td>
									</tr>
									<?php }?>
									<!-- Surgical history-->
									<?php 
									if($consultation_surgicalhistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Medical History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_surgicalhistory; ?></td>
									</tr>
									<?php }?>
									<!-- Family history-->
									<?php 
									if($consultation_familyhistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Medical History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_familyhistory; ?></td>
									</tr>
									<?php }?>
									<!-- Economic history-->
									<?php 
									if($consultation_economichistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Medical History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_economichistory; ?></td>
									</tr>
									<?php }?>
									<!-- consultation_socialhistory history-->
									<?php 
									if($consultation_socialhistory!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Medical History</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_socialhistory; ?></td>
									</tr>
									<?php }?>
									<!-- consultation_impressions history-->
									<?php 
									if($consultation_impressions!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Impressions</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_impressions; ?></td>
									</tr>
									<?php }?>
									<!-- consultation_diagnosis -->
									<?php 
									if($consultation_diagnosis!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Impressions</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_diagnosis; ?></td>
									</tr>
									<?php }?>
									<!-- consultation_diagnosis -->
									<?php 
									if($consultation_diagnosis!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Diagnosis</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_diagnosis; ?></td>
									</tr>
									<?php }?>
									<!-- consultation_summary -->
									<?php 
									if($consultation_diagnosis!=null){
									?>
									<tr>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt">Summary</td>
										<td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12pt"><?php echo $consultation_summary; ?></td>
									</tr>
									<?php }?>
																		
									
									<?php
									}
									?>
								</table>
							</td>

							</tr>
							 </table>
							 
									<tr style="font-family: 'Times New Roman', Times, serif; font-size: 10px; border-top-style: solid; border-top-width: 1pt; border-top-color: #000000"><td align="left" style="font-family: 'Times New Roman', Times, serif; font-size: 12px; border-top-style: solid; border-top-width: 1px; border-top-color: #ff0000"> Name: _______________ </td>
									<td align="centre" style="font-family: 'Times New Roman', Times, serif; font-size: 12px; border-top-style: solid; border-top-width: 1px; border-top-color: #ff0000"> Signature _______________</td>
									</tr>
							 
									   <tr align="center" style="font-family: 'Times New Roman', Times, serif; font-size: 10px; border-top-style: solid; border-top-width: 1pt; border-top-color: #000000"><td valign="bottom" style="font-family: 'Times New Roman', Times, serif; font-size: 12px; border-top-style: solid; border-top-width: 1px; border-top-color: #ff0000">
									   At <?php echo $smart_name; ?> - <?php echo $slogan; ?></br>
									   Print Date: <?php echo $leodate; ?>
									  </td></tr>
							  
							 </table>

								
							</div>
							</div>
							</div>
						
							<button onclick="printDiv('printableArea')" class="btn btn-primary"><i class="fa fa-print"></i> Print/Save</button> 
                   		
            </div>
            </div>
        </div>
		
		
		<?php include 'includes/footer.php'?>
    </div>
    </div>
	<script>
	
			
    </script>
   <?php include 'includes/footer-scripts.php';?>
   <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
       <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Page-Level Scripts -->
   
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>
</html>
