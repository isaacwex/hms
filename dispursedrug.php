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
	<script>
    function showResult(str) {
        if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET","searchdrug.php?q="+str,true);
        xmlhttp.send();
        }
         // Define an array to store the cart items
       
    </script>
    <script>
		function displayMessage() {
			alert("Adding drug to list");
		}
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
		
		<?php
			$visitno=$_GET['visitno'];
			$opno=$_GET['opno'];
			$current_processstage=$_GET['current_processstage'];
			$c_id=$_GET['c_id'];
			$todaydate = date('Y-m-d');
			
			$checkdetails = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE reg_no='$c_id'");
			$pdetails = mysqli_fetch_assoc($checkdetails);
			$id_no = $pdetails['id_no'];
			$fnames = $pdetails['f_name'];
			$lnames = $pdetails['l_name'];
			$gender = $pdetails['gender'];
			$dob = $pdetails['dob'];
			
			if($current_processstage=='REGISTRY'){
				$page='registry.php';
			}
			elseif($current_processstage=='TRIAGE'){
				$page='triage.php';
			}
			elseif($current_processstage=='CONSULTATION'){
				$page='consultations.php';
			}
			elseif($current_processstage=='LABORATORY'){
				$page='laboratory.php';
			}
			elseif($current_processstage=='PHARMACY'){
				$page='pharmacy.php';
			}
			elseif($current_processstage='BILLING'){
				$page='billing.php';
			}
			else{
				echo 'Error Occurrred';
			}
						
		?>
                  <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h2 class="modal-title">drug <span><a href="consultations.php"><button class="btn btn-primary align-right" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<span class="bold"> Back</span></button></a></span></h2>
                                            <small class="font-bold">Make drug for the patient</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
											<form role="form" method="post">	
												<div class="col-sm-12">													
												<?php
													$date1 = $dob;
													$date2 = $todaydate;
													
													$diff = date_diff(date_create($dob), date_create($todaydate));
													$agess = $diff->format('%y');
													
													if(isset($_POST['btndrug'])){
														if(empty($_POST['drug_code'])){
															echo "Select on the list";
														}
														elseif(empty($_POST['dosage_quantity'])){
															echo "Enter quantity";
														}
														else{
															
															
														$dosage_quantity = $dbconnect->real_escape_string($_POST['dosage_quantity']);
														$dosage_instructions = $dbconnect->real_escape_string($_POST['dosage_instructions']);
														$drug_code = $dbconnect->real_escape_string($_POST['drug_code']);
														$drug_status='0';
														$drug_referred='0';
														
														
														
														$checkL = mysqli_query($dbconnect, "SELECT * FROM tbl_drugs WHERE drug_opno='$opno' AND drug_visitno='$visitno' AND drug_productcode='$drug_code'");
														$countL = mysqli_num_rows($checkL);
														if($countL>=1){
															echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems there is a similar request pending for the patient </div>";
														}
														else{
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_drugs (drug_opno, drug_visitno,drug_productcode,drug_quantity,drug_dosagesummary,drug_status,drug_referred) VALUES (?,?,?,?,?,?,?)")){
																	$stmt->bind_param('sssssss',$opno, $visitno, $drug_code, $dosage_quantity,$dosage_instructions,$drug_status,$drug_referred);
																	$stmt->execute();
																	
													//Checking and updating the bill				
													$checkC = mysqli_query($dbconnect, "SELECT * FROM tbl_billing WHERE bill_opno='$opno' AND bill_visitno='$visitno' AND bill_servicecode='$drug_code'");
															$countc = mysqli_num_rows($checkC);
															if($countc>= 1){
																
															}
														else {
															$getcountyname =mysqli_query($dbconnect,"SELECT * FROM  products WHERE code='$drug_code'");
															$gcn = mysqli_fetch_array($getcountyname);
																$drug_code = $gcn['code'];
																$drug_name = $gcn['name'];
																$drug_cost = $gcn['retail_price'];
																$category = 'PHARMACY';
																$status = '1';
															$sqlbill = "INSERT INTO tbl_billing(bill_servicename,bill_amount, bill_opno,bill_visitno,bill_paymentscheme,bill_status,bill_category,bill_servicecode)
															VALUES ('$drug_name', '$drug_cost','$opno', '$visitno','$scheme_code','$status','$category','$drug_code')";
																if($dbconnect->query($sqlbill) === TRUE) {
																	echo "Processing...";
																}
															}	
													//End of the check and update		
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'prescribe.php?opno=<?php echo $opno; ?>&visitno=<?php echo $visitno; ?>&current_processstage=<?php echo $current_processstage;?>&c_id=<?php echo $c_id;?>';
																			</script>	
																	<?php
																}
															}	
														}
													}
												?>
												<br />
												</div>
												
												<!-- ididndini -->
												<div class="col-sm-12">													
													<div class="row">
														<div class="col-sm-3">Patient Names:
														</div>												
														<div class="col-sm-4"> <strong><?php echo "$fnames $lnames"; ?></strong>
														</div>												
														<div class="col-sm-2">OP No:
														</div>												
														<div class="col-sm-3"><strong><?php echo $opno ?></strong>
														</div>
													</div>												
													<div class="row">
														<div class="col-sm-3">Age:
														</div>												
														<div class="col-sm-4"> <strong><?php echo $agess ?> years</strong>
														</div>												
														<div class="col-sm-2">
														</div>												
														<div class="col-sm-3">
														</div>
													</div>
													<hr>
                                                    <div class="row">
                                                            <h2><b>Pending drug Requests</b></h2>
                                                            <?php
                                                                    $No=0;
                                                                    $getls = mysqli_query($dbconnect, "SELECT * FROM  tbl_prescriptions p INNER JOIN products r ON p.prescription_productcode=r.code WHERE p.prescription_opno='$opno' AND p.prescription_visitno='$visitno'");
                                                                        while($lrarray = mysqli_fetch_array($getls)){
                                                                            $No=$No+1;
                                                                            $prescription_productcode = $lrarray['prescription_productcode'];
                                                                            $prescription_dosagesummary = $lrarray['prescription_dosagesummary'];
                                                                            $prescription_quantity = $lrarray['prescription_quantity'];
                                                                            $product_name = $lrarray['name'];
                                                                            $prescription_id = $lrarray['prescription_id'];
                                                                            $prescription_status = $lrarray['prescription_status'];
                                                                            ?>
                                                                            
                                                                            <?php echo $No; ?>. <?php echo $product_name; ?> - <?php echo $prescription_quantity; ?> - <?php echo $prescription_dosagesummary; ?>
                                                                            
                                                        </br>
                                                        <?php
                                                        }
                                                    ?>	
                                                                
												</div>


													<div class="row">
													<div class="col-sm-12"> 

															<div class="form-group">
															<label>Drugs</label>
															<input type="text" size="30" onkeyup="showResult(this.value)" placeholder="Search Drug" class="form-control">
<div id="livesearch"></div>
														</div>	
												    </div>
													</div>
													<div class="row">
                                                   											
														
														
													</div>
													<div class="row">
														
													</div>
													
                            </div>
							</form>
                            </div>
                </div>
			<div class="modal-footer">
			</div>
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
