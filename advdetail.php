<?php
  ob_start();
  session_start();
  include("inc/config.php");
  include("inc/unsetsession_supply_buy.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo SUPPLY_POST_INFO; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link rel="stylesheet" href="./thinkBox/thickbox.css" type="text/css" media="screen"/>
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<script type="text/javascript" src="./thinkBox/jquery-latest.js"></script>
<script type="text/javascript" src="./thinkBox/thickbox.js"></script>
<style type="text/css">
img {border:0;}
.gg_width TD {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
</style>
<style type=text/css>
th {
padding:3px 3px 3px 3px;
height:30px;
font-family:"Times New Roman", Times, serif;
font-size:16px;
font-weight:bolder;
color:#000000;
}
td {
	padding:3px 3px 3px 3px;
	font-family:"Times New Roman", Times, serif;
	font-size:14px;
}

td .title{
color:#0000CC;
text-decoration:underline;
font-weight:bold;
font-size:16px;
white-space:nowrap;
}

table.sortable thead {
	FONT-WEIGHT: bold; CURSOR: default; COLOR: #666666; BACKGROUND-COLOR: #eee
}
</style>
</head>

<body>
<div id="main_container" style="width:100%;">
<?php 
require("inc/dbconnect.php");
include("inc/function.php");
     
	   $postid=$_GET["pid"];
	   CHECK_ID_CORRECT_PAGE('discountinfo', 2, $postid, $db);
	   
       if($_SESSION['interbringeruserType']>0){
       $current_user=$_SESSION['interbringeruserId'];
	     $_SESSION['interbringerusername'] = get_user_name($current_user, $db);
		// update_lastaction($current_user, $db);
	   }
	  
	  
      $sql="SELECT * FROM `discountinfo` WHERE `id`= ".$postid."";
	  $demandquery= mysql_query($sql, $db);
	  while($row=mysql_fetch_array($demandquery))
	  {
		$title_detail=$row["title"];		
		$description=stripslashes($row["description"]);
	  }

?>
   	
	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user-buy.php");
	 }else{
	 include_once("header/header-search-buy.php");
	 }
    ?>
 
<div class="fb_content clearfix" id="content">
     <div class="UIFullPage_Container" style="width:90%; min-width:1200px;">
  <div style=" float:left; width:19%;">
  		  <?php include_once("advinfoboard.php"); ?>
  </div>
  <div id="content" class="fb_content clearfix" style=" float:right; min-height:500px;width:80%;">

	<div id="mainContainer" style="width:90%;"  >
       <div style="margin-top:15px; margin-left:20px; padding-bottom:5px; width:100%;">
	     <div style="font-size:20px;font-weight:bolder;"><?php echo $title_detail; ?></div>
		<div style="width:100%; border-bottom:#AAAAAA solid 1px; height:26px;">
		 </div>
	   </div>
	    
	  
	   <div style="width:100%; margin-left:20px;">
		  <?php
            include_once("header/friendhint.php");
          ?>
		 <div style="width:100%; margin-top:20px; font-size:13px;">
		   <?php echo stripslashes($description); ?>	       
		 </div>
	   </div>
    </div>
  </div>
 </div>
 </div>
  
 	<div style="margin-top:50px;">
	</div>

  
 <?php
   include_once("header/long_footer.php");
  ?>

</div>
<?php if($_SESSION['interbringeruserId']>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>