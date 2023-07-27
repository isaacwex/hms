<?php 
session_start();
$q=$_GET['q'];
$_SESSION['edit'] = array(
    'id' => $q,
);header("Location: newotc.php");
?>