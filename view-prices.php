<?php include('includes/authenticate.php'); ?>
	<?php
		$skim_code = $_GET['scode'];
		$get_scheme_details = mysqli_query($dbconnect, "SELECT * FROM tbl_paymentschemes WHERE pscheme_code='$skim_code'");
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
				<h2>Drugs</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php"> Add List</a>
					</li>                        
					<li class="active">
						<strong>New Drugs</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="drugs.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Drug Prices</span></button></a></span> &nbsp; <span><a href="drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Drugs</span></button></a></span>
				</p>
				</div>
		</div>

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
									
					</div>	
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Drug Catalog</h5>
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
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_drug_prices tp INNER JOIN tbl_drugs d ON tp.drug_code=d.drugitem_code WHERE scheme='$skim_code'");
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
									<td>
									<!--<a href="edit-price.php?scheme=<?php //echo $dru_ski; ?>&dcode=<?php //echo $dru_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a>-->
									</td>
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