<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Inpatient - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
			$current_processstage='INPATIENT';
			$queuestatuscurrent='1';
			//$getPatientsConsultations =mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$getPatientsConsultations =mysqli_query($dbconnect, "SELECT * FROM tbl_inpatient q INNER JOIN tbl_registry p ON q.inpatient_opno=p.opno AND q.inpatient_visitno=p.visit_no WHERE q.inpatient_status='ADMITTED'");
			$title='Patients for Inpatient';
		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for Inpatient results)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>						
							<th>Full Names</th>
							<th>Details</th>
							<th>Inpatient Notes</th>
							<th>Ward</th>
							<th>Date of Admission</th>
							<th>Prescriptions</th>
							<th>Lab Requests </th>
							<th>Treatment Requests </th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						
						while($gacC = mysqli_fetch_array($getPatientsConsultations)){
						$No=$No+1;
						$c_id = $gacC['reg_no'];
						$fnames = $gacC['f_name'];
						$lnames = $gacC['l_name'];
						$id_number = $gacC['id_no'];
						$phonenumber = $gacC['phone_no'];
						$gender = $gacC['gender'];
						$dob = $gacC['dob'];
						$opno = $gacC['opno'];
						$visitno = $gacC['visit_no'];
						$reside = $gacC['residence'];
						$visit_date = $gacC['visit_date'];
						$todaydate = date('Y-m-d');
						
						$date1 = $dob;
						$date2 = $todaydate;
						$diff = date_diff(date_create($dob), date_create($todaydate));
						$agess = $diff->format('%y');
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td>
								<?php echo $opno; ?> | <?php echo $visitno; ?><br>
							<?php echo "$gender";?> (<?php echo "$agess years";?>)
							
							</td>
							
							<td>
							<?php
										$getconsultations = mysqli_query($dbconnect, "SELECT * FROM  tbl_inpatient WHERE inpatient_opno='$opno' AND inpatient_visitno='$visitno'");
												$consultationarray = mysqli_fetch_assoc($getconsultations);
												$consultation_complaints1 = $consultationarray['inpatient_nursingnotes'];
												$inpatient_wardname = $consultationarray['inpatient_wardname'];
												$inpatient_bedno = $consultationarray['inpatient_bedno'];
												$inpatient_timestamp = $consultationarray['inpatient_timestamp'];
												$inpatient_status = $consultationarray['inpatient_status'];
												echo $consultation_complaints1;  
											 ?>	
							</td>
							<td>
							<?php if($inpatient_status=='DISCHARGED'){ ?>
							<p><span class="badge badge-primary"><?php echo $inpatient_status; ?></span></p> 
							<?php
							}
							else{
								?>
							<p><span class="badge badge-warning"><?php echo $inpatient_status; ?></span></p> 
							
							<?php 
							}
							echo $inpatient_wardname; ?> (Bed: <?php echo $inpatient_bedno;?>)
							</td>
							<td> <?php echo $inpatient_timestamp; ?> </td>
							<td>
								<?php
								
								$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN tbl_drugs t on p.prescription_productcode=t.drugitem_code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
									//$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN products t on p.prescription_productcode=t.code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
									//$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_inventory v INNER JOIN tbl_drugs t on v.inve_drugcode=t.drugitem_code WHERE v.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
										//$No=1;
										while($prescriptionarray = mysqli_fetch_array($getprescriptions)){
											//$No=$No+1;
											$drug = $prescriptionarray['brand_name'];
											$quantity = $prescriptionarray['prescription_quantity'];
											$dosagesummary = $prescriptionarray['prescription_dosagesummary'];
											?>
											 
											<b>*</b> <?php echo $drug; ?> | <?php echo $quantity; ?> | <?php echo $dosagesummary; ?></br>
											<?php
											}
										?>
							</br>
							</td>
							<td>
								<?php
								$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests q INNER JOIN tbl_services v ON q.labrequest_labservicecode=v.ss_code WHERE q.labrequest_opno='$opno' AND q.labrequest_visitno='$visitno'");
												$No=0;
												while($vitalarray = mysqli_fetch_array($getvitals)){
													$No=$No+1;
													$labrequest_id = $vitalarray['labrequest_id'];
													$ss_code = $vitalarray['ss_code'];
													$ss_name = $vitalarray['ss_name'];
													//$labservice_cost = $vitalarray['labservice_cost'];
													$sq_status = $vitalarray['labrequest_status'];
													$labrequest_componentsample = $vitalarray['labrequest_componentsample'];
													$labrequest_results = $vitalarray['labrequest_results'];
													$labrequest_conclusion = $vitalarray['labrequest_conclusion'];
												?>	
											 * <?php echo $ss_name; ?> - <?php echo $labrequest_componentsample; ?> - <?php echo $labrequest_results; ?> - <?php echo $labrequest_conclusion; ?>
										<?php } ?>
							
							</td>
							<td>
								<?php
												$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_nursingstationrequests q INNER JOIN tbl_services v ON q.nursingstationrequest_servicecode=v.ss_code WHERE q.nursingstationrequest_opno='$opno' AND q.nursingstationrequest_visitno='$visitno'");
												$No=0;
												while($vitalarray = mysqli_fetch_array($getvitals)){
													$No=$No+1;
													$sq_id = $vitalarray['nursingstationrequest_id'];
													$ss_code = $vitalarray['ss_code'];
													$ss_name = $vitalarray['ss_name'];
													//$labservice_cost = $vitalarray['labservice_cost'];
													$sq_requestnote = $vitalarray['nursingstationrequest_note'];
													$sq_status = $vitalarray['nursingstationrequest_status'];
												?>
												* <span class="badge badge-success"><?php echo $sq_status; ?> </span>
												<?php echo $ss_code; ?> <?php echo $ss_name; ?> (<?php echo $sq_requestnote; ?>) - 
												<?php
									}
								?>
							</br>
							</td>
							<td>
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary success" btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
									<a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Clinic Request </a>			
									</li>
									<li>
									<a href="prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Prescribe </a>			
									</li>
									<li>
									<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Lab Request </a>			
									</li>
									<li>
									<a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Treatment Requests">Treatment Request</a>			
									</li>
									
									<?php if($inpatient_status=='ADMITTED'){ ?>
									<li>
									<a href="discharge.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Treatment Requests">Discharge</a>
									</li>
									<?php } ?>
									
									<li>
									<!--<a href="#refer<?php //echo $c_id;?>" data-toggle="modal" title="Edit Contact">Refer Patient</a>-->		
									<?php //include('modals/refer.php');?>
									</li>
									<li class="divider"></li>
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
									</li>
									<li class="divider"></li>
									<li>
									<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Lab Report</a>
									</li>
									
								</ul>
							</div>
							</td>
						</tr>
						<?php
						}
						?>
						</tbody>
						</table>
                </div>
            </div>
            </div>
        </div>
		</form>
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
