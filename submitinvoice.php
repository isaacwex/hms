<?php include('includes/authenticate.php'); ?>
<?php if(isset($_GET['page']) && $_GET['page'] == 'i') {
			$r=$_GET['invoice'];
			$result = mysqli_query($dbconnect,"SELECT * FROM tbl_inventorytemp WHERE `inve_invoiceno`='$r'");
			
										$No = 0;
										
										while($gcn = mysqli_fetch_array($result)){
											$No=$No+1;
											$inve_id = $gcn['inve_id'];
											$inve_drugcode = $gcn['inve_drugcode'];
											$inve_drugname = $gcn['inve_drugname'];
											$inve_qty = $gcn['inve_qty'];
											$inve_purchaseprice = $gcn['inve_purchaseprice'];
											$inve_time = $gcn['inve_time'];
											$inve_batchno = $gcn['inve_batchno'];
											$inve_expirydate = $gcn['inve_expirydate'];
											$inve_invoiceno = $gcn['inve_invoiceno'];
											$supplierid = $gcn['supplierid'];
											$name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
											$inve_drugname = $rrow2['brand_name'];

											$sql = "INSERT INTO `tbl_inventory`(`inve_drugcode`,`inve_drugname`,`inve_qty`, `inve_purchaseprice`, `inve_time`, `inve_batchno`, `inve_expirydate`, `inve_invoiceno`, `supplierid`) VALUES ('$inve_drugcode','$inve_drugname','$inve_qty','$inve_purchaseprice','$inve_time','$inve_batchno','$inve_expirydate','$inve_invoiceno','$supplierid')";
											$result1 = $dbconnect->query($sql);
										
									}header("Location: sessinvoice.php?page=invoice");}
	if(isset($_GET['page']) && $_GET['page'] == 'r') {
					$r=$_GET['invoice'];
			$result = mysqli_query($dbconnect,"SELECT * FROM tbl_materialsrequest_temp WHERE `tray_id`='$r'");
			
										$No = 0;
										
										while($gcn = mysqli_fetch_array($result)){
											$No=$No+1;
											$tray_id = $gcn['tray_id'];
											$tray_deptcode = $gcn['tray_deptcode'];
											$tray_itemcode = $gcn['tray_itemcode'];
											$tray_requestedby = $gcn['tray_requestedby'];
											$tray_qty = $gcn['tray_qty'];
											$tray_expirydate = $gcn['tray_expirydate'];
											$tray_dispatchedby = $gcn['tray_dispatchedby'];
											$sql = "INSERT INTO `tbl_dept_trays`(`tray_id`, `tray_deptcode`, `tray_itemcode`, `tray_requestedby`, `tray_qty`, `tray_expirydate`, `tray_dispatchedby`) VALUES ('$tray_id','$tray_deptcode','$tray_itemcode','$tray_requestedby','$tray_qty','$tray_expirydate','$tray_dispatchedby')";
											$result1 = $dbconnect->query($sql);
									}header("Location: sessinvoice.php?page=request");}

?>