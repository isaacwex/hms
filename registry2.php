<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Registry - <?php echo $smart_name; ?></title>
	
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
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry ORDER BY reg_no DESC limit 10");
		$title='Newly Added Patients';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
		<?php
							if(isset($_POST['approveall'])){
							if(empty($_POST['Farmers'])){
									echo "<div class='alert alert-error'>
								<button type='button' class='close' data-dismiss='alert'>X</button>You must select items on the list and enter the message text to broadcast</div>";
								}
								else{
							$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
									$action = mysqli_query($dbconnect,"DELETE FROM tbl_contacts WHERE contact_id=('".$checkBox[$i]."')");
								}
							if($action){
								?>
								<script type="text/javascript">
									alert('Successful!');
									window.location = 'registry.php';
								</script> 
							<?php
						}else{
							?>
								<script type="text/javascript">
									alert('Not successful. Error occured');
									window.location = 'registry.php';
								</script> 
							<?php
							
						}
							}
							}
					?>
			<div class="row">
				<div class="col-lg-7">
				<h2>Search for revists or add for new visits</h2>
				</div>
				<div class="col-lg-5">
				<p class="pull-right">
						   <span><a href="add-registry.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Patient</span></button></a></span>
						</p>
				</div>
				</div>
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
								$cfullnames = $dbconnect->real_escape_string($_POST['fullNames']);
								
								$cward = $dbconnect->real_escape_string($_POST['ward']);
								$cpstation = $dbconnect->real_escape_string($_POST['pstation']);
								$scsubcounty = $dbconnect->real_escape_string($_POST['subcounty']);
						
					
					$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE names like '%$cfullnames%' OR phone_no LIKE '%$cfullnames%' OR id_no LIKE '%$cfullnames%' OR gender='$cfullnames' OR address LIKE '%$cfullnames%' OR village LIKE '%$cfullnames%' OR sublocation LIKE '%$cfullnames%' OR location LIKE '%$cfullnames%' ORDER BY contact_id DESC");
					$title='Search Results from the registry List';
					}
					?>
					</div>
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-7">
					<input type="text" name="fullNames" required placeholder="Search by Name/ID No./location/phone" class="form-control"/>
				</div>
				<div class="col-sm-3">
					<button name="new-search" class="btn btn-success" type="submit">Search!</button>
					<span><a href="contacts.php"><button class="btn btn-success" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
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
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th><input type="checkBox" id="toggle" value="select" /></th>
							<th>Full Names</th>
							<th>ID Number</th>
							<th>Phone Number</th>
							<th>Gender</th>
							<th>DoB</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts C INNER JOIN tbl_locations k ON C.county=k.location_id OR C.subcounty=k.location_id OR C.sublocation=k.location_id OR C.location=k.location_id OR C.pstation=k.location_id");
						
						
						//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts LIMIT 50");
						
						while($gac = mysqli_fetch_array($getPatients)){
						$No=$No+1;
						$c_id = $gac['reg_no'];
						$fnames = $gac['f_name'];
						$lnames = $gac['l_name'];
						$id_number = $gac['id_no'];
						$phonenumber = $gac['phone_no'];
						$gender = $gac['gender'];
						$dob = $gac['dob'];
						$opno = $gac['opno'];
						$reside = $gac['residence'];
						$visit_date = $gac['visit_date'];
						$todaydate = date('Y-m-d');
						
												
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<?php echo "<td class='a-center '><input type='checkbox' value ='$c_id' class='flat' name='Farmers[]' ></td>"; ?>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							
							
							
							
							<td>
							
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
									<a href="#edit<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Queue Patient</a>		
									<?php include('modals/queue.php');?>
									</li>
									<li>
									<a href="#update<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Edit Patient</a>		
									<?php include('modals/edit-patient.php');?>
									</li>
									<li><a href="#">Deactivate Patient</a></li>
									<?php
										if(isset($_GET['delete'])){
											$deleted = $_GET['delete'];
											$action = mysqli_query($dbconnect,"DELETE FROM tbl_registry WHERE contact_id='$deleted'");
											if($action){
												?>
												<script>
													alert('Patient deleted successfully<?php echo "$dbconnect->error()";?>');
														window.location = 'registry.php';
												</script>	
												<?php
											}
											else {
											
												?>
												<script>
													alert('Error deleting patient <?php echo "$dbconnect->error()";?>');
														window.location = 'registry.php';
												</script>	
												<?php
											}
										}
										?>
									<li><a href="contacts.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $names; ?> from your contact list?')" ><i class="fa fa-trash"></i>  </button> Delete Patient</a>
									</li>
									<li class="divider"></li>
									<li><a href="#">View Patient Visits</a></li>
									<li><a href="#">View Visits/Bills History</a></li>
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
        </div>
		<div class="container d-flex justify-content-center"> <button class="btn btn-danger " data-toggle="modal" data-target="#my-modal">Confirm Delete</button>
			<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content border-0">
						<div class="modal-body p-0">
							<div class="card border-0 p-sm-3 p-2 justify-content-center">
								<div class="card-header pb-0 bg-white border-0 ">
									<div class="row">
										<div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
									</div>
									<p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p>
									<p class="text-muted "> This change will reflect in your portal after an hour.</p>
								</div>
								<div class="card-body px-sm-4 mb-2 pt-1 pb-0">
									<div class="row justify-content-end no-gutters">
										<div class="col-auto"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button></div>
										<div class="col-auto"><button type="button" class="btn btn-danger px-4" data-dismiss="modal">Delete</button></div>
									</div>
								</div>
							</div>
						</div>
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
