<?php
 ob_start();
 //require("inc/session.php");
 //sessionCheck(session_id(), $_SESSION, $_SERVER);
 //checkLogin();
 include("inc/config.php");
 include("fckeditor.php") ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo POST; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<script  src="./js/calendar.js"></script>
<link rel="STYLESHEET" type="text/css" href="./js/cwcalendar.css">
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<script language="javascript" type="text/javascript" src="js/postdemond.js"></script>
<script type="text/javascript">
  var formatSplitter = "-";
  var monthFormat = "mm";
  var yearFormat = "yyyy";
</script>
</head>
<?php
if($_POST["submit_info"]!=""){

 $title=$_POST["title"];
 $postdescription=stripslashes($_POST["postdescription"]);
 $sql = "INSERT INTO `discountinfo` (`id`,`title`, `description`, `post_time`,`post_type`)  VALUES ";
        $sql .= "(null,'$title', '$postdescription', NOW(), 1)";
	    $q = mysql_query($sql, $db);
	    $fID = (int)mysql_insert_id($db); 
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new supplypost). ERROR AVL001");


}
?>

<body>
<div id="main_container" style="width:100%;">
<?php
include("threelink.php");
include("inc/function.php");
//include("inc/check_cat_select.php");


$user_id=$_SESSION['interbringeruserId'];
?>

 <?php
     include_once("header/header-user-buy.php");
 ?>
		
  <div id="content" class="fb_content clearfix" style="min-height:500px; width:100%;">
    <div class="UIFullPage_Container" style="width:860px;">
       <div style="margin-top:30px; width:150px; padding-bottom:5px;font-size:20px; font-weight:bolder;">
	     填写信息
	   </div>
	   <div style="width:100%;">

		 <div style=" margin-top:10px;">
		  
	      <form name="postdemondform" id="postdemondform" enctype="multipart/form-data" action="postdiscountinfo-admin.php" method="post">               
			   <table cellpadding="3" cellspacing="3" border="0" width="100%">
               <tr>
                <td style="width:100%;" colspan="6" nowrap="nowrap">
			     <input type="text" class="inputtext" id="title" style="width:98%; font-size:18px;" maxlength="65" name="title" value="<?php echo $_SESSION["demond_add_title"];?>" /><span style="color:#FF0000;">*</span>
              </td>
			   
                 </tr>
			
			      <tr><td colspan="6"><div id="title_check"></div></td></tr>
			     <tr>
                   <td align="center" colspan="6" ><div id="postdescription_alert" >
                                  <?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "../interbringer" ) ) ;

$oFCKeditor = new FCKeditor('postdescription') ;
$oFCKeditor->BasePath = $sBasePath ;

if ( isset($_GET['Lang']) )
{
	$oFCKeditor->Config['AutoDetectLanguage']	= false ;
	$oFCKeditor->Config['DefaultLanguage']		= preg_replace("/[^a-z\-]/i", "", $_GET['Lang']) ;
}
else
{
	$oFCKeditor->Config['AutoDetectLanguage']	= true ;
	$oFCKeditor->Config['DefaultLanguage']		= 'en' ;
}

$oFCKeditor->Value =$_SESSION["demond_add_postdescription"];;
$oFCKeditor->Create() ;
?>
				   
				   </div>
                      </td>
                    </tr>
		           <tr><td colspan="6"><div id="postdescription_check"></div></td></tr>
                    <tr><td colspan="6" style="padding-top:2px;text-align:right;" >
	               <input type="submit" name="submit_info" id="submit_info" value="SUBMIT" />

				</td>
				</tr>
				</table>
				</form>			
		 </div>
	   </div>
    </div>	
  </div>
 
  
  <?php
   include_once("header/footer.php");
  ?>
</div>
<?php if($_SESSION['interbringeruserId']>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>