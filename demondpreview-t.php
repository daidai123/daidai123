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
<title><?php echo POST; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link rel="stylesheet" href="./thinkBox/thickbox.css" type="text/css" media="screen"/>

<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>

<script type="text/javascript" src="./thinkBox/jquery-latest.js"></script>
<script type="text/javascript" src="./thinkBox/thickbox.js"></script>
<style type=text/css>
th {
padding:3px 3px 3px 3px;
height:30px;
font-family:"Times New Roman", Times, serif;
font-size:16px;
font-weight:bolder;
color:#000000;
}
td {
	padding:3px 3px 3px 3px;
	font-family:"Times New Roman", Times, serif;
	font-size:14px;
}

td .title{
color:#0000CC;
text-decoration:underline;
font-weight:bold;
font-size:16px;
white-space:nowrap;
}

table.sortable thead {
	FONT-WEIGHT: bold; CURSOR: default; COLOR: #666666; BACKGROUND-COLOR: #eee
}
</style>
</head>

<body>
<div id="main_container" style="width:100%;">
<?php 
include("inc/function.php");
$user_id=$_SESSION['interbringeruserId'];
$email=$_POST["replyemail"];
$title=$_POST["title"];
$country=$_POST["country"];
$state=$_POST["state"];
$city=$_POST["city"];
$countryback=$_POST["countryback"];
$stateback=$_POST["stateback"];
$cityback=$_POST["cityback"];
$catergory=$_POST["catergory"];
$contactpub=$_POST["contactpub"];
$emailshow=$_POST["emailshow"];
$postdescription=$_POST["postdescription"];
$actiontype=$_POST["actiontype"];
if($actiontype=="mod") {
  $postdate=$_POST["pdate"];
  $postid=$_POST["pid"];
  $nextactionpage="demondpreview-t.php";
} else{
  $postdate=date("Y-m-d H:i:s");
  $nextactionpage="securimag/securitydemontranscheck.php";
}
$online_offline = "<span style=\"font-size:18; font-weight:bold; color: green;\">".ONLINE."</span>";

$_SESSION["trans_demond_add_email"]=$email;
$_SESSION["trans_demond_add_title"]=$title;
$_SESSION["trans_demond_add_country"]=$country;
$_SESSION["trans_demond_add_state"]=$state;
$_SESSION["trans_demond_add_city"]=$city;
$_SESSION["trans_demond_add_countryback"]=$countryback;
$_SESSION["trans_demond_add_stateback"]=$stateback;
$_SESSION["trans_demond_add_cityback"]=$cityback;
$_SESSION["trans_demond_add_catergory"]=$catergory;
$_SESSION["trans_demond_add_contactpub"]=$contactpub;
$_SESSION["trans_demond_add_emailshow"]=$emailshow;
$_SESSION["trans_demond_add_postdescription"]=$postdescription;


if($_POST["confirm"]!=""){

	    $sql = "UPDATE `demandpost` SET `title`='".$title."', `catergory` = '".$catergory."', `countryid`= ".$country.",  `stateid` = ".$state.", `cityid`= ".$city.", `pubic`='".$contactpub."', `replytoemail` = '".$email."', `showemailtype`=".$emailshow.", `description` = '".$postdescription."' WHERE `id` = ".$postid."";
	    $q = mysql_query($sql, $db);
		
		echo $sql;
		
	    if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (update post information). ERROR AVL001");
		
		
		unset($_SESSION["trans_demond_add_email"]);
        unset($_SESSION["trans_demond_add_title"]);
        unset($_SESSION["trans_demond_add_country"]);
        unset($_SESSION["trans_demond_add_state"]);
        unset($_SESSION["trans_demond_add_city"]);
        unset($_SESSION["trans_demond_add_countryback"]);
        unset($_SESSION["trans_demond_add_stateback"]);
        unset($_SESSION["trans_demond_add_cityback"]);
        unset($_SESSION["trans_demond_add_catergory"]);
        unset($_SESSION["trans_demond_add_contactpub"]);
        unset($_SESSION["trans_demond_add_emailshow"]);
		unset($_SESSION["trans_demond_add_postdescription"]);
		
		header("Location: postsu.php?pt=2&op=m&pid=".$postid);
	    die();	
}

if($emailshow==1){
$emailshowinpage=$email;
}else if($emailshow==2){
$emailshowinpage="";
}

if($contactpub=='Y'){
   $contactinf_link="contactinfo.php?pid=".$postid."&ty=p&t=t&keepThis=true&TB_iframe=true&height=450&width=600";
}else if($contactpub=='N'){
   $contactinf_link="nocontactinfo.php?t=t&keepThis=true&TB_iframe=true&height=160&width=700";
}else{
   $contactinf_link="#";
}
?>

   <?php
     include_once("header/header-user-trans.php");
   ?>

  <div class="fb_content clearfix" id="content">
     <div class="UIFullPage_Container" style="width:90%; min-width:1200px; "> 
 
        <div style="min-height:550px; width:100%;">
		
		
          <?php if($actiontype!="mod"){?>
             <div style="text-align:center; margin-top:20px; margin-left:20%; width:860px;">
	            <img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/step-4.png" />
	          </div>
           <?php } ?>
		   
		   
       <div style=" float:left; width:20%; min-width:240px; margin-top:25px;">
          <div style="border:#D8DFEA solid 1px;">
            <table cellpadding="4" cellspacing="4" style="width:100%;">
             <tr style="background:#EDEFF4; height:30px;">
	          <td colspan="3" nowrap="nowrap" style="color:#3B5998; font-weight:bold; font-size:14px;">
	           <?php echo POSTER_INFORMATION; ?>
               </td>
	           </tr>
               <tr>
	           <td colspan="2" nowrap="nowrap"><span style="font-weight:bold;"><?php echo USERNAME; ?>: </span><?php echo get_user_name($user_id, $db); ?></td>
	           <td></td>
               </tr>
	          <tr>
	           <td style="" colspan="2" nowrap="nowrap">
	             <?php if($_SESSION["interbringeruserId"]>0){?>
	             <a href="javascript:void(0)" style="font-size:18px; color:#0C36E0; font-weight:bold;" onClick="javascript:chatWith('<?php echo get_user_name($user_id, $db);?>')"><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/geiwoliuyan.png"  /></a>
	            <?php 
	             }else{
                  ?>
	            <a href="javascript:void(0)" style="font-size:18px; color:#0C36E0; font-weight:bold;" onClick="javascript:alert('<?php echo ONLY_OPEN_FOR_RE_USER;?>');"><input type="button" value="给我留言"  style="width:100px; height:30px; color:#FFFFFF; font-size:14px; font-weight:bold; background:#00CC33;"/></a>
	            <?php } ?>
                </td>
	            <td style="text-align:right;"><span style="color:#FF0000; margin-right:10px; font-weight:bold;  font-size:13px;"><?php echo $online_offline;?></span></td>
                </tr>
	             <tr>
	             <td colspan="3">
	               <div style="width:100%; border-top:#B3B3B3 solid 1px;">
	               </div>
	             </td>
				 </tr>
	             <tr>
	            <td style="font-weight:bold;" align="left" nowrap="nowrap" colspan="3"><span style="color:#0000FF; font-size:16px; font-family:'新宋体';"><?php echo REPLYTO; ?></span></td>
               </tr>
		       <tr>
	            <td style="font-weight:bold;" align="left" colspan="3"><span style="color:#0000FF; font-size:13px; font-family:'新宋体';"><?php echo $emailshowinpage;?></span></td>
                </tr>
	            <tr>
	            <td style="font-weight:bold;" align="left" nowrap="nowrap" colspan="3"><span style="color:#0000FF; font-size:16px; font-family:'新宋体';">[<a href="<?php echo $contactinf_link; ?>" class="thickbox" style="font-size:12px; color:#0000CC; font-weight:bold;"><?php echo NEED_MORE_POSTER_INFO_QU; ?></a>]</span></td>
              </tr>
	          <tr>
	          <td colspan="3" style="height:10px;">
	           <div style="width:100%; border-top:#B3B3B3 solid 1px;"></div>
	          </td>
	          </tr>
	           <tr>
	            <td colspan="3">
	            <table cellpadding="0" cellspacing="0">
	            <tr>
	 <td colspan="3"  style=" font-weight:bold; width:100%;">
	  <?php echo WHERE_POSTER_IS; ?>：
	 </td>
	</tr>
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo COUNTRY; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_country_name($country, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo STATE_OR_PROVINCE; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_state_name($state, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo CITY; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_city_name($city, $db); ?></td>
	</tr>
		
	</table>
	</td>
	</tr>
    <tr>
	 <td colspan="3" style="height:10px;">
	  <div style="width:100%; border-top:#B3B3B3 solid 1px;"></div>
	 </td>
	 </tr>
	 <tr>
	 <td colspan="3">
	 <table cellpadding="0" cellspacing="0">
	 <tr>
	 <td colspan="3"  style=" font-weight:bold; width:100%;">
	  <?php echo TRANS_FINAL_DESTINAT; ?>：
	 </td>
	</tr>
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo COUNTRY; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_country_name($countryback, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo STATE_OR_PROVINCE; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_state_name($stateback, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo CITY; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_city_name($cityback, $db); ?></td>
	</tr>
		
	</table>
	 </td>
	 </tr>
	   <tr>
	 <td colspan="3" style="height:20px;">
	 </td>
	 </tr>
   </table>
   
   </div>
  </div>
  
  
  <div id="content" class="fb_content clearfix" style=" float:right; min-height:500px;width:78%;">

	<div id="mainContainer" style="width:90%;"  >
       <div style="margin-top:25px; margin-left:20px; padding-bottom:5px; width:100%;">
	     <div style="font-size:20px;font-weight:bolder;"><?php echo $title; ?></div>
		<div style="width:100%; border-bottom:#AAAAAA solid 1px; height:26px;">
		 <div style="float:left; color:#FF3333; font-family: font-size:10px; font-weight:normal; margin-top:10px;"><?php echo POST_LOCATION; ?>：<span style=" font-weight:bold;"><?php echo get_country_name($postlocation, $db); ?></span><?php echo COME_FROM_SYSTEM;?></div>
		 <div style="float:right; color:#999999; font-size:10px; font-weight:normal;margin-top:10px;"><?php echo POST_TIME;?>：<?php echo $postdate; ?></div>
		 </div>
	   </div>
	    
	  
	   <div style="width:100%; margin-left:20px;">
	   
	   <div style="width:100%; text-align:left; font-family:'Times New Roman', Times, serif; font-size:13px;">
	   <table style="width:100%;" border="0">
	   <tr>
	   <td style="text-align:left;">
	   <?php echo CATERGORY; ?>: <span style="font-family:Georgia, 'Times New Roman', Times, serif; color:#0000FF; font-size:13px; font-weight:bold;"><?php echo get_catergory_name($catergory, $db); ?></span>
	   </td>
		</tr>
		</table>
		</div>	
		
		
		
		 <div style="width:100%; margin-top:20px; min-height:300px; font-size:13px;">
		   <?php echo stripslashes($postdescription);?>       
		 </div> 
	     </div>
        </div>
      
	  </div>
     </div>
    </div>
    </div>
  
<div style="text-align: center; padding-top:10px; margin-top:5px;">	
			<form name="demondprevieform" id="demondpreviewform" action="<?php echo $nextactionpage; ?>" enctype="multipart/form-data" method="post">
	 <input type="hidden" id="title" name="title" value="<?php echo $title; ?>" />
	 <input type="hidden" id="country" name="country" value="<?php echo $country; ?>" />
	 <input type="hidden" id="state" name="state" value="<?php echo $state; ?>" />
	 <input type="hidden" id="city" name="city" value="<?php echo $city; ?>" />
	 <input type="hidden" id="countryback" name="countryback" value="<?php echo $countryback; ?>" />
	 <input type="hidden" id="stateback" name="stateback" value="<?php echo $stateback; ?>" />
	 <input type="hidden" id="cityback" name="cityback" value="<?php echo $cityback; ?>" />
	 <input type="hidden" id="catergory" name="catergory" value="<?php echo $catergory; ?>" />
	 <input type="hidden" id="contactpub" name="contactpub" value="<?php echo $contactpub; ?>" />
	 <input type="hidden" id="emailshow" name="emailshow" value="<?php echo $emailshow; ?>" /> 
	 <input type="hidden" id="postdescription" name="postdescription" value="<?php echo htmlspecialchars(stripslashes($postdescription)); ?>" />
	 <input type="hidden" id="replyemail" name="replyemail"  value="<?php echo $email; ?>"  />
	 <input type="hidden" id="postdate" name="postdate" value="<?php echo $postdate; ?>" />
	 <input type="hidden" id="actiontype" name="actiontype" value="<?php echo $actiontype; ?>" />
	 <input type="hidden" id="pid" name="pid" value="<?php echo $postid; ?>" />
	 <input type="button" value="<?php echo EDIT; ?>" name="edit" onclick="javascript: history.go(-1);" id="edit" style="width:100px; height:40px; font-weight:bold; font-size:16px;background:#EFEFEF; color:#000000;" />
	<input type="submit" value="<?php echo POST; ?>" style="background:#3B5998; width:100px; height:40px; font-weight:bold; font-size:16px; color:#FFFFFF;" name="confirm"/>
	 </form>		
			
		 
         </div>
   <?php
   include_once("header/long_footer.php");
  ?>

</div>
<?php if($_SESSION['interbringeruserId']>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>