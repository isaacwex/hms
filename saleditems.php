<?php
    include('includes/authenticate.php'); 
    $startdate=date('Y/m/d');
    $enddate=date('Y/m/d');
    if(isset($_SESSION['datesearch'])){
        $startdate=$_SESSION['datesearch']['start'];
        $enddate=$_SESSION['datesearch']['ending'];
        unset($_SESSION['datesearch']);
    }
        $item=$_GET['i'];
        $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='$sidno' AND `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'");
        $salecount=$getsalecount->num_rows;
        $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE  `sale_itemcode`='$item' AND `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate'";
        $result4 = mysqli_query($dbconnect, $sql4);
        $row = mysqli_fetch_assoc($result4);
        $total= $row["total"];
        $sql5 = "SELECT SUM(sale_amount) as mpesa FROM tbl_sales WHERE `sale_soldby`='$sidno' && sale_modeofpayment='MPESA' AND `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'";
        $result5 = mysqli_query($dbconnect, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $mpesa= $row5["mpesa"];
        $sql7 = "SELECT SUM(sale_amount) as cash FROM tbl_sales WHERE `sale_soldby`='$sidno' && sale_modeofpayment='CASH' AND `sale_itemcode`='$item' AND `datee`>='$startdate' AND `datee`<='$enddate'";
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
                                            <td><?php if($cash>0){echo $cash."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr>
                                            <td>Mpesa</td>
                                            <td><?php if($mpesa>0){echo $mpesa."/=";}else{echo "0.00";}?></td>
                                        </tr>
                                        <tr>
                                            <td>Other payment options</td>
                                            <td><?php if($other>0){ echo $other."/=";}else{ echo "0.00";}?></td>
                                        </tr>
                                        <tr style="color: green; border-top:2px solid black; margin-top: 2px;">
                                            <th>Total Amount collected</th>
                                            <th><?php if($total>0){echo $total."/=";}else{echo "0.00";}?></th>
                                        </tr>
                                    </table>
        
        </div>				