<?php include('includes/authenticate.php');
	
	?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
    <title>Services Catalog - <?php echo "$smart_name"; ?></title>
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
				<h2>Services</h2>
				<ol class="breadcrumb">
					<li>
						<a href="Services.php"> Add List</a>
					</li>                        
					<li class="active">
						<strong>New Services</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="Services.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Services Prices</span></button></a></span> &nbsp; <span><a href="Services.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Services</span></button></a></span>
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
                            <h5>Add Services </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newcounty'])){
											if(empty($_POST['name'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Name is required</div>";
														}
												else {
													
												$name = $dbconnect->real_escape_string($_POST['name']);
												$category = $dbconnect->real_escape_string($_POST['category']);
                                               
												

												$checkcounty = mysqli_query($dbconnect, "SELECT * FROM tbl_Services WHERE `ss_name`='$name'");
												$countNo = mysqli_num_rows($checkcounty);
												if($countNo >= 1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Code or name already exists.</div>";
														}
												else {
													$code = 'LAB';
													if($category=="LABORATORY"){
														$code='LAB';
													}if($category=="CONSULTATION"){
														$code='CON';
													}if($category=="INPATIENT"){
														$code='INP';
													}if($category=="DENTAL"){
														$code='DEN';
													}if($category=="TREATMENTROOM"){
														$code='TRE';
													}if($category=="PHYSIOTHERAPY"){
														$code='	PHY';
													}

													$getmaxreg = mysqli_query($dbconnect,"SELECT COUNT(*) FROM tbl_Services WHERE `ss_code`LIKE '%$code%'");
													$asreg = mysqli_fetch_row($getmaxreg);
													$opnos = $asreg[0];
													$nextcode = $opnos+1;
													$postnextcode = str_pad($nextcode,3,"0",STR_PAD_LEFT);
													$cod= $code.$postnextcode;
													$sql5 = "INSERT INTO `tbl_services`(`ss_code`, `ss_category`, `ss_subcategory`, `ss_name`) VALUES ('$cod', '$category', '','$name')";
													$result5 = $dbconnect->query($sql5);	
													echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i>Successfully added</div>";
															}
														}
													}
												?>
											</div>
												
											<div class="col-sm-12">
                                                
                                            <div class="form-group">
                                                <label for="brand-name">Service Name:</label>
                                                <input type="text" class="form-control" id="brand-name" name="name" required>
                                            </div>
													<div class="form-group">
															<label>Category</label>
															<select name="category" class="form-control" required>
																	<option value='CONSULTATION'>CONSULTATION</option>
																	<option value='LABORATORY'>LABORATORY</option>
																	<option value='INPATIENT'>INPATIENT</option>
																	<option value='DENTAL'>DENTAL</option>
																	<option value='TREATMENTROOM'>TREATMENTROOM</option>
																	<option value='PHYSIOTHERAPY'>PHYSIOTHERAPY</option>
															</select>
														</div>
                                           
											<div class="form-group">
												<button name="newcounty" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Add Services </button>
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
                            <h5>Services Catalog</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									
									<th>S/NO </th>
									<th>Code</th>
									<th>Services Name</th>
									<th>Category </th>
									<th>Action </th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_Services");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$ss_code = $gcn['ss_code'];
									$ss_name = $gcn['ss_name'];
									$ss_category = $gcn['ss_category'];
									//$Servicesitem_sellingprice = $gcn['Servicesitem_sellingprice'];
								?>	<td><?php echo $No; ?></td>
									<td><?php echo $ss_code; ?></td>
									<td><?php echo $ss_name; ?></td>
									<td><?php echo $ss_category; ?></td>
									<td><a href="editservice.php?services_id=<?php echo $ss_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a></td>
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