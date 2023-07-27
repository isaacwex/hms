<?php
    include('includes/authenticate.php'); 
	$newid=time();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agrovet";
    $t=$_GET['str'];
    $paymentmode=$_GET['payment'];
    $mybusket=$_GET['busk'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
	if(isset($mybusket)){
        $sql2 = "SELECT * FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) { $n=1; 
            while($row2 = $result2->fetch_assoc()) {
                $temp_prodcode = $row2['temp_prodcode'];
                $temp_prodname = $row2['temp_prodname'];
                $temp_totalprice = $row2['temp_totalprice'];
                $temp_batch = $row2['temp_batch'];
                $datee=date('Y/m/d');
                $sql3 = "SELECT * FROM `tbl_inventory` where `inve_drugcode`='$temp_prodcode'";
                $result3 = $conn->query($sql3);
                if ($result3->num_rows > 0){
                    while($row3 = $result3->fetch_assoc()) {
                        $inve_qty = $row3['inve_qty'];
                        $buyingprice=$row3['inve_purchaseprice'];
                        $profit=$temp_totalprice-$buyingprice;
                        $newqty = $inve_qty-1;
                       // echo $newqty." ".$temp_prodcode." ".$temp_batch."<br/>";
                        $sql4 = "UPDATE `tbl_inventory` SET `inve_qty`='$newqty' WHERE `inve_drugcode`='$temp_prodcode'";
                        $result4 = $conn->query($sql4);
                        $sql5 = "INSERT INTO `tbl_sales`(`sale_itemcode`,`sale_name`,`sale_amount`,`sale_receiptno`, `sale_soldby`, `sale_profit`, `sale_customertype`, `sale_modeofpayment`, `sale_discount`, `sale_taxpercentage`, `sale_taxamount`, `sale_status`,`batch`,`datee`) VALUES ('$temp_prodcode','$temp_prodname','$temp_totalprice','$mybusket','$sidno','$profit','001','$paymentmode','0','0','0','completed','$temp_batch','$datee')";
                        $result5 = $conn->query($sql5);
                    }
                }
            }
        }
        $sql = "SELECT * FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' group by `temp_prodcode`";
        $result = $conn->query($sql);
        $_SESSION['receipt']='ready';
    }else{
        echo "<div class=\"alert alert-danger alert-dismissable\"> The busket is clear</div>"; 
    }						
?> 
					<div class="ibox-content p-xl printed">
						<!-- Hospital Details -->
						<div id="printableArea">
							<table bgcolor="White" width="100%" cellspacing="0" cellpadding="4">
							<tr style="border-bottom:1pt solid black; width:100%;" align="center" >
								<td><img src="logo.jpg" title="<?php $institution_name = strtoupper($smart_name); echo $institution_name; ?>" width="150px"></td>
								<td colspan="4" align="right" style="border-bottom: 2px solid #000000; height: 12px; border-bottom-width: 1px;" valign="middle"><p class="invoice_para">Longman House T - Junction next to Friends Church <br /><span style="color:black;">Webuye - Kitale Highway</span><p style="font-family:Times New Roman;font-size:12pt;font-weight:bold;"><?php echo $smart_address; ?> <br /> Mobile: +254 705 644282 / +254 780 005 200 <br /> E-mail: info@calvaryhopemedical.or.ke / calvaryhopemed.centre@gmail.com</p>
								</td>
								</hr>
							</tr>

							<tr style="border-bottom:1pt solid black;"><br /><td colspan="5" align="center"><span style="font-family:Times New Roman;font-size:12pt;font-weight:bold;color:red;">RECEIPT </span><br /></td></tr>
                            <?php if ($result->num_rows > 0) { 
                                $n=1; 
                                while($row = $result->fetch_assoc()) { ?>
                            <tr style="font-family:Times New Roman;font-size:11pt;font-weight:bold;">
                            <?php
                            $vital_code = $row['temp_prodcode'];
                            $vital_name = $row['temp_prodname'];
                            $temp_busketid = $row['temp_busketid'];
                            $vital_unit = $row['temp_qty'];
                            $vital_price = $row['temp_totalprice'];
                            $sql6 = "SELECT * FROM tbl_tempsales WHERE `temp_busketid`='$temp_busketid' && `temp_prodcode`='$vital_code'"; 
                            $result6 = $conn->query($sql6);
                            $numro=mysqli_num_rows($result6);
                            ?>
                                <td width="10%"><?php echo $n;$n++; ?></td>
                                <td width="55%"><?php echo $vital_name; ?></td>
                                <td width="10%"><?php echo  $numro; ?></td>
                                <td width="10%"><?php echo $vital_price;?></td>
                                <td width="15%"> <?php  $va= $vital_price*$numro; echo $va."/=";?></td>  
                            </tr>
                                <?php } } else {
                                    echo "Empty Busket";
                                }?>
                                <tr style="border-top:1pt solid black; width:100%;" align="center" >
								<td colspan="5" align="center" style="border-bottom: 2px solid #000000; height: 23px; border-bottom-width: 1px;" valign="middle" margin-top="10pt"><p style="font-family:Times New Roman;font-size:14pt;font-weight:bold;padding-top:5pt">Total Price - <?php echo $t."/=";?></p>
								</td>
							
							</tr>
							</table>
									   <tr align="center" style="font-family: 'Times New Roman', Times, serif; font-size: 10px; border-top-style: solid; border-top-width: 1pt; border-top-color: #000000"><td valign="bottom" style="font-family: 'Times New Roman', Times, serif; font-size: 12px; border-top-style: solid; border-top-width: 1px; border-top-color: #ff0000">We Treat God Heals</td></tr>
							 </td></tr> 
                            </table>
                        </div>
                    </div>