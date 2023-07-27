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

	
    <title>Add Vital Signs - <?php echo $smart_name; ?></title>
	
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
			elseif($current_processstage=='MATERNITY'){
				$page='maternity.php';
			}
			elseif($current_processstage=='INPATIENT'){
				$page='inpatient.php';
			}
			else{
				echo 'Error Occurrred';
			}
						
		?>
                                <div class="modal-content">
                                        <div class="modal-header">											
                                           <a href='<?php echo $page; ?>'> <button type="button" class="pull-right btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</button></a>
                                            <h4 class="modal-title">Vital Sign Recording</h4>
                                            <small class="font-bold">Create vital sign information</small>
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
													$vital_code='0';
													$vital_name='0';
													$vital_unit='0';
													if(isset($_POST['btn_addsign'])){
														if(empty($_POST['vital_code'])){
															echo "Select vale";
														}
														elseif(empty($_POST['vitalvalue'])){
															echo "Enter value";
														}
														else{
														$vital_code = $dbconnect->real_escape_string($_POST['vital_code']);
														$vital_value = $dbconnect->real_escape_string($_POST['vitalvalue']);
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_vitalsigns WHERE vitalsign_opno='$opno' AND vitalsign_visitno='$visitno' AND vitalsign_signcode='$vital_code'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('Oops! A similar record already exists...');
																			window.location ='add-vital.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																		</script>	
																	<?php
															}
														else {
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_vitalsigns (vitalsign_opno,vitalsign_visitno,vitalsign_signcode,vitalsign_value) VALUES (?,?,?,?)")){
																	$stmt->bind_param('ssss',$opno,$visitno,$vital_code,$vital_value);
																	$stmt->execute();
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Vital Successfully Added </div>";
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'triage.php';
																			</script>	
																	<?php
																	
																}
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
													<hr>
													<div class="row">
														<div class="col-md-6"> 
														
															<div class="col-sm-12"> 
															<div class="form-group">
															<label>SELECT VITAL SIGN</label>
															<select name="vital_code" class="form-control" >
																	<option selected value="">Select from list</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_vitals");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$vital_code = $gal['vital_code'];
																	$vital_name = $gal['vital_name'];
																	$vital_unit = $gal['vital_unit'];
																	?>
																	<option value="<?php echo $vital_code; ?>" ><?php echo $vital_name;?> (<?php echo $vital_unit;?> )</option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>												
														<div class="col-sm-12"> 
															<div class="form-group">
															<label>VALUE</label>
															<div class="form-group">
																<textarea id="vitalvalue" name="vitalvalue" rows="4" cols="70"></textarea>
															</div>
														</div>	
														</div>	
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_addsign" class="btn btn-md btn-success" type="submit" value="Add Sign"/>
															</div>
														</div>
														
													</div>
													</br>
								<div class="col-md-6 well well-sm">	
										<h3><b> Vital Signs Recorded</b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_vitalsigns q INNER JOIN tbl_vitals v ON q.vitalsign_signcode=v.vital_code WHERE q.vitalsign_opno='$opno' AND q.vitalsign_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$vitalsign_id = $vitalarray['vitalsign_id'];
															$vitalsign_signcode = $vitalarray['vitalsign_signcode'];
															$vitalsign_value = $vitalarray['vitalsign_value'];
															$vital_name = $vitalarray['vital_name'];
															$vital_unit = $vitalarray['vital_unit'];
														?>
														<?php echo $No; ?>.
														<?php echo $vital_name; ?>: <?php echo $vitalsign_value; ?><?php echo $vital_unit; ?>
														
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_vitalsigns WHERE vitalsign_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='add-vital.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
																else {
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='add-vital.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
															}
															?>
														<a href="add-vital.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $vitalsign_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
														</br>
														<?php
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
