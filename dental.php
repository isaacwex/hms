<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Dental Services - <?php echo $smart_name; ?></title>
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
			$current_processstage='DENTAL';
			$queuestatuscurrent='1';
			//$getPatientsConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_consultations r ON r.consultation_opno=q.queue_opno AND r.consultation_visitno=q.queue_visitno INNER JOIN tbl_registry p ON q.queue_visitno=p.visit_no AND q.queue_opno=p.opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$getPatientsConsultations =mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			
			
			$title='Patients Waiting';

		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Action functionality to navigate)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
					
						<thead>
						<tr>						
							<th>Names</th>
							<th>Details</th>
							<th>Pending Dental Requests  </th>
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
						<?php "<tr class='gradeX'>"; ?>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td>
								<?php echo $opno; ?> | <?php echo $visitno; ?><br>
							<?php echo "$gender";?>-<?php echo "$agess yrs";?><br>
							
							</td>
							
							<td>
							<?php
								$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_servicerequests q INNER JOIN tbl_services v ON q.sq_servicecode=v.ss_code WHERE q.sq_opno='$opno' AND q.sq_visitno='$visitno' AND q.sq_servicecategory='DENTAL'");
								//$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_servicerequests q INNER JOIN tbl_services v ON q.sq_servicecode=v.ss_code WHERE q.sq_opno='CHMC-OP-1269-23' AND q.sq_visitno='1' AND sq_servicecategory='DENTAL'");
									$No=0;
									while($vitalarray = mysqli_fetch_array($getvitals)){
										$No=$No+1;
										$sq_id = $vitalarray['sq_id'];
										$ss_code = $vitalarray['ss_code'];
										$ss_name = $vitalarray['ss_name'];
										//$labservice_cost = $vitalarray['labservice_cost'];
										$sq_requestnote = $vitalarray['sq_requestnote'];
										$sq_status = $vitalarray['sq_status'];
										$sq_servicecategory = $vitalarray['sq_servicecategory'];
									?>
									<?php echo $No; ?>. <span class="badge badge-success"><?php echo $sq_status; ?> </span>
									<?php echo $ss_code; ?> <?php echo $ss_name; ?> (<?php echo $sq_requestnote; ?>)
								
								<?php
									if(isset($_GET['closeservice'])){
										$sq_id = $_GET['closeservice'];
										$status='CLOSED';
								$update_item = "UPDATE tbl_servicerequests SET sq_status=? WHERE sq_id='$sq_id'";
										if($stmt = $dbconnect->prepare($update_item)) {
											$stmt->bind_param('s',$status);
											$stmt->execute();
											?>
												<script>
												 alert('Successful');
												window.location = 'dental.php';
												</script>	
											<?php
								
								}
							}
									if($sq_status=='OPEN'){
								?>
											<a href="dental.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&closeservice=<?php echo $sq_id;?>" data-toggle="modal" title=" Request results"><span class="badge badge-warning">Close Now <i class="fa fa-arrow-right"></i></span></a>
											</br>
											<?php
								}else{
										?>							
									<span class="badge badge-primary"><?php echo $sq_status; ?> </span>
									<?php
									}
								} ?>
							</td>
							<td>
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary" btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								
								<ul class="dropdown-menu pull-right">
							
									<li>
									<a href="servicerequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Clinic Request </a>			
									</li>
									<li class="divider"></li>
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
									</li>
									<li class="divider"></li>
									
									
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
