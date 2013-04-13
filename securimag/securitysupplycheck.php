<?php
ob_start();
error_reporting(0);
 require("../inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
if( $_SESSION["language_be_choosed"]=="eng"){
 include("../language/eng.php");
}else{
 include("../language/chn.php");
}
require("../inc/dbconnect.php");
include("../inc/function.php");
include("geolocation/geoip.inc");
$user_id=$_SESSION['interbringeruserId'];
$email=get_user_email($user_id, $db);
$title=$_POST["title"];
$country=$_POST["country"];
$state=$_POST["state"];
$city=$_POST["city"];
$countryback=$_POST["countryback"];
$stateback=$_POST["stateback"];
$cityback=$_POST["cityback"];
$backdate=$_POST["backdate"];
$postdate=date("Y-m-d H:i:s");
$catergory=$_POST["catergory"];
$contactpub=$_POST["contactpub"];
$emailshow=$_POST["emailshow"];
$postdescription=$_POST["postdescription"];
$price=$_POST["price"];


 if ($_POST["check_supply_post"]=="Submit") {

  include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {
  
        //open the database
          $GeoIPDatabase = geoip_open("geolocation/GeoIP.dat", GEOIP_STANDARD);
		  //to get the country code (2 letters)
          $country_post=geoip_country_code_by_addr($GeoIPDatabase, $_SERVER['REMOTE_ADDR']);
          //to get the full country name
          //echo geoip_country_name_by_addr($GeoIPDatabase, $IP);
          //return $country;
          //close the database
          geoip_close($GeoIPDatabase);
		  
		   if($country_post=="CN"){
		    $iplocation_c=2;
		  }else if($country_post=="US"){
		     $iplocation_c=1;
		  }else{
		    $iplocation_c=0;
		  }
		  
        $sql = "INSERT INTO `supplypost` (`id`,`title`,`catergory`,`userid`, `countryid`, `stateid`, `cityid`,`countryback`, `stateback`, `cityback`, `price`, `backtime`,`pubic`, `replytoemail`, `showemailtype`, `description`, `postdate`, `postlocation`,`view`, `email_check`)  VALUES ";
        $sql .= "(null,'$title','$catergory', $user_id, $country, $state, $city, $countryback, $stateback, $cityback, '$price', '$backdate', '$contactpub', '$email', $emailshow, '".$postdescription."', '$postdate', ".$iplocation_c.", 0, 'N')";
		
		echo $sql;
	    $q = mysql_query($sql, $db);
	    $fID = (int)mysql_insert_id($db); 
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new supplypost). ERROR AVL001");
	    header("Location: ../postsu.php?t=s&op=pb&pid=".$fID);
	    die(); 
  } else {
	$failinfo="<div style=\"border: red solid 2px; color:red; width: 30%;\">".FAIL_FOR_CODE_HINT."</div>";

  }
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>InterBringer-<?php echo SECURITY_CODE_CHECK; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="header">
  <div id="logo">
    <h2></h2>
  </div>
</div>
<!-- end #header -->
<div id="page">
  <div id="content">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
	<?php if($failinfo!="") {?>
	<tr><td><?php echo $failinfo;?></td></tr>
	<?php } ?>
      <tr>
        <td><table cellpadding="0" cellspacing="0" border="0" width="30%">
		<tr>
			<td><?php echo SECURITY_HEADER_HINT; ?></td>
			</tr>
            <tr>
              <td><fieldset>
                <legend><?php echo SECURITY_CHECK; ?></legend>
                <form method="post" action="securitysupplycheck.php" enctype="multipart/form-data">
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
                  
                  <!--check($_POST['code']) will check the submitted form field -->
				     <input type="text"  name="code" value="" />
                  	 <input type="hidden" id="title" name="title" value="<?php echo $title; ?>" />
	                 <input type="hidden" id= "price" name="price" value= "<?php echo $price; ?>" />
	                 <input type="hidden" id= "backdate" name="backdate" value= "<?php echo $backdate; ?>" />
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
                  <br />
                  <br />
				  <input type="hidden" id="check_supply_post" name="check_supply_post" value="Submit" />
                  <input type="submit"  value="<?php echo SUBMIT; ?>" />
                </form>
                </fieldset></td>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
  <!-- end #content -->
</div>
<!-- end #page -->
<div id="footer">
  <?php echo show_footer(); ?>
</div>
<!-- end #footer -->
</body>
</html>
<?php


?>
