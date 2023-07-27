<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Wards Management - <?php echo "$smart_name"; ?></title>
	
	
    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<?php include('includes/meta.php');?>

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<script>
		$(document).ready(function(){
			$('#yes_county').change(function(){
				var yes_county = $('#yes_county').val();
				if(yes_county != 0)
				{
					$.ajax({
						type:'post',
						url:'getSubCounty.php',
						data:{id:yes_county},
						cache:false,
						success: function(returndata){
							$('#subcounty_name').html(returndata);
						}
					});
				}
			})
		})
	</script>
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
							<span><a href="wards.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Add Ward(s)</span></button></a></span></p>
							
						</div>				
					</div>
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Wards</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<form role="form" method="post">
									<div class="col-sm-12">													
										<?php
											if(isset($_POST['neward'])){
												if(empty($_POST['ward'])){
												echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Sub county name is required.</div>";
														}
														
												else {
												$sub_county = $dbconnect->real_escape_string($_POST['sub_county']);
												$loc_type = "3";
												$ward_name = $dbconnect->real_escape_string($_POST['ward']);
															
												$checknumber = mysqli_query($dbconnect, "SELECT * FROM tbl_locations WHERE location_name='$ward_name' AND location_type='$loc_type'");
												$countNo = mysqli_num_rows($checknumber);
												if($countNo >= 1){
														echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> The ward $ward_name already exists.</div>";
																
														}
												else {
													if($stmt = $dbconnect->prepare("INSERT INTO tbl_locations (location_name, location_type, location_parent_id) VALUES (?,?,?)")){
													$stmt->bind_param('sss',$ward_name, $loc_type, $sub_county);
													$stmt->execute();
														echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> The sub county $ward_name has been defined successfully.</div>";
													}
													else {
														
														echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Error definining sub county</div>";
																	
																}
															}
															
														}
														
													}
												?>
											</div>
												
											<div class="col-sm-12">
												<div class="form-group">
													<label>Choose County</label>
													<select name="yes_county" id="yes_county" class="form-control" required>
														<option value="" selected="selected">Choose County</option>
														<?php
														$getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='1'");
														while($gal = mysqli_fetch_array($getalllocations)){
															$loctype = $gal['location_id'];
															$locname = $gal['location_name'];
																	
															?>
															<option value="<?php echo $loctype; ?>" ><?php echo $locname; ?></option>
															<?php
															}
															?>
													</select>
												</div>
												<div class="form-group">
													<label>Sub County</label>
													<select name="sub_county" id="subcounty_name" class="form-control" required>
														<option value="" selected="selected">Select County First</option>
													</select>
												</div>
												<div class="form-group">
													<label>Ward Name</label>
													<input type="text" name="ward" placeholder="Sub County" class="form-control">
												</div>
												<div class="form-group">
													<button name="neward" class="btn btn-md btn-primary" type="submit">Add Ward</button>
												</div>	
											</div>																							
								</form>
							</div>
						</div>
					 </div>
					</div>
					
					
					<div class="col-lg-6">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Wards</h5>
						</div>
                        <div class="ibox-content">
                           <div class="row">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>#</th>
									<th>Code</th>
									<th>Sub County</th>
									<th>Ward Name</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								$getcountyname =mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_type='3'");
								while($gcn = mysqli_fetch_array($getcountyname)){
									$No=$No+1;
									$ward_code = $gcn['location_id'];
									$ward_name = $gcn['location_name'];
									$subcounty_code = $gcn['location_parent_id'];
									
									$getcountiesname = mysqli_query($dbconnect,"SELECT * FROM tbl_locations WHERE location_id='$subcounty_code'");
									$get_cname = mysqli_fetch_array($getcountiesname);
									$subcounty_name = $get_cname['location_name'];
								
								?>
								 <td><?php echo $No; ?></td>
									<td><?php echo $ward_code; ?></td>
									<td><?php echo $subcounty_name; ?></td>
									<td><?php echo $ward_name; ?></td>
									<td><a href="edit-ward.php?wardid=<?php echo $ward_code; ?>"><button class="btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</button></a> | <?php
											if(isset($_GET['trash'])){
												$trashed = $_GET['trash'];
												$action = mysqli_query($dbconnect,"DELETE FROM tbl_locations WHERE location_id='$trashed'");
												if($action){
													?>
													<script>
														alert(' successfully deleted');
															window.location = 'wards.php';
													</script>	
													<?php
												}
												else {
													?>
													<script>
														alert('Error deleting message');
															window.location = 'wards.php';
													</script>	
													<?php
												}
											}
											?>
									<a href="wards.php?trash=<?php echo $ward_code;?>">
										<button onclick="return confirm('Are you sure you want to delete <?php echo ucwords(strtolower($ward_name)); ?> Ward?')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> Delete</button></a>
									</td>
								</tr>
								<?php
								}
								?>
								
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>Code</th>
									<th>County Name</th>
									<th>Sub County Name</th>
									<th>Action</th>
								</tr>
								</tfoot>
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


    <!-- Chosen -->
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
