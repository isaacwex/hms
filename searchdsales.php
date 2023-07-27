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
if($search_char=='*'){
$getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_itemcode`");
}
else{
    $getsdrugs =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate' AND `sale_itemcode` LIKE '%$search_char%' group by `sale_receiptno`");
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

       $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_itemcode`='$sale_itemcode' AND `sale_soldby`='$fullnames' AND `datee`>='$startdate' AND `datee`<='$enddate'");
       $salecount=$getsalecount->num_rows;
       ?>
       <tr style='border-radius:5px; margin-bottom:20px; cursor: pointer;' onclick="myFunction1('<?php echo $sale_itemcode;?>')">
           <td><h4><?php echo $n;$n=$n+1;?></h4></td>
           <td ><h4><?php echo $sale_itemcode; ?></h4></td>
           <td><h4><?php echo $row['brand_name']; ?></h4></td>
           <td><h4><?php echo $salecount; ?></h4></td>
       </tr>
   <?php }}else{?>
       <div
       style="text-align: center;
       font-size: 24px;
       margin-top: 20px;
       align-items: center;
       color:green;
       font-size: large;">
       <b>Drug never sold</b>
       </div>
   <?php }  ?>
   
   </table>[]