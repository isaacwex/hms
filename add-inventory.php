<?php include('includes/authenticate.php'); ?>
<?php
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_inventorytemp");
	?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>	
    <title>Drug Catalog - <?php echo "$smart_name"; ?></title>	
	<!-- Data Tables -->	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<link href="css/plugins/chosen/chosen.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
    <script>
			function opendrug() {
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
    function showResult(str) {
        if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET","druginvent.php?q="+str,true);
        xmlhttp.send();
        }
        function mydata(str) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            
        }
         // Define an array to store the cart items
       
    </script>
</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Drugs</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php"> Add Inventory</a>
					</li>                        
					<li class="active">
						<strong>New Invoice</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Drugs</span></button></a></span>
				</p>
				</div>
		</div>
        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						
                        <div class="ibox-title" style="margin-left: 1rem;margin-right:1rem;align-content:center;">
                           <h5>Add stock </h5>
                        </div>	
                        
                        <div class="row" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">
                            <div class="ibox float-e-margins">
                                <form action="invoiceprocesor.php" method="post">
                                    <div class="col-md-4">
                                        <div class="form-group" style="display:block;">
                                        <label><h4>Invoice</h4></label>
                                        <?php if(!isset($_SESSION['invoice'])){?>
                                          <input type="text" name="invoice" class="form-control" required >
                                        <?php }else{ ?>
                                            <input type="text" name="invoice" value="<?php echo $_SESSION['invoice'];?>" class="form-control" disabled> 
											<?php } ?>
										</div>
                                    
										<div class="form-group" style="display:block;">
											<label><h4>Drugs</h4></label>
											
												<select data-placeholder="Choose drug..." name="drug" class="form-control chosen-select">
												
														<option selected value="">Select from List </option>
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
									
									<div class="form-group" style="display:block;">
										<label><h4>Supplier</h4></label>
                                        <?php if(!isset($_SESSION['supplier'])){?>
                                        <input type="text" name="supplier" placeholder="Enter name of your Supplier" class="form-control">  <?php }else{ ?><input type="text" name="supplier" value="<?php echo $_SESSION['supplier'];?>" disabled placeholder="Enter name of your Supplier" class="form-control"> <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="display:block;">
                                        <div class="form-group">
                                        <label><h4>Quantity</h4></label>
                                        <input type="number" name="quantity" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label><h4>Batch Number</h4></label>
                                        <input type="text" name="batch" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label><h4>Price</h4></label>
                                        <input type="number" step="0.01" name="price" class="form-control">
                                        </div>
										
										
                                    </div>
                                    <div class="col-md-4" style="display:block;">
                                        <div class="form-group">
                                        <label><h4>Expiry Date</h4></label>
                                        <input type="date" name="edate" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label><h4>Time Created</h4></label>
                                        <input type="date" name="time" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label><h4>.</h4></label>
                                        <button type="submit" name="submit" class="form-control btn btn-primary">Add to list</button>
                                        </div>
                                        
                                    </div>
                             </form>
                            </div>
                        </div>

					</div>
					<div class="row" >	
					<div class="col-lg-12" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Drug Catalog</h5>
                            <p class="pull-right"><a href="sessinvoice.php?page=invoice" style="text-align:center;">
                            <button  class="btn btn-primary"><i class="fa fa-trash"></i> Clear Invoice</button>
							</a></p>
						</div>
                        <div class="ibox-content">
                           <div class="row">
                           <?php if(isset($_SESSION['invoice'])){?>	
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Drug Name</th>
									<th>Unit Price </th>
									<th>Quantity</th>
                                    <th>Sub Total</th>
									<th>Batch Number</th>
                                    <th>#</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn = mysqli_fetch_array($result)){
									$No=$No+1;
									$inve_drugcode = $gcn['inve_drugcode'];
									$inve_purchaseprice = $gcn['inve_purchaseprice'];
									$inve_qty = $gcn['inve_qty'];
                                    $inve_id = $gcn['inve_id'];
                                    $inve_batchno = $gcn['inve_batchno'];
                                    $stotal=$inve_qty*$inve_purchaseprice;
									$inve_expirydate = $gcn['inve_expirydate'];
                                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $rrowname; ?></td>
									<td><?php echo $inve_purchaseprice; ?></td>
									<td><?php echo $inve_qty; ?></td>
                                    <td><?php echo $stotal; ?></td>
                                    <td><?php echo $inve_batchno; ?></td>
                                    <td><a href="delinvetemp.php?id=<?php echo $inve_id;?>"><i class="fa fa-trash"></i></a></td>
									<!--<td><button class="btn-xs btn-primary"><a href="edit-county.php?county_id=<?php //echo $county_code; ?>"><i class="fa fa-pencil"></i> Edit </a></button> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>-->
								</tr>
								<?php
								}
								?>
								<tr><td colspan="7"><a href="submitinvoice.php?page=i&invoice=<?php echo $_SESSION['invoice'];?>" style="text-align:center;">
                            <button  class="btn btn-primary"><i class="fa fa-trash"></i> Submit Invoice</button>
							</a></td></tr>
								</tbody>
								</table>
                                <?php } ?>                            
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

   <?php include 'includes/footer-scripts.php';?>
   <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

</body>
</html>