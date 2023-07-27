<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
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
			elseif($current_processstage=='BILLING'){
				$page='billing.php';
			}
			elseif($current_processstage=='TREATMENTROOM'){
				$page='treatmentroom.php';
			}
			elseif($current_processstage=='INPATIENT'){
				$page='inpatient.php';
			}
			else{
				echo 'Error Occurrred';
			}
						
		?>
                 <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header">											
                                            <button type="button" class="pull-right btn btn-primary" onclick="history.back()"><i class="fa fa-arrow-left"></i> Go Back</button>
                                            <h4 class="modal-title">Lab Requests</h4>
                                            <small class="font-bold">Make Lab Requests</small>
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
														$labservicecode = $dbconnect->real_escape_string($_POST['labservicecode']);
														$requestnote = $dbconnect->real_escape_string($_POST['requestnote']);
														$labrequest_status = 'OPEN';
														
														$opno1=$opno;
														$visitno1=$visitno;
														
														$checkL = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests WHERE labrequest_opno='$opno' AND labrequest_visitno='$visitno' AND labrequest_labservicecode='$labservicecode' AND labrequest_status='OPEN'");
														$countL = mysqli_num_rows($checkL);
														if($countL>=1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems there is a similar lab request pending for the patient </div>";
														}
														else{
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_labrequests (labrequest_opno, labrequest_visitno,labrequest_labservicecode,	labservice_note,labrequest_status) VALUES (?,?,?,?,?)")){
																	$stmt->bind_param('sssss',$opno1, $visitno1,$labservicecode,$requestnote,$labrequest_status);
																	$stmt->execute();
													//Checking and updating the bill				
																$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='$labservicecode'");
																		$countc = mysqli_num_rows($checkC);
																		if($countc>= 1){
																			
																		}
																	else {
																		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM  tbl_labservices WHERE labservice_code='$labservicecode'");
																		$gcn = mysqli_fetch_array($getcountyname);
																			$labservice_code = $gcn['labservice_code'];
																			$labservice_name = $gcn['labservice_name'];
																			$labservice_cost = $gcn['labservice_cost'];
																			$category = 'LABORATORY';
																			$status = 'INITIATED';
																			
																		$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
																		VALUES ('$labservice_name', '$labservice_cost','$opno', '$visitno','$scheme_code','$status','$category','$labservice_code')";
																			if($dbconnect->query($sqlbill) === TRUE) {
																				echo "Processing...";
																			}
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
													</br>
													<div class="row">
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>Lab Service</label>
															<select name="labservicecode" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_labservices");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$labservice_code = $gal['labservice_code'];
																	$labservice_name = $gal['labservice_name'];
																	$labservice_cost = $gal['labservice_cost'];
																	?>
																	<option value="<?php echo $labservice_code; ?>" ><?php echo $labservice_name; ?> | KES. <?php echo $labservice_cost; ?> </option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>									
														<div class="col-sm-6">
															<div class="form-group">
																<label>Request Note</label>
																<textarea name="requestnote" class="form-control" placeholder="Enter lab request note" rows="1"></textarea>
															</div>
														</div>
													</div>
													<div class="row">									
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btn_labrequest" class="btn btn-md btn-success" type="submit" value="Make Lab Request"/>
															</div>
														</div>
													</div>
													</br>
													<div class="row">
												<h3><b>Current pending Requests</b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests q INNER JOIN tbl_labservices v ON q.labrequest_labservicecode=v.labservice_code WHERE q.labrequest_opno='$opno' AND q.labrequest_visitno='$visitno'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$labrequest_id = $vitalarray['labrequest_id'];
															$labservice_signcode = $vitalarray['labrequest_labservicecode'];
															$labservice_name = $vitalarray['labservice_name'];
															$labservice_cost = $vitalarray['labservice_cost'];
															$labservice_note = $vitalarray['labservice_note'];
															$labrequest_status = $vitalarray['labrequest_status'];
														?>
														<?php echo $No; ?>.
														<?php echo $labservice_name; ?> (<?php echo $labservice_note; ?>) - <?php echo $labservice_cost; ?>/= 
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_labrequests WHERE labrequest_id='$deleted'");
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
														if($labrequest_status=='OPEN'){	
															?>
														<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $labrequest_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
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
