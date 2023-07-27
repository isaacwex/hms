<?php
$q=$_GET["q"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrovet";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_char = $q;
$sql = "SELECT * FROM `tbl_drugs` WHERE `brand_name` LIKE '$search_char%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		
        
		$vital_code = $row['image_url'];
	    $vital_name = $row['brand_name'];
		$vital_unit = $row['drugitem_code'];?>
									
		<div style='padding:10px; font-size: 100%;align-content:right;text-align:center;cursor: pointer;' class='col-lg-2' onclick="myFunction('<?php echo $vital_name; ?>', <?php echo $vital_unit; ?>)">
		<?php echo '<img src="drug_imgs/drug.jpg" width="80" height="80"><br>';
		echo '<span >'.$vital_name.'</span>';
		echo '</div>';
								

  }
} else {
    echo "No Sugestions";
}

$conn->close();

?>
