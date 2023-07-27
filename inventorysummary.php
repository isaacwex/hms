<?php include 'includes/authenticate.php';?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo "$campaigner_name - $smart_name"; ?></title>
    <?php include 'includes/meta.php' ;?>
</head>
<body>
    <div id="wrapper">
			<?php include 'includes/sidebar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">  
            <!--nav menu-->      
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

     <!--end nav menu-->


        </div>
        <div class="wrapper wrapper-content">
        <div class="row">
		 <div class="col-lg-12">
				<p><h2> The <?php echo $smart_name; ?> System</h2></p>
		</div>
		</div>
		<div class="row">
                <div class="col-lg-2">
					<a href="#"> 
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-clipboard fa-4x"></i>
                            <h1 class="m-xs"></h1>
                            <h3 class="font-bold no-margins">
                                Patient Registry
                            </h3>
                        </div>
                    </div>
					</a>
                </div>
                <div class="col-lg-2">
					<a href="#">
                    <div class="widget  lazur-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-medkit fa-4x"></i>
                            <h1 class="m-xs"></h1>
                            <h3 class="font-bold no-margins">
                                Triage Section
                            </h3>
                        </div>
                    </div>
					</a>
                </div>
                <div class="col-lg-2">
                    <div class="widget red-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-user-md fa-4x"></i>
                            <h1 class="m-xs"></h1>
                            <h3 class="font-bold no-margins">
                                Consultation Room
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
					<div class="widget yellow-bg p-lg text-center">
						<div class="m-b-md">
							<i class="fa fa-flask fa-4x"></i>
							<h1 class="m-xs"></h1>
							<h3 class="font-bold no-margins">
								Laboratory Dept
							</h3>
						</div>
					</div>
				</div>
                <div class="col-lg-2">
                    <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-stethoscope fa-4x"></i>
                            <h1 class="m-xs"></h1>
                            <h3 class="font-bold no-margins">
                                Pharmacy Dept
                            </h3>
                        </div>
                    </div>
				</div>
                <div class="col-lg-2">
                    <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-user-md fa-4x"></i>
                            <h1 class="m-xs"></h1>
                            <h3 class="font-bold no-margins">
                                Treatment Room
                            </h3>
                        </div>
                    </div>
				</div>
        </div>
        <div class="row">
		<?php
	
		$getcontacts = mysqli_query($dbconnect,"SELECT count(*) as c FROM tbl_registry");
		$gc = mysqli_fetch_array($getcontacts);
		$g_allpatientscount = $gc['c'];
		
		$getmessages = mysqli_query($dbconnect,"SELECT count(*) as m FROM tbl_messages");
		$gm = mysqli_fetch_array($getmessages);
		$g_m = $gm['m'];
		
		$getsent = mysqli_query($dbconnect,"SELECT count(*) as s FROM messagein");
		$gs = mysqli_fetch_array($getsent);
		$g_s = $gs['s'];
		
		$all = $g_s+$g_m;
		
		?>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Unread</span>
                                <h5>In Process</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $g_allpatientscount; ?></h1>
                                <div class="stat-percent font-bold text-success"><a href='#'>View</a> <i class="fa fa-bolt"></i></div>
                                <small>Current patients in process</small>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Total Patients</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $g_allpatientscount;?></h1>
                                <div class="stat-percent font-bold text-info"><a href='#'>View</a> <i class="fa fa-level-up"></i></div>
                                <small>Total Patients Served </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Handled</span>
                                <h5>Patients</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $g_allpatientscount; ?></h1>
                                <div class="stat-percent font-bold text-navy"><a href='#'>View</a>  <i class="fa fa-level-up"></i></div>
                                <small>handled patients</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Collections</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">Ksh. </h1>
                                <div class="stat-percent font-bold text-danger"><a href='#'>View</a> <i class="fa fa-level-down"></i></div>
                                <small>Total Collections</small>
                            </div>
                        </div>
            </div>
        </div>
    				<div class="col-lg-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <i class="fa fa-info"></i> About this system
                                        </div>
                                        <div class="panel-body">
                                            <p>
											<ul>
												<li>Allow patient registration</li>
												<li>Monitor reports</li>
												<li>Keep history of data</li>
											</ul>
											</p>
                                        </div>
                                    </div>
								</div>	
					
                </div>
        
				<?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Mainly scripts -->
	<?php include 'includes/footer-scripts.php'; ?>

    <script>
    </script>
</body>
</html>
