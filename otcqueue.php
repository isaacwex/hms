<?php include('includes/authenticate.php'); 
	$newid=time();
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "agrovet";

    $t=$_GET['str'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	if(isset($_SESSION['busket'])){
        $mybusket=$_SESSION['busket'];
        $sql = "SELECT * FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' group by `temp_prodcode`";
        $result = $conn->query($sql);
        $_SESSION['receipt']='ready';
    }else{
        echo "<div class=\"alert alert-danger alert-dismissable\"> The busket is clear</div>"; 
    }	?>    
                    <div class="mt-5">
                        <h1>Buyer Details</h1>
                        <!-- Dropdown with payment options -->
                        <div class="form-group">
                        <label for="payment-options">Name:</label>
                        
						<input type="text" id="payment-options" placeholder="John Doe" name="batch" class="form-control" required>
                        </div>

                        <!-- Text area to show payment notes -->
                        <div class="form-group">
                        <label for="payment-notes">Payment Notes:</label>
                        <textarea class="form-control" placeholder="Please choose the payment Method from the dropdown above before proceeding" rows="5" readonly></textarea>
                        </div>
                    </div>
                        <div class="total-col"><span class="bold"><?php if(isset($_SESSION['busket'])){ ?> 
                    <div class="alert alert-success alert-dismissable"><h4>Queue amount to be paid = <?php echo $t;} ?></h4></span></div>
                   <div><?php if(isset($_SESSION['busket'])){ ?><p> <a href="newotc.php">
								<button  class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
							</a> || <span><button class="btn btn-primary" type="button" onclick="paid(<?php echo $t;} ?>)"><span class="bold"> Queue</span></button></span></p></div> 
		                 