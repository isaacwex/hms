<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Welcome to <?php echo $smart_name; ?>..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
		<?php
		$getU = mysqli_query($dbconnect, "SELECT count(*) as xu FROM tbl_messages WHERE (message_status='1' OR message_status='2') AND read_status='0'");
							$gau = mysqli_fetch_array($getU);
							$cu=$gau['xu'];
							
		$geti = mysqli_query($dbconnect, "SELECT count(*) as xi FROM tbl_messages WHERE message_status='2'");
		$gai = mysqli_fetch_array($geti);
		$ci=$gai['xi'];
		
		?>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <!--<span class="m-r-sm text-muted welcome-message">Welcome to <?php echo $smart_name; ?>.</span>-->
                </li>
                <li>
                    <!--<a class="count-info" tooltip="Unread" href="messages.php?status=inbox">-->
                    <a class="count-info" tooltip="Unread" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">0</span>
                    </a>
                </li>
                <li>
                    <!--<a class="count-info" data-toggle="dropdowhn" tooltip="Marked Important" href="messages.php?status=important">-->
                    <a class="count-info" data-toggle="dropdowhn" tooltip="Marked Important" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">0</span>
                    </a>
                 </li>
				<li>
                    <a href="logout.php?logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
	</nav>