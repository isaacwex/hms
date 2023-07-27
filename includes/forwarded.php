            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
                    <a href="mailbox.html" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                </div>
                <h2>
                    Compose an SMS
                </h2>
            </div>
                <div class="mail-box">


                <div class="mail-body">
					
                    <form class="form-horizontal" method="post">       
						<div class="form-group">
							<?php
								if(isset($POST['txtsend'])){
									if($_POST['contacts'] == "" OR $_POST['contacts']==" "){
										echo "Select a Contact First";
									}
									else {
										$txtsent = $_POST['txtsend'];
										foreach($_POST['contacts'] as $contact_selected){
											if($stmt= $dbconnect->prepare("INSERT INTO messageout (MessageTo,MessageText) VALUES (?,?)")){
												$stmt->bind_param('ss',$contact_selected, $txtsent);
												$stmt->execute();
												
												?>
												<script>
													alert('Success');
													window.location = 'mail-compose.php';
												</script>
												<?php
											}
											else {
												?>
												<script>
													alert('Ooooooooooooooooooooops');
													window.location = 'mail-compose.php';
												</script>
												<?php
											}
										}
										
									}
							
								}
								elseif(isset($_POST['txtdraft'])){
									if(empty($_POST['contacts'])){
										echo "It's empty oooooh!";
									}
									else {
										$textdrafted = $_POST['txtsend'];
										foreach($_POST['contacts'] as $contact_picked){
											if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageText,MessageTo) VALUES (?,?)")){
												$stmt->bind_param('ss',$textdrafted,$contact_picked);
												$stmt->execute();
												
												?>
												<script>
													alert('Message saved as draft');
													window.location = 'mail-compose.php';
												</script>
												<?php
											}
											else {
												?>
												<script>
													alert('Ooooh! Stopped');
													window.location = 'mail-compose.php';
												</script>
												<?php
											}
										}
									}
								}
						
						?>
						</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Select Contact(s)</label>
									<div class="col-sm-9">
										<div class="input-group">
											<select data-placeholder="Choose a Contact(s)..." name="contacts[]" class="form-control chosen-select" multiple style="width:550px" tabindex="4">
												<option value="">Select</option>
												<?php 
												$getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_contacts");
												while($locs = mysqli_fetch_array($getcontactslocations)){
													$locname = $locs['subcounty'];
													$cnames = $locs['names'];
													$cnumber = $locs['phone_no'];
													$con_id = $locs['contact_id'];
													
													echo "<option value=\"$cnumber\">$cnames - $cnumber</option>";
												}
												?>
											</select>
										</div>
									</div>
								</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Message Here</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="txtMsg" rows="5" required ><?php echo $txtContent;?></textarea>
							</div>							
						</div>

                </div>
                    <div class="mail-body text-right tooltip-demo">
                        <button type="submit" name="txtsend" class="btn btn-sm btn-primary" title="Send Message"> <i class="fa fa-reply"></i> Send</button>
                        <a href="messages.php?status=inbox" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                        <button type="submit" name="txtdraft" class="btn btn-sm btn-primary" title="Move to Drafts"> <i class="fa fa-pencil"></i> Draft</button>
                    </div>
					
                        </form>
                    <div class="clearfix"></div>



                </div>
            </div>