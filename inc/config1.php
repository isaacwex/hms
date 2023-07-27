<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "smart_campaigner_db";

$dbconnect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()){
	echo "<div style=\"color:red\">Ooops error connecting to database server</div>",mysqli_connect_error();
}
if($dbconnect->set_charset('utf-8')){
	echo "<div style=\"color:red\">Error setting character set to utf-8</div>", $dbconnect->error();
}


?>