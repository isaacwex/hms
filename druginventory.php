<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Inventory - <?php echo $smart_name; ?></title>
	
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
		$current_processstage='REGISTRY';
		$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_inventory  ORDER BY inve_invoiceno DESC limit 10");
		$title='Current drug Inventory';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
			<div class="row">
				<div class="col-lg-7">
				<h2>Search for drug</h2>
				</div>
				<div class="col-lg-5">
				<p class="pull-right">
				<span><a href="add-drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Inventory</span></button></a></span>
						   <span><a href="add-drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Stock</span></button></a></span>
						</p>
				</div>
				</div>
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE id_no LIKE '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR f_name LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%'");
					
					$title='Search Results from the registry List';
					}
					?>
					</div>
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-7">
					<input type="text" name="searchterm" required placeholder="Search by Name/ID No./location/phone" class="form-control"/>
				</div>
				<div class="col-sm-3">
					<button name="new-search" class="btn btn-success" type="submit">Search!</button>
					<span><a href="registry.php"><button class="btn btn-success" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> Reset</span></button></a></span>
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
							<th>OP No</th>
							<th>Full Names</th>
							<th>ID Number</th>
							<th>Phone Number</th>
							<th>Gender</th>
							<th>DoB</th>
							<th> Scheme</th>
							<th>Last visit No</th>
							<th>Actions </th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						while($gac = mysqli_fetch_array($getdrugs)){
						$No=$No+1;
						$c_id = $gac['reg_no'];
						$fnames = $gac['f_name'];
						$lnames = $gac['l_name'];
						$id_number = $gac['id_no'];
						$phonenumber = $gac['phone_no'];
						$gender = $gac['gender'];
						$dob = $gac['dob'];
						$opno = $gac['opno'];
						$visitno = $gac['visit_no'];
						$reside = $gac['residence'];
						$scheme_code = $gac['scheme_code'];
						$visit_date = $gac['visit_date'];
						$todaydate = date('Y-m-d');
						
						
							$getmaxv= mysqli_query($dbconnect,"SELECT Max(visit_no) as visitnonext FROM tbl_visits WHERE visit_opno='$opno'");
							$asre = mysqli_fetch_array($getmaxv);
							$visitnoforupdate = $asre['visitnonext'];
							$visitnoforupdate = $visitnoforupdate+1;
						
						$current_visit_no = $visitnoforupdate;
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<?php echo "<td class='a-center '><input type='checkbox' value ='$c_id' class='flat' name='Farmers[]' ></td>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td><?php echo "$scheme_code"; ?></td>
							<td><?php echo $visitno; ?></br>
							<?php
										$getvisit = mysqli_query($dbconnect, "SELECT max(visit_no) as last_visit FROM  tbl_visits WHERE visit_opno='$opno'");
										$visitarray = mysqli_fetch_assoc($getvisit);
										$visit_noo = $visitarray['last_visit'];
										
										$getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_visits WHERE visit_opno='$opno' AND visit_no='$visit_noo'");
										while($lrarray = mysqli_fetch_array($getls)){
											//$No=$No+1;
											$visit_datetime = $lrarray['visit_datetime'];
											?>
											<?php echo "Current Visit No.: $visit_noo"; ?> (<?php echo $visit_datetime; ?>)</br>
											
											<?php
											if(isset($_GET['newvisit'])){
												$visit_psnid = $_GET['newvisit'];
												$update_item = "UPDATE tbl_registry SET visit_no=? WHERE reg_no='$visit_psnid'";
														if($stmt = $dbconnect->prepare($update_item)) {
															$stmt->bind_param('s',$current_visit_no);
															$stmt->execute();
												
														if($stmtv = $dbconnect->prepare("INSERT INTO tbl_visits (visit_opno, visit_no) VALUES (?,?)")){
																	$stmtv->bind_param('ss', $opno, $current_visit_no);
																	$stmtv->execute();
																}
																else{}
															?>
																<script>
																	alert('Successfully<?php echo "$dbconnect->error()";?>');
																	window.location = 'registry.php';
																</script>	
															<?php
														}
														else {}
											}
											?>
										<a href="registry.php?newvisit=<?php echo $c_id; ?>"><button type="button" class="btn-xs btn-warning" onclick="return confirm('Are you sure you want to create a new visit for <?php echo "$fnames $lnames"; ?>? This should only be done when the drug is returning for some new visit. Be sure a bout your action.')" >Generate New Visit No</button></a>
											<?php
										}
							?>
							</td>
							
							<td>
							<div class="input-group-btn">
								<button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle" type="button">Action <span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
									<a href="queue.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">Queue drug</button></a>	
									</li>
									<li>
									<a href="#update<?php echo $c_id;?>" data-toggle="modal" title="Edit Contact">Edit drug</a>		
									<?php include('modals/edit-drug.php');?>
									</li>
									
									<li class="divider"></li>
									<li>
									<a target="_blank" href="viewlabreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Lab Report</a>
									</li>
									<li>
									<a target="_blank" href="consultationreport.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>">View Consultation Report</a>
									</li>
									<li><a href="#">View drug Visits</a></li>
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
		</form>
		<?php include 'includes/footer.php'?>
    </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="search-input" placeholder="Search...">
        </div>
        <div id="search-results"></div>
      </div>
    </div>
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
