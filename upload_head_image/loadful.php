<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Darkangle Flash Avatar Editor Demo</title>
<style>
a{color:#3b5998;}
</style>
</head>
<?php
  define("UPLOAD_PIC_POWER_BY", "Flash upload powered by darkangle, blog:");
?>
<body style="font-family:'Times New Roman', Times, serif,verdana;font-size:14px;">
<form enctype="multipart/form-data" method="post" name="upform"  action="upload.php">
		<input type="file" name="Filedata" id="Filedata"/>
		<input style="margin-right:20px;" type="submit" name="" value="Upload Image" onclick="return checkFile();" /><span style="visibility:hidden;" id="loading_gif"><img src="loading.gif" align="absmiddle" />Uploading, Please wait......</span>
		</form>
</body>

</html>