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
  <?php
     $find_page_from_header=$_GET["header_search_type_form"];
	 
	 if($find_page_from_header=="1"){
	    
		$taker_selected="selected=\"selected\"";
		$defualt_submit_page="findbringer.php";
		
	 }else if($find_page_from_header=="2"){
	   $buyer_selected="selected=\"selected\"";
	   $defualt_submit_page="findneeder.php";
	   
	 }else if($find_page_from_header=="3"){
	   $carrier_selected="selected=\"selected\"";
	   $defualt_submit_page="findbringer-trans.php";
	   
	 }else if($find_page_from_header=="4"){
	   $needer_selected="selected=\"selected\"";
	   $defualt_submit_page="findneeder-trans.php";
	 }else{
	    $defualt_submit_page="findbringer.php";
	 }
	 
	 
  ?>
<div class="loggedout_menubar_container" style="background:#68A64C;">
    <div class="clearfix loggedout_menubar"><a class="lfloat" href="./" title="<?php GO_TO_INTERBRINGER_MAIN; ?>"><img class="fb_logo img" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/logo-white.png" alt="interbringer logo" width="170" height="36"></a>
      <div class="rfloat">
        <div class="menu_login_container">
          <form method="post" action="login.php?a=tmp" id="login_form">
            <table cellspacing="0">
              <tbody>
                <tr>
                  <td class="html7magic"><label for="username"><?php echo USERNAME; ?></label></td>
                  <td class="html7magic"><label for="pass"><?php echo PASSWORD; ?></label></td>
                </tr>
                <tr>
                  <td><input class="inputtext" name="username" id="username" tabindex="1" type="text"></td>
                  <td><input class="inputtext" name="password" id="password" tabindex="2" type="password"></td>
                  <td><label class="uiButton uiButtonConfirm uiButtonMedium">
                    <input value="<?php echo LOGIN; ?>" tabindex="4" type="submit">
                    </label></td>
					<td><LABEL class="uiButton uiButtonSpecial uiButtonMedium">
                          <INPUT tabIndex=4 value="<?php echo REGISTER; ?>" style="background:#68A64C;" onclick="javascript:window.location='register.php';" type="button">
                    </LABEL>
			     </td>
				 <td><LABEL class="uiButton uiButtonConfirm uiButtonMedium">
                          <INPUT  value="<?php echo FEEDBACK_TO_US; ?>"  onclick="javascript:window.location='feedback.php';" type="button">
                    </LABEL>
			     </td>
                </tr>
                <tr>
                  <td class="login_form_label_field"><input class="inputcheckbox" value="1" id="persistent" name="persistent" tabindex="3" type="checkbox">
                    <label id="label_persistent" for="persistent"><?php echo KEEP_ME_LOGIN; ?></label></td>
                  <td class="login_form_label_field"><a href="forgetpassword.php" rel="nofollow"><?php echo FORGETPASSWORD; ?>?</a></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class=signup_bar_container>
    <div class="signup_box clearfix">
	<form name="header_search_form" method="get"  action="<?php echo $defualt_submit_page; ?>">
	<table>
	 <tr>
	  <td>
	  <input type="text" id="t" name="t" value="<?php echo $title; ?>" style="width:500px; height:20px;">
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