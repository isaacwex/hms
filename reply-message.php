<div class="modal inmodal" id="<?php echo $message_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-comments modal-icon"></i>
                                            <h4 class="modal-title">Send a Reply Message</h4>
                                            <small class="font-bold">Send a reply to <?php echo $sender_no; ?>.</small>
                                        </div>
                                        <div class="modal-body">
										<form method="post" >
											<?php
											if(isset($_POST['replyto'])){
												if(empty($_POST['txtmessage'])){
													echo "Blank Message";
												}
												else {
													$sms_id = $_POST['msg_id'];
													$sender_number = $_POST['phoneNumber'];
													$smsTxt = $_POST['txtmessage'];
													
													if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageTo,MessageText) VALUES (?,?)")){
														$stmt->bind_param('ss',$sender_number,$smsTxt);
														$stmt->execute();
														
														?>
															<script>
																alert('Reply sent successfully');
																window.location = history.back();
															</script>	
														<?php
														
													}
													else {
														?>
															<script>
																alert('Error sending message <?php echo "$dbconnect->error()";?>');
																window.location = 'messages.php?status=inbox';
															</script>	
														<?php
													
													}
												}
											}
											?>
                                             <div class="form-group">
												<input type="hidden" name="msg_id" value="<?php echo $message_id; ?>" />
												<input type="hidden" name="phoneNumber" value="<?php echo $sender_no; ?>" />
												<label>Text Message to Send</label>
												<textarea name="txtmessage" class="form-control" required placeholder="Enter your Short Message Here"></textarea>
											 </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> -->
                                            <button type="submit" name="replyto" class="btn btn-primary">Send Message Now</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>