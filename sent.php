<div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <!--<form method="get" action="index.html" class="pull-right mail-search">
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
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM messagelog WHERE MessageText NOT LIKE 'Your message was successfully received%'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Sent Items (<?php echo $c; ?>)
                </h2>
                <div class="mail-tools m-t-md">
					<?php
				$limit = 15;
				$getnumbers = $c;
				
				if(isset($_GET{'page'})){
					$page = $_GET{'page'}+1;
					$offset = $limit*$page;
				}
				else{
					$page=0;
					$offset=0;
				}
				$left_rec = $c-($page*$limit);
				?>
                <div class="btn-group pull-right">
				<?php
				if($page>0){
						$last = $page-2;
						   echo "<a href=\"messages.php?status=sent&page=$last\"><button class=\"btn btn-white btn-sm\"><i class=\"fa fa-arrow-left\"></i>  Previous </button></a>";
						   echo "<a href=\"messages.php?status=sent&page=$page\"><button class=\"btn btn-white btn-sm\"><i class=\"fa fa-arrow-right\"></i>  Next </button></a>";
					   }
					   elseif($page <= 0){
						   echo "<a href=\"messages.php?status=sent&page=$page\"><button class=\"btn btn-white btn-sm\"><i class=\"fa fa-arrow-right\"></i> Next</button></a>";
					   }
					   elseif($left_rec < $limit){
						   $last = $page-2;
						   echo "<a href=\"messages.php?status=sent&page=$page\"><button class=\"btn btn-white btn-sm\"><i class=\"fa fa-arrow-left\"></i> Prev</button></a>";
					   }
					   elseif($left_rec <= 9){						   
						   echo "<a href=\"messages.php?status=sent&page=$page\"><button class=\"btn btn-white btn-sm\"><i class=\"fa fa-arrow-right\"></i> Next</button></a>";
					   }
					?>
                    </div>
                </div>
            </div>		
                <form action="" method="post">
                <div class="mail-box">
				   <a href="messages.php?status=sent"><button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh set"><i class="fa fa-refresh"></i> Refresh</button></a>
				   <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" type="submit" name="but_delete" title="Delete Messages" onclick="return confirm('Are you sure you want to delete the selected messages?')"><i class="fa fa-eye"></i> Delete Selected</button>
				<?php 
					if(isset($_POST['but_delete'])){
					  if(!isset($_POST['checked'])){
								 ?>
								<script>
									alert('You did not select any messages to delete');
									window.location = 'messages.php?status=sent';
								</script>	
								<?php
					  }
					  else {
						  if(isset($_POST['checked'])){
							foreach($_POST['checked'] as $checkedid){
							  $deleteSent = "DELETE FROM messagelog WHERE Id='$checkedid'";
							  $dlt = mysqli_query($dbconnect,$deleteSent);
							  if($dlt){
								 ?>
								<script>
									alert('Messages Deleted Successfully');
									window.location = 'messages.php?status=sent';
								</script>	
								<?php
							  }
							  else{
								  echo ("Error occured".$dbconnect->error);
							  }
							}
						  }
						 
						}
					}
					?>
                <table class="table table-hover table-mail">
                <tbody>
				<?php
				$inq = mysqli_query($dbconnect, "SELECT * FROM messagelog WHERE MessageText NOT LIKE 'Your message was successfully received%' ORDER BY SendTime DESC LIMIT $offset,$limit");
				while($ina = mysqli_fetch_array($inq)){
					$message_id = $ina['Id'];
					$sender_no=$ina['MessageTo'];
					$message_text=$ina['MessageText'];
					$message_date=$ina['SendTime'];
				?>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks" name="checked[]" value="<?php echo $message_id; ?>">
                    </td>
                    <td class="mail-ontact"><a href="readsent.php?id=<?php echo $message_id;?>">To: 
					<?php $sn= mysqli_query($dbconnect, "SELECT names FROM tbl_contacts WHERE phone_no='$sender_no'");
						$sna=mysqli_fetch_array($sn);
						$names=$sna['names'];
						if($names!=null){
							echo $names;
						}else{
							echo $sender_no;
						}
					?></a></td>
                    <td class="mail-subject"><a href="readsent.php?id=<?php echo $message_id;?>"><?php echo $message_text; ?></a></td>
                    <td class="text-right mail-date"><?php echo $message_date; ?></td>
                    <td class="">
					<a href="messages.php?status=sent&trash=<?php echo $message_id;?>">
						<button onclick="return confirm('Are you sure you sent this message to trash?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button>
					</a>
					 <?php
							if(isset($_GET['trash'])){
								$deleted = $_GET['trash'];
								$action = mysqli_query($dbconnect,"DELETE FROM messagelog WHERE Id='$deleted'");
								if($action){
									echo $message_id;
								}
								else {
									?>
									<script>
										alert('Error deleting message <?php echo "$dbconnect->error()";?>');
											window.location = 'messages.php?status=sent';
									</script>	
									<?php
								}
							}
							?>
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