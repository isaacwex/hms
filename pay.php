<?php include('includes/authenticate.php'); 
	$newid=time();
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "agrovet";
    $t=$_GET['str'];
    $mybusket=$_GET['busk'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	if(isset($mybusket)){
        $sql = "SELECT * FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' group by `temp_prodcode`";
        $result = $conn->query($sql);
        $_SESSION['receipt']='ready';
    }else{
        echo "<div class=\"alert alert-danger alert-dismissable\"> The busket is clear</div>"; 
    }	?>    
                    <div class="mt-5">
                        <h1>Payment Options</h1>
                        <!-- Dropdown with payment options -->
                        <div class="form-group">
                        <label for="payment-options">Payment Options:</label>
                        <select class="form-control" id="payment-options" name="paymentmode">
                            <option value="CASH">Cash</option>
                            <option value="MPESA">Mpesa</option>
                            <option value="CREDIT">Credit</option>
                            <option value="VISA">Visa</option>
                            <option value="MASTERCARD">Master Card</option>
                            <option value="OTHERS">Others</option>
                        </select>
                        </div>

                        <!-- Text area to show payment notes -->
                        <div class="form-group">
                        <label for="payment-notes">Payment Notes:</label>
                        <textarea class="form-control" placeholder="Please choose the payment Method from the dropdown above before proceeding" rows="5" readonly></textarea>
                        </div>
                    </div>
                        <div class="total-col"><span class="bold"><?php if(isset($_SESSION['busket'])){ ?> 
                    <div class="alert alert-success alert-dismissable"><h4>Total amount to be paid = <?php echo $t;} ?></h4></span></div>
                   <div><?php if(isset($mybusket)){ ?><p>  <span><button class="btn btn-primary" type="button" onclick="paid(<?php echo $t; ?>,<?php echo $mybusket;?>)"><span class="bold"> Pay</span></button></span></p><?php } ?></div> 
		                 