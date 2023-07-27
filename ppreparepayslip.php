<?php include('includes/authenticate.php'); ?>
<?php
	$getmaxreg = mysqli_query($dbconnect,"SELECT Max(petty_transcode) as OPNO FROM tbl_pettycash");
	$asreg = mysqli_fetch_array($getmaxreg);
	$opnos = $asreg['OPNO'];
	$nextcode = $opnos+1;
	$postnextcode = str_pad($nextcode,4,"0",STR_PAD_LEFT);
	
	?>
<!DOCTYPE html>
<html>

<head>

    <?php include('includes/meta.php');?>
	
    <title> Employees Cash - <?php echo "$smart_name"; ?></title>
	
	<!-- Data Tables -->
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<script>
		function showResult(actor) {
			var dep=document.getElementById("dep").value;
			document.getElementById("loading").innerHTML='Activating....';
			alert(dep);
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("loading").innerHTML=this.responseText;
				document.getElementById("loading").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","activate.php?actor="+actor+"&dept="+dept);
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("loading").innerHTML=this.responseText;
				document.getElementById("loading").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","activate.php?actor="+actor+"&dept="+dep);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
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
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>HR and Payroll</h2>
				<ol class="breadcrumb">
					<li>
						<a href="employees.php"> Employees</a>
					</li>                        
					<li class="active">
						<strong>New Employee</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
						<p class="pull-right"></br>
						<a href="#register" class="btn-primary btn" data-toggle="modal" title="register">
						<i class="fa fa-plus"></i>Add New Employee				
						</a></p>
						<?php include('modals/new_employee.php');?>
				</div>
		</div>

       <!-- <div class="wrapper wrapper-content"> -->
                <div class="wrapper wrapper-contentr">
          
		<div class="row">
              <div class="media-list bg-white rounded shadow-base">
               <div class="card pd-20 pd-xs-30 shadow-base bd-0">
               <?php if(isset($res)){
					echo $res;
				} ?>
				<!-- form-layout-footer -->
				
				<div class="col-lg-12">
					<div class="form-group">
					  <h3 class="tx-gray-800 tx-uppercase tx-semibold tx-15 mg-b-25">LIST OF EMPLOYEES</h3>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-12 ibox-content">
					<div class="table-wrapper">
				<table class="table  ">
				  <thead>
					<tr>
					  <th>S/NO</th>
					  <th>Employee</th>
					  <th>ID No.</th>
					  <th>DESG.</th>
					  <th>Phone</th>
					  <th>Address</th>
					  <th>Bank (Branch)</th>
					  <th>Accout No</th>
					  <th>more information</th>
					  
					</tr>
				  </thead>
				  <tbody>
					  <?php
							$getEmployees = mysqli_query($dbconnect,"SELECT * FROM tbl_employees");
								$No=0;
								while($ge = mysqli_fetch_array($getEmployees)){
									//	$dhosiname = strtoupper($ge['hospitalName']);
									$No = $No+1;
									$firstname =$ge['emp_fname'];
									$onames =$ge['emp_onames'];
									$idno =$ge['emp_idno'];
									$designation =$ge['emp_designation'];
									$egender=$ge['emp_gender'];
									$ephone=$ge['emp_phone'];
									$emp_dob=$ge['emp_dob'];
									$active=$ge['active'];
									$eaddress = $ge['emp_address'];
									$basicsalary = $ge['emp_basicsalary'];
									$ebank = $ge['emp_bank'];
									$emp_marital_status = $ge['emp_marital_status'];
									$bankbranch = $ge['emp_bank_branch'];
									$bankaccount = $ge['emp_accountno'];
									$emp_doe = $ge['emp_doe'];
									$emp_nationality = $ge['emp_nationality'];
									$emp_nssfno = $ge['emp_nssfno'];
									$emp_nhifno = $ge['emp_nhifno'];
									$empkra = $ge['emp_kra'];
										echo "
											<tr>
											  <td>$No</td>
											  <td>$firstname $onames</td>
											  <td>$idno</td>
											  <td>$designation</td>
											  <td>$ephone</td>
											  <td>$eaddress</td>
											  <td>$ebank ($bankbranch)</td>
											  <td>$bankaccount</td>
											  
										";?>
										<td>
								  <a href="#employees<?php echo $idno;?>" data-toggle="modal" title="Profile">More Information</a>		
									<?php include('modals/employees_info.php');?>
								   </td>
											</tr>
									<?php }?>
								  
					</tbody>
				</table>
				</div>  
				</div><!-- col-4 -->
				
            
				</div>
			</div><!-- row -->
			
		  </div> 
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>														
																	
   <?php include 'includes/footer-scripts.php';?>
</body>
</html>
 