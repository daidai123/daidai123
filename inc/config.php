<?php
error_reporting(0);
session_start();

if($_SESSION["language_be_choosed"]==""){
$lang=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
 if (substr($lang, 0, 2)=='en')
 {
  $_SESSION["language_be_choosed"]="eng";
  }else{
  $_SESSION["language_be_choosed"]="chn";
 }
}
if($_SESSION["language_be_choosed"]=="eng") include("language/eng.php");
else include("language/chn.php");
require("inc/dbconnect.php");
if($_SESSION['interbringeruserType']>1){
       $current_user=$_SESSION['interbringeruserId'];
	   update_lastaction($current_user, $db);
	 }
function update_lastaction($uid, $db){
	$time = time();
	$timeframe = '900'; // 900secs = 15mins; 1800secs = 30mins; 3600secs = 1hour;
	//echo $time+$timeframe;
	$sql="UPDATE user SET `lastvisit`= '".($time+$timeframe)."' WHERE id= ".$uid."";
	mysql_query($sql, $db);
}// this function gets inputted into each page.php or init.php page what you put in each page.php is below

?>