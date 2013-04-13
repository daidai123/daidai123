<?php
  ob_start();
  session_start();
  include("inc/config.php");
  require("inc/session.php");
  require("inc/function.php");
  require("inc/sfunction.php");
  
  $clean['emai'] = $_GET['email']; //need to filter these data to be clean
  $clean['v'] = $_GET['v']; //need to filter these data to be clean
  $clean['id']=$_GET['u'];
  $code = "here we place a secret key  with the email address: ".$clean['emai']."";
  echo $code;
  $code = md5($code);
  echo $code;
  if ($clean['v'] != $code) {
	 echo "The Verification Code is invalid. Please Try Again.";
	 exit(0);
  }else{
  
        $sql = "UPDATE `user` SET `status`=1 WHERE `id` = ".$clean['id']."";
	    $q = mysql_query($sql, $db);
	    if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (active account). ERROR AVL001");
		
		// Variable with all system settings
        $settings = settings();

        // Current time
        $timenow = timenow($settings['time_offset']);
		
		$sql="UPDATE `session` SET `userType` = 3 , `userID` = ".$clean['id'].", `lastAction` = '$timenow' WHERE `id` = '".session_id()."'";
		 mysql_query($sql, $db);
		  
	    // ob_start();
		 $_SESSION['interbringeruserType'] = 3;
		 $_SESSION['interbringeruserId'] = $clean['id'];
		
		$_SESSION['msgtype']=1;
		$_SESSION['msg']=SU_CONGURATULATION." <span style=\"color:red; font-weight:bold;\">".$username."</span>!".SU_REGIST_HINT;
		header("Location: loginsu.php");
		ob_end_flush();
		die();
     }
?>	  