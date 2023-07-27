<?php include('includes/authenticate.php'); 
if(isset($_POST['update'])){
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
							if($quan<$stoc){
								$_SESSION['cart'][$i]['quantity']= $quan;
								$getdata =mysqli_query($dbconnect,"SELECT * FROM tbl_tempsales WHERE `temp_busketid`='$mybusket' AND `temp_prodcode`='$id'");
								while($data = mysqli_fetch_array($getdata)){
								$mybusket = $data['temp_busketid'];
								$name = $data['temp_prodname'];
								$id = $data['temp_prodcode'];
								$p = $data['temp_totalprice'];
								$batch = $data['temp_batch'];
								$sql1 = "DELETE FROM `tbl_tempsales` WHERE `temp_busketid`='$mybusket' AND `temp_prodcode`='$id'";
								$result = $dbconnect->query($sql1);
								
								for ($i = 1; $i <= $quan; $i++) {
								$sql2 = "INSERT INTO `tbl_tempsales`( `temp_busketid`, `temp_prodname`,`temp_prodcode`,`temp_qty`,`temp_totalprice`,`temp_batch`) VALUES ('$mybusket','$name','$id','1','$p','$batch')";
								$result2 = $dbconnect->query($sql2);
								}	unset($_SESSION['edit']);
									header("Location: newotc.php");
							}}else{
								unset($_SESSION['edit']);
								$size="<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Seems the stock quantity is not enough </div>";
								}
						}
						
						}  
						
						header("Location: newotc.php");
					endif;header("Location: newotc.php");	
				endif;header("Location: newotc.php");
		
		}
?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Over the Counter - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
		function showResult(str) {
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdrug.php?q=out56");
			xmlhttp.send();
			}else{
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdrug.php?q="+str,true);
			xmlhttp.send();
		}}/// Define an array to store the cart items
		</script>
		<script>
			function callPHPFunction(item) {
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "quantitysess.php?q="+item, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
				// Handle the response from the PHP function here
					location.reload();
				}
			};
			xhr.send();
			}
		</script>

		<script>
			function myFunction(name,id,b,p,s) {
			if (id.length==0) {
				document.getElementById("cart").innerHTML="";
				document.getElementById("cart").style.border="0px";
				return;
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","loadcart.php?i="+id+"&n="+name+"&batch="+b+"&stock="+s+"&p="+p+"&img=drug.jpg");
			xmlhttp.send();
			}
		</script>
		<script>
			function openedit(drugid,cart,name) {
				// Get the modal element
				var modal = document.getElementById("myModal");
				// Set the modal content
				var nameElement = document.getElementById("name");
				nameElement.innerText = name;
				var cart2element = document.getElementById("cart2");
				cart2element.value = cart;
				var drugid2 = document.getElementById("drugid2");
				drugid2.value = drugid;
				// Show the modal
				$(modal).modal("show");
			}
		</script>
		<script>
			function checkout(str) {
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","otcqueue.php?str="+str);
			xmlhttp.send();
			}
		</script>
		<script>
			function transdone(str) {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","transaction_complete.php?str="+str);
			xmlhttp.send();
			}
		</script>
		<script>
			function home(){
				window.location.href = "sess.php";
			}
		</script>
		<script>
			function home1(){
				window.location.href = "newotc.php";
			}
		</script>
		<script>
			function paid(str) {
				var input = document.getElementById("payment-options");
				var inputValue = input.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				transdone(str);
				}
			}
			xmlhttp.open("GET","otcsubmit.php?str="+str+"&payment="+inputValue);
			xmlhttp.send();
			}
		</script>
		<script>
			function start() {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","loadcart.php?nil=nil");
			xmlhttp.send();
			}
		</script>
		<script type="text/javascript">

		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			window.location.replace("sess.php");
		}
</script>
</head>

<body onload="start()">
    <div id="wrapper">
    <!-- Navigation -->
	<?php include 'includes/sidebar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-sm-12">
						<p class="pull-right">
							
							
						</div>				
					</div>				
					<div class="col-sm-7">					
						
					 
					 <div class="ibox float-e-margins">
                        <div class="form-group">
							<input type="text" size="30" onkeyup="showResult(this.value)" placeholder="Search Drug" class="form-control">
							
						</div>	
                        <div class="ibox-content" style="overflow:auto;height:100vh; -ms-overflow-style: none; scrollbar-width: none;">
							
                           <div id="livesearch" >
							<?php 
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_qty`>0 limit 50");if ($getcountyname->num_rows > 0) {			
								while($gcn = mysqli_fetch_array($getcountyname)){
									$inve_qty = $gcn['inve_qty'];
									$inve_batchno = $gcn['inve_batchno'];
									$inve_drugcode = $gcn['inve_drugcode'];
									$inve_time = $gcn['inve_expirydate'];
									$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$inve_drugcode' AND `scheme`='001'");$rrow = mysqli_fetch_array($price);
									$rrowprice = $rrow['price'];
									$name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
									?>
									<div class="row" style='border-radius:5px;background-color: #e7eaec;margin-bottom:2px; font-size: 100%;cursor: pointer;' onclick="myFunction('<?php echo $rrowname; ?>', '<?php echo $inve_drugcode; ?>', '<?php echo $inve_batchno; ?>',<?php echo $rrowprice; ?>,<?php echo $inve_qty; ?>)"> 
									<?php 
									echo '<div class="col-sm-2" style="border-radius:5px; background-image: url(drug_imgs/drug.jpg);background-size: cover;background-position: center;"><br/><br/><br/><br/></div>';
									echo '<div class="col-sm-6"><h4 style="font-size: 15px;" padding:3px;>'.$rrowname.'</h4>';
									echo '<span style="border-radius:5px;" class="badge badge-primary"><p style ="font-size: 13px; border:1px";background-color: #ff00ff; >'.$rrowprice.'/=</p></span></div>';
									echo '<div class="col-sm-4">
									<h6 style="font-size: 12px;color:blue; " padding:3px; ><i class="fa fa-check"></i> Batch No. '.$inve_batchno.'</h6>';
									echo '<p style ="background-color: #ff0000"; font-size: 13px;color:blue; " > <h6><i class="fa fa-check"></i>In Stock <i>'.$inve_qty.'</i></h6></p>
									<p style ="font-size: 13px;color:blue; " ><h6><i class="fa fa-check"></i>Expiry Date '.$inve_time.'</h6></p>									
									</div>';
									echo '</div>';
								}}else{
									echo "The Drug is out of stock";
								}
								?>
																
							</div>
						</div>
					 </div>
					 
					</div>
					
					
					<div class="col-sm-5" >					
						<div class="ibox float-e-margins">
                        <div class="ibox-title"  >
                           <h5>Drug Busket</h5>
							<p class="pull-right"><a href="sess.php">
								<button  class="btn btn-primary"><i class="fa fa-trash"></i> Clear list</button>
							</a></p>
						</div>
                        <div class="ibox-content" style="overflow:auto;height:75vh; -ms-overflow-style: none; scrollbar-width: none;">
						<?php 
							if(isset($size)){
								echo $size;
								$qrequest=0;
							}
						?>
                           <div class="row" id="cart">
						   <div class="alert alert-danger alert-dismissable"> The busket is clear</div>
							</div>
							
						</div>
					 </div>
					</div>
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>
	<!-- Modal -->
<div class="modal" id="myModal" aria-labelledby="exampleModalLabel" aria-hidden="fault">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h3>Update quantity</h3></h5>
      </div>
      <div class="modal-body">
        <p><h4><span id="name"></span></h4></p>
		<form action="updatequantity.php" method="post">
			<input type="number" name="qu" id="quantity" required placeholder="Enter New Quantity" class="form-control">
			<input type="hidden" name="drugid" id="drugid2" value="3442" required class="form-control">
			<input type="hidden" name="busket" id="cart2" value="0084"required class="form-control">
			<button name="tuma" class="btn btn-md btn-primary" type="submit" style="margin-top:2em">Update Quantity</button>
		</form>
      </div>
    </div>
  </div>
</div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>