<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Billing - <?php echo $smart_name; ?></title>
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
			$current_processstage='BILLING';
			$queuestatuscurrent='1';
			$getLabPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$title='Patients for billing services';
		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for billing results)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th><input type="checkBox" id="toggle" value="select" /></th>
							<th>OP No</th>
							<th>Visit No</th>
							<th>Full Names</th>
							<th>ID Number</th>
							<th>Phone Number</th>
							<th>Gender</th>
							<th>DoB</th>
							<th>Billing Services Pending</th>
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
						$todaydate = date('Y-m-d');
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<?php echo "<td class='a-center '><input type='checkbox' class='flat' name='Farmers[]' ></td>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo $visitno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
						
							<td>
								<?php
									$No=0;
									$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN tbl_products r ON p.prescription_productcode=r.product_code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
										while($lrarray = mysqli_fetch_array($getls)){
											$No=$No+1;
											$prescription_productcode = $lrarray['prescription_productcode'];
											$prescription_dosagesummary = $lrarray['prescription_dosagesummary'];
											$prescription_quantity = $lrarray['prescription_quantity'];
											$product_name = $lrarray['product_name'];
											$prescription_id = $lrarray['prescription_id'];
											$prescription_status = $lrarray['prescription_status'];
											?>
											 
											<?php echo $No; ?>. <?php echo $product_name; ?> - <?php echo $prescription_quantity; ?> - <?php echo $prescription_dosagesummary; ?>
											<?php
							if(isset($_GET['dispense'])){
								$prescription_psnid = $_GET['dispense'];
								$prescription_status='1';
								$update_item = "UPDATE tbl_prescriptions SET prescription_status=? WHERE prescription_id='$prescription_psnid'";
										if($stmt = $dbconnect->prepare($update_item)) {
											$stmt->bind_param('s',$prescription_status);
											$stmt->execute();
											?>
												<script>
													alert('Dispensed successfully<?php echo "$dbconnect->error()";?>');
													window.location = 'pharmacy.php';
												</script>	
											<?php
										}
										else {
											
										}
							}
							
							if ($prescription_status=='1'){
								?>
								<button type="button" class="btn-xs btn-info" onclick="return alert('<?php echo $product_name; ?> already dispensed!')" > Dispensed</button>
								<?php
							}
							else{
								?>
							<a href="pharmacy.php?dispense=<?php echo $prescription_id; ?>"><button type="button" class="btn-xs btn-warning" onclick="return confirm('Are you sure you want to dispense <?php echo $product_name; ?>?')" >Dispense</button></a>
								<?php
							}
							 ?>
							
											</br>
											<?php
											}
										?>	
							</td>
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
									</li>
									<li class="divider"></li>
									<li><a href="#">View Lab Reports</a></li>
									<li><a href="#">View Triage Results</a></li>
									<li><a href="#">View Patient Visits</a></li>
									<li><a href="#">View Visits/Bills History</a></li>
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
