<?php include('includes/authenticate.php'); 
date_default_timezone_set("Africa/Nairobi");
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Laboratory - <?php echo $smart_name; ?></title>
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
			//$labid = $_GET['id'];
			$labid = '2';
			$getlab_results = mysqli_query($dbconnect, "SELECT * FROM tbl_labrequests lb INNER JOIN tbl_labservices tl ON lb.labrequest_labservicecode=tl.labservice_code WHERE lb.labrequest_id='$labid'");
			$lre = mysqli_fetch_array($getlab_results);
			
			$lopno = $lre['labrequest_opno'];
			$lvno = $lre['labrequest_visitno'];
			$lvnote = $lre['labservice_note'];
			$lscode = $lre['labrequest_labservicecode'];
			$lvsample = $lre['labrequest_componentsample'];
			$lvresults = $lre['labrequest_results'];
			$lsname = $lre['labservice_name'];
			$lvcon = $lre['labrequest_conclusion'];
			$servicecode = $lre['labservice_code'];
			
			$patient_names = mysqli_query($dbconnect, "SELECT * FROM tbL_registry WHERE reg_no='$lopno'");
			$pd = mysqli_fetch_array($patient_names);
			
			$pid_no = $pd['id_no'];
			$pfname = $pd['f_name'];
			$pdob = $pd['dob'];
			$plname = $pd['l_name'];
			$pgender = $pd['gender'];
			$preside = $pd['residence'];
			
			$todaydate = date('Y-m-d');
			
			$leodate = date('d-m-Y, h:i:sA');
			
			$date1 = $pdob;
			$date2 = $todaydate;
			
			$diff = date_diff(date_create($pdob), date_create($todaydate));
			$agess = $diff->format('%y');
			
			$current_processstage='LABORATORY';
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry r on r.opno=q.queue_opno WHERE q.queue_to='$current_processstage'");
			$title='Patients for laboratory services';

		?>	
			
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>View Lab Reports</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Dashboard</a>
                        </li>
                        <li>
                            Laboratory
                        </li>
                        <li class="active">
                            <strong>Lab Report Lab ID = <?php echo "$lopno $servicecode  $lvnote - "; ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="title-action">
                        <a href="#" class="btn btn-info"><i class="fa fa-pencil"></i> Edit </a>
                        <a href="#" class="btn btn-primary"><i class="fa fa-save "></i> Save </a>
                        <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-danger"><i class="fa fa-print"></i> Print Lab Report</a>
                    </div>
                </div>
        </div>
        <div class="row">
			<div class="col-lg-1">
			</div>
            <div class="col-lg-10">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div id="printableArea">
					<div class="ibox-content p-xl">
						<!-- Hospital Details -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5></h5>
                                    <!-- <address>
                                        <strong><?php echo "$pfname $plname"; ?>.</strong><br>
                                        106 Jorg Avenu, 600/10<br>
                                        Chicago, VT 32456<br>
                                        <abbr title="Phone">P:</abbr> (123) 601-4590
                                    </address> -->
                                </div>
                                <div class="col-sm-6">
								  <div class="row justify-content-center">
									<div class="col-3 text-center">
										<h2><?php echo $smart_name; ?></h2>
										<address>
											<strong><?php echo "$pfname $plname"; ?>.</strong><br>
											106 Jorg Avenu, 600/10<br>
											Chicago, VT 32456<br>
											<abbr title="Phone">P:</abbr> (123) 601-4590
										</address>
									</div>
								  </div>
                                </div>
                                <div class="col-sm-3">
                                    <h5></h5>
                                    <!-- <address>
                                        <strong><?php echo "$pfname $plname"; ?>.</strong><br>
                                        106 Jorg Avenu, 600/10<br>
                                        Chicago, VT 32456<br>
                                        <abbr title="Phone">P:</abbr> (123) 601-4590
                                    </address> -->
                                </div>

                            </div>
							<div class="row">
								<p style="text-align:center; font-size: 14px; font-style:italic; font-weight:bold;color:red;">Patient Lab Report</p>
								<hr style="height:1px;border:none;color:#333;background-color:#333;" />
							</div>
							<table>
								<td>Patient Names: <strong><?php echo "$pfname $plname"; ?></strong></td>
								<td>OP No.<strong><?php echo $lopno ?></strong></td>
							</table>
							<div class="row">
								<div class="col-sm-3">Patient Names:
								</div>												
									<div class="col-sm-4"> <strong><?php echo "$pfname $plname"; ?></strong>
									</div>												
									<div class="col-sm-2">OP No:
								</div>												
									<div class="col-sm-3"><strong><?php echo $lopno ?></strong></div>
							</div>												
							<div class="row">
								<div class="col-sm-3">Age:</div>												
								<div class="col-sm-4"> <strong><?php echo $agess ?> years</strong></div>
								<div class="col-sm-2">Collection Date</div>
								<div class="col-sm-3"><?php echo $todaydate;?></div>
							</div>	
							
							<div class="row">
								<div class="col-sm-3">Gender:</div>												
								<div class="col-sm-4"> <strong><?php echo $pgender ?> </strong></div>
								<div class="col-sm-2">Received Date</div>
								<div class="col-sm-3"><?php echo $todaydate;?></div>
							</div>
							
							<div class="row">
								<div class="col-sm-3">Lab Number:</div>												
								<div class="col-sm-4"> <strong><?php echo $smart_name ?> </strong></div>
								<div class="col-sm-2">Report Date</div>
								<div class="col-sm-3"><?php echo $leodate;?></div>
							</div>

							<div class="row">
								<div class="col-sm-3">Doctor:</div>												
								<div class="col-sm-4"> <strong><?php echo $smart_name ?> </strong></div>
								<div class="col-sm-2">Report Date</div>
								<div class="col-sm-3"><?php echo $leodate;?></div>
							</div>
							<br />
							<div class="row" style="background-color:BurlyWood;">
								<div class="col-lg-12"><span><strong>Request No. #1444</strong></span></div>	
							</div>
                            <div class="table-responsive m-t">
                                <table class="table">
                                    <tr>
                                        <td>Test: <?php echo $lsname; ?></td>
                                        <td align="right">Specimen: <i><?php echo $lvsample;?></i></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">History: <i><?php echo $lvresults; ?></i></td>
                                    </tr>

                                </table>
                            </div><!-- /table-responsive -->

							
							<div class="row">
								<p style="text-align:center; font-size: 14px; font-style:italic; font-weight:bold;color:red;">Patient Lab Report</p>
								<hr style="height:1px;border:none;color:#333;background-color:#333;" />
							</div>
							<div class="row">
								<div class="col-sm-6 text-center">Pathologist:</div>
								<div class="col-sm-6 text-center">Laboratory Manager:</div>	
							</div>												
							<div class="row">
								<div class="col-sm-6">&nbsp;<hr style="height:1px;border:none;color:#333;background-color:#ff0000;"/></div>
								<div class="col-sm-6">&nbsp;<hr style="height:1px;border:none;color:#333;background-color:#ff0000;"/></div>
							</div>
							
                            <div class="text-right">
                                <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"><i class="fa fa-print"></i> Print Lab Results</a>
                            </div>

                            <div class="well m-t"><strong>Comments</strong>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                            </div>
                        </div>
                        </div>
                </div>
            </div>
			<div class="col-lg-1">
			</div>
        </div>
		
		
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
		
	function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    //WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
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
