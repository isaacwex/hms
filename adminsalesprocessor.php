<?php 
	include('includes/authenticate.php'); 
	if(isset($_GET['page']) && $_GET['page'] == 'searchsales') {

										$q=$_GET["q"];
										$search_char = $q;
										$startdate=date('Y/m/d');
										$enddate=date('Y/m/d');
										if(isset($_SESSION['datesearch'])){
											$startdate=$_SESSION['datesearch']['start'];
											$enddate=$_SESSION['datesearch']['ending'];
											unset($_SESSION['datesearch']);
										}
		$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' AND `sale_receiptno` LIKE '%$search_char%' group by `sale_receiptno`");if ($getcountyname->num_rows > 0) {?>
			<table width="100%" cellspacing="0" cellpadding="4" style="font-size:15px;">
			<tr>
				   <th colspan="4" style="font-size:13px; color:green;text-align:center;"><u>Showing results for 
				   <?php if(isset($_SESSION['datesearch']['start'])){
											echo " dates between ".$_SESSION['datesearch']['start'];
											echo " and ".$enddate=$_SESSION['datesearch']['ending'];
										} else{?> today<?php }   ?>
				</u></th>
			   </tr>   
			<tr>
				   <th>S/No</th>
				   <th>Invoice Number</th>
				   <th>Amount Paid</th>
				   <th>Mode of Payment</th>
			   </tr> 		
		   <?php $n=1;
			   while($gcn = mysqli_fetch_array($getcountyname)){
			   $sale_receiptno = $gcn['sale_receiptno'];
			   $sale_modeofpayment = $gcn['sale_modeofpayment'];
			   $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales";
			   $result4 = mysqli_query($dbconnect, $sql4);
			   $row = mysqli_fetch_assoc($result4);
			   $total= $row["total"];
			   ?>
			   <tr style='border-radius:5px; margin-bottom:20px; cursor: pointer;' onclick="myFunction(<?php echo $sale_receiptno;?>)">
				   <td><h4><?php echo $n;$n=$n+1;?></h4></td>
				   <td ><h4><?php echo $sale_receiptno; ?></h4></td>
				   <td><h4><?php echo $total; ?></h4></td>
				   <td><h4><?php echo $sale_modeofpayment?></h4></td>
			   </tr>
		   <?php }}else{?>
			   <div style="text-align: center;
			   font-size: 24px;
			   margin-top: 20px;
			   align-items: center;
			   color:green;
			   font-size: large;">
			   <b>Receipt Number not found</b>
			   </div>
		   <?php }
		   ?>
		   
		   </table>
	<?php }
	if(isset($_GET['page']) && $_GET['page'] =='searchdsales'){
			$q=$_GET["q"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "agrovet";
			$dbconnect = new mysqli($servername, $username, $password, $dbname);
			if ($dbconnect->connect_error) {
				die("Connection failed: " . $dbconnect->connect_error);
			}

			$search_char = $q;
			$startdate=date('Y/m/d');
			$enddate=date('Y/m/d');
			if(isset($_SESSION['datesearch'])){
				$startdate=$_SESSION['datesearch']['start'];
				$enddate=$_SESSION['datesearch']['ending'];
				unset($_SESSION['datesearch']);
			}
			if($search_char=='*'){
			$getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_itemcode`");
			}
			else{
				$getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' AND `sale_itemcode` LIKE '%$search_char%' group by `sale_receiptno`");
			}

			if ($getsdrugs->num_rows > 0) {
				
				?>
				<table width="100%" cellspacing="0" cellpadding="4" style="font-size:15px;">
				<tr>
					   <th colspan="4" style="font-size:13px; color:green;text-align:center;"><u>
						 sold  
					   <?php if(isset($_SESSION['datesearch']['start'])){
												echo " between dates between ".$_SESSION['datesearch']['start'];
												echo " and ".$enddate=$_SESSION['datesearch']['ending'];
											} else{?> today<?php }   ?>
					</u></th>
				   </tr>    
				
				<tr>
					   <th>S/No</th>
					   <th>Item Code</th>
					   <th>Item Name</th>
					   <th>Qty Sold</th>
				   </tr> 		
			   <?php $n=1;
				   while($gcn = mysqli_fetch_array($getsdrugs)){
				   $sale_itemcode = $gcn['sale_itemcode'];
				   $sql4 = "SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode'";
				   $result4 = mysqli_query($dbconnect, $sql4);
				   $row = mysqli_fetch_assoc($result4);

				   $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_itemcode`='$sale_itemcode' AND `datee`>='$startdate' AND `datee`<='$enddate'");
				   $salecount=$getsalecount->num_rows;
				   ?>
				   <tr style='border-radius:5px; margin-bottom:20px; cursor: pointer;' onclick="myFunction1('<?php echo $sale_itemcode;?>')">
					   <td><h4><?php echo $n;$n=$n+1;?></h4></td>
					   <td ><h4><?php echo $sale_itemcode; ?></h4></td>
					   <td><h4><?php echo $row['brand_name']; ?></h4></td>
					   <td><h4><?php echo $salecount; ?></h4></td>
				   </tr>
			   <?php }}else{?>
				   <div style="text-align: center;
				   font-size: 24px;
				   margin-top: 20px;
				   align-items: center;
				   color:green;
				   font-size: large;">
				   <b>Drug never sold</b>
				   </div>
			   <?php }  ?>
			   
	</table><?php }
	if(isset($_GET['page']) && $_GET['page'] =='totalsales'){?>
	<?php
        $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` group by `sale_itemcode`");
        $salecount=$getsalecount->num_rows;
        $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales";
        $result4 = mysqli_query($dbconnect, $sql4);
        $row = mysqli_fetch_assoc($result4);
        $total= $row["total"];
        $sql5 = "SELECT SUM(sale_amount) as mpesa FROM tbl_sales WHERE  sale_modeofpayment='MPESA'";
        $result5 = mysqli_query($dbconnect, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $mpesa= $row5["mpesa"];
		$sql8 = "SELECT SUM(sale_amount) as credit FROM tbl_sales WHERE  sale_modeofpayment='CREDIT'";
        $result8 = mysqli_query($dbconnect, $sql8);
        $row8 = mysqli_fetch_assoc($result8);
        $credit= $row5["credit"];
        $sql7 = "SELECT SUM(sale_amount) as cash FROM tbl_sales WHERE  sale_modeofpayment='CASH'";
        $result7 = mysqli_query($dbconnect, $sql7);
        $row7 = mysqli_fetch_assoc($result7);
        $cash= $row7["cash"];
        $other=$total-($mpesa+$cash);?>
        <div class="ibox-content p-xl printed">
                                    <table width="100%" cellspacing="0" cellpadding="4" style="font-size:20px;color:grey;border-radius:5px;">
                                        <tr>
                                            <th colspan="2">Your daily Summary</th>
                                        </tr>
                                        <tr>
                                            <td>Number of Items Sold</td>
                                            <td><?php echo $salecount;?></td>
                                        </tr>
                                        <tr>
                                            <td>Cash</td>
                                            <td><?php if($cash>0){ echo $cash."/=";}else{echo "0.00";};?></td>
                                        </tr>
                                        <tr>
                                            <td>Mpesa</td>
                                            <td><?php if($mpes>0){echo $mpesa."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr>
                                            <td>Other payment options</td>
                                            <td><?php if($other>0){ echo $other."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr style="color: green; border-top:2px solid black; margin-top: 2px;">
                                            <th>Total Amount collected</th>
                                            <th><?php if($total>=0) {echo $total."/=";}else{echo "0.00";}?></th>
                                        </tr>
                                    </table>
        
	</div>			
	<?php }?>	
	<?php
	if(isset($_GET['page']) && $_GET['page'] =='receiptdetails'){?>
		<?php
		session_start(); 
		$starting=$_GET['start'];
		$ending=$_GET['end'];
		$_SESSION['datesearch']['start']=$starting;
		$_SESSION['datesearch']['ending']=$ending;
		if(isset($_GET['clear'])){
		} }?><?php
	if(isset($_GET['page']) && $_GET['page'] =='sessions'){?>
	<?php include('includes/authenticate.php'); 
    $startdate=date('Y/m/d');
    $enddate=date('Y/m/d');
    if(isset($_SESSION['datesearch'])){
        $startdate=$_SESSION['datesearch']['start'];
        $enddate=$_SESSION['datesearch']['ending'];
        unset($_SESSION['datesearch']);
    }
    $str=$_GET['i'];
    ?>
         <div class="cart-table-warp" >
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th class="drug-th" width="30%">Name</th>
                                            <th class="quy-th" width="20%">Quantity</th>
                                            <th class="size-th" width="20%">price</th>
                                            <th class="total-th" width="20%">Total prize</th>
                                            <th width="5%">#</th>
                                        </tr>
                                    </thead>
                                       
			<tbody>
                <?php $getsitems =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_receiptno`='$str' group by sale_itemcode");
                    if ($getsitems->num_rows > 0) {
                            $No=1;
                        while($gcn = mysqli_fetch_array($getsitems)){
                            $sale_itemcode = $gcn['sale_itemcode'];
                            $sale_amount = $gcn['sale_amount'];
                            $sql4 = "SELECT SUM(sale_amount) as totalprice FROM tbl_sales WHERE `sale_receiptno`='$str' and sale_itemcode='$sale_itemcode'";
                            $result4 = mysqli_query($dbconnect, $sql4);
                            $row = mysqli_fetch_assoc($result4);
                            $totalprice= $row["totalprice"];
                            $quantity=$result4->num_rows;
                            $getsname =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='00004'");
                            $gcn = mysqli_fetch_array($getsname);
                            $name=$gcn['brand_name'];
        ?>  <tr>
                                            <td><?php  $No=$No+1;?><?php echo $No;?></td>
                                            <td class="drug-col">
                                                <div class="pc-title">
                                                    <?php echo $name; ?>
                                                </div>
                                            </td>
                                            <td class="quy-col">
                                                <h4><?php  echo $quantity;?></h4>
                                            </td>
                                            <td class="size-col"><?php echo number_format($sale_amount,2); ?></td>
                                            <td class="total-col">
                                                <?php echo number_format($totalprice,2); ?></td>
                                            <td class="size-col"><a href="#">
                                            <button  class="btn btn-primary"><i class="fa fa-more"></i></button></a></td>
                                        </tr>
                                        <?php 
									}?>
                             </tbody><?php }?>
                            </table>
                            <?php 
                            $sql7 = "SELECT SUM(sale_amount) as totalprice FROM tbl_sales WHERE `sale_receiptno`='$str'";
                            $result7 = mysqli_query($dbconnect, $sql7);
                            $row7 = mysqli_fetch_assoc($result7);
                            $totalprice7= $row7["totalprice"];
                            ?>
         <div class="total-col"><h4>Total = <?php echo $totalprice7;?></h4></span></div>
	<?php }?><?php
	if(isset($_GET['page']) && $_GET['page'] =='drugdetails'){?>
	<?php
    $startdate=date('Y/m/d');
    $enddate=date('Y/m/d');
    if(isset($_SESSION['datesearch'])){
        $startdate=$_SESSION['datesearch']['start'];
        $enddate=$_SESSION['datesearch']['ending'];
        unset($_SESSION['datesearch']);
    }
        $item=$_GET['i'];
        $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'");
        $salecount=$getsalecount->num_rows;
        $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'";
        $result4 = mysqli_query($dbconnect, $sql4);
        $row = mysqli_fetch_assoc($result4);
        $total= $row["total"];
        $sql5 = "SELECT SUM(sale_amount) as mpesa FROM tbl_sales WHERE sale_modeofpayment='MPESA' AND `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'";
        $result5 = mysqli_query($dbconnect, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $mpesa= $row5["mpesa"];
        $sql7 = "SELECT SUM(sale_amount) as cash FROM tbl_sales WHERE  sale_modeofpayment='CASH' AND `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'";
        $result7 = mysqli_query($dbconnect, $sql7);
        $row7 = mysqli_fetch_assoc($result7);
        $cash= $row7["cash"];
        $other=$total-($mpesa+$cash);?>
        <div class="ibox-content p-xl printed">
                                    <table width="100%" cellspacing="0" cellpadding="4" style="font-size:20px;color:grey;border-radius:5px;">
                                        <tr>
                                            <th colspan="2">Daily Summary</th>
                                        </tr>
                                        <tr>
                                            <td>Number of Items Sold</td>
                                            <td><?php echo $salecount;?></td>
                                        </tr>
                                        <tr>
                                            <td>Cash</td>
                                            <td><?php if($cash>0){ echo $cash."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr>
                                            <td>Mpesa</td>
                                            <td><?php if($mpesa>0){echo $mpesa."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr>
                                            <td>Other payment options</td>
                                            <td><?php if($other>0){echo $other."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr style="color: green; border-top:2px solid black; margin-top: 2px;">
                                            <th>Total Amount collected</th>
                                            <th><?php if($total>0){echo $total."/=";}else{echo "0.00";}?></th>
                                        </tr>
                                    </table>
        
        </div>				
	<?php } 
    if(isset($_GET['page']) && $_GET['page'] =='searchUser'){
			$q=$_GET["q"];
			$search_char = $q;
			$startdate=date('Y/m/d');
			$enddate=date('Y/m/d');
			if(isset($_SESSION['datesearch'])){
				$startdate=$_SESSION['datesearch']['start'];
				$enddate=$_SESSION['datesearch']['ending'];
				unset($_SESSION['datesearch']);
			}
			if($search_char=='*'){
			$getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='%$search_char%' AND `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_itemcode`");
			}
			else{
				$getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `datee`>='$startdate' AND `datee`<='$enddate' AND `sale_soldby` LIKE '%$search_char%' group by `sale_receiptno`");
			}

			if ($getsdrugs->num_rows > 0) {
				
				?>
				<table width="100%" cellspacing="0" cellpadding="4" style="font-size:15px;">
				<tr>
					   <th colspan="4" style="font-size:13px; color:green;text-align:center;"><u>
						 Items sold by <?php  echo " ".$search_char;?>
					   <?php if(isset($_SESSION['datesearch']['start'])){
												echo " between dates ".$_SESSION['datesearch']['start'];
												echo " and ".$_SESSION['datesearch']['ending'];
											} else{?> today<?php }   ?>
					</u></th>
				   </tr>    
				
				<tr>
					   <th>S/No</th>
					   <th>Item Code</th>
					   <th>Item Name</th>
					   <th>Qty Sold</th>
				   </tr> 		
			   <?php $n=1;
				   while($gcn = mysqli_fetch_array($getsdrugs)){
				   $sale_itemcode = $gcn['sale_itemcode'];
				   $sql4 = "SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode'";
				   $result4 = mysqli_query($dbconnect, $sql4);
				   $row = mysqli_fetch_assoc($result4);

				   $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_itemcode`='$sale_itemcode' AND `datee`>='$startdate' AND `datee`<='$enddate'");
				   $salecount=$getsalecount->num_rows;
				   ?>
				   <tr style='border-radius:5px; margin-bottom:20px; cursor: pointer;' onclick="myFunction1('<?php echo $sale_itemcode;?>')">
					   <td><h4><?php echo $n;$n=$n+1;?></h4></td>
					   <td ><h4><?php echo $sale_itemcode; ?></h4></td>
					   <td><h4><?php echo $row['brand_name']; ?></h4></td>
					   <td><h4><?php echo $salecount; ?></h4></td>
				   </tr>
			   <?php }}else{?>
				   <div style="text-align: center;
				   font-size: 24px;
				   margin-top: 20px;
				   align-items: center;
				   color:green;
				   font-size: large;">
				   <b>User has no sales for this period</b>
				   </div>
			   <?php }  ?>
			   
	</table><?php }?>