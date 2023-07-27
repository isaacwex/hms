<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Lab Services Master - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>

        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						<div class="col-lg-12">
						<p class="pull-right">
							<span><a href="#"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add </span></button></a></span></p>
							
						</div>				
					</div>				
					
					<div class="col-lg-8">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Lab Services for Different Payment Scheme</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Scheme Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$pscheme_code = $gcn['pscheme_code'];
									$pscheme_name = $gcn['pscheme_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $pscheme_name; ?></td>
									<td><button cclass="btn-xs btn-primary success" type="button"><a href="labservices.php?c=<?php echo $pscheme_code;?>&n=<?php echo $pscheme_name; ?>"><i class="fa fa-arrow-right"></i> Open pricing for <?php echo $pscheme_name; ?> </a></button></td>
								</tr>
								<?php
								}
								?>
								
								</tbody>
								</table>
							</div>
						</div>
					 </div>
					</div>
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
