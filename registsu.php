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
<title><?php echo REGISTER; ?> Interbringer|Interbringer</title>
<?php echo REGISTER; ?> Interbringer
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
</head>
<?php 
 $postid=$_GET["pid"];
 $op=$_GET["op"];
 $type=$_GET["t"];
?>
<body>
	<?php
	 include_once("header/header-search.php");	 
    ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container" style="width:620px;">
	<div style="text-align:center;">
	<div  style="height:320px;text-align:center;"> 
	   
	   <div  style="width:610px; margin-top:30px; height:180px; background: url(<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/information.png) no-repeat;">
	     <div style="width:590px; height:160px; padding-top:10px;">
		 <table cellpadding="0" cellspacing="0" border="0" width="100%">
		 <tr>
		 <td style="font-size:18px; width:90%; font-weight:normal; font-family:'Times New Roman', Times, serif; color:#000000;">
          <?php echo print_msg($_SESSION)?>
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
	
</body>
</html>