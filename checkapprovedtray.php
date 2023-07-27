<?php include('includes/authenticate.php'); ?>
<?php
	$item=$_GET['item'];
    $tray=$_GET['tray'];
    $result2 = mysqli_query($dbconnect,"UPDATE `tbl_dept_trays` SET `tray_dispatchedby`='approved' WHERE `tray_id`='$tray' AND `tray_itemcode`='$item'");
	?>