<?php
    include('includes/authenticate.php'); 
	$t2=$_GET['str'];
	$newid=time();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agrovet";
    $t=$_GET['str'];
    $paymentmode=$_GET['payment'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	if(isset($_SESSION['busket'])){
        $mybusket=$_SESSION['busket'];
                        $sql4 = "UPDATE `tbl_tempsales` SET `buyer`='$paymentmode' WHERE `temp_busketid`='$mybusket'";
                        $result4 = $conn->query($sql4);
                    }
						
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
               <?php echo $t2."/=";?> Queue Success 
    </div>
	<div class="buttons">
        <button onclick="home1()" class="btn btn-primary">New Order</button>
	</div>
</body>
</html>