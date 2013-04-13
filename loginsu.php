<?php
 session_start();
 include("inc/config.php");
 require("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo INFORMATION_LOGINSU; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
</head>
<body>

	
	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header.php");
	 }
    ?>
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container"  style="width:620px;">
	<div style="text-align:center;">
	<div  style="height:320px;text-align:center;"> 
	   
	   <div  style="width:610px;  margin-top:30px; height:180px; background: url(<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/information.png) no-repeat;">
	     <div style="width:590px; height:160px; margin-left:5px; padding-top:10px;">
		     <table cellpadding="0" cellspacing="0" border="0" width="100%">
	          <?php if ($_SESSION['msg'] !=""){?>
             <tr>
             <td>
             <div id="<?php echo msg_type($_SESSION); ?>" style="border:#009900 solid 1px; font-size:18px; width:97%; font-weight:normal; font-family:'Times New Roman', Times, serif; color:#000000;" > <?php echo print_msg($_SESSION)?>, <?php echo JUMP_TO_LOGIN_HINT; ?></div>
           </td>
        </tr>
    <?php }?>
    </table>
	     </div>
	   </div>
	  
	 </div> 
	  
	  
	
	
	
	<?php
	   include_once("header/languagebar.php");
	 ?>
	  
        </div>
      </div>
	</div>
	
 <?php
   include_once("header/footer.php");
  ?>
<script>
function runtime()
{
 document.getElementById('mytime').innerHTML=document.getElementById('mytime').innerHTML-1;
 if(document.getElementById('mytime').innerHTML==0)
 {
  location.href='myaccount.php';
 }
 setTimeout("runtime()",1000);
}
runtime();
</script>
</body>
</html>