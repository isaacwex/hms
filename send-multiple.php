<?php include 'includes/authenticate.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Send Multiple - <?php echo $smart_name; ?></title>

    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<?php include('includes/meta.php');?>

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
  <div id="wrapper">
		<?php include('includes/sidebar.php');?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <?php include('includes/top-nav.php');?>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Choose item to send text</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Contact List</a>
                        </li>
                        <li>
                            <a>Group</a>
                        </li>
                        <li class="active">
                            <strong>Location</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Chose recipient to send to<small></small></h5>
                </div>
                <div class="ibox-content">
               <form name="bulksend" method="post">
				<?php
				if(isset($_POST['sendBulk'])){
					if(empty($_POST['counties'])&&empty($_POST['groups'])&&empty($_POST['contacts'])){
						//echo "You must select atleast one item to send text!!!";
						echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> You must select atleast one item to send text!!!.
																</div>";
					}
					elseif(empty($_POST['bulkSMS'])){
						//echo "You must enter the text to send";
						echo "<div class=\"alert alert-danger alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> You must enter the text to send.
																</div>";
					}
					elseif($_POST['groups']!=null){
						
							$group_no = $dbconnect->real_escape_string($_POST['groups']);
							$txt=$_POST['bulkSMS'];
							$getphonegroup = mysqli_query($dbconnect, "SELECT c.phone_no FROM tbl_contacts c INNER JOIN tbl_category_assignment a ON a.category_id=$group_no WHERE c.contact_id=a.contact_id");
								
									while($gphoneg = mysqli_fetch_array($getphonegroup)){
										$phneg=$gphoneg['phone_no'];
									
										if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageText, MessageTo) VALUES (?,?)")){
																	$stmt->bind_param('ss',$txt,$phneg);
																	$stmt->execute();
																	//echo 'Succesful...Attempting to send text to the selected group(s)....';
												}
									
												else{
														echo'Not successful. Error occured';
												}
									
								}
								
								echo "<div class=\"alert alert-success alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Succesful...Attempting to send text to the selected recipient(s).....
																</div>";
					}
					elseif($_POST['contacts']!=null){
						foreach($_POST['contacts'] as $contact_no){
								$txt=$_POST['bulkSMS'];
									if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageText, MessageTo) VALUES (?,?)")){
											$stmt->bind_param('ss',$txt,$contact_no);
											$stmt->execute();
									echo "<div class=\"alert alert-success alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Succesful...Attempting to send text to the selected recipient(s)....The process is performed in the background.
																</div>";				
													}
						else{
								echo'Not successful. Error occured';
						}
					}
					}
					elseif($_POST['counties']!=null)
					{
						
							//$loc_code= $_POST['counties']
							$loc_code = $dbconnect->real_escape_string($_POST['counties']);
							$txt=$_POST['bulkSMS'];
							$getphone = mysqli_query($dbconnect, "SELECT phone_no FROM tbl_contacts WHERE village='$loc_code' OR sublocation='$loc_code' OR location='$loc_code' OR ward='$loc_code' OR subcounty='$loc_code' OR county='$loc_code'");
							
							
							while($gphone = mysqli_fetch_array($getphone)){
									
								//	$gphone= mysqli_fetch_assoc($getphone);
									$phne=$gphone['phone_no'];
									
										if($stmt = $dbconnect->prepare("INSERT INTO messageout (MessageText, MessageTo) VALUES (?,?)")){
																	$stmt->bind_param('ss',$txt,$phne);
																	$stmt->execute();
																	//echo 'Succesful...Attempting to send text to the selected group(s)....';
												}
									
						else{
								echo'Not successful. Error occured';
						}
							}
					echo "<div class=\"alert alert-success alert-dismissable\">
																	<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Succesful...Attempting to send text to the selected recipient(s)....The process is performed in the background.
																</div>";				
						
					}
					else {
							echo "This is is the last else. Idont know what to tell you in this else statement";
					}
				}
				?>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-4">
								<div class="form-group">
									<label class="font-noraml">Group to send SMS to</label>
									<div class="input-group">
										<!--<select data-placeholder="Choose a Group(s)..." name="groups[]" class="chosen-select" multiple style="width:300px;" tabindex="4">
											<option value="">Select</option>
											<?php 
											/** $getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_categories");
											while($locs = mysqli_fetch_array($getcontactslocations)){
												$cat_no = $locs['cat_no'];
												$cat_name = $locs['category_name'];
												
												echo "<option value=\"$cat_no\">$cat_name</option>"; 
											}**/
											?>
										</select>--->
										<select name="groups" class="form-control">
																<option value="" selected="selected">Choose Group</option>
																<?php
											$getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_categories");
											while($locs = mysqli_fetch_array($getcontactslocations)){
												$cat_no = $locs['cat_no'];
												$cat_name = $locs['category_name'];
												echo "<option value=\"$cat_no\">$cat_name</option>";
													}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="font-noraml">Select Contact(s) to Send SMS To</label>
									<div class="input-group">
										<select data-placeholder="Choose a contact(s)..." name="contacts[]" class="chosen-select" multiple style="width:300px;" tabindex="4">
											<option value="">Select contact(s)</option>
											<?php 
											$getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_contacts");
											while($locs = mysqli_fetch_array($getcontactslocations)){
												$locname = $locs['subcounty'];
												$cnames = $locs['names'];
												$cnumber = $locs['phone_no'];
												$con_id = $locs['contact_id'];
												
												echo "<option value=\"$cnumber\">$cnames - $cnumber</option>";
											}
											?>
										</select>
									</div>
									
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="font-noraml">Select area to Send SMS To</label>
									<div class="input-group">
										<!---<select data-placeholder="Choose location..." name="counties[]" class="chosen-select" multiple style="width:300px;" tabindex="4">
											<option value="">Select</option>
											<?php 
											/*$getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations l INNER JOIN tbl_location_types t ON l.location_type=t.location_type_code");
											while($locs = mysqli_fetch_array($getcontactslocations)){
												$locid = $locs['location_id'];
												$locname = $locs['location_name'];
												$loctypename = $locs['location_type_name'];
												
												echo "<option value=\"$locid\">$locname ($loctypename)</option>";*/
											//}
											?>
										</select>---->
										<select name="counties" class="form-control">
																<option value="" selected="selected">Choose area</option>
																<?php
																$getcontactslocations = mysqli_query($dbconnect,"SELECT * FROM tbl_locations l INNER JOIN tbl_location_types t ON l.location_type=t.location_type_code");
											while($locs = mysqli_fetch_array($getcontactslocations)){
												$locid = $locs['location_id'];
												$locname = $locs['location_name'];
												$loctypename = $locs['location_type_name'];
												
												echo "<option value=\"$locid\">$locname ($loctypename)</option>";
																}
																?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<textarea class="form-control" rows="4" required name="bulkSMS" placeholder="Add Message Here"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="sendBulk" value="SEND MESAGE" />
							</div>
						</div>
					</div>
					</form>
                </div>
                </div>

            </div>
                
            </div>
       
        </div>
        <?php include('includes/footer.php');?>

        </div>
                    </div>

    <!-- Mainly scripts -->
    <?php include('includes/footer-scripts.php');?>

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
