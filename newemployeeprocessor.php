<?php include('includes/authenticate.php');
													if(isset($_POST['addEmployee'])){
														if($_POST['fname']==""||$_POST['onames']==""||$_POST['idno']==""){
															$res="<div class='alert alert-danger' role='alert'>Ensure the names are filled and ID number</div>";
															header("Location:employees.php?res=$res");
															}
														else{
															$emp_fname = stripslashes(trim($dbconnect->real_escape_string($_POST['fname'])));
															$emp_onames = stripslashes(trim($dbconnect->real_escape_string($_POST['onames'])));
															$emp_fname = stripslashes(trim($dbconnect->real_escape_string(ucwords(strtolower($emp_fname )))));
															$emp_onames = stripslashes(trim($dbconnect->real_escape_string(ucwords(strtolower($emp_onames)))));
															$emp_des = stripslashes(trim($dbconnect->real_escape_string($_POST['designation'])));
															$emp_idno = stripslashes(trim($dbconnect->real_escape_string($_POST['idno'])));
															$emp_phone = stripslashes(trim($dbconnect->real_escape_string($_POST['phone'])));
															$emp_email = stripslashes(trim($dbconnect->real_escape_string($_POST['email'])));
															$emp_address = stripslashes(trim($dbconnect->real_escape_string($_POST['physicaladdress'])));
															$emp_gender = stripslashes(trim($dbconnect->real_escape_string($_POST['gender'])));
															$emp_marital_status = stripslashes(trim($dbconnect->real_escape_string($_POST['maritalstatus'])));
															$emp_dob = stripslashes(trim($dbconnect->real_escape_string($_POST['dob'])));
															$emp_nationality = stripslashes(trim($dbconnect->real_escape_string($_POST['nationality'])));
															$emp_doe = stripslashes(trim($dbconnect->real_escape_string($_POST['employmentdate'])));
															$emp_bank = stripslashes(trim($dbconnect->real_escape_string($_POST['bank'])));
															$emp_branch = stripslashes(trim($dbconnect->real_escape_string($_POST['acbranch'])));
															$emp_accno = stripslashes(trim($dbconnect->real_escape_string($_POST['accno'])));
															$emp_nssf = stripslashes(trim($dbconnect->real_escape_string($_POST['nssfno'])));
															$emp_nhif = stripslashes(trim($dbconnect->real_escape_string($_POST['nhifno'])));
															$emp_kra = stripslashes(trim($dbconnect->real_escape_string($_POST['kra'])));
															$basicsalary = stripslashes(trim($dbconnect->real_escape_string($_POST['basicsalary'])));	
															$c_emp = "SELECT * FROM tbl_employees WHERE emp_idno='$emp_idno'";
																		$c4v = mysqli_query($dbconnect, $c_emp);								
																		$crec = mysqli_num_rows($c4v);
																		$ce = mysqli_fetch_array($c4v);
																		$empfname = $ce['emp_fname'];
																		$emponames = $ce['emp_onames'];
															if($crec >= 1){
																			$res= "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the employee <strong>$empfname $emponames</strong> with ID ($emp_idno) already exists</div>";
																			header("Location:employees.php?res=$res");
																		}
															else {					
															$addEmp = "INSERT INTO tbl_employees (emp_fname, emp_onames, emp_designation, emp_idno, emp_phone, emp_email, emp_address, emp_gender, emp_marital_status, emp_dob, emp_nationality, emp_doe, emp_bank, emp_bank_branch, emp_accountno, emp_nssfno, emp_nhifno, emp_kra, emp_basicsalary) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";						
																if($stmt = $dbconnect->prepare($addEmp)){
																	$stmt->bind_param('sssssssssssssssssss', $emp_fname, $emp_onames, $emp_des, $emp_idno, $emp_phone, $emp_email,$emp_address, $emp_gender, $emp_marital_status, $emp_dob, $emp_nationality, $emp_doe, $emp_bank, $emp_branch, $emp_accno, $emp_nssf, $emp_nhif, $emp_kra, $basicsalary);
																	$stmt->execute();
																		$res= "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><sup>x</sup></button><i class=\"fa fa-exclamation-triangle\"></i> Employee added successfully</div>";
																		header("Location:employees.php?res=$res");
																	}
																	else {
																		echo mysqli_error($dbconnect);
																}
															}
														}
													}
													
													?>
													

