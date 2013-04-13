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
<!--[if lte IE 7]>
<![endif]-->
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
<div id="blueBar" class="" style="background:#68A64C;"></div>

      <div id="headNavOut" style="margin-left:320px; width:65%;background:#606060;">
	  <div style="margin-top:5px;"><a class="lfloat" href="myaccount.php" title="<?php GO_TO_INTERBRINGER_MAIN; ?>"><img class="fb_logo img" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/logo-white.png" alt="interbringer logo" width="125" height="25"></a>
    </div>
	   <?php 
		   $nummessage=CHECK_UNREAD_MESSAGE($_SESSION['interbringerusername'], $db);
		   if($nummessage>0){
		   $message_hint="<span style=\"width:150px; margin-left:2px; background-color:#FF0000; font-weight:bold; color:#FFFFFF;\">&nbsp;".$nummessage."&nbsp;</span>";
		   }  
		?>
        <div id="headNavIn">
          <ul id="pageNav" sty le="border:#660066 solid 4px;">
            <li><a href="myaccount.php" accesskey="1"><?php echo HEADER_MYACCOUNT; ?></a></li>
			<li><a href="mymessage.php" accesskey="1"><?php echo HEADER_MESSAGE_BOARD; ?><?php echo $message_hint; ?></a></li>
			<li><a href="post.php" accesskey="2"><?php echo POST; ?></a></li>
            <li><a href="usersetting.php" accesskey="2"><?php echo HEADER_SETTING; ?></a></li>
			<li><a href="feedback.php" accesskey="2"><?php echo FEEDBACK_TO_US; ?></a></li>
            <li><a href="logoff.php" accesskey="2"><?php echo HEADER_LOGOFF; ?></a></li>
          </ul>
        </div>
      </div>
   <div class=signup_bar_container style="height:50px;">
    <div class="signup_box clearfix" style="margin-left:295px;width:73.5%">
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