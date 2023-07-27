<div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <form method="get" action="index.html" class="pull-right mail-search">
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
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='4'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Trash (<?php echo $c; ?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                   <a href="messages.php?status=important"><button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh"><i class="fa fa-refresh"></i> Refresh</button></a>

				  
				   <form method="post" action="" class="pull-right mail-search">
				  <?php
				  if(isset($_POST['trash_delete'])){
							  $deleteUser = "DELETE FROM tbl_messages WHERE message_status='4'";
							  $dlt = mysqli_query($dbconnect,$deleteUser);
							  if($dlt){
								 ?>
								<script>
									alert('All trash Messages deleted');
									window.location = 'messages.php?status=trash';
								</script>	
								<?php
							  }
							  else{
								  echo ("Error occured");
							  }						 
						}
					
					?>
                    <div class="input-group">
                        <div class="input-group-btn">
                            				  <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"type="submit" name="trash_delete" title="Delete all Messages in trash" onclick="return confirm('Are you sure you want to delete all messages in the trash??? Action cannot be reversed!!!!')"><i class="fa fa-eye"></i> Delete all in trash</button>
                        </div>
                    </div>
                </form>
				  
				  
				   
                    <!--<button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>-->
						
                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
				<?php
				
				$inq = mysqli_query($dbconnect, "SELECT * FROM tbl_messages WHERE message_status='4' ORDER BY message_date DESC");
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
							if(isset($_GET['todelete'])){
								$msg_do = $_GET['todelete'];							
								$actioned = mysqli_query($dbconnect, "DELETE FROM tbl_messages WHERE message_id='$msg_do'");
								if($actioned){
										?>
										<script>
											alert('Message deleted successfully <?php echo "$dbconnect->error()";?>');
												window.location = 'messages.php?status=trash';
										</script>	
										<?php
									}
									else {?>
										<script>
											alert('Message not deleted <?php echo "$dbconnect->error()";?>');
												window.location = 'messages.php?status=trash';
										</script>
										<?php
									}
								
							}
						?>
						<a href="messages.php?status=trash&todelete=<?php echo $message_id; ?>" ><button class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this message? It is irreversibe')" ><i class="fa fa-trash"></i> Delete</button></a></td>
                </tr>
               <?php
			   }
				?>
                </tbody>
                </table>


                </div>
            </div>