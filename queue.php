<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
    <title>Queue - <?php echo $smart_name; ?></title>
	
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
				<h2>Queue</h2>
				<ol class="breadcrumb">
					<li>
						<a href="">Queue</a>
					</li>                        
					<li class="active">
						<strong>Now</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
						   <span><button class="btn btn-primary" type="button" onclick="history.back()"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></span>
				</p>
				</div>
		</div>
        <div class="wrapper wrapper-content">
		
		<?php
			$visitno=$_GET['visitno'];
			$opno=$_GET['opno'];
			$current_processstage=$_GET['current_processstage'];
			$c_id=$_GET['c_id'];
			$todaydate = date('Y-m-d');
			
			//$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE reg_no='$c_id'");
			$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE r.reg_no='$c_id'");
			$pdetails = mysqli_fetch_assoc($checkdetails);
			$id_no = $pdetails['id_no'];
			$fnames = $pdetails['f_name'];
			$lnames = $pdetails['l_name'];
			$gender = $pdetails['gender'];
			$dob = $pdetails['dob'];
			$scheme_code = $pdetails['scheme_code'];
			$pscheme_copayments = $pdetails['pscheme_copayments'];
			$visit_status = $pdetails['visit_status'];
			
			
				$getcop = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicename='COPAY'");
				$lrarrayy = mysqli_fetch_array($getcop);
				$bill_status = $lrarrayy['bill_status'];
			
			
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
			elseif($current_processstage=='DENTAL'){
				$page='dental.php';
			}
			elseif($current_processstage=='PHYSIOTHERAPY'){
				$page='physiotherapy.php';
			}
			elseif($current_processstage=='RADIOLOGY'){
				$page='radiology.php';
			}
			else{
				echo 'Error Occurrred';
			}		
		?>
		
		<div class="inmodal" id="edit<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
		
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Queue Patient</h4>
                                            <small class="font-bold">Send the patient to the next process level</small>
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
													
												
													if(isset($_POST['btn_queue'])){
														
														if(empty($_POST['queueto'])){
															echo "Select place to";
														}
														elseif(empty($_POST['queuefrom'])){
															echo "Select from";
														}
														else{
															
															$queuefrom = $dbconnect->real_escape_string($_POST['queuefrom']);
															$queueto = $dbconnect->real_escape_string($_POST['queueto']);
															$queue_note = $dbconnect->real_escape_string($_POST['queue_note']);
															$queuestatus='1';
															$queuestatusclose='0';
												//Getting consultation requests
																$getconsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_servicerequests q INNER JOIN tbl_services v ON q.sq_servicecode=v.ss_code WHERE q.sq_opno='$opno' AND q.sq_visitno='$visitno' AND q.sq_servicecategory='CONSULTATION' AND q.sq_status='OPEN'");
																$conarray = mysqli_num_rows($getconsultations);		
															
												///start of checking copay	
															if($pscheme_copayments!=null AND $bill_status!='RECEIPTED'){
																echo "<div class=\"alert alert-warning alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Queue placement failed. Seems $fnames has some pending copay payments. Please pay at the billing office to proceed or <a href='$page'> Go Back</a>  </div>";
															}
															else if($queueto=='CONSULTATION' AND $conarray<1){
																echo "<div class=\"alert alert-warning alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Please create the consultation request before proceeding or <a href='$page'> Go Back</a>  </div>";
															}
															else{
													//end phrase of checking copay
												
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_queue WHERE queue_to='$queueto' AND queue_opno='$opno' AND queue_visitno='$visitno' AND queue_status='1'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo>= 1){
																echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems $fnames has already been queued at $queueto. <a href='$page'>Back</a>  </div>";
															}
														else {
																		
																	$sql = "INSERT INTO tbl_queue(queue_from,queue_to,queue_opno,queue_visitno,queue_note,queue_idno,queue_status)
																	VALUES ('$queuefrom', '$queueto','$opno', '$visitno','$queue_note','$id_no','$queuestatus')";
																	
														//start			
																/*
																if($queueto=='CONSULTATION'){
																
																$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='CONSULTATION'");
																$countc = mysqli_num_rows($checkC);
																if($countc>= 1){
																	
																}
																else {
																	
																	$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints p INNER JOIN tbl_consultation_mappings c ON p.process_uniquecode=c.conmap_servicecode WHERE p.process_status='1' AND p.process_code='CONSULTATION' AND c.conmap_schemecode='$scheme_code'");
																	$gcn = mysqli_fetch_array($getcountyname);
																		$process_code = $gcn['process_code'];
																		$process_servicename = $gcn['process_servicename'];
																		$process_servicecost = $gcn['conmap_price'];
																		$status = '1';
																		
																	$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																	VALUES ('$process_servicename', '$process_servicecost','$opno', '$visitno','$scheme_code','$status','$process_code','$process_code')";
																		if($dbconnect->query($sqlbill) === TRUE) {
																			echo "Processing...";
																		}
																		
																	}	
																}*/
																	
																	//code that was moved to new services style
																	/*if($queueto=='CONSULTATION'){
																		
																		$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='CONSULTATION'");
																		$countc = mysqli_num_rows($checkC);
																		if($countc>= 1){
																			
																		}
																	else {
																		
																		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints p INNER JOIN tbl_consultation_mappings c ON p.process_uniquecode=c.conmap_servicecode WHERE p.process_status='1' AND p.process_code='CONSULTATION' AND c.conmap_schemecode='$scheme_code'");
																		$gcn = mysqli_fetch_array($getcountyname);
																			$process_code = $gcn['process_code'];
																			$process_servicename = $gcn['process_servicename'];
																			$process_servicecost = $gcn['conmap_price'];
																			$status = '1';
																			
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																		VALUES ('$process_servicename', '$process_servicecost','$opno', '$visitno','$scheme_code','$status','$process_code','$process_code')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "Processing...";
																			}
																			
																		}	
																	}
																
																if($queueto=='TREATMENTROOM'){
																		
																		$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='TREATMENTROOM'");
																		$countc = mysqli_num_rows($checkC);
																		if($countc>= 1){
																			
																		}
																	else {
																		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints WHERE process_status='1' AND process_code='TREATMENTROOM'");
																		$gcn = mysqli_fetch_array($getcountyname);
																			$process_code = $gcn['process_code'];
																			$process_servicename = $gcn['process_servicename'];
																			$process_servicecost = $gcn['process_servicecost'];
																			$status = '1';
																			
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																		VALUES ('$process_servicename', '$process_servicecost','$opno', '$visitno','$scheme_code','$status','$process_code','$process_code')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "Processing...";
																			}
																		}	
																	}
																
																*/
																	
																	//end
																	if($dbconnect->query($sql) === TRUE) {
																		$updateStatus = "UPDATE tbl_queue SET queue_status=? WHERE queue_opno='$opno' AND queue_visitno='$visitno' AND queue_to='$current_processstage'";
																		$stmtp = $dbconnect->prepare($updateStatus);
																		$stmtp->bind_param('s',$queuestatusclose);
																		$stmtp->execute();
																		
																		echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> $fnames successfully queued at $queueto. </div>";
																		echo '<META HTTP-EQUIV="Refresh" Content="0; URL="$page">';
																																		
																	} else {
																		echo "Oops! Failed. Something bad happened. Error: " . $sql . "<br>" . $conn->error;
																	}

																	//$conn->close();	
															
													}
												
												}//finishing copay restrictions	
												
											}
										}
													
												?>
												<br />
												</div>
												
												<!-- ididndini -->
												<div class="col-sm-12">													
													<div class="row">
														<div class="col-sm-3">Patient Names:
														</div>												
														<div class="col-sm-4"> <strong><?php echo "$fnames $lnames"; ?></strong>
														</div>												
														<div class="col-sm-2">OP No:
														</div>												
														<div class="col-sm-3"><strong>
														<input type="text" name="queue1_opno" disabled value="<?php echo $opno ?>" class="form-control">
														<input type="text" name="queue1_visitno" disabled value="<?php echo $visitno ?>" class="form-control">
														</strong>
														</div>
													</div>												
													<div class="row">
														<div class="col-sm-3">Age:
														</div>												
														<div class="col-sm-4"> <strong><?php echo $agess ?> years</strong>
														</div>												
														<div class="col-sm-2">
														</div>												
														<div class="col-sm-3">
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>FROM</label>
															<select required name="queuefrom" class="form-control" >
																	<option selected value="<?php echo $current_processstage;?>"><?php echo $current_processstage;?></option>
																	<?php
																/*$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$process_code = $gal['process_code'];
																	$process_name = $gal['process_name'];
																	?>
																	<option value="<?php echo $process_code; ?>" ><?php echo $process_name; ?></option>
																	<?php
																}*/
																?>
															</select>
														</div>	
														</div>												
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>TO</label>
															<select required name="queueto" class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_processpoints");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$process_code = $gal['process_code'];
																	$process_name = $gal['process_name'];
																	?>
																	<option value="<?php echo $process_code; ?>" ><?php echo $process_name; ?></option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>	
													</div>
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group">
																<label>Queue Note</label>
																<input type="text" name="queue_note" value="" placeholder="Enter note (Optional)" class="form-control">
															</div>
														</div>
														<?php
															if($visit_status=='CLOSED'){
															?>
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_queue" class="btn btn-md btn-success" disabled type="submit" value="Queue Patient"/>
															</div>
														</div>
															<?php } else { ?>
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_queue" class="btn btn-md btn-success" type="submit" value="Queue Patient"/>
															</div>
														</div>
															<?php } ?>

													</div>
                            </div>
							</form>
                            </div>
                </div>
			<div class="modal-footer">
			</div>
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
