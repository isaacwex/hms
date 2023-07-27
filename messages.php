<?php include 'includes/authenticate.php';
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>

    <title>Messages - <?php echo "$campaigner_name - $smart_name"; ?></title>

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
                            <a class="btn btn-block btn-primary compose-mail" href="send-multiple.php"><i class="fa fa-paper-plane-o"></i> Compose SMS</a>
                            <div class="space-25"></div>
                            <h5>Folders</h5>
							<?php
							$getNo = mysqli_query($dbconnect, "SELECT count(*) as x FROM tbl_messages WHERE message_status='1'");
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
                               
                                <li><a href="messages.php?status=trash"> <i class="fa fa-trash-o"></i> Trash  <span class="label label-warning pull-right"><?php echo $c4; ?></span></a></li>
                            </ul>
                            <h5>Quick Links</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="contacts.php"> <i class="fa fa-circle text-navy"></i> Contacts </a></li>
                                <li><a href="send-multiple.php"> <i class="fa fa-circle text-danger"></i> Send to many</a></li>
                                <li><a href="profile.php"> <i class="fa fa-circle text-primary"></i> Profile</a></li>
                            </ul>

                           
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
			
			$status = $_GET['status'];
			if($status=="inbox"){
				include('inbox.php');
			}
			elseif($status=="sent"){
				include('sent.php');
			}
			elseif($status=="important"){
				include('important.php');
			}
			elseif($status=="trash"){
				include('trash.php');
			}
			elseif($status=="drafts"){
				include('drafts.php');
			}
			else {
				include('inbox.php');
			}
			
			?>
        </div>
        </div>
        <?php include 'includes/footer.php'; ?>

        </div>
        </div>

    
   <?php include 'includes/footer-scripts.php';?>
  <!-- Mainly scripts -->	
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
	
	<!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>   <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
	<script>
		$("#checkAl").click(function () {
		$('input:checkbox').not(this).prop('checked', this.checked);
		});
	</script>

</body>

</html>
