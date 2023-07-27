<?php
	session_start();
	
	if (!isset($_SESSION['email'])) {
		header("Location: login.php");
	} 
	elseif(isset($_SESSION['email'])!="") {
		header("Location: index.php");
	}
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['email']);
		header("Location: login.php");
		exit;
	}
