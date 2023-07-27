<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<link href="css/plugins/chosen/chosen.css" rel="stylesheet">
   <title>Sales Patients - <?php echo $smart_name; ?></title>
	
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
			xmlhttp.open("GET","searchsales.php?q=0");
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchsales.php?q="+str,true);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
		</script>
        <script>
		function showResult1(str) {
			var starting = document.getElementById("starting");
				var startvalue = starting.value;
				var ending = document.getElementById("ending");
				var endvalue = ending.value;
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdsales.php??q="+str,true);
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdsales.php?q="+str,true);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
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
			function myFunction1(b) {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","saleditems.php?i="+b);
			xmlhttp.send();
			}
		</script>

		<script>
			function myFunction(b) {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","saleitems.php?i="+b);
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
			function saleitems(str) {
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","proccessor/saleitems.php?str="+str);
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
			xmlhttp.open("GET","checkout.php?str="+str+"&payment="+inputValue);
			xmlhttp.send();
			}
		</script>
			<script>
			function search() {
				var starting = document.getElementById("starting");
				var startvalue = starting.value;
				var ending = document.getElementById("ending");
				var endvalue = ending.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML="Loading....";
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","salesearch.php?start="+startvalue+"&end="+endvalue);
			xmlhttp.send();
			location.href = "sales.php?start="+startvalue+"&end="+endvalue;
			}
		</script>
		<script>
			function searchclear() {
				var starting = document.getElementById("starting");
				var startvalue = starting.value;
				var ending = document.getElementById("ending");
				var endvalue = ending.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML="Loading....";
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","salesearch.php?start="+startvalue+"&end="+endvalue+"&clear=clear");
			xmlhttp.send();
			location.href = "sales.php?start="+startvalue+"&end="+endvalue;
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
			xmlhttp.open("GET","salestotal.php");
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
      <div class="ibox-content">
		<div class="row">		
                <div class="col-sm-4"> 
					<div class="form-group">
						<label>Start Date</label>
						<?php if(isset($_SESSION['datesearch'])){?>
						<input type="date" name="startdate" id="starting" value="<?php echo $_SESSION['datesearch']['start']; ?>" class="form-control datepicker">										
								<?php }else{?>
						<input type="date" name="startdate" id="starting" value="<?php echo date('Y-m-d'); ?>" placeholder="Start Date" class="form-control datepicker">
						<?php } ?>
					</div>
				</div>
				<div class="col-sm-4"> 
						<div class="form-group">
							<label>End Date</label>
							<?php if(isset($_SESSION['datesearch'])){?>
						<input type="date" name="enddate" id="ending" value="<?php echo $_SESSION['datesearch']['ending']; ?>" class="form-control datepicker">										
								<?php }else{?>
						<input type="date" name="enddate" id="ending" placeholder="End Date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker">
						<?php } ?>
							
						</div>
				</div>
                <div class="col-sm-2"> 
						<div class="form-group">
                        <label>&nbsp;</label>
                    <button type="submit" onclick="search()" name="submit" class="btn btn-primary">View Sale Transactions</button>
						</div>
				</div>
				<div class="col-sm-1"> 
						<div class="form-group">
                        <label>&nbsp;</label>
						<button type="submit" onclick="searchclear()" name="submit" class="btn btn-primary">Reset</button>
						</div>
				</div>
				<div class="col-sm-1"> 
						<div class="form-group" >
                            <label>&nbsp;</label>
							<button type="submit" onclick="searchclear()" name="submit" class="btn btn-info">Refresh</button>
						</div>
                        
				</div>
            </div>
         </div>
                <div class="row">					
					<div class="row">					
						<div class="col-sm-12">
						<p class="pull-right">
							
						</div>				
					</div>				
					<div class="col-sm-7">					
						
					 <div class="ibox float-e-margins">
                        <div class="form-group">
						<label><span class="badge badge-success">Search Receipt numbers within the selected dates </span></label>
							<input type="text" size="30" onkeyup="showResult(this.value)" placeholder="Search Invoice Number" class="form-control">
							
						</div>	
                        <div class="ibox-content" style="overflow:auto;height:78vh; -ms-overflow-style: none; scrollbar-width: none;">
							
                           <div id="livesearch">
							<?php 
								$startdate=date('Y/m/d');
								$enddate=date('Y/m/d');
								if(isset($_SESSION['datesearch'])){
									$startdate=$_SESSION['datesearch']['start'];
									$enddate=$_SESSION['datesearch']['ending'];									
								}
								
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_sales` WHERE `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate' group by `sale_receiptno`");if ($getcountyname->num_rows > 0) {?>
                                 <table width="100%" cellspacing="0" cellpadding="4" style="font-size:13px; navy-bg p-sm text-center">
								 <tr>
									<th colspan="4" style="font-size:13px; color:green;text-align:center;"><u>Showing results for 
														<?php if(isset($_SESSION['datesearch']['start'])){
																echo " dates between ".$_SESSION['datesearch']['start'];
																echo " and ".$enddate=$_SESSION['datesearch']['ending'];
															} else{?> today<?php }   ?>
									</u></th>
								</tr> 
								 <tr>
                                        <th>S/No</th>
                                        <th>Invoice Number</th>
                                        <th>Amount Paid</th>
                                        <th>Mode of Payment</th>
                                    </tr>		
								<?php 
									$n=1;
                                    while($gcn = mysqli_fetch_array($getcountyname)){
									$sale_receiptno = $gcn['sale_receiptno'];
									$sale_modeofpayment = $gcn['sale_modeofpayment'];
                                    $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE `sale_soldby`='$sidno' AND `datee`>='$startdate' AND `datee`<='$enddate'";
                                    $result4 = mysqli_query($dbconnect, $sql4);
                                    $row = mysqli_fetch_assoc($result4);
                                    $total= $row["total"];
									?>
									<tr style='border-radius:5px; margin-bottom:20px; cursor: pointer;' onclick="myFunction(<?php echo $sale_receiptno;?>)">
                                        <td><h4><?php echo $n;$n=$n+1;?></h4></td>
                                        <td ><h4><?php echo $sale_receiptno; ?></h4></td>
                                        <td><h4><?php echo $total; ?></h4></td>
                                        <td><h4><?php echo $sale_modeofpayment?></h4></td>
                                    </tr>
								<?php }}else{?>
									<div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>No sale made during the selected period</b>
                                    </div>
								<?php }
								?>
                                </table>
																
							</div>
						</div>
					 </div>
					 
					</div>
					
					
					<div class="col-sm-5 " >					
						<div class="ibox float-e-margins">
                        <div class="form-group">
						<label><span class="badge badge-success">Pick from List for Drug Report within the selected dates </span></label>
                            <select data-placeholder="Choose drug..." name="drug" onchange="showResult1(this.value)" class="form-control chosen-select">
														
														<option selected value="">Select Drug from List </option>
														<option value="*">All Drugs</option>
														<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_drugs");
													while($gal = mysqli_fetch_array($getalllocations)){
														$product_code = $gal['drugitem_code'];
														$brand_name = $gal['brand_name'];
														?>
														<option value="<?php echo $product_code; ?>" ><?php echo $brand_name; ?></option>
														<?php
													}
													?>
												</select>
							
						</div>	
                        
                        <div class="ibox-contenti yellow-bg" style="overflow:auto;height:75vh; -ms-overflow-style: none; scrollbar-width: none;">
                           <div class="rowi" id="cart" >
						   <div class="alert alert-danger alert-dismissable">total sales for today is

                           </div>
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


   <?php include 'includes/footer-scripts.php';?>
</body>
<script>
        
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

    </script>
</html>