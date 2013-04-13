<?php
ob_start();
require("inc/session.php");
sessionCheck(session_id(), $_SESSION, $_SERVER);
checkLogin();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo CHANGE_EMAIL_ADDRESS; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<link rel="stylesheet" type="text/css" href="index.css" />
<script  src="./js/changeemail.js"></script>
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
</head>
<body>
<div id="main_container" style="width:100%;" >
<?php
include("threelink.php");
include("inc/function.php");
  $user_id=$_SESSION['interbringeruserId'];
  if($_POST["change_email_submit"]!=""){
     
	 $new_email=$_POST["new_email"];
	 $confirm_email=$_POST["confirm_email"];
	 
	 
	 if($new_email==""){
	 
	 $_SESSION['msgtype']=0;
     $_SESSION['msg'] = HINT_FOR_EMAIL_EMPTY;
	  header("Location: changeemail.php");	
	  ob_end_flush();
	  die();
	 
	 }else if($new_email!=$confirm_email){
	 
	    $_SESSION['msgtype']=0;
        $_SESSION['msg'] = CHANGE_EMAIL_NO_MATCH_CONFIRM;
	  
	    header("Location: changeemail.php");	
		ob_end_flush();
	    die();	
	 }
	 else{
	    $sql = "UPDATE `user` SET `email`='".$new_email."' WHERE `id` = ".$user_id."";
	    $q = mysql_query($sql, $db);
	    if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (update user email information). ERROR AVL001");
	  
	    $_SESSION['msgtype']=1;
        $_SESSION['msg'] = CHANGE_EMAIL_SU;
	  
	    header("Location: changeemail.php");	
		ob_end_flush();
	    die();
	  }
   }
  else{
   $usersql="SELECT `email` FROM `user` WHERE `id`=".$user_id."";
   $userquery= mysql_query($usersql, $db);
   while($row=mysql_fetch_array($userquery))
   {
	 $email=$row["email"];
   }
  }
?>
   <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
    ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container">
	<div style="margin-left:40px;">
	
	  <div style="color:#000000; font-size:16px; width:850px; margin-top:30px; font-weight:bold; margin-left:40px;">
	       <table cellpadding="3" cellspacing="0" border="0" width="60%">
   <?php if ($_SESSION['msg'] !=""){?>
   <tr>
    <td>
	   <div id="<?php echo msg_type($_SESSION); ?>" ><?php echo print_msg($_SESSION); ?></div>
   </td>
  </tr>
  <?php }?>
   <tr>
	  <td>
	 <?php echo CHANGEEMAIL_HEADER_HINT; ?>
	  </td>
	  </tr>
  <tr><td>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
     
	  <tr>
        <td><fieldset>
          <legend><?php echo CHANGE_EMAIL_ADDRESS; ?></legend>
		   <form id="change_email_form" name="change_email_form" method="post" action="changeemail.php" enctype="multipart/form-data">
          <table cellpadding="4" cellspacing="0" border="0" width="90%">
		  
		  <tr>
             
              <td nowrap="nowrap" align="right" style="font-weight:bold;"><?php echo CURRENT_EMAIL_ADDRESS; ?>
              </td> 
			  <td align="left" nowrap="nowrap"> 
			   <?php echo $email; ?>
			  </td>
            </tr>
			<tr><td></td><td><div id="email_check"></div></td></tr>
            <tr>
             
              <td nowrap="nowrap" align="right" style="font-weight:bold;"><?php echo NEW_EMAIL_ADDRESS; ?>
              </td> 
			  <td align="left" nowrap="nowrap"> 
			  <input type="text" value="" id="new_email" onblur="javascript:checkform('new_email');" name="new_email" style="width:200px;" />
			  </td>
            </tr>
			<tr><td></td><td><div id="new_email_check"></div></td></tr>
			<tr>
             
              <td nowrap="nowrap" align="right" style="font-weight:bold;"><?php echo RETYPE_NEW_EMAIL_ADDRESS; ?>
              </td> 
			  <td align="left" nowrap="nowrap"> 
			  <input type="text" value="" id="confirm_email" name="confirm_email" onblur="javascript:checkform('confirm_email');" style="width:200px;" />
			  </td>
            </tr>
			<tr><td></td><td><div id="confirm_email_check"></div></td></tr>
			<tr>
             
              <td></td> 
			  <td align="left" nowrap="nowrap"> 
			  <input type="submit" value="<?php echo SUBMIT_NEW_EMAIL_ADDRESS; ?>" onclick="return formcheck('changeemail');" id="change_email_submit" name="change_email_submit" style="width:210px;" />
			  </td>
            </tr>
			
			<tr><td colspan="2" nowrap="nowrap">
			<?php echo QUESTIONEMAIL; ?><a href="#" style="color:#0033CC;"><?php echo ADMINEMAILADDRESS; ?></a>.
			</td></tr>
          </table>
		  </form>
          </fieldset></td>
      </tr>
    </table>
	
	</td></tr>
	</table>
	  </div>
	 </div>
	 </div>
	</div>
	 
	   <div style="height:20px;"></div>
	  

	
 <?php
      include_once("header/footer.php");
  ?>
  </div>
<?php if($_SESSION["interbringeruserId"]>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>