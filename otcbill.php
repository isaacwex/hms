<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
    <title>Shopping list - <?php echo "$smart_name"; ?></title>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
			function checkout1(str,busk) {
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","pay.php?str="+str+"&busk="+busk);
			xmlhttp.send();
			}
		</script>
	<script>
			function checkout(str) {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","listitems.php?str="+str);
			xmlhttp.send();
			}
		</script>
		<script>
			function paid(str,busk) {
				var input = document.getElementById("payment-options");
				var inputValue = input.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("cart").innerHTML=this.responseText;
				document.getElementById("cart").style.border="0px solid #A5ACB2";
				transdone(str,busk);
				}
			}
			xmlhttp.open("GET","checkout.php?str="+str+"&busk="+busk+"&payment="+inputValue);
			xmlhttp.send();
			}
		</script>
		<script>
			function transdone(str,busk) {
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("live").innerHTML=this.responseText;
				document.getElementById("live").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","transaction_complete.php?str="+str+"&busk="+busk);
			xmlhttp.send();
			}
		</script>
		<script>
			function home(){
				window.location.href = "sess.php?r=1";
			}
		</script>
		<script type="text/javascript">

		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			window.location.replace("sess.php?r=1");
		}
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
				<h2>Shopping List</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php"> List Items</a>
					</li>                         
					<li class="active">
						<strong>Pay list</strong>
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
					<div class="col-lg-5">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Busket</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row" id="live" >
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									
									<th>S/NO </th>
									<th>Busket number</th>
									<th>Buyer</th>
									<th>Action </th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM `tbl_tempsales` GROUP BY `temp_busketid`");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$temp_busketid = $gcn['temp_busketid'];
									$buyer = $gcn['buyer'];
									//$drugitem_sellingprice = $gcn['drugitem_sellingprice'];
								?>	<td><?php echo $No; ?></td>
									<td><?php echo $temp_busketid; ?></td>
									<td><?php echo $buyer; ?></td>
									<td><button onclick="checkout(<?php echo $temp_busketid;?>)" class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Open </button> </td>
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
					
					<div class="col-lg-7">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List Items</h5>
                            <p class="pull-right"><a href="sessinvoice.php?page=invoice" style="text-align:center;">
                            <button  class="btn btn-primary"><i class="fa fa-trash"></i> Clear List</button>
							</a></p>
						</div>
                        <div class="ibox-content">
                           <div class="row" id="cart">
                                                    
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