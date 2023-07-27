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

   <title>View Current Bill - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
	function printPageArea(printableArea1) {
			var openWindow = window.open(printableArea, "title", "attributes");
			openWindow.document.write(printableArea.innerHTML);
			openWindow.document.close();
			openWindow.focus();
			openWindow.print();
			openWindow.close();
			
		}
	function PrintElem(printableArea)
		{
			var mywindow = window.open('', 'PRINT', 'height=400,width=600');

			mywindow.document.write('<html><head><title>' + document.title  + '</title>');
			mywindow.document.write('</head><body >');
			mywindow.document.write('<h1>' + document.title  + '</h1>');
			mywindow.document.write(document.getElementById(printableArea).innerHTML);
			mywindow.document.write('</body></html>');

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10*/

			mywindow.print();
			mywindow.close();

			return true;
		}
	</script>
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
			$billvisitno = $_GET['visitno'];
			$billopno = $_GET['opno'];
			$getbilling = mysqli_query($dbconnect, "SELECT * FROM tbl_billing lb INNER JOIN tbl_registry tl ON lb.bill_opno=tl.opno WHERE lb.bill_opno='$billopno'");
			$gbil = mysqli_fetch_array($getbilling);
			
			$bopno = $gbil['bill_opno'];
			$bvisitno = $gbil['bill_visitno'];
			$bfname = $gbil['f_name'];
			$blname = $gbil['l_name'];
			$bdob = $gbil['dob'];
			$bservicename = $gbil['bill_servicename'];
			$bamount = $gbil['bill_amount'];
			
			$patient_names = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE opno='$bopno'");
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
			
			$current_processstage='BILLING';
			$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry r on r.opno=q.queue_opno WHERE q.queue_to='$current_processstage'");
			$title='Patients for Billing Services';

		?>	
			
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>View Bill Statament</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Dashboard</a>
                        </li>
                        <li>
                            Billing
                        </li>
                        <li class="active">
                            <strong>Bill Report for <?php echo "$bfname $blname - Visit No. $bvisitno"; ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    
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
                                <div class="col-sm-2">
                                    <h5></h5>
                                    <!-- <address>
                                        <strong><?php echo "$pfname $plname"; ?>.</strong><br>
                                        106 Jorg Avenu, 600/10<br>
                                        Chicago, VT 32456<br>
                                        <abbr title="Phone">P:</abbr> (123) 601-4590
                                    </address> -->
                                </div>
                                <div class="col-sm-8">
								  <div class="row justify-content-center">
									<div class="col-3 text-center">
										<h2><strong>MPELI MEDICAL CLINIC</strong></h2>
											P.O BOX 2455-50200, BUNGOMA KENYA <br>
											TEL: 0726061599 PIN: A004714311H<br> 
											<i>mpelimedicalcare@gmail.com></i>
										</address>
									</div>
								  </div>
                                </div>
                                <div class="col-sm-2">
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
								<p style="text-align:center; font-size: 14px; font-weight:bold;color:red;">INVOICE</p>
								<hr style="height:1px;border:none;color:#333;background-color:#333;" />
							</div>
							<div class="row">
								<div class="col-sm-3">Patient Names:
								</div>												
									<div class="col-sm-4"> <strong><?php echo "$pfname $plname"; ?></strong>
									</div>												
									<div class="col-sm-2">OP No:
								</div>												
									<div class="col-sm-3"><strong><?php echo $bopno ?></strong></div>
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
							
							<br />
							<div class="row" style="background-color:BurlyWood;">
								<div class="col-lg-12"><span><strong>Request No. #1444</strong></span></div>	
							</div>
                            <div class="table-responsive m-t">
                                <table class="table">
                                    <tr style="background-color:gray;font-weight:bold">
                                        <td>No</td>
                                        <td>Service Category</td>
                                        <td>Service Details</td>
                                        <td>Amount</td>
                                    </tr>
									<?php
									$No = 0;
									$get_billinfo = mysqli_query($dbconnect,"SELECT * FROM tbl_billing WHERE bill_opno='$billopno' AND bill_visitno='$billvisitno'");
									while($bill = mysqli_fetch_array($get_billinfo)){
										$Nos = $No+1;
										$bill_amount = $bill['bill_amount'];
										$bill_category = $bill['bill_category'];
										$bill_servicename = $bill['bill_servicename'];
										$bill_scheme = $bill['bill_paymentscheme'];
										$bill_datetime = $bill['bill_datetime'];
									?>
                                    <tr>
                                        <td><?php echo $Nos; ?></td>
                                        <td><?php echo $bill_category; ?></td>
                                        <td><?php echo $bill_servicename; ?></td>
                                        <td><?php echo $bill_amount; ?></td>
                                    </tr>
									
									<?php
									}
									?>
                                    <tr>
                                        <td colspan="2">History: <i><?php echo $bill_category; ?></i></td>
                                    </tr>

                                </table>
                            </div><!-- /table-responsive -->

							
							<div class="row">
								<p style="text-align:center; font-size: 14px; font-style:italic; font-weight:bold;color:red;">Patient Bill Report</p>
								<hr style="height:1px;border:none;color:#333;background-color:#333;" />
							</div>
							<div class="row">
								<div class="col-sm-6 text-center">Compiled By:</div>
								<div class="col-sm-6 text-center">Signature:</div>	
							</div>												
							<div class="row">
								<div class="col-sm-6">&nbsp;<hr style="height:1px;border:none;color:#333;background-color:#ff0000;"/></div>
								<div class="col-sm-6">&nbsp;<hr style="height:1px;border:none;color:#333;background-color:#ff0000;"/></div>
							</div>
							
                            <div class="well m-t"><strong>Summary</strong>
                                We Treat God heals
                            </div>
                        </div>
                      <a href="#" onclick="printPageArea('printableArea')" class="btn btn-primary"><i class="fa fa-print"></i> Print Lab Report</a>
                   
                        </div>
						
                </div>
            </div>
			<div class="col-lg-1">
			</div>
        </div>
		
		
		<?php include 'includes/footer.php'?>
    </div>
    </div>
	<script>
	
			
    </script>
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
