<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title>Add Consultations<?php echo "$smart_name"; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	
	<?php
	$item=$_GET['item'];
	$saleid=$_GET['saleid'];
	$No = 0;
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM `tbl_sales` WHERE sale_itemcode='$item' AND batch='$saleid'");
		
		while($gac = mysqli_fetch_array($getPatients)){
			$No=$No+1;
			$c_id = $gac['reg_no'];
			$fnames = $gac['f_name'];
			$lnames = $gac['l_name'];
			$id_number = $gac['id_no'];
			$phonenumber = $gac['phone_no'];
			$gender = $gac['gender'];
			$dob = $gac['dob'];
			$opno = $gac['opno'];
			$visitno = $gac['visit_no'];
			$residence = $gac['residence'];
			$visit_date = $gac['visit_date'];
			$todaydate = date('Y-m-d');
		}									
	
	$date1 = $dob;
	$date2 = $todaydate;
	
	$diff = date_diff(date_create($dob), date_create($todaydate));
	$agess = $diff->format('%y');
	
	
	$getConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_consultations WHERE consultation_visitno='$visitno' AND consultation_opno='$opno'");
			$gc = mysqli_fetch_assoc($getConsultations);
			$consultation_opno = $gc['consultation_opno'];
			$consultation_visitno = $gc['consultation_visitno'];
			$consultation_complaints = $gc['consultation_complaints'];
			$consultation_presenthistory = $gc['consultation_presenthistory'];
			$consultation_allergies = $gc['consultation_allergies'];
			$consultation_medicalhistory = $gc['consultation_medicalhistory'];
			$consultation_surgicalhistory = $gc['consultation_surgicalhistory'];
			$consultation_familyhistory = $gc['consultation_familyhistory'];
			$consultation_economichistory = $gc['consultation_economichistory'];
			$consultation_socialhistory = $gc['consultation_socialhistory'];
			$consultation_impressions = $gc['consultation_impressions'];
			$consultation_diagnosis = $gc['consultation_diagnosis'];
			$consultation_summary = $gc['consultation_summary'];
	
?>

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
		<div class="row wrapper border-bottom white-bg page-heading">
            </div>
			<div class="wrapper wrapper-content">
                <div class="row">					
								
					<div class="col-lg-12">					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
						    <div class="modal-body">
											
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