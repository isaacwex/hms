<?php include('includes/authenticate.php'); 
$get_cat =$_GET['cat'];
$getcatname =mysqli_query($dbconnect,"SELECT category_name FROM tbl_categories WHERE cat_no ='$get_cat'");
$gen = mysqli_fetch_array($getcatname);
$cate_name = $gen['category_name'];

?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
    <title><?php echo "$cate_name - $smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<script type="text/javascript">
	$(function(){
		//add multiple select or deselect functions
		$("#selectall").click(function(){
			$('.case').attr('checked',this.checked);
		});
		$(".case").click(function(){
			if($(".case").length==$(".case:checked").length){
				$("#selectall").attr("checked","checked");
			}else {	
				$("#selectall").removeAttr("checked");
			}
		
		});
	});
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
                        <a href="add-contact.php"><button class="btn btn-primary " type="button"><i class="fa fa-plus"></i>&nbsp;Add New Contact</button></a>
                        <a href="contacts.php"><button class="btn btn-info " type="button"><i class="fa fa-eye"></i>&nbsp;View Contacts</button></a>
						<!-- Well start --->
						<?php include 'modals/new-contact.php'; ?>
						<?php include 'modals/bulk-contact.php';?>
					</p>
						
				</div>
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2> <b><?php echo "$cate_name";?> List</b> </h2>
                    </div>
                    <div class="ibox-content">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
							<th><input type="checkBox" id="toggle" value="select" onClick="do_this()" /></th>
							<th>Full Names</th>
							<th>Phone Number</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						$getgroupscats = mysqli_query($dbconnect,"SELECT contact_id FROM tbl_category_assignment WHERE category_id='$get_cat'");
						$con=mysqli_fetch_array($getgroupscats);
						$con_id = $con['contact_id'];
						
						//$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts WHERE contact_id='$con_id'");
						
						//$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_categories c INNER JOIN tbl_category_assignment ca ON ca.category_id=c.cat_no INNER JOIN tbl_contacts co ON co.contact_id=ca.contact_id");
						
						$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts tc INNER JOIN tbl_category_assignment co ON tc.contact_id=co.contact_id WHERE co.category_id='$get_cat'");
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
						
						
						$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='$county'");
						$gcn = mysqli_fetch_array($getcountyname);
						$county_name = $gcn['location_name'];
						?>
						<tr class="gradeX">
							<?php echo "<td class='a-center '><input type='checkbox' value ='$c_id' class='flat' name='Farmers[]' ></td>"; ?>
                      <td><?php echo $names; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><button class="btn-xs btn-primary" data-toggle="modal" type="button" data-target="#edit<?php echo $c_id;?>"><i class="fa fa-pencil-square"></i> Edit</button>
							<!-- edit contact -->							
								<?php include('modals/edit-contact.php');?>
							<!-- edit contact end -->
							<!-- | <button  data-toggle="modal" data-target="#send<?php //echo $c_id;?>"  type="button" class="btn-xs btn-success"><i class="fa fa-comments"></i> Message</button>
							<?php //include ('modals/single-message.php');?>-->
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
							<a href="contacts.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $names; ?> from your contact list?')" ><i class="fa fa-trash"></i> Remove </button></a></td>
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
								<input type="submit" name="sendbulk" class="btn btn-block btn-primary btn-lg" value="Send Bulk SMS" />
								
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

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
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
