<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "agrovet";

$dbconnect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//$dbConnect = new mysqli('localhost','root','','smart_campaigner_db');

if(mysqli_connect_errno()){
	echo "<div style=\"color:red\">Ooops error connecting to database server</div>",mysqli_connect_error();
}
if($dbconnect->set_charset('utf-8')){
	echo "<div style=\"color:red\">Error setting character set to utf-8</div>", $dbconnect->error();
}


?>