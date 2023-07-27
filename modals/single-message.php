<div class="modal inmodal" id="<?php echo $c_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-comments modal-icon"></i>
                                            <h4 class="modal-title">Send a Message to <?php echo $names; ?></h4>
                                            <small class="font-bold">Type the message to send to <?php echo "$names ($phonenumber)";?>.</small>
                                        </div>
                                        <div class="modal-body">
										<form method="post" >
											<?php
											if(isset($_POST['sendtxt']))
												if(empty($_POST['txtmessage'])){
													echo "Blank Message";
												}
												else {
													$ke_id = $_POST['theid'];
													$telNo = $_POST['phoneNumber'];
													$txtMsg = $_POST['txtmessage'];
													
													if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageTo,MessageText) VALUES (?,?)")){
														$stmt->bind_param('ss',$telNo,$txtMsg);
														$stmt->execute();
														
														?>
															<script>
																alert('Message sent successfully<?php echo "$dbconnect->error()";?>');
																window.location = 'contacts.php';
															</script>	
														<?php
														
													}
													else {
														?>
															<script>
																alert('Error sending message<?php echo "$dbconnect->error()";?>');
																window.location = 'contacts.php';
															</script>	
														<?php
													
													}
												}
											?>
                                             <div class="form-group">
												<input type="hidden" name="theid" value="<?php echo $c_id; ?>" />
												<input type="hidden" name="phoneNumber" value="<?php echo $phonenumber; ?>" />
												<label>Text Message to Send</label>
												<textarea name="txtmessage" required class="form-control" placeholder="Enter your Short Message Here"></textarea>
											 </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> -->
                                            <button type="submit" name="sendtxt" class="btn btn-primary">Send Message Now</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>