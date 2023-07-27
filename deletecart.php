<?php include('includes/authenticate.php'); 
	$newid=time();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agrovet";
	

    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
								

if(isset($_GET['nil'])){
    if(!isset($_SESSION['busket'])){
    echo "<div class=\"alert alert-danger alert-dismissable\"> The busket is clear</div>";exit;}  
}else{
        $id=$_GET['i'];
        $mybusket=$_GET['n'];
    
        $drugid=array();
        
        if(isset($_SESSION['cart'])):
            $count=count($_SESSION['cart']);
            $drugid=  array_column($_SESSION['cart'],'id');
            if(!in_array($id,$drugid)):
            $_SESSION['cart'][$count]=array
                (
            'id'=>$id,
            'quantity'=>1,
            );
            // print_r($_SESSION);
            //echo 'not in array';
            else:
                $itemIdToDelete = $id;
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] == $itemIdToDelete) {
                        unset($_SESSION['cart'][$key]);
                        $sql = "DELETE FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' AND `temp_prodcode`='$id'";
                        $result = $conn->query($sql);
                        if (count($_SESSION['cart']) == 0) {
                            header("Location: sess.php");
                            break;
                        }
                        header("Location:newotc.php");
                        break;
                    }
                }
            endif;		
            else: 
            $_SESSION['cart'][0]=array(
            'id'=>$id,
            'quantity'=>1,
			'cartid'=>$newid,
            );
			
												
            // print_r($_SESSION);echo 'new drug';	 
            endif;              
                $finalcount=count($_SESSION['cart']);
                $_SESSION['bagtotal']=$finalcount;
                //echo $_SESSION['bagtotal'];
            ?><?php } ?>