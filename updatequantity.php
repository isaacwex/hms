<?php include('includes/authenticate.php'); 
	$newid=time();
    $servername = "192.168.1.116";
    $username = "hmsuser";
    $password = "Kenya@50";
    $dbname = "agrovet";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }						
        $id=$_POST['d'];
        $stoc=$_POST['stoc'];
        $quan=$_POST['q'];
        $mybusket=$_POST['b'];
        
        if(isset($_SESSION['cart'])):
            $count=count($_SESSION['cart']);
            $drugid=  array_column($_SESSION['cart'],'id');
            if(!in_array($id,$drugid)):
               echo '<script>alert("not found")</script>';
                // print_r($_SESSION);
                //echo 'not in array';
               header("Location: newoc.php");
            else:
                for($i=0;$i<count($drugid);$i++){
                    if($drugid[$i]===$id)
                    { 
						$qrequest=$_SESSION['cart'][$i]['quantity'];
						if($qrequest<$stoc){
							$_SESSION['cart'][$i]['quantity']= $quan;
							$getdata =mysqli_query($dbconnect,"SELECT * FROM tbl_tempsales WHERE `temp_busketid`='$mybusket' AND `temp_prodcode`='$id'");
							while($data = mysqli_fetch_array($getdata)){
							$mybusket = $data['temp_busketid'];
							$name = $data['temp_prodname'];
							$id = $data['temp_prodcode'];
							$p = $data['temp_totalprice'];
							$batch = $data['temp_batch'];
							$sql1 = "DELETE FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' AND `temp_prodcode`='$id'";
							$result = $conn->query($sql1);
							
							for ($i = 1; $i <= $quan; $i++) {
							$sql2 = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`,`temp_prodcode`,`temp_qty`,`temp_totalprice`,`temp_batch`) VALUES ('$mybusket','$name','$id','1','$p','$batch')";
							$result2 = $dbconnect->query($sql2);
							}
						   
						   
								unset($_SESSION['edit']);
								header("Location: newotc.php");
						}}else{
							unset($_SESSION['edit']);
							echo "<script>alert('quantity has a problem')</script>";
							header("Location: newotc.php");
							}
					}
					
					}  
					
					header("Location: newotc.php");
                endif;header("Location: newotc.php");	
            endif;header("Location: newotc.php");