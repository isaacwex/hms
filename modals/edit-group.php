<div class="modal inmodal" id="edit<?php echo $c_id;?>" tabindex="-2" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Group</h4>
                                            <small class="font-bold">You can now edit group details on <?php echo $smart_name; ?>.</small>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-sm-12">													
												<?php
													if(isset($_POST['update-group'])){
														if(empty($_POST['group_id'])){
															echo "We need full names";
														}
														elseif(empty($_POST['group_name'])){
															echo "We need an group name.";
														}
														else {
															$cwa_id = $dbconnect->real_escape_string($_POST['cwa_id']);
															$group_name = $dbconnect->real_escape_string($_POST['group_name']);
															$group_description = $dbconnect->real_escape_string($_POST['group_description']);
															$group_id = $dbconnect->real_escape_string($_POST['group_id']);
															
															$update_person = "UPDATE tbl_categories SET category_name=?, cat_description=? WHERE cat_no='$cwa_id'";
															if($stmt = $dbconnect->prepare($update_person)) {
																$stmt->bind_param('ss',$group_name, $group_description);
																$stmt->execute();
																
																?>
																	<script>
																		alert('Group updated successfully<?php echo "$dbconnect->error()";?>');
																		window.location = 'groups.php';
																	</script>	
																<?php
															}
															else {
																?>
																<script>
																	 alert('Error occurred <?php echo "$dbconnect->error()"; ?>');
																	window.location = 'groups.php';
																		</script>	
																<?php
															}
														}
													}
												?>
												<br />
												</div>
												<div class="col-sm-12">
													<form role="form" method="post">														
														<input type="hidden" name="cwa_id" value="<?php echo $c_id; ?>" class="form-control">
														<div class="form-group">
															<label>Group Id</label>
															<input type="text" name="group_id" readonly value="<?php echo $c_id; ?>" placeholder="Full Names" class="form-control">
														</div>
														<div class="form-group">
															<label>Group Name</label>
															<input type="text" name="group_name" required placeholder="Group Name" value="<?php echo $cat_name;?>" class="form-control">
														</div>									
														<div class="form-group">
															<div class="form-group">
															<label>Group Description</label>
													<textarea name="group_description" class="form-control" placeholder="Type the group description" rows="4"><?php echo $cat_description;?></textarea>
														</div>
														</div>
														<div class="form-group">
															<input name="update-group" class="btn btn-md btn-success" type="submit" value="Update Group">
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