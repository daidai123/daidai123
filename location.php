<?php
/*
 * Created on 2011-8-25
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */ 
    error_reporting(0);
    session_start();
    function mysql_open()
	{
	//define('ALL_PS',"PHP100");
	
	$mysql_servername="interbringer.db.6730981.hostedresource.com";
	$mysql_username="interbringer";
	$mysql_password="JAMESluo00711";
	$mysql_dbname="interbringer";
	
	$conn=mysql_connect($mysql_servername ,$mysql_username ,$mysql_password);
		 // mysql_query("set names UTF8");
		 
		 if (!$conn) die (mysql_error());
		  mysql_select_db($mysql_dbname , $conn);
		  
		  return $conn;
	}

    $longtitude= str_replace(" ","",$_POST["longtitude"]);
    $lantitude= str_replace(" ","",$_POST["lantitude"]);
	$userid=str_replace(" ","",$_POST["userid"]);
    $conn=mysql_open();
    //$code=md5($_POST['password'].ALL_PS);
    $sql="insert into location (`id`,`user`,`longtitude`,`latitude`, `time`) values(null, $userid, $longtitude,$lantitude, NOW())";
    $query=mysql_query($sql);
    mysql_close($conn);
	
	//echo $sql;


if($query){
	
echo "ok";

}


?>
