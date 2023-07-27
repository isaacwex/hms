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

	
    <title>Lab Requests - <?php echo $smart_name; ?></title>
	
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
                                            <h4 class="modal-title">Lab Requests</h4>
                                            <small class="font-bold">Make Lab Requests - <?php echo $patientcategory; ?></small>
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
													
													if(isset($_POST['btn_labrequest'])){
														$labservicecode = $dbconnect->real_escape_string($_POST['servicecode']);
														$requestnote = $dbconnect->real_escape_string($_POST['requestnote']);
														$labrequest_status = 'OPEN';
														$opno1=$opno;
														$visitno1=$visitno;
														$sq_requesttime=date('Y/m/d');
														$sq_requester=$sidno;
											//Getting Service Details for Insertion	
														$servicedet =mysqli_query($dbconnect,"SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_schemecode='$scheme_code' AND s.ss_code='$labservicecode' LIMIT 1");
															$gcnn = mysqli_fetch_array($servicedet);
																$service_code = $gcnn['ss_code'];
																$sq_servicecategory = $gcnn['ss_category'];
																$service_name = $gcnn['ss_name'];
																$service_price = $gcnn['sp_price'];											
														
														
														
														$checkL = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests WHERE labrequest_opno='$opno' AND labrequest_visitno='$visitno' AND labrequest_labservicecode='$labservicecode' AND labrequest_status='OPEN'");
														$countL = mysqli_num_rows($checkL);
														if($countL>=1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems there is a similar lab request pending for the patient </div>";
														}
														else{
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_labrequests (labrequest_opno, labrequest_visitno,labrequest_labservicecode,	labservice_note,labrequest_status,labrequest_requesttime,labrequest_requester,labrequest_requestfrom,labrequest_price,labrequest_category) VALUES (?,?,?,?,?,?,?,?,?,?)")){
																	$stmt->bind_param('ssssssssss',$opno1, $visitno1,$labservicecode,$requestnote,$labrequest_status,$sq_requesttime,$sq_requester,$current_processstage,$service_price,$patientcategory);
																	$stmt->execute();
													//Checking and updating the bill				
																		$status = 'INITIATED';
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode,bill_patientcategory)
																		VALUES ('$service_name', '$service_price','$opno1', '$visitno1','$scheme_code','$status','$sq_servicecategory','$service_code','$patientcategory')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "Processing...";
																			}
													//End of the check and update				
																	//echo "Successfully created";
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Request Successfully Created </div>";
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		 window.location = 'index.php';
																			</script>	
																	<?php
																}
														}
													}
												?>
												<br />
												</div>
												
												<!-- ididndini -->												
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
																		<span> Scheme Limit </span>
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
													</br>
													<div class="row">
														<div class="col-md-6"> 
															<div class="col-md-12"> 
																<div class="form-group">
																<label>Lab Service</label>
																<select name="servicecode" required class="form-control chosen-select" >
																		<option selected value="">Select from List</option>
																		<?php
																	$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_services s INNER JOIN tbl_service_prices p ON s.ss_code=p.sp_code WHERE p.sp_schemecode='$scheme_code' AND s.ss_category='LABORATORY' AND p.sp_price>0");
																	while($gal = mysqli_fetch_array($getalllocations)){
																		$ss_code = $gal['ss_code'];
																		$ss_category = $gal['ss_category'];
																		$ss_name = $gal['ss_name'];
																		$ss_cost = $gal['sp_price'];
																		?>
																		<option value="<?php echo $ss_code; ?>" ><?php echo $ss_category; ?> | <?php echo $ss_name; ?> | KES. <?php echo $ss_cost; ?> </option>
																		<?php
																	}
																	?>
																	</select>
																</div>									
															</div>									
															<div class="col-md-12">
																<div class="form-group">
																	<label>Request Note</label>
																	<textarea name="requestnote" class="form-control" placeholder="Enter lab request note" rows="1"></textarea>
																</div>
															</div>
																							
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_labrequest" class="btn btn-md btn-success" type="submit" value="Make Lab Request"/>
															</div>
														</div>
													</div>
													</br>
								<div class="col-md-6 well well-sm">	
										<h3><b>Current pending Requests</b></h3><hr>
											<?php
												$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests q INNER JOIN tbl_services v ON q.labrequest_labservicecode=v.ss_code WHERE q.labrequest_opno='$opno' AND q.labrequest_visitno='$visitno'");
												$No=0;
												while($vitalarray = mysqli_fetch_array($getvitals)){
													$No=$No+1;
													$sq_id = $vitalarray['labrequest_id'];
													$ss_code = $vitalarray['ss_code'];
													$ss_name = $vitalarray['ss_name'];
													//$labservice_cost = $vitalarray['labservice_cost'];
													$sq_requestnote = $vitalarray['labservice_note'];
													$sq_status = $vitalarray['labrequest_status'];
												?>
												<b>
												<?php echo $No; ?>. <span class="badge badge-success"><?php echo $sq_status; ?> </span>
												<?php echo $ss_code; ?> <?php echo $ss_name; ?> (<?php echo $sq_requestnote; ?>) - 
												</b>
												<?php
													if(isset($_GET['delete'])){
														$deleted = $_GET['delete'];
														$action = mysqli_query($dbconnect,"DELETE FROM tbl_labrequests WHERE sq_id='$deleted'");
														if($action){
															
															//echo "Successfully Deleted from list"
															?>
															<script>
																alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																window.location ='labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
															</script>	
															<?php
														}
														else {
															?>
															<script>
																alert('Error deleting <?php echo "$dbconnect->error()";?>');
																	window.location ='labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
															</script>	
															<?php
														}
													}
												if($sq_status=='OPEN'){	
													?>
												<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $labrequest_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
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
