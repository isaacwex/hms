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
        $name=$_GET['n'];
        $img=$_GET['img'];
        $qua=1;

    if(isset($_SESSION['busket'])){
        $mybusket=$_SESSION['busket'];
        $sql = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`, `temp_prodcode`,`temp_totalprice`) VALUES ('$mybusket','$name','$id','784')";
        $result = $conn->query($sql);
    }else{
        $_SESSION['busket']=$newid;
        $mybusket=$_SESSION['busket'];
        $sql = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`, `temp_prodcode`,`temp_totalprice`) VALUES ('$mybusket','$name','$id','784')";
        $result = $conn->query($sql);
    }	
        $drugid=array();
        
        if(isset($_SESSION['cart'])):
            $count=count($_SESSION['cart']);
            $drugid=  array_column($_SESSION['cart'],'id');
            if(!in_array($id,$drugid)):
            $_SESSION['cart'][$count]=array
                (
            'id'=>$id,
            'name'=>$name,
            'img'=>$img,
            'quantity'=>1,
            'price'=>70,
            );
            // print_r($_SESSION);
            //echo 'not in array';
			
            else:
                for($i=0;$i<count($drugid);$i++){
                    if($drugid[$i]==$id)
                    { 
                        $_SESSION['cart'][$i]['quantity']+= $qua;
                    }
                    }  
            endif;		
            else: 
            
            $_SESSION['cart'][0]=array(
            'id'=>$id,
            'name'=>$name,
            'img'=>$img,
            'quantity'=>1,
            'price'=>70,
			'cartid'=>$newid,
            );
			
												
            // print_r($_SESSION);echo 'new drug';	 
            endif;              
                $finalcount=count($_SESSION['cart']);
                $_SESSION['bagtotal']=$finalcount;
                //echo $_SESSION['bagtotal'];
            ?><?php } ?>
            <div class="cart-table-warp">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="drug-th">Name</th>
                                            <th class="quy-th">Quantity</th>
                                            <th class="size-th">price</th>
                                            <th class="total-th">Total prize</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                        <?php if(!empty($_SESSION['cart'])){
            $total=0;?>
			<tbody>
			<?php 
			$No=0;
			$newid=time();
												
            foreach($_SESSION['cart'] as $key => $drug){
					
											$dn=$drug['name'];
											$dc=$drug['id'];
											$quantity=$drug['quantity'];
											$price=$drug['price'];
											
											
                ?>
                                        
                                    
                                        <tr>
                                            <td><?php  $No=$No+1;?><?php echo $No;?></td>
                                            <td class="drug-col">
                                                
                                                <div class="pc-title">
                                                    <h4><?php echo $drug['name']; ?></h4>
                                                </div>
                                            </td>
                                            <script>
                                                function add(){
                                                    var r=document.getElementById("qu").innerHTML="";
                                                    r=r++;
                                                    document.getElementById("qu").innerHTML=r;
                                                }
                                                function sub(){
                                                    var r=document.getElementById("qu").innerHTML="";
                                                    r=r--;
                                                    document.getElementById("qu").innerHTML=r;
                                                }
                                            </script>
                                            <td class="quy-col">
                                                <div class="quantity">
                                                   <div class="pro" id="qu"> 
                                                      
                                                    <?php echo $drug['quantity']; ?>
                                                        
                                                </div>
                                                </div>
                                            </td>
                                            <td class="size-col"><h4><?php echo $drug['price']; ?></h4></td>
                                            <td class="total-col"><h4>
                                                <?php echo number_format($drug['quantity']*$drug['price'],2); ?></h4></td>
                                            <td class="size-col"><a href="cart.php?action=delete&id=<?php echo  $drug['id'];?>&amnt=<?php echo number_format($drug['quantity']*$drug['price'],2); ?>">
                                            <i class="fa fa-trash"></i></a></td>
											
                                        </tr>
                                        <?php 
                                    $total=$total+($drug['quantity']*$drug['price']);
									
									}
                 }
              ?>
                                    </tbody>
                                </table>
                <div class="total-col"><span class="bold"><?php if(isset($_SESSION['busket'])){ ?> 
                    <div class="alert alert-success alert-dismissable">Total = <?php echo $total;} ?></span></div>
                   <div><?php if(isset($_SESSION['busket'])){ ?><p> <span><button class="btn btn-primary" type="button" onclick="checkout(<?php echo $total;} ?>)"><span class="bold"> Checkout</span></button></span></p></div> 
                    
                    
               