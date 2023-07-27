<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Drug Prices - <?php echo $smart_name; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
		
		$get_prices = mysqli_query($dbconnect, "SELECT * FROM tbl_drugs td INNER JOIN tbl_drug_prices dp ON td.drugitem_code=dp.drug_code ORDER BY dp.price DESC");
		$title='Drugs and their Prices';
		?>
		
        <div class="wrapper wrapper-content">	
				<div class="row">
					<div class="col-lg-7">
					<h2>Drugs and their Prices</h2>
					</div>
					<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="manage-prices.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Manage Drug Prices</span></button></a></span> &nbsp;
				<span><a href="drugs.php"><button class="btn btn-success" type="button"><i class="fa fa-medkit"></i>&nbsp;&nbsp;<span class="bold"> View Drugs</span></button></a></span>
				</p>
				</div>
				</div>
				
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>No</th>
							<th>Drug Code</th>
							<th>Drug Name</th>
							<th>Drug Price</th>
							<th>Scheme</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						while($dru = mysqli_fetch_array($get_prices)){
						$No=$No+1;
						
						$dru_code = $dru['drugitem_code'];
						$dru_name = $dru['brand_name'];
						$dru_price = $dru['price'];
						$dru_scheme = $dru['scheme'];
						
						
						?>
						<?php "<tr class='gradeX'>"; ?>
							<td><?php echo $No; ?></td>
							<td><?php echo $dru_code; ?></td>
							<td><?php echo $dru_name; ?></td>
							<td><?php echo $dru_price; ?></td>
							<td><?php echo $dru_scheme;?></td>
							<td>Manage</td>
							
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
		<?php include 'includes/footer.php'?>
    </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
   <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
       <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
				"pageLength": 20,
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
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>
</html>
