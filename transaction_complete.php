<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrovet";
$t2=$_GET['str'];
 $busk=$_GET['busk'];
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
session_start();    
$mybusket=$busk;
$sql1 = "DELETE FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket'";
$result = $conn->query($sql1);

unset($_SESSION['cart']);
unset($_SESSION['busket']);
unset($_SESSION['receipt']);
unset($_SESSION['edit']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Transaction Complete</title>
	<style>
        .check {
			display: block;
            margin: auto;
            width: 200px;
            height: 200px;
            background-image: url('giphy.gif');
            background-size: contain;
            background-repeat: no-repeat;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            animation-duration: 1s;
		}
		.message {
			text-align: center;
			font-size: 24px;
			margin-top: 20px;
		}

		.buttons {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		.buttons button {
			margin: 0px 10px;
			font-size: 18px;
			padding: 10px 20px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="check"></div>
	<div style="text-align: center;
                font-size: 24px;
                margin-top: 20px;
                align-items: center;
                font-size: large;">
                Transaction Complete, Paid <?php echo $t2."/=";?>
    </div>
	<div class="buttons">
        <button onclick="home()" class="btn btn-primary">New Order</button>
        <button onclick="printDiv('printableArea')" class="btn btn-primary"><i class="fa fa-print"></i> Print Receipt</button>
	</div>
</body>
</html>