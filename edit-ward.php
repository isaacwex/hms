<?php include('includes/authenticate.php');
$ward_id = $_GET['wardid'];

$getcountydetails = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$ward_id'");
$cdet = mysqli_fetch_array($getcountydetails);
$parent_id = $cdet['location_parent_id'];
$ward_name = $cdet['location_name'];


$getsubcounty = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$parent_id' AND location_type='2'");
$c_n = mysqli_fetch_array($getsubcounty);
$get_loc_id = $c_n['location_parent_id'];
$sub_county = $c_n['location_name'];

$getcounty = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$get_loc_id' AND location_type='1'");
$c_n = mysqli_fetch_array($getcounty);
$cou_id = $c_n['location_parent_id'];
$cou_name = $c_n['location_name'];

 ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Edit <?php echo ucwords(strtolower($ward_name)); ?> Ward - <?php echo "$smart_name"; ?></title>
	
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

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							<span><a href="wards.php"><button class="btn btn-primary" type="button"><i class="fa fa-eye"></i>&nbsp;&nbsp;<span class="bold"> View or Add Wards</span></button></a></span></p>
							
						</div>				
					</div>				
					<div class="col-lg-5">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Update Ward Details</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['updateward'])){
											if(empty($_POST['wardname'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> County name is required</div>";
														}
												else {
												$wardname = $dbconnect->real_escape_string($_POST['wardname']);
															
												if($stmt = $dbconnect->prepare("UPDATE tbl_locations SET location_name=? WHERE location_id='$ward_id'")){
													$stmt->bind_param('s',$wardname);
													$stmt->execute();
														
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> $wardname modified successfully</div>";
													}
													else {
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error occured while updating ward name</div>";	
														}
													}													
												}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>County Name</label>
													<input type="text" disabled value="<?php echo $cou_name; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Sub County Name</label>
													<input type="text" disabled value="<?php echo $sub_county; ?>" class="form-control">
												</div>
												<div class="form-group">
													<label>Ward Name</label>
													<input type="text" name="wardname" value="<?php echo $ward_name; ?>" class="form-control">
												</div>
												<div class="form-group">
													<button name="updateward" class="btn btn-md btn-primary" type="submit"><i class="fa fa-plus"></i> Update Ward</button>
												</div>	
											</div>																							
								</form>
							</div>
						</div> 
					 </div>
					</div>
					
					
					<div class="col-lg-7">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Wards</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Code</th>
									<th>Ward Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$ward_code = $gcn['location_id'];
									$ward_name = $gcn['location_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $ward_code; ?></td>
									<td><?php echo $ward_name; ?></td>
									<td><a href="edit-ward.php?wardid=<?php echo $ward_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit </button></a> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>
								</tr>
								<?php
								}
								?>
								
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>Code</th>
									<th>Ward Name</th>
									<th>Action</th>
								</tr>
								</tfoot>
								</table>
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
