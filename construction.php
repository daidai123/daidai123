<?php
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 include("inc/config.php");
 include("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>建设信息|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
</head>
<?php 
 $postid=$_GET["pid"];
 $op=$_GET["op"];
 $type=$_GET["t"];
 $post_type=$_GET["pt"];
?>
<body>
<div id="main_container" style="width:100%;">
   <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
    ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container" style="width:620px;">
	<div style="text-align:center;">
	<div  style="height:380px;text-align:center;"> 
	   
	   <div  style="width:630px; margin-top:30px; height:340px; background: url(<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/information2.png) no-repeat;">
	     <div style="width:620px; height:160px; margin-left:5px; padding-top:10px;">
		 <table cellpadding="3" cellspacing="3" border="0" width="100%">
		 <tr>
		 <td>
		  <img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/worker.gif"/>
		 </td>
		 <td style="font-size:18px; width:90%; font-weight:normal; font-family:'Times New Roman', Times, serif; color:#000000;">
            <div style="font-size:22px; color:#FF8000; font-weight:bold;"><?php echo SORRY_IN_CONTRUCTION; ?></div>
			<div style="font-size:22px; color:#FF8000; font-weight:bold;"><?php echo PLEASE_UNDERSTAND; ?></div>
		 </td>
		 </tr>
		 </table>
	     </div>
	   </div>
	  
	 </div> 
	  
	  
	
	
	
	<?php
	   include_once("header/languagebar.php");
	 ?>
	  
        </div>
      </div>
	</div>
	
		
	
<?php
  include_once("header/footer.php");
 ?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>	
</body>
</html>