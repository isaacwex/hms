<?php
include('includes/authenticate.php'); 
$id=$_GET['str'];
$result =mysqli_query($dbconnect,"SELECT * FROM `tbl_tempsales`WHERE `temp_busketid`='$id' group by `temp_prodcode`");
 if(isset($id)){?>	
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Drug Name</th>
									<th>Unit Price </th>
									<th>Quantity</th>
                                    <th>Sub Total</th>
								</tr>
								</thead>
								<tbody>
								
                            <?php if ($result->num_rows > 0) { 
                                $n=1; 
								$t=0;
                                while($row = $result->fetch_assoc()) { ?>
                            <tr style="font-family:Times New Roman;font-size:11pt;font-weight:bold;">
                            <?php
                            $vital_code = $row['temp_prodcode'];
                            $vital_name = $row['temp_prodname'];
                            $temp_busketid = $row['temp_busketid'];
                            $vital_unit = $row['temp_qty'];
                            $vital_price = $row['temp_totalprice'];
                            $sql6 = "SELECT * FROM tbl_tempsales WHERE `temp_busketid`='$temp_busketid' && `temp_prodcode`='$vital_code'"; 
                            $result6 = $dbconnect->query($sql6);
                            $numro=mysqli_num_rows($result6);
                            ?>
                                <td width="10%"><?php echo $n;$n++; ?></td>
                                <td width="55%"><?php echo $vital_name; ?></td>
                                <td width="10%"><?php echo  $numro; ?></td>
                                <td width="10%"><?php echo $vital_price;?></td>
                                <td width="15%"> <?php  $va= $vital_price*$numro; echo $va;$t=$va+$t;?></td>  
                            </tr>
                                <?php } } else {
                                    echo "Empty Busket";
                                }?>
                                <tr style="border-top:1pt solid black; width:100%;" align="center" >
								<td colspan="5" align="center" style="border-bottom: 0px solid #000000; height: 23px; border-bottom-width: 1px;" valign="middle" margin-top="10pt"><p style="font-family:Times New Roman;font-size:14pt;font-weight:bold;padding-top:5pt">Total Price - <?php echo $t;?></p>
								</td>
							</tr>
								<tr><td colspan="7">
								<button onclick="checkout1(<?php echo $t; ?>,<?php echo $id; ?>)"  class="btn btn-primary"><i class="fa fa-trash"></i> Checkout</button>
							</td></tr>
								</tbody>
								</table>
                                <?php } ?>  