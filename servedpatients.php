<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Served Patients - <?php echo $smart_name; ?></title>
	
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
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE visit_status='1' ORDER BY reg_no DESC limit 30");
		$title='Newly Added Patients';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
				<div class="row">
					<div class="col-lg-7">
					<h2>Search for patients</h2>
					</div>
				</div>
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE id_no LIKE '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR f_name LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%'");
					
					$title='Search Results from the List';
					}
					?>
					</div>
			<div class="row">		
				<div class="col-sm-2"> 
					<div class="form-group">
						<label>Start Date</label>
						<input type="date" name="startdate" placeholder="Start Date" class="form-control datepicker">
					</div>
				</div>
					<div class="col-sm-2"> 
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" placeholder="End Date" class="form-control datepicker">
						</div>
					</div>
				<div class="col-sm-1"> 
						<div class="form-group">
						<label>Gender</label>
						<select name="dischargestate" required class="form-control" >
								<option value="*" >All </option>
								<option value="MALE" >MALE </option>
								<option value="FEMALE" >FEMALE </option>
						</select>
					</div>	
				</div>	
				<div class="col-sm-1"> 
					<div class="form-group">
					<label>Adult/Child</label>
					<select name="dischargestate" required class="form-control" >
							<option value="*" >ADULT/CHILD </option>
							<option value="ADULT" >ADULT </option>
							<option value="CHILD" >CHILD </option>
					</select>
					</div>
				</div>
				<div class="col-sm-1"> 
					<div class="form-group">
					<label>Scheme</label>
					<select name="dischargestate" required class="form-control" >
							<option value="*" >All Schemes </option>
							<option value="ADULT" >NHIF </option>
							<option value="CHILD" >CASH </option>
							<option value="DEAD" >Britam </option>
					</select>
				</div>				
				</div>	
				<div class="col-sm-2">
					<div class="form-group">
					<label>Name/ID/Phone</label>
						<input type="text" name="searchterm" required placeholder="Search by Name/ID No./location/phone" class="form-control"/>
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						<button name="new-search" class="btn btn-primary" type="submit">Search!</button>
						
					</div>									
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						<span><a href="registry.php"><button class="btn btn-primary" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> </span>Refresh</button></a></span>
					</div>									
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
							<th>OP No</th>
							<th>Full Names</th>
							<th>ID Number</th>
							<th>Phone Number</th>
							<th>Gender</th>
							<th>DoB</th>
							<th> Scheme</th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
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
						$visitno = $gac['visit_no'];
						$reside = $gac['residence'];
						$scheme_code = $gac['scheme_code'];
						$scheme_name = $gac['pscheme_name'];
						$visit_date = $gac['visit_date'];
						$todaydate = date('Y-m-d');
						
						
							$getmaxv= mysqli_query($dbconnect,"SELECT Max(visit_no) as visitnonext FROM tbl_visits WHERE visit_opno='$opno'");
							$asre = mysqli_fetch_array($getmaxv);
							$visitnoforupdate = $asre['visitnonext'];
							$visitnoforupdate = $visitnoforupdate+1;
						
						$current_visit_no = $visitnoforupdate;
						?>
						<?php "<tr class='gradeX'>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td><?php echo "$scheme_name"; ?></td>
							
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
