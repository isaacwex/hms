<?php

include ('config.php');

$get_system_settings = mysqli_query($dbconnect,"SELECT * FROM tbl_settings LIMIT 1");
$smartC = mysqli_fetch_array($get_system_settings);

$smart_name = $smartC['system_name'];
$campaigner_name = $smartC['campaigner_name'];
$camp_short_name = $smartC['campaigner_short_name'];
$campaign_location = $smartC['campaign_location'];
$seat_name = $smartC['seat'];
$slogan = $smartC['slogan'];
$custom_msg = $smartC['custom_reply_msg'];
$license = $smartC['l_status'];

?>