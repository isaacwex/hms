<div class="modal inmodal" id="prescribe<?php echo $c_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Prescription</h4>
                                            <small class="font-bold">Make prescription for the patient</small>
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
													
													if(isset($_POST['btnprescription'])){
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
														
														$opno2=$opno;
														$visitno2=$visitno;
														$id_number1=$id_number;
														$prescription_status='0';
														$prescription_referred='0';
														
															$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_prescriptions WHERE prescription_opno='$opno2' AND prescription_visitno='$visitno2'");
															$countNo = mysqli_num_rows($checknumber);
															if($countNo >= 1){
																	?>
																		<script>
																			alert('The record already exits. <?php echo "$dbconnect->error()";?>');
																			window.location = 'prescriptions.php';
																		</script>	
																	<?php
															}
														else {
															if($stmt = $dbconnect->prepare("INSERT INTO tbl_prescriptions (prescription_opno, prescription_visitno,prescription_productcode,prescription_quantity,prescription_dosagesummary,prescription_status,prescription_referred) VALUES (?,?,?,?,?,?,?)")){
																	$stmt->bind_param('sssssss',$opno2, $visitno2, $drug_code, $dosage_quantity,$dosage_instructions,$id_number1,$id_number1);
																	$stmt->execute();
																	?>
																		<script>
																			alert('Successful...');
																			window.location = 'prescriptions.php';
																		</script>	
																	<?php
																}
																else {
																	?>
																		<script>
																		 alert('OOOOOPS Error occcurred');
																		window.location = 'prescriptions.php';
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
													<div class="row">
																									
														<div class="col-sm-6"> 
															<div class="form-group">
															<label>Drugs</label>
															<select name="drug_code" required class="form-control" >
																	<option selected value="">Select from List</option>
																	<?php
																$getalllocations = mysqli_query($dbconnect,"SELECT * FROM products");
																while($gal = mysqli_fetch_array($getalllocations)){
																	$product_code = $gal['code'];
																	$product_name = $gal['name'];
																	$product_quantity = $gal['product_quantity'];
																	?>
																	<option value="<?php echo $product_code; ?>" ><?php echo $product_name; ?> | <?php echo $product_quantity; ?> Units Available in Stock</option>
																	<?php
																}
																?>
															</select>
														</div>	
														</div>
														<div class="col-sm-6"> 		
														<div class="form-group">
																<label>Quantity</label>
																<input type="text" name="dosage_quantity" value="" required placeholder="Enter the quantity" class="form-control">
															</div>
														</div>	
													</div>
													<div class="row">
														<div class="col-sm-12">
															<label>Dosage Summary/Instructions</label>
															<div class="form-group">
																<textarea name="dosage_instructions" class="form-control" placeholder="Enter Dosage Summary/Instructions" rows="4"></textarea>
															</div>
														</div>												
														<div class="col-sm-6">
															<div class="form-group">
																<input name="btnprescription" class="btn btn-md btn-success" type="submit" value="Submit Prescription"/>
															</div>
														</div>
													</div>
                            </div>
							</form>
                            </div>
                </div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>