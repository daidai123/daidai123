<?php
  ob_start();
  session_start();
  include("inc/config.php");
  include("inc/unsetsession_demond.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo DEMOND_POST_INFO; ?>|Interbringer</title>
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
<script language="javascript">
function checkPostDelete(id)
 {
  if(confirm( '<?php echo SURE_TO_DELETE_POST; ?>' ))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=d&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
 
 function checkRePost(id)
 {
  if(confirm('<?php echo SURE_TO_REPOST; ?>'))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=rp&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
</script>
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
     
	   $postid=$_GET["pid"];
	   
	   CHECK_ID_CORRECT_PAGE('demandpost', 2, $postid, $db);
	   
	   if($_SESSION['interbringeruserType']>0){
       $current_user=$_SESSION['interbringeruserId'];
	   $_SESSION['interbringerusername'] = get_user_name($current_user, $db);
	   }
	   
	   
	  if($_GET["op"]!=""){
	  	 $checksql="SELECT * FROM `demandpost` WHERE `id`=".$postid."";
	     $checkquery= mysql_query($checksql, $db);
	      while($row=mysql_fetch_array($checkquery))
	     {
	       $check_user=$row["userid"];
	     }
	  }
	  
	  if(($_GET["op"]=="d")&&($current_user==$check_user))
      {	  
	    $deletesql="DELETE FROM demandpost WHERE id=".$postid;
	    $q = mysql_query($deletesql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Delete Post for ".$delete_table."). ERROR AVL001");	
	    header("Location: postsu.php?pt=2&op=d&pid=".$postid."");	
	    die();	   
       }else if(($_GET["op"]=="rp")&&($current_user==$check_user)){
	    $repostsql= "UPDATE `demandpost` SET `postdate`= NOW() WHERE `id` = ".$postid."";
        $q = mysql_query($repostsql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Re-Post Post for ".$repost_table."). ERROR AVL001");	  
	    header("Location: postsu.php?pt=2&op=rp&pid=".$postid."");	
	    die();	   
     }
	  
	  
      $sql="SELECT * FROM `demandpost` WHERE `id`=".$postid."";
	  $demandquery= mysql_query($sql, $db);
	  
	  while($row=mysql_fetch_array($demandquery))
	  {
		$title_detail=$row["title"];
        $catergory=$row["catergory"];
		$countryid=$row["countryid"];
		$userid=$row["userid"];
        $stateid=$row["stateid"];
		$countryto=$row["countryto"];
        $cityto=$row["cityto"];
		$stateto=$row["stateto"];
        $cityid=$row["cityid"];
		$pubic=$row["pubic"];
		$replytoemail=$row["replytoemail"];
		$showemailtype=$row["showemailtype"];
		$description=stripslashes($row["description"]);
        $postdate=$row["postdate"];
		$postlocation=$row["postlocation"];
		$longtitude=$row["longtitude"];
		$latitude=$row["latitude"];
	  }
	  
	  if($showemailtype==1){
	    $emailshow=$replytoemail;
	  }else{
	    $emailshow="";
	  }
	  
	  
	 if($pubic=='Y'){
     $contactinf_link="contactinfo.php?pid=".$postid."&ty=d&t=t&keepThis=true&TB_iframe=true&height=450&width=600";
}else if($pubic=='N'){
   $contactinf_link="nocontactinfo.php?t=t&keepThis=true&TB_iframe=true&height=170&width=700";
}else{
   $contactinf_link="#";
}
   
	$online_offline = CHECK_USER_ONLINE_OFFLINE($userid, $db); 
					    
	if($online_offline){
	  $online_offline_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/online.png\" width=\"25\" height=\"25\"  alt=\"".USER_ONLINE."\" />";
	  $online_offline_search_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/yuwolianxi.png\" alt=\"".CONTACT_ME."\" />";// this will show that your user is currently offline
	  $trans_to_the_href="href=\"javascript:void(0)\" onClick=\"javascript:chatWith('".get_user_name($userid, $db)."')\"";
    }else{
	  $online_offline_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/offline.png\" width=\"25\" height=\"25\"  alt=\"".USER_OFFLINE."\" />";
	  $online_offline_search_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/geiwoliuyanh.png\"  alt=\"".MESSAGE_ME."\" />";// this will show that your user is currently online
	  $trans_to_the_href="href=\"mymessage.php?lmt=".get_user_name($userid, $db)."\"";
   }
?>

   <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user-trans.php");
	 }else{
	 include_once("header/header-search-trans.php");
	 }
	$gender = get_user_gender($userid, $db);
	 
	 $filename = USER_HEADSHOT_IMAGE_FOLDER_SMALL."".$userid."_small.jpg";
	
    if (file_exists(dirname(__FILE__).'/'.$filename))
     {
	   $show_image_url=$filename;
	  }
    else
     {
	   if($gender==1){
	     $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_m_small.jpg"; 
		}else if($gender==2){
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_w_small.jpg";
	    }else{
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_small.jpg";
		}
	 }
    ?>

 
 
  <div class="fb_content clearfix" id="content">
     <div class="UIFullPage_Container" style="width:90%; min-width:1200px;"> 
  <div style=" float:left; width:20%; min-width:240px; margin-top:15px;">
  
  <div style="border:#D8DFEA solid 1px;width:240px;">
   <table cellpadding="4" cellspacing="4" style="width:100%;">
     <tr style="background:#EDEFF4; height:30px;">
	 <td colspan="3" nowrap="nowrap" style="color:#3B5998; font-weight:bold; font-size:14px;">
	  <?php echo POSTER_INFORMATION; ?>
     </td>
	 </tr>
     <tr>
	 <td rowspan="2" style="width:50px;">
	  <div style="height:50px; width:50px; border:#000000 solid 1px; padding:5px 2px 2px 5px;">
	   <img src="<?php echo $show_image_url; ?>"  style="width:48px; height:48px;" />
	  </div>
	 </td>
	 <td colspan="1" nowrap="nowrap"><span style="font-weight:bold;"><?php echo USERNAME; ?>：</span><?php echo get_user_name($userid, $db); ?></td>
	 <td></td>
     </tr>
	 <tr>
	 <td style="" colspan="2" nowrap="nowrap">
	 <?php echo $online_offline_m;?>
	 <?php if($_SESSION["interbringeruserId"]>0){?>
	   <a <?php echo $trans_to_the_href; ?> style="font-size:18px; color:#0C36E0; font-weight:bold;" ><?php echo $online_offline_search_m; ?></a>
	   
	   <?php 
	   }else{
	   ?>
	   
	   <a href="javascript:void(0)" style="font-size:18px; color:#0C36E0; font-weight:bold;" onClick="javascript:alert('<?php echo ONLY_OPEN_FOR_RE_USER;?>');"><?php echo $online_offline_search_m; ?></a>
	   
	   <?php } ?>
	 
	 </td>
	 <td style="text-align:right;"><span style="color:#FF0000; margin-right:10px; font-weight:bold;  font-size:13px;"></span></td>
     </tr>
	 <tr>
	 <td colspan="3">
	 <div style="width:100%; border-top:#B3B3B3 solid 1px;">
	 </div>
	 </td>
	 <tr>
	 <td style="font-weight:bold;" align="left" nowrap="nowrap" colspan="3"><span style="color:#0000FF; font-size:16px; font-family:'新宋体';"><?php echo REPLYTO; ?></span></td>
     </tr>
		 <tr>
	 <td style="font-weight:bold;" align="left" colspan="3"><span style="color:#0000FF; font-size:13px; font-family:'新宋体';"><?php echo $emailshow;?></span></td>
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
	 <td colspan="1" style="text-align:left;"><?php echo get_country_name($countryid, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo STATE_OR_PROVINCE; ?>:</td>
	 <td colspan="1" style="text-align:left;"><?php echo get_state_name($stateid, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo CITY; ?>:</td>
	 <td colspan="1" style="text-align:left;"><?php echo get_city_name($cityid, $db); ?></td>
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
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_country_name($countryto, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo STATE_OR_PROVINCE; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_state_name($stateto, $db);?></td>
	</tr>
	
	 <tr>
     <td style="width:30px;"></td>
	 <td colspan="1" align="left" style=" width:50px; text-align:left"><?php echo CITY; ?>:</td>
	 <td colspan="1" style="text-align:left;" nowrap="nowrap"><?php echo get_city_name($cityto, $db); ?></td>
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
  <div id="content" class="fb_content clearfix" style=" float:right; min-height:500px;width:80%;">

	<div id="mainContainer" style="width:90%;"  >
       <div style="margin-top:15px; margin-left:20px; padding-bottom:5px; width:100%;">
	     <div style="font-size:20px;font-weight:bolder;"><?php echo $title_detail; ?></div>
		<div style="width:100%; border-bottom:#AAAAAA solid 1px; height:26px;">
		 <div style="float:left; color:#FF3333; font-family: font-size:10px; font-weight:normal; margin-top:5px;"><?php echo POST_LOCATION; ?>：<span style=" font-weight:bold;"><?php echo get_country_name($postlocation, $db); ?></span><?php echo COME_FROM_SYSTEM;?> <?php if(($longtitude!="")&&($latitude!="")){?>
		 <a href="mapshow.php?l=<?php echo $latitude; ?>&lo=<?php echo $longtitude; ?>&ty=s&t=t&keepThis=true&TB_iframe=true&height=560&width=700;" style="font-style:italic;" class="thickbox" ><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/earth.jpeg"  height="15px" width="15px" /></a>
		 <?php } ?></div>
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
	  <td style="text-align:right;">
	   <?php if($current_user==$userid){?>
	    <span style="text-align:right;font-size:14px; margin-bottom:2px; font-weight:bold; color:#0000CC;"> <a href="demandpostmod-trans.php?pid=<?php echo $postid;?>" style="padding-right:20px;"><?php echo EDIT; ?></a><a href="#" onclick="javascript: checkPostDelete('<?php echo $postid;?>');" style="padding-right:20px;"><?php echo REMOVE; ?></a><a href="#" onclick="javascript: checkRePost('<?php echo $postid;?>');" style=""><?php echo REPOST; ?></a>
		</span>
	    <?php }  ?> 
		</td>
		</tr>
		</table>
		</div>
		<?php
            include_once("header/friendhint.php");
          ?>	
		 <div style="width:100%; margin-top:20px; font-size:13px;">
		   <?php echo stripslashes($description); ?>	       
		 </div>
	   </div>
    </div>
  </div>
  </div>
  </div>
  
 	<div style="margin-top:50px;">
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