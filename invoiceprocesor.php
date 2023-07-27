<?php include('includes/authenticate.php'); 
	    $inve_drugcode=$_POST['drug'];
        $inve_drugname=$_POST['name'];
        $inve_qty=$_POST['quantity'];
        $inve_purchaseprice=$_POST['price'];
        $inve_time=$_POST['time'];
        $inve_batchno=$_POST['batch'];
        $inve_expirydate=$_POST['edate'];
        if(!isset($_SESSION['invoice'])){   
        $inve_id=$_POST['invoice'];
        $inve_invoiceno=$_POST['invoice'];
        $supplierid=$_POST['supplier'];}else{
        $inve_id=$_SESSION['invoice'];
        $inve_invoiceno=$_SESSION['invoice'];
        $supplierid=$_SESSION['supplier'];
        }
    if(!isset($_SESSION['invoice'])){
        $_SESSION['invoice']=$inve_id;
        $_SESSION['supplier']=$supplierid;
    }
    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode '");
    $rrow2 = mysqli_fetch_array($name);
    $rrowname = $rrow2['brand_name'];
    if ($name->num_rows > 0) {

        $sql = "INSERT INTO `tbl_inventorytemp`(`inve_drugcode`,`inve_drugname`,`inve_qty`, `inve_purchaseprice`, `inve_time`, `inve_batchno`, `inve_expirydate`, `inve_invoiceno`, `supplierid`) VALUES (
        '$inve_drugcode',
        '$rrowname',
        '$inve_qty',
        '$inve_purchaseprice',
        '$inve_time',
        '$inve_batchno',
        '$inve_expirydate',
        '$inve_invoiceno',
        '$supplierid')";
        $result = $dbconnect->query($sql);
        header("Location: add-inventory.php");
    }else{
        echo '<script>alert("Your Drug Code is not found in the data base. look for the exact matching code and try again")</script>';
        header("Location: add-inventory.php");
    }