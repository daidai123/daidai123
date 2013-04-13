<?php

// Starting PHP session
session_start();

// This function receives session id and $_SERVER global, predefined variable that checks the following items:
// Does session id exist in db
// Does session id correspond to user's ip
// Did session expire
// 
// Every time this function is run, last action is updated with current time.
//
// User's permission is checked against every page
//
// If session expired, userType and userID are set to 0, this indicates that session does not exist or expired. 
// This function uses built in PHP session to store variables.
function sessionCheck($sid, &$_SESSION, $_SERVER)
{
	// Includes
	require("dbconnect.php");
	require_once("sfunction.php");

	// Variables
	$timenow = timenow();				  // Current time
	$slife = settings('session_life');	  // Session life
	$newtime = $timenow + $slife;		  // New updated session time
	$stime = $timenow - $slife;			  // Latest last action time permitted
	

	// Cleaning session id (SQL INJECTION)
	$sid = trim($sid);
	$sid = mysql_real_escape_string($sid);
	$sid = substr($sid, 0, 32);

	// Checking if provided session exists in db
	$query = mysql_query("SELECT * FROM `session` WHERE `id` = '$sid'", $db);
	@$sessionExist = mysql_num_rows($query);
	
	// Session id provided exist in db
	if ($sessionExist > 0)
	{
		// Fetching all session info
		$sinfo = mysql_fetch_array($query);

		// Checking if user ip matches session ip and session did not expire
		if ($sinfo['ip'] == $_SERVER['REMOTE_ADDR'] && $sinfo['lastAction'] > $stime)
		{
			$_SESSION['interbringeruserId'] = $sinfo['userID'];
			$_SESSION['interbringeruserType'] = $sinfo['userType'];
			$_SESSION['lastAction'] = $sinfo['lastAction'];
			mysql_query("UPDATE `session` SET `lastAction` = '$newtime' WHERE `id` = '$sid'", $db); // Updating last action time
		} 
		// User ip did not match or session expired
		else
		{
			$_SESSION['interbringeruserType'] = 0;
			// Updating session record
			mysql_query("UPDATE `session` SET `lastAction` = '$newtime', `userID` = 0, `userType` = 0, `ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE `id` = '$sid'", $db); 
		   
		}
	}

	// Session id provided does not exist in db
	else
	{
		// Setting session type to 0
		$_SESSION['interbringeruserType'] = 0;

		// Adding new session id to db
		$nsQuery = mysql_query("INSERT INTO `session` ( `id` , `ip` , `userID` , `userType` , `lastAction` ) VALUES ( '$sid', '".$_SERVER['REMOTE_ADDR']."', '0', '0', '$timenow')", $db);
		
	}
	   
	
}

function checkLogin(){
    if($_SESSION['interbringeruserType']<1){
/*	if($_SESSION['lastAction']>0){
	
	    $_SESSION['msg'] = "Your session has expired. Please re-login.";
		header("Location: login.php");
		die();
	
	  }else{*/
	  
	     $_SESSION['msg'] = "ÇëÏÈµÇÂ¼ÄãµÄÕË»§£¡";
		 header("Location: login.php");
		 die();
	  
/*	  }*/
     }else{
	 
	 $_SESSION['FCKeditor:UserFilesPath']="/interbringer/User_Files_Folder/".$_SESSION['interbringeruserId']."/";
	 
	 }
}




// Running function above
//sessionCheck(session_id(), $_SESSION, $_SERVER);
?>