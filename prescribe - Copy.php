<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <title>Prescribe - <?php echo $smart_name; ?></title>
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
        <div class="wrapper wrapper-content">
		<?php
			$visitno=$_GET['visitno'];
			$opno=$_GET['opno'];
			$current_processstage=$_GET['current_processstage'];
			$c_id=$_GET['c_id'];
			$todaydate = date('Y-m-d');
			
			$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes s ON r.scheme_code=s.pscheme_code INNER JOIN tbl_paymentschemes ps ON ps.pscheme_code=r.scheme_code WHERE r.reg_no='$c_id'");
			$pdetails = mysqli_fetch_assoc($checkdetails);
			$id_no = $pdetails['id_no'];
			$fnames = $pdetails['f_name'];
			$lnames = $pdetails['l_name'];
			$gender = $pdetails['gender'];
			$dob = $pdetails['dob'];
			$scheme_code = $pdetails['scheme_code'];
			$pscheme_name = $pdetails['pscheme_name'];
			$limitamount = $pdetails['pscheme_oplimit'];
			
			//patient category
			//check inpatient if there an status open/discharded then inpatient is admitted
			$confirminpatient = mysqli_query($dbconnect, "SELECT * FROM  tbl_inpatient WHERE inpatient_opno='$opno' AND inpatient_visitno='$visitno' AND inpatient_status='ADMITTED'");
			$confirminpatientarray = mysqli_num_rows($confirminpatient);
			if($confirminpatientarray>0){
				$patientcategory='INPATIENT';
			}else{
				$patientcategory='OUTPATIENT';
			}
			//end of checking category

			
			
			if($current_processstage=='REGISTRY'){
				$page='registry.php';
			}
			elseif($current_processstage=='TRIAGE'){
				$page='triage.php';
			}
			elseif($current_processstage=='CONSULTATION'){
				$page='consultations.php';
			}
			elseif($current_processstage=='LABORATORY'){
				$page='laboratory.php';
			}
			elseif($current_processstage=='PHARMACY'){
				$page='pharmacy.php';
			}
			elseif($current_processstage=='BILLING'){
				$page='billing.php';
			}
			elseif($current_processstage=='TREATMENTROOM'){
				$page='treatmentroom.php';
			}
			elseif($current_processstage=='INPATIENT'){
				$page='inpatient.php';
			}
			elseif($current_processstage=='MATERNITY'){
				$page='maternity.php';
			}
			else{
				echo 'Error Occurrred';
			}
						
		?>
                                <div class="modal-content">
										<div class="modal-header">											
                                            <a href='<?php echo $page; ?>'> <button type="button" class="pull-right btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</button></a>
                                            <h3 class="modal-title">Prescription</h3>
                                            <small class="font-bold">Make prescription for the patient - <?php echo $patientcategory; ?></small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
											<form role="form" method="post">	
												<div class="col-sm-12">													
												<?php
													$date1 = $dob;
													$date2 = $todaydate;
													$diff = date_diff(date_create($dob), date_create($todaydate));
													$agess = $diff->format('%y');
													if(isset($_POST['btnprescription'])){
														if(empty($_POST['inve_id'])){
															echo "Select drug on the list";
														}
														elseif(empty($_POST['dosage_quantity'])){
															echo "Enter quantity";
														}
														elseif(empty($_POST['dosage_instructions'])){
															echo "oops! You must provide the instructions ";
														}
														else{
														$dosage_quantity = $dbconnect->real_escape_string($_POST['dosage_quantity']);
														$dosage_instructions = $dbconnect->real_escape_string($_POST['dosage_instructions']);
														
														//$drug_code = $dbconnect->real_escape_string($_POST['drug_code']);
														$inve_id = $_POST['inve_id'];
														
														$prescription_status='OPEN';
														$prescription_referred=$dbconnect->real_escape_string($_POST['drug_storeimpact']);
														$prescription_requesttime=$todaydate;
														$prescription_requester=$sidno;
														
													$geoc =  mysqli_query($dbconnect, "SELECT * FROM  tbl_inventory WHERE inve_id='$inve_id'");
														$gallinv = mysqli_fetch_assoc($geoc);
														$drug_code = $gallinv['inve_drugcode'];
														$inve_qty = $gallinv['inve_qty'];
													
														
														$checkL = mysqli_query($dbconnect, "SELECT * FROM tbl_prescriptions WHERE prescription_opno='$opno' AND prescription_visitno='$visitno' AND prescription_productcode='$drug_code' AND prescription_status='OPEN'");
														$countL = mysqli_num_rows($checkL);
														if($countL>=1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems there is a similar request pending for the patient </div>";
														}
														else{
														//$getallloc =  mysqli_query($dbconnect, "SELECT * FROM  tbl_inventory v INNER JOIN tbl_drugs t on v.inve_drugcode=t.drugitem_code INNER JOIN tbl_drug_prices p ON t.drugitem_code=p.drug_code WHERE p.scheme='$scheme_code'");
														//$gall = mysqli_fetch_assoc($getallloc);
														//$inve_qty = $gall['inve_qty'];	
														
														
														
																	
														if($dosage_quantity>$inve_qty){
													echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! The quantity to requested is more than what is available in store </div>";
														}
														else{
													//Get Basic Drug Details
															//$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drugs d INNER JOIN tbl_drug_prices p ON d.drugitem_code=p.drug_code WHERE p.drug_code='$drug_code' AND p.scheme='$scheme_code'");															
															$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drug_prices p INNER JOIN tbl_drugs d ON d.drugitem_code=p.drug_code WHERE p.drug_code='$drug_code' AND p.scheme='$scheme_code'");
															$gcn = mysqli_fetch_array($getcountyname);
																//$drug_code = $gcn['drugitem_code'];
																$drug_name = $gcn['brand_name'];
																$drug_cost = $gcn['price'];
																$drug_scheme = $gcn['scheme'];
																
													///end of basic drug details
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_prescriptions (prescription_opno, prescription_visitno,prescription_productcode,prescription_quantity,prescription_dosagesummary,prescription_status,prescription_referred,prescription_price,prescription_scheme,prescription_deptcode,prescription_requesttime,prescription_by,prescription_invid,prescription_patientcategory) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssssssss',$opno, $visitno, $drug_code, $dosage_quantity,$dosage_instructions,$prescription_status,$prescription_referred,$drug_cost,$drug_scheme,$current_processstage,$prescription_requesttime,$prescription_requester,$inve_id,$patientcategory);
																	$stmt->execute();
													//Checking and updating the bill
																	$category = 'PHARMACY';
																	$status = 'INITIATED';
																	$bill_openclosed = 'OPEN';
															$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_openclosed,bill_patientcategory)
															VALUES ('$drug_name','$drug_cost','$opno','$visitno','$scheme_code','$status','$category','$drug_code','$bill_openclosed','$patientcategory')";
																if($dbconnect->query($sqlbill) === TRUE) {
																	echo "Processing...";
																}
													//End of the check and update		
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successful...</div>";
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																			</script>	
																	<?php
																}
																
															}
															// this curly ends the check	
														}
													}
												}
												?>
												<br />
												</div>												
												<!-- ididndini -->
											<div class="col-sm-12">													
												<div class="row">
													<div class="col-sm-8">
														<div class="col-sm-6">Patient Names: <strong><?php echo "$fnames $lnames"; ?></div>
														<div class="col-sm-6">OP No: <strong><?php echo $opno ?></strong></div>
														<div class="col-sm-6">Age: <strong><?php echo $agess ?> years</strong></div>
														<div class="col-sm-6">Scheme Name: <strong><span class="badge badge-success"><?php echo $pscheme_name ?> </span></strong></div>
													</div>
													<div class="col-sm-4">
														<div class="row widget style1 yellow-bg">
														<?php
														if($limitamount!=null){
															//Getting bill totals for the visitno
																$billTotal = mysqli_query($dbconnect,"SELECT SUM(bill_amount) AS billT FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno'");
																$pataTotal = mysqli_fetch_array($billTotal);
																$totalbill_now = $pataTotal['billT'];
															
															//Getting the difference
																$availablebalance=$limitamount-$totalbill_now;
																
														?>
															<div class="col-xs-4">
																<span> Current Bill </span>
																<h3 class="font-bold"><?php echo $totalbill_now; ?>/=</h3>
															</div>
															<div class="col-xs-4">
																<span> Scheme Limit</span>
																<h3 class="font-bold"><?php echo $limitamount; ?>/=</h3>
															</div>
															<div class="col-xs-4">
																<span> Available Balance </span>
																<h3 class="font-bold"><?php echo $availablebalance; ?>/=</h3>
															</div>
														<?php } ?>
															
														</div>
													</div>
												</div>
													<hr>
											<div class="row">
												<div class="col-sm-6"> 
													<div class="col-sm-12"> 
														<div class="form-group">
															<label>Drugs</label>
															<select name="inve_id" required class="form-control chosen-select" >
																	<option selected value="">Select from List </option>
																	<?php
																$getalllocations =  mysqli_query($dbconnect, "SELECT * FROM  tbl_inventory v INNER JOIN tbl_drugs t on v.inve_drugcode=t.drugitem_code INNER JOIN tbl_drug_prices p ON t.drugitem_code=p.drug_code WHERE p.scheme='$scheme_code' AND p.price>0 AND v.inve_qty>0");
																//$getalllocations = mysqli_query($dbconnect,"SELECT * FROM products p INNER JOIN inventory i on p.code=i.product_code");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$inve_id = $gal['inve_id'];
																	$product_code = $gal['inve_drugcode'];
																	$product_name = $gal['brand_name'];
																	$product_quantity = $gal['inve_qty'];
																	$inve_expirydate = $gal['inve_expirydate'];
																	?>
																	<option value="<?php echo $inve_id; ?>" ><?php echo $product_name; ?> |<?php echo $product_quantity; ?>  Units Available ( Expiry: <?php echo $inve_expirydate; ?> )</option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>
														<div class="col-sm-6"> 		
														<div class="form-group">
																<label>Quantity</label>
																<input type="number" name="dosage_quantity" value="" required placeholder="Enter the quantity" class="form-control">
															</div>
														</div>	
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>Drug Type</label>
															<select name="drug_storeimpact" required class="form-control" >
																	<option selected value="IN-STORE">IN-STORE</option>
																	<option value="NO-STOCK-EFFECT">NO-STOCK-EFFECT</option>
															</select>
														</div>	
														</div>
														<div class="col-sm-12">
															<label>Dosage Summary/Instructions</label>
															<div class="form-group">
																<textarea name="dosage_instructions" required class="form-control" placeholder="Enter Dosage Summary/Instructions" rows="4"></textarea>
															</div>
														</div>												
														<div class="col-sm-12">
															<div class="form-group">
																<input name="btnprescription" class="btn btn-md btn-success" type="submit" value="Submit Prescription"/>
															</div>
														</div>
												</div>
													<br>
											<div class="col-sm-6 well well-sm"> 
												<h3><b>Pending Prescription Requests</b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_prescriptions q INNER JOIN tbl_drugs v ON q.prescription_productcode=v.drugitem_code WHERE q.prescription_opno='$opno' AND q.prescription_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$prescription_id = $vitalarray['prescription_id'];
															$prescription_productcode = $vitalarray['prescription_productcode'];
															$name = $vitalarray['brand_name'];
															$retail_price = $vitalarray['prescription_price'];
															$prescription_quantity = $vitalarray['prescription_quantity'];
															$prescription_dosagesummary = $vitalarray['prescription_dosagesummary'];
															$prescription_status = $vitalarray['prescription_status'];
														?>
														<?php echo $No; ?>.<span class="badge badge-success"><?php echo $prescription_status; ?> </span>
														<?php echo $name; ?> - <?php echo $prescription_quantity; ?> (@<?php echo $retail_price; ?>/=) - <?php echo $prescription_dosagesummary; ?>) 
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_prescriptions WHERE prescription_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
																else {
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
															}		
													if($prescription_status=='OPEN'){	
															?>
													<a href="prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $prescription_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
														</br>
														<?php
															}	
														}
													?>
											</div>
									</div>
                            </div>
							</form>
                            </div>
                </div>
			<div class="modal-footer">
			</div>
		</div>
		
		
		
		
		
		<?php include 'includes/footer.php'?>
    </div>
    </div>

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
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });
    </script>
	<script>
        
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

    </script>
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
