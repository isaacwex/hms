<?php include('includes/authenticate.php'); ?>
<?php
	$id=$_GET['tray'];
    $result2 = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_id`='$id' and `tray_dispatchedby`!='approved'");
	?>
	
	<?php if($result2->num_rows > 0){?>	
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Drug Name</th>
									<th>Quantity</th>
                                    <th>Status</th>
                                    <th>#</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn2 = mysqli_fetch_array($result2)){
									$No=$No+1;
									$tray_itemcode = $gcn2['tray_itemcode'];
									$tray_qty = $gcn2['tray_qty'];
                                    $tray_dispatchedby = $gcn2['tray_dispatchedby'];
                                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$tray_itemcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $rrowname; ?></td>
									<td><?php echo $tray_qty; ?></td>
									<td><?php echo $tray_dispatchedby; ?></td>
                                    <td><a onclick="approve('<?php echo $tray_itemcode;?>','<?php echo $id;?>')" class="btn btn-primary" type="button"><i class="fa fa-check"></i></a></td>
									<!--<td><button class="btn-xs btn-primary"><a href="edit-county.php?county_id=<?php //echo $county_code; ?>"><i class="fa fa-pencil"></i> Edit </a></button> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>-->
								</tr>
								<?php
								}
								?>
								
								</tbody>
								</table>
                                <?php } else{ ?> 
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>Item list will be displayed here</b>
                                    </div>                                    
                                    <?php }?>