<?php include('includes/authenticate.php'); ?>
<?php
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_inventorytemp");
	
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
                                    $sql = "INSERT INTO `tbl_inventory`(`inve_id`, `inve_drugcode`,`inve_drugname`,`inve_qty`, `inve_purchaseprice`, `inve_time`, `inve_batchno`, `inve_expirydate`, `inve_invoiceno`, `supplierid`) VALUES ('$inve_id','$inve_drugcode','$inve_qty','$inve_purchaseprice','$inve_time','$inve_batchno','$inve_expirydate','$inve_invoiceno','$supplierid')";
                                    $result = $dbconnect->query($sql);
                                    header("Location: sessinvoice.php");
                              }?>