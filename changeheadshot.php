<?php
ob_start();
require("inc/session.php");
sessionCheck(session_id(), $_SESSION, $_SERVER);
checkLogin();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo CHANGEHEADSHOTINFO; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<link rel="stylesheet" type="text/css" href="index.css" />
<script  src="./js/changebasic.js"></script>
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<script language="javascript">
 
 function change_button(key, action){
 
 if(action=="on"){
 // alert(document.getElementById("next1").src);
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-b.png";
  } 
  else if(action=="out"){
  document.getElementById(key).src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/next-button-a.png";
  }
 
 }
 
</script>
</head>
<body>
<div id="main_container" style="width:100%;" >
<?php
include("threelink.php");
include("inc/function.php");
 
$user_id=$_SESSION['interbringeruserId'];
?>
<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
	 
    ?>
<div class="fb_content clearfix" id="content">
  <div class="UIFullPage_Container">
    <div style="margin-left:40px;">
      <div style="color:#000000; font-size:16px; min-height:400px; width:850px; margin-top:30px; font-weight:bold; margin-left:40px;">
        <div>
		<h3 style="font-size:16px;padding:5px;border-bottom:solid 1px #ccc;"><?php echo UPLOAD_HEADSHOT_CHANGE; ?></h3>
		<div style="padding:10px 0;color:#666;">
		 <?php echo PLEASE_UPLOAD_HEADSHOT_OR; ?><a style="color:#cc3300;" href="javascript:void(0);" onclick="useCamera()"><?php echo PLEASE_USE_CAMERA; ?></a>
		</div>
		<form enctype="multipart/form-data" method="post" name="upform" target="upload_target" action="upload_head_image/upload.php">
		<input type="file" name="Filedata" id="Filedata"/>
		<input style="margin-right:20px;" type="submit" name="" value="<?php echo UPLOAD_IMAGE; ?>" onclick="return checkFile();" /><span style="visibility:hidden;" id="loading_gif"><img src="loading.gif" align="absmiddle" /><?php echo UPLOADING_PLEASE_WAIT; ?></span>
		</form>
		<iframe src="about:blank" name="upload_target" style="display:none;"></iframe>
		<div id="avatar_editor"></div>
		<script type="text/javascript">
		//允许上传的图片类�?
		var extensions = 'jpg,jpeg,gif,png';
		//保存缩略图的地址.
		var saveUrl = '/upload_head_image/save_avatar.php';
		//保存摄象头白摄图片的地址.
		var cameraPostUrl = '/upload_head_image/camera.php';
		//头像编辑器flash的地址.
		var editorFlaPath = '/upload_head_image/AvatarEditor.swf';

		function useCamera()
		{
			var content = '<embed height="464" width="514" ';
			content +='flashvars="type=camera';
			content +='&postUrl='+cameraPostUrl+'?&radom=1';
			content += '&saveUrl='+saveUrl+'?radom=1" ';
			content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
			content +='allowscriptaccess="always" quality="high" ';
			content +='src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
		function buildAvatarEditor(pic_id,pic_path,post_type)
		{
			var content = '<embed height="464" width="514"'; 
			content+='flashvars="type='+post_type;
			content+='&photoUrl='+pic_path;
			content+='&photoId='+pic_id;
			content+='&postUrl='+cameraPostUrl+'?&radom=1';
			content+='&saveUrl='+saveUrl+'?radom=1"';
			content+=' pluginspage="http://www.macromedia.com/go/getflashplayer"';
			content+=' type="application/x-shockwave-flash"';
			content+=' allowscriptaccess="always" quality="high" src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
			/**
			  * 提供给FLASH的接�?�?没有摄像头时的回调方�?
			  */
			 function noCamera(){
				 alert("Sorry! I don't have camera");
			 }
					
			/**
			 * 提供给FLASH的接口：编辑头像保存成功后的回调方法
			 */
			function avatarSaved(){
			    alert('<?php echo SAVE_IMAGE_SUCCESSFUL; ?>');
				window.location.href = '/usersetting.php';
			}
			
			 /**
			  * 提供给FLASH的接口：编辑头像保存失败的回调方�? msg 是失败信息，可以不返回给用户, 仅作调试使用.
			  */
			 function avatarError(msg){
				 alert("Sorry! Upload fail.");
			 }

			 function checkFile()
			 {
				 var path = document.getElementById('Filedata').value;
				 var ext = getExt(path);
				 var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
				  if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
				 alert('Sorry! you can only upload jpg, gif, png');
				 return false;
				 }
				 showLoading();
				 return true;
			 }

			 function getExt(path) {
				return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
			}
              function	showLoading()
			  {
				  document.getElementById('loading_gif').style.visibility = 'visible';
			  }
			  function hideLoading()
			  {
				document.getElementById('loading_gif').style.visibility = 'hidden';
			  }
		</script>
	</div>
      </div>
      <div style="height:20px;"></div>
    </div>
	</div>
  </div>
  <?php
      include_once("header/footer.php");
    ?>
</div>
<?php if($_SESSION["interbringeruserId"]>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>
