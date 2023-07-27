<?php include('includes/authenticate.php'); ?>
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
			xmlhttp.open("GET","searchdrug.php?q=0");
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdrug.php?q="+str,true);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
		</script>
		<script>
			function myFunction(name,id) {
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
			xmlhttp.open("GET","loadcart.php?i="+id+"&n="+name+"&img=drug.jpg");
			xmlhttp.send();
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
			xmlhttp.open("GET","checkout.php?str="+str);
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
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							
							
						</div>				
					</div>				
					<div class="col-lg-7">					
						
					 
					 <div class="ibox float-e-margins">
                        <div class="form-group">
							<input type="text" size="30" onkeyup="showResult(this.value)" placeholder="Search Drug" class="form-control">
							
						</div>	
                        <div class="ibox-content">
							
                           <div class="row" id="livesearch">
							<?php 
								
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drugs LIMIT 50");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$vital_code = $gcn['image_url'];
									$vital_name = $gcn['brand_name'];
									$vital_unit = $gcn['drugitem_code'];?>
									<div style='padding:10px; font-size: 100%;align-content:right;text-align:center;cursor: pointer;' class='col-lg-2' onclick="myFunction('<?php echo $vital_name; ?>', <?php echo $vital_unit; ?>)">
									<?php echo '<img src="drug_imgs/drug.jpg" width="80" height="80"><br>';
									echo '<span >'.$vital_name.'</span>';
									echo '</div>';
								}
								?>
																
							</div>
						</div>
					 </div>
					 
					</div>
					
					
					<div class="col-lg-5">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title" >
                            <h5>Drug Busket</h5>
							<p class="pull-right"><a href="sess.php" style="text-align:center;">
								
								<button  class="btn btn-primary"><i class="fa fa-trash"></i> Clear list</button>
							</a></p>
						</div>
                        <div class="ibox-content">
                           <div class="row" id="cart">
						   <div class=\"alert alert-danger alert-dismissable\"> The busket is clear</div>
							</div>
							
						</div>
					 </div>
					</div>
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>