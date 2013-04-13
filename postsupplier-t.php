<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
 include("inc/config.php");
  include("fckeditor.php");
/*  include_once('sinaEditor.class.php');
*/?>
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
<script language="javascript" type="text/javascript" src="js/postsupplier.js"></script>
<script type="text/javascript">
  var formatSplitter = "-";
  var monthFormat = "mm";
  var yearFormat = "yyyy";
</script>
<script language="javascript">
 
 function change_button(key, action){
 
 if(action=="on"){
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-b.png";
  } 
  else if(action=="out"){
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png";
  }
 
 }
 
</script>
</head>

<body>
<div id="main_container" style="width:100%;">
<?php
include("threelink.php");
include("inc/function.php");
include("inc/check_cat_select.php");

$user_id=$_SESSION['interbringeruserId'];
?>

 <?php
     include_once("header/header-user-trans.php");
 ?>
	
  <div id="content" class="fb_content clearfix" style="min-height:500px; width:100%;">
    <div class="UIFullPage_Container" style="width:860px;">
    <div style="margin-top:20px; height:46px; text-align:center;">
	<img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/step-3.png" />
	</div>
       <div style="margin-top:30px; width:150px; padding-bottom:5px;font-size:20px; font-weight:bolder;">
	     <?php echo PLEASE_FILL_INFORMATION; ?>
	   </div>
	   
	   <div style="width:100%;">

		 <div style=" margin-top:10px;">
		  
	      <form name="postsupplyform" id="postsupplyform" enctype="multipart/form-data" action="supplypostpreview-t.php" method="post">               
			   <table cellpadding="3" cellspacing="3" border="0" width="100%">
               <tr>
                <td style="width:100%;" colspan="6" nowrap="nowrap">
			     <input type="text" class="inputtext" id="title" style="width:98%; font-size:18px;" name="title" value="<?php echo $_SESSION["trans_supply_add_title"];?>" /><span style="color:#FF0000;">*</span>
                </td>
                 </tr>
			
			      <tr><td colspan="6"><div id="title_check"></div></td></tr>
			
		     <tr>
		     <td  colspan="6" style="font-family:'Times New Roman', Times, serif; font-size:15px;">
		     <?php echo CATERGORY; ?>: <span style="font-family:Georgia, 'Times New Roman', Times, serif; color:#FF0000; font-size:16px; font-weight:bold;"><?php 
			
			echo get_catergory_name($_GET["ca"], $db);
			?></span>
			
			<input type="hidden" value="<?php echo $_GET["ca"]; ?>" name="catergory" id="catergory" />
		  </td>
		  </tr>
		   <tr>
			  <td colspan="6" nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; font-size:15px;">
			     <?php echo BACK_HOME_TIME; ?>: <input type="text" class="inputtext" id="backdate" name="backdate" onClick="fPopCalendar('backdate')"  readonly="readonly" value="<?php echo $_SESSION["trans_supply_add_backdate"]; ?>" />
              </td> 
		   </tr>
		   
		   <tr><td colspan="6"><div id="backdate_check"></div></td></tr>
		   <tr>
		   <?php
			  $country_query="SELECT * FROM `country` ORDER BY `id`";
	          $country_execute_query = mysql_query($country_query, $db); 
              $numCountry = mysql_num_rows($country_execute_query); 
			?>
			  <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; width:10%; font-size:15px;">
			  <?php echo BRINGER_FORM; ?>:
			  <?php echo COUNTRY; ?>: </td>
			  <td id="country_border" style="width:25%;">
			  <select id="country" name="country" style="width:95%; font-size:15px;" onChange="changepro('state','country');">
			  <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
			  
			  <?php if($_SESSION["trans_supply_add_country"]!=""){ ?>
			  
			    <?php  while ($row = mysql_fetch_array($country_execute_query)) {
			    if($_SESSION["trans_supply_add_country"]==$row["id"]) $selected="selected=\"selected\"";
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
			  
			  </td>
			  <td style="font-family:'Times New Roman', Times, serif; text-align:right; width:10%; font-size:15px;">
				<?php echo STATE_OR_PROVINCE; ?>:
              </td>
			  <td id="state_border" style="width:25%;">
			  <select id="state" name="state" style="width:95%;font-size:15px;" onChange="changecity('city','state');">
			  <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
			   <?php if($_SESSION["trans_supply_add_state"]!=""){
			     $state_query="SELECT * FROM `states` where `country`= ".$_SESSION["trans_supply_add_country"]." ORDER BY `id`";
	             $state_execute_query = mysql_query($state_query, $db);
			   ?>
			   <?php  while ($row = mysql_fetch_array($state_execute_query)) {
			    if($_SESSION["trans_supply_add_state"]==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			   ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
			  <?php   } ?>
			   <?php }else if(get_user_state($user_id, $db)!="") {
			   $state_query="SELECT * FROM `states` where `country`= ".get_user_country($user_id, $db)." ORDER BY `id`";
	           $state_execute_query = mysql_query($state_query, $db); 
			   ?>
			    <?php  while ($row = mysql_fetch_array($state_execute_query)) {
			    if(get_user_state($user_id, $db)==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			   ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
			  <?php   } ?> 
			   <?php } ?>
			  </select><span style="color:#FF0000;">*</span>
		      </td>
			  <td style="font-family:'Times New Roman', Times, serif; width:10%; text-align:right; font-size:15px;">
			 <?php echo CITY; ?>: 
             </td>
			 <td id="city_border" style="width:25%;" nowrap="nowrap">
			  <select id="city" name="city" style="width:95%;font-size:15px;">
			  <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
			  <?php if($_SESSION["trans_supply_add_city"]!=""){
			    $city_query="SELECT * FROM `city` where `state_id`= ".$_SESSION["trans_supply_add_state"]." ORDER BY `id`";
	           $city_execute_query = mysql_query($city_query, $db); 
			   ?>
			    <?php  while ($row = mysql_fetch_array($city_execute_query)) {
			    if($_SESSION["trans_supply_add_city"]==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
			  <?php   } ?>
			  <?php }else if(get_user_city($user_id, $db)!="") {
			   $city_query="SELECT * FROM `city` where `state_id`= ".get_user_state($user_id, $db)." ORDER BY `id`";
	           $city_execute_query = mysql_query($city_query, $db); 
			   ?>
			    <?php  while ($row = mysql_fetch_array($city_execute_query)) {
			    if(get_user_city($user_id, $db)==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
			  <?php   } ?> 
			   <?php } ?>
			  
			  </select><span style="color:#FF0000;">*</span>
              </td> 
			  </tr>
			  
		      <tr>
			  <td></td><td><span id="country_check"></span></td>
			  <td></td><td><span id="state_check"></span></td>
			  <td></td><td><span id="city_check"></span></td>
			  </tr>
			  
			  <?php
			   $country_query="SELECT * FROM `country` ORDER BY `id`";
	           $country_execute_query = mysql_query($country_query, $db); 
               $numCountry = mysql_num_rows($country_execute_query); 
			  ?>
			   <tr>
			    <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; text-align:right; width:10%; font-size:15px;">
			    <?php echo BACK_TO; ?>: 
			    <?php echo COUNTRY; ?>: 
			    </td>
			    <td id="countryback_border" style="width:25%;">
			    <select id="countryback" name="countryback" style="width:95%;font-size:15px;" onChange="changepro('stateback','countryback');">
			    <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
				<?php if($_SESSION["trans_supply_add_countryback"]!=""){ ?>
			  
			    <?php  while ($row = mysql_fetch_array($country_execute_query)) {
			    if($_SESSION["trans_supply_add_countryback"]==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			    ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
			  <?php } ?>
			  
			 <?php }
			  else{
			  ?>
			    <?php  
			     while ($row = mysql_fetch_array($country_execute_query)) {
			    ?>
			     <option value="<?php echo $row["id"];?>" ><?php echo $row["country"]; ?></option>
			    <?php } ?>
			    </select><span style="color:#FF0000;">*</span>
			    </td>
			  	<?php
				 }
				?>
			    <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; text-align:right; width:10%; font-size:15px;">
			     <?php echo STATE_OR_PROVINCE; ?>:
                </td>
			  
			    <td id="stateback_border" style="width:25%;">
			    <select id="stateback" name="stateback" style="width:95%;font-size:15px;" onChange="changecity('cityback','stateback');">
			    <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
				<?php if($_SESSION["trans_supply_add_stateback"]!=""){
			     $state_query="SELECT * FROM `states` where `country`= ".$_SESSION["trans_supply_add_countryback"]." ORDER BY `id`";
	             $state_execute_query = mysql_query($state_query, $db);
			   ?>
			   <?php  while ($row = mysql_fetch_array($state_execute_query)) {
			    if($_SESSION["trans_supply_add_stateback"]==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			   ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
			  <?php   } ?>
			  <?php } ?>
			    </select><span style="color:#FF0000;">*</span>
		        </td>
			  
			    <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; text-align:right; width:10%; font-size:15px;">
			    <?php echo CITY; ?>: 
                </td>
			  
			    <td id="cityback_border" style="width:25%;" nowrap="nowrap">
			    <select id="cityback" name="cityback" style="width:95%;font-size:15px;">
			    <option style="color:#999999;" value=""><?php echo PLEASESELECTED; ?></option>
				<?php if($_SESSION["trans_supply_add_cityback"]!=""){
			    $city_query="SELECT * FROM `city` where `state_id`= ".$_SESSION["trans_supply_add_stateback"]." ORDER BY `id`";
	           $city_execute_query = mysql_query($city_query, $db); 
			   ?>
			    <?php  while ($row = mysql_fetch_array($city_execute_query)) {
			    if($_SESSION["trans_supply_add_cityback"]==$row["id"]) $selected="selected=\"selected\"";
				else $selected="";
			  ?>
			  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
			  <?php   } ?>
			  <?php  } ?>
			    </select><span style="color:#FF0000;">*</span>
                </td> 
			    </tr>
			  
			     <tr>
			     <td></td><td><span id="countryback_check"></span></td>
			     <td></td><td><span id="stateback_check"></span></td>
			     <td></td><td><span id="cityback_check"></span></td>
			    </tr>
				<tr>
				<?php if($_SESSION["trans_supply_add_contactpub"]=="Y"){
				        $contactpub_yes="checked=\"checked\"";
				      }else{
				        $contactpub_no="checked=\"checked\"";
				      }
				?> 
			  <td colspan="6" nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; font-size:15px;">
			     <span style="color:#0000FF;"><?php echo PUBLICYOURPROFILEQU; ?></span>  <?php echo YES; ?><input type="radio" value="Y" <?php echo $contactpub_yes; ?> id="contactpub" name="contactpub"  />&nbsp; <?php echo NO; ?><input type="radio" id="contactpub" value="N" name="contactpub" <?php echo $contactpub_no; ?> /><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;"><?php echo PUBLICINFORINSTRUCTIONDEMAND; ?></span>
              </td> 
            </tr>
			 <tr>
			 <?php if($_SESSION["trans_supply_add_emailshow"]=="2"){
				        $emailshow_no="checked=\"checked\"";
				  }else{
				     $emailshow_yes="checked=\"checked\"";
				  }
				?> 
              <td colspan="6" style="font-family:'Times New Roman', Times, serif; font-size:15px;" nowrap="nowrap">
			     <?php echo REPLYTO; ?>: <?php echo get_user_email($user_id, $db); ?>
				 <input type="hidden" name="replyemail" id="replyemail" value="<?php echo get_user_email($user_id, $db); ?>" />
				 <input type="radio" id="emailshow" value="1" <?php echo $emailshow_yes;?> name="emailshow" /><?php echo SHOW; ?>&nbsp;<input type="radio" value="2" id="emailshow" name="emailshow" <?php echo $emailshow_no;?> /> <?php echo HIDE; ?>

				</td>
				</tr>
					<tr>  
					  <td nowrap="nowrap" colspan="6" style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000;"><?php echo PAY_ATTATION; ?><?php echo NEED_INSERT_IMAGE_CLICK; ?><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/insert_img.png" alt="insert image icon" /><?php echo WHICH_IN_EDITOR_TOOL_BAR;?><?php echo NEED_EDITOR_TO_FULL_SCREEN_CLICK; ?><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/zoom_up.png" alt="full screen icon" /><?php echo WHICH_IN_EDITOR_TOOL_BAR;?></td>

                    </tr>
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
                  $oFCKeditor->Value = $_SESSION["trans_supply_add_postdescription"];
                  $oFCKeditor->Create() ;
                   ?>
                      </div>
					  </td>
                    </tr>
		           <tr><td colspan="6"><div id="postdescription_check"></div></td></tr>
                  <tr><td colspan="6" style="padding-top:2px;text-align:right;" >

	 <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png" id="post_next" onclick="return formcheck('postsupplier');" onMouseOver="javascript: change_button('post_next', 'on');"  onmouseout="javascript: change_button('post_next', 'out');"/>&nbsp;&nbsp;
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