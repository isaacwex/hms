<?php
session_start();
require_once 'inc/auth.php';

$signedemail = $_SESSION['email'];

	
		$now = time();
/*Timeout for sessions
		if($now > $_SESSION['expire']) {
			session_destroy();
			//echo "<p align='center'>Session has been destroyed!!";
			header("Location: login.php");  
		}*/
		
		if(isset($_SESSION['logged_in'])) {
			   // Check if last activity was more than 5 minutes ago
			   if (time() - $_SESSION['last_activity'] > 300) {
				   // Destroy session and log out user
				   session_destroy();
				   header('Location: login.php');
				   exit();
			   }

			   // Update last activity time
			   $_SESSION['last_activity'] = time();
			}
						
		
//check loogin and redirect appropriately
if(!isset($_SESSION['email'])){
	header('location:login.php');
	exit;
}

$adminDetails = mysqli_query($dbconnect,"SELECT * FROM tbl_users WHERE email='$signedemail'");
$dd = mysqli_fetch_assoc($adminDetails);
$sid = $dd['id'];
$sfname = $dd['f_name'];
$ssname = $dd['s_name'];
$semail = $dd['email'];
$sidno = $dd['id_no'];
$sphone = $dd['phone'];
$user_l = $dd['user_l'];
$password = $dd['password'];
$password1 = hash('sha256', 'password123');

$fullnames = "$sfname $ssname";


	$getcountleaves =mysqli_query($dbconnect,"SELECT COUNT(*) as k FROM tbl_leavetransactions WHERE leavetrans_approver='$sidno' AND leavetrans_status='APPLIED'");
	$gcntttl1 = mysqli_fetch_array($getcountleaves);
	$leavestoapprove = $gcntttl1['k'];
	if($password==$password1){
		$page=basename($_SERVER['PHP_SELF']);
		if($page!='profile.php'){
			header('location:profile.php?activated=true');
		}
	}
?>