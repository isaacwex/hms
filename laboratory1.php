<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Laboratory - <?php echo $smart_name; ?></title>
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
			$current_processstage='LABORATORY';
			$queuestatuscurrent='1';
			$getLabPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno INNER JOIN tbl_paymentschemes ps ON p.scheme_code=ps.pscheme_code WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			
			$title='Patients for laboratory services';
			$baselink='laboratory.php';
		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for laboratory results)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>OP No</th>
							<th>Visit No</th>
							<th>Full Names</th>
							<th>Member No.</th>
							<th>Phone No.</th>
							<th>Details</th>
							<th>Lab Requests Pending</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gaclab = mysqli_fetch_array($getLabPatients)){
						$No=$No+1;
						$c_id = $gaclab['reg_no'];
						$fnames = $gaclab['f_name'];
						$lnames = $gaclab['l_name'];
						$id_number = $gaclab['id_no'];
						$phonenumber = $gaclab['phone_no'];
						$gender = $gaclab['gender'];
						$dob = $gaclab['dob'];
						$opno = $gaclab['opno'];
						$visitno = $gaclab['visit_no'];
						$reside = $gaclab['residence'];
						$visit_date = $gaclab['visit_date'];
						$pscheme_name = $gaclab['pscheme_name'];
						$queue_from = $gaclab['queue_from'];
						
						$todaydate = date('Y-m-d');
						
													$todaydate = date('Y-m-d');
													$date1 = $dob;
													$date2 = $todaydate;
													
													$diff = date_diff(date_create($dob), date_create($todaydate));
													$agess = $diff->format('%y');
													$allmonths = $diff->format('%m');
													$alldays = $diff->format('%m');
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo $visitno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<?php
							$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_labrequests r INNER JOIN tbl_labservices s ON r.labrequest_labservicecode=s.labservice_code WHERE r.labrequest_opno='$opno' AND r.labrequest_visitno='$visitno'");
										while($lrarray = mysqli_fetch_array($getls)){
											//$No=$No+1;
											$labrequest_labservicecode = $lrarray['labrequest_labservicecode'];
										}
							?>
							
							<td><span class="badge badge-primary"><?php echo $pscheme_name; ?></span><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?>(<?php echo "$agess"; ?>Y <?php  echo "$allmonths";?>M <?php echo "$alldays" ?>D)</td>
							<td>
								<span class="badge badge-success"><?php echo $queue_from; ?></span><br>
								<?php
									$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_labrequests r INNER JOIN tbl_labservices s ON r.labrequest_labservicecode=s.labservice_code WHERE r.labrequest_opno='$opno' AND r.labrequest_visitno='$visitno'");
										while($lrarray = mysqli_fetch_array($getls)){
											//$No=$No+1;
											$labrequest_labservicecode = $lrarray['labrequest_labservicecode'];
											$labservice_note = $lrarray['labservice_note'];
											$labservice_name = $lrarray['labservice_name'];
											$labrequest_id = $lrarray['labrequest_id'];
											$labrequest_visitno = $lrarray['labrequest_visitno'];
											$labrequest_opno = $lrarray['labrequest_opno'];
											?>
											 <?php echo $No; ?> - <?php echo $labservice_name; ?> - <?php echo $labservice_note; ?> - 
										<span class="badge badge-warning"><a href="addlabresults.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&labrequest_id=<?php echo $labrequest_id;?>" data-toggle="modal" title="Lab results">Add/Edit Results</a></span>
										 </br>
											<?php
											}
										?>	
							</td>
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
				
									<li>
									<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Lab Request </a>			
									</li>
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
			</form>
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
