<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Patient Invoices - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<!-- Data Tables -->	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
			$current_processstage='PATIENTINVOICES';
			$queuestatuscurrent='1';
			$getLabPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_patientinvoices s INNER JOIN tbl_registry r ON s.invoice_opno=r.opno ORDER BY invoice_id desc");
			
			$title='Patients already invoiced';
			$baselink='patientinvoices.php';
		?>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>Billing</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>Invoice Date</th>
							<th>Category</th>
							<th>Invoice No.</th>
							<th>OP/IP No.</th>
							<th>Full Names</th>
							<th>Scheme</th>
							<th>Member No.</th>
							<th>Invoice Details</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gaclab = mysqli_fetch_array($getLabPatients)){
						$No=$No+1;
						$invoice_id = $gaclab['invoice_id'];
						$invoice_no = $gaclab['invoice_no'];
						$invoice_datetime = $gaclab['invoice_datetime'];
						$invoice_tenderedamt = $gaclab['invoice_tenderedamt'];
						$invoice_pschemename = $gaclab['invoice_pschemename'];
						$invoice_patientname = $gaclab['invoice_payername'];
						$invoice_ipno = $gaclab['invoice_ipno'];
						$invoice_visitno = $gaclab['invoice_visitno'];
						$invoice_memberno = $gaclab['invoice_memberno'];
						$invoice_opno = $gaclab['invoice_opno'];
						$invoice_category = $gaclab['invoice_category'];
						$c_id = $gaclab['reg_no'];
						
													$todaydate = date('Y-m-d');
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $invoice_datetime; ?></td>
							<td><span class="badge badge-primary"><?php echo $invoice_category; ?></span></td>
							<td><?php echo $invoice_no; ?></td>
							<td>OPNo.: <?php echo $invoice_opno; ?>|<?php echo $invoice_visitno; ?><br>
							IPNo.: <?php echo $invoice_ipno; ?>
							</td>
							<td><?php echo $invoice_patientname; ?></td>
							<td><?php echo $invoice_pschemename; ?></td>
							<td><?php echo $invoice_memberno; ?></td>
							<td>
							<?php
							$Noinside = 0;
							$getls = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_invoiceno='$invoice_no'");
										while($lrarray = mysqli_fetch_array($getls)){
											$Noinside=$Noinside+1;
											$billservicename = $lrarray['bill_servicename'];
											$billamount = $lrarray['bill_amount'];
											$bill_visitno = $lrarray['bill_visitno'];
											$bill_opno = $lrarray['bill_opno'];
											$bill_id = $lrarray['bill_id'];
											?>
											<?php echo $Noinside; ?>. <?php echo $billservicename; ?> - <?php echo $billamount; ?>/= 
										
											<a href="invoiceedit.php?opno=<?php echo $bill_opno;?>&visitno=<?php echo $bill_visitno;?>&bill_id=<?php echo $bill_id;?>"><button type="button" class="badge badge-warning">Edit</button></a>
											<br>
										<?php
										}
							?>
							</td>
							
						<td>
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
									<a href="printbill.php?opno=<?php echo $invoice_opno; ?>&visitno=<?php echo $invoice_visitno; ?>&current_processstage=<?php echo $current_processstage;?>&invoiceno=<?php echo $invoice_no;?>">Invoice  </a>
									</li>
									<li>
									<a href="labrequest.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Confirm Reembursement </a>			
									</li>
									
								</ul>
							</div>
							
							
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
			</form>
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
 <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
  <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip'
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

        });
    </script>
</body>
</html>
