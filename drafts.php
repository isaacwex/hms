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
				$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='1'");
				$ga = mysqli_fetch_array($getNo);
				$c=$ga['x'];
				?>
                    Inbox (<?php echo $c; ?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                   <a href="messages.php?status=inbox"><button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button></a>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

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
                    <td class=""><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#<?php echo $message_id; ?>"><i class="fa fa-mail-reply"></i> Reply</button><?php include('modals/reply-message.php');?>
					</td>
                </tr>
               <?php
			   }
				?>
                </tbody>
                </table>


                </div>
            </div>