<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Registry Report - <?php echo $smart_name; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
		<style>
			.divScroll {
			overflow:scroll;
			height:500px;
			width:1200px;
			}
		</style>
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
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code ORDER BY reg_no");
		$title='Newly Added Patients';
		$todaydate = date('Y-m-d');
		?>
        <div class="wrapper wrapper-content">
		<form method="POST">
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
							$startdate=$_POST['startdate'];
							$enddate=$_POST['enddate'];
							$gender=$_POST['gender'];
							$category=$_POST['category'];
							$schemecode=$_POST['schemecode'];
								
						//echo"hhhhhhhhhhhhhhhhhhhh $startdate $enddate";				
					//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE id_no LIKE '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR f_name LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%'");
					
					//gender
					if($gender=='*'){
						$genderpart="r.gender='MALE' OR r.gender='FEMALE'";
					}else{
						$genderpart="r.gender='$gender'";
					}
					//$datepart="";
					if($startdate==""||$enddate==""){
						$datepart="";
					}
					else{
						//$datepart="AND r.visit_date BETWEEN DATE_FORMAT('$startdate', '%Y %M %d') AND DATE_FORMAT('$enddate', '%Y %M %d')";
						$datepart="AND r.visit_date BETWEEN '$startdate' AND '$enddate'";
					}
					//category part
					if($category=='*'){
						$categorypart="";
					}else{
						$categorypart="AND r.agecategory='$category'";
					}
					//scheme part 
					if($schemecode=='*'){
						$schemecodepart="";
					}else{
						$schemecodepart="AND r.schemecode='$schemecode'";
					}

					$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE $genderpart $datepart $categorypart $schemecodepart ORDER BY r.reg_no");
					
					$title='Search Results from the List';
					}
					?>
					</div>
			<div class="col-lg-12">
					<h2>Registry History</h2>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading">		
				<div class="col-sm-2"> 
					<div class="form-group">
						<label>Start Date</label>
						<input type="date" name="startdate" value="<?php echo $todaydate; ?>" placeholder="Start Date" class="form-control">
					</div>
				</div>
					<div class="col-sm-2"> 
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" value="<?php echo $todaydate; ?>" placeholder="End Date" class="form-control datepicker">
						</div>
					</div>
				<div class="col-sm-1"> 
						<div class="form-group">
						<label>Gender</label>
						<select name="gender" required class="form-control" >
								<option value="*" >ALL </option>
								<option value="MALE" >MALE </option>
								<option value="FEMALE" >FEMALE </option>
						</select>
					</div>	
				</div>	
				<div class="col-sm-1"> 
					<div class="form-group">
					<label>Adult/Child</label>
					<select name="category" required class="form-control" >
							<option value="*" >ADULT/CHILD </option>
							<option value="ADULT" >ADULT </option>
							<option value="CHILD" >CHILD </option>
					</select>
					</div>
				</div>
				<div class="col-sm-1"> 
					<div class="form-group">
					<label>Scheme</label>
							<select name="schemecode" required class="form-control">
								<option value="*" >All Schemes </option>
										<?php
									$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
									while($gal = mysqli_fetch_array($getalllocations)){
										$pscheme_code = $gal['pscheme_code'];
										$pscheme_name = $gal['pscheme_name'];
										?>
										<option value="<?php echo $pscheme_code; ?>" ><?php echo $pscheme_name; ?></option>
										<?php
									}
									?>
							</select>
						
				</div>				
				</div>	
				<div class="col-sm-2">
					<div class="form-group">
					<label>Name/ID/Phone</label>
						<input type="text" name="searchterm" placeholder="Search by Name/ID No./location/phone" class="form-control"/>
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
					<label></label>
						<button name="new-search" class="btn btn-primary" type="submit">Search!</button>
						
					</div>									
				</div>
				<div class="col-sm-1">
					<div class="form-group">
					<label></label>
						<span><a href="registryreport.php"><button class="btn btn-primary" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<span class="bold"> </span>Refresh</button></a></span>
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
                    <div class="ibox-content divScroll">
					<table class="table dataTables-example table-striped table-bordered table-hover" style="width: 100%;">
						<thead>
						<tr>
							<th>OP No</th>
							<th>VisitNo</th>
							<th>Names</th>
							<th>ID No</th>
							<th>Phone No</th>
							<th>Gender</th>
							<th>DoB</th>
							<th> Scheme</th>
							<th> MemberNo</th>
							<th> Residence</th>
							<th> Category</th>
							<th> Age</th>
							<th> ParentFname</th>
							<th> ParentLname</th>
							<th> VisitDate</th>
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
						$residence = $gac['residence'];
						$scheme_code = $gac['scheme_code'];
						$memberno = $gac['memberno'];
						$scheme_name = $gac['pscheme_name'];
						$age = $gac['age'];
						$parentFname = $gac['parentFname'];
						$parentLame = $gac['parentLame'];
						$visit_date = $gac['visit_date'];
						$agecategory = $gac['agecategory'];
						$todaydate = date('Y-m-d');
									
							$getmaxv= mysqli_query($dbconnect,"SELECT Max(visit_no) as visitnonext FROM tbl_visits WHERE visit_opno='$opno'");
							$asre = mysqli_fetch_array($getmaxv);
							$visitnoforupdate = $asre['visitnonext'];
							$visitnoforupdate = $visitnoforupdate+1;
						
						$current_visit_no = $visitnoforupdate;
						?>
						<?php "<tr class='gradeX'>"; ?>
							<td><?php echo $opno; ?></td>
							<td><?php echo $visitno; ?></td>
							<td><?php echo "$fnames $lnames"; ?></td>
							<td><?php echo $id_number; ?></td>
							<td><?php echo $phonenumber; ?></td>
							<td><?php echo "$gender";?></td>
							<td><?php echo "$dob";?></td>
							<td><?php echo "$scheme_name"; ?></td>
							<td><?php echo "$memberno"; ?></td>
							<td><?php echo "$residence"; ?></td>
							<td><?php echo "$agecategory"; ?></td>
							<td><?php echo "$age"; ?></td>
							<td><?php echo "$parentFname"; ?></td>
							<td><?php echo "$parentLame"; ?></td>
							<td><?php echo "$visit_date"; ?></td>
							
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
