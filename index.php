<?php
error_reporting(0);
ob_start();
require("inc/session.php");
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"  />
<title><?php echo WELCOME_TO_INTERBRINGER; ?>| Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/main_login.css"  />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<SCRIPT language=JavaScript> 
  <!-- 
  function processForm(form){  
  if (document.getElementById("select_page").value=="1") form.action="findbringer.php"; 
  if (document.getElementById("select_page").value=="2") form.action="findneeder.php"; 
  if (document.getElementById("select_page").value=="3") form.action="findbringer-trans.php"; 
  if (document.getElementById("select_page").value=="4") form.action="findneeder-trans.php"; 
  } 
  //--> 
</SCRIPT> 
<style>
.inner{
border:#666666 solid 1px;
}
</style>
</head>
<body>
<div id="main_container" style="width:100%;">
<?php
/*if($_POST["language_select"]!=""){
  $_SESSION["language_be_choosed"]=$_POST["language_select"];
}*/
require("inc/function.php");
?>
  <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header.php");
	 }
    ?>
	
<!-- end #header -->
<div style="min-height:500px; min-width:400px; width:100%; background: url(<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/face.jpg) repeat;">
   <div id="content" class="fb_content clearfix" style=" float:right; min-height:500px;width:70%; margin-right:15%;">
   <form name="header_search_form" method="get"  action="findbringer.php">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
		<td align="center">
		 <table style="width:100%;" border="0">
        <tr>
		  <td style="height:40px;" colspan="3">
		  </td>
		 </tr>
		 <tr>
		   <td style="width:100%;"  colspan="2"align="center" >
	        <div style="font-family:'Times New Roman', Times, serif; font-size:24px; font-weight:bolder; margin-bottom:10px;">
			  <!--<img class="fb_logo img" src="<?php// echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/mainpage-logo.png" alt="interbringer logo" width="170" height="36">--> <span style="font-family:Geneva, Arial, Helvetica, sans-serif; font-weight:bolder; font-size:36px; color:#5B5BFF">Interbringer</span> <?php echo HELP_YOU_TO; ?>
			</div>
			<div style="font-family:'Times New Roman', Times, serif; font-size:24px; font-weight:bolder;">
			  <?php echo BUY_SELL_DELIVER; ?>
			</div>
		 </td>
		 </tr>
		  <tr>
		  <td style="height:20px;" colspan="3">
		  </td>
		 </tr>
		  <tr>
		  <td  style="width:60%; text-align:right; padding-right:10px;" >
		  <div style="border:#7C8EE4; background-color:#7C8EE4; height:60px; padding: 20px 20px 20px 20px;">
		     <table style="width:100%;">
		        <tr>
				  <td style="text-align:center; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold;">
				     <?php echo I_AM_LOOKING_FOR; ?>
				  </td>
				 </tr>
				 <tr>
				   <td style="text-align:center">
				     <input type="text" value="" style=" width:100%;height:30px;"   id="t" name="t"  />
				    </td>
				 </tr>
				 </table>
		  </div>
		  </td>
		   <td  style="width:30%; text-align:right;" >
			 <div style="border:#7C8EE4; background-color:#7C8EE4; height:60px; padding: 20px 20px 20px 20px;">
		     <table style="width:100%;">
		        <tr>
				  <td style="text-align:center; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold;">
				     <?php echo IN_SERVICE_TYPE; ?>
				  </td>
				 </tr>
				 <tr>
				   <td style="text-align:center">
				     <select id="select_page"  style=" width:100%; font-size: 15px; line-height:27px; font-size:20px; "  onchange="processForm(this.form)"   class="select" name="select_page">
			           <option value="1" <?php echo $taker_selected; ?> ><?php echo FIND_TAKER; ?></option>
	                   <option value="2" <?php echo $buyer_selected; ?> ><?php echo FIND_BUYER; ?></option>
	                   <option value="3" <?php echo $carrier_selected; ?> ><?php echo FIND_CARRIER; ?></option>
	                   <option value="4" <?php echo $needer_selected; ?> ><?php echo FIND_NEEDER; ?></option>
			          </select>
				    </td>
				 </tr>
				 </table>
		  </div>
		  </td>
		 </tr>
		   
		    <tr>
		         <td style="width:100%; text-align:center; padding-top: 20px;"  colspan="2" >
	                  <input type="submit" style="width:200px;  height:50px; background-color:#CCCCCC; font-size:16px; font-weight:bold; color:#000000;" value="<?php echo SEARCH; ?>"   />
		           </td>
		    </tr>
		 </table>
		</td>
      </tr>
	  
    </table>
	</form>
	</div>
  <!-- end #content -->
</div>
<!-- end #page -->
<?php
 include_once("header/footer.php");
?>

<!-- end #footer -->
</div>
<?php if($_SESSION["interbringeruserId"]>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>
