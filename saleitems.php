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
                                    <table class="table" bgcolor="White" width="100%" cellspacing="0" cellpadding="4" >
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th class="drug-th" width="30%">Name</th>
                                            <th class="quy-th" width="20%">Quantity</th>
                                            <th class="size-th" width="20%">price</th>
                                            <th class="total-th" width="20%">Total prize</th>
                                           
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
                            $getsname =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode'");
                            $gcn = mysqli_fetch_array($getsname);
                            $name=$gcn['brand_name'];
        ?>  <tr>
                                            <td><?php  $No=$No+1;?><?php echo $No;?></td>
                                            <td class="drug-col">
                                                    <?php echo $name; ?>
                                            </td>
                                            <td class="quy-col">
                                                <h4><?php  echo $quantity;?></h4>
                                            </td>
                                            <td class="size-col"><?php echo number_format($sale_amount,2); ?></td>
                                            <td class="total-col">
                                                <?php echo number_format($totalprice,2); ?></td>
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