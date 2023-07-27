<?php 
include('includes/authenticate.php'); 
$q=$_GET["q"];
$servername = "192.168.1.116";
$username = "hmsuser";
$password = "Kenya@50";
$dbname = "agrovet";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

                                $search_char = $q;
                                $startdate=date('Y/m/d');
								$enddate=date('Y/m/d');
								if(isset($_SESSION['datesearch'])){
									$startdate=$_SESSION['datesearch']['start'];
									$enddate=$_SESSION['datesearch']['ending'];
									unset($_SESSION['datesearch']);
								}
$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate' AND `sale_receiptno` LIKE '%$search_char%' group by `sale_receiptno`");if ($getcountyname->num_rows > 0) {?>
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
       <b>Invoice not found</b>
       </div>
   <?php }
   ?>
   
   </table>