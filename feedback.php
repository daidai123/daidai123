<?php
ob_start();
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo SUGGESTION_CUSTOMER; ?>|Interbringer(代代网)</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<!--<link type="text/css" rel="stylesheet" href="csshead/login2.css">-->
<link type="text/css" rel="stylesheet" href="csshead/22o3gybn.css">
<script language="javascript" type="text/javascript" src="js/register.js"></script>
</head>
<?php
require("inc/function.php");
  session_start(); 
  
  if($_POST["submit"]=="Submit"){ 
  
  
     header( "Content-Type: text/html; charset=gb2312" );

	 $susername=mysql_real_escape_string($_POST["susername"]);
	 $semail=$_POST["semail"];
	 $scontent=$_POST["scontent"];
	 $verifycode=$_POST["verifycode"];
	 
	 
	 $_SESSION["suggestion_semail"]=$semail;
	 $_SESSION["suggestion_susername"]=$susername;
     $_SESSION["suggestion_scontent"]=$scontent;	
	  
	  if($scontent!=""){
	    $_SESSION["check_empty"]="";
	  
	  }
	 
   if(!ereg("^([a-z][_0-9a-z.-]{2,})@([0-9a-z][0-9a-z_]+\.)+[a-z]{2,3}$",$semail)){
		 
		  $_SESSION['msgtype']=0;
		  $_SESSION['msg']=EMAIL_FORMAT_INCORRECT;
		  header("Location: feedback.php");
		  ob_end_flush();
		  die();
	 }
	 
	 if($scontent==""){
		 
		  $_SESSION['msgtype']=0;
		  $_SESSION['msg']=SUGGESTION_NO_COMPLETE;
		  $_SESSION["check_empty"]="style=\"border:#FF0000 2px solid;\"";
		  header("Location: feedback.php");
		  ob_end_flush();
		  die();
	 }
	 
	 

   if($verifycode!=$_SESSION["interbringercheckcode"]){
          $_SESSION['msgtype']=0;
		  $_SESSION['msg']=SECURITY_CODE_ERROR;
		  header("Location: feedback.php");
		  ob_end_flush();
		  die();
   }
         
		$ip=$_SERVER['REMOTE_ADDR'];

	    $sql = "INSERT INTO `feedback` (`id`,`username`,`email`,`content`,`ip`,`createtime`)  VALUES ";
        $sql .= "(null,'$susername','$semail','$scontent', '$ip', NOW())";
		
		//echo $sql;
	    $q = mysql_query($sql, $db);
		
	    $fID = (int)mysql_insert_id($db); 
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new feedback). ERROR AVL001");
		  
		  unset($_SESSION["suggestion_semail"]);
		  unset($_SESSION["suggestion_susername"]);
		  unset($_SESSION["suggestion_scontent"]);
		  unset($_SESSION["check_empty"]);

          $_SESSION['msgtype']=1;
		  $_SESSION['msg']=SUBMIT_SUCCESSFUL_FEEDBACK;
		  header("Location: feedback.php");
		  ob_end_flush();
		  die();
  
  }else{ 
?>
<body>

	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
    ?>
	
	
	<div class="fb_content clearfix" id="content" >
     <div class="UIFullPage_Container" style="width:700px;">
           
		  <!--This is for information div-->
		   <div class="UIContentTopper clearfix" id="UIContentTopper" style=" margin-top:10px;">
            <div class="UIContentTopper_text_container">
              <div class="UIContentTopper_text_headline"><?php echo SUGGESTION_CUSTOMER; ?></div>
              <div class="UIContentTopper_text" style="color:#FF0000;"><?php echo WELCOME_YOUR_FEEDBACK_YOUR_SUPPORT_IS_OUR_MOTIVATION; ?></div>
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
            <div id="simple_registration_container" class="simple_registration_container" style="width:80%;">
              <div id="reg_box" >
                <form action="feedback.php" method="post" name="reg" id="reg" enctype="multipart/form-data">
		            <div id="reg_form_box" class="large_form" style="margin-top:20px;">
                    <table class="editor" border="0" cellspacing="0">
                      <tbody >
                        <tr>
                          <td class="label"><?php echo YOUR_SIGN_UP; ?><span class="nowrapEmail"><?php echo EMAIL; ?></span></td>
                          <td><div class="field_container">
                              <input type="text" id="semail" class="inputtext" value="<?php echo $_SESSION["suggestion_semail"];?>"  name="semail" />
                              <span style="color:#FF0000;"><?php echo WE_WILL_CONTACT_YOU_BY_EMAIL; ?></span>
                            </div></td>
                        </tr>
                        <tr>
                          <td class="label"><?php echo YOUR_REAL_NAME; ?>：</td>
                          <td nowrap="nowrap"><div class="field_container">
                              <input type="text" id="susername" name="susername" value="<?php echo $_SESSION["suggestion_susername"];?>" class="inputtext" />
                            <?php echo OPTION_FEEDBACK; ?></div></td>
                        </tr>
						 <tr>
                          <td class="label" nowrap="nowrap"><?php echo YOUR_SUGGESTION; ?>：</td>
                          <td nowrap="nowrap">
                              <textarea  id="scontent" name="scontent"  <?php echo $_SESSION["check_empty"]; ?>  style="width:85%;" rows="10" ><?php echo $_SESSION["suggestion_scontent"];?></textarea>
                              <span style="color:#FF0000;">*</span>
                            </td>
                        </tr>
						<tr>
                          <td class="label" nowrap="nowrap"><?php echo SECURITY_CODE; ?>：</td>
                           <td><input type="text" id="verifycode" style="width:160px" maxLength=20 size=25 name="verifycode" >
			               <a href="feedback.php"><img border="0" src="testcode.php">&nbsp;<?php echo CANNOT_SEE_CODE_PLEASE_CLICK_TO_CHANGE_ANOTHER; ?></a>
						   </td>
						  </tr>
                      </tbody>
                    </table>
					 <input type="hidden" id="submit" value="Submit" name="submit" style="width:100px;" />
					<div class="reg_btn clearfix">
                      <label class="uiButton uiButtonSpecial uiButtonMedium">
					 
			              <input type="submit" onclick="return formcheck('register');" value="<?php echo SUBMIT; ?>" />
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