<?php include 'includes/authenticate.php';
if($user_l=='REGISTRY'){header("Location: registry.php");}
if($user_l=='TRIAGE'){header("Location: triage.php");}
if($user_l=='CONSULTATION'){header("Location: consultations.php");}
if($user_l=='LABORATORY'){header("Location: laboratory.php");}
if($user_l=='TREATMENTROOM'){header("Location: treatmentroom.php");}
if($user_l=='PHARMACY'){header("Location: newotc.php");}

$startdate=date('Y/m/d');
$enddate=date('Y/m/d');

$getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_itemcode`");
$salecount=$getsalecount->num_rows;
$sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE `datee`>='$startdate' AND `datee`<='$enddate'";
$result4 = mysqli_query($dbconnect, $sql4);
$row = mysqli_fetch_assoc($result4);
$total= $row["total"];
$sql5 = "SELECT SUM(sale_amount) as mpesa FROM tbl_sales WHERE `datee`>='$startdate' AND `datee`<='$enddate'";
$result5 = mysqli_query($dbconnect, $sql5);
$row5 = mysqli_fetch_assoc($result5);
$mpesa= $row5["mpesa"];
$sql7 = "SELECT SUM(sale_amount) as cash FROM tbl_sales WHERE `datee`>='$startdate' AND `datee`<='$enddate'";
$result7 = mysqli_query($dbconnect, $sql7);
$row7 = mysqli_fetch_assoc($result7);
$cash= $row7["cash"];
$other=$total-($mpesa+$cash);
//value of stock
$sql9 = "SELECT * FROM tbl_inventory WHERE `inve_qty`>0";
$result9 = mysqli_query($dbconnect, $sql9);
$row9 = mysqli_num_rows($result9);

//get expiry
$expiry=date('Y-m-d', strtotime('+7 days'));
$sql10 = "SELECT SUM(inve_qty) as exiprytotal FROM tbl_inventory WHERE `inve_expirydate`>='$expiry' AND `inve_expirydate`<='$expiry'";
$result10 = mysqli_query($dbconnect, $sql10);
$row10 = mysqli_fetch_assoc($result10);
$exiprytotal= $row10["exiprytotal"];
?>
		<?php
		$date=date('Y-m-d');
		$getcontacts = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_registry where `visit_date`='$date'");
		$gc = mysqli_fetch_array($getcontacts);
		$g_allpatientscount = $gc['c'];
		
		$getmessages = mysqli_query($dbconnect,"SELECT count(*) as m FROM tbl_inpatient where `inpatient_status`='ADMITTED'");
		$gm = mysqli_fetch_array($getmessages);
		$g_m = $gm['m'];
		
		$getsent = mysqli_query($dbconnect,"SELECT count(*) as s FROM messagein");
		$gs = mysqli_fetch_array($getsent);
		$g_s = $gs['s'];
		
		$all = $g_allpatientscount-$g_m;
		
			$sql20 = "SELECT SUM(bill_amount*bill_qty) as totalrevenue FROM tbl_billing";
			$result20 = mysqli_query($dbconnect, $sql20);
			$row20 = mysqli_fetch_assoc($result20);
			$totalrev= $row20["totalrevenue"];
		//IP patients served	
			$sql21 = "SELECT COUNT(DISTINCT (prescription_opno)) as servediprow FROM tbl_prescriptions WHERE prescription_patientcategory='INPATIENT' AND `prescription_requesttime`='$date' AND prescription_status='CLOSED'";
			$result21 = mysqli_query($dbconnect, $sql21);
			$row21 = mysqli_fetch_assoc($result21);
			$servedip= $row21["servediprow"];
		//IP revenue served	
			$sql23 = "SELECT SUM(prescription_price*prescription_quantity) as servedipamount FROM tbl_prescriptions WHERE prescription_patientcategory='INPATIENT' AND `prescription_requesttime`='$date' AND prescription_status='CLOSED'";
			$result23 = mysqli_query($dbconnect, $sql23);
			$row23 = mysqli_fetch_assoc($result23);
			$servedipamount= $row23["servedipamount"];
			
			
		//OP patients served	
			$sql22 = "SELECT COUNT(DISTINCT (prescription_opno)) as servedoprow FROM tbl_prescriptions WHERE prescription_patientcategory='OUTPATIENT' AND `prescription_requesttime`='$date' AND prescription_status='CLOSED'";
			$result22 = mysqli_query($dbconnect, $sql22);
			$row22 = mysqli_fetch_assoc($result22);
			$servedop= $row22["servedoprow"];
		//OP revenue served	
			$sql24 = "SELECT SUM(prescription_price*prescription_quantity) as servedopamount FROM tbl_prescriptions WHERE prescription_patientcategory='OUTPATIENT' AND `prescription_requesttime`='$date' AND prescription_status='CLOSED'";
			$result24 = mysqli_query($dbconnect, $sql24);
			$row24 = mysqli_fetch_assoc($result24);
			$servedopamount= $row24["servedopamount"];
			$totalpharmacyamount=($total+$servedipamount+$servedopamount);
		?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo "$campaigner_name - $smart_name"; ?></title>
    <?php include 'includes/meta.php' ;?>
	
	<script src="https://cdn.jsdelivr.net/npm/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
	<script>
		function showexpiry(str){
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","datasummary.php?page="+str,true);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
		</script>
		<script type="text/javascript">

       function printDiv(divName) {
           var printContents = document.getElementById(divName).innerHTML;
           var originalContents = document.body.innerHTML;

           document.body.innerHTML = printContents;

           window.print();

           document.body.innerHTML = originalContents;
       }
       //function hideDiv() {
       //    if (document.getElementById) {
       //        document.getElementById('printableArea').style.display = 'none';
       //    }
       //}
       //function showDiv() {
       //    if (document.getElementById) {
       //        document.getElementById('printableArea').style.visibility = 'visible';
       //    }
       //}

		</script>
		<script>
			  function exportToExcel() {
				// Get the data from the table
				var table = document.querySelector('#pri table');
				var data = [];
				var headers = [];
				for (var i = 0; i < table.rows.length; i++) {
				  var row = table.rows[i];
				  var rowData = [];
				  for (var j = 0; j < row.cells.length; j++) {
					if (i === 0) {
					  headers.push(row.cells[j].innerText);
					}
					rowData.push(row.cells[j].innerText);
				  }
				  data.push(rowData);
				}
				// Create a new Excel file
				var wb = XLSX.utils.book_new();
				var ws = XLSX.utils.aoa_to_sheet([headers].concat(data));
				XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

				// Prompt the user to download the Excel file
				var wbout = XLSX.write(wb, {bookType: 'xlsx', type: 'binary'});
				function s2ab(s) {
				  var buf = new ArrayBuffer(s.length);
				  var view = new Uint8Array(buf);
				  for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
				  return buf;
				}
				var blob = new Blob([s2ab(wbout)], {type:"application/octet-stream"});
				var url = URL.createObjectURL(blob);
				var link = document.createElement("a");
				link.href = url;
				link.download = "data.xlsx";
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			  }
		</script>

</head>
<body>
    <div id="wrapper">
			<?php include 'includes/sidebar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">        
			<?php include 'includes/top-nav.php'; ?>
        </div>
        <div class="wrapper wrapper-content">
        <div class="row">
		 <div class="col-lg-12">
				<p><h2> The <?php echo $smart_name; ?> System</h2></p>
		</div>
		</div>
		<div class="row">
                <div class="col-lg-3">
				  <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md"><?php if($total>0){ ?>
                            <i class="fa fa-clipboard fa-4x"></i>
                            <h1 class="m-xs"> <?php  echo number_format($totalpharmacyamount,2); ?>
                             </h1>
                            <h3 class="font-bold no-margins">
                           Pharmacy Revenue 
                            </h3> <?php } else{ ?> <i class="fa fa-clipboard fa-4x"></i><?php echo "<h3>
							<h1 class='m-xs'>No
                             </h1>
							Revenue made today</h3>"; }?>
                        </div>
                    </div>
                    <div class="widget blue-bg p-lg text-center">
                         <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table margin bottom">
                                                    <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Patients</th>
                                                        <th class="text-center">Revenue</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td> OTC DRUGS SOLD</td>
                                                        <td class="text-center"><span class="label label-primary"> 
														<?php if($salecount>0){ ?>
														<?php  echo $salecount; }?>
													</span></td>
													 <td class="text-center"><span class="label label-primary">Ksh. <?php if($total>0){
														echo number_format($total,2); }?></span></td>
                                                    </tr>
                                                     
													<tr>
                                                        <td> PHARMACY IP </td>
                                                        <td class="text-center"><span class="label label-primary"><?php echo $servedip ?></span></td>
														<td class="text-center"><span class="label label-primary">Ksh. <?php echo $servedipamount; ?></span></td>
                                                    </tr>
													<tr>
                                                        <td>PHARMACY OP </td>
                                                        <td class="text-center"><span class="label label-primary"><?php echo $servedop ?></span></td>
														<td class="text-center"><span class="label label-primary">Ksh. <?php echo $servedopamount; ?></span></td>
                                                    </tr>
													<tr>
                                                        <td>DRUGS DUE EXPIRY
                                                        </td>
														<td>
                                                        </td>
                                                        <td class="text-center"><span class="label label-warning"> <?php if($exiprytotal>0){   echo $exiprytotal; }?></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                    </div>
                </div>
                  <div class="col-lg-3">
				  <div class="widget  lazur-bg p-lg text-center">
                        <div class="m-b-md">
                        <?php if($g_allpatientscount>0){ ?>
                            <i class="fa fa-clipboard fa-4x" style="cursor: pointer;" onclick="showexpiry('sold')" ></i>
                            <h1 class="m-xs"> <?php echo $g_allpatientscount;?>; ?>
                             </h1>
                            <h3 class="font-bold no-margins">
                            Patients 
                            </h3> <?php }else{ ?> <i class="fa fa-clipboard fa-4x" style=""></i><?php echo "<h1 class='m-xs'>No
                             </h1><h3> Patients </h3>"; }?>
                        </div>
                    </div>
                    <div class="widget blue-bg p-lg text-center">
                         <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table margin bottom">
                                                    <thead>
                                                    <tr>
                                                        <th>OP Item</th>
                                                        <th>Patients</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
													$getbills = mysqli_query($dbconnect, "SELECT p.pscheme_name, p. pscheme_code, count(DISTINCT bill_opno) AS numberofpatients, SUM(bill_amount*bill_qty) AS schemeamountonaday FROM tbl_billing b INNER JOIN tbl_paymentschemes p ON b.bill_paymentscheme=p.pscheme_code WHERE b.bill_patientcategory='OUTPATIENT' GROUP BY b.bill_paymentscheme ORDER BY b.bill_paymentscheme");
												while($billarray = mysqli_fetch_array($getbills)){
													$schemeamountonaday = $billarray['schemeamountonaday'];
													$pscheme_name = $billarray['pscheme_name'];
													$numberofpatients = $billarray['numberofpatients'];
                                                    echo "<tr>";
                                                        echo "<td> $pscheme_name </td>";
                                                        echo "<td> $numberofpatients </td>";
                                                        echo "<td><span class='label label-primary'>Ksh.";
														echo number_format($schemeamountonaday,2);
														echo"</span></td>";
                                                        
                                                    echo "</tr>";
												}
												?>
													
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                    </div>
                </div>
				    <div class="col-lg-3">
					 <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                           <?php if($g_m>0){ ?>
                            <i class="fa fa-clipboard fa-4x" style=""></i>
                            <h1 class="m-xs"> <?php  echo $g_m; ?> 
                             </h1>
                            <h3 class="font-bold no-margins">
                                Inpatient
                            </h3> <?php }else{ ?> <i class="fa fa-clipboard fa-4x" style=""></i><?php echo "<h1 class='m-xs'>No
                             </h1><h3>Due for expiry</h3>"; }?>                        
                        </div>
                    </div>
                    <div class="widget blue-bg p-lg text-center">
                         <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table margin bottom">
                                                    <thead>
                                                    <tr>
                                                        <th>IP Item</th>
                                                        <th>Patients</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
													$getbillsip = mysqli_query($dbconnect, "SELECT p.pscheme_name, p. pscheme_code, count(DISTINCT bill_opno) AS numberofpatientsip, SUM(bill_amount*bill_qty) AS schemeamountonadayip FROM tbl_billing b INNER JOIN tbl_paymentschemes p ON b.bill_paymentscheme=p.pscheme_code WHERE b.bill_patientcategory='INPATIENT' GROUP BY b.bill_paymentscheme ORDER BY b.bill_paymentscheme");
												while($billarrayip = mysqli_fetch_array($getbillsip)){
													$schemeamountonadayip = $billarrayip['schemeamountonadayip'];
													$pscheme_name = $billarrayip['pscheme_name'];
													$numberofpatientsip = $billarrayip['numberofpatientsip'];
                                                    echo "<tr>";
                                                        echo "<td> $pscheme_name </td>";
                                                        echo "<td> $numberofpatientsip </td>";
                                                        echo "<td><span class='label label-primary'>Ksh.";
														echo number_format($schemeamountonadayip,2);
														echo"</span></td>";
                                                        
                                                    echo "</tr>";
												}
												?>
													
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                    </div>
                </div>
							<?php
													$getbillsrevenuehosp = mysqli_query($dbconnect, "SELECT SUM(bill_amount*bill_qty) AS hosprevenue FROM tbl_billing");
													$billarrayh = mysqli_fetch_assoc($getbillsrevenuehosp);
													$hosprevenue = $billarrayh['hosprevenue'];
								?>
				 <div class="col-lg-3">
				 <div class="widget lazur-bg p-lg text-center">
						<div class="m-b-md">
                        <?php if($hosprevenue>0){ ?>
                            <i class="fa fa-clipboard fa-4x" style="cursor: pointer;" onclick="showexpiry('inventory')"></i>
                            <h1 class="m-xs"> <?php  echo number_format($hosprevenue,2); ?>
                             </h1>
                            <h3 class="font-bold no-margins">
                                Hospital Revenue
                            </h3> <?php } else{ ?> <i class="fa fa-clipboard fa-4x" style="cursor: pointer;" onclick="showexpiry('inventory')"></i><?php echo "<h1 class='m-xs'>No
                             </h1><h3>Item in the Inventory</h3>"; }?>                        

						</div>
					</div>
                    <div class="widget blue-bg p-lg text-center">
                         <div class="row">
                                            
                         </div>
                    </div>
                </div>
              
               
        </div>
    				<div class="col-lg-12" id="livesearch">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <i class="fa fa-info"></i> About this system
                                        </div>
                                        <div class="panel-body">
                                            <p>
											<ul>
												<li>Allow patient registration</li>
												<li>Monitor reports</li>
												<li>Keep history of data</li>
											</ul>
											</p>
                                        </div>
                                    </div>
					</div>	
					
					
					
                </div>
        
				<?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Mainly scripts -->
	<?php include 'includes/footer-scripts.php'; ?>
	 
</body>
</html>
