<div class="modal inmodal" id="addnewgroup" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
								
								<form role="form" method="post">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><i class='user'></i>Add SMS Group to <?php echo $smart_name; ?></h4>
                                            <small class="font-bold">To campaign better and efficient, please create your groups one by one and save.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['new-contact'])){
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
												<br />
												</div>
												<div class="col-sm-12">
														<div class="form-group">
															<label>Group ID</label>
															<input type="number" required name="group_id" placeholder="Group ID" class="form-control">
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
															<input type="submit" name="newgrouped" class="btn btn-lg btn-primary" value="Add New Group" />
														</div>
													</form>
												</div>
											</div>
                                        </div>
											<div class="modal-footer">
											</div>
                                    </div>
									</div>
                                </div>
                            </div>