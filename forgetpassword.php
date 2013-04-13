<?php
ob_start();
session_start();
include("inc/config.php");
require("emailforforgetpassword.php");
 if($_SESSION['interbringeruserType']>0){
   header("Location: myaccount.php");
   die();
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo FORGET_PASSWORD_HEAD; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/22o3gybn.css">
</head>
<?php
require("inc/function.php");
include("threelink.php");


  if($_POST["post_question_anser_enter"]=="ok"){ 
     
	 $user_id=$_POST["user_id"];
	 $correct_answer=$_POST["c_an_q_r"];
	 $answer=$_POST["answer"];
	 
	 if( $correct_answer==$answer){
	    $usrinfoSQL = mysql_query("SELECT * FROM `user` WHERE `id` = ".$user_id." AND `status` = 1 ", $db);
		$userinfo = mysql_fetch_array($usrinfoSQL);
		 $username=$userinfo["username"];
		 $realname=$userinfo["realname"];
		 $password=$userinfo["password"];
		 $email=$userinfo["email"];
		
	     if(passwordretrievesendemail($email, $username, $password, $realname, $user_id)){
	 
	      $_SESSION['msgtype']=1;
		  $_SESSION['msg']="An email already send to your email, please check it in your email!";
		  header("Location: login.php");
		  ob_end_flush();
		  die();
		  }else{
		  
		  $_SESSION['msgtype']=0;
		  $_SESSION['msg']="Sorry! Send email failed!";
		  header("Location: login.php");
		  ob_end_flush();
		  die();
		  }
	 
	 } else{
	 
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']="Sorry! The Answer is not correct, we cannot retriewe your password for you!";
		  header("Location: forgetpassword.php");
		  ob_end_flush();
		  die();
	 
	 }  
      die();
  
  }else if($_POST["post_email_enter"]=="ok"){ 
  	
	$email=$_POST["email"];
	$verifycode=$_POST["verifycode"];
	  if(!ereg("^([a-z][_0-9a-z.-]{2,})@([0-9a-z][0-9a-z_]+\.)+[a-z]{2,3}$",$email)){
		 
		  $_SESSION['msgtype']=0;
		  $_SESSION['msg']=EMAIL_FORMAT_INCORRECT;
		  header("Location: forgetpassword.php");
		  ob_end_flush();
		  die();
	 }
	 
	  if($verifycode!=$_SESSION["interbringercheckcode"]){
          $_SESSION['msgtype']=0;
		  $_SESSION['msg']=SECURITY_CODE_ERROR;
		  header("Location: forgetpassword.php");
		  ob_end_flush();
		  die();
      }
	
	$usrchkSQL = mysql_query("SELECT * FROM `user` WHERE `email` = '".$email."' AND `status` = 1 ", $db);
     if (mysql_num_rows($usrchkSQL) == 1)
	{
		 $accinfo = mysql_fetch_array($usrchkSQL);
		 
		 $user=$accinfo["id"];
		 
		 
		 $qestionfindSQL = mysql_query("SELECT * FROM `securityquestion` WHERE `user` = ".$accinfo["id"]."", $db);
		 $qestioninfo=mysql_fetch_array($qestionfindSQL);
		 
		 $qestion = $qestioninfo["question"];
		 $correct_answer=$qestioninfo["answer"];
		 
    }else{
	
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']="Cannot find user related to this email!";
		  header("Location: forgetpassword.php");
		  ob_end_flush();
		  die();
		
	}
	
    
?>
<body>

	<?php 
	   include_once("header/header-search.php");
	 ?>
	
<div class="fb_content clearfix" id="content" >
     <div class="UIFullPage_Container" style="width:700px;">
           
		  <!--This is for information div-->
		   <div class="UIContentTopper clearfix" id="UIContentTopper" style=" margin-top:10px;">
            <div class="UIContentTopper_text_container">
              <div class="UIContentTopper_text_headline"><?php echo FORGET_PASSWORD_HEAD; ?></div>
              <!--<div class="UIContentTopper_text">为了找回您的密码，请回答您的安全问题</b></div>-->
			  <div class="UIContentTopper_text"><?php echo PLEASE_ANSWER_SECURITY_QU_TO_RETRIEVE_PASSWORD; ?></b></div>
            </div>
          </div>
		  <!--End of information div-->
		  <!--This is for the signup div-->
		  <?php if ($_SESSION['msg'] !=""){?>
	       <div id="<?php echo msg_type($_SESSION); ?>" style="height:30px;" >
		      <div style="padding-top:5px;">
			  <?php echo print_msg($_SESSION); ?>
			  </div>
			</div>
          <?php }?>
		  
		  <div class="UIWindowShade">
            <div id="simple_registration_container" class="simple_registration_container">
              <div id="reg_box">
                <form action="forgetpassword.php" method="post" name="reg" id="reg" enctype="multipart/form-data">
                 <noscript>
                  <div id="no_js_box">
                    <h2>你的浏览器关闭了 JavaScript。</h2>
                    <p>要注册Facebook，请在你的浏览器中启用JavaScript，或升级为支持JavaScript的浏览器。</p>
                  </div>
                  </noscript>
		  
		            <div id="reg_form_box" class="large_form" style="margin-top:20px;">
                    <table class="editor" border="0" cellspacing="0">
                      <tbody >						
						<tr><td></td><td><div id="username_info_check"></div></td></tr>
                        <tr>
                          <td class="label"><?php echo YOUR_SECURITY_QUESTION; ?></td>
                          <td><div class="field_container">
                              <input type="text" id="question_input" class="inputtext"  disabled="disabled" value="<?php echo get_qustion_info($qestion, $db); ?>" name="question_input" />
                              <span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						
						<tr>
                          <td class="label"><?php echo YOUR_ANSWER; ?></td>
                          <td><div class="field_container">
                              <input type="text" id="answer" class="inputtext"  value="" name="answer" />
                              <span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
                      </tbody>
                    </table>
					<input type="hidden" value="<?php echo $user; ?>" name="user_id"  />
					<input  type="hidden" value="<?php echo $correct_answer; ?>" name="c_an_q_r" />
					<input type="hidden" value="ok" name="post_question_anser_enter" style="width:100px;" />
					<!-- sign up button -->
					<div class="reg_btn clearfix">
                      <label class="uiButton uiButtonSpecial uiButtonMedium"> 
			              <input type="submit" onclick="" value="<?php echo SUBMIT; ?>" />
                      </label>
                     </div>
					 </div>
					 </form>
					 <!-- sign up button end-->  
					    
					</div>
                 </div>
				</div>
			 
               
			   <!--end of the signup div-->
       <?php
        //   include_once("header/languagebar.php");
        ?>
    
	   </div>
	  </div>
	 </div>
             <?php
              include_once("header/footer.php");
              ?>
	
</body>
</html>
   

<?php }else { ?>
<body>

	<?php 
	   include_once("header/header-search.php");
	 ?>
	
	
	<div class="fb_content clearfix" id="content" >
     <div class="UIFullPage_Container" style="width:700px;">
           
		  <!--This is for information div-->
		   <div class="UIContentTopper clearfix" id="UIContentTopper" style=" margin-top:10px;">
            <div class="UIContentTopper_text_container">
              <div class="UIContentTopper_text_headline"><?php echo FORGET_PASSWORD_HEAD; ?></div>
              <div class="UIContentTopper_text"><?php echo TO_RETRIEVE_YOUR_PASSWORD_PLEASE_PROVIDE_YOUR_EMAIL_AND_USERNAME; ?></b></div>
            </div>
          </div>
		  <!--End of information div-->
		  <!--This is for the signup div-->
		  <?php if ($_SESSION['msg'] !=""){?>
	       <div id="<?php echo msg_type($_SESSION); ?>" style="height:30px;" >
		      <div style="padding-top:5px;">
			  <?php echo print_msg($_SESSION); ?>
			  </div>
			</div>
          <?php }?>
		  
		  <div class="UIWindowShade">
            <div id="simple_registration_container" class="simple_registration_container">
              <div id="reg_box">
                <form action="forgetpassword.php" method="post" name="reg" id="reg" enctype="multipart/form-data">
                 <noscript>
                  <div id="no_js_box">
                    <h2>你的浏览器关闭了 JavaScript。</h2>
                    <p>要注册Facebook，请在你的浏览器中启用JavaScript，或升级为支持JavaScript的浏览器。</p>
                  </div>
                  </noscript>
		  
		            <div id="reg_form_box" class="large_form" style="margin-top:20px;">
                    <table class="editor" border="0" cellspacing="0">
                      <tbody >						
						<tr><td></td><td><div id="username_info_check"></div></td></tr>
                        <tr>
                          <td class="label"><?php echo YOUR_SIGN_UP; ?> <span class="nowrapEmail"><?php echo EMAIL; ?></span></td>
                          <td><div class="field_container">
                              <input type="text" id="email" class="inputtext" onblur="javascript:checkform('email');" value="<?php echo $_SESSION["registration_page_email"]; ?>" name="email" />
                              <span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						
						<tr><td></td><td><div id="email_check"></div></td></tr>
						<tr>
                          <td class="label" nowrap="nowrap"><?php echo SECURITY_CODE; ?></td>
                           <td><input type="text" id="verifycode" style="width:160px" maxLength=20 size=25 name="verifycode" >
			             <!--  <a href="forgetpassword.php"><img border="0" src="testcode.php">&nbsp;验证码看不清楚?请点击刷新验证码.</a>-->
						 <a href="forgetpassword.php"><img border="0" src="testcode.php">&nbsp;<?php echo CANNOT_SEE_CODE_PLEASE_CLICK_TO_CHANGE_ANOTHER; ?></a>
						   </td>
						  </tr>
                      </tbody>
                    </table>
					<input type="hidden" value="ok" name="post_email_enter" style="width:100px;" />
					<!-- sign up button -->
					<div class="reg_btn clearfix">
                      <label class="uiButton uiButtonSpecial uiButtonMedium"> 
			              <input type="submit" onclick="" value="<?php echo SUBMIT; ?>" />
                      </label>
                     </div>
					 </div>
					 </form>
					 <!-- sign up button end-->  
					    
					</div>
                 </div>
				</div>
			 
               
			   <!--end of the signup div-->
       <?php
           //include_once("header/languagebar.php");
        ?>
    
	   </div>
	  </div>
	 </div>
             <?php
              include_once("header/footer.php");
              ?>
	
</body>
</html>

<?php } ?>