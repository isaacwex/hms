<?php
include('includes/authenticate.php');
require_once ('tcpdf/tcpdf.php');

			$billvisitno = $_GET['visitno'];
			$billopno = $_GET['opno'];
			$invoiceipno  = $billopno;
			//$c_id = $_GET['c_id'];
							
			
			$patient_names = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$billopno'");
			$pd = mysqli_fetch_array($patient_names);
			
			$pid_no = $pd['id_no'];
			$pfname = $pd['f_name'];
			$pdob = $pd['dob'];
			$plname = $pd['l_name'];
			$pgender = $pd['gender'];
			$preside = $pd['residence'];
			
			$scheme_code = $pd['scheme_code'];
			$memberno = $pd['memberno'];
			
			
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_paymentschemes WHERE pscheme_code='$scheme_code'");
			$gp = mysqli_fetch_array($getPatients);
			$schemename = $gp['pscheme_name'];
			
			$todaydate = date('Y-m-d');
			
			
			$stampdate = date('d/m/Y');
			
			$leodate = date('d-m-Y, h:i:sA');
			$nileo = date('d-m-Y h:i:sA');
			
			$date1 = $pdob;
			$date2 = $todaydate;
			
			$diff = date_diff(date_create($pdob), date_create($todaydate));
			$agess = $diff->format('%y');
			
			$title='Patients for Billing Services';
			
			$get_billinfo = mysqli_query($dbconnect,"SELECT * FROM tbl_consultations WHERE consultation_opno='$billopno' AND consultation_visitno='$billvisitno'");
			
			
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor(''.$smart_name.'');
$pdf->SetTitle(''.$pfname.' '.$plname.' Lab Report for '.$nileo.'');
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
$pdf->SetFont('dejavusans', '', 12);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();
// create some HTML content

$html = '<table cellpadding="3" border="0">
<tr style="line-height:1.7;">
	<td><img src="logo.jpg" width="120px" title="$smart_name"></td>
	<td colspan="3" align="right"><span style="font-weight:bold; font-size:14px; color:blue;">Longman House T - Junction next to Friends Church</span><br />
<span align="right" font-weight:bold; style="font-size:14px">Webuye - Kitale Highway <br />P.O Box 1646 - 50205, Webuye <br /> Tel: +254 705 644 282/ +254 780 005 200 <br /> <span style="font-size:11px;">E-mail: info@calvaryhopemedical.or.ke/calvaryhopmed.centre@gmail.com</span></span></td>
</tr>
<tr>
	<td colspan="4" style="line-height:0.5;"><hr style="height:5px; color:#61105f;" ><hr style="height:2px; color:#61105f;" ></td>
</tr>
</table>
<div style="background-color:#61105f;"><span style="font-family:Times New Roman; font-size:14pt; line-height:1.8;text-align:center; font-weight:bold; color:white; width:100%;">PATIENT CONSULTATION REPORT</span></div>';
// <span align="center" color="red"><u><h4>'.$pfname.' '.$plname.' INVOICE</h4></u></span>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells

$tbl = <<<EOD
<table cellspacing="0" cellpadding="3" border="0">
    <tr>
        <td width="20%">PATIENT NAME:</td>
        <td width="25%">$plname $pfname</td>
        <td width="25%" align="right">DATE:</td>
        <td width="35%" align="">$todaydate</td>
    </tr>
    <tr>
        <td width="20%">AGE:</td>
        <td width="25%">$agess years</td>
        <td width="25%" align="right"></td>
        <td width="30%" align=""></td>
    </tr>
    <tr>
        <td width="20%">SCHEME: </td>
        <td width="30%">$schemename</td>
        <td width="25%" align="right">MEMBER NO:</td>
        <td width="25%" align="right">$memberno</td>
    </tr> 
    <tr>
        <td width="20%">OP|VISIT NO:</td>
        <td width="30%">$billopno | $billvisitno</td>
        <td width="20%" align="right">IP No.</td>
        <td width="30%" align="right"></td>
    </tr>

</table>
<table>
	<tr>
		<td style="border-top:1px solid #000;border-bottom:1px dotted #61105f;"></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="3" border="0">
    <tr style="border-top:1px dotted #000;">
        <td width="85%"><strong><u>Consulation Details</u></strong></td>
    </tr>
EOD;
$No =0;
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
			
							
			
			$tbl .= '<tr><td>'.ucwords($consultation_complaints).'</td></tr>
					 <tr><td>'.ucwords($consultation_presenthistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_allergies).'</td></tr>
					 <tr><td>'.ucwords($consultation_medicalhistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_surgicalhistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_familyhistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_economichistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_socialhistory).'</td></tr>
					 <tr><td>'.ucwords($consultation_impressions).'</td></tr>
					 <tr><td>'.ucwords($consultation_diagnosis).'</td></tr>
					 <tr><td>'.ucwords($consultation_summary).'</td></tr>
					';
			}
			$tbl .= '<tr>
						<td colspan="4" align="left" bgcolor="#D3D3D3"><strong>Consulting Doctor............</strong></td>
						<td align="right" width="30%"><strong>Signature..........</strong></td>
					</tr>';
	$tbl .= '</table>'.'<br><br /><div style="position: relative;text-align: right;color: black;"><img src="stamp.jpg" align="right" width="200px"> <div style="position:absolute;top:50px;left:50px;">'.$stampdate.'</div></div>';



$pdf->writeHTML($tbl, true, false, false, false, '');

// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output(''.$pfname.' '.$plname.' CONSULTATIONREPORT - '.$nileo.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>