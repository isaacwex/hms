<?php include('includes/authenticate.php'); ?>
<?php
	/*$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_leavetransactions");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	*/
	$applicantid = $sidno;
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Leave Entitlements - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
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
				<h2>Leave</h2>
				<ol class="breadcrumb">
					<li>
						<a href="leaveapplications.php"> Entitlements</a>
					</li>                        
					<li class="active">
						<strong> Entitlements and Balances</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<!--<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></p>-->
				</div>
		</div>

        <div class="wrapper wrapper-content">
                <div class="row">	
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Choose Leave type to see transactions</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['newleave'])){
											if(empty($_POST['leavetype'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Leave type is required to proceed</div>";
														}
												else {
												
												//$todaydate = date('Y-m-d');
												//$petty_transcode = $postnextcode;
												//$petty_code = $dbconnect->real_escape_string($_POST['petty_code']);
												
													$leavetype = $dbconnect->real_escape_string($_POST['leavetype']);
													
													echo '<META HTTP-EQUIV="Refresh" content="0; URL=leaveentitlementlist.php?leavecode='.$leavetype.'">';
												
														}
													}
												?>
											</div>
												
												<div class="col-sm-5">
													<div class="form-group">
														<select data-placeholder="Choose leave typer" name="leavetype" class="form-control chosen-select">
														
																<option selected value="">Select leave type from List </option>
																<?php
															$getalllocationss = mysqli_query($dbconnect,"SELECT * FROM tbl_leavetypes");
															while($ga = mysqli_fetch_array($getalllocationss)){
																$leavetype_code = $ga['leavetype_code'];
																$leavetype_name = $ga['leavetype_name'];
																?>
																<option value="<?php echo $leavetype_code; ?>" ><?php echo $leavetype_name; ?></option>
																<?php
															}
															?>
														</select>									
													</div>
												</div>
												
												<div class="col-sm-5">
													<div class="form-group">
														<button name="newleave" class="btn btn-md btn-primary" type="submit"> View</button>
													</div>																							
												</div>																							
								</form>
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
       <!-- Page-Level Scripts -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
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
