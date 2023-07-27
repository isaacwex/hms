<?php
	include 'includes/authenticate.php';
	
	if(isset($_GET['page']) && $_GET['page'] == 'expiry') {
		$expiry=date('Y-m-d', strtotime('+30 days'));
		$expiry =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_expirydate`>='$expiry' AND `inve_expirydate`<='$expiry'");
		$expiryrrow2 = mysqli_fetch_array($expiry);?>
		
		<div class="ibox-content">
                           <div class="row">
                            <?php if($expiry->num_rows > 0){?>
							<div id="pri">
                           <table class="table table-striped table-bordered table-hover dataTables-example">
								
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Batch No.</th>
									<th>Expiry date</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								while($gcn = mysqli_fetch_array($expiryrrow2)){
									$No=$No+1;
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $gcn['inve_drugname']; ?></td>
									<td><?php echo $gcn['inve_qty']; ?></td>
									<td><?php echo $gcn['inve_batchno']; ?></td>
									<td><?php echo $gcn['inve_expirydate']; ?></td>
									
								</tr>
								<?php }?>
                                </tbody>
								</table> 
								</div>
								<button onclick="printDiv('pri')" class="btn btn-primary"><i class="fa fa-print"></i> Print </button> | 
							<button class="btn btn-danger"><i class="fa fa-file-pdf-o" onclick="exportToExcel()"></i> Export to excel</button>
								
                            <?php }else{ ?>
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>Nothing is due to expire</b>
                                    </div>
                                <?php } ?>
								                    
							</div>
						</div><?php 
	}
		if(isset($_GET['page']) && $_GET['page'] == 'inventory') {
			
			$now=date('Y-m-d');
			$inve =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory`");
			$inve2 = mysqli_fetch_array($inve);
			?>
			
			<div class="row">
                                          

                            <?php if($inve->num_rows > 0){?>
							<div id="pri">
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Batch No.</th>
									<th>Expiry date</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn1 = mysqli_fetch_array($inve)){
									$No=$No+1;
                                    
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $gcn1['inve_drugname']; ?></td>
									<td><?php echo $gcn1['inve_qty']; ?></td>
									<td><?php echo $gcn1['inve_batchno']; ?></td>
									<td><?php echo $gcn1['inve_expirydate']; ?></td>
								
								</tr>
								<?php }?>
                                </tbody>
								</table>
								</div>
							<button onclick="printDiv('pri')" class="btn btn-primary"><i class="fa fa-print"></i> Print </button> | 
							<button class="btn btn-danger"><i class="fa fa-file-pdf-o" onclick="exportToExcel()"></i> Export to excel</button>
                            <?php }else{ ?>
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>Out of Stock. please request stock</b>
                                    </div>
                                <?php } ?>
								
								                       
							</div>
						</div><?php
		}
		if(isset($_GET['page']) && $_GET['page'] == 'sold') {
			$now=date('Y-m-d');
			$startdate=date('Y-m-d');
			$enddate=date('Y-m-d');
			$inve =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_itemcode`");
			$inve2 = mysqli_fetch_array($inve);
			
			?>
			<div class="row">
                            <?php if($inve->num_rows > 0){?>
							<div id="pri">
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Name</th>
									<th>Quantity Sold</th>
									<th>Revenue</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn1 = mysqli_fetch_array($inve)){
									$No=$No+1;
                                    $qtysold=$inve->num_rows;
									
									$dcode=$gcn1['sale_itemcode'];
									$sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE `sale_itemcode`=$dcode";
									$sql41 = "SELECT * FROM tbl_sales WHERE `sale_itemcode`=$dcode";
									$result4 = mysqli_query($dbconnect, $sql4);
									$result41 = mysqli_query($dbconnect, $sql41);
									$row0 = mysqli_fetch_assoc($result4);
									$row = mysqli_fetch_assoc($result41);
									$total= $row0["total"];
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $gcn1['sale_name']; ?></td>
									<td><?php echo $qtysold; ?></td>
									<td><?php echo  $total;?></td>
									
								</tr>
								<?php }?>
                                </tbody>
								</table>
								</div>
								<button onclick="printDiv('pri')" class="btn btn-primary"><i class="fa fa-print"></i> Print </button> | 
							<button class="btn btn-danger" onclick="exportToExcel()"><i class="fa fa-file-pdf-o"></i> Export to excel</button></a>
                            <?php }else{ ?>
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>Out of Stock. please request stock</b>
                                    </div>
                                <?php } ?> 
							</div>
						</div>
			
			
			<?php	} ?>
			