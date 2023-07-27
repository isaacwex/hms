<?php
include('includes/authenticate.php');
require_once ('tcpdf/tcpdf.php');

			$billvisitno = $_GET['visitno'];
			$billopno = $_GET['opno'];
			$invoiceno = $_GET['invoiceno'];
			
			$invoiceipno='';
			$itemname=''; 
			$getinvoicedetails = mysqli_query($dbconnect, "SELECT * FROM tbl_patientinvoices WHERE invoice_no='$invoiceno'");
			$ginvo = mysqli_fetch_array($getinvoicedetails);
			$invoice_datetime = $ginvo['invoice_datetime'];
			$invoice_no = $ginvo['invoice_no'];
			$invoice_payername = $ginvo['invoice_payername'];
			$invoice_visitno = $ginvo['invoice_visitno'];
			$invoice_pschemecode = $ginvo['invoice_pschemecode'];
			$invoice_pschemename = $ginvo['invoice_pschemename'];
			$invoice_memberno = $ginvo['invoice_memberno'];
			$invoice_category = $ginvo['invoice_category'];
			$invoice_ipno = $ginvo['invoice_ipno'];

			 if($invoice_ipno!=null){
				 $invoiceipno=$invoice_ipno;
				 $itemname='IP No.: ';
			 }
				
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
			
			
			$stampdate = date('d/m/Y');
			
			$leodate = date('d-m-Y, h:i:sA');
			$nileo = date('d-m-Y h:i:sA');
			
			$date1 = $pdob;
			$date2 = $todaydate;
			
			$diff = date_diff(date_create($pdob), date_create($todaydate));
			$agess = $diff->format('%y');
			
			$current_processstage='BILLING';
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry r on r.opno=q.queue_opno WHERE q.queue_to='$current_processstage'");
			$title='Patients for Billing Services';
			
			$get_billinfo = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno'");
			
			$get_inpatient= mysqli_query($dbconnect,"SELECT *, SUM(bill_qty) AS iinpatientsum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_category='INPATIENT' GROUP BY bill_servicecode ORDER BY SUBSTRING(bill_servicecode, 4, 6)");
			$get_consultations= mysqli_query($dbconnect,"SELECT *, SUM(bill_qty) AS iconsum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_category='CONSULTATION' GROUP BY bill_servicecode ORDER BY SUBSTRING(bill_servicecode, 4, 6) ");
			  
			//  $get_consultations= mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_servicecode LIKE 'INP%' OR bill_servicecode LIKE  'CON%' GROUP BY CASE WHEN bill_category='INPATIENT' THEN 1 WHEN bill_category = 'CONSULTATION' THEN 2 ELSE 3 END ORDER BY SUBSTRING(bill_servicecode, 4, 6)");
			
			/*$get_consultations= mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND  bill_servicecode LIKE 'INP%' OR bill_servicecode LIKE  'CON%' ORDER BY CASE WHEN bill_category='INPATIENT' THEN 1
              WHEN bill_category = 'CONSULTATION' THEN 2
              ELSE 3 END 
			  GROUP BY bill_category ORDER BY SUBSTRING(bill_servicecode, 4, 6)");
			*/
			$get_lab = mysqli_query($dbconnect,"SELECT *, SUM(bill_qty) AS ilabsum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND  bill_category='LABORATORY' AND bill_patientcategory='$invoice_category' GROUP BY bill_servicecode");
			
			$get_pharm = mysqli_query($dbconnect,"SELECT *, SUM(bill_qty) AS ipharmsum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND  bill_category='PHARMACY' AND bill_patientcategory='$invoice_category' GROUP BY bill_servicecode");
			
			
			
			//$sqlOthers = "SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND (bill_category!='PHARMACY' OR bill_category!='LABORATORY' OR bill_category!='INPATIENT' OR bill_category!='CONSULTATION') AND bill_patientcategory='$invoice_category'";
			//$sqlOthers = "SELECT * FROM tbl_billing WHERE bill_opno='CHMC-OP-20198-23' AND bill_visitno='1' AND bill_patientcategory='INPATIENT' AND bill_category NOT IN ('PHARMACY','LABORATORY','INPATIENT','CONSULTATION')";
			
			
			$sqlOthers = "SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_category NOT IN ('PHARMACY','LABORATORY','INPATIENT','CONSULTATION','NHIFREBATE') GROUP BY bill_servicecode";
			$othersCOUNTER = mysqli_query($dbconnect, $sqlOthers);
			$countothers = mysqli_fetch_assoc($othersCOUNTER);
			
			
			$othersrebate = mysqli_query($dbconnect, "SELECT *, SUM(bill_qty) AS iotherssum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_servicecode='NHIFREBATE'");
			$sqlRebate = "SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_servicecode='NHIFREBATE'";
			$othersCOUNTERRebate = mysqli_query($dbconnect, $sqlRebate);
			$countrebate = mysqli_fetch_assoc($othersCOUNTERRebate);
			
			
			$others = mysqli_query($dbconnect, "SELECT *, SUM(bill_qty) AS iotherssum FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_category NOT IN ('PHARMACY','LABORATORY','INPATIENT','CONSULTATION') GROUP BY bill_servicecode");
			
			
			$billTotal = mysqli_query($dbconnect,"SELECT SUM(bill_amount*bill_qty) AS billT FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category'");
			$pataTotal = mysqli_fetch_array($billTotal);
			$totalbill_now = $pataTotal['billT'];
			
//Rebate and copay			
			$billTotalRebate = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_servicecode='NHIFREBATE'");
			$pataTotalRebate = mysqli_fetch_array($billTotalRebate);
			$nhifrebate = $pataTotalRebate['bill_amount'];
			
			$billTotalCopay = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno' AND bill_patientcategory='$invoice_category' AND bill_servicecode='COPAY'");
			$pataTotalCopay = mysqli_fetch_array($billTotalCopay);
			$copay = $pataTotalCopay['bill_amount'];
		
			
//create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor(''.$smart_name.'');
$pdf->SetTitle(''.$pfname.' '.$plname.' Bill for '.$nileo.'');
$pdf->SetSubject(''.$pfname.''.$plname.'');
$pdf->SetKeywords(''.$smart_name.', PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// remove default header/footer
$pdf->setPrintHeader(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins( $left, $top, $right = -1, $keepmargins = false );
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 9);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();
// create some HTML content

$html = '<table cellpadding="3" border="0">
<tr style="line-height:1.5;">
	<td><img src="logo.jpg" width="120px" title="$smart_name"></td>
	<td colspan="3" align="right"><span style="font-weight:bold; font-size:14px; color:blue;">Longman House T - Junction next to Friends Church</span><br />
<span align="right" font-weight:bold; line-height:0.5; style="font-size:14px">Webuye - Kitale Highway <br />P.O Box 1646 - 50205, Webuye <br /> Tel: +254 705 644 282/ +254 780 005 200 <br /> <span style="font-size:11px;">E-mail: info@calvaryhopemedical.or.ke/calvaryhopmed.centre@gmail.com</span></span></td>
</tr>
<tr>
	<td colspan="4" style="line-height:0.5;"><hr style="height:5px; color:#61105f;" ><hr style="height:2px; color:#61105f;" ></td>
</tr>
</table>
<div style="background-color:#61105f;"><span style="font-family:Times New Roman; font-size:12pt; line-height:1.5;text-align:center; font-weight:bold; color:white; width:100%;">'.$invoice_category.' INVOICE</span></div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">
    <tr height="8px">
        <td width="20%">PATIENT NAME:</td>
        <td width="35%">$plname $pfname</td>
        <td width="15%" align="left">INVOICE DATE:</td>
        <td width="30%" align="">$invoice_datetime</td>
    </tr>
    <tr height="8px">
        <td width="20%">AGE:</td>
        <td width="35%">$agess years</td>
        <td width="15%" align="left">INVOICE NO:</td>
        <td width="30%" align="">$invoice_no</td>
    </tr>
    <tr height="8px">
        <td width="20%">BILLED TO: </td>
        <td width="35%">$invoice_pschemename</td>
        <td width="15%" align="left">MEMBER NO:</td>
        <td width="30%" align="">$invoice_memberno</td>
    </tr> 
    <tr style="border-bottom:1px solid #000;height:10px;">
        <td width="20%">$itemname</td>
        <td width="35%">$invoiceipno</td>
        <td width="15%" align="left">O.P./VISIT NO:</td>
        <td width="30%" align="">$bopno/$billvisitno</td>
    </tr>

</table>
<table>
	<tr>
		<td style="border-top:1px solid #000;border-bottom:1px dotted #61105f;"></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="3" border="1px dotted #000">
    <tr style="border-top:1px dotted #808080; background-color:#61105f;color:#fff;">
        <td width="100%" align="center" colspan="5"><strong>SERVICE CHARGES</strong></td>
    </tr>
    <tr style="border-top:1px dotted #808080;">
        <td width="4%"><strong>NO</strong></td>
        <td width="61%"><strong>ITEM NAME</strong></td>
        <td width="8%"><strong>QTY</strong></td>
        <td width="12%" align="right"><strong>RATE</strong></td>
        <td width="15%" align="right"><strong>BILL AMOUNT</strong></td>
    </tr>
EOD;
$No =0;
//$totalbill_now =0;

//inpatient first
while($bill = mysqli_fetch_array($get_inpatient)){
			$No = $No+1;
			$bill_amount = $bill['bill_amount'];
			$bill_category = strtoupper($bill['bill_category']);
			$bill_servicename = strtoupper($bill['bill_servicename']);
			$bill_scheme = strtoupper($bill['bill_paymentscheme']);
			$bill_datetime = $bill['bill_datetime'];
			//$bill_qty = $bill['bill_qty'];
			$bill_qty = $bill['iinpatientsum'];
			$bill_category = $bill['bill_category'];
			if(empty($bill_qty)){
			$bill_qty='1';;
			}
			$subtotal=($bill_qty*$bill_amount);
			$tbl .= '<tr>
						<td width="4%">'.$No.'</td>
						<td  width="61%">'.ucwords($bill_servicename).'</td>
						<td  width="8%" align="right">'.$bill_qty.'</td>
						<td align="right" width="12%">'.number_format($bill_amount,2).'</td>
						<td align="right" width="15%">'.number_format($subtotal,2).'</td>
					</tr>';
					//$totalbill_now=$totalbill_now+$subtotal;
					//$totalbill_now=$totalbill_now+$subtotal;
			}
	//Consultations

	while($billcon = mysqli_fetch_array($get_consultations)){
			$No = $No+1;
			$bill_amount = $billcon['bill_amount'];
			$bill_category = strtoupper($billcon['bill_category']);
			$bill_servicename = strtoupper($billcon['bill_servicename']);
			$bill_scheme = strtoupper($billcon['bill_paymentscheme']);
			$bill_datetime = $billcon['bill_datetime'];
			//$bill_qty = $bill['bill_qty'];
			$bill_qty = $billcon['iconsum'];
			$bill_category = $billcon['bill_category'];
			if(empty($bill_qty)){
			$bill_qty='1';;
			}
			$subtotal=($bill_qty*$bill_amount);
			$tbl .= '<tr>
						<td width="4%">'.$No.'</td>
						<td  width="61%">'.ucwords($bill_servicename).'</td>
						<td  width="8%" align="right">'.$bill_qty.'</td>
						<td align="right" width="12%">'.number_format($bill_amount,2).'</td>
						<td align="right" width="15%">'.number_format($subtotal,2).'</td>
					</tr>';
					//$totalbill_now=$totalbill_now+$subtotal;
					//$totalbill_now=$totalbill_now+$subtotal;
			}		  



			  
			$tbl .= '<tr style="border-top:1px dotted #808080; background-color:#61105f;color:#fff;">
						<td width="100%" align="center" colspan="5"><strong>LABORATORY</strong></td>
					</tr>';
			
while($billa = mysqli_fetch_array($get_lab)){
			$No = $No+1;
			$lab_amount = $billa['bill_amount'];
			$lab_category = strtoupper($billa['bill_category']);
			$lab_servicename = strtoupper($billa['bill_servicename']);
			$lab_scheme = strtoupper($billa['bill_paymentscheme']);
			$lab_datetime = $billa['bill_datetime'];
			//$lab_qty = $billa['bill_qty'];
			$lab_qty = $billa['ilabsum'];
			$lab_category = $billa['bill_category'];
			if(empty($lab_qty)){
				$lab_qty='1';
			}
			/*if($bill_category=='PHARMACY'){
			$subtotal=($bill_qty*$bill_amount);
			}
			else{
				$subtotal=$bill_amount;
			}
			*/
			$lab_subtotal=($lab_qty*$lab_amount);
			$tbl .= '<tr>
						<td width="4%">'.$No.'</td>
						<td  width="61%">'.ucwords($lab_servicename).'</td>
						<td  width="8%" align="right">'.$lab_qty.'</td>
						<td align="right" width="12%">'.number_format($lab_amount,2).'</td>
						<td align="right" width="15%">'.number_format($lab_subtotal,2).'</td>
					</tr>';
					$lab_totalbill_now=$totalbill_now+$lab_subtotal;
			
}

//If others are there show them
if($countothers>1){
	$tbl .= '<tr style="border-top:1px dotted #808080; background-color:#61105f;color:#fff;">
						<td width="100%" align="center" colspan="5"><strong>OTHERS</strong></td>
					</tr>';
			while($getothers = mysqli_fetch_array($others)){
					$No = $No+1;
					$amount_others = $getothers['bill_amount'];
					$pharm_category = strtoupper($getothers['bill_category']);
					$servicename_others = strtoupper($getothers['bill_servicename']);
					//$qty_others = $getothers['bill_qty'];
					$qty_others = $getothers['iotherssum'];
					if(empty($qty_others)){
					$bill_qty='1';;
					}
					/*if($bill_category=='PHARMACY'){
					$subtotal=($bill_qty*$bill_amount);
					}
					else{
						$subtotal=$bill_amount;
					}
					*/
					$subtotal_others=($qty_others*$amount_others);
					$tbl .= '<tr>
								<td width="4%">'.$No.'</td>
								<td  width="61%">'.ucwords($servicename_others).'</td>
								<td  width="8%" align="right">'.$qty_others.'</td>
								<td align="right" width="12%">'.number_format($amount_others,2).'</td>
								<td align="right" width="15%">'.number_format($subtotal_others,2).'</td>
							</tr>';
							//$totalbill_now=$totalbill_now+$subtotal_others;
					
		}
}			
			
			$tbl .= '<tr style="border-top:1px dotted #808080; background-color:#61105f;color:#fff;">
						<td width="100%" align="center" colspan="5"><strong>DRUGS & CONSUMABLES</strong></td>
					</tr>';

while($pharma = mysqli_fetch_array($get_pharm)){
			$No = $No+1;
			$pharm_amount = $pharma['bill_amount'];
			$pharm_category = strtoupper($pharma['bill_category']);
			$pharm_servicename = strtoupper($pharma['bill_servicename']);
			$pharm_scheme = strtoupper($pharma['bill_paymentscheme']);
			$pharm_datetime = $pharma['bill_datetime'];
			//$pharm_qty = $pharma['bill_qty'];
			$pharm_qty = $pharma['ipharmsum'];
			$pharm_category = $pharma['bill_category'];
			if(empty($bill_qty)){
			$bill_qty='1';;
			}
			/*if($bill_category=='PHARMACY'){
			$subtotal=($bill_qty*$bill_amount);
			}
			else{
				$subtotal=$bill_amount;
			}
			*/
			$pharm_subtotal=($pharm_qty*$pharm_amount);
			$tbl .= '<tr>
						<td width="4%">'.$No.'</td>
						<td  width="61%">'.ucwords($pharm_servicename).'</td>
						<td  width="8%" align="right">'.$pharm_qty.'</td>
						<td align="right" width="12%">'.number_format($pharm_amount,2).'</td>
						<td align="right" width="15%">'.number_format($pharm_subtotal,2).'</td>
					</tr>';
					//$pharmtotalbill_now=$lab_totalbill_now+$pharm_subtotal;
			
}

			$tbl .= '<tr>
						<td colspan="4" align="right" bgcolor="#61105f" color="#fff"><strong>TOTAL BILL</strong></td>
						<td align="right" width="15%"><strong>'.number_format($totalbill_now,2).'</strong></td>
					</tr>';
if($nhifrebate>0){					
			while($pharmarebate = mysqli_fetch_array($pataTotalRebate)){
					$No = $No+1;
					$pharm_amount = $pharmarebate['bill_amount'];
					$pharm_category = strtoupper($pharmarebate['bill_category']);
					$pharm_servicename = strtoupper($pharmarebate['bill_servicename']);
					$pharm_scheme = strtoupper($pharmarebate['bill_paymentscheme']);
					$pharm_datetime = $pharmarebate['bill_datetime'];
					//$pharm_qty = $pharma['bill_qty'];
					$pharm_qty = $pharmarebate['ipharmsumrebate'];
					$pharm_category = $pharmarebate['bill_category'];
					if(empty($bill_qty)){
					$bill_qty='1';;
					}
					/*if($bill_category=='PHARMACY'){
					$subtotal=($bill_qty*$bill_amount);
					}
					else{
						$subtotal=$bill_amount;
					}
					*/
					$pharm_subtotal=($pharm_qty*$pharm_amount);
					$tbl .= '<tr>
								<td width="4%">'.$No.'</td>
								<td  width="61%">'.ucwords($pharm_servicename).'</td>
								<td  width="8%" align="right">'.$pharm_qty.'</td>
								<td align="right" width="12%">'.number_format($pharm_amount,2).'</td>
								<td align="right" width="15%">'.number_format($pharm_subtotal,2).'</td>
							</tr>';
							//$pharmtotalbill_now=$lab_totalbill_now+$pharm_subtotal;
		}				
}				
			$totalbill_nowpay=$totalbill_now-$copay-$nhifrebate;
			if($copay>0){
			$tbl .= '<tr>
						<td colspan="4" align="right" bgcolor="" color=""><strong>COPAY</strong></td>
						<td align="right" width="15%"><strong>'.number_format($copay,2).'</strong></td>
					</tr>';
			}
			/*if($nhifrebate>0){
			$tbl .= '<tr>
						<td colspan="4" align="right" bgcolor="" color=""><strong>NHIF REBATE</strong></td>
						<td align="right" width="15%"><strong>'.number_format($nhifrebate,2).'</strong></td>
					</tr>';
			}
			*/
			$tbl .= '<tr>
						<td colspan="4" align="right" bgcolor="#61105f" color="#fff"><strong>TOTAL TO PAY</strong></td>
						<td align="right" width="15%"><strong>'.number_format($totalbill_nowpay,2).'</strong></td>
					</tr>';
					
	$tbl .= '</table>'.'<br><br /><div style="position: relative;text-align: right;color: black;"><img src="stamp.jpg" align="right" width="200px"> <div style="position:absolute;top:50px;left:50px;">'.$stampdate.'</div></div>';



$pdf->writeHTML($tbl, true, false, false, false, '');

// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output(''.$pfname.' '.$plname.' INVOICE - '.$nileo.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>