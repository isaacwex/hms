<div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

               <!-- <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search Message">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>-->
                <h2>
				<?php
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='2'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Important (<?php echo $c; ?>)
                </h2><i>Open message to reply</i>
                <div class="mail-tools m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                   <a href="messages.php?status=important"><button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh"><i class="fa fa-refresh"></i> Refresh</button></a>
                   <!-- <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>-->

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
				<?php
				
				$inq = mysqli_query($dbconnect, "SELECT * FROM tbl_messages WHERE message_status='2' ORDER BY message_date DESC");
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
                        <input type="checkbox" class="i-checks">
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
							if(isset($_GET['unimport'])){
								$unimportant = $_GET['unimport'];
								$action = mysqli_query($dbconnect,"UPDATE tbl_messages SET message_status='1' WHERE message_id='$unimportant'");
								if($action){
									?>
									<script>
										alert('Message sent to removed from important');
											window.location = 'messages.php?status=important';
									</script>	
									<?php
								}
								else {
									?>
									<script>
										alert('Error deleting message <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=important';
									</script>	
									<?php
								}
							}
							?>
					<a href="messages.php?status=important&unimport=<?php echo $message_id;?>">
						<button onclick="return confirm('Are you sure you sent this message to mark this message as not important?')" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Move to Inbox"><i class="fa fa-exclamation"></i> Not important </button>
					</a>
					<!--<button class="btn btn-xs btn-primary" type='button' data-toggle="modal" title="Forward" data-target="#<?php //echo $message_id; ?>"><i class="fa fa-mail-forward"></i></button>-->
					|
					 <?php
							if(isset($_GET['trash'])){
								$deleted = $_GET['trash'];
								$action = mysqli_query($dbconnect,"DELETE FROM tbl_messages WHERE message_id='$deleted'");
								if($action){
									?>
									<script>
										alert('Message sent to trash');
											window.location = 'messages.php?status=important';
									</script>	
									<?php
								}
								else {
									?>
									<script>
										alert('Error deleting message <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=important';
									</script>	
									<?php
								}
							}
							?>
					<a href="messages.php?status=important&trash=<?php echo $message_id;?>">
						<button onclick="return confirm('Are you sure you sent this message to trash?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button>
					</a>
					<!--<button class="btn btn-xs btn-primary" type='button' data-toggle="modal" title="Forward" data-target="#<?php //echo $message_id; ?>"><i class="fa fa-mail-forward"></i></button>-->
					</td>
                </tr>
               <?php
			   }
				?>
                </tbody>
                </table>


                </div>
            </div>