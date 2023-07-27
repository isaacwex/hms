<?php include('includes/authenticate.php'); 
        $inve_id=$_POST['inve_id'];
        $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_id`='$inve_id'");
        $rrow2 = mysqli_fetch_array($name);
        $inve_drugcode = $rrow2['inve_drugcode'];
        $inve_postedqty = $rrow2['inve_qty'];
        $inve_qty=$_POST['quantity'];
        if($inve_postedqty>=$inve_qty){
                       
                        if(!isset($_SESSION['request'])){   
                        $inve_id=$_POST['requesting'];
                        $requesterid=$_POST['requestme'];}else{
                        $inve_id=$_SESSION['request'];
                        $requesterid=$_SESSION['requester'];
                        }
                        $req_expirydate = date('Y-m-d', strtotime('+7 days'));
                    if(!isset($_SESSION['request'])){
                        $_SESSION['request']=$inve_id;
                        $_SESSION['requester']=$requesterid;
                    }
                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode'");
                    $rrow2 = mysqli_fetch_array($name);
                    $rrowname = $rrow2['brand_name'];

                
                
                    if ($name->num_rows > 0) {
                        $sql = "INSERT INTO `tbl_materialsrequest_temp` (`tray_id`, `tray_deptcode`, `tray_itemcode`, `tray_requestedby`, `tray_qty`, `tray_expirydate`, `tray_dispatchedby`) VALUES (
                        '$inve_id',
                        '$user_l',
                        '$inve_drugcode',
                        '$sid',
                        '$inve_qty',
                        '$req_expirydate',
                        'pending')";
                        $result = $dbconnect->query($sql);?>
                        <?php // header("Location: materialrequest.php");
                        echo $inve_postedqty;
                    }else{
                        echo '<script>alert("their is a problem with the request")</script>';
                        header("Location: materialrequest.php");
                        
                    }
                }else{
                    $lessquantity="<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the stock quantity is not enough </div>";
                     
                }