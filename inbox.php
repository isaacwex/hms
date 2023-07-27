<div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
				<?php
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='1'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Inbox (<?php echo $c; ?>)
                </h2><i>Open message to reply</i>
            </div>			
				<form action="" method="post">	
                <div class="mail-box">
                   <div class="mail-tools"><a href="messages.php?status=important"><button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh"><i class="fa fa-refresh"></i> Refresh</button></a>
				   
				   <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"type="submit" name="but_delete" title="Delete Messages" onclick="return confirm('Are you sure you want to delete the selected messages?')"><i class="fa fa-eye"></i> Delete Selected</button>
				   
				   <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"type="submit" name="mark_important" title="Mark as Important" onclick="return confirm('Are you sure you want to mark these messages as Important?')"><i class="fa fa-exclamation"></i> Mark Important</button>
				<?php 
					//MARK IMPORTANT
					if(isset($_POST['mark_important'])){
					  if(!isset($_POST['check'])){
								 ?>
								<script>
									alert('You did not select any messages to delete');
									window.location = 'messages.php?status=inbox';
								</script>	
								<?php
					  }
					  else {
						  if(isset($_POST['check'])){
							foreach($_POST['check'] as $checkid){
							  $deleteUser = "UPDATE tbl_messages SET message_status='2' WHERE message_id='$checkid'";
							  $dlt = mysqli_query($dbconnect,$deleteUser);
							  if($dlt){
								 ?>
								<script>
									alert('Messages marked as important');
									window.location = 'messages.php?status=inbox';
								</script>	
								<?php
							  }
							  else{
								  echo ("Error occured");
							  }
							}
						  }
						 
						}
					}
					
					//TO DELETE
					if(isset($_POST['but_delete'])){
					  if(!isset($_POST['check'])){
								 ?>
								<script>
									alert('You did not select any messages to delete');
									window.location = 'messages.php?status=inbox';
								</script>	
								<?php
					  }
					  else {
						  if(isset($_POST['check'])){
							foreach($_POST['check'] as $checkid){
							  $deleteUser = "UPDATE tbl_messages SET message_status='4' WHERE message_id='$checkid'";
							  $dlt = mysqli_query($dbconnect,$deleteUser);
							  if($dlt){
								 ?>
								<script>
									alert('Messages Deleted Successfully');
									window.location = 'messages.php?status=inbox';
								</script>	
								<?php
							  }
							  else{
								  echo ("Error occured");
							  }
							}
						  }
						 
						}
					}
					?>
					<div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
					</div>
                <table class="table table-hover table-mail">
                <tbody>
				<?php
				
				$inq = mysqli_query($dbconnect, "SELECT * FROM tbl_messages WHERE message_status='1' ORDER BY message_date DESC");
				while($ina = mysqli_fetch_array($inq)){
					$message_id = $ina['message_id'];
					$sender_no=$ina['sender_no'];
					$message_text=$ina['message_text'];
					$message_date=$ina['message_date'];
					$status=$ina['read_status'];
					if($status==1){
						$class='read';
					}else{
						$class='unread';
						}
				
				?>
                <tr class="<?php echo $class; ?>">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks" name="check[]" value="<?php echo $message_id; ?>">
                    </td>
                    <td class="mail-ontact"><a href="readmail.php?id=<?php echo $message_id;?>">
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
							if(isset($_GET['import'])){
								$important = $_GET['import'];
								$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='2' WHERE message_id='$important'");
								if($action){
									echo "Hello error occured";
								}
								else {
									?>
									<script>
										alert('Error deleting message <?php echo ".$dbconnect->error()";?>');
											window.location = 'messages.php?status=inbox';
									</script>	
									<?php
								}
							}
							?>
					<a href="messages.php?status=inbox&import=<?php echo $message_id;?>">
						<button onclick="return confirm('Are you sure you sent this message to mark this message as important <?php echo $important;?>?')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Mark as Important"><i class="fa fa-exclamation"></i> Mark Important </button>
					</a>
					|
					 <?php
							if(isset($_GET['trash'])){
								$deleted = $_GET['trash'];
								$action = mysqli_query($dbconnect,"UPDATE FROM tbl_messages SET message_status='4' WHERE message_id='$deleted'");
								if($action){
									echo ".mysqli_error()";
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
					<a href="messages.php?status=inbox&trash=<?php echo $message_id;?>">
						<button onclick="return confirm('Are you sure you sent this message to trash?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button>
					</a>
					</td>
                </tr>
               <?php
			   }
				?>
                </tbody>
                </table>
				</form>

                </div>
            </div>