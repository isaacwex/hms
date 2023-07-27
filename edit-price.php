<?php include('includes/authenticate.php'); ?>
	<?php
		$skm_code = $_GET['scheme'];
		$drug_code = $_GET['dcode'];
		$getdrugprice = mysqli_query($dbconnect, "SELECT * FROM tbl_drugs td INNER JOIN tbl_drug_prices tdp ON td.drugitem_code=tdp.drug_code WHERE td.drugitem_code='$drug_code' AND tdp.scheme='$skm_code'");
		$tdp = mysqli_fetch_array($getdrugprice);
		
		$d_autoid = $tdp['autoid'];
		$d_code = $tdp['drug_code'];
		$d_name = $tdp['brand_name'];
		$d_price = $tdp['price'];
		$d_scheme = $tdp['scheme'];
		
		$get_scheme_details = mysqli_query($dbconnect, "SELECT * FROM tbl_paymentschemes WHERE pscheme_code='$skm_code'");
		$ski = mysqli_fetch_array($get_scheme_details);
		
		$skim_name = $ski['pscheme_name'];
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Drug Prices under <?php echo $skim_name; ?> - <?php echo "$smart_name"; ?></title>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

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
				<h2>Drug Prices</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php"> Manage Price</a>
					</li>                        
					<li class="active">
						<strong>Prices for <?php echo $skim_name; ?></strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="manage-prices.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Drug Prices</span></button></a></span> &nbsp; <span><a href="drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Drugs</span></button></a></span>
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
                            <h5>Manage Drug Price</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['updateprice'])){
											if(empty($_POST['newprice'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> New Price is required</div>";
														}
												else {
													
												$dr_code = $dbconnect->real_escape_string($_POST['dr_code']);
												$dr_autoid = $dbconnect->real_escape_string($_POST['auto_id']);
												$dr_scheme = $dbconnect->real_escape_string($_POST['dr_scheme']);
                                                $new_price = $dbconnect->real_escape_string($_POST['newprice']);
												
												if($stmt = $dbconnect->prepare("UPDATE tbl_drug_prices SET price=? WHERE autoid='$dr_autoid' AND drug_code='$dr_code' AND scheme='$dr_scheme'")){
													$stmt->bind_param('s',$new_price);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-check-square-o\"></i> The price for: <b>$d_name</b> has been modified successfully. Redirecting in 2 seconds ...</div>";
														
														echo '<META HTTP-EQUIV="Refresh" content="2; ">';
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating new price for $d_name</div>".$dbconnect->error;	
														}

													}
												}
												?>
											</div>
												
											<div class="col-sm-12">
                                                
                                            <div class="form-group">
                                                <label for="brand-name">Name:</label>
												<input type="hidden" value="<?php echo $d_code; ?>" name="dr_code"/>
												<input type="hidden" value="<?php echo $d_scheme; ?>" name="dr_scheme"/>
												<input type="hidden" value="<?php echo $d_autoid; ?>" name="auto_id"/>
                                                <input type="text" class="form-control" name="brand" readonly value="<?php echo $d_name; ?>">
                                            </div>
                                                
                                            <div class="form-group">
                                                <label for="brand-name">Current Price:</label>
                                                <input type="text" class="form-control" name="newprice" readonly value="<?php echo $d_price; ?>">
                                            </div>
											
                                            <div class="form-group">
                                                <label for="brand-name">New Price:</label>
                                                <input type="text" class="form-control" name="newprice" >
                                            </div>
											<div class="form-group">
												<button name="updateprice" class="btn btn-md btn-success" type="submit"><i class="fa fa-save"></i>  Update New Price</button>
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
                            <h5>Drug Catalog for <?php echo $skim_name; ?></h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									<th>Code</th>
									<th>Drug Name</th>
									<th>Price </th>
									<th>Action </th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drug_prices tp INNER JOIN tbl_drugs d ON tp.drug_code=d.drugitem_code WHERE scheme='$skm_code'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$dru_name = $gcn['brand_name'];
									$dru_ski = $gcn['scheme'];
									$dru_code = $gcn['drug_code'];
									$dru_price = $gcn['price'];
									//$drugitem_sellingprice = $gcn['drugitem_sellingprice'];
								?>
									<td><?php echo $dru_code; ?></td>
									<td><?php echo $dru_name; ?></td>
									<td><?php echo $dru_price; ?></td>
									<td><a href="edit-price.php?scheme=<?php echo $dru_ski; ?>&dcode=<?php echo $dru_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a></td>
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