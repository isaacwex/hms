<?php
        include('includes/authenticate.php'); 
        $fdate=$_GET['fdate'];
        $sdate=$_GET['sdate'];
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM `tbl_sales` where `datee`=<'$fdate' and `datee`=>'$sdate'");
		?>

    <table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>S/No</th>
							<th>Sale ID</th>
							<th>Item Sold</th>
							<th>Amount Sold</th>
							<th>Sale Profit</th>
							<th> Mode of payment</th>
							<th>Batch number</th>
							<th>Date Sold </th>
							<th>#</th>
                            
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gac = mysqli_fetch_array($getPatients)){
						$No=$No+1;
						$sale_id = $gac['sale_id'];
						$sale_itemcode = $gac['sale_itemcode'];
						$sale_amount = $gac['sale_amount'];
						$sale_soldby = $gac['sale_soldby'];
						$sale_profit = $gac['sale_profit'];
						$sale_modeofpayment = $gac['sale_modeofpayment'];
						$batch = $gac['batch'];
						$sale_status = $gac['sale_status'];
						$datee = $gac['datee'];
						$name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
							
						?>
						<?php "<tr class='gradeX'>"; ?>
                            <td><?php echo $No; ?></td>
							<td><?php echo $sale_id; ?></td>
							<td><?php echo $rrowname; ?></td>
							<td><?php echo $sale_amount; ?></td>
							<td><?php echo $sale_soldby; ?></td>
							<td><?php echo $sale_profit;?></td>
							<td><?php echo $sale_modeofpayment;?></td>
							<td><a href="sale-details.php?saleid=<?php echo $sale_id;?>&item=<?php echo $sale_itemcode;?>"><button class="btn btn-success" type="button"><span class="bold"> More</button></a></span></td>
							<td></td>
							
						</tr>
						<?php
						}
						?>
						
						</tbody>
						
	</table>