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
<title><?php echo CHANGEPASSWORD;?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<link rel="stylesheet" type="text/css" href="index.css" />
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
  
  
  if($_POST["change_pw_submit"]!=""){
	 $new_password=$_POST["new_password"];
	 $confirm_password=$_POST["confirm_password"];
	 
	 if($new_password==""){
	 
	 $_SESSION['msgtype']=0;
     $_SESSION['msg'] = HINT_FOR_PASSWORD_EMPTY;
	   header("Location: changepassword.php");	
		ob_end_flush();
	    die();
	 
	 }else if($new_password!=$confirm_password){
	    $_SESSION['msgtype']=0;
        $_SESSION['msg'] = HINT_FOR_PASSWORD_NO_MATCH; 
	  
	    header("Location: changepassword.php");	
		ob_end_flush();
	    die();
	 } else {
	 
	    $sql = "UPDATE `user` SET `password`='".$new_password."' WHERE `id` = ".$user_id."";
	    $q = mysql_query($sql, $db);
	    if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (update user email information). ERROR AVL001");
	  
	    $_SESSION['msgtype']=1;
        $_SESSION['msg'] = HINT_FOR_CHANGEPASSWORD_SU; 
	  
	    header("Location: changepassword.php");	
		ob_end_flush();
	    die();
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
	      <table cellpadding="3" cellspacing="0" border="0" width="40%">
     <?php if ($_SESSION['msg'] !=""){?>
     <tr>
       <td>
	   <div id="<?php echo msg_type($_SESSION); ?>" ><?php echo print_msg($_SESSION); ?></div>
       </td>
     </tr>
     <?php }?>
   <tr>
	  <td>
	  <?php echo CHANGEPASSWORD_HEADER_INFORMATION; ?>
	  </td>
	  </tr>
  <tr><td>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
	  <tr>
        <td><fieldset>
          <legend><?php echo CHANGEPASSWORD; ?></legend>
		   <form id="change_ps_form" name="change_ps_form" method="post" action="changepassword.php" enctype="multipart/form-data">
          <table cellpadding="4" cellspacing="0" border="0" width="70%">
            <tr>
             
              <td nowrap="nowrap" align="right"><?php echo NEWPASSWORD; ?>:
              </td> 
			  <td align="right" nowrap="nowrap"> 
			  <input type="password" value="" id="new_password" name="new_password" style="width:200px;" />
			  </td>
            </tr>
			
			<tr>
             
              <td nowrap="nowrap" align="right"><?php echo RETYPEPASSWORD; ?>:
              </td> 
			  <td align="right" nowrap="nowrap"> 
			  <input type="password" value="" id="confirm_password" name="confirm_password" style="width:200px;" />
			  </td>
            </tr>
			
			<tr>
             
              <td></td> 
			  <td align="right" nowrap="nowrap"> 
			  <input type="submit" value="<?php echo CHANGEPASSWORD ?>" id="change_pw_submit" name="change_pw_submit" style="width:210px;" />
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