<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Pharmacy - <?php echo $smart_name; ?></title>
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
			$current_processstage='PHARMACY';
			$queuestatuscurrent='1';
			$patientcategory='OUTPATIENT';
			//$getLabPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$title='Patients for pharmacy services';
			
			$getLabPatients =mysqli_query($dbconnect, "SELECT * FROM tbl_prescriptions q INNER JOIN tbl_registry p ON q.prescription_opno=p.opno WHERE q.prescription_status='OPEN' AND q.prescription_patientcategory='$patientcategory' GROUP BY q.prescription_opno");
			
			
			//$baselink='treatmentroom.php';
		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for pharmacy results)</i>
						<p class="pull-right
				<span><a href="add-drugs.php"><button onclick="history.back()" class="btn btn-primary" type="button">Back<span class="bold"> </span></button></a></span>
				</p>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>S/NO</th>
							<th>OP No</th>
							<th>Full Names</th>
							<th>Gender</th>
							<th>DoB</th>
							<th>Category</th>
							<th>Pharmacy Requests Pending</th>
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
						<tr class='gradeX'>
							<td><?php echo $No;?></td>
							<td><?php echo $opno.' | '. $visitno;?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td><span class="badge badge-success"><?php echo $patientcategory; ?> </span></td>
							<td>
								<?php
								$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN tbl_drugs t on p.prescription_productcode=t.drugitem_code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno' AND prescription_patientcategory='$patientcategory' AND p.prescription_referred='IN-STORE'");
									//$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN products t on p.prescription_productcode=t.code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
									//$getprescriptions = mysqli_query($dbconnect, "SELECT * FROM  tbl_inventory v INNER JOIN tbl_drugs t on v.inve_drugcode=t.drugitem_code WHERE v.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
										//$No=1;
										while($prescriptionarray = mysqli_fetch_array($getprescriptions)){
											//$No=$No+1;
											$prescription_id = $prescriptionarray['prescription_id'];
											$drug = $prescriptionarray['brand_name'];
											$quantity = $prescriptionarray['prescription_quantity'];
											$prescription_invid = $prescriptionarray['prescription_invid'];
											$dosagesummary = $prescriptionarray['prescription_dosagesummary'];
											$prescription_status = $prescriptionarray['prescription_status'];
											$prescription_scheme = $prescriptionarray['prescription_scheme'];
											$prescription_productcode = $prescriptionarray['prescription_productcode'];
											?>
											 
											<b>*</b> <?php echo $drug; ?> | <?php echo $quantity; ?> | <?php echo $dosagesummary; ?>
											<?php
							if(isset($_GET['dispense'])){
								$c_id = $_GET['dispense'];
								$prescription_status='CLOSED';
								
								// Get the Opno and the visito for the variable $c_id in table 'registry' 
								//update the product stock quantity in table 'inventory' with the values provided in 'tbl_prescriptions'
								//insert the transaction into the 'order'
								//insert list of prescribtions into the table 'order_items'
																
								$update_item = "UPDATE tbl_prescriptions SET prescription_status=? WHERE prescription_id='$c_id'";
										if($stmt = $dbconnect->prepare($update_item)) {
											$stmt->bind_param('s',$prescription_status);
											$stmt->execute();
											
								$curentstock = mysqli_query($dbconnect, "SELECT * FROM `tbl_inventory` WHERE `inve_id`='$prescription_invid'");	
								$mystock = mysqli_fetch_array($curentstock);
								$inve_qty=$mystock['inve_qty'];
								$remstock=$inve_qty-$quantity;
								$inve_drugcode=$mystock['inve_drugcode'];
								$inve_drugname=$mystock['inve_drugname'];
								$inve_purchaseprice=$mystock['inve_purchaseprice'];
								$inve_batchno=$mystock['inve_batchno'];
								
								$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$inve_drugcode' AND `scheme`='$prescription_scheme'");$rrow = mysqli_fetch_array($price);
								$rrowprice = $rrow['price'];
								$inve_qty=$mystock['inve_qty'];
								$inv=$opno."/".$visitno;
								$datee=date('Y-m-d');
								$profit=$rrowprice-$inve_purchaseprice;
																
								$update_inve = "UPDATE `tbl_inventory` SET `inve_qty`=? WHERE `inve_id`='$prescription_invid'";
								if($stmt2 = $dbconnect->prepare($update_inve)) {
											$stmt2->bind_param('s',$remstock);
											$stmt2->execute();
								$sql5 = "INSERT INTO `tbl_prescriptionsales`(`sale_itemcode`,`sale_name`,`sale_amount`,`sale_receiptno`, `sale_soldby`, `sale_profit`, `sale_customertype`,`sale_schemecode`,`sale_modeofpayment`, `sale_discount`, `sale_taxpercentage`, `sale_taxamount`,`sale_status`,`batch`,`datee`) VALUES('$inve_drugcode','$inve_drugname','$rrowprice','$inv','$sidno','$profit','$patientcategory','$prescription_scheme','CREDIT','0','0','0','completed','$inve_batchno','$datee')";
								$result5 = $dbconnect->query($sql5);
										//refresh page
										echo "<meta http-equiv='refresh' content='0;url=pharmacy.php'>";
								}
							}
						}
								if($prescription_status=='OPEN'){
								?>
											<a href="dispense.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&prescription_id=<?php echo $prescription_id;?>&inventory_id=<?php echo $prescription_invid; ?>&qty=<?php echo $quantity; ?>&schemep=<?php echo $prescription_scheme; ?>&pcategory=<?php echo $patientcategory; ?>"><span class="badge badge-warning"> Dispense Now</span></a>
											<br>
											<?php
								}else{
										?>							
									<span class="badge badge-primary"><i>Dispensed</i></span><br>
									<?php
									}
							}
							?>
							</br>
							</td>
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									
									<li>
									
									</li>
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
									</li>
									<li class="divider"></li>
									<li>
									<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Lab Report</a>
									</li>
									<li>
									<a target="_blank" href="consultationreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Consultation Report</a>
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