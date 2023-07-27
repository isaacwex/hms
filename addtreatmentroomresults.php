<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	<title>Add Lab Results - <?php echo $smart_name; ?></title>
	
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
			$currentdept=$_GET['current_processstage'];
			$c_id=$_GET['c_id'];
			$nursingstationrequest_id=$_GET['nursingstationrequestid'];
			$todaydate = date('Y-m-d');
			
			$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE reg_no='$c_id'");
			$pdetails = mysqli_fetch_assoc($checkdetails);
			$id_no = $pdetails['id_no'];
			$fnames = $pdetails['f_name'];
			$lnames = $pdetails['l_name'];
			$gender = $pdetails['gender'];
			$dob = $pdetails['dob'];
			
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
			elseif($current_processstage='BILLING'){
				$page='billing.php';
			}
			else{
				echo 'Error Occurrred';
			}
//// To load the existing indformation 
						//$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_labrequests r INNER JOIN tbl_labservices s ON r.labrequest_labservicecode=s.labservice_code WHERE r.labrequest_opno='$opno' AND r.labrequest_visitno='$visitno'");
							$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_nursingstationrequests q INNER JOIN tbl_services v ON q.nursingstationrequest_servicecode=v.ss_code WHERE q.nursingstationrequest_id='$nursingstationrequest_id'");
									$vitalarray = mysqli_fetch_array($getvitals);
										$nursingstationrequest_id = $vitalarray['nursingstationrequest_id'];
										$nursingstation_code = $vitalarray['ss_code'];
										$nursingstation_name = $vitalarray['ss_name'];
										$nursingstation_cost = $vitalarray['nursingstationrequest_price'];
										$nursingstationrequest_status = $vitalarray['nursingstationrequest_status'];
							?>
                  <div class="row">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><?php echo $nursingstation_name; ?> </h4>
                                            <small class="font-bold">COnfirm Service</small>
                                        </div>
                                        <div class="modal-body">			
										<div class="row">
											<div class="col-sm-7">
											<h3> Procedure Confirmation </h3>
											<form role="form" method="post">	
												<div class="col-sm-12">													
												<?php
													$date1 = $dob;
													$date2 = $todaydate;
													
													$diff = date_diff(date_create($dob), date_create($todaydate));
													$agess = $diff->format('%y');
													
													if(isset($_POST['confirmprocedure'])){
														
														$status = 'CLOSED';
															$updateStatus = "UPDATE tbl_nursingstationrequests SET nursingstationrequest_status=? WHERE nursingstationrequest_id='$nursingstationrequest_id'";
																if($stmtp = $dbconnect->prepare($updateStatus)){
																$stmtp->bind_param('s',$componenttested);
																$stmtp->execute();
																	echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-check-circle-o\"></i> Sucessful...</div>";
																	echo '<META HTTP-EQUIV="Refresh" content="0; URL=treatmentroom.php">';
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		</script>	
																	<?php
																	
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
													</div>
													<hr>
													<div class="row well well-sm">
														<div class="col-sm-12">
															<div class="col-sm-10">
															</br><span class="badge badge-success"><?php echo $nursingstationrequest_status; ?></span>
															</br>Procedure: <strong><i><?php echo $nursingstation_name; ?> - <?php echo $nursingstation_cost; ?>/=</i></strong>
															
															</br></br>
															</div>	
														</div>	
													</div>
													</br>
																									
														<div class="col-sm-6">
															<div class="form-group">
																<input name="confirmprocedure" class="btn btn-md btn-success" type="submit" value="Complete Now"/>
															</div>
														</div>
													</div>
                            
							</form>
						</div>
						<div class="col-sm-5 well well-sm">
							<form action="" method="post">
								<div class="col-sm-12">													
										<?php
											if(isset($_POST['submit'])){
											if(empty($_POST['tray_autoid'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
									$traycons_trayid=$_POST['tray_autoid'];
									$traycons_deptcode='$currentdept';
									$traycons_user=$sidno;
									$traycons_servicerequestid=$nursingstationrequest_id;
									$quantity = $dbconnect->real_escape_string($_POST['quantity']);
									$traycons_consumedtime = date('Y-m-d');
									
									$gettrayitems = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays v INNER JOIN tbl_drugs d ON v.tray_itemcode=d.drugitem_code WHERE tray_autoid='$traycons_trayid'");
                                            $gali = mysqli_fetch_array($gettrayitems);
											$brand_name = $gali['brand_name'];
											$tray_availableqty = $gali['tray_availableqty'];
											$drugcode = $gali['tray_itemcode'];		
													
									if($quantity>$tray_availableqty){
										echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Wah! seems you are trying to consume more than what you have</div>";
									}else{
										$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_trayconsumption WHERE traycons_drugcode='$drugcode' AND traycons_servicerequestid='$traycons_servicerequestid'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! A similar material has already been consumed for this</div>";
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_trayconsumption (traycons_deptcode, traycons_trayid, traycons_user,traycons_qty,traycons_servicerequestid,traycons_consumedtime,traycons_drugcode) VALUES (?,?,?,?,?,?,?)")){
													$stmt->bind_param('sssssss',$traycons_deptcode, $traycons_trayid, $traycons_user,$quantity,$traycons_servicerequestid,$traycons_consumedtime,$drugcode);
													$stmt->execute();
													
													//updating the tray availability
													$newqty=$tray_availableqty-$quantity;
													$updateStatus = "UPDATE tbl_dept_trays SET tray_availableqty=? WHERE tray_autoid='$traycons_trayid'";
																if($stmtp = $dbconnect->prepare($updateStatus)){
																$stmtp->bind_param('s',$newqty);
																$stmtp->execute();
																echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Material Added..</div>";
																}
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured</div>";	
																}
															}
													}
											}
												?>
											</div>
											<h3>Materials Consumed for <?php echo $nursingstation_name; ?></h3>
								
                                           <div class="form-group" style="display:block;">
													<label><h4>Select Item</h4></label>
                                                    <select data-placeholder="Choose drug..." name="tray_autoid" class="form-control chosen-select">
                                                            <option selected value="">Select from List </option>
                                                            <?php
                                                     $getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays v INNER JOIN tbl_drugs d ON v.tray_itemcode=d.drugitem_code AND V.tray_deptcode='$currentdept'");
														
														//tray_autoid
														
                                                        while($gal = mysqli_fetch_array($getalllocations)){
                                                            $tray_autoid = $gal['tray_autoid'];
                                                            $brand_name = $gal['brand_name'];
                                                            $inve_batchno = $gal['inve_batchno'];
                                                            $tray_availableqty = $gal['tray_availableqty'];
                                                            $tray_batchno = $gal['tray_batchno'];
                                                            
                                                            ?>
                                                            <option value="<?php echo $tray_autoid; ?>" > <?php echo $brand_name; ?> | Batch- <?php echo $tray_batchno; ?>  | Available qty-<?php echo $tray_availableqty; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                            <label><h4>Quantity</h4></label>
                                            <input type="number" name="quantity" class="form-control">
                                            </div>
											<div class="form-group">
                                             <p class="pull-right"><button class="btn btn-primary" type="submit" name="submit" class="form-control btn btn-primary">Add to List</button></p>
                                            </div>
											<br>
											<hr>
											<div class="form-group well well-sm"> 
												<h3><b> Items Consumed for this procedure </b></h3>
													<?php
														$getvitals = mysqli_query($dbconnect, "SELECT * FROM tbl_trayconsumption t INNER JOIN tbl_drugs g ON t.traycons_drugcode=g.drugitem_code WHERE t.traycons_deptcode='$currentdept'");
														$No=0;
														while($vitalarray = mysqli_fetch_array($getvitals)){
															$No=$No+1;
															$traycons_id = $vitalarray['traycons_id'];
															$traycons_qty = $vitalarray['traycons_qty'];
															$brand_name = $vitalarray['brand_name'];
														?>
														<?php echo $brand_name; ?> <span class="badge badge-success"><?php echo $traycons_qty; ?> </span> 
														<?php
															if(isset($_GET['delete'])){
																$deleted = $_GET['delete'];
																$action = mysqli_query($dbconnect,"DELETE FROM tbl_trayconsumption WHERE traycons_id='$traycons_id'");
																if($action){
																	?>
																	<script>
																		alert('Deleted successfully<?php echo "$dbconnect->error()";?>');
																			window.location ='addlabresults.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
																else {
																	?>
																	<script>
																		alert('Error deleting <?php echo "$dbconnect->error()";?>');
																			window.location ='addlabresults.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																	</script>	
																	<?php
																}
															}	
															?>
													<a href="addtreatmentroomresults.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>&delete=<?php echo $traycons_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete the item on the list?')" > <span class="fa fa-trash"></span></button></a>
														</br>
														<?php } ?>
											</div>
                                        </form>	
								</div>	
							</div>	
									
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
