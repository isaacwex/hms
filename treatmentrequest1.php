<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
    <title>Treatment Requests - <?php echo $smart_name; ?></title>
	
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
			
			$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE reg_no='$c_id'");
			$pdetails = mysqli_fetch_assoc($checkdetails);
			$id_no = $pdetails['id_no'];
			$fnames = $pdetails['f_name'];
			$lnames = $pdetails['l_name'];
			$gender = $pdetails['gender'];
			$dob = $pdetails['dob'];
			$scheme_code = $pdetails['scheme_code'];
			
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
			elseif($current_processstage=='TREATMENTROOM'){
				$page='treatmentroom.php';
			}
			elseif($current_processstage=='BILLING'){
				$page='billing.php';
			}
			else{
				echo 'Error Occurrred';
			}
						
		?>
                  <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Treatment Requests</h4>
                                            <small class="font-bold">Make a request to the treatment room</small>
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
													
													if(isset($_POST['btn_treatmentrequest'])){
														
														$treatmentservicecode = $dbconnect->real_escape_string($_POST['treatmentservicecode']);
														$requestnote = $dbconnect->real_escape_string($_POST['requestnote']);
														$nursingstationrequest_status = 'OPEN';
													

													$checkL = mysqli_query($dbconnect, "SELECT * FROM tbl_nursingstationrequests WHERE nursingstationrequest_opno='$opno' AND nursingstationrequest_visitno='$visitno' AND nursingstationrequest_servicecode='$treatmentservicecode' AND nursingstationrequest_status='OPEN'");
														$countL = mysqli_num_rows($checkL);
														if($countL>=1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems there is a similar treatment request pending for the patient that has not been serviced </div>";
														}
														else{
													
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_nursingstationrequests (nursingstationrequest_opno, nursingstationrequest_visitno,nursingstationrequest_servicecode,nursingstationrequest_note,nursingstationrequest_status) VALUES (?,?,?,?,?)")){
																	$stmt->bind_param('sssss',$opno, $visitno,$treatmentservicecode,$requestnote,$nursingstationrequest_status);
																	$stmt->execute();
														//Checking and updating the bill				
																$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='$treatmentservicecode'");
																		$countc = mysqli_num_rows($checkC);
																		if($countc>= 1){
																			
																		}
																	else {
																		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM  tbl_nursingstationservices WHERE nursingstation_code='$treatmentservicecode'");
																		$gcn = mysqli_fetch_array($getcountyname);
																			$nursingstation_code = $gcn['nursingstation_code'];
																			$nursingstation_name = $gcn['nursingstation_name'];
																			$nursingstation_cost = $gcn['nursingstation_cost'];
																			$category = 'TREATMENTROOM';
																			$status = 'INITIATED';
																			
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																		VALUES ('$nursingstation_name', '$nursingstation_cost','$opno', '$visitno','$scheme_code','$status','$category','$nursingstation_code')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "Processing...";
																			}
																		}	
													//End of the check and update
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Request Successfully Created </div>";
																}
																else {
																	echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Failed... </div>";
																}
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
														<div class="col-sm-3"><strong><?php echo $opno ?></strong>
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
															<label>Treatment Service</label>
															<select required name="treatmentservicecode" class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_nursingstationservices");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$nursingstation_code = $gal['nursingstation_code'];
																	$nursingstation_name = $gal['nursingstation_name'];
																	$nursingstation_cost = $gal['nursingstation_cost'];
																	?>
																	<option value="<?php echo $nursingstation_code; ?>" ><?php echo $nursingstation_name; ?> | KES. <?php echo $nursingstation_cost; ?> </option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>									
														<div class="col-sm-6">
															<div class="form-group">
																<label>Request Note</label>
																<textarea name="requestnote" class="form-control" placeholder="Enter treatment request note" rows="1"></textarea>
															</div>
														</div>
													</div>
													<div class="row">									
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_treatmentrequest" class="btn btn-md btn-success" type="submit" value="Make Treatment Request"/>
															</div>
														</div>
													</div>
													</br>
													<div class="row">
												<h2><b>Pending Treatment Requests</b></h2>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_nursingstationrequests q INNER JOIN tbl_nursingstationservices v ON q.nursingstationrequest_servicecode=v.nursingstation_code WHERE q.nursingstationrequest_opno='$opno' AND q.nursingstationrequest_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$nursingstationrequest_id = $vitalarray['nursingstationrequest_id'];
															$nursingstationrequest_servicecode = $vitalarray['nursingstationrequest_servicecode'];
															$nursingstation_name = $vitalarray['nursingstation_name'];
															$nursingstation_cost = $vitalarray['nursingstation_cost'];
															$nursingstationrequest_note = $vitalarray['nursingstationrequest_note'];
															$nursingstationrequest_status = $vitalarray['nursingstationrequest_status'];
														?>
														<?php echo $No; ?>.
														<?php echo $nursingstation_name; ?> (<?php echo $nursingstationrequest_note; ?>) - <?php echo $nursingstation_cost; ?>/=
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_nursingstationrequests WHERE nursingstationrequest_id='$deleted'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
																else {
																
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
															}
														if($nursingstationrequest_status=='OPEN'){		
															?>
														<a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $nursingstationrequest_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
														
														</br>
														<?php
															}
														}
													?>
													
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
