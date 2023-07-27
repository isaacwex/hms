<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Triage - <?php echo $smart_name; ?></title>
	
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
			$current_processstage='TRIAGE';
			$queuestatuscurrent='1';
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$title='Patients for Triage';
		?>
					</form>
						</br>
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for triage results)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>OP No</th>
							<th>Visit No</th>
							<th>Full Names</th>
							<th>ID/Insurance No</th>
							<th>Phone Number</th>
							<th>Gender</th>
							<th>DoB</th>
							<th>Triage Results</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts C INNER JOIN tbl_locations k ON C.county=k.location_id OR C.subcounty=k.location_id OR C.sublocation=k.location_id OR C.location=k.location_id OR C.pstation=k.location_id");
						
						
						//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts LIMIT 50");
						
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
						$visit_date = $gac['visit_date'];
						$todaydate = date('Y-m-d');
												
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo $visitno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td>
							
								<?php
									$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_vitalsigns q INNER JOIN tbl_vitals v ON q.vitalsign_signcode=v.vital_code WHERE q.vitalsign_opno='$opno' AND q.vitalsign_visitno='$visitno'");
									
									while($vitalarray = mysqli_fetch_array($getvitals)){
									//$No=$No+1;
									$vitalsign_signcode = $vitalarray['vitalsign_signcode'];
									$vitalsign_value = $vitalarray['vitalsign_value'];
									$vital_name = $vitalarray['vital_name'];
									$vital_unit = $vitalarray['vital_unit'];
									?>
									<?php echo $vital_name; ?>: <?php echo $vitalsign_value; ?><?php echo $vital_unit; ?></br>
									<?php
									}
								?>
							<a href="add-vital.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact"><button class="small btn-warning" type="button">Add/Edit  <span class="fa-pen"></span></button></a>	
									
							</br>
							</td>
							
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
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
