<?php
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
 include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo USERINFOMATION; ?>|Interbringer</title>
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
?>

  <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
	 $filename = USER_HEADSHOT_IMAGE_FOLDER_BIG."".$_SESSION['interbringeruserId']."_big.jpg";
	
    if (file_exists(dirname(__FILE__).'/'.$filename))
     {
	   $show_image_url=$filename;
	  }
    else
     {
	   if($gender==1){
	     $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_m_big.jpg"; 
		}else if($gender==2){
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_w_big.jpg";
	    }else{
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_big.jpg";
		}
	 }
    ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container">
	<div style="margin-left:40px;">
	
	  <div style="color:#000000; font-size:16px; width:850px; margin-top:30px; font-weight:bold; margin-left:40px;">
	       <table cellpadding="0" cellspacing="0" border="0" width="70%">
      <tr>
        <td>
		  
          <table cellpadding="6" cellspacing="0" border="0" width="100%">
            <tr><td>
			

			 <table cellpadding="4" cellspacing="4" border="0" width="100%" style="border:#999999 solid 1px;">
			 <tr>
			 <td colspan="3" style="background:#B0BDDF; height:30px;">
			 <?php echo BASICINFOMATION; ?> [<a href="changebasic.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a>]
			 </td>
			 </tr>
			 <tr>
			  <td rowspan="6" width="40%">
			   <div style="width:167px; padding:2px 2px 2px 2px; height:202px; border:#999999 solid 2px;">
			     <img src="<?php echo $show_image_url; ?>" />
			   </div>
			  </td>
              <td align="right" nowrap="nowrap" style="font-weight:bold;width:20%;"> <?php echo USERNAME; ?>: </td>
              <td style="width:40%;">
			  <?php echo $username; ?>
              </td>
              </tr>
			  <tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;20%;"> <?php echo REALNAME; ?>: </td>
              <td style="width:50%;">
			  <?php echo $realname; ?>
              </td>
              </tr>
			  <tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;width:20%;"> <?php echo GENDER; ?>: </td>
              <td style="width:50%;">
			  <?php echo get_gender_name($gender); ?>
              </td>
              </tr>
			  <tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;width:20%;"> <?php echo COUNTRY; ?>: </td>
              <td style="width:50%;">
			  <?php echo get_country_name($countryid, $db); ?>
              </td>
              </tr>
			  <tr>
              <td align="right" nowrap="nowrap"  style="font-weight:bold;width:20%;"> <?php echo STATE_OR_PROVINCE;?>: </td>
              <td style="width:50%;">
			  <?php echo get_state_name($stateid, $db); ?>
              </td>
              </tr>
			  <tr>
              <td align="right" nowrap="nowrap"  style="font-weight:bold;width:20%;"> <?php echo CITY; ?>: </td>
              <td style="width:50%;">
			  <?php echo get_city_name($cityid, $db); ?>
              </td>
            </tr>
			</table>

			
			</td></tr>
            <tr><td>
			
			
			
			 <table cellpadding="4" cellspacing="4" border="0" width="100%" style="border:#999999 solid 1px;">
			 <tr>
			 <td colspan="2" style="background:#B0BDDF; height:30px;">
			 <?php echo PASSWORD; ?> [<a href="changepassword.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a>]
			 </td>
			 </tr>
			 <tr>
              <td nowrap="nowrap"> [<a href="changepassword.php" style="color:#0000FF"><?php echo SIDBAR_CHANG_PASSWORD; ?></a>]</td>
               <td></td>
              </tr>
			 </table>
		
			 </td></tr>
              <tr><td>
			
		   <table cellpadding="4" cellspacing="4" border="0" width="100%" style="border:#999999 solid 1px;">
			 <tr>
			 <td colspan="2" style="background:#B0BDDF; height:30px;">
			 <?php echo EMAILINFORMATION; ?> [<a href="changeemail.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a>]
			 </td>
			 </tr>
			 <tr><td align="right" style="font-weight:bold;width:50%;" > <?php echo EMAIL; ?>: </td>
              <td style="width:50%;"> 
			  <?php echo $email; ?>
              </td>
              </tr>
			  </table>

			
			</td></tr>
            <tr><td>
			
		 <table cellpadding="4" cellspacing="4" border="0" width="100%" style="border:#999999 solid 1px;">
			 <tr>
			 <td colspan="2" style="background:#B0BDDF; height:30px;">
			 <?php echo CONTACTINFORMATION; ?>  [<a href="changecontact.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a>]
			 </td>
			 </tr>
			   <tr>
              <td align="right"  style="font-weight:bold;width:50%;"><?php echo TELEPHONE; ?>: </td>
              <td style="width:50%;">
			  <?php echo $cellphone; ?>
              </td>
            </tr>
			 <tr>
				  <td align="right" style="font-weight:bold;width:50%;" ><?php echo QQ; ?>: </td>
              <td style="width:50%;">
			  <?php echo $qq; ?>
              </td>
            </tr>
			 <tr>
              <td align="right" style="font-weight:bold;width:50%;"><?php echo MSN; ?>: </td>
              <td style="width:50;%">
			  <?php echo $msn; ?>
              </td>
            </tr>
			</table>

			</td></tr> 
           </table>
        
		  </td>
      </tr>
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