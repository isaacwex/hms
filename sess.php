<?php
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrovet";

 
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
session_start();    
$mybusket=$_SESSION['busket'];
$sql1 = "DELETE FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket'";
$result = $conn->query($sql1);

unset($_SESSION['cart']);
unset($_SESSION['busket']);
unset($_SESSION['receipt']);
unset($_SESSION['edit']);
if(isset($_GET['r'])){
	header("Location: otcbill.php");
}
	header("Location: newotc.php");
	
exit;
?>