<?php 
require("inc/sfunction.php");
require("inc/dbconnect.php");
require("inc/session.php");
include("inc/config.php");

$timenow = timenow();	// Current time

$language=$_SESSION["language_be_choosed"];
// Updating session record
mysql_query("UPDATE `session` SET `lastAction` = '$timenow', `userID` = 0, `userType` = 0, `ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE `id` = '".session_id()."'", $db); 
mysql_query("UPDATE `user` SET `lastvisit` = '$timenow' WHERE `id` = '".$_SESSION['interbringeruserId']."'", $db);

session_unset();
$_SESSION["language_be_choosed"] = $language;
$_SESSION['msgtype']=1;
$_SESSION['msg'] = SUCCESS_LOGOFF_HINT; // You have successfully logged out

header("Location: login.php");


?>
