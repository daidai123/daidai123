<?php
 ob_start(); 
 include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo LOGIN; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<script src="js/login.js" type="text/javascript"></script>
</head>
<?php 
//ob_start();
require("inc/session.php");
require("inc/function.php");
require("inc/sfunction.php");


 if ($_SESSION['interbringeruserType'] > 0)
	header("Location: myaccount.php");

// Variable with all system settings
  $settings = settings();

// Current time
  $timenow = timenow($settings['time_offset']);

// FORM IS SUBMITTED 
if (($_POST['username'] && $_POST['password'])||($_GET['a']=="tmp"))
{
	$_POST['username'] = substr($_POST['username'], 0, 25);
	$usrchkSQL = mysql_query("SELECT * FROM `user` WHERE `username` = '".mysql_real_escape_string($_POST['username'])."' AND `password` = '".$_POST['password']."' AND `status` = 1 ", $db);

    //  echo "I am in here";
	// Login is ok
	

	if (mysql_num_rows($usrchkSQL) == 1)
	{
	
		 $accinfo = mysql_fetch_array($usrchkSQL);
         sessionCheck(session_id(), $_SESSION, $_SERVER);
	
	     $sql="UPDATE `session` SET `userType` = ".$accinfo['role']." , `userID` = ".$accinfo['id'].", `lastAction` = '$timenow' WHERE `id` = '".session_id()."'";
		 mysql_query($sql, $db);
		  
	    // ob_start();
		 $_SESSION['interbringeruserType'] = $accinfo['role'];
		 $_SESSION['interbringeruserId'] = $accinfo['id'];
		 $_SESSION['interbringerusername'] = get_user_name($accinfo['id'], $db);
		 header("Location: myaccount.php");
		 die();
	}

	else
	{
		$_SESSION['msgtype']=0;
        $_SESSION['msg'] = PASSANDUSERBADCOMBIN; // invalid user name/pass

	}
}
?>
<body>

	<?php 
	   include_once("header/header-login.php");
	 ?>
	
	
	<div class="fb_content clearfix" id="content">
     <div class="UIFullPage_Container" style=" width:700px;">
	 
	 <div style="">
	 		<?php if ($_SESSION['msg'] !=""){?>
	        <div id="<?php echo msg_type($_SESSION); ?>" style="height:30px;">
			
			  <div style="padding-top:5px;"><?php echo print_msg($_SESSION); ?></div>
			
			</div>
			 <?php }?>
	  <div style="height:335px;">
      <div style="width:430px; height:290px; margin-top:30px; float:left; border:#DADEE9 solid 1px;" >
       <div style="margin:4px 4px 4px 4px; background:#EDEFF4; border:#EDEFF4 solid 1px; height:280px;"> 
		<div style="height:50px;">
          
	
		  <div class="clearfix uiHeaderTop">
          
		  </div>
        
		</div>
        <div class="phl ptm uiInterstitialContent" style="padding:0 0 0 0; margin-bottom:0px;">

		  <div class=login_form_container style="margin-top:0px; margin-left:25px; margin-bottom:0px;">
            <form id="login_form" name="login_form" method="post" action="login.php" >
	
              <input type=hidden value="" name=charset_test>
              <div id=loginform>
                <div class="form_row clearfix ">
				 <table cellpadding="0" cellspacing="0">
				 <tr>
				 <td style="text-align:right;">
                  <LABEL class=login_form_label id=label_username for=username><?php echo USERNAME; ?>:&nbsp;&nbsp;</LABEL>
				   </td>
				  <td>
                  <input  type="text" class="inputtext" onBlur="" value="<?php echo $_COOKIE['login_usr_name']; ?>" id="username" name="username" style="width:200px" />
				  </td>
				  </tr>
				  <tr>
				  <td>
				  </td>
				  <td>
				  <div id="username_check"></div>
				  </td>
				  </table>
                </div>
				
				
				
                <div class="form_row clearfix ">
				 <table cellpadding="0" cellspacing="0">
				 <tr>
				 <td style="text-align:right;">
                  <LABEL class=login_form_label id=label_pass for=pass><?php echo PASSWORD; ?>:&nbsp;&nbsp;</LABEL>
				  </td>
				  <td>
				  <input   class="inputpassword" type="password" onBlur="" id="password" name="password" style="width:200px" />
				  </td>
				  </tr>
				  <tr>
				  <td>
				  </td>
				  <td>
				  <div id="password_check"></div>
				  </td>
				  </table>
                </div>
				
				
				
				
                <LABEL class=persistent>
                <input class="inputcheckbox " id=persistent_inputcheckbox  checked="checked" type=checkbox value=1 name=persistent>
                <span id=persistent_login_text><?php echo KEEP_ME_LOGIN; ?></span></LABEL>
                <div id=set_as_homepage_persistent>
                  <LABEL class=persistent>
                  <input class="inputcheckbox " id=set_as_homepage_inputcheckbox onclick=HomepageChanger.addLoginFormSubmitHook(this) type=checkbox value=1 name=set_as_homepage_check_box>
                  <span id=set_as_homepage_text><?php echo SET_INTERBRINGER_AS_MAIN_PAGE; ?>？</span></LABEL>
                </div>
                <div class="form_row clearfix" id=buttons>
                  <LABEL class=login_form_label></LABEL>
                  <LABEL class="uiButton uiButtonConfirm uiButtonLarge">
			  <input type="hidden" id="submit" value="Submit" name="submit" />
			   <input onclick="return formcheck('login');" style="width:170px;" type="submit" value=<?php echo SUBMIT; ?> name=login>
                  </LABEL>
                  </div>
                <P class="reset_password form_row" style="margin-left:-30px;"><a href="forgetpassword.php" style="color:#FF0000; padding-right:10px;"><?php echo FORGETPASSWORDQU; ?></a>
				
				
				<STRONG><a href="register.php" style="color:#0000FF;"><?php echo NEWUSERQU; ?></a></STRONG>
				</P>
              </div>
			  
            </form>
          </div>
         </div>

        </div>	
      </div>
	  
	  
	  <div style="border:#EEEEEE solid 5px; height:286px; width:200px; border:#DADEE9 solid 1px; float:right; margin-top:30px;">
	      <div style="border:#EDEFF4 solid 1px; height:275px; background:#EDEFF4; margin:4px 4px 4px 4px;">
		    <div style="text-align:center; margin-top:30px;">
			<span style="color:#000000; font-weight:bold; font-size:15px;"><?php echo INTERBRINGER_NEW_USER_QU; ?></span>
			<div style="text-align:center; margin-top:10px;">
			<span style="color:#000000; font-weight:bold; font-size:14px;"><?php echo CONVIENT_FREE; ?></span>
			</div>
			</div>
		    <div style="text-align: center; margin-top:40px;">
			 <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/button-zhuce.png" onclick="javascript: window.location='register.php'" />
			</div>
			<div style="text-align:center; color:#000000; font-weight:bold; font-size:14px; margin-top:20px;">
			 <?php echo GET_MORE_SERVICE_FROM_INTERBRINGER; ?>
			</div>
		</div>
     </div>
	 
	 </div> 
	  
	  
	   <?php
	   //  include_once("header/languagebar.php");
	   ?>

	  
        </div>
      </div>
	</div>
	
	
	
	
  <?php
   include_once("header/footer.php");
  ?>
	
</body>
</html>