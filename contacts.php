<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
    <title>Contacts - <?php echo $smart_name; ?></title>
	
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
		
		<?php
		$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts ORDER BY contact_id DESC limit 30");
		$title='Newly Added Contacts';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
		<?php
							if(isset($_POST['approveall'])){
							/*$deQ = mysql_query("UPDATE verifiedfarmers AS v INNER JOIN users AS u ON v.EMPLOYEE_CODE=u.EMPLOYEE_CODE 
								SET v.VERIFICATION_STATUS='4', v.EMPLOYEE_CODE='$emp_check' WHERE v.EMPLOYEE_CODE=u.EMPLOYEE_CODE AND (v.VERIFICATION_STATUS='2' OR v.VERIFICATION_STATUS='5')");*/
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
									window.location = 'contacts.php';
								</script> 
							<?php
						}else{
							?>
								<script type="text/javascript">
									alert('Not successful. Error occured');
									window.location = 'contacts.php';
								</script> 
							<?php
							
						}
							}
							}
							
					if(isset($_POST['sendbulk'])){
								if(empty($_POST['Farmers'])||empty($_POST['bulksms'])){
									echo "<div class='alert alert-danger'>
								<button type='button' class='close' data-dismiss='alert'>X</button>You must select items on the list</div>";
								}
								else{
							$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
									$txt=$_POST['bulksms'];
									$getphone = mysqli_query($dbconnect, "SELECT phone_no FROM tbl_contacts WHERE contact_id=('".$checkBox[$i]."')");
									$gphone= mysqli_fetch_assoc($getphone);
									$phne=$gphone['phone_no'];
									//$txt = $dbconnect->real_escape_string($_POST['phone_no']);
									//$action = mysqli_query($dbconnect,"INSERT INTO MessageOut(MessageText, MessageTo) VALUES ($txt,$phne));
									
										if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageText, MessageTo) VALUES (?,?)")){
																	$stmt->bind_param('ss',$txt,$phne);
																	$stmt->execute();
																	
																	?>
																		<script>
																			alert('Succesfull...Attempting to send text....');
																			window.location = 'contacts.php';
																		</script>	
																	<?php
																}
						else{
							?>
								<script type="text/javascript">
									alert('Not successful. Error occured');
									window.location = 'contacts.php';
								</script> 
							<?php
							
						}
				}
					}
			}
					?>
		
		
			<div class="row">
				<div class="col-lg-12">
					<p class="pull-right">
                        <!--<span><button class="btn btn-primary " data-toggle="modal" data-target="#newcontact" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Contact</span></button></span> -->
						<span><a href="add-contact.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add</span></button></a></span>
						<span><button class="btn btn-success " data-toggle="modal" data-target="#bulkcontact" type="button"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload </span></button></span>
						<!--<span><input type="submit" name="sendbulk" class="btn btn-info " value="SMS" /></span>-->
                        <span><i class="fa fa-mail"></i>&nbsp;&nbsp;<button class="btn btn-danger" name="approveall" type="button" onclick="return confirm('Please Confirm!!!! This action will delete all the selected items on the list. Continue???')"><i class="fa fa-trash"></i> <span class="bold">Delete All</span></button></span>
						<!-- Well start --->
						<?php include 'modals/new-contact.php'; ?>
						<?php include 'modals/bulk-contact.php';?>
					</p>
						
				</div>
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
								$cfullnames = $dbconnect->real_escape_string($_POST['fullNames']);
								/*$cphone = $dbconnect->real_escape_string($_POST['phoneNumber']);
								$cidno = $dbconnect->real_escape_string($_POST['IDNo']);
								$cgender = $dbconnect->real_escape_string($_POST['gender']);
								$caddress = $dbconnect->real_escape_string($_POST['address']);
								$cvillage = $dbconnect->real_escape_string($_POST['village']);
								$csublocation = $dbconnect->real_escape_string($_POST['sublocation']);
								$clocation = $dbconnect->real_escape_string($_POST['location']);*/
								$cward = $dbconnect->real_escape_string($_POST['ward']);
								$cpstation = $dbconnect->real_escape_string($_POST['pstation']);
								$scsubcounty = $dbconnect->real_escape_string($_POST['subcounty']);
						
					//$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts WHERE names like '%$cfullnames%' OR phone_no LIKE '%$cfullnames%' OR id_no LIKE '%$cfullnames%' OR gender='$cfullnames' OR address LIKE '%$cfullnames%' OR village LIKE '%$cfullnames%' OR sublocation LIKE '%$cfullnames%' OR location LIKE '%$cfullnames%' OR ward='$cward' OR subcounty='$scsubcounty' OR pstation='$cpstation' ORDER BY contact_id DESC");
					$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts WHERE names like '%$cfullnames%' OR phone_no LIKE '%$cfullnames%' OR id_no LIKE '%$cfullnames%' OR gender='$cfullnames' OR address LIKE '%$cfullnames%' OR village LIKE '%$cfullnames%' OR sublocation LIKE '%$cfullnames%' OR location LIKE '%$cfullnames%' ORDER BY contact_id DESC");
					$title='Search Results from the Contact List';
						
					}
					?>
					</div>
			<!---
				<div class="col-sm-4">
					<input type="text" name="fullNames" placeholder="Enter Name" class="form-control"/>
					<input type="text" name="phoneNumber" placeholder="Phone Number" class="form-control"/>
					<input type="text" name="IDNo" placeholder="Enter ID Number" class="form-control">
					
					<select name="gender" class="form-control">
							<option value="*">All Gender</option>
							<option value="Female">Female</option>
							<option value="Male">Male</option>
					</select>
				</div>
				<div class="col-sm-4">
					<input type="text" name="village" placeholder="Village Name" class="form-control">
					<input type="text" name="sublocation" placeholder="Sub Location" class="form-control">
					<input type="text" name="location" placeholder="Location" class="form-control">
					<input type="text" name="address" placeholder="Postal Address" class="form-control">
				</div>
					<div class="col-sm-4">
						
						<select name="subcounty" required class="form-control" required>
								<option value="*" selected="selected">All SubCounties</option>
								<?php
							/*	$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='2'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];
									*/?>
									<option value="<?php //echo $loctype; ?>" ><?php //echo $locname; ?></option>
									<?php
								//}
								?>
						</select>
							<select name="ward" class="form-control">
							<option value="*" selected="selected">All Wards</option>
								<?php
								/*
								$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];*/
									?>
									<option value="<?php //echo $loctype; ?>" ><?php //echo $locname; ?></option>
									<?php
								//}
								?>
							</select>
							<select name="pstation" class="form-control">
							<option value="*" selected="selected">All Polling Stations</option>
								<?php
								/*$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='6'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];*/
									?>
									<option value="<?php //echo $loctype; ?>" ><?php //echo $locname; ?></option>
									<?php
								//}
								?>
							</select>
							<button name="new-search" class="btn btn-info" type="submit">Search!</button>
						</div>
						---->
					



					
				<div class="col-sm-9">
					<input type="text" name="fullNames" required placeholder="Search by Name/ID No./phone no./gender/address/village/sublocation/location" class="form-control"/>
				</div>
				<div class="col-sm-3">
					<button name="new-search" class="btn btn-primary" type="submit">Search!</button>
					<span><a href="contacts.php"><button class="btn btn-primary" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
				</div>
				<div class="col-sm-3">
						
						<select name="subcounty" required class="form-control" required>
								<option value="*" selected="selected">All SubCounties</option>
								<?php
								$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='2'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];
									?>
									<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
									<?php
								}
								?>
						</select>
				</div>
				<div class="col-sm-3">
							<select name="ward" class="form-control">
							<option value="*" selected="selected">All Wards</option>
								<?php
								
								$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];
									?>
									<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
									<?php
								}
								?>
							</select>
				</div>
				<div class="col-sm-3">
							<select name="pstation" class="form-control">
							<option value="*" selected="selected">All Polling Stations</option>
								<?php
								$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='6'");
								while($gal = mysqli_fetch_array($getalllocations)){
									$loctype = $gal['location_id'];
									$locname = $gal['location_name'];
									?>
									<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
									<?php
								}
								?>
							</select>
							
					</div>	
						</br>
						</br>
																		
					</div>
					<div class="row">
					
					</div>
					</form>
					

				
				
				
				
				
				
				
			
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use search functionality above to find more contacts of your choice)</i>
                    </div>
                    <div class="ibox-content">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
							<th><input type="checkBox" id="toggle" value="select" /></th>
							<th>Full Names</th>
							<th>Phone Number</th>
							<th>Ward</th>
							<th>Sub County</th>
							<th>Villages</th>
							<th>P. Station</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						//$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts C INNER JOIN tbl_locations k ON C.county=k.location_id OR C.subcounty=k.location_id OR C.sublocation=k.location_id OR C.location=k.location_id OR C.pstation=k.location_id");
						
						
						//$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts LIMIT 50");
						
						while($gac = mysqli_fetch_array($getAllContacts)){
						$No=$No+1;
						$c_id = $gac['contact_id'];
						$names = $gac['names'];
						$phonenumber = $gac['phone_no'];
						$ward = $gac['ward'];
						$c_address = $gac['address'];
						$c_village = $gac['village'];
						$county = $gac['county'];
												
						$cgendered = $gac['gender'];
						$sub_county = $gac['subcounty'];
						$slocation = $gac['sublocation'];
						$sc_location = $gac['location'];
						$idnumber = $gac['id_no'];
						$pstation = $gac['pstation'];
						
						$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$county' AND location_type='1'");
						$gcn = mysqli_fetch_array($getcountyname);
						$county_name = $gcn['location_name'];
						
						
						$getsubcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$sub_county' AND location_type='2'");
						$gscn = mysqli_fetch_array($getsubcountyname);
						$sub_county_name = $gscn['location_name'];
						
						$getwardname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$ward'");
						$gwardn = mysqli_fetch_array($getwardname);
						$ward_name = $gwardn['location_name'];
						
						$pstationname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$pstation'");
						$gpsn = mysqli_fetch_array($pstationname);
						$pstation_name = $gpsn['location_name'];
						
						$subcname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$sub_county'");
						$scn = mysqli_fetch_array($subcname);
						$locationdisplay = $scn['location_name'];
						
						
						
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<?php echo "<td class='a-center '><input type='checkbox' value ='$c_id' class='flat' name='Farmers[]' ></td>"; ?>
                      <td><?php echo $names; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$ward_name";?></td>
							<td><?php echo "$locationdisplay";?></td>
							<td><?php echo $c_village; ?></td>
							<td><?php echo $pstation_name;?></td>
							<td><a href="#edit<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact"><button class="btn-xs btn-primary"><i class="fa fa-pencil-square"></i> </button></a>
							<!-- edit contact -->							
								<?php include('modals/edit-contact.php');?>
							<!-- edit contact end -->
							<!--| <a href="#<?php //echo $c_id; ?>" data-toggle="modal" title="Text Details" ><button class="btn-xs btn-success"><i class="fa fa-comments"></i> Send Text </button></a>
							<?php // include ('modals/single-message.php');?>-->
							|
							<?php
							if(isset($_GET['delete'])){
								$deleted = $_GET['delete'];
								$action = mysqli_query($dbconnect,"DELETE FROM tbl_contacts WHERE contact_id='$deleted'");
								if($action){
									?>
									<script>
										alert('Contact deleted successfully<?php echo "$dbconnect->error()";?>');
											window.location = 'contacts.php';
									</script>	
									<?php
								}
								else {
								
									?>
									<script>
										alert('Error deleting contact<?php echo "$dbconnect->error()";?>');
											window.location = 'contacts.php';
									</script>	
									<?php
								}
							}
							
							?>
							<a href="contacts.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $names; ?> from your contact list?')" ><i class="fa fa-trash"></i>  </button></a></td>
						</tr>
						<?php
						}
						?>
						
						</tbody>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Full Names</th>
							<th>Phone Number</th>
							<th>Ward</th>
							<th>Sub County</th>
							<th>Villages</th>
							<th>P. Station</th>
							<th>Actions</th>
						</tr>
						</tfoot>
						</table>
				<div class="row">
							<div class="col-lg-8">
								<div class="form-group">
									<textarea name="bulksms" class="form-control" placeholder="Type a message to sent to selected recipients" rows="4"></textarea>
								</div>
							</div>
							<div class="col-lg-4">
								<input type="submit" name="sendbulk" class="btn btn-block btn-primary btn-lg" value="Send SMS to Selected" />
								
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
