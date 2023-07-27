<?php 
		include('includes/authenticate.php');
		if(isset($_POST['addEmployee'])){
		$ids=$_POST['actor'];
		$dept=$_POST['dept'];
			$getprv = mysqli_query($dbconnect,"SELECT * FROM tbl_users WHERE `id_no`='$ids'");
			if($num_of_rows = $getprv->num_rows >= 1){
			$password=hash('sha256','@password123');
			$sql5 = "UPDATE `tbl_users` SET `password`='$password',`user_l`='$dept',`active`='activated' WHERE `id_no`='$ids'";
			$result5 = $dbconnect->query($sql5);
			$update=mysqli_query($dbconnect,"UPDATE `tbl_employees` SET `active`='YES' WHERE `emp_idno`='$ids'");	
			header("Location:employees.php");
			}else{
				$getEmpl = mysqli_query($dbconnect,"SELECT * FROM tbl_employees WHERE `emp_idno`='$ids'");
				$geact = mysqli_fetch_array($getEmpl);
											$f_name =$geact['emp_fname'];
											$s_name =$geact['emp_onames'];
											$id_no =$geact['emp_idno'];
											$email =$geact['emp_email'];
											$phone=$geact['emp_phone'];
											$password=hash('sha256','@password123');
											$user_l=$dept;
											$profile_image = $geact['emp_address'];
				
				
				$sql5 = "INSERT INTO `tbl_users`(`f_name`, `s_name`, `id_no`, `email`, `phone`, `password`, `user_l`, `profile_image`,`active`) VALUES ('$f_name','$s_name','$id_no','$email','$phone','$password','$dept','','activated')";
								$result5 = $dbconnect->query($sql5);
				$update=mysqli_query($dbconnect,"UPDATE `tbl_employees` SET `active`='YES' WHERE `emp_idno`='$id_no'");
				header("Location:employees.php");
			}
		}
		if(isset($_POST['deactiv'])){
			$id_no=$_POST['actor'];
			
			$sql5 = "UPDATE `tbl_users` SET `active`='deactivated' WHERE `id_no`='$id_no'";
			 $result5 = $dbconnect->query($sql5);
			
			$update=mysqli_query($dbconnect,"UPDATE `tbl_employees` SET `active`='' WHERE `emp_idno`='$id_no'");	
			header("Location:employees.php");
		}
		
		?>