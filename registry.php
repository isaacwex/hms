<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Registry - <?php echo $smart_name; ?></title>
	
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
		$current_processstage='REGISTRY';
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE visit_status='OPEN' ORDER BY reg_no DESC limit 50");
		$title='Newly Added Patients';
		?>
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Registry</h2>
				<ol class="breadcrumb">
					<li>
						<a href="registry.php">All</a>
					</li>                        
					<li class="active">
						<strong>Patients</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
						   <span><a href="add-registry.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> New Patient</span></button></a></span>
				</p>
				</div>
		</div>
        <div class="wrapper wrapper-content">
		<form method="POST">
			
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE r.id_no LIKE '%$searchtermv%' OR r.phone_no LIKE '%$searchtermv%' OR r.f_name LIKE '%$searchtermv%' OR r.l_name LIKE '%$searchtermv%' OR r.opno LIKE '%$searchtermv%'");
					
					$title='Search Results from the registry List';
					}
					?>
					</div>
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-7">
					<input type="text" name="searchterm" required placeholder="Search by Name/ID No./location/phone" class="form-control"/>
				</div>
				<div class="col-sm-3">
					<button name="new-search" class="btn btn-success" type="submit">Search!</button>
					<span><a href="registry.php"><button class="btn btn-success" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
				</div>									
					</div>
					</form>
						</br>
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                   
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>VisitDate</th>
							<th>OpNo</th>
							<th>Names</th>
							<th>IdNo.</th>
							<th>PhoneNo</th>
							<th>Gender</th>
							<th>DoB</th>
							<th>Scheme</th>
							<th>Requests</th>
							<th>Action </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gac = mysqli_fetch_array($getPatients)){
						$No=$No+1;
						$c_id = $gac['reg_no'];
						$fnames = $gac['f_name'];
						$lnames = $gac['l_name'];
						$id_number = $gac['id_no'];
						$phonenumber = $gac['phone_no'];
						$gender = $gac['gender'];
						$dob = $gac['dob'];
						$opno = $gac['opno'];
						$visitno = $gac['visit_no'];
						$reside = $gac['residence'];
						$scheme_code = $gac['scheme_code'];
						$pscheme_name = $gac['pscheme_name'];
						$pscheme_copayments = $gac['pscheme_copayments'];
						$visit_date = $gac['visit_date'];
						$visit_status = $gac['visit_status'];
						$memberno = $gac['memberno'];
						$todaydate = date('Y-m-d');
						
							$getmaxv= mysqli_query($dbconnect,"SELECT Max(visit_no) as visitnonext FROM tbl_visits WHERE visit_opno='$opno'");
							$asre = mysqli_fetch_array($getmaxv);
							$visitnoforupdate = $asre['visitnonext'];
							$visitnoforupdate = $visitnoforupdate+1;
						$current_visit_no = $visitnoforupdate;
					
					//Getting Visit No
					$getvisit = mysqli_query($dbconnect, "SELECT max(visit_no) as last_visit FROM  tbl_visits WHERE visit_opno='$opno'");
					$visitarray = mysqli_fetch_assoc($getvisit);
					$visit_noo = $visitarray['last_visit'];				
					$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_visits WHERE visit_opno='$opno' AND visit_no='$visit_noo'");					
						?>
						<?php "<tr class='gradeX'>"; ?>
							<td><?php echo $visit_date; ?></td>
							<td><?php echo $opno; ?> | <b><?php echo $visitno; ?></b> </td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td><span class="badge badge-success"><?php echo $pscheme_name; ?> <?php echo $memberno; ?> </span>
							<?php
							if($pscheme_copayments!=null){
								$getcop = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visit_noo' AND bill_servicename='COPAY'");
										$lrarrayy = mysqli_fetch_array($getcop);
											$bill_status = $lrarrayy['bill_status'];
											if($bill_status=='RECEIPTED'){
												?>
												<span class="badge badge-primary">Copay Paid</span>
												<?php
											}
											else{
												?>
												<span class="badge badge-warning">Copay Pending <a href='billing.php'>Pay</a></span>
												<?php
											}
							}
							?>
							</td>
							<td>
							<!---Requests --------->
							<?php
							//General Services
							if($visit_status=='OPEN'){
								$getseevic = mysqli_query($dbconnect,"SELECT DISTINCT sq_servicecategory FROM tbl_servicerequests WHERE sq_opno='$opno' AND sq_visitno='$visitno' AND sq_status='OPEN'");
								while($gccc = mysqli_fetch_array($getseevic)){
								$sq_servicecategory = $gccc['sq_servicecategory'];
								
								
								$getcontactss = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_servicerequests WHERE sq_opno='$opno' AND sq_visitno='$visitno' AND sq_status='OPEN' AND sq_servicecategory='$sq_servicecategory'");
								$gccc = mysqli_fetch_array($getcontactss);
								$g_alllabcountt = $gccc['c'];
								
								if($g_alllabcountt>=1){
								?>
								<b><small><a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Open"><?php echo $sq_servicecategory; ?><span class="badge badge-primary"><?php echo $g_alllabcountt; ?></span></a></small></b> </br>
								<?php
								}
							}								
							//Lab
								$getcontacts = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_labrequests WHERE labrequest_opno='$opno' AND labrequest_visitno='$visitno' AND labrequest_status='OPEN'");
								$gc = mysqli_fetch_array($getcontacts);
								$g_alllabcount = $gc['c'];
								if($g_alllabcount>=1){
								?>
								<b><small><a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Open">LAB<span class="badge badge-primary"><?php echo $g_alllabcount; ?></span></a></small></b> </br>
								<?php
								}								
							//treatment requests
								$checkL = mysqli_query($dbconnect, "SELECT count(*) as d FROM tbl_nursingstationrequests WHERE nursingstationrequest_opno='$opno' AND nursingstationrequest_visitno='$visitno' AND nursingstationrequest_status='OPEN'");
									$gcc = mysqli_fetch_array($checkL);
								$treatmentcount = $gcc['d'];
									if($treatmentcount>=1){
										?>
									<b><small><a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Treatment Requests">TREATMENT<span class="badge badge-primary"><?php echo $treatmentcount; ?></span></a></small></b>
									<?php
									}
							}
							//ANC							
							?>						
							</td>							
							<td>
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">									
									<?php		
									if($visit_status=='OPEN'){
									?>								
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
									</li>
									<?php
									}
									if($visit_status=='CLOSED'){
									?>
									<!--<li>
									<a href="registry.php?newvisit=<?php //echo $c_id; ?>"><button type="button" class="btn-xs btn-white" onclick="return confirm('Are you sure you want to create a new visit for <?php //echo "$fnames $lnames"; ?>? This should only be done when the patient is returning for some new visit. Be sure a bout your action.')" >Generate New Visit No</button></a>
									</li>--->
									<li class="divider"></li>
									<li>
									<a href="newvisit.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Generate Visit">Generate Visit Number </a>			
									</li>
									<?php
									}
									if($visit_status=='OPEN'){
									?>
									<li>
									<a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Clinic Request </a>			
									</li>
									<li>
									<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Lab Request </a>			
									</li>
									<li>
									<a href="treatmentrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Treatment Requests">Treatment Request</a>			
									</li>
									<li>
									<a href="#update<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Edit Patient</a>		
									<?php include('modals/edit-patient.php');?>
									</li>
									<li>
											<!--- 
											Closing Visit Logic
											- Check bills
											- close any pending queue position
											- Update Visits table to closed
											- Update the registry table
											--->
									<?php
															if(isset($_GET['closevisitid'])){
																$op = $_GET['op'];
																$vis = $_GET['vis'];
																$cvid = $_GET['closevisitid'];
																	$visitstatus='CLOSED';
																	$update_item = "UPDATE tbl_registry SET visit_status=? WHERE reg_no='$cvid'";
																		if($stmt = $dbconnect->prepare($update_item)) {
																			$stmt->bind_param('s',$visitstatus);
																			$stmt->execute();
																$queuestatusclose='0';
															$updateqStatus = "UPDATE tbl_queue SET queue_status=? WHERE queue_opno='$opno' AND queue_visitno='$visitno'";
																		$stmtp = $dbconnect->prepare($updateqStatus);
																		$stmtp->bind_param('s',$queuestatusclose);
																		$stmtp->execute();
																
																
															$update_visit = "UPDATE tbl_visits SET visit_status=? WHERE visit_opno='$op' AND visit_no='$vis'";
																		if($stmt1 = $dbconnect->prepare($update_visit)) {
																			$stmt1->bind_param('s',$visitstatus);
																			$stmt1->execute();	
																		}
															}
																
															?>
																<script>
																	alert('Successfully<?php echo "$dbconnect->error()";?>');
																	window.location = 'registry.php';
																</script>	
															<?php
														}
																
												
															?>
														<a href="registry.php?closevisitid=<?php echo $c_id; ?>&op=<?php echo $opno;?>&vis=<?php echo $visitno;?>><button type="button" class="btn-xs btn-white" onclick="return confirm('Closing the visit means that patients will start a new treatment process for subsequent activities. Continue?')" > Close Visit</button></a>
		
									</li>
									<li class="divider"></li>
									<li>
									<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=OUTPATIENT">View OP Lab Report</a>
									</li>
									<li>
									<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=INPATIENT">View IP Lab Report</a>
									</li>
									<li>
									<a target="_blank" href="viewprescriptionreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=INPATIENT">Prescription IP Report</a>
									</li>
									<li>
									<a target="_blank" href="viewprescriptionreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&pcategory=OUTPATIENT">Prescription OP Report</a>
									</li>
									<li>
									<a target="_blank" href="consultationreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Consultation Notes</a>
									</li>
									<?php
									}
									?>
									<li>
									<a href="visithistory.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Visits/Bills History</a>
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
