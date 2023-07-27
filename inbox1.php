<div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <form method="get" action="index.php" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search Message">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
				<?php
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='1'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Inbox (<?php echo $c; ?>)
                </h2>
				<form  method="post">
				<?php
						/**if(isset($_POST['important'])){
							
						$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
									$action = mysqli_query($dbconnect,"DELETE FROM tbl_contacts WHERE contact_id=('".$checkBox[$i]."')");
							if($action){
								?>
								<script type="text/javascript">
									alert('Successful!');
									//window.location = 'messages.php?status=inbox';
								</script> 
							<?php
						}
						else{
							?>
								<script type="text/javascript">
									alert('Not successful. Error occured');
									//window.location = 'messages.php?status=inbox';
								</script> 
							<?php
						}
						}}
						
						***/
					if(isset($_POST['importantall'])){
							//echo "$_POST['Farmers']";
								if(empty($_POST['Farmers'])){
									echo "<div class='alert alert-danger'>
								<button type='button' class='close' data-dismiss='alert'>X</button>You must select items on the list</div>";
								}
								else{
							$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
									//$getphone = mysqli_query($dbconnect, "SELECT phone_no FROM tbl_contacts WHERE contact_id=('".$checkBox[$i]."')");
										$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='2' WHERE message_id=('".$checkBox[$i]."')");
							if($action){
								?>
								<script type="text/javascript">
									alert('Successful!');
									//window.location = 'messages.php?status=inbox';
								</script> 
							<?php
						}
						else{
							?>
								<script type="text/javascript">
									alert('Not successful. Error occured');
									//window.location = 'messages.php?status=inbox';
								</script> 
							<?php
						}	
							}
								}
									}
									
									
									
									
									
									
									
					?>
					<?php
						if(isset($_POST['delete'])){
							if(empty($_POST['Farmers'])){
									echo "<div class='alert alert-error'>
								<button type='button' class='close' data-dismiss='alert'>X</button>You must select items on the list</div>";
								}
								else{
							$checkBox=$_POST['Farmers'];
								for ($i=0; $i<sizeof($checkBox); $i++){
							$query = mysqli_query($dbconnect,"DELETE FROM tbl_messages SET message_status='2' WHERE message_id=('".$checkBox[$i]."')");
										}
							if($query){
								?>
								<script type="text/javascript">
									alert('Successful');
									window.location = 'messages.php?status=inbox';
								</script> 
							<?php
									}
								}
							}
					?>
				 <div class="mail-tools m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>		
				<th><input type="checkBox" id="toggle" value="select" onClick="do_this()" /></th>					
					 <!-- <input type="button" class="btn-warning" id="toggle" value="Select All" onClick="do_this()" />-->
                   <a href="messages.php?status=inbox" title="Refresh inbox"><button class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Refresh</button></a>
				   <button type="submit" name='importantall' class="btn btn-white btn-sm" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
					
                    <button class="btn btn-white btn-sm" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button type="submit" name="delete" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>
                <div class="mail-box">
				<table class="table table-hover table-mail">
				 <tbody>
				<?php
				
				$inq = mysqli_query($dbconnect, "SELECT * FROM tbl_messages WHERE message_status='1' ORDER BY message_date DESC");
				while($ina = mysqli_fetch_array($inq)){
					$message_id = $ina['message_id'];
					$sender_no=$ina['sender_no'];
					$message_text=$ina['message_text'];
					$message_date=$ina['message_date'];
					$message_status=$ina['message_status'];
					$status=$ina['read_status'];
					if($status==1){
						$class='read';
					}else{
						$class='unread';
						}
				
				?>
                <tr class="<?php echo $class; ?>">
                    <?php echo "<td class='a-center '><input type='checkbox' value='$message_id' class='flat' name='Farmers[]' ></td>"; ?>
					
					
                    <td class="mail-contact"><a href="readmail.php?id=<?php echo $message_id;?>">
					<?php $sn= mysqli_query($dbconnect, "SELECT names FROM tbl_contacts WHERE phone_no='$sender_no'");
						$sna=mysqli_fetch_array($sn);
						$names=$sna['names'];
						if($names!=null){
							echo $names;
						}else{
							echo $sender_no;
						}
					?></a></td>
                    <td class="mail-subject"><a href="readmail.php?id=<?php echo $message_id;?>"><?php echo $message_text; ?></a></td>
                    <td class="text-right mail-date"><?php echo $message_date; ?></td>
                    <td class="">
					
					<?php
					if($message_status=="2"){
						?>
						    <?php
							if(isset($_GET['unimport'])){
								$unimportid = $_GET['unimport'];
								$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='1' WHERE message_id='$unimportid'");
								if($action){
									?>
									<script>
										alert('Successful <?php echo "$unimportid $dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
								else {
								
									?>
									<script>
										alert('Error occurred <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
							}
							
							?>
                   <a href="messages.php?status=inbox&unimport=<?php echo $message_id;?>"><button onclick="return confirm('Are you sure you want to toggle importance?')" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Mark as not important">&nbsp;<i class="fa fa-exclamation"></i>&nbsp;</button></a>
				   <?php
					}
					else {
						?>
						    <?php
							if(isset($_GET['important'])){
								$importid = $_GET['important'];
								$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='2' WHERE message_id='$importid'");
								if($action){
									?>
									<script>
										alert('Successful<?php echo "$importid $dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
								else {
								?>
									<script>
										alert('Error occurred <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
							}
							?>
                   <a href="messages.php?status=inbox&important=<?php echo $message_id;?>"><button onclick="return confirm('Are you sure you want to mark thisas important  bbb?')" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Mark as Important">&nbsp;<i class="fa fa-exclamation"></i>&nbsp;</button></a>
						<?php
					}
					?>
					 <?php
							if(isset($_GET['trash'])){
								$deleted = $_GET['trash'];
								$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='4' WHERE message_id='$deleted'");
								if($action){
									?>
									<script>
										alert('Message sent to trash <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
								else {
								
									?>
									<script>
										alert('Error deleting message <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
							}
							?>
					<a href="messages.php?status=inbox&trash=<?php echo $message_id;?>"><button onclick="return confirm('Are you sure you sent this message to trash?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button> <!-- </a>
						<button class="btn btn-xs btn-primary" type='button' data-toggle="modal" title="Reply" data-target="#<?php echo $message_id; ?>"><i class="fa fa-mail-reply"></i></button>
						<button class="btn btn-xs btn-primary" type='button' data-toggle="modal" title="Forward" data-target="#<?php echo $message_id; ?>"><i class="fa fa-mail-forward"></i></button> -->
					<?php include('modals/reply-message.php');?> 
					</td>
                </tr>
               <?php
			   }
				?>
				 </tbody>
                </table>
			</div>
				</form>
            </div>