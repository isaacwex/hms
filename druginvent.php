<?php 
include('includes/authenticate.php'); 
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
$sql = "SELECT * FROM `tbl_drugs` WHERE `brand_name` LIKE '%$search_char%'";
$result = $conn->query($sql);

$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `brand_name` LIKE '%$search_char%' limit 10");

if ($getcountyname->num_rows > 0) {			
	
		?>
		
		
        <select name="drug" class="form-control" required>
        <?php	
         while($gcn = mysqli_fetch_array($getcountyname)){
		        $drugitem_code = $gcn['drugitem_code'];
		        $brand_name = $gcn['brand_name'];?>
              <option value="<?php echo $row['drugitem_code'];?>"> <?php echo $brand_name;?></option>
       <?php } ?>
          </select>
	<?php }else{
		echo "The Inventory is empty";
	}
	

$conn->close();
?>