<?php
session_start();
$productid=array();
$id=$_GET['item'];
$q=$_GET['quantity'];
$price=$_GET['price'];
$name=$_GET['name'];
$img=$_GET['image'];
$seller=$_GET['seller'];
if(isset($_GET['party'])){
//party	
	 if(empty($id)):
 	header("Location.index.php");
 else:
 if(isset($_SESSION['party'])):
	$count=count($_SESSION['party']);
	$productid=  array_column($_SESSION['party'],'id');
	if(!in_array($id,$productid)):
	$_SESSION['party'][$count]=array
		(
	 'id'=>$id,
	 'quantity'=>$q,
	 'name'=>$name,
	 'price'=>$price,
	'img'=>$img,
	'seller'=>$seller
	 );
	// print_r($_SESSION);
	//echo 'not in array';
	else:
		for($i=0;$i<count($productid);$i++){
			if($productid[$i]==$id)
			{ 
				$_SESSION['party'][$i]['quantity']+= $q;
				//print_r($_SESSION);echo 'many simillar id';
				}
			 }  
	endif;		
 else: 
	$_SESSION['party'][0]=array(
	 'id'=>$id,
	 'quantity'=>$q,
	 'name'=>$name,
	 'price'=>$price,
	  'img'=>$img,
	'seller'=>$seller		
	 );
	// print_r($_SESSION);echo 'new product';	 
 endif;
 endif;
$partycount=count($_SESSION['party']);
$_SESSION['partytotal']=$partycount;
//echo $_SESSION['bagtotal'];

//end party
}
else{
 if(empty($id)):
 	header("Location.index.php");
 else:
 if(isset($_SESSION['cart'])):
	$count=count($_SESSION['cart']);
	$productid=  array_column($_SESSION['cart'],'id');
	if(!in_array($id,$productid)):
	$_SESSION['cart'][$count]=array
		(
	 'id'=>$id,
	 'quantity'=>$q,
	 'name'=>$name,
	 'price'=>$price,
	'img'=>$img,
	'seller'=>$seller
	 );
	// print_r($_SESSION);
	//echo 'not in array';
	else:
		for($i=0;$i<count($productid);$i++){
			if($productid[$i]==$id)
			{ 
				$_SESSION['cart'][$i]['quantity']+= $q;
				//print_r($_SESSION);echo 'many simillar id';
				}
			 }  
	endif;		
 else: 
	$_SESSION['cart'][0]=array(
	 'id'=>$id,
	 'quantity'=>$q,
	 'name'=>$name,
	 'price'=>$price,
	  'img'=>$img,
	'seller'=>$seller
	 );
	// print_r($_SESSION);echo 'new product';	 
 endif;
 endif;
$finalcount=count($_SESSION['cart']);
$_SESSION['bagtotal']=$finalcount;
//echo $_SESSION['bagtotal'];
}
if(isset($_GET['searchbox'])){ 
    $h=$_GET['searchbox'];
	?>
		<form class="header-search-form" id="myform" action="all.php" method="POST">
		<input type="hidden" name="searchbox" value="<?php echo $h;?>">
		<div style="text-align: center;height: 100%;color:#ffffff;padding-top: 200px;background-color:#282828;  border-radius: 5px;" >
			Successfully Added to cart<br/>
			<button type="submit" style="text-align: center; background-color: #f51167;border-radius: 5px;padding: 20px;">Success</button></div>
        </form>

	<?php
}
else{?>
	<script>
	function baac(){
			history.back();}
</script>
<div style="text-align: center;height: 100%;padding-top: 200px; color:#ffffff;background-color:#282828;  border-radius: 5px;" >
		Successfully Added to cart<br/>
	<button type="submit" onclick="javascript:baac();" style="text-align: center; background-color: #f51167;border-radius: 5px;padding: 20px;">Continue</button></div>


<?php }?>