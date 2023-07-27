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

        <div class="wrapper wrapper-content">
		<form method="POST">
		<?php
							if(isset($_POST['approveall'])){
							/*$deQ = mysql_query("UPDATE verifiedfarmers AS v INNER JOIN users AS u ON v.EMPLOYEE_CODE=u.EMPLOYEE_CODE 
								SET v.VERIFICATION_STATUS='4', v.EMPLOYEE_CODE='$emp_check' WHERE v.EMPLOYEE_CODE=u.EMPLOYEE_CODE AND (v.VERIFICATION_STATUS='2' OR v.VERIFICATION_STATUS='5')");*/
							if(empty($_POST['Farmers'])){
									echo "<div class='alert alert-error'>
								<button type='button' class='close' data-dismiss='alert'>X</button>You must select items on the list</div>";
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
					?>
			<div class="row">
				<!--<div class="col-lg-12">
					<p class="pull-right">
                        <a href="add-contact.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Contact</span></button></a>
                        <button class="btn btn-success " data-toggle="modal" data-target="#bulkcontactgroup" type="button"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload Bulk Group Assigned Contacts</span></button>                  
                        
						<?php //include 'modals/bulk-contact-group.php';?>
					</p>
				</div>--->
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Assign Contacts to groups on <?php echo $smart_name;?> System</h5>
                    </div>
                    <div class="ibox-content">
					
					<div class="row">
							<div class="col-lg-12">
								<?php
													if(isset($_POST['assign'])){
														if(empty($_POST['con'])||empty($_POST['gr'])){
															echo "Plz select contact and the group";
														}
														else {
															$contact_id = $dbconnect->real_escape_string($_POST['con']);
															$group_id = $dbconnect->real_escape_string($_POST['gr']);
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_category_assignment WHERE contact_id='$contact_id' AND category_id='$group_id'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																echo "Oops! Already assigned to the group";
															}
															else {
																if($stmt = $dbconnect->prepare("INSERT INTO tbl_category_assignment (contact_id, category_id) VALUES (?,?)")){
																	$stmt->bind_param('ss',$contact_id, $group_id);
																	$stmt->execute();
																		echo "<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Yay! Successfully assigned group.</div>";
																	}
																	else {
																		echo "<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Ooops! Group assignment failed.</div>";
																	}
															}
														}
													}
												?>
							</div>							
							<div class="col-lg-6">
							<div class="form-group">
								<select class="form-control chosen-select" name="con" required>
								<option selected="selected" value="">~~ Select Contact~~</option>
							<?php
								$getAllContactsa = mysqli_query($dbconnect, "SELECT * FROM tbl_contacts");
								while($gaca = mysqli_fetch_array($getAllContactsa)){
								$phone_no = $gaca['phone_no'];
								$names = $gaca['names'];
								$village_name = $gaca['village'];
								$contact_id = $gaca['contact_id'];
								echo "<option value='$contact_id'>$names $phone_no - $village_name</option>";
							}
							?>
								</select>
							</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
							<select class="form-control chosen-select" name="gr" required">
								<option selected="selected" value="">~~ Select Group~~</option>
							<?php
								$getAllContactsaa = mysqli_query($dbconnect, "SELECT * FROM tbl_categories");
								while($gacaa = mysqli_fetch_array($getAllContactsaa)){
								$cat_no = $gacaa['cat_no'];
								$cat_name = $gacaa['category_name'];
								echo "<option value='$cat_no'>$cat_name</option>";
							}
							?>
						</select>
								</div>
							</div>
							</div>
							<div class="col-lg-4">
							</div>
							<div class="col-lg-4">
								<input type="submit" name="assign" class="btn btn-block btn-primary btn-lg" value="Assign Member to Group" />
							</div>
							<div class="col-lg-4">
							</div>
						</div>
					<table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th><input type="checkBox" id="toggle" value="select" onClick="do_this()" /></th>
							<th>Full Names</th>
							<th>Phone Number</th>
							<th>Ward</th>
							<th>Sub County</th>
							<th>Group</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						$getAllContacts = mysqli_query($dbconnect, "SELECT * FROM tbl_categories c INNER JOIN tbl_category_assignment ca ON ca.category_id=c.cat_no INNER JOIN tbl_contacts co ON co.contact_id=ca.contact_id");
						while($gac = mysqli_fetch_array($getAllContacts)){
						$No=$No+1;
						$c_id = $gac['cat_assignment_id'];
						//$c_id = $gac['cat_no'];
						$cat_name = $gac['category_name'];
						$contact_name=$gac['names'];
						$subcounty=$gac['subcounty'];
						$phone=$gac['phone_no'];
						$ward=$gac['ward'];
						
						?>
						<tr class="gradeX">
							<?php echo "<td class='a-center '><input type='checkbox' value ='$c_id' class='flat' name='Farmers[]' ></td>"; ?>
							<?php echo "<td class='a-center '>$contact_name</td>"; ?>
							<?php echo "<td class='a-center '>$phone</td>"; ?>
							<?php echo "<td class='a-center '>$ward</td>"; ?>
							<?php echo "<td class='a-center '>$subcounty</td>"; ?>
							<?php echo "<td class='a-center '>$cat_name</td><td>"; ?>
                     
							<?php
							if(isset($_GET['delete'])){
								$deleted = $_GET['delete'];
								$action = mysqli_query($dbconnect,"DELETE FROM tbl_groups WHERE cat_no='$deleted'");
								if($action){
									?>
									<script>
										alert('Successful<?php echo "$dbconnect->error()";?>');
											window.location = 'groups.php';
									</script>	
									<?php
								}
								else {
								
									?>
									<script>
										alert('Not successful. Error occurred<?php echo "$dbconnect->error()";?>');
											window.location = 'groups.php';
									</script>	
									<?php
								}
							}
							
							?>
							<a href="group_assignment.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure of this action?')" ><i class="fa fa-trash"></i> Remove from Group </button></a></td>
						</tr>
						<?php
						}
						?>
						</tbody>
						<tfoot>
						
						</tfoot>
						</table>
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
	
	<script type="text/javascript">
	var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
</script>
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
