<?php include('includes/authenticate.php');
    $id=$_GET['q'];
?>
<table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									
									<th>S/NO </th>
									<th>Name</th>
									<th>Stock</th>
									<th>Expiry </th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_invoiceno`='$id'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$inve_drugname = $gcn['inve_drugname'];
									$inve_qty = $gcn['inve_qty'];
									$inve_expirydate = $gcn['inve_expirydate'];
                                    $inve_id = $gcn['inve_id'];
									//$Servicesitem_sellingprice = $gcn['Servicesitem_sellingprice'];
								?>	<td><?php echo $No; ?></td>
									<td><?php echo $inve_drugname; ?></td>
									<td><?php echo $inve_qty; ?></td>
									<td><?php echo $inve_expirydate; ?></td>
									 
								</tr>
								<?php
								}
								?>
								
								</tbody>
								</table>