<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Logs - <?php echo "$smart_name"; ?></title>
	
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
					
					<div class="col-lg-12">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>History of System Activities</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped dataTables-example table-bordered table-hover dataTables-example" >
								
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>Email</th>
									<th>User Name</th>
									<th>Activity</th>
									<th>Time</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM log_table");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$user_id_no = $gcn['user_id_no'];
									$time = $gcn['time'];
									$action = $gcn['action'];
									$user_name = $gcn['user_name'];
								
								?>
									<td><?php echo $user_id_no; ?></td>
									<td><?php echo $user_name; ?></td>
									<td><?php echo $action; ?></td>
									<td><?php echo $time; ?></td>
									
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
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
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
</body>
</html>
