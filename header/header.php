<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Header|Interbringer</title>
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
</head>

<body>
<div class="loggedout_menubar_container">
    <div class="clearfix loggedout_menubar"><a class="lfloat" href="./" title="转到interbringer首页"><img class="fb_logo img" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/logo-white.png" alt="interbringer logo" width="170" height="36"><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/daidai.png" align="interbringer logo" width="70" height="25" /></a>
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
                  <td class="login_form_label_field"><a href="forgetpassword.php" rel="nofollow"><?php echo FORGETPASSWORD; ?>？</a></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>