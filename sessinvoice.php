<?php
        include('includes/authenticate.php'); 
        if(isset($_GET['page']) && $_GET['page'] == 'invoice') {
            $mybusket=$_SESSION['invoice'];
            $sql1 = "DELETE FROM `tbl_inventorytemp` WHERE `inve_invoiceno`='$mybusket'";
            $result = $dbconnect->query($sql1);
            unset($_SESSION['invoice']);
            unset($_SESSION['supplier']);
            header("Location: add-inventory.php");
        }
        if(isset($_GET['page']) && $_GET['page'] == 'request') {
            $mybusket=$_SESSION['request'];
            $sql1 = "DELETE FROM `tbl_materialsrequest_temp` WHERE `tray_id`='$mybusket'";
            $result = $dbconnect->query($sql1);
            unset($_SESSION['request']);
            unset($_SESSION['requester']);
            
           header("Location: materialrequest.php?reqdeptcode=$requestingdeptcode;");
        }
?>