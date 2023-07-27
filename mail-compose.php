<?php include 'includes/authenticate.php';?>
<!DOCTYPE html>
<html>

<head>

    <title>Compose an SMS - <?php echo "$campaigner_name - $smart_name"; ?></title>

    <?php include 'includes/meta.php'; ?>

</head>

<body>

    <div id="wrapper">

    <?php include 'includes/sidebar.php'; ?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">        
        <?php include 'includes/top-nav.php'; ?>
        </div>

        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="mail-compose.php"><i class="fa fa-paper-plane-o"></i> Compose SMS</a>
                            <div class="space-25"></div>
                            <h5>Folders</h5>
							<?php
							$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='1' OR message_status='2'");
							$ga = mysqli_fetch_array($getNo);
							$c=$ga['x'];
							
							$getNo2 = mysqli_query($dbconnect, "SELECT count(*) as x2 FROM tbl_messages WHERE message_status='2'");
							$ga2 = mysqli_fetch_array($getNo2);
							$c2=$ga2['x2'];
							
							$getNo3 = mysqli_query($dbconnect, "SELECT count(*) as x3 FROM tbl_messages WHERE message_status='3'");
							$ga3 = mysqli_fetch_array($getNo3);
							$c3=$ga3['x3'];
							
							$getNo4 = mysqli_query($dbconnect, "SELECT count(*) as x4 FROM tbl_messages WHERE message_status='4'");
							$ga4 = mysqli_fetch_array($getNo4);
							$c4=$ga4['x4'];
							
							$getNoi = mysqli_query($dbconnect, "SELECT count(*) as xi FROM messagelog WHERE MessageText NOT LIKE 'Your message was successfully received%'");
							$gai = mysqli_fetch_array($getNoi);
							$ci=$gai['xi'];
							?>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="messages.php?status=inbox"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning pull-right"><?php echo $c; ?></span> </a></li>
                                <li><a href="messages.php?status=sent"> <i class="fa fa-envelope-o"></i> Sent SMS  <span class="label label-warning pull-right"><?php echo $ci; ?></span></a></li>
                                <li><a href="messages.php?status=important"> <i class="fa fa-certificate"></i> Important  <span class="label label-warning pull-right"><?php echo $c2; ?></span></a></li>
                                <li><a href="messages.php?status=draft"> <i class="fa fa-file-text-o"></i> Drafts  <span class="label label-warning pull-right"><?php echo $c3; ?></span></a></li>
                                <li><a href="messages.php?status=trash"> <i class="fa fa-trash-o"></i> Trash  <span class="label label-warning pull-right"><?php echo $c4; ?></span></a></li>
                            </ul>
                            <h5>Quick Links</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="#"> <i class="fa fa-circle text-navy"></i> Contacts </a></li>
                                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Send to many</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Profile</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Advertising</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Clients</a></li>
                            </ul>

                           
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
				include('includes/compose.php');
			
			?>
        </div>
        </div>
        <?php include 'includes/footer.php'; ?>

        </div>
        </div>

    
   <?php include 'includes/footer-scripts.php';?>
  <!-- Mainly scripts -->	
  <script>
        $(document).ready(function(){

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });


        });
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

    </script>

</body>

</html>
