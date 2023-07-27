<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Services - <?php echo $smart_name; ?></title>
	
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
			<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Services</h2>
				<ol class="breadcrumb">
					<li>
						<a href="all-services.php">All</a>
					</li>                        
					<li class="active">
						<strong>Service Categories</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
						   <span><a href="servicemaster.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Service Master</span></button></a></span>
				</p>
				</div>
		</div>
		<?php
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_servicecategories");
		?>
					</form>
						</br>
			<div class="row">
               <div class="col-lg-3">
			   </div>
               <div class="col-lg-6">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>SERVICE CATEGORY PRICES</i>
						</div>
						<div class="ibox-content">
						<table class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
								<th>Name</th>
								<th>Actions </th>
							</tr>
							</thead>
							<tbody>
							
							<?php 
							while($gac = mysqli_fetch_array($getPatients)){
							$sc_code = $gac['sc_code'];
							$sc_name = $gac['sc_name'];
							?>
							<?php "<tr class='gradeX'/>"; ?>
								<td><?php echo $sc_name; ?></td>
								<td>
								<?php
								$getcontacts = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
									while($gc = mysqli_fetch_array($getcontacts)){
									$pscheme_code = $gc['pscheme_code'];
									$pscheme_name = $gc['pscheme_name'];
									
									
								$getcontactss = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_service_prices sp INNER JOIN tbl_services c ON sp.sp_code=c.ss_code WHERE sp.sp_schemecode='$pscheme_code' AND c.ss_category='$sc_code'");
								$gccc = mysqli_fetch_array($getcontactss);
								$g_alllabcountt = $gccc['c'];
									?>
									<b><small><a href="services.php?catcode=<?php echo $sc_code; ?>&schemecode=<?php echo $pscheme_code; ?>&n=<?php echo $pscheme_name; ?>" data-toggle="modal" title="Open"><?php echo $pscheme_name; ?> <span class="badge badge-primary"><?php echo $g_alllabcountt; ?></span></a></small></b> </br>
									<?php
									}
									?>
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
			 <div class="col-lg-3">
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
