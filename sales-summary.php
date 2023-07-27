<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Sales Summary - <?php echo $smart_name; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
    function showResult() {
                var fdate = document.getElementById("fdate").value;
				var sdate = document.getElementById("sdate").value;
			if(fdate>sdate){
                alert("First date must be prior to the second date");
                exit;
            }
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchsummary.php?fdate="+fdate+"&sdate="+sdate);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
		</script>
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
		$current_processstage='SALES SUMMARY';
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM `tbl_sales` ORDER BY datee DESC limit 200");
		$title='Sales Summary';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
			<div class="row">
            <div class="row">
			<div class="col-md-3">
            <label for="date2"><h2>Search between dates</h2></label>
				
			</div>
			<div class="col-md-3">
				<label for="date2">First Date:</label>
				<input type="date" id="fdate" name="date2" class="form-control">
			</div>
			<div class="col-md-3">
				<label for="date3">Second Date:</label>
				<input type="date" id="sdate" name="date3" class="form-control">
			</div>
            <div class="col-md-1">
				<label for="date3">&nbsp;</label>
				<button name="new-search" class="btn btn-success" type="submit" onclick="showResult()">Search!</button>
			</div>
            <div class="col-md-1">
				<label for="date3">&nbsp;</label>
				<span><a href="sales-summary.php"><button class="btn btn-success" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
            	</div>
		</div>
			</div>
				
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use search functionality above to find more to the list)</i>
                    </div>
                    <div class="ibox-content" id="livesearch">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>S/No</th>
							<th>Sale ID</th>
							<th>Item Sold</th>
							<th>Amount Sold</th>
							<th>Sale Profit</th>
							<th> Mode of payment</th>
							<th>Batch number</th>
							<th>Date Sold </th>
							<th>#</th>
                            
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gac = mysqli_fetch_array($getPatients)){
						$No=$No+1;
						$sale_id = $gac['sale_id'];
						$sale_itemcode = $gac['sale_itemcode'];
						$sale_amount = $gac['sale_amount'];
						$sale_soldby = $gac['sale_soldby'];
						$sale_profit = $gac['sale_profit'];
						$sale_modeofpayment = $gac['sale_modeofpayment'];
						$batch = $gac['batch'];
						$sale_status = $gac['sale_status'];
						$datee = $gac['datee'];
						$name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
							
						?>
						<?php "<tr class='gradeX'>"; ?>
                            <td><?php echo $No; ?></td>
							<td><?php echo $sale_id; ?></td>
							<td><?php echo $rrowname; ?></td>
							<td><?php echo $sale_amount; ?></td>
							<td><?php echo $sale_soldby; ?></td>
							<td><?php echo $sale_profit;?></td>
							<td><?php echo $sale_modeofpayment;?></td>
							<td><a href="sale-details.php?saleid=<?php echo $sale_id;?>&item=<?php echo $sale_itemcode;?>"><button class="btn btn-success" type="button"><span class="bold"> More</button></a></span></td>
							<td></td>
							
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