<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
	
    <?php include('includes/meta.php');?>
	
    <title>Choose Payment Scheme - <?php echo "$smart_name"; ?></title>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<style>
		.btn-scheme	{
			width:100%;
			text-align:left;
		}
	</style>

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
						<a href="drugs.php"> Manage Drugs</a>
					</li>                        
					<li class="active">
						<strong>Drug Prices</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="index.php"><button class="btn btn-success" type="button"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Dashboard</span></button></a></span> &nbsp; <span><a href="drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back to Drugs</span></button></a></span>
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
                            <h5>Select Payment Scheme </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<?php
										$No = 0;
										$find_schemes = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
										while ($skim = mysqli_fetch_array($find_schemes)){
											$No = $No+1;
											$skim_id = $skim['pscheme_id'];
											$skim_code = $skim['pscheme_code'];
											$skim_name = $skim['pscheme_name'];
											?>
											<div class="form-group">
												<a href="view-prices.php?scode=<?php echo $skim_code ?>"><button class="btn btn-md btn-success btn-scheme" type="submit"><i class="fa fa-money"></i> <?php echo "$No $skim_name ($skim_code) PRICES"; ?></button></a>
											</div>
											<?php
										}
										?>
									</div>	
								</div>	
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
								<div class="col-sm-12">
									<div class="form-group">										
								<span>Select the Payment Scheme on the Left to Key in or modify prices</span>
									</div>	
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