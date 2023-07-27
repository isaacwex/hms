<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

	
    <title>Users - <?php echo $smart_name; ?></title>
	
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
			<div class="row">
				<div class="row">
				<div class="col-lg-12">
					<p class="pull-right">
                        <!--<span><button class="btn btn-primary " data-toggle="modal" data-target="#newcontact" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Contact</span></button></span> -->
						<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add New Customer</span></button></a></span>
						
						<!-- Well start --->
						<?php include 'modals/new-contact.php'; ?>
					</p>
						
				</div>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All User Accounts on <?php echo $smart_name;?> System</h5>
                    </div>
                    <div class="ibox-content">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
							<th><input type="checkBox" id="toggle" value="select" onClick="do_this()" /></th>
							<th>Full Names</th>
							<th>Phone Number</th>
							<th>ID No</th>
							<th>Email Address</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						
						<?php 
						$No = 0;
						$getAllUsers = mysqli_query($dbconnect, "SELECT * FROM users");
						while($gau = mysqli_fetch_array($getAllUsers)){
						$No=$No+1;
						$u_id = $gau['id'];
						$f_name = $gau['f_name'];
						$s_name = $gau['s_name'];
						$idnum = $gau['id_no'];
						$emailad = $gau['email'];
						$phoneNo = $gau['phone'];
						$allNames = "$f_name $s_name";
						
						?>
						<?php "<tr class='gradeX'/>"; ?>
							<?php echo "<td class='a-center '><input type='checkbox' value ='$u_id' class='flat' name='Farmers[]' ></td>"; ?>
							<td><?php echo $allNames; ?></td>
							<td><?php echo $phoneNo; ?></td>
							<td><?php echo $idnum; ?></td>
							<td><?php echo $emailad ?></td>
							<td><a href="#edit<?php echo $u_id;?>" data-toggle="modal" title="Edit Contact"><button class="btn-xs btn-primary"><i class="fa fa-pencil-square"></i> Edit</button></a>
							<!-- edit contact -->							
								<?php include('modals/edit-user.php');?>
							<!-- edit contact end -->
							|
							<?php
							if(isset($_GET['delete'])){
								$deleted = $_GET['delete'];
								$action = mysqli_query($dbconnect,"DELETE FROM users WHERE id='$deleted'");
								if($action){
									?>
									<script>
										alert('User deleted successfully<?php echo "$dbconnect->error()";?>');
											window.location = 'contacts.php';
									</script>	
									<?php
								}
								else {
								
									?>
									<script>
										alert('Error deleting user <?php echo "$dbconnect->error()";?>');
											window.location = 'contacts.php';
									</script>	
									<?php
								}
							}
							
							?>
							<a href="users.php?delete=<?php echo $u_id; ?>"><button type="button" class="btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete <?php echo $allNames; ?> from your users list?')" ><i class="fa fa-trash"></i> Delete User </button></a></td>
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
							<th>ID No</th>
							<th>Email Address</th>
							<th>Actions</th>
						</tr>
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
