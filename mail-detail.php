<?php
				$inq = mysqli_query($dbconnect, "SELECT * FROM tbl_messages WHERE message_id='$msg_id'");
				$ina = mysqli_fetch_array($inq);
				$message_id = $ina['message_id'];
				$sender_no=$ina['sender_no'];
				$message_text=$ina['message_text'];
				$message_date=$ina['message_date'];
				$status=$ina['read_status'];
				
				$sn= mysqli_query($dbconnect, "SELECT names FROM tbl_contacts WHERE phone_no='$sender_no'");
				$sna=mysqli_fetch_array($sn);
				$names=$sna['names'];
				if($names!=null){
					//echo $names;
				}else{
					//echo $sender_no;
				}

				?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                   <!-- <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a>-->
                </div>
                <h2>
                    <?php echo $names;?>
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <h5>
                        <span class="pull-right font-noraml"><?php echo $message_date;?></span>
                        <span class="font-noraml">From: </span><?php echo "$names ($sender_no)";?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <p class="m-b-xs">
						<?php echo $message_text;?>
					</p>
                </div>
                       
                        <div class="mail-body text-right tooltip-demo">
								<a href="messages.php?status=inbox"><button class="btn btn-sm btn-white" data-toggle="modal" data-target=".../messages.php?status=inbox"><i class="fa fa-arrow-left"></i> Back</button></a>
								<button class="btn btn-sm btn-white" data-toggle="modal" data-target="#<?php echo $message_id;?>"><i class="fa fa-reply"></i> Reply</button>
								<?php include('modals/reply-message.php');?>
                        </div>
                        <div class="clearfix"></div>


                </div>
            </div>