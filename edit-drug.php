<?php include('includes/authenticate.php'); ?>
<?php
	$drugg_id = $_GET['drug_id'];
	$get_drug = mysqli_query($dbconnect,"SELECT * FROM tbl_drugs WHERE drugitem_code = $drugg_id");
	$dru = mysqli_fetch_array($get_drug);
	$d_id = $dru['drug_id'];
	$drug_name = $dru['brand_name'];
	$dru_itemcode = $dru['drugitem_code'];
	$drugcat = $dru['drugitem_cat'];
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Edit <?php echo $drug_name; ?> - <?php echo "$smart_name"; ?></title>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
		function showResult3(str,code) {
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("pricediv").innerHTML=this.responseText;
				document.getElementById("pricediv").style.border="0px solid #A5ACB2";}
			}
				xmlhttp.open("GET","newpricing.php?drugcode="+code+"&scheme="+str,true);
				xmlhttp.send();
			}
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("pricediv").innerHTML=this.responseText;
				document.getElementById("pricediv").style.border="0px solid #A5ACB2";
				}
			}
				xmlhttp.open("GET","newpricing.php?drugcode="+code+"&scheme="+str,true);
				xmlhttp.send();
			}// Define an array to store the cart items
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
						<a href="drugs.php"> Manage Drug</a>
					</li>                        
					<li class="active">
						<strong><?php echo $drug_name; ?></strong>
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
									
					</div>				
					<div class="col-lg-4">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Drug prices </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['updatedrug'])){
											if(empty($_POST['brand'])){
												$res= "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
													
												$brand = $dbconnect->real_escape_string($_POST['brand']);
												$dd_id = $dbconnect->real_escape_string($_POST['drug_id']);
												$scheme = $dbconnect->real_escape_string($_POST['scheme']);
												$price = $dbconnect->real_escape_string($_POST['price']);
												$generic = '';
												$strength = '';
												$dosage = '';
												$manufacturer = '';
												$prescription = '';
												//$category = $dbconnect->real_escape_string($_POST['category']);
                                                $description = $dbconnect->real_escape_string($_POST['description']);
												$imageurl = '';
												
												if($stmt = $dbconnect->prepare("UPDATE tbl_drugs SET brand_name=? WHERE drug_id='$dd_id'")){
													$stmt->bind_param('s',$brand);
													$stmt->execute();
													
													
													$pricing =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$drugg_id' AND `scheme`='$scheme'");$rrow = mysqli_fetch_array($pricing);
													$rrowprice = $rrow['price'];
													if($pricing->num_rows > 0){
														$sql5 = "UPDATE `tbl_drug_prices` SET `price`='$price'  WHERE `drug_code`='$drugg_id' and `scheme`='$scheme'";
														$result5 = $dbconnect->query($sql5);
													}else{
														$sql5 = "INSERT INTO `tbl_drug_prices`(`drug_code`, `price`, `scheme`) VALUES ('$drugg_id','$price','$scheme')";
														$result5 = $dbconnect->query($sql5);
													}


													

													$res= "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-check-square-o\"></i> $brand has been modified successfully. </div>";
														//echo '<META HTTP-EQUIV="Refresh" content="2; ">';
													}
													else {
														$res= "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating $brand drug</div>";	
														}
												
														}
													}
												?>
											</div>
												
											<div class="col-sm-12">
                                                
                                            <div class="form-group">
                                                <label for="brand-name">Name:</label>
                                                <input type="text" class="form-control" id="brand-name" name="brand" value="<?php echo $drug_name; ?>">
                                                <input type="hidden" class="form-control" id="brand-name" name="drug_id" value="<?php echo $d_id; ?>">
                                            </div>
											<div>
												<h4>Current Pricing</h4>
												<table>
													<?php 
													$getalmyscheme = mysqli_query($dbconnect,"SELECT * FROM `tbl_paymentschemes`");
													
													$No=1;
													while($ga = mysqli_fetch_array($getalmyscheme)){ 
													$na = $ga['pscheme_name'];
													$scheme = $ga['pscheme_code'];
													$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$drugg_id' AND `scheme`='$scheme'");$rrow = mysqli_fetch_array($price);
													$rrowprice = $rrow['price'];
															?>
														<tr>
															<td><?php echo $na; ?></td><td><span class="badge badge-success"><?php echo number_format($rrowprice,2); ?></span></td>
														</tr>
														<?php
															
														}?>
												</table>
												<?php if(isset($res)){
													echo $res;
												}?>
											</div>
											<div class="form-group">
						<label><span class="badge badge-success">Select scheme to update price </span></label>
                            <select data-placeholder="Choose drug..." name="scheme" onchange="showResul3(this.value,<?php echo $d_id; ?>)" class="form-control chosen-select">
													<option selected value="">Select Scheme </option>
													<?php
													$getalllocations = mysqli_query($dbconnect,"SELECT * FROM `tbl_paymentschemes`");
													while($gal = mysqli_fetch_array($getalllocations)){
														$product_code = $gal['pscheme_code'];
														$brand_name = $gal['pscheme_name'];
														?>
														<option value="<?php echo $product_code; ?>" ><?php echo $brand_name; ?></option>
														<?php
													}
													?>
												</select>
											</div>

											<div class="form-group" id="pricediv">
                                                <label for="brand-name">Price:</label>
                                                <input type="number" step="0.01" id="price" class="form-control" name="price" value="" />
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image-url">Image URL:</label>
                                                <input disabled type="file" class="form-control" id="image-url" name="image-url">
                                            </div>
											<div class="form-group">
												<button name="updatedrug" class="btn btn-md btn-primary" type="submit"><i class="fa fa-edit"></i> Update Drug </button>
											</div>	
										</div>																					
								</form>
							</div>
						</div>
					 </div>
					</div>
					
					
					<div class="col-lg-8">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Drug Catalog</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									<th>S/NO </th>
									<th>Code</th>
									<th>Drug Name</th>
									<th>Action </th>
								</tr>
								</thead>
								<tbody>
								
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drugs c INNER JOIN tbl_drug_categories d ON c.drugitem_cat=d.drug_code");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$drugid = $gcn['drug_id'];
									$brand_name = $gcn['brand_name'];
									$drugitem_code = $gcn['drugitem_code'];
									$vital_name = $gcn['drug_name'];
									$vital_unit = $gcn['description'];
									//$drugitem_sellingprice = $gcn['drugitem_sellingprice'];
								?>	<td><?php echo $No; ?></td>
									<td><?php echo $drugitem_code; ?></td>
									<td><?php echo $brand_name; ?></td>
									<td><a href="edit-drug.php?drug_id=<?php echo $drugitem_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
								</tr>
								<?php
								}
								?>
								
								</tbody>
								</table>
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
        <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });
	 </script>
</body>
</html>