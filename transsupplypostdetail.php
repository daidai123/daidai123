<?php
  ob_start();
  session_start();
  include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo SUPPLY_POST_INFO; ?>|Interbringer</title>
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link rel="stylesheet" href="./thinkBox/thickbox.css" type="text/css" media="screen"/>

<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->

<script type="text/javascript" src="./thinkBox/jquery-latest.js"></script>
<script type="text/javascript" src="./thinkBox/thickbox.js"></script>
<script language="javascript">
function checkPostDelete(id)
 {
  if(confirm("Are you sure to DELETE this post? "))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=d&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
 
 function checkRePost(id)
 {
  if(confirm("Are you sure to Re-Post this post? "))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=rp&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
</script>
</head>
<body>
<div id="main_container" style="width:100%;">
<?php 
require("inc/dbconnect.php");
include("inc/function.php");
     
	   $postid=$_GET["pid"];
       if($_SESSION['interbringeruserType']>1){
       $current_user=$_SESSION['interbringeruserId'];
	     $_SESSION['username'] = get_user_name($current_user, $db);
		 update_lastaction($current_user, $db);
	   }
	  
	  if($_GET["op"]!=""){
	  	 $checksql="SELECT * FROM `supplypost` WHERE `id`=".$postid."";
	     $checkquery= mysql_query($checksql, $db);
	      while($row=mysql_fetch_array($checkquery))
	     {
	       $check_user=$row["userid"];
	     }
	  }
	  
	  if(($_GET["op"]=="d")&&($current_user==$check_user))
      {	  
	    $deletesql="DELETE FROM supplypost WHERE id=".$postid;
	    $q = mysql_query($deletesql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Delete Post for ".$delete_table."). ERROR AVL001");	
	    header("Location: postsu.php?t=s&op=d&pid=".$postid."");	
	    die();	   
       }else if(($_GET["op"]=="rp")&&($current_user==$check_user)){
	    $repostsql= "UPDATE `supplypost` SET `postdate`= NOW() WHERE `id` = ".$postid."";
        $q = mysql_query($repostsql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Re-Post Post for ".$repost_table."). ERROR AVL001");	  
	    header("Location: postsu.php?t=s&op=rp&pid=".$postid."");	
	    die();	   
    }
	  
	  
      $sql="SELECT * FROM `supplypost` WHERE `id`=".$postid."";
	  $demandquery= mysql_query($sql, $db);
	  
	  while($row=mysql_fetch_array($demandquery))
	  {
		$title=$row["title"];
        $catergory=$row["catergory"];
		$countryid=$row["countryid"];
		$countryback=$row["countryback"];
		$userid=$row["userid"];
        $stateid=$row["stateid"];
        $cityback=$row["cityback"];
		$stateback=$row["stateback"];
        $cityid=$row["cityid"];
		$pubic=$row["pubic"];
		$backdate=$row["backtime"];
		$replytoemail=$row["replytoemail"];
		$showemailtype=$row["showemailtype"];
		$description=stripslashes($row["description"]);
        $postdate=$row["postdate"];
		$price=$row["price"];
		$postlocation=$row["postlocation"];
	  }
	  
	  if($showemailtype==1){
	    $emailshow=$replytoemail;
	  }else{
	    $emailshow="";
	  }
	  
	  
	 if($pubic=='Y'){
     $contactinf_link="contactinfo.php?pid=".$postid."&ty=s&t=t&keepThis=true&TB_iframe=true&height=450&width=600";
}else if($pubic=='N'){
   $contactinf_link="nocontactinfo.php?t=t&keepThis=true&TB_iframe=true&height=160&width=700";
}else{
   $contactinf_link="#";
}

$time = time(); // this is a Unix time stamp
    $timeframe = '900'; // 900secs = 15mins || this is how long till the user is shown to be offline of in case the user exits out of browser or have logged or has user IDLE's to long but is cookie dose not time out all they have to do is refresh the page and the will be shown online again 
	
	$sql="SELECT `lastvisit` FROM user WHERE id = ".$userid."";
    $lastactionquery = mysql_query($sql, $db); 
	 while($row=mysql_fetch_array($lastactionquery)){
	  $lastaction=$row["lastvisit"];
	 }/**/
    // die();
    if ($lastaction <= $time) {
	$online_offline = "<span style=\"font-size:18; font-weight:bold; color: red;\">".OFFLINE."</span>";// this will show that your user is currently offline
    }elseif ($lastaction > $time){
	$online_offline = "<span style=\"font-size:18; font-weight:bold; color: green;\">".ONLINE."</span>";// this will show that your user is currently online
   } 
?>
   	
	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user-trans.php");
	 }else{
	 include_once("header/header-search-trans.php");
	 }
    ?>
 <div class="fb_content clearfix" id="content" style=" border:#330033 solid 2px;">
   <div class="UIFullPage_Container" style="width:90%; min-width:1200px; border:#00CC33 solid 2px;">
   
   
   <div style=" float:left; width:20%; min-width:240px; margin-top:15px; border:#000066 solid 2px;">
  
  
   </div>
  
  
  </div>
 </div> 	
	
   

</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>