<?php
ob_start();
error_reporting(0);
require("../inc/session.php");
sessionCheck(session_id(), $_SESSION, $_SERVER);
checkLogin();
require("../inc/dbconnect.php");
include("../inc/function.php");
/*include("geolocation/geoip.inc");*/
if( $_SESSION["language_be_choosed"]=="eng"){
 include("../language/eng.php");
}else{
 include("../language/chn.php");
}
include("iplocationcheck.php");
$user_id=$_SESSION['interbringeruserId'];
$email=get_user_email($user_id, $db);
$title=$_POST["title"];
$country=$_POST["country"];
$state=$_POST["state"];
$city=$_POST["city"];
$postdate=date("Y-m-d H:i:s");
$catergory=$_POST["catergory"];
$contactpub=$_POST["contactpub"];
$emailshow=$_POST["emailshow"];
$postdescription=$_POST["postdescription"];


 if ($_POST["check_demond_post"]=="Submit") {

  include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);
  
  if($valid == true) {
         /* //open the database
          $GeoIPDatabase = geoip_open("geolocation/GeoIP.dat", GEOIP_STANDARD);
		  //to get the country code (2 letters)
          $country_post=geoip_country_code_by_addr($GeoIPDatabase, $_SERVER['REMOTE_ADDR']);
          //to get the full country name
          //echo geoip_country_name_by_addr($GeoIPDatabase, $IP);
          //return $country;
          //close the database
          geoip_close($GeoIPDatabase);*/
		  
		  //$_SERVER['REMOTE_ADDR']
		  $ip=$_SERVER['REMOTE_ADDR'];
		  $locationinfo = array('city'=>null, 'country'=>null, 'countryCode'=>null, 'longitude'=>null, 'latitude'=>null);
		  $locationinfo=IP_LOOK_LOCATION($ip);
		  $country_post=$locationinfo["countryCode"];
  
         if($country_post=="CN"){
		    $iplocation_c=2;
		  }else if($country_post=="US"){
		     $iplocation_c=1;
		  }else if($country_post=="FR"){
		    $iplocation_c=3;
		  }else if($country_post=="JP"){
		    $iplocation_c=4;
		  }else if($country_post=="AU"){
		    $iplocation_c=5;
		  }else if($country_post=="CA"){
		    $iplocation_c=6;
		  }else{
                    $iplocation_c=0;
                  }

		  
        $sql = "INSERT INTO `demandpost` (`id`,`title`,`catergory`,`userid`, `countryid`, `stateid`, `cityid`, `pubic`, `replytoemail`, `showemailtype`, `description`, `postdate`, `post_type`, `postlocation`, `ip`, `longtitude`, `latitude`,`view`, `email_check`)  VALUES ";
        $sql .= "(null,'$title','$catergory', $user_id, $country, $state, $city, '$contactpub', '$email', $emailshow, '".$postdescription."', '$postdate', 1, ".$iplocation_c.", '".$ip."', ".$locationinfo["longitude"].", ".$locationinfo["latitude"].", 0, 'N')";
		//echo $sql;
	    $q = mysql_query($sql, $db);
	    $fID = (int)mysql_insert_id($db); 
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new user). ERROR AVL001");
		unset($_SESSION["demond_add_email"]);
        unset($_SESSION["demond_add_title"]);
        unset($_SESSION["demond_add_country"]);
        unset($_SESSION["demond_add_state"]);
        unset($_SESSION["demond_add_city"]);
        unset($_SESSION["demond_add_catergory"]);
        unset($_SESSION["demond_add_contactpub"]);
        unset($_SESSION["demond_add_emailshow"]);
		unset($_SESSION["demond_add_postdescription"]);
	    header("Location: ../postsu.php?pt=1&op=pb&pid=".$fID);
	    die(); 
  } else {
	$failinfo="<div style=\"border: red solid 2px; color:red; width: 30%;\">".FAIL_FOR_CODE_HINT."</div>";

  }
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>InterBringer-<?php echo SECURITY_CODE_CHECK; ?></title>
<link type="text/css" rel="stylesheet" href="../csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="../csshead/716c6sy6.css">
</head>
<body>
   <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("../header/header-user.php");
	 }else{
	 include_once("../header/header-search.php");
	 }
    ?>
<!-- end #header -->
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container">
	<div style="margin-left:40px; padding-bottom:20px;">
	
	  <div style="text-align:center">
	   <img src="../<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/step-5.png" />
	  </div>
	    <div style="text-align:center; margin-left:30px; padding-top:20px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
	<?php if($failinfo!="") {?>
	<tr><td><?php echo $failinfo;?></td></tr>
	<?php } ?>
      <tr>
        <td><table cellpadding="8" cellspacing="8" border="0" width="30%">
            <tr>
			<td><?php echo SECURITY_HEADER_HINT; ?></td>
			</tr>
			<tr>
              <td>
			  <div style="background:#F9F9F9; border:#999999 solid 1px;">
                 <form method="post" action="securitydemoncheck.php" enctype="multipart/form-data">
				 <table cellpadding="4" cellspacing="4">
				  <tr>
				  <td>
                  <div style="width: 430px; float: left; height: 90px"> <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="securimage_show.php?sid=<?php echo md5(time()) ?>" />
                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                      <param name="allowScriptAccess" value="sameDomain" />
                      <param name="allowFullScreen" value="false" />
                      <param name="movie" value="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                      <param name="quality" value="high" />
                      <param name="bgcolor" value="#ffffff" />
                      <embed src="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                    </object>
                    <br />
                    <!-- pass a session id to the query string of the script to prevent ie caching -->
                    <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a> </div>
                  <div style="clear: both"></div>
                    </td>
				  </tr>
				  <tr>
				  <td>
                
                  <input type="text" name="code" size="12" style="width:200px;" />
				  <input type="hidden" id="title" name="title" value="<?php echo $title; ?>" />
	              <input type="hidden" id="country" name="country" value="<?php echo $country; ?>" />
	              <input type="hidden" id="state" name="state" value="<?php echo $state; ?>" />
	              <input type="hidden" id="city" name="city" value="<?php echo $city; ?>" />
	              <input type="hidden" id="catergory" name="catergory" value="<?php echo $catergory; ?>" />
	              <input type="hidden" id="contactpub" name="contactpub" value="<?php echo $contactpub; ?>" />
	              <input type="hidden" id="emailshow" name="emailshow" value="<?php echo $emailshow; ?>" /> 
	              <input type="hidden" id="postdescription" name="postdescription" value="<?php echo htmlspecialchars(stripslashes($postdescription)); ?>" />
	              <input type="hidden" id="postdate" name="postdate" value="<?php echo $postdate; ?>" />
                   </td>
				  </tr>
				  <tr>
				  <td>
				  <input type="hidden" id="check_demond_post" name="check_demond_post" value="Submit" />
                  <input type="submit"  value="<?php echo SUBMIT; ?>" />
				  	  </td>
				</tr>
				</table>
                </form>
                </div></td>
            </tr>
          </table></td>
      </tr>
    </table>
	</div>
  </div>
 </div>
</div>
<!-- end #page -->
   <?php
      include_once("../header/footer.php");
  ?>
<!-- end #footer -->
</body>
</html>
<?php


?>
