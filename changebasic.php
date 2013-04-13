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
<title><?php echo BASICINFOMATION; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<link rel="stylesheet" type="text/css" href="index.css" />
<script  src="./js/changebasic.js"></script>
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<script language="javascript">
 
 function change_button(key, action){
 
 if(action=="on"){
 // alert(document.getElementById("next1").src);
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-b.png";
  } 
  else if(action=="out"){
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png";
  }
 
 }
 
</script>
</head>
<body>
<div id="main_container" style="width:100%;" >
<?php
include("threelink.php");
include("inc/function.php");
 
$user_id=$_SESSION['interbringeruserId'];
 
if($_POST["change_basic_submit"]!=""){
        //$username=$_POST["username"];
		$realname=$_POST["realname"];
		$country=$_POST["country"];
		$state=$_POST["state"];
		$city=$_POST["city"];
		$gender=$_POST["sex"];
		
		 if(($realname=="")||($country=="")||($state=="")||($city=="")||($gender=="")){
	 
	      $_SESSION['msgtype']=0;
		  $_SESSION['msg']=INFORMATION_INCOMPLETE_HINT;
		  header("Location: changebasic.php");
		  ob_end_flush();
		  die();
	      }

        $sql = "UPDATE `user` SET `realname` = '".$realname."', `country`= ".$country.",  `state` = ".$state.", `city` = ".$city.", `gendor` = ".$gender." WHERE `id` = ".$user_id."";
	    $q = mysql_query($sql, $db);
	    if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (update user basic information). ERROR AVL001");
	  
	    $_SESSION['msgtype']=1;
        $_SESSION['msg'] = CHANGE_BASIC_SU;
	  
	    header("Location: changebasic.php");
		ob_end_flush();	
	    die();	

}
else{

  $usersql="SELECT * FROM `user` WHERE `id`=".$user_id."";
  $userquery= mysql_query($usersql, $db);
  while($row=mysql_fetch_array($userquery))
  {
	$username=$row["username"];
	$realname=$row["realname"];
	$countryid=$row["country"];
	$stateid=$row["state"];
	$cityid=$row["city"];
	$email=$row["email"];
	$cellphone=$row["cellphone"];
	$qq=$row["qq"];
	$msn=$row["msn"];
	$gender=$row["gendor"];
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
            <td><div id="<?php echo msg_type($_SESSION); ?>" ><?php echo print_msg($_SESSION); ?></div></td>
          </tr>
          <?php }?>
          <tr>
            <td><?php echo CHANGEBASIC_HEADER_HINT; ?> </td>
          </tr>
	      <tr>
           <td>
          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
            <td align="center">
            <fieldset>
            <legend><?php echo BASICINFOMATION; ?></legend>
            <form id="change_basic_form" name="change_basic_form" method="post" action="changebasic.php" enctype="multipart/form-data">
              <table cellpadding="4" cellspacing="0" border="0" width="50%">
                <tr>
                  <td align="right" nowrap="nowrap" style="font-weight:bold;"><?php echo USERNAME; ?>: </td>
                  <td><input type="text" disabled="disabled"  value="<?php echo $username; ?>" id="username" onblur="javascript:checkform('realname');" name="username" style="width:200px;" /></td>
                  <td><span style="color:#FF0000;">*</span> </td>
                </tr>
				<tr>
                  <td align="right" nowrap="nowrap" style="font-weight:bold;"><?php echo HEAD_IMAGE; ?>: </td>
                  <td><input type="button" value="<?php echo CHANGE_HEAD_IMAGE; ?>" onclick="javascript: window.location.href = 'changeheadshot.php';" style="width:210px; height:30px;" /></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div id="username_check"></div></td>
                  <td></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap" style="font-weight:bold;"><?php echo REALNAME; ?>: </td>
                  <td><input type="text"  value="<?php echo $realname; ?>" id="realname" name="realname" onblur="javascript:checkform('realname');" style="width:200px;" /></td>
                  <td><span style="color:#FF0000;">*</span> </td>
                </tr>
                <tr>
                  <td></td>
                  <td><div id="realname_check"></div></td>
                  <td></td>
                </tr>
				<tr>
				 <td class="label"><?php echo I_AM_REGISTER; ?></td>
                     <td id="sex_border"><div class="field_container">
                                <select gtbfieldid="23" class="select" name="sex" id="sex" onblur="javascript:checkform('sex');">
                                  <option selected="selected" value=""><?php echo PLEASE_SELECT_SEX_REGISTER; ?></option>
                                  <option value="1" <?php if($gender==1){?> selected="selected"<?php } ?> ><?php echo MALE_REGISTER; ?></option>
                                  <option value="2" <?php if($gender==2){?> selected="selected"<?php } ?> ><?php echo FEMALE_REGISTER; ?></option>
                                </select><span style="color:#FF0000;">*</span>
                              </div></td>
							  <tr><td></td><td><div id="sex_check"></div></td></tr>
                        </tr>
                <tr>
            <?php
			  $country_query="SELECT * FROM `country` ORDER BY `id`";
	          $country_execute_query = mysql_query($country_query, $db); 
              $numCountry = mysql_num_rows($country_execute_query); 
			?>
                  <td nowrap="nowrap" align="right" style="font-weight:bold;"><?php echo COUNTRY; ?>: </td>
                  <td nowrap="nowrap" id="country_border"><select id="country" name="country" style="width:200px" onblur="javascript:checkform('country');" onChange="changepro('state','country');">
                      <option value="">----Please Select----</option>
                      <?php  while ($row = mysql_fetch_array($country_execute_query)) {
			    if($countryid==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
                      <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
                      <?php } ?>
                    </select></td>
                  <td><span style="color:#FF0000;">*</span></td>
                </tr>
                
                <tr>
                  <td></td>
                  <td><div id="country_check"></div></td>
                  <td></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap" style="font-weight:bold;"><?php echo STATE_OR_PROVINCE;?>: </td>
                  <td nowrap="nowrap" id="state_border"><select id="state" name="state" style="width:200px" onblur="javascript:checkform('state');" onChange="changecity('city','state');">
                      <option value="">----Please Select----</option>
                      <?php if(stateid!="") {
			           $state_query="SELECT * FROM `states` where `country`= ".$countryid." ORDER BY `id`";
	                   $state_execute_query = mysql_query($state_query, $db); 
			          ?>
                      <?php  while ($row = mysql_fetch_array($state_execute_query)) {
			    if($stateid==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
                      <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
                      <?php   } ?>
                      <?php } ?>
                    </select></td>
                  <td><span style="color:#FF0000;">*</span> </td>
                </tr>
                <tr>
                  <td></td>
                  <td><div id="state_check"></div></td>
				  <td></td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap" style="font-weight:bold;"><?php echo CITY; ?>: </td>
                  <td nowrap="nowrap" id="city_border"><select id="city" name="city" onblur="javascript:checkform('city');" style="width:200px">
                      <option value="">----Please Select----</option>
                      <?php if($cityid!="") {
			   $city_query="SELECT * FROM `city` where `state_id`= ".$stateid." ORDER BY `id`";
	           $city_execute_query = mysql_query($city_query, $db); 
			   ?>
                      <?php  while ($row = mysql_fetch_array($city_execute_query)) {
			    if($cityid==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
                      <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
                      <?php   } ?>
                      <?php } ?>
                    </select></td>
                  <td><span style="color:#FF0000;">*</span> </td>
                </tr>
                <tr>
                  <td></td>
                  <td><div id="city_check"></div></td>
				  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td align="left" nowrap="nowrap"><input type="submit" value="<?php echo SUBMITNEWBASICINFORMATION; ?>" onclick="return formcheck('changebasic');" id="change_basic_submit" name="change_basic_submit" style="width:210px;" />
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3" nowrap="nowrap"><?php echo QUESTIONEMAIL; ?><a href="#" style="color:#0033CC;"><?php echo ADMINEMAILADDRESS; ?></a>. </td>
                </tr>
              </table>
            </form>
            </fieldset>
            </td>
            </tr>
          </table>
          </td>
          </tr>
        </table>
      </div>
      <div style="height:20px;"></div>
    </div>
	</div>
  </div>
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
