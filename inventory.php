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
    <script>
		function showResult(str) {
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("items").innerHTML=this.responseText;
				document.getElementById("items").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","invoiceitems.php?q=0");
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("items").innerHTML=this.responseText;
				document.getElementById("items").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","invoiceitems.php?q="+str,true);
			xmlhttp.send();
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
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Recent Inventory </h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									
									<th>S/NO </th>
									<th>Invoice NO.</th>
									<th>Supplier</th>
									<th>Date </th>
									<th>Action </th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` GROUP BY `inve_invoiceno` ORDER BY `inve_time`");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$inve_invoiceno = $gcn['inve_invoiceno'];
									$supplierid = $gcn['supplierid'];
									$inve_time = $gcn['inve_time'];
									//$Servicesitem_sellingprice = $gcn['Servicesitem_sellingprice']; 

								?>	<td><?php echo $No; ?></td>
									<td><?php echo $inve_invoiceno; ?></td>
									<td><?php echo $supplierid; ?></td>
									<td><?php echo $inve_time; ?></td>
									<td><button class="btn-xs btn-primary" onclick="showResult('<?php echo $inve_invoiceno;?>')"><i class="fa fa-book"></i></button></td>
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
					
					
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Invoice Items</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row" id="items">
								
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