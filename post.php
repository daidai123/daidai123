<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
 include("inc/config.php");
 include("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo POST; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
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
     include_once("header/header-user.php");
   ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container" style="width:1050px;">
	<div style="height:385px;">
	
	  <div style="text-align:center">
	   <img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/step-1.png" />
	  </div>
	  <div style="color:#000000; font-size:16px; width:850px; margin-top:30px; font-weight:bold; margin-left:20px;">
	    <?php echo PLEASE_SELECT_POST_TYPE; ?>
	  </div>
      <div style="width:200px; margin-left: 50px; height:210px; margin-top:30px; float:left; border:#DADEE9 solid 1px;" >
       <div style="margin:4px 4px 4px 4px; background:#EDEFF4; border:#EDEFF4 solid 1px; height:200px;"> 

		  <div class=login_form_container style="margin-top:0px; margin-bottom:0px;">
             
			 <div style="text-align:center; margin-top:30px;">
			<span style="color:#FD5411; font-weight:bold; font-size:18px;"><?php echo I_WANT_TO_BE; ?></span>
			<div style="margin-left:10px;">
			<span style="color:#FD5411; font-weight:bold; font-size:18px;"><?php echo A_TAKER; ?></span>
			</div>
			</div>
		    <div style="text-align: center; margin-top:40px;">
			 <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png" id="next2" onclick="javascript: window.location.href='catergoryselect.php?type=supply';" onmouseover="javascript: change_button('next2', 'on');"  onmouseout="javascript: change_button('next2', 'out');"/>
			</div>

         </div>
        </div>	
      </div>
	  
	  <div style="width:200px; margin-left: 50px; height:210px; margin-top:30px; float:left; border:#DADEE9 solid 1px;" >
       <div style="margin:4px 4px 4px 4px; background:#EDEFF4; border:#EDEFF4 solid 1px; height:200px;"> 

		  <div class=login_form_container style="margin-top:0px; margin-bottom:0px;">
             
			 <div style="text-align:center; margin-top:30px;">
			<span style="color:#FD5411; font-weight:bold; font-size:18px;"><?php echo I_WANT_TO_BE; ?></span>
			<div style="margin-left:10px;">
			<span style="color:#FD5411; font-weight:bold; font-size:18px;"><?php echo A_BUYER; ?></span>
			</div>
			</div>
		    <div style="text-align: center; margin-top:40px;">
			  <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png" id="next1" onclick="javascript: window.location.href='catergoryselect.php?type=demand';" onmouseover="javascript: change_button('next1', 'on');"  onmouseout="javascript: change_button('next1', 'out');"/>
			</div>

         </div>
        </div>	
      </div>
	  
	  
	  	  <div style="border:#EEEEEE solid 5px; height:210px; margin-right:50px; width:200px; border:#DADEE9 solid 1px; float:right; margin-top:30px;">
	      <div style="border:#EDEFF4 solid 1px; height:200px; background:#EDEFF4; margin:4px 4px 4px 4px;">
		    <div style="text-align:center; margin-top:30px;">
			<span style="color:#68A64C; font-weight:bold; font-size:18px;"><?php echo I_WANT_TO_BE; ?></span>
			<div style="margin-left:10px;">
			<span style="color:#68A64C; font-weight:bold; font-size:18px;"><?php echo A_CARRIER; ?></span>
			</div>
			</div>
		    <div style="text-align: center; margin-top:40px;">
			  <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png" id="next3" onclick="javascript: window.location.href='catergoryselect.php?type=tsupply';" onmouseover="javascript: change_button('next3', 'on');"  onmouseout="javascript: change_button('next3', 'out');"/>
			</div>

		</div>
     </div>
	  
	  
	  <div style="border:#EEEEEE solid 5px; height:210px; margin-right:50px; width:200px; border:#DADEE9 solid 1px; float:right; margin-top:30px;">
	      <div style="border:#EDEFF4 solid 1px; height:200px; background:#EDEFF4; margin:4px 4px 4px 4px;">
		    <div style="text-align:center; margin-top:30px;">
			<span style="color:#68A64C; font-weight:bold; font-size:18px;"><?php echo I_WANT_TO_BE; ?></span>
			<div style="margin-left:10px;">
			<span style="color:#68A64C; font-weight:bold; font-size:18px;"><?php echo A_NEEDER; ?></span>
			</div>
			</div>
		    <div style="text-align: center; margin-top:40px;">
			 <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png" id="next4" onclick="javascript: window.location.href='catergoryselect.php?type=tdemand';" onmouseover="javascript: change_button('next4', 'on');"  onmouseout="javascript: change_button('next4', 'out');"/>
			</div>

		</div>
     </div>
	 
	 
	 </div> 
	  
	   <div style="height:20px;">
	   </div>
      </div>
	</div>
  <?php
   include_once("header/footer.php");
  ?>
</div>	
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>