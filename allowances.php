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
                                        <p>Universal Allowances</p>
                                       <div class="form-group" style="display:block;">
											<label><h4>Allowance Type</h4></label>
											
												<select data-placeholder="Choose allowance..." name="allowance" class="form-control chosen-select">
												
														<option selected value="">Select from List </option>
														<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_allowancetypes");
													while($gal = mysqli_fetch_array($getalllocations)){
														$code = $gal['code'];
														$type = $gal['type'];
														?>
														<option value="<?php echo $type; ?>" ><?php echo $type; ?></option>
														<?php
													}
													?>
												</select>
									    </div>
                                        <div class="form-group">
                                        <label><h4>Amount</h4></label>
                                        <input type="number" name="amount" class="form-control">
                                        </div>	
                                    </div>
									
                                    <div class="col-md-4" style="display:block;border:1px;">
                                        <p>Departmental Allowance</p>
                                        
                                        <div class="form-group" style="display:block;">
											<label><h4>Allowance Type</h4></label>
											
												<select data-placeholder="Choose allowance..." name="allowance" class="form-control chosen-select">
												
														<option selected value="">Select from List </option>
														<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_allowancetypes");
													while($gal = mysqli_fetch_array($getalllocations)){
														$code = $gal['code'];
														$type = $gal['type'];
														?>
														<option value="<?php echo $type; ?>" ><?php echo $type; ?></option>
														<?php
													}
													?>
												</select>
									    </div>
                                       
                                        <div class="form-group" style="display:block;">
											<label><h4>Allowance Type</h4></label>
											
												<select data-placeholder="Choose allowance..." name="allowance" class="form-control chosen-select">
												
														<option selected value="">Select from List </option>
														<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_allowancetypes");
													while($gal = mysqli_fetch_array($getalllocations)){
														$code = $gal['code'];
														$type = $gal['type'];
														?>
														<option value="<?php echo $type; ?>" ><?php echo $type; ?></option>
														<?php
													}
													?>
												</select>
									    </div>
                                        <div class="form-group">
                                        <label><h4>Price</h4></label>
                                        <input type="number" step="0.01" name="price" class="form-control">
                                        </div>
										
										
                                    </div>
                                    <div class="col-md-4" style="display:block;">
                                        <p>Individual Allowance</p>
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