<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Drugs - <?php echo $smart_name; ?></title>
	
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
		$current_processstage='REGISTRY';
		$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_inventory WHERE inve_qty>0 AND inve_purchaseprice>0 ORDER BY inve_expirydate DESC");
		$title='Newly Added Stock';
		?>
		
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Drugs</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php">Drugs</a>
					</li>                        
					<li class="active">
						<strong>Manage Drugs</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="add-inventory.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> New Stock</span></button></a></span> &nbsp;
				<span><a href="manage-prices.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Drug Prices</span></button></a></span> &nbsp;
				<span><a href="add-drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-save"></i>&nbsp;&nbsp;<span class="bold"> Add drug</span></button></a></span>
				</p>
				</div>
		</div>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
			
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_inventory WHERE inve_drugcode LIKE '%$searchtermv%' OR inve_batchno LIKE '%$searchtermv%' OR inve_invoiceno LIKE '%$searchtermv%' OR inve_purchaseprice LIKE '%$searchtermv%' OR inve_expirydate LIKE '%$searchtermv%'");
					
					$title='Search Results from the Inventory';
					}
					?>
					</div>
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-7">
					<input type="text" name="searchterm" required placeholder="Search by Name/Code" class="form-control"/>
				</div>
				<div class="col-sm-3">
					<button name="new-search" class="btn btn-success" type="submit">Search!</button>
					<span><a href="drugs.php"><button class="btn btn-success" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
				</div>									
					</div>
					</form>
						</br>
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use search functionality above to find more to the list)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>Code</th>
							<th>Name</th>
							<th>Current Stock</th>
							<th>Purchace price</th>
							<th>Time In</th>
							<th> Batch No.</th>
							<th>Expiry date</th>
							<th>Invoice No. </th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						while($gac = mysqli_fetch_array($getdrugs)){
						$No=$No+1;
						$inve_drugcode = $gac['inve_drugcode'];
						//$price =mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$inve_drugcode '");
						$price =mysqli_query($dbconnect,"SELECT * FROM tbl_drug_prices p INNER JOIN tbl_drugs g ON p.drug_code=g.drugitem_code WHERE p.drug_code='$inve_drugcode'");
							$rrow = mysqli_fetch_array($price);
						$drugname = $rrow['brand_name'];
						$inve_stock = $gac['inve_qty'];
						$inve_price = $gac['inve_purchaseprice'];
						$inve_time = $gac['inve_time'];
						$inve_batch = $gac['inve_batchno'];
						$inve_expire = $gac['inve_expirydate'];
						$inve_invoice = $gac['inve_invoiceno'];
						
						
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $inve_drugcode; ?></td>
							<td><?php echo $drugname; ?></td>
							<td><span class="badge badge-primary"><?php echo $inve_stock; ?></span></td>
							<td><?php echo $inve_price; ?></td>
							<td><?php echo $inve_time;?></td>
							<td><?php echo $inve_batch;?></td>
							<td><?php echo $inve_expire; ?></td>
							<td><?php echo $inve_invoice; ?></br>
							
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
		</form>
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
