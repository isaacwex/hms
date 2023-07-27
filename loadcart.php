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
        $p=$_GET['p'];
        $batch=$_GET['batch'];
        $qua=1;
		$stock=$_GET['stock'];

    if(isset($_SESSION['busket'])){
        $mybusket=$_SESSION['busket'];
        $sql = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`, `temp_prodcode`,`temp_qty`,`temp_totalprice`,`temp_batch`) VALUES ('$mybusket','$name','$id','1','$p','$batch')";
        $result = $conn->query($sql);
    }else{
        $_SESSION['busket']=$newid;
        $mybusket=$_SESSION['busket'];
        $sql = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`, `temp_prodcode`,`temp_qty`,`temp_totalprice`,`temp_batch`) VALUES ('$mybusket','$name','$id','1','$p','$batch')";
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
            'price'=>$p,
            'stoc'=>$stock,
            );
            // print_r($_SESSION);
            //echo 'not in array';
			
            else:
                for($i=0;$i<count($drugid);$i++){
                    if($drugid[$i]==$id)
                    { 
						$qrequest=$_SESSION['cart'][$i]['quantity'];
						if($qrequest<$stock){
							$_SESSION['cart'][$i]['quantity']+= $qua;
						}else{
							$sql31 = "DELETE FROM `tbl_tempsales` WHERE `temp_id` = LAST_INSERT_ID()";
							$result31 = $conn->query($sql31);
							$size="<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the stock quantity is not enough </div>";
						}
                    }
                    }  
            endif;		
            else: 
            $_SESSION['cart'][0]=array(
            'id'=>$id,
            'name'=>$name,
            'img'=>$img,
            'quantity'=>1,
            'price'=>$p,
            'stoc'=>$stock,
			'cartid'=>$newid,
            );								
            // print_r($_SESSION);echo 'new drug';	 
            endif;              
                $finalcount=count($_SESSION['cart']);
                $_SESSION['bagtotal']=$finalcount;
                //echo $_SESSION['bagtotal'];
            ?><?php } 
			if(isset($size)){
				echo $size;
				$qrequest=0;
			}
			
			
			?>
			
            <div class="cart-table-warp" >
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th class="drug-th" width="30%">Name</th>
                                            <th class="quy-th" width="20%">Quantity</th>
                                            <th class="size-th" width="20%">price</th>
                                            <th class="total-th" width="20%">Total prize</th>
                                            <th width="5%">#</th>
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
											$stoc=$drug['stoc'];
                ?>
                                        <tr>
                                            <td><?php  $No=$No+1;?><?php echo $No;?></td>
                                            <td class="drug-col">
                                                
                                                <div class="pc-title">
                                                    <h4><?php echo $drug['name']; ?></h4>
                                                </div>
                                            </td>
                                            <td class="quy-col">
                                          <?php if(!isset($_SESSION['edit'])){ 
                                            $_SESSION['edit'] = array(
                                                'id' => 'nil',
                                            );
                                          }
                                            if($_SESSION['edit']['id']===$dc){	?>
                                            <form method="post" action="newotc.php">
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                    <input style="background-color: #f8f8f8; border: 3px solid #1ab394; padding: 4px 4px; margin-left: 4px ; box-sizing: border-box;" type="number"  name="q" min="1" max="100000" value="<?php echo $quantity;?>" > 
                                                    <input type="hidden"  name="d" value="<?php echo $dc;?>"/>
                                                    <input type="hidden"  name="stoc" value="<?php echo $stoc;?>"/>
                                                   <input type="hidden" name="b" value="<?php echo $_SESSION['busket'];?>"/>
                                                    </div>
                                                    <div class="col-sm-5"> 
                                                   <button style=" border: 3px solid #1ab394; padding: 4px 4px; margin-right: 4px 0; box-sizing: border-box; color: white;background-color: #1ab394;" name="update" type="submit" ><i class="fa fa-check"></i></button>
                                                    </div>  
                                                </div>
                                                </form>
                                                
                                          <?php  }
                                    else{ ?><div class="quantity" style="display: flex;flex-direction: row; justify-content:space-between;align-items: center;">
                                                   <div class="pro" id="qu"> 
                                                    <?php echo $drug['quantity']; ?>
                                                    </div>
                                                    <div style="margin-right:0px;font-size: 18px;cursor: pointer;"><a href="quantitysess.php?q=<?php echo $dc;?>"><i class="fa fa-edit"></i></a></div>  
                                                </div>
                                            
                                            <?php  } ?>
                                            </td>
                                            <td class="size-col"><h4><?php echo number_format($drug['price'],2); ?></h4></td>
                                            <td class="total-col"><h4>
                                                <?php echo number_format($drug['quantity']*$drug['price'],2); ?></h4></td>
                                            <td class="size-col"><a href="deletecart.php?i=<?php echo $drug['id'];?>&n=<?php echo $_SESSION['busket'];?>">
                                            <button  class="btn btn-primary"><i class="fa fa-trash"></i></button></a></td>
                                        </tr>
                                        <?php 
                                    $total=$total+($drug['quantity']*$drug['price']);
									}?>
                             </tbody><?php }?>
                            </table>
         <div class="total-col"><span class="bold"><?php if(isset($_SESSION['busket'])){ ?> 
        <div class="alert alert-success alert-dismissable"><h4>Total = <?php echo $total;} ?></h4></span></div>
    <div><?php if(isset($_SESSION['busket'])){ ?><p class="pull-left"><a href="sess.php">
								<button  class="btn btn-primary"><i class="fa fa-trash"></i> Empty list</button>
							</a></p>
							<p class="pull-right"> <span><button class="btn btn-primary" type="button" onclick="checkout(<?php echo $total; ?>)"><span class="bold"><i class="fa fa-arrow-right"></i> Queue for Billing </span></button></span></p><?php } ?></div> 