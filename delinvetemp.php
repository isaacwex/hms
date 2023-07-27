<?php
include('includes/authenticate.php');
$r=$_GET['id'];
$sql=mysqli_query($dbconnect,"DELETE FROM `tbl_inventorytemp` WHERE `inve_id`='$r'");
header("location:add-inventory.php");
?> 