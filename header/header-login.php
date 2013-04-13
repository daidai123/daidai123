<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Header|Interbringer</title>
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<SCRIPT language=JavaScript> 
  <!-- 
  function processForm(form){  
  if (document.getElementById("header_search_type").value=="1") form.action="findbringer.php"; 
  if (document.getElementById("header_search_type").value=="2") form.action="findneeder.php"; 
  if (document.getElementById("header_search_type").value=="3") form.action="findbringer-trans.php"; 
  if (document.getElementById("header_search_type").value=="4") form.action="findneeder-trans.php"; 
  } 
  //--> 
  </SCRIPT> 
</head>

<body>
<div class="loggedout_menubar_container">
    <div class="clearfix loggedout_menubar"><a class="lfloat" href="./" title="转到interbringer首页"><img class="fb_logo img" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/logo-white.png" alt="interbringer logo" width="170" height="36"></a>
    </div>
  </div>
  
  <div class=signup_bar_container>
    <div class="signup_box clearfix">
<form name="header_search_form" method="get"  action="findbringer.php">
	<table>
	 <tr>
	  <td>
	  <input type="text" id="t" name="t" style="width:500px; height:20px;">
	  </td>
	  <td>
	  <select id="header_search_type" name="header_search_type_form"  onchange="processForm(this.form)" style="width:150px; height:28px; color:#333333; font-size:18px;">
	  <option value="1" <?php echo $taker_selected; ?> ><?php echo FIND_TAKER; ?></option>
	  <option value="2" <?php echo $buyer_selected; ?> ><?php echo FIND_BUYER; ?></option>
	  <option value="3" <?php echo $carrier_selected; ?> ><?php echo FIND_CARRIER; ?></option>
	  <option value="4" <?php echo $needer_selected; ?> ><?php echo FIND_NEEDER; ?></option>
	  </select> 
	  </td>
	   <td>
	  <a href="#" onclick="javascript: document.forms['header_search_form'].submit();"><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/search-new.png" /></a>
	  </td>
	  <td nowrap="nowrap">
	   <input type="checkbox" checked="checked" id="des_in" name="des_in"> <?php echo ENTIRE_TEXT_QU; ?>
	  </td>
	 </tr>
	 </table>
	 </form>
	</div>
    </div>
</body>
</html>