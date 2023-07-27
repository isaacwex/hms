<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<title>Contact Groups - <?php echo $smart_name; ?></title>
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
		<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<div class="wrapper wrapper-content">
				<div class="row">
				<form method="POST">
					<?php
					if(isset($_POST['sendbulk'])){
								if(empty($_POST['Farmers'])||empty($_POST['bulksms'])){
									echo "<div class='alert alert-error'>
								<button type='button' class='close danger' data-dismiss='alert'>X</button>You must select items on the list</div>";
								}
								else{
							$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
									$txt=$_POST['bulksms'];
							$getphone = mysqli_query($dbconnect, "SELECT c.phone_no FROM tbl_contacts c INNER JOIN tbl_category_assignment a ON a.category_id=('".$checkBox[$i]."')");
									$gphone= mysqli_fetch_assoc($getphone);
									$phne=$gphone['phone_no'];
									
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
                <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Contact Groups <?php echo $smart_name;?> System</h5>
                    </div>
                  <div class="ibox-content">
				  <div class="row">
					<div class="col-sm-4">
						<div class="col-sm-12">													
							<?php
							if(isset($_POST['newgroup'])){
								if(empty($_POST['group_id'])){
									echo "We need group id (Should be a unique number assigned to the group)";
								}
								elseif(empty($_POST['group_name'])){
									echo "We need group name.";
								}
								else {
									$group_id = $dbconnect->real_escape_string($_POST['group_id']);
									$group_name = $dbconnect->real_escape_string($_POST['group_name']);
									$group_description = $dbconnect->real_escape_string($_POST['group_description']);
									$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_categories WHERE cat_no='$group_id'");
									$countNo = mysqli_num_rows($checknumber);
									if($countNo >= 1){
												?>
												<script>
												alert('That group_id already exists. <?php echo "$dbconnect->error()";?>');
													window.location = 'groups.php';
												</script>	
												<?php
																
											}
										else {
											if($stmt = $dbconnect->prepare("INSERT INTO tbl_categories (cat_no, category_name, cat_description) VALUES (?,?,?)")){
												$stmt->bind_param('sss',$group_id, $group_name, $group_description);
												$stmt->execute();
																	
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
																		 alert('Not Successful <?php echo "$dbconnect->error()"; ?>');
																		window.location = 'contacts.php';
																			</script>	
																	<?php
																	
																}
															}
															
														}
														
													}
												?>
												</div>
												<div class="col-sm-12">
														<div class="form-group">
															<label>Group Code</label>
															<input type="number" required  name="group_id" placeholder="Enter Group Code" class="form-control">
														</div>
														<div class="form-group">
															<label>Group Name</label>
															<input type="text" name="group_name" required placeholder="Enter group name" class="form-control">
														</div>
														<div class="form-group">
															<label>Group Description</label>
															<textarea name="group_description" class="form-control" placeholder="Type the group description" rows="4"></textarea>
														</div>
														<div class="form-group">
															<input type="submit" name="newgroup" class="btn btn-lg btn-primary" value="Add New Group" />
														</div>
												</div>
													</form>
											
					
					</div>
					
					<div class="col-lg-8">
						<table class="table table-striped table-bordered table-hover dataTables-example1" >
						<thead>
						<tr>
							<th>Group Code</th>
							<th>Group Name</th>
							<th>Description</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$No = 0;
						$getAllGroups = mysqli_query($dbconnect, "SELECT * FROM tbl_categories");
						while($gac = mysqli_fetch_array($getAllGroups)){
						$No=$No+1;
						$c_id = $gac['cat_no'];
						$group_id = $gac['cat_no'];
						$cat_name = $gac['category_name'];
						$cat_description = $gac['cat_description'];
						?>
						<tr class="gradeX">
					  <td><?php echo $group_id; ?></td>
							<td><?php echo $cat_name; ?></td>
							<td><?php echo $cat_description; ?></td>
							<td><button class="btn-xs btn-primary" data-toggle="modal" data-target="#edit<?php echo $c_id;?>"><i class="fa fa-pencil-square"></i> Edit</button>
							<!-- edit contact -->							
								<?php include('modals/edit-group.php');?>
							|
							<?php
							if(isset($_GET['delete'])){
								$deleted = $_GET['delete'];
								$action = mysqli_query($dbconnect,"DELETE FROM tbl_categories WHERE cat_no='$deleted'");
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
										alert('Error occurred<?php echo "$dbconnect->error()";?>');
											window.location = 'groups.php';
									</script>	
									<?php
								}
							}
							
							?>
							<a href="groups.php?delete=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $group_name; ?> from your contact list?')" ><i class="fa fa-trash"></i> Delete </button></a>
						<a href="group-members.php?cat=<?php echo $c_id ?>"><button class="btn-xs btn-info" data-toggle="modal" type="button" data-target="#edit"><i class="fa fa-pencil-square"></i>View Members</button></a>
							</td>
						</tr>
						<?php
						}
						?>
						
						</tbody>
						<tfoot>
						<tr>
							
						</tr>
						</tfoot>
						</table>
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
