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
$sql = "SELECT * FROM `tbl_drugs` WHERE `brand_name` LIKE '%$search_char%'";
$result = $conn->query($sql);
if($search_char=='out56'){
	$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_qty` > 0 limit 50");	
}else{
	$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE  `inve_drugcode` LIKE '%$search_char%' OR `inve_drugname` LIKE '%$search_char%' AND `inve_qty` > 0 limit 50");	
}
if ($getcountyname->num_rows > 0) {			
	while($gcn = mysqli_fetch_array($getcountyname)){
		$inve_qty = $gcn['inve_qty'];
		$inve_batchno = $gcn['inve_batchno'];
		$inve_drugcode = $gcn['inve_drugcode'];
		$inve_time = $gcn['inve_time'];
		$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$inve_drugcode' and `scheme`='001'");$rrow = mysqli_fetch_array($price);
		$rrowprice = $rrow['price'];
		$name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
		?>
		<div class="row" style='border-radius:5px;background-color: #e7eaec;margin-bottom:2px; font-size: 100%;cursor: pointer;' onclick="myFunction('<?php echo $rrowname; ?>', '<?php echo $inve_drugcode; ?>', '<?php echo $inve_batchno; ?>',<?php echo $rrowprice; ?>)"> <?php 
									echo '<div class="col-lg-2" style="border-radius:5px; background-image: url(drug_imgs/drug.jpg);background-size: cover;background-position: center;"><br/><br/><br/><br/></div>';
									echo '<div class="col-lg-6"><h4 style="font-size: 15px;" padding:3px;>'.$rrowname.'</h4>';
									echo '<span style="border-radius:5px;" class="badge badge-primary"><p style ="font-size: 13px; border:1px";background-color: #ff00ff; >'.$rrowprice.'/=</p></span></div>';
									echo '<div class="col-lg-4">
									<h6 style="font-size: 12px;color:blue; " padding:3px; ><i class="fa fa-check"></i> Batch No. '.$inve_batchno.'</h6>';
									echo '<p style ="background-color: #ff0000"; font-size: 13px;color:blue; " > <h6><i class="fa fa-check"></i>In Stock <i>'.$inve_qty.'</i></h6></p>
									<p style ="font-size: 13px;color:blue; " ><h6><i class="fa fa-check"></i>Expiry Date '.$inve_time.'</h6></p>									
									</div>';
									echo '</div>';
								}}else{?>
								<div style="text-align: center;
									font-size: 24px;
									margin-top: 20px;
									align-items: center;
									font-size: large;">
									Out of stock
								</div>
								<?php }
								?>
																
							</div>
<?php
$conn->close();
?>