<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Billing - <?php echo $smart_name; ?></title>
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
			$current_processstage='BILLING';
			$queuestatuscurrent='1';
			$patientcategory='OUTPATIENT';
			$getLabPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_billing b ON b.bill_opno=r.opno AND b.bill_visitno=r.visit_no WHERE b.bill_patientcategory='$patientcategory' GROUP BY b.bill_opno");
			
			$title='Patients for Billing Services';
			$baselink='billing.php';
			
		?>	
				
			<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2><?php echo $patientcategory; ?></h2>
				<ol class="breadcrumb">
					<li>
						<a href="invoicer.php">Invoice</a>
					</li>                        
					<li class="active">
						<strong>Invoice status</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				</div>
		</div>	
				<div class="row">
				<form>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use Add/Edit functionality for laboratory results)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th>Date</th>
							<th>OP|VisitNo</th>
							<th>Full Names</th>
							<th>Bill Type</th>
							<th>Phone Number</th>
							<th>Invoice</th>
							<th>Scheme</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						while($gaclab = mysqli_fetch_array($getLabPatients)){
						$No=$No+1;
						$c_id = $gaclab['reg_no'];
						$fnames = $gaclab['f_name'];
						$lnames = $gaclab['l_name'];
						$id_number = $gaclab['id_no'];
						$phonenumber = $gaclab['phone_no'];
						$gender = $gaclab['gender'];
						$dob = $gaclab['dob'];
						$opno = $gaclab['opno'];
						$scheme_code = $gaclab['scheme_code'];
						$visitno = $gaclab['visit_no'];
						$reside = $gaclab['residence'];
						$visit_date = $gaclab['visit_date'];
						$todaydate = date('Y-m-d');
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $visit_date; ?></td>
							<td><?php echo $opno; ?> | <?php echo $visitno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $patientcategory; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php 
									$getinvo = mysqli_query($dbconnect, "SELECT invoice_no FROM tbl_patientinvoices WHERE invoice_visitno='$visitno' AND invoice_opno='$opno' AND invoice_category='$patientcategory' LIMIT 1");
										$giv = mysqli_fetch_assoc($getinvo);
										$invoice_no = $giv['invoice_no'];
										if($invoice_no!=null){
											?>
											<span class="badge badge-primary">Invoiced<br><?php echo $invoice_no; ?>)</span>
											<?php
										}else{
											?>
											<span class="badge badge-warning"> Pending </span>
											<?php
											
										}
								?>
							</td>
							
							<td>
								<?php
									$getlss = mysqli_query($dbconnect, "SELECT pscheme_name FROM tbl_paymentschemes WHERE pscheme_code='$scheme_code'");
										$lrarrayy = mysqli_fetch_array($getlss);
										$pscheme_name = $lrarrayy['pscheme_name'];
											echo "$pscheme_name";
										?>	
											
							</td>
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">	
									
									<li>
									<a href="invoicer.php?current_processstage=<?php echo $current_processstage;?>&opip=<?php echo $opno;?>&vis=<?php echo $visitno;?>&pcategory=<?php echo $patientcategory;?>"><button type="button" class="btn-xs btn-white"> Invoice Details</button></a>
									</li>
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue Patient</button></a>	
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
</body>
</html>
