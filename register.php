<?php
ob_start();
session_start();
include("inc/config.php");
require("emailcheck.php");
 if($_SESSION['interbringeruserType']>0){
   header("Location: myaccount.php");
   die();
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo REGISTER; ?> Interbringer|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<!--<link type="text/css" rel="stylesheet" href="csshead/login2.css">-->
<link type="text/css" rel="stylesheet" href="csshead/22o3gybn.css">
<script language="javascript" type="text/javascript" src="js/register.js"></script>
</head>
<?php
require("inc/function.php");
include("threelink.php");

  if($_POST["submit"]=="Submit"){ 
  
  
     header( "Content-Type: text/html; charset=gb2312" );
	 
	 $username=mysql_real_escape_string($_POST["username_info"]);
	 $realname=$_POST["realname"];
     $password=$_POST["password_info"];
	 $confirmpassword=$_POST["confrim_pw"];
     $country = $_POST["country"];
	 $state=$_POST["state"];
	 $city = $_POST["city"];
	 $email=$_POST["email"];
	 $phone=$_POST["phone"];
	 $qq=$_POST["qq"];
	 $msn=$_POST["msn"];
	 $question=$_POST["question"];
	 $answer=$_POST["answer"];
	 $verifycode=$_POST["verifycode"];
	 $gender=$_POST["sex"];
	 
	 $_SESSION["registration_page_username"]=$username;
	 $_SESSION["registration_page_realname"]=$realname;
	 $_SESSION["registration_page_country"]=$country;
	 $_SESSION["registration_page_state"]=$state;
	 $_SESSION["registration_page_city"]=$city;
	 $_SESSION["registration_page_email"]=$email;
	 $_SESSION["registration_page_phone"]=$phone;
	 $_SESSION["registration_page_qq"]=$qq;
	 $_SESSION["registration_page_msn"]=$msn;
	 $_SESSION["registration_page_question"]=$question;
	 $_SESSION["registration_page_answer"]=$answer;
	 
 if(($username=="")||($realname=="")||($password=="")||($confirmpassword=="")||($country=="")||($state=="")||($city=="")||($email=="")||(question=="")||($answer=="")||($gender=="")){
	 
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']=INFORMATION_INCOMPLETE_HINT;
		  header("Location: register.php");
		  ob_end_flush();
		  die();
	 }

	 
	 
	   if(check_user_email_exist($email, $db)){
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']=EMAIL_ALREADY_EXIST_HINT;
		  header("Location: register.php");
		  ob_end_flush();
		  die();
	    }else if(check_username_exist($username, $db)){
		 
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']=USERNAME_ALREADY_EXIST_HINT;
		  header("Location: register.php");
		  ob_end_flush();
		  die();
		}else if($password!=$confirmpassword){
		  
		  $_SESSION['msgtype']=0;
		  $_SESSION['msg']=CONFIRM_PASSWORD_NO_MATCH_HINT;
		  header("Location: register.php");
		  ob_end_flush();
		  die();
		}/*else if($verifycode!=$_SESSION["interbringercheckcode"]){
          $_SESSION['msgtype']=0;
		  $_SESSION['msg']="验证码错误，请重新输入验证码。";
		  header("Location: register.php");
		  ob_end_flush();
		  die();
        }  */

	    $sql = "INSERT INTO `user` (`id`,`username`,`realname`,`password`, `country`, `state`, `city`, `email`, `cellphone`, `qq`, `msn`, `gendor`,`role`, `status`, `createtime`)  VALUES ";
        $sql .= "(null,'$username','$realname','$password', $country, $state, $city, '$email', '$phone', '$qq', '$msn', '$gender', 3, 2, NOW())";
		
		//echo $sql;
	    $q = mysql_query($sql, $db);
		
	    $fID = (int)mysql_insert_id($db); 
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new user). ERROR AVL001");
		
		
		$secsql = "INSERT INTO `securityquestion` (`id`,`user`,`question`,`answer`)  VALUES ";
        $secsql .= "(null,'$fID','$question','$answer')";
		
		//echo $sql;
	    $secquery = mysql_query($secsql, $db);
		
	    $nid = (int)mysql_insert_id($db); 
		if ($nid < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new security). ERROR AVL002");
		
		unset($_SESSION["registration_page_username"]);
	    unset($_SESSION["registration_page_realname"]);
	    unset($_SESSION["registration_page_country"]);
	    unset($_SESSION["registration_page_state"]);
	    unset($_SESSION["registration_page_city"]);
	    unset($_SESSION["registration_page_email"]);
	    unset($_SESSION["registration_page_phone"]);
	    unset($_SESSION["registration_page_qq"]);
	    unset($_SESSION["registration_page_msn"]);
	    unset($_SESSION["registration_page_question"]);
	    unset($_SESSION["registration_page_answer"]);
		
		$sql_user="SELECT * FROM `user` WHERE `username` = '".$username."' AND `password` = '".$password."'";
		$usrchkSQL = mysql_query($sql_user, $db);
		
		$newuseracct = mysql_fetch_array($usrchkSQL);
			
		EmailValidation($email, $username, $password, $realname, $newuseracct["id"]);
		
		list($email, $domain) = split("@", $email, 2);


		//if ($fID < 1) die();
		//$_SESSION['msgtype']=1;
		$_SESSION['msg']=REGISTER_SU_CON.", <span style=\"color:red; font-weight:bold;\">".$username."</span>!".REGISTER_SU_HINT." <a href=\"http://www.".$domain."\" style=\"font-weight:bold; color:red;\" >".REGISTER_SU_HERE."</a> ".REGISTER_SU_AFTER;
		  header("Location: registsu.php");
		  ob_end_flush();
		  die();
  
  }else{ 
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
              <div class="UIContentTopper_text_headline"><?php echo REGIST_INTERBRINGER; ?></div>
              <div class="UIContentTopper_text"><?php echo JOIN_INTERBRINGER; ?><b><?php echo COME_TO_POST; ?></b><?php echo AND_WORD; ?><b><?php echo COME_TO_COMMUNICATE; ?></b></div>
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
                <form action="register.php" method="post" name="reg" id="reg" enctype="multipart/form-data">
                 <noscript>
                  <div id="no_js_box">
                    <h2>你的浏览器关闭了 JavaScript。</h2>
                    <p>要注册Facebook，请在你的浏览器中启用JavaScript，或升级为支持JavaScript的浏览器。</p>
                  </div>
                  </noscript>
		  
		            <div id="reg_form_box" class="large_form" style="margin-top:20px;">
                    <table class="editor" border="0" cellspacing="0">
                      <tbody >
                        <tr>
                          <td class="label" ><?php echo USERNAME ?></td>
                          <td><div class="field_container">
                              <input type="text" id="username_info" onblur="javascript:checkform('username_info');" value="<?php echo $_SESSION["registration_page_username"]; ?>" class="inputtext" name="username_info" /><span style="color:#FF0000;">* (<?php echo USER_NAME_HINT_CAN_ONLY_INCLUDE_ENGLISH; ?>)</span>
                            </div></td>
                        </tr>
						
						<tr><td></td><td><div id="username_info_check"></div></td></tr>
						
						
                        <tr>
                          <td class="label"><?php echo REALNAME ?></td>
                          <td><div class="field_container">
                              <input type="text" id="realname" name="realname" value="<?php echo $_SESSION["registration_page_realname"]; ?>" class="inputtext" onblur="javascript:checkform('realname');" /><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						<tr><td></td><td><div id="realname_check"></div></td></tr>
                        <tr>
                          <td class="label"><?php echo YOUR_SIGN_UP; ?><span class="nowrapEmail"><?php echo EMAIL; ?></span></td>
                          <td><div class="field_container">
                              <input type="text" id="email" class="inputtext" onblur="javascript:checkform('email');" value="<?php echo $_SESSION["registration_page_email"]; ?>" name="email" />
                              <span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						
						<tr><td></td><td><div id="email_check"></div></td></tr>
						
                       
                        <tr>
                          <td class="label"><?php echo PASSWORD; ?></td>
                          <td><div class="field_container">
                              <input type="password" class="inputpassword" id="password_info" onblur="javascript:checkform('password_info');" onkeyup="return passwordChanged();" name="password_info"  /><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						
						<tr><td></td><td><div id="password_info_check"></div></td></tr>
						
						 <tr>
                          <td class="label"><?php echo CONFIRMPASS; ?></td>
                          <td><div class="field_container">
                              <input type="password" id="confirm_pw" class="inputpassword" onblur="javascript:checkform('confirm_pw');" name="confrim_pw"  /><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						
                        <tr><td></td><td><div id="confirm_pw_check"></div></td></tr>
						<?php
			             $country_query="SELECT * FROM `country` ORDER BY `id`";
	                     $country_execute_query = mysql_query($country_query, $db); 
                         $numCountry = mysql_num_rows($country_execute_query); 
			            ?>
                        <tr>
                          <td class="label"><?php echo COUNTRY; ?></td>
                          <td id="country_border"><div class="field_container">
                              <select id="country" name="country" class="inputtext" onblur="javascript:checkform('country');" onChange="changepro('state','country');" >
			                 <option value="" style="color:#999999;"><?php echo PLEASESELECTED; ?></option>
			                 <?php if($_SESSION["registration_page_country"]!=""){ ?>
			  
			                 <?php  while ($row = mysql_fetch_array($country_execute_query)) {
			                   if($_SESSION["registration_page_country"]==$row["id"]) $selected="selected=\"selected\"";
				               else $selected="";
			                   ?>
			                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
			                  <?php } ?>
			  
			                <?php }
			              else{
			               ?>
			                  <?php  while ($row = mysql_fetch_array($country_execute_query)) {
			                  if(get_user_country($user_id, $db)==$row["id"]) $selected="selected=\"selected\"";
				              else $selected="";
			                 ?>
			               <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
			              <?php } ?>
			               <?php
			                 }
			                 ?>
			                  </select><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						<tr><td></td><td><div id="country_check"></div></td></tr>
						
						<tr>
                          <td class="label"><?php echo STATE_OR_PROVINCE; ?></td>
                          <td  id="state_border"><div class="field_container">
                          <select id="state" name="state" class="inputtext" onblur="javascript:checkform('state');" onChange="changecity('city','state');">
			              <option value="" style="color:#999999;"><?php echo PLEASESELECTED; ?></option>
						  <?php if($_SESSION["registration_page_state"]!=""){
			               $state_query="SELECT * FROM `states` where `country`= ".$_SESSION["registration_page_country"]." ORDER BY `id`";
	                       $state_execute_query = mysql_query($state_query, $db);
			              ?>
			             <?php  while ($row = mysql_fetch_array($state_execute_query)) {
			               if($_SESSION["registration_page_state"]==$row["id"]) $selected="selected=\"selected\"";
				           else $selected="";
			             ?>
			             <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
			          <?php   } ?>
			          <?php } ?>
			              </select><span style="color:#FF0000;">*</span>
			             </div></td>
                        </tr>
						<tr><td></td><td><div id="state_check"></div></td></tr>
						
						
						<tr>
                          <td class="label"><?php echo CITY; ?></td>
                          <td id="city_border">
						  <div class="field_container">
                    	  <select id="city" name="city" class="inputtext" onblur="javascript:checkform('city');" >
			              <option value="" style="color:#999999;"><?php echo PLEASESELECTED; ?></option>
						  <?php if($_SESSION["registration_page_city"]!=""){
			                $city_query="SELECT * FROM `city` where `state_id`= ".$_SESSION["registration_page_state"]." ORDER BY `id`";
	                        $city_execute_query = mysql_query($city_query, $db); 
			              ?>
			             <?php  while ($row = mysql_fetch_array($city_execute_query)) {
			              if($_SESSION["registration_page_city"]==$row["id"]) $selected="selected=\"selected\"";
				          else $selected="";
			             ?>
			            <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
			            <?php   } ?>
			            <?php  } ?>
			              </select><span style="color:#FF0000;">*</span>
			              </div></td>
                        </tr>
						
						<tr><td></td><td><div id="city_check"></div></td></tr>
						
						
                        <tr>
                          <td class="label"><?php echo TELEPHONE; ?></td>
                          <td><div class="field_container">
                              <input type="text" onb lur="javascript:checkform('phone');" value="<?php echo $_SESSION["registration_page_phone"]; ?>" id="phone" name="phone" class="inputtext" />
                            </div></td>
                        </tr>
						  <tr>
                          <td class="label"><?php echo QQ; ?></td>
                          <td><div class="field_container">
                              <input type="text" id="qq" on blur="javascript:checkform('qq');" value="<?php echo $_SESSION["registration_page_qq"]; ?>" name="qq" class="inputtext" />
                            </div></td>
                        </tr>
						  <tr>
                          <td class="label"><?php echo MSN; ?></td>
                          <td><div class="field_container">
                              <input type="text" onb lur="javascript:checkform('msn');"  value="<?php echo $_SESSION["registration_page_msn"]; ?>" id="msn" name="msn" class="inputtext" />
                            </div></td>
							</tr>
							<tr>
							 <td class="label"><?php echo I_AM_REGISTER; ?></td>
                            <td id="sex_border"><div class="field_container">
                                <select gtbfieldid="23" class="select" name="sex" id="sex" onblur="javascript:checkform('sex');">
                                  <option selected="selected" value=""><?php echo PLEASE_SELECT_SEX_REGISTER; ?></option>
                                  <option value="1"><?php echo MALE_REGISTER; ?></option>
                                  <option value="2"><?php echo FEMALE_REGISTER; ?></option>
                                </select><span style="color:#FF0000;">*</span>
                              </div></td>
							  <tr><td></td><td><div id="sex_check"></div></td></tr>
                        </tr>
						
						
						 <tr>
                          <td class="label"><?php echo QUESTION; ?></td>
                          <td  id="question_border"><div class="field_container">
                              <?php echo question_drop_list("question", " class=\"inputtext\" id='question' onblur=\"javascript:checkform('question');\"", "".$_SESSION["registration_page_question"]."", "".PLEASESELECTED.""); ?><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						<tr><td></td><td><div id="question_check"></div></td></tr>
						
						 <tr>
                          <td class="label"><?php echo ANSWER; ?></td>
                          <td><div class="field_container">
                              <input type="text" id="answer" name="answer" value="<?php echo $_SESSION["registration_page_answer"]; ?>" onblur="javascript:checkform('answer');" class="inputtext" /><span style="color:#FF0000;">*</span>
                            </div></td>
                        </tr>
						<tr><td></td><td><div id="answer_check"></div></td></tr>
						<!--<tr>
                          <td class="label" nowrap="nowrap">验证码</td>
                           <td><input type="text" id="verifycode" style="width:160px" maxLength=20 size=25 name="verifycode" >
			               <a href="register.php"><img border="0" src="testcode.php"></a>
						   <div style="color:#0000CC;">验证码看不清楚?请点击刷新验证码</div>
						   </td>
						  </tr>-->
                          <!--<tr>
                          <td class="label"></td>
                          <td><div id="birthday_warning"><a href="#" title="点击查看更多信息" rel="dialog">为什么我需要提供此信息？</a></div></td>
                        </tr>-->
                      </tbody>
                    </table>
					 <input type="hidden" id="submit" value="Submit" name="submit" style="width:100px;" />
					<!-- sign up button -->
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